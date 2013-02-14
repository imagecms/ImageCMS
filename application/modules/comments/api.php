<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Api extends Comments {

    public $tpl_name = 'comments_api';
    public $period = 5;      // Post comment period in minutes. If user is unregistered, check will be made by ip address. 0 - To disable this method.
    public $can_comment = 0;      // Possible values: 0 - all, 1 - registered only.
    public $max_comment_length = 500;    // Max. comments text lenght.
    public $use_captcha = FALSE;  // Possible values TRUE/FALSE;
    public $cache_ttl = 86400;
    public $comment_controller = 'comments/add';
    public $use_moderation = TRUE;
    public $validation_errors;

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
    }

    public function index() {
//        return FALSE;
    }

    private function init_settings() {
        $settings = $this->base->get_settings();

        ($hook = get_hook('comments_settigs_init')) ? eval($hook) : NULL;
        if (is_array($settings)) {
            foreach ($settings as $k => $v) {
                $this->$k = $v;
            }
        }
    }

    public function renderPosts() {
        $comments = array();
        ($hook = get_hook('comments_on_build_comments')) ? eval($hook) : NULL;

        $this->load->model('base');
        $this->init_settings();

//        if (($comments = $this->cache->fetch('comments_' . $item_id . $this->module, 'comments')) !== FALSE) {
//            ($hook = get_hook('comments_fetch_cache_ok')) ? eval($hook) : NULL;
//            // Comments fetched from cahce file
//        } else {
//        $this->db->where('module', 'shop');
        $comments = $this->base->get($this->parsUrl($_SERVER['HTTP_REFERER']));

        // Read comments template
        // Set page id for comments form
        if ($comments != FALSE) {
            ($hook = get_hook('comments_store_cache')) ? eval($hook) : NULL;
            $this->cache->store('comments_' . $this->parsUrl($_SERVER['HTTP_REFERER']) . $this->module, $comments, $this->cache_ttl, 'comments');
        }
        //}

        if ($comments != null) {
            $comments_count = count($comments);
        } else {
            $comments_count = 0;
        }

        if (is_array($comments)) {
            $i = 0;
            foreach ($comments as $comment) {
                if ($comment['parent'] > 0) {
                    $comment_ch[] = $comment;
                    unset($comments[$i]);
                }
                $i++;
            }
        }
//        $this->load->library('pagination');
//
//        $config['base_url'] = '';
//        $config['total_rows'] = '200';
//        $config['per_page'] = '20';
//
//        $this->pagination->initialize($config);
//
//        echo $this->pagination->create_links();


        $data = array(
            'comments_arr' => $comments,
            'comment_ch' => $comment_ch,
            'comment_controller' => $this->comment_controller,
            'total_comments' => lang('lang_total_comments') . count($comments),
            'can_comment' => $this->can_comment,
            'use_captcha' => $this->use_captcha,
//            'item_id' => $this->input->post(item_id)
        );

        if ($this->use_captcha == TRUE) {
            $this->dx_auth->captcha();
            $data['cap_image'] = $this->dx_auth->get_captcha_image();
        }

        ($hook = get_hook('comments_read_com_tpl')) ? eval($hook) : NULL;

        $comments = $this->template->read($this->tpl_name, $data);

        ($hook = get_hook('comments_assign_tpl_data')) ? eval($hook) : NULL;
        //$this->render('comments_list', array('comments'=>$comments));

        echo json_encode(array(
            'comments' => $comments,
            'total_comments' => $comments_count,
            'validation_errors' => $this->validation_errors
        ));
    }

    /**
     * Determinate commented page.
     * 
     * if product - return id
     */
    public function parsUrl($url) {
        if (strstr($url, '/product/')) {
            $url = parse_url($url);
            $search = array('shop', 'product', '/');
            $replace = array('', '', '');
            $url = str_replace($search, $replace, $url['path']);
            $id = $this->db->select('id')
                    ->where('url', $url)
                    ->get('shop_products')
                    ->row();
            return $id->id;
        }

        if (strstr($url, '/bloh/')) {
            $url = parse_url($url);
            $search = array('bloh', '/');
            $replace = array('', '');
            $url = str_replace($search, $replace, $url['path']);
            $id = $this->db->select('id')
                    ->where('url', $url)
                    ->get('content')
                    ->row();
            return $id->id;
        }
    }

    public function getModule($url) {
        if (strstr($url, '/shop/')) {
            return 'shop';
        }

        if (strstr($url, '/bloh/')) {
            return 'core';
        }
    }

    public function newPost() {
        ($hook = get_hook('comments_on_add')) ? eval($hook) : NULL;

        $this->load->library('user_agent');
        $this->load->library('form_validation');
        $this->load->model('base');


        $item_id = $this->parsUrl($_SERVER['HTTP_REFERER']);

        // Check if page comments status.
        if ($this->getModule($_SERVER['HTTP_REFERER']) == 'core') {
            if ($this->base->get_item_comments_status($item_id) == FALSE) {
                ($hook = get_hook('comments_page_comments_disabled')) ? eval($hook) : NULL;
                $this->core->error(lang('error_comments_diabled'));
            }
        }

        if ($this->period > 0)
            if ($this->check_comment_period() == FALSE) {
                ($hook = get_hook('comments_period_error')) ? eval($hook) : NULL;
                $this->core->error(sprintf(lang('error_comments_period'), $this->period));
            }

        // Validate email and nickname from unregistered users.
        if ($this->dx_auth->is_logged_in() == FALSE) {
            ($hook = get_hook('comments_set_val_rules')) ? eval($hook) : NULL;

            $this->form_validation->set_rules('comment_email', 'lang:lang_comment_email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('comment_author', 'lang:lang_comment_author', 'trim|required|xss_clean|max_length[50]');
            $this->form_validation->set_rules('comment_site', 'lang:lang_comment_site', 'trim|xss_clean|max_length[250]');
        }

        // Check captcha code if captcha_check enabled and user in not admin.
        if ($this->use_captcha == TRUE AND $this->dx_auth->is_admin() == FALSE) {
            ($hook = get_hook('comments_set_captcha')) ? eval($hook) : NULL;
            if ($this->dx_auth->use_recaptcha)
                $this->form_validation->set_rules('recaptcha_response_field', lang('lang_captcha'), 'trim|required|xss_clean|callback_captcha_check');
            else
                $this->form_validation->set_rules('captcha', lang('lang_captcha'), 'trim|required|xss_clean|callback_captcha_check');
        }

        $this->form_validation->set_rules('comment_text', 'lang:lang_comment_text', 'trim|required|xss_clean|max_length[' . $this->max_comment_length . ']');

        if ($this->form_validation->run($this) == FALSE) {
            ($hook = get_hook('comments_validation_failed')) ? eval($hook) : NULL;
            //$this->core->error( validation_errors() );
//            $this->template->assign('comment_errors', validation_errors());
        } else {
            if ($this->dx_auth->is_logged_in() == FALSE) {
                ($hook = get_hook('comments_author_not_logged')) ? eval($hook) : NULL;

                $comment_author = trim(htmlspecialchars($this->input->post('comment_author')));
                $comment_email = trim(htmlspecialchars($this->input->post('comment_email')));

                // Write on cookie nickname and email
                $this->_write_cookie($comment_author, $comment_email, $this->input->post('comment_site'));
            } else {
                ($hook = get_hook('comments_author_logged')) ? eval($hook) : NULL;

                $user = $this->db->get_where('users', array('id' => $this->dx_auth->get_user_id()))->row_array();
                $comment_author = $user['username'];
                $comment_email = $user['email'];
            }

            $comment_text = trim(htmlspecialchars($this->input->post('comment_text')));
            $comment_text = str_replace("\n", '<br/>', $comment_text);
            $comment_text_plus = trim(htmlspecialchars($this->input->post('comment_text_plus')));
            $comment_text_plus = str_replace("\n", '<br/>', $comment_text_plus);
            $comment_text_minus = trim(htmlspecialchars($this->input->post('comment_text_minus')));
            $comment_text_minus = str_replace("\n", '<br/>', $comment_text_minus);
            $rate = $this->input->post('ratec');
            if ($this->input->post('ratec')) {
                if (SProductsQuery::create()->findPk($item_id) !== null) {
                    $model = SProductsRatingQuery::create()->findPk($item_id);
                    if ($model === null) {
                        $model = new SProductsRating;
                        $model->setProductId($item_id);
                    }
                    $model->setVotes($model->getVotes() + 1);
                    $model->setRating($model->getRating() + $rate);
                    $model->save();
                }
            }
        }

        if ($this->input->post('action') == 'newPost') {
            $email = $this->db->select('email')
                    ->get_where('users', array('username' => $this->dx_auth->get_username()), 1)
                    ->row();

            if (!validation_errors()) {
                $comment_data = array(
                    'module' => $this->getModule($_SERVER['HTTP_REFERER']),
                    'user_id' => $this->dx_auth->get_user_id(), // 0 if unregistered
                    'user_name' => $this->dx_auth->get_username(),
                    'user_mail' => $email->email,
                    'user_site' => htmlspecialchars($this->input->post(comment_site)),
                    'text' => $comment_text,
                    'text_plus' => $comment_text_plus,
                    'text_minus' => $comment_text_minus,
                    'item_id' => $this->parsUrl($_SERVER['HTTP_REFERER']),
                    'status' => $this->_comment_status(),
                    'agent' => $this->agent->agent_string(),
                    'user_ip' => $this->input->ip_address(),
                    'date' => time(),
                    'rate' => $this->input->post('ratec'),
                    'parent' => $this->input->post('parent')
                );

                $this->db->insert('comments', $comment_data);
                $this->validation_errors = '';

                //return sucesfull JSON answer
                echo json_encode(
                        array(
                            'answer' => 'sucesfull'
                        )
                );
            } else {
                echo json_encode(
                        array(
                            'answer' => 'error',
                            'validation_errors' => validation_errors()
                        )
                );
            }
        }
//        else
//            parent::add();
    }

    /**
     * Determinate comment status.
     *
     *  Comment statuses
     *  0 - Normal(approved) comment.
     *  1 - Waiting for moderation(pending).
     *  2 - Spam.
     */
    private function _comment_status() {
        ($hook = get_hook('comments_on_get_status')) ? eval($hook) : NULL;

        $status = 0;

        if ($this->dx_auth->is_admin() == TRUE) {
            return 0;
        }

        if ($this->use_moderation == TRUE) {
            $status = 1;
        } elseif ($this->use_moderation == FALSE) {
            $status = 0;
        }

        return $status;
    }

    public function setyes() {
        $comid = $this->input->post('comid');
        if ($this->session->userdata('commentl' . $comid) != 1) {
            $row = $this->db->where('id', $comid)->get('comments')->row();
            $like = $row->like;
            $like = $like + 1;
            $data = array('like' => $like);
            $this->db->where('id', $comid);
            $this->db->update('comments', $data);
            $this->session->set_userdata('commentl' . $comid, 1);
            if ($this->input->is_ajax_request()) {
                return json_encode(array("y_count" => "$like"));
            } else {
                $like--;
                return json_encode(array("y_count" => "$like"));
            }
        }
    }

    public function setno() {
        $comid = $this->input->post('comid');
        if ($this->session->userdata('commentl' . $comid) != 1) {
            $row = $this->db->where('id', $comid)->get('comments')->row();
            $disslike = $row->disslike;
            $disslike = $disslike + 1;
            $data = array('disslike' => $disslike);
            $this->db->where('id', $comid);
            $this->db->update('comments', $data);
            $this->session->set_userdata('commentl' . $comid, 1);
            if ($this->input->is_ajax_request()) {
                return json_encode(array("n_count" => "$disslike"));
            } else {
                $disslike--;
                return json_encode(array("n_count" => "$disslike"));
            }
        }
    }

    private function check_comment_period() {
        ($hook = get_hook('comments_on_check_period')) ? eval($hook) : NULL;

        if ($this->dx_auth->is_admin() == TRUE) {
            return TRUE;
        }

        $this->db->select('id, date');
        $this->db->order_by('date', 'desc');

        if ($this->dx_auth->is_logged_in() == TRUE) {
            $this->db->where('user_id', $this->dx_auth->get_user_id());
        } else {
            $this->db->where('user_ip', $this->input->ip_address());
        }

        $query = $this->db->get('comments', 1);

        if ($query->num_rows() == 1) {
            $query = $query->row_array();

            $latest_comment = $query['date'];
            $allow_time = $latest_comment + ($this->period * 60);

            if ($allow_time > time()) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    public function captcha_check($code) {
        ($hook = get_hook('comments_captcha_check')) ? eval($hook) : NULL;

        if (!$this->dx_auth->captcha_check($code))
            return FALSE;
        else
            return TRUE;
    }

    function get_comments_number($id) {
        $this->where('item_id', $id);
        $query = $this->db->get('comments')->result_array();
        return count($query);
    }

    private function _write_cookie($name, $email, $site) {
        $this->load->helper('cookie');

        ($hook = get_hook('comments_write_cookie')) ? eval($hook) : NULL;

        $cookie_name = array(
            'name' => 'comment_author',
            'value' => $name,
            'expire' => '30000000',
        );

        $cookie_email = array(
            'name' => 'comment_email',
            'value' => $email,
            'expire' => '30000000',
        );

        $cookie_site = array(
            'name' => 'comment_site',
            'value' => $site,
            'expire' => '30000000',
        );


        set_cookie($cookie_name);
        set_cookie($cookie_email);
        set_cookie($cookie_site);

        return TRUE;
    }

}


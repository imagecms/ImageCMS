<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Commentsapi extends Comments {

    public $tpl_name = 'comments_api';
    public $period = 5;      // Post comment period in minutes. If user is unregistered, check will be made by ip address. 0 - To disable this method.
    public $can_comment = 0;      // Possible values: 0 - all, 1 - registered only.
    public $max_comment_length = 500;    // Max. comments text lenght.
    public $use_captcha = FALSE;  // Possible values TRUE/FALSE;
    public $cache_ttl = 86400;
    public $comment_controller = 'comments/add';
    public $use_moderation = TRUE;
    public $validation_errors;
    public $enable_comments = true;
    public $module = 'core';

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
        $this->module = $this->getModule($_SERVER['HTTP_REFERER']);
        $lang = new MY_Lang();
        $lang->load('comments');
    }

    private function init_settings() {
        $settings = $this->base->get_settings();
        
        ($hook = get_hook('comments_settigs_init')) ? eval($hook) : NULL;
        if (is_array($settings)) {
            foreach ($settings as $k => $v) {
                $this->$k = $v;
            }
        }
        $this->use_moderation = $this->dx_auth->is_admin() ? FALSE : $settings['use_moderation'];
        $this->use_captcha = $this->dx_auth->is_admin() ? FALSE : $settings['use_captcha'];
    }

    public function renderAsArray($url) {
        $comments = array();
        ($hook = get_hook('comments_on_build_comments')) ? eval($hook) : NULL;

        $this->load->model('base');
        $this->init_settings();

        $this->module = $this->getModule($url);
        $item_id = $this->parsUrl($url);
        $commentsCount = $this->getTotalCommentsForProducts($item_id);

        $comments = $this->base->get($item_id, 0, $this->module, 99999);

        // Read comments template
        // Set page id for comments form
        if ($comments != FALSE) {
            $this->cache->store('comments_' . $item_id . $this->module, $comments, $this->cache_ttl, 'comments');
        }

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

        $data = array(
            'comments_arr' => $comments,
            'comment_ch' => $comment_ch,
            'comment_controller' => $this->comment_controller,
            'total_comments' => lang('Total comments: ', 'comments') . count($comments),
            'can_comment' => $this->can_comment,
            'use_captcha' => $this->use_captcha,
            'use_moderation' => $this->use_moderation,
            'enable_comments' => $this->enable_comments
        );

        if ($this->use_captcha == TRUE) {
            $this->dx_auth->captcha();
            $data['cap_image'] = $this->dx_auth->get_captcha_image();
        }
        ($hook = get_hook('comments_read_com_tpl')) ? eval($hook) : NULL;

        if ($this->enable_comments) {
            $comments = \CMSFactory\assetManager::create()
                    ->setData($data)
                    ->registerStyle('comments', TRUE)
                    ->fetchTemplate($this->tpl_name);
        } else {
            $comments = '';
        }

        ($hook = get_hook('comments_assign_tpl_data')) ? eval($hook) : NULL;
        return array(
            'comments' => $comments,
            'commentsCount' => $commentsCount[$item_id],
            'total_comments' => $comments_count ? $comments_count . ' ' . $this->Pluralize($comments_count, array(lang('comment', 'comments'), lang('comment', 'comments'), lang('comments', 'comments'))) : lang('Leave comment', 'comments'),
            'validation_errors' => $this->validation_errors
        );
    }

    public function renderPosts() {
        $comments = array();
        ($hook = get_hook('comments_on_build_comments')) ? eval($hook) : NULL;
        $this->load->model('base');
        $this->init_settings();

        $item_id = $this->parsUrl($_SERVER['HTTP_REFERER']);

        $commentsCount = $this->getTotalCommentsForProducts($item_id);
        $comments = $this->base->get($item_id, 0, $this->module, $_POST['countcomment']);

        // Read comments template
        // Set page id for comments form
        if ($comments != FALSE) {
            ($hook = get_hook('comments_store_cache')) ? eval($hook) : NULL;
            $this->cache->store('comments_' . $item_id . $this->module, $comments, $this->cache_ttl, 'comments');
        }

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
        
        $data = array(
            'comments_arr' => $comments,
            'comment_ch' => $comment_ch,
            'comment_controller' => $this->comment_controller,
            'total_comments' => lang('Total comments: ', 'comments') . count($comments),
            'can_comment' => $this->can_comment,
            'use_captcha' => $this->use_captcha,
            'use_moderation' => $this->use_moderation,
            'enable_comments' => $this->enable_comments,
            'visibleMainForm' => $_POST['visibleMainForm']
        );
        
        if ($this->use_captcha == TRUE && !$this->dx_auth->is_admin()) {
            $this->dx_auth->captcha();
            $data['cap_image'] = $this->dx_auth->get_captcha_image();
        }
        ($hook = get_hook('comments_read_com_tpl')) ? eval($hook) : NULL;

        if ($this->enable_comments) {
            $comments = \CMSFactory\assetManager::create()
                    ->setData($data)
                    ->registerStyle('comments', TRUE)
                    ->fetchTemplate($this->tpl_name);
        } else {
            $comment = '';
        }

        ($hook = get_hook('comments_assign_tpl_data')) ? eval($hook) : NULL;

        echo json_encode(array(
            'comments' => $comments,
            'total_comments' => $comments_count ? $comments_count . ' ' . $this->Pluralize($comments_count, array(lang("review", 'comments'), lang("reviews", 'comments'), lang("review", 'comments'))) : lang('Leave a comment', 'comments'),
            'commentsCount' => $commentsCount[$item_id],
            'validation_errors' => $this->validation_errors
        ));
    }

    /**
     * Determinate commented page.
     *
     * if product - return id
     */
    public function parsUrl($url) {
        defined('DS') OR define('DS', '/');

        if (strstr($url, '/product/')) {
            $url = parse_url($url);
            /** Check is lang segment and remove it from url path * */
            $urlArraySegments = explode("/", $url["path"]);

            $id = $this->db->select('id, enable_comments')
                    ->where('url', end($urlArraySegments))
                    ->get('shop_products')
                    ->row();

            if ($id->enable_comments == 0) {
                $this->enable_comments = false;
            }
            return $id->id;
        }

        if (strstr($url, "/image/")) {
            $url = explode(DS, $url);
            $url = $url[count($url) - 1];

            return $url;
        }
        if (strstr($url, '/album/')) {
            $url = explode(DS, $url);
            $url = $url[count($url) - 1];

            return $url;
        }

        if ($url == site_url()) {
            $id = $this->db->select('main_page_id, comments_status')
                    ->join('content', 'settings.main_page_id=content.id')
                    ->get('settings')
                    ->row();

            if ($id->comments_status == 0) {
                $this->enable_comments = false;
            }
            return $id->main_page_id;
        }

        $paths = explode('/', $url);
        $paths = $paths[count($paths) - 1];

        $id = $this->db->select('id, comments_status')
                ->where('url', $paths)
                ->get('content');
        
        if ($id) {
            $id = $id->row();
        }

        if ($id->comments_status == 0) {
            $this->enable_comments = FALSE;
        }
        return $id->id;
    }

    public function getModule($url) {
        $url = '/' . $url;

        if (strstr($url, '/shop/')) {
            return 'shop';
        }

        if (strstr($url, '/bloh/')) {
            return 'core';
        }

        if (strstr($url, '/gallery/')) {
            return 'gallery';
        }

        if ($url == site_url()) {
            return 'core';
        }

        return 'core';
    }

    public function newPost() {
        $this->load->model('base');
        $this->init_settings();

        ($hook = get_hook('comments_on_add')) ? eval($hook) : NULL;

        $this->load->library('user_agent');
        $this->load->library('form_validation');
        $this->load->model('base');

        $item_id = $this->parsUrl($_SERVER['HTTP_REFERER']);

        if ($this->period > 0)
            if ($this->check_comment_period() == FALSE) {
                echo json_encode(
                        array(
                            'answer' => 'error',
                            'validation_errors' => lang('The following comment can be left through', 'comments') . ' ' . $this->period . ' ' . lang('minutes', 'comments')
                        )
                );
                return;
            }

        // Validate email and nickname from unregistered users.
        if ($this->dx_auth->is_logged_in() == FALSE) {
            ($hook = get_hook('comments_set_val_rules')) ? eval($hook) : NULL;

            $this->form_validation->set_rules('comment_email', lang('Email', 'comments'), 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('comment_author', lang('Your name', 'comments'), 'trim|required|xss_clean|max_length[50]');
            $this->form_validation->set_rules('comment_site', lang('Site', 'comments'), 'trim|xss_clean|max_length[250]');
        }

        // Check captcha code if captcha_check enabled and user in not admin.
        if ($this->use_captcha == TRUE AND $this->dx_auth->is_admin() == FALSE) {
            ($hook = get_hook('comments_set_captcha')) ? eval($hook) : NULL;
            $this->form_validation->set_message('callback_captcha_check', lang('Wrong code protection', 'comments'));
            if ($this->dx_auth->use_recaptcha)
                $this->form_validation->set_rules('recaptcha_response_field', lang("Code protection", 'comments'), 'trim|required|xss_clean|callback_captcha_check');
            else
                $this->form_validation->set_rules('captcha', lang("Code protection", 'comments'), 'trim|required|xss_clean|callback_captcha_check');
        }

        if ($this->max_comment_length != 0)
            $this->form_validation->set_rules('comment_text', lang('Comment', 'comments'), 'trim|required|xss_clean|max_length[' . $this->max_comment_length . ']');
        else
            $this->form_validation->set_rules('comment_text', lang('Comment', 'comments'), 'trim|required|xss_clean');

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
                if (class_exists('SProductsQuery'))
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
                    ->get_where('users', array('id' => $this->dx_auth->get_user_id()), 1)
                    ->row();

            if (!validation_errors()) {
                $comment_data = array(
                    'module' => $this->module,
                    'user_id' => $this->dx_auth->get_user_id(), // 0 if unregistered
                    'user_name' => $this->dx_auth->is_logged_in() ? $this->dx_auth->get_username() : trim(htmlspecialchars($this->input->post('comment_author'))),
                    'user_mail' => $this->dx_auth->is_logged_in() ? $email->email : trim(htmlspecialchars($this->input->post('comment_email'))),
                    'user_site' => htmlspecialchars($this->input->post(comment_site)),
                    'text' => $comment_text,
                    'text_plus' => $comment_text_plus,
                    'text_minus' => $comment_text_minus,
                    'item_id' => $item_id,
                    'status' => $this->_comment_status(),
                    'agent' => $this->agent->agent_string(),
                    'user_ip' => $this->input->ip_address(),
                    'date' => time(),
                    'rate' => $this->input->post('ratec'),
                    'parent' => $this->input->post('comment_parent')
                );
                $this->db->insert('comments', $comment_data);
                $this->_recount_comments($item_id, $comment_data['module']);
                \CMSFactory\Events::create()->registerEvent(array('commentId' => $this->db->insert_id()));
                $this->validation_errors = '';

                //return sucesfull JSON answer
                echo json_encode(
                        array(
                            'answer' => 'sucesfull'
                        )
                );
            } else {


                if ($this->dx_auth->use_recaptcha)
                    $field_name = 'recaptcha_response_field';
                else
                    $field_name = 'captcha';

//                if ($this->form_validation->error($field_name)) {
                $this->dx_auth->captcha();
                $cap_image = $this->dx_auth->get_captcha_image();
//                }
//                if ($this->use_captcha == TRUE && !$this->dx_auth->is_admin()) {
//                    $this->dx_auth->captcha();
//                    $data['cap_image'] = $this->dx_auth->get_captcha_image();
//                }
                echo json_encode(
                        array(
                            'answer' => 'error',
                            'validation_errors' => validation_errors(),
                            'cap_image' => $cap_image
                        )
                );
            }
        }
    }

    private function _recount_comments($page_id, $module) {
        if ($module != 'core') {
            return FALSE;
        }

        $this->db->where('item_id', $page_id);
        $this->db->where('status', 0);
        $this->db->where('module', 'core');
        $this->db->from('comments');
        $total = $this->db->count_all_results();

        $this->db->limit(1);
        $this->db->where('id', $page_id);
        $this->db->update('content', array('comments_count' => $total));
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

        if ($this->dx_auth->is_admin() == TRUE)
            return 0;

        if ($this->use_moderation == TRUE)
            $status = 1;
        elseif ($this->use_moderation == FALSE)
            $status = 0;

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

        if ($this->dx_auth->is_admin() == TRUE)
            return TRUE;

        $this->db->select('id, date');
        $this->db->order_by('date', 'desc');

        if ($this->dx_auth->is_logged_in() == TRUE)
            $this->db->where('user_id', $this->dx_auth->get_user_id());
        else
            $this->db->where('user_ip', $this->input->ip_address());

        $query = $this->db->get('comments', 1);

        if ($query->num_rows() == 1) {
            $query = $query->row_array();


            $latest_comment = $query['date'];
            $allow_time = $latest_comment + ($this->period * 60);
//            var_dumps(time());
//            var_dumps($allow_time);
//var_dumps_exit($query);
            if ($allow_time > time())
                return FALSE;
            else
                return TRUE;
        } else
            return TRUE;
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

    public function getTotalCommentsForProducts($ids, $module = 'shop', $status = 0) {
        if ($ids == null)
            return;

        $this->db->select('item_id, COUNT(comments.id) AS `count`');
        $this->db->group_by('item_id');
        $this->db->where_in('item_id', $ids);
        $this->db->where('status', $status);
        $this->db->where('module = ', $module);
        $query = $this->db->get('comments')->result_array();

        $result = array();

        foreach ($query as $q)
            $result[$q['item_id']] = $q['count'] . ' ' . $this->Pluralize((int) $q['count'], array(lang("review", 'comments'), lang("reviews", 'comments'), lang("review", 'comments')));

        foreach ((array) $ids as $id)
            if (!$result[$id])
                $result[$id] = 0 . ' ' . $this->Pluralize('0', array(lang("review", 'comments'), lang("reviews", 'comments'), lang("comments", 'comments')));

        return $result;
    }

    public static function Pluralize($count = 0, array $words = array()) {
        if (empty($words))
            $words = array(' ', ' ', ' ');

        $numeric = (int) abs($count);
        if ($numeric % 100 == 1 || ($numeric % 100 > 20) && ( $numeric % 10 == 1 ))
            return $words[0];
        if ($numeric % 100 == 2 || ($numeric % 100 > 20) && ( $numeric % 10 == 2 ))
            return $words[1];
        if ($numeric % 100 == 3 || ($numeric % 100 > 20) && ( $numeric % 10 == 3 ))
            return $words[1];
        if ($numeric % 100 == 4 || ($numeric % 100 > 20) && ( $numeric % 10 == 4 ))
            return $words[1];
        return $words[2];
    }

    /**
     * Get count answers to comment by id
     * @param int $commentId
     * @return boolean|int
     */
    public function getCountCommentAnswersByCommentId($commentId) {
        $query = $this->db->where('parent', $commentId)->get('comments')->result_array();
        if ($query)
            return count($query);
        else
            return false;
    }

}

<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Api extends Comments {

    public $tpl_name = 'comments_api';

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
//        var_dump($_POST);
        $comments = array();
        ($hook = get_hook('comments_on_build_comments')) ? eval($hook) : NULL;

        $this->load->model('base');
        $this->init_settings();

//        if (($comments = $this->cache->fetch('comments_' . $item_id . $this->module, 'comments')) !== FALSE) {
//            ($hook = get_hook('comments_fetch_cache_ok')) ? eval($hook) : NULL;
//            // Comments fetched from cahce file
//        } else {
        $this->db->where('module', 'shop');
        $comments = $this->base->get($this->input->post(item_id));

        // Read comments template
        // Set page id for comments form
        if ($comments != FALSE) {
            ($hook = get_hook('comments_store_cache')) ? eval($hook) : NULL;
            $this->cache->store('comments_' . $this->input->post(item_id) . $this->module, $comments, $this->cache_ttl, 'comments');
        }
        //}

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

        if ($comments != null) {
            $comments_count = count($comments);
        } else {
            $comments_count = 0;
        }

        $data = array(
            'comments_arr' => $comments,
            'comment_ch' => $comment_ch,
            'comment_controller' => $this->comment_controller,
            'total_comments' => lang('lang_total_comments') . count($comments),
            'can_comment' => $this->can_comment,
            'use_captcha' => $this->use_captcha,
            'item_id' => $this->input->post(item_id)
        );

        if ($this->use_captcha == TRUE) {
            $this->dx_auth->captcha();
            $data['cap_image'] = $this->dx_auth->get_captcha_image();
        }

        ($hook = get_hook('comments_read_com_tpl')) ? eval($hook) : NULL;

        $comments = $this->template->read($this->tpl_name, $data);

        ($hook = get_hook('comments_assign_tpl_data')) ? eval($hook) : NULL;
        //$this->render('comments_list', array('comments'=>$comments));

        echo json_encode(array('comments' => $comments));
    }

    /**
     * Determinate commented page.
     * 
     * if product - return id
     */
    public function parsUrl($url) {
        if (strstr($url, 'product')) {
            $url = parse_url($url);
            $search = array('shop', 'product', '/');
            $replace = array('', '', '');
            $url = str_replace($search, $replace, $url['path']);
            $id = $this->db->select('id')->where('url', $url)->get('shop_products')->row();
            return $id->id;
        }
    }

    public function newPost() {
        $this->load->library('user_agent');

        if ($this->input->post('action') == 'newPost') {
            $email = $this->db->select('email')->get_where('users', array('username' => $this->dx_auth->get_username()), 1)->row();

            if ($this->dx_auth->is_logged_in())
                $comment_data = array(
                    'module' => 'shop',//$this->module,
                    'user_id' => $this->dx_auth->get_user_id(), // 0 if unregistered
                    'user_name' => $this->dx_auth->get_username(),
                    'user_mail' => $email->email,
                    'user_site' => htmlspecialchars($this->input->post(comment_site)),
                    'text' => $this->input->post('comment_text'),
                    'text_plus' => $this->input->post('comment_text_plus'),
                    'text_minus' => $this->input->post('comment_text_minus'),
                    'item_id' => $this->parsUrl($_SERVER['HTTP_REFERER']),
                    'status' => $this->_comment_status(),
                    'agent' => $this->agent->agent_string(),
                    'user_ip' => $this->input->ip_address(),
                    'date' => time(),
                    'rate' => $this->input->post('ratec'),
                    'parent' => $this->input->post('parent')
                );
//            else 

            $this->db->insert('comments', $comment_data);
            //return JSON
            echo json_encode(array('answer' => 'sucesfull'));

//            echo 'debugAPI';
        }
        else
            parent::test();
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

}


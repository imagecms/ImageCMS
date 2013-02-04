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
//        var_dump($_SERVER['HTTP_REFERER']);
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

    public function newPost() {
        if ($this->input->post('action') == 'newPost') {

            $email = $this->db->select('email')->get_where('users', array('username' => $this->dx_auth->get_username()), 1)->row();

            if ($this->dx_auth->is_logged_in())
                $comment_data = array(
                    'module' => $this->module,
                    'user_id' => $this->dx_auth->get_user_id(), // 0 if unregistered
                    'user_name' => $this->dx_auth->get_username(),
                    'user_mail' => $email->email,
                    'user_site' => htmlspecialchars($this->input->post(comment_site)),
                    'text' => $this->input->post('comment'),
                    'text_plus' => '$comment_text_plus',
                    'text_minus' => '$comment_text_minus',
                    'item_id' => '$item_id',
                    'status' => '$this->_comment_status()',
                    'agent' => '$this->agent->agent_string()',
                    'user_ip' => '$this->input->ip_address()',
                    'date' => time(),
                    'rate' => '$rate',
                    'parent' => '$parent'
                );
//            else 


            $this->db->insert('comments_api', $comment_data);
            //return JSON
            echo json_encode(array('answer' => 'sucesfull'));

//            echo 'debugAPI';
        }
        else
            parent::test();
    }

}


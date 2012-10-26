<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Comments admin
 */
class Admin extends MY_Controller {

    private $per_page = 12;

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        cp_check_perm('module_admin');

        $this->load->model('base', 'comments');
    }

    // Display comments list
    public function index() {
        $segs = $this->uri->uri_to_assoc(6);

        $status = $segs['status'];
        $off_set = $segs['page'];

        switch ($status) {
            case 'all':
                $this->db->where('status', '0');
                $this->db->or_where('status', '1');
                $status_all = 'all';
                break;

            case 'waiting':
                $this->db->where('status', 1);
                $status_all = '1';
                break;

            case 'approved':
                $this->db->where('status', 0);
                $status_all = '0';
                break;

            case 'spam':
                $this->db->where('status', 2);
                $status_all = '2';
                break;

            default:
                $this->db->where('status', '0');
                $this->db->or_where('status', '1');
                $status_all = 'all';
                $status = 'all';
                break;
        }

        $comments = $this->comments->all($this->per_page, $off_set);

        if ($comments == FALSE AND $off_set > $this->per_page - 1) {
            redirect('admin/components/cp/comments/index/status/' . $segs['status']);
        }

        if ($comments != FALSE) {
            $cnt = count($comments);
            for ($i = 0; $i < $cnt; $i++) {
                if ($comments[$i]['module'] == 'core') {
                    $this->db->select('id, title, url, cat_url');
                    $this->db->where('id', $comments[$i]['item_id']);
                    $query = $this->db->get('content')->row_array();

                    $comments[$i]['page_title'] = $query['title'];
                    $comments[$i]['page_url'] = site_url($query['cat_url'] . $query['url']);
                }
            }

            if ($status_all == 'all') {
                $this->db->where('status', '0');
                $this->db->or_where('status', '1');
            } else {
                $this->db->where('status', $status_all);
            }

            $this->db->from('comments');
            $total = $this->db->count_all_results();

            if ($total > $this->per_page) {
                $this->load->library('Pagination');

                $config['base_url'] = site_url('admin/components/cp/comments/index/status/' . $status . '/page/');
                $config['total_rows'] = $total;
                $config['per_page'] = $this->per_page;
                $config['uri_segment'] = $this->uri->total_segments();
                
                $config['separate_controls'] = true;
                $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
                $config['full_tag_close'] = '</ul></div>';
                $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
                $config['controls_tag_close'] = '</ul></div>';
                $config['next_link'] = 'Next&nbsp;&gt;';
                $config['prev_link'] = '&lt;&nbsp;Prev';
                $config['cur_tag_open'] = '<li class="btn-primary active"><span>';
                $config['cur_tag_close'] = '</span></li>';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['num_tag_close'] = '</li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                
                $this->pagination->num_links = 5;
                $this->pagination->initialize($config);
                $this->template->assign('paginator', $this->pagination->create_links_ajax());
            }
            // End pagination
        }

        $this->load->helper('string');
            
        if(is_array($comments))
            $comments = $this->proccess_child_comments($comments);
        
        $all_comments = count($this->db->get('comments')->result_array());
        
        $this->render('comments_list', array(
            'comments_cur_url' => site_url(trim_slashes($this->uri->uri_string())),
            'comments' => $comments,
            'status' => $status,
            'total_waiting' => $this->comments->count_by_status(1),
            'total_spam' => $this->comments->count_by_status(2),
            'total_app' => $this->comments->count_by_status(0),
            'all_comm' => $all_comments,
        ));
    }
    
     public function proccess_child_comments($comments = array()) {
        $i = 0;
        foreach ($comments as $comment) {
            if ($comment['parent'] != 0) {
                //$comments[$comment['parent']]['child'][] = $comment;
                $children[$comment['parent']][] = $comment;
                unset($comments[$i]);
            }
            $i++;
        }
        $i = 0;
        if (count($children) > 0) {
            foreach ($comments as $ck => $cv) {
                foreach ($children as $k => $v) {
                    if ($cv['id'] == $k) {
                        $comments[$ck]['child'] = $v;
                    }
                }
            }
        }
        return $comments;
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->show('file:' . 'application/modules/comments/templates/' . $viewName);
        exit;

        if ($return === false)
            $this->template->show('file:' . 'application/modules/comments/templates/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/modules/comments/templates/' . $viewName);
    }

    // Edit comment
    public function edit($id, $update_list = 1) {
        $this->template->assign('comment', $this->comments->get_one($id));
        $this->template->assign('update_list', $update_list);
        $this->display_tpl('edit');
    }

    // Update comment
    public function update() {
        $data = array(
            'text' => $this->input->post('text'),
            'text_plus' => $this->input->post('text_plus'),
            'text_minus' => $this->input->post('text_minus'),
            'user_name' => htmlspecialchars($this->input->post('user_name')),
            'user_mail' => htmlspecialchars($this->input->post('user_mail')),
            'status' => (int) $this->input->post('status'),
        );
        
        $this->comments->update($this->input->post('id'), $data);

        $comment = $this->comments->get_one($this->input->post('id'));

        $this->drop_cache($this->input->post('id'), $comment['module']);

        $this->_recount_comments($comment['item_id'], $comment['module']);

//        $resp = "<script type='text/javascript'> showMessage('Измения сохранены','Успех<br/><strong>Запросов к базе: 6</strong>',''); </script>";
//
//        echo json_encode(array('response'=> $resp, 'result'=> 'success'));
        showMessage('Успех', 'Измениния сохранены');
        $this->load->helper('url');
        $url = '/'.str_replace(base_url(), '',$_SERVER['HTTP_REFERER']);
        pjax($url);
    }

    public function update_status() {
        $this->db->where_in('id', $this->input->post('id'));
        $this->db->update('comments', array('status' => $this->input->post('status')));
        
        //for children comments
        $this->db->where_in('parent', $this->input->post('id'));
        $this->db->update('comments', array('status' => $this->input->post('status')));
        /*
        $comment = $this->comments->get_one($this->input->post('id'));

        $this->drop_cache($this->input->post('id'), $comment['module']);

        $this->_recount_comments($comment['item_id'], $comment['module']);
        */
        showMessage("Успех", "Статус обновлен");
        $this->load->helper('url');
        $url = '/'.str_replace(base_url(), '',$_SERVER['HTTP_REFERER']);
        pjax($url);
    }

    // Delete comment
    public function delete() {
        $id = $this->input->post('id');
        if(is_array($id)){
            foreach($id as $item)
                $this->drop_cache($item);
            $comment = $this->comments->get_many($id);
        }else{
            $this->drop_cache($id);
            $comment = $this->comments->get_one($id);
        }
        

        $this->comments->delete($id);

        $this->_recount_comments($comment['item_id'], $comment['module']);
        
        showMessage('Комментарий(и) успешно удален(ы)');
        $this->load->helper('url');
        $url = '/'.str_replace(base_url(), '',$_SERVER['HTTP_REFERER']);
        pjax($url);
    }

    public function delete_many() {
        $array = $this->input->post('comments');

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                $id = substr($v, 5);

                // Recount total page comments.
                $comment = $this->comments->get_one($id);
                $this->comments->delete($id);

                $this->_recount_comments($comment['item_id'], $comment['module']);
            }
        }

        // Delete all cached comments
        $this->cache->delete_group('comments');
    }

    /**
     * Delete cached comments
     */
    private function drop_cache($comment_id) {
        $this->db->select('id, item_id, module');
        $comment = $this->comments->get_one($comment_id);
        $this->cache->delete('comments_' . $comment['item_id'] . $comment['module'], 'comments');
    }

    /**
     * Show module settings
     */
    public function show_settings() {
        $settings = $this->comments->get_settings();

//        $this->template->add_array(array(
//            'settings' => $settings
//        ));
        $this->render('settings', array('settings'=>$settings));
        //$this->display_tpl('settings');
    }

    public function update_settings() {
        $data = array(
            'max_comment_length' => (int) $this->input->post('max_comment_length'),
            'period' => (int) $this->input->post('period'),
            'can_comment' => (int) $this->input->post('can_comment'),
            'use_captcha' => (bool) $this->input->post('use_captcha'),
            'use_moderation' => (bool) $this->input->post('use_moderation'),
        );

        $this->comments->save_settings($data);

        showMessage('Изменения сохранены');
        pjax('/admin/components/cp/comments');
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

    // Template functions
    private function display_tpl($file) {
        $file = realpath(dirname(__FILE__)) . '/templates/' . $file;
        $this->template->show('file:' . $file);
    }

    private function fetch_tpl($file) {
        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file admin.php */

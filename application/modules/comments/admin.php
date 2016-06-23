<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 * Comments admin
 * @property Base comments
 */
class Admin extends BaseAdminController
{

    private $per_page = 12;

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        //        cp_check_perm('module_admin');

        $this->load->model('base', 'comments');

        $obj = new MY_Lang();
        $obj->load('comments');
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
                $this->db->or_where('status', '2');
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

        //        $comments = $this->comments->all($this->per_page, $off_set);
        $comments = $this->comments->all(0, 0, $status_all);

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

            if (is_array($comments)) {
                $children = $this->proccess_child_comments($comments);
            }

            foreach ($comments as $key => $comment) {
                if ($comment['parent'] != 0 && $status_all != 1 && $status_all != 2 && $status == 'all') {
                    unset($comments[$key]);
                }
            }

            $total = count($comments);

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
                $config['next_link'] = lang('Next', 'admin') . '&nbsp;&gt;';
                $config['prev_link'] = '&lt;&nbsp;' . lang('Prev', 'admin');
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

        if ($comments) {
            $comments = array_splice($comments, (int) $off_set, (int) $this->per_page);
        } else {
            $comments = [];
        }

            //        $all_comments = count($this->db->get('comments')->result_array());
            \CMSFactory\assetManager::create()
            ->setData(
                [
                 'comments_cur_url' => site_url(trim_slashes($this->uri->uri_string())),
                 'comments'         => $comments,
                 'status'           => $status,
                 'children'         => $children,
                 'total_waiting'    => $this->comments->count_by_status(1),
                 'total_spam'       => $this->comments->count_by_status(2),
                 'total_app'        => $this->comments->count_by_status(0),
                 'all_comm_show'    => $total,
                ]
            )
            ->registerScript('admin')
            ->renderAdmin('comments_list');
    }

    public function proccess_child_comments($comments = []) {
        $children = [];
        $i = 0;
        foreach ($comments as $comment) {
            if ($comment['parent'] != 0) {
                $children[$comment['parent']][] = $comment;
                unset($comments[$i]);
            }
            $i++;
        }

        return $children;
    }

    public function render($viewName, array $data = []) {
        if (!empty($data)) {
            $this->template->add_array($data);
        }
        $modContDirName = getModContDirName('comments');
        $this->template->show('file:' . "application/{$modContDirName}comments/templates/$viewName");
    }

    // Edit comment

    public function edit($id, $update_list = 1) {
        $this->template->assign('comment', $this->comments->get_one($id));
        $this->template->assign('update_list', $update_list);
        $this->display_tpl('edit');
    }

    // Update comment

    public function update() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_name', lang('Author', 'admin'), 'required|trim|min_length[2]|alpha_dash');
        $this->form_validation->set_rules('user_mail', lang('Email', 'admin'), 'required|trim|valid_email');
        $this->form_validation->set_rules('text', lang('Contents', 'comments'), 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            showMessage(validation_errors(), '', 'r');
            return;
        }

        $data = [
                 'text'      => $this->input->post('text'),
                 'user_name' => htmlspecialchars($this->input->post('user_name')),
                 'user_mail' => htmlspecialchars($this->input->post('user_mail')),
                 'status'    => (int) $this->input->post('status'),
                ];

        $this->comments->update($this->input->post('id'), $data);

        $comment = $this->comments->get_one($this->input->post('id'));

        $this->drop_cache($this->input->post('id'), $comment['module']);

        $this->load->module('comments')->_recount_comments($comment['item_id'], $comment['module']);

        $this->lib_admin->log(lang('Comment successfully updated', 'comments'));
        showMessage(lang('Comment successfully updated', 'comments'), lang('Message', 'comments'));

        if ($this->input->post('action') == 'exit') {
            pjax('/admin/components/cp/comments');
        }
    }

    public function update_status() {
        $this->db->where_in('id', $this->input->post('id'));
        $this->db->update('comments', ['status' => $this->input->post('status')]);

        //        for children comments
        $this->db->where_in('parent', $this->input->post('id'));
        $this->db->update('comments', ['status' => $this->input->post('status')]);
        /*
          $comment = $this->comments->get_one($this->input->post('id'));

          $this->drop_cache($this->input->post('id'), $comment['module']);

          $this->_recount_comments($comment['item_id'], $comment['module']);
         */

        $ids = is_array($this->input->post('id')) ? implode(', ', $this->input->post('id')) : $this->input->post('id');
        $this->lib_admin->log(lang('Comments status was updated', 'comments') . '. Ids: ' . $ids);
        showMessage(lang('Status updated', 'comments'), lang('Message', 'comments'));
        $this->load->helper('url');
        $url = '/' . str_replace(base_url(), '', $this->input->server('HTTP_REFERER'));
        pjax($url);
    }

    // Delete comment

    public function delete() {
        $id = $this->input->post('id');
        if (is_array($id)) {
            foreach ($id as $item) {
                $this->drop_cache($item);
            }
            $comment = $this->comments->get_many($id);
        } else {
            $this->drop_cache($id);
            $comment = $this->comments->get_one($id);
        }

            $this->comments->delete($id);

            $this->load->module('comments')->_recount_comments($comment['item_id'], $comment['module']);

            $id = is_array($id) ? implode(', ', $id) : $id;
            $this->lib_admin->log(lang('Comment(s) deleted', 'comments') . '. Ids: ' . $id);
            showMessage(lang('Comment(s) deleted', 'comments'));

            $this->load->helper('url');
            $url = '/' . str_replace(base_url(), '', $this->input->server('HTTP_REFERER'));
            pjax($url);
    }

    public function delete_many() {
        $comments = $this->input->post('comments');

        if (count($comments) > 0) {
            foreach ($comments as $v) {
                $id = substr($v, 5);

                // Recount total page comments.
                $comment = $this->comments->get_one($id);
                $this->comments->delete($id);

                $this->load->module('comments')->_recount_comments($comment['item_id'], $comment['module']);
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

        \CMSFactory\assetManager::create()
            ->setData('settings', $settings)
            ->renderAdmin('settings');
    }

    public function update_settings() {
        $data = [
                 'max_comment_length' => (int) $this->input->post('max_comment_length'),
                 'period'             => (int) $this->input->post('period'),
                 'can_comment'        => (int) $this->input->post('can_comment'),
                 'use_captcha'        => (bool) $this->input->post('use_captcha'),
                 'use_moderation'     => (bool) $this->input->post('use_moderation'),
                 'order_by'           => $this->input->post('order_by'),
                ];

        $this->comments->save_settings($data);
        $this->lib_admin->log(lang('Comments settings was edited', 'comments'));
        showMessage(lang('Changes saved', 'comments'));

        if ($this->input->post('action') == 'toedit') {
            pjax('/admin/components/cp/comments/show_settings');
        } else {
            pjax('/admin/components/cp/comments');
        }

    }

    // Template functions

    private function display_tpl($file) {
        $file = realpath(__DIR__) . '/templates/' . $file;
        $this->template->show('file:' . $file);
    }

}

/* End of file admin.php */
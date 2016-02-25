<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property Filter filter
 * @property Lib_category lib_category
 * @property Lib_admin lib_admin
 * @property Search search
 */
class Admin_search extends BaseAdminController
{

    public $items_per_page = '20'; // items per page for advanced search.

    public function __construct() {

        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();

        $_POST['search_text'] = urldecode($this->input->post('search_text'));
    }

    public function index($hash = '', $offset = 0) {

        $this->load->module('search');
        $this->load->helper('category');

        /** Check is first page (Temp) * */
        if ($offset == 'offset') {
            $offset = 0;
        }

        $data = trim($this->input->get('q'));
        $data = strip_tags($data);
        $data = htmlspecialchars($data, ENT_QUOTES);

        $searchText = $this->security->xss_clean($data);

        if (mb_strlen($searchText, 'UTF-8') >= 2) {
            $config = [
                'table' => 'content',
                'order_by' => ['publish_date' => 'DESC'],
                'hash_prefix' => 'admin',
                'search_title' => $searchText,
            ];

            $this->search->init($config);

            $where = [
                [
                    'publish_date <=' => 'UNIX_TIMESTAMP()',
                    'backticks' => false,
                ],
                [
                    'id =' => (int) $searchText,
                    'backticks' => 'both',
                ],
                [
                    'prev_text' => $searchText,
                    'operator' => 'LIKE',
                    'backticks' => 'both',
                ],
                [
                    'full_text' => $searchText,
                    'operator' => 'OR_LIKE',
                    'backticks' => 'both',
                ],
                [
                    'title' => $searchText,
                    'operator' => 'OR_LIKE',
                    'backticks' => 'both',
                ],
            ];

            if ($hash == '') {
                $result = $this->search->execute($where, $offset);
            } else {
                $result = $this->search->query($hash, $offset);
            }

            //Pagination
            if ($result['total_rows'] > $this->search->row_count) {
                $this->load->library('Pagination');

                $config['base_url'] = site_url('admin/admin_search/index/' . $result['hash'] . '/');
                $config['total_rows'] = $result['total_rows'];
                $config['per_page'] = $this->search->row_count;
                $config['suffix'] = '?' . http_build_query($this->input->get(), '', '&');
                $config['uri_segment'] = 5;

                $config['first_link'] = lang('First link', 'admin');
                $config['last_link'] = lang('Last link', 'admin');

                $config['cur_tag_open'] = '<li class="btn-primary active"><span>';
                $config['cur_tag_close'] = '</span></li>';

                $this->pagination->num_links = 5;
                $this->pagination->initialize($config);
                $this->template->assign('pagination', $this->pagination->create_links_ajax());
            }
            //End pagination

            if ($result['total_rows'] > 0) {
                $this->template->assign('pages', $result['query']->result_array());
                $cats = [];
                foreach ($this->db->get('category')->result_array() as $row) {
                    $cats[$row['id']] = $row['name'];
                }
                $this->template->assign('categories', $cats);
            }

            $usersResult = $this->db->where('id =', $searchText)
                ->or_where("username LIKE '%$searchText%'")
                ->or_where("email LIKE '%$searchText%'")
                ->get('users')
                ->result_array();

            if (count($usersResult) > 0) {
                $this->template->assign('users', $usersResult);
            }
        }

        if ($result['search_title'] == null) {
            $result['search_title'] = $searchText;
        }

        $this->template->assign('search_title', $result['search_title']);

        $this->template->show('search', false);
    }

    public function advanced_search() {

        $this->template->add_array(
            [
                    'categories' => $this->lib_category->build(),
                ]
        );

        $this->template->show('advanced_search', false);
    }

    public function do_advanced_search() {

        $this->load->library('pagination');
        $this->load->module('filter');
        $this->load->module('forms');

        $segments = array_slice($this->uri->segment_array(), 3);

        $search_data = $this->filter->parse_url($segments);

        $search_data['search_text'] = urldecode($search_data['search_text']);

        if ($search_data['use_cfcm_group'] == 0) {
            unset($search_data['use_cfcm_group']);
        }

        if (!$search_data) {
            $search_data = [];
        }

        ob_start();
        $this->form_from_group($search_data['use_cfcm_group'], $search_data);
        $group_html = ob_get_contents();
        ob_end_clean();

        $this->template->add_array(
            [
                    'advanced_search' => true,
                    'filter_data' => $search_data,
                    'cfcm_group_html' => $group_html,
                ]
        );

        $ids = $this->filter->search_items($search_data);

        if (!$ids and isset($search_data['use_cfcm_group'])) {
            $this->template->show('search', false);
            exit;
        }

        $query = $this->_filter_pages($ids, $search_data);

        if ($query->num_rows() == 0) {
            $this->template->show('search', false);
            exit;
        }

        $config = [];
        $config['base_url'] = site_url('admin/admin_search/do_advanced_search/' . http_build_query($search_data, '', '/'));
        $config['total_rows'] = $this->_filter_pages($ids, $search_data, true);
        $config['per_page'] = $this->items_per_page;
        $config['uri_segment'] = $this->uri->total_segments();
        $config['first_link'] = lang('First link', 'admin');
        $config['last_link'] = lang('Last link', 'admin');

        $config['cur_tag_open'] = '<span class="active">';
        $config['cur_tag_close'] = '</span>';

        $this->pagination->num_links = 5;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links_ajax();

        $this->template->add_array(
            [
                    'pages' => $query->result_array(),
                    'pagination' => $pagination,
                    'advanced_search' => true,
                    'filter_data' => $search_data,
                    'cfcm_group_html' => $group_html,
                ]
        );

        $this->template->show('search', false);
    }

    public function validate_advanced_search() {

        $this->load->module('filter');
        $this->load->module('forms');

        $form = $this->filter->create_filter_form($this->input->post('use_cfcm_group'));

        if ($form) {
            if ($form->isValid()) {
                $data = $form->getData();
                $data['category'] = $this->input->post('category');
                $data['search_text'] = $this->input->post('search_text');
                $data['use_cfcm_group'] = $this->input->post('use_cfcm_group');

                $url = http_build_query($data, '', '/');
                updateDiv('page', site_url('admin/admin_search/do_advanced_search/' . $url));
            } else {
                showMessage($form->_validation_errors(), false, 'r');
            }
        } else {
            $data = $this->input->post();
            $url = http_build_query($data, '', '/');
            updateDiv('page', site_url('admin/admin_search/do_advanced_search/' . $url));
        }
    }

    public function form_from_group($group_id, $attributes = false) {

        $this->load->module('filter');
        $this->load->module('forms');
        $this->load->module('cfcm/admin')->_set_forms_config();
        $form = $this->filter->create_filter_form($group_id);

        // overfilling form on search
        if ($attributes and $form) {
            $form->setAttributes($attributes);
        }

        $result = '';

        if ($form) {
            foreach ($form->asArray() as $field) {
                $result .= '<div class="form_text">' . $field['label'] . '</div>';
                $result .= '<div class="form_input">' . $field['field'] . '</div>';
                $result .= '<div class="form_overflow"></div>';
            }
        }

        echo $result;
        echo '<input type="hidden" value="' . $group_id . '" name="use_cfcm_group" />';
    }

    /**
     * @param int $ids
     * @param array $search_data
     * @param bool $count
     * @return object|string
     */
    public function _filter_pages($ids, $search_data, $count = false) {

        $where = [
            'lang_alias' => '0',
        ];

        $this->db->where($where);

        if (count((array) $ids) > 0 and is_array($ids)) {
            $this->db->where_in('id', $ids);
        }

        if (isset($search_data['search_text'])) {
            $s_text = $search_data['search_text'];
            $this->db->where('(title LIKE "%' . $this->db->escape_str($s_text) . '%" OR prev_text LIKE "%' . $this->db->escape_str($s_text) . '%" OR full_text LIKE "%' . $this->db->escape_str($s_text) . '%" )', null, false);
        }

        if (isset($search_data['category']) and $search_data['category'] != '') {
            $this->db->where_in('category', $search_data['category']);
        }

        if ($count == false) {
            $this->db->select('*');
            $this->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url', false);
            return $this->db->get('content', $this->items_per_page, (int) $this->uri->segment($this->uri->total_segments()));
        } else {
            $this->db->from('content');
            return $this->db->count_all_results();
        }
    }

    public function autocomplete() {

        if ($this->ajaxRequest) {
            $tokens = [];
            $pages = $this->db->select('title')
                ->get('content')
                ->result_array();
            foreach ($pages as $p) {
                $tokens[] = $p['title'];
            }

            $users = $this->db->select('username, email')
                ->get('users')
                ->result_array();

            foreach ($users as $u) {
                $tokens[] = $u['username'];
                $tokens[] = $u['email'];
            }

            echo json_encode(array_values(array_unique($tokens)));
        } else {
            redirect('/admin');
        }
    }

}

/* End of search.php */
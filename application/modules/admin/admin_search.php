<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_search extends MY_Controller {

    public $items_per_page = '20'; // items per page for advanced search.

	public function __construct()
	{
		parent::__construct();

		$this->load->library('DX_Auth');
        admin_or_redirect(); 

		$this->load->library('lib_admin');
		$this->lib_admin->init_settings();

        $_POST['search_text'] = urldecode($_POST['search_text']);

        cp_check_perm('cp_page_search');
	}

	public function index($hash = '', $offset = 0)
	{
        $this->load->module('search');
        $this->load->helper('category');

        if (mb_strlen(trim($this->input->post('search_text')), 'UTF-8') >= 3)
        {
            $config = array(
                'table'        => 'content',
                'order_by'     => array('publish_date' => 'DESC'),
                'hash_prefix'  => 'admin',
                'search_title' => $this->input->post('search_text'),
            );

            $this->search->init($config);        

            $where = array(
                    array(
                            'publish_date <=' => 'UNIX_TIMESTAMP()',
                            'backticks'       => FALSE,
                        ),
                    array(
                            'lang_alias ' => '0',
                        ),
                   array(
                            'prev_text' => trim($this->input->post('search_text')),
                            'operator'  => 'LIKE',
                            'backticks' => 'both',
                        ),
                    array(
                            'full_text' => trim($this->input->post('search_text')),
                            'operator'  => 'OR_LIKE',
                            'backticks' => 'both',
                        ),
                    array(
                            'title' => trim($this->input->post('search_text')),
                            'operator'  => 'OR_LIKE',
                            'backticks' => 'both',
                        ),
            );

            if ($hash == '')
            {
                $result = $this->search->execute($where, $offset);
            }
            else
            {
                $result = $this->search->query($hash, $offset);
            }

            //Pagination
            if ($result['total_rows'] > $this->search->row_count)
            {
                $this->load->library('Pagination');

                $config['base_url']    = site_url('admin/admin_search/index/'.$result['hash'].'/');
                $config['total_rows']  = $result['total_rows'];
                $config['per_page']    = $this->search->row_count;
                $config['uri_segment'] = 5;
                $config['first_link']  = lang('first_link');
                $config['last_link']   = lang('last_link');

                $config['cur_tag_open']  = '<span class="active">';
                $config['cur_tag_close'] = '</span>';

                $this->pagination->num_links = 5;
                $this->pagination->initialize($config);
                $this->template->assign('pagination', $this->pagination->create_links_ajax());
            }
            //End pagination 

            if ($result['total_rows'] > 0)
            {
                $this->template->assign('pages', $result['query']->result_array());
            }
        }

        if ($result['search_title'] == NULL) 
        {
            $result['search_title'] = $this->input->post('search_text');
        }

        $this->template->assign('search_title', $result['search_title']);

		$this->template->show('search', FALSE);
	}

    public function advanced_search()
    {
        $this->template->add_array(array(
            'categories' => $this->lib_category->build(), 
        ));

        $this->template->show('advanced_search', FALSE);
    }

    public function do_advanced_search()
    {
        $this->load->module('filter');
        $this->load->module('forms');

        $segments = array_slice($this->uri->segment_array(), 3);

        $search_data = $this->filter->parse_url($segments);

        $search_data['search_text'] = urldecode($search_data['search_text']);

        if ($search_data['use_cfcm_group'] == 0)
            unset($search_data['use_cfcm_group']);

        if (!$search_data)
            $search_data = array();

        ob_start();
        $this->form_from_group($search_data['use_cfcm_group'], $search_data); 
        $group_html = ob_get_contents();
        ob_end_clean(); 

        $this->template->add_array(array(
            'advanced_search' => TRUE,
            'filter_data'     => $search_data,
            'cfcm_group_html' => $group_html,
        )); 

        $ids = $this->filter->search_items($search_data);

        if (!$ids AND isset($search_data['use_cfcm_group']))
        { 
            $this->template->show('search', FALSE); 
            exit;
        } 

        $query = $this->_filter_pages($ids, $search_data);

        if ($query->num_rows() == 0)
        {
            $this->template->show('search', FALSE); 
            exit;
        } 

        $this->load->library('Pagination');

        $config['base_url']    = site_url('admin/admin_search/do_advanced_search/'.http_build_query($search_data,'','/'));
        $config['total_rows']  = $this->_filter_pages($ids, $search_data, TRUE);
        $config['per_page']    = $this->items_per_page;
        $config['uri_segment'] = $this->uri->total_segments();
        $config['first_link']  = lang('first_link');
        $config['last_link']   = lang('last_link');

        $config['cur_tag_open']  = '<span class="active">';
        $config['cur_tag_close'] = '</span>';

        $this->pagination->num_links = 5;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links_ajax();

        $this->template->add_array(array(
            'pages'           => $query->result_array(),
            'pagination'      => $pagination,
            'advanced_search' => TRUE,
            'filter_data'     => $search_data,
            'cfcm_group_html' => $group_html,
        ));

        $this->template->show('search', FALSE);
    }

    public function validate_advanced_search()
    {
        $this->load->module('filter');
        $this->load->module('forms');
        
        $form = $this->filter->create_filter_form($_POST['use_cfcm_group']);

        if ($form)
        {
            if ($form->isValid())
            {
                $data = $form->getData();
                $data['category']       = $_POST['category'];
                $data['search_text']    = $_POST['search_text'];
                $data['use_cfcm_group'] = $_POST['use_cfcm_group'];
                
                $url = http_build_query($data, '', '/');
                updateDiv('page', site_url('admin/admin_search/do_advanced_search/'.$url));
            }
            else
            {
                showMessage($form->_validation_errors());
            }
        }
        else
        {
            $data = $_POST;
            $url = http_build_query($data, '', '/');
            updateDiv('page', site_url('admin/admin_search/do_advanced_search/'.$url));  
        }
    }

    public function form_from_group($group_id, $attributes = FALSE)
    {
        $this->load->module('filter');
        $this->load->module('forms');
        $this->load->module('cfcm/admin')->_set_forms_config(); 
        $form = $this->filter->create_filter_form($group_id);

        // Перезаполним форму при поиске
        if ($attributes AND $form)
            $form->setAttributes($attributes);

        $result = '';

        if ($form)
            foreach ($form->asArray() as $field)
            {   
                $result .= '<div class="form_text">'.$field['label'].'</div>';
                $result .= '<div class="form_input">'.$field['field'].'</div>';
                $result .= '<div class="form_overflow"></div>';
            }

        echo $result;
        echo '<input type="hidden" value="'.$group_id.'" name="use_cfcm_group" />';
    }

    public function _filter_pages($ids, $search_data, $count = FALSE)
    {
        $where = array(
            'lang_alias' => '0', 
        );

        $this->db->where($where);

        if (count((array)$ids) > 0 AND is_array($ids))
            $this->db->where_in('id', $ids);

        if (isset($search_data['search_text']))
        {
            $s_text = $search_data['search_text'];
            $this->db->where('(title LIKE "%'.$this->db->escape_str($s_text).'%" OR prev_text LIKE "%'.$this->db->escape_str($s_text).'%" OR full_text LIKE "%'.$this->db->escape_str($s_text).'%" )', NULL, FALSE);
        }

        if (isset($search_data['category']) AND $search_data['category'] != '')
            $this->db->where_in('category', $search_data['category']);

        if ($count == FALSE)
        {
            $this->db->select('*');
            $this->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url', FALSE);
            return $this->db->get('content', $this->items_per_page, (int) $this->uri->segment($this->uri->total_segments()) );
        }
        else
        {
            $this->db->from('content');
            return $this->db->count_all_results(); 
        }
    }

}

/* End of search.php */

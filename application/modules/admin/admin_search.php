<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_search extends Controller {

	public function __construct()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
        admin_or_redirect(); 

		$this->load->library('lib_admin');
		$this->lib_admin->init_settings();

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


}

/* End of search.php */

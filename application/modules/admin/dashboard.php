<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Controller{


	public function __construct()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		if( $this->dx_auth->is_admin() == FALSE)
		{
			redirect('admin/login','');
		}

		$this->load->library('lib_admin');
		$this->lib_admin->init_settings();
	}

	public function index()
	{
        // get latest pages
        $this->db->limit(5);
        $this->db->order_by('created', 'DESC');
        $this->db->where('lang_alias', 0);
        $latest = $this->db->get('content')->result_array();

        // get recenly updated pages
        $this->db->limit(5);
        $this->db->order_by('updated', 'DESC');
        $this->db->where('updated >', 0);
        $this->db->where('lang_alias', 0);
        $updated = $this->db->get('content')->result_array();

        // get comments
        $this->db->where('status', '0');
        $this->db->or_where('status', '1');
        $this->db->order_by('date', 'DESC');
        $this->db->limit(5);
        $comments = $this->db->get('comments')->result_array();

        // total pages
        $this->db->where('post_status', 'publish');
        $this->db->from('content');
        $total_pages = $this->db->count_all_results();

        // total categories
        $this->db->from('category');
        $total_cats = $this->db->count_all_results();

        // total comments
        $this->db->where('status', '0');
        $this->db->or_where('status', '1');
        $this->db->from('comments');
        $total_comments = $this->db->count_all_results();

        $this->template->add_array(array(
                    'latest'         => $latest,
                    'updated'        => $updated,
                    'comments'       => $comments,
                    'total_cats'     => $total_cats,
                    'total_pages'    => $total_pages,
                    'total_comments' => $total_comments,
                ));

        if (($api_news = $this->cache->fetch('api_news_cache')) !== FALSE)
        {
            $this->template->assign('api_news', $api_news);
        }
        else
        {
            $this->config->load('api');

            $api_news = @file_get_contents($this->config->item('imagecms_latest_news'));

            if (count(unserialize($api_news)) > 1)
            {
                $this->template->assign('api_news', unserialize($api_news));
                $this->cache->store('api_news_cache', unserialize($api_news)); 
            }
            else
            {
                $this->cache->store('api_news_cache', 'false'); 
            } 
        }

	    $this->template->show('dashboard', FALSE);
	}


}

/* End of dashboard.php */

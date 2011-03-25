<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * RSS Module
 */

class Rss extends MY_Controller {

    private $settings   = array();
    private $rss_header = '<?xml version="1.0" encoding="UTF-8"?>';
    private $cache_key  = 'rss';

	function __construct()
	{
		parent::__construct();
    }

	public function index()
	{
        if (($content = $this->cache->fetch($this->cache_key)) !== FALSE)
        {
            // rss feed fetched from cache
        }
        else
        {
            $this->load->library('lib_category');

            $this->settings = $this->_load_settings();        

            if ($this->settings['pages_count'] == 0)
            {
                $this->settings['pages_count'] = 10;
            }

            $pages = $this->get_pages();

            $cnt = count($pages);
            if ($cnt > 0)
            {
                for($i = 0; $i < $cnt; $i++)
                {
                    $pages[$i]['prev_text'] = htmlspecialchars_decode($pages[$i]['prev_text']);

                    if ($pages[$i]['category'] > 0)
                    {
                        $category = $this->lib_category->get_category($pages[$i]['category']);
                        $pages[$i]['title'] = $category['name'] .' / '. $pages[$i]['title'];
                        $pages[$i]['publish_date'] = gmdate('D, d M Y H:i:s', $pages[$i]['publish_date']).' GMT';
                    }
                }
            }

            $tpl_data = array(
                'header'      => $this->rss_header,
                'title'       => $this->settings['title'],
                'description' => $this->settings['description'],
                'pub_date'    => gmdate('D, d M Y H:i:s', time()).' GMT',
                'items'       => $pages,
                );

            $this->template->add_array($tpl_data);

            $content = $this->fetch_tpl('feed_theme');

            $this->cache->store($this->cache_key, $content, $this->settings['cache_ttl'] * 60);
        }

        echo $content;
    }

    /**
     * Load pages
     */
    private function get_pages()
    {
        $this->db->select('CONCAT_WS("", cat_url, url) as full_url, id, title, prev_text, publish_date, category, author', FALSE); 
        $this->db->where('post_status', 'publish');
        $this->db->where('prev_text !=', 'null');
        $this->db->where('publish_date <=', time());

        if ( count($this->settings['categories']) > 0)
        {
            $this->db->where_in('category', $this->settings['categories']);
        }

        $this->db->order_by('publish_date', 'desc');
        $query = $this->db->get('content', $this->settings['pages_count']);

        return $query->result_array();
    }

    /**
     * Load rss settings
     */
    public function _load_settings()
    {
        $this->db->where('name', 'rss');
        $query = $this->db->get('components', 1)->row_array();

        return unserialize($query['settings']);
    }


    public function _install()
    {
    	if( $this->dx_auth->is_admin() == FALSE) exit;

        // Enable module url access
        $this->db->where('name', 'rss');
        $this->db->update('components', array('enabled' => '1'));
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

/* End of file sample_module.php */

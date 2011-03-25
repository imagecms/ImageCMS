<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Sitemap Module
 */

class Sitemap extends MY_Controller {

    public $pages_priority     = '0.5'; // priority for pages
    public $cats_priority      = '0.9'; // priority for categories
    public $main_page_priority = '1'; // priority for main page
    public $pages_changefreq   = 'weekly'; 
    public $main_page_changefreq   = 'weekly';      
    public $changefreq   = 'weekly'; 
    public $gzip_level   = 9;
    public $result       = '';
    public $langs        = array();
    public $default_lang = array();
    public $sitemap_ttl  = 3600;
    public $sitemap_key  = 'sitemap_';
    public $items        = array(); 

	function __construct()
	{
		parent::__construct();
        $this->load->module('core');

        // Get langs
        $this->langs = $this->core->langs;
        $this->default_lang = $this->core->def_lang[0];
	}

    public function index()
    {
        $categories = $this->lib_category->build();
        //echo $this->sitemap_ul($categories);

        $this->template->assign('content', $this->sitemap_ul($categories));
        $this->template->show();
    }

    public function initialize($settings = array())
    {
        if (count($settings) > 0)
        {
            $this->main_page_priority   = $settings['main_page_priority'];
            $this->cats_priority        = $settings['cats_priority'];
            $this->pages_priority       = $settings['pages_priority'];
            $this->main_page_changefreq = $settings['main_page_changefreq'];
            $this->pages_changefreq     = $settings['pages_changefreq'];
        }
    }

    /** 
     * Display sitemap ul list
     */
    public function sitemap_ul($items = array())
    {
        $out .= '<ul id="sitemap">';

            foreach($items as $item)
            {
                if (isset($item['path_url']))
                {
                    $url = $item['path_url'];
                }
                elseif(isset($item['full_url']))
                {
                    $url = $item['full_url'];
                }

                $out .= '<li>'.anchor($url, $item['name']).'</li>';

                // Get category pages
                if (isset($item['path_url']))
                {
                    $pages = $this->_cateogry_pages($item['id']);

                    if ($pages->num_rows() > 0)
                    {
                        $out .= $this->sitemap_ul($pages->result_array());
                    }
                }

                if (count($item['subtree']) > 0)
                {
                    $out .= $this->sitemap_ul($item['subtree']);
                }
            }

        $out .= '</ul>';

        return $out;
    }

    /**
     * Create and display sitemap xml
     */
    public function build_xml_map()
    {
        $this->_create_map();
        echo $this->result;
    }

	public function _create_map()
    {
        if (($data = $this->cache->fetch($this->sitemap_key)) !== FALSE)
        {
            $this->result = $data;
        } 
        else
        {
            $this->initialize($this->_load_settings());

            // Add main page
            $this->items[] = array(
                    'loc'        => site_url(),
                    'changefreq' => $this->main_page_changefreq,
                    'priority'   => $this->main_page_priority
                );

            // Add categories to sitemap urls.
            $categories = $this->lib_category->unsorted();

            foreach($categories as $category)
            {
                $this->items[] = array(
                    'loc'        => site_url($category['path_url']),
                    'changefreq' => $this->pages_changefreq,
                    'priority'   => $this->cats_priority
                );

                // Add links to categories in all langs.
                foreach($this->langs as $k => $v)
                {
                    if ($v['id'] != $this->default_lang['id'])
                    {
                        $this->items[] = array(
                            'loc'        => site_url($k.'/'.$category['path_url']),
                            'changefreq' => $this->pages_changefreq,
                            'priority'   => $this->cats_priority
                        );
                    }
                }
            }

            // Get all pages
            $pages = $this->_get_all_pages();

            foreach($pages->result_array() as $page)
            {
                // create page url
                if ($page['lang'] == $this->default_lang['id'])
                {
                    $url = site_url($page['full_url']);
                }
                else
                {
                    $prefix = $this->_get_lang_prefix($page['lang']);
                    $url = site_url($prefix.'/'.$page['full_url']);
                }

                // create date
                if ($page['updated'] > 0)
                {
                    $date = date('Y-m-d', $page['updated']);
                }
                else
                {
                    $date = date('Y-m-d', $page['created']);
                }
                
                $this->items[] = array(
                    'loc'        => $url,
                    'lastmod'    => $date,
                    'changefreq' => $this->pages_changefreq,
                    'priority'   => $this->pages_priority
                );
            }

            $this->result = $this->generate_xml($this->items);

            $this->cache->store($this->sitemap_key, $this->result, $this->sitemap_ttl);
        }
    }

    public function _get_all_pages()
    {
        $this->db->select('id, created, updated, lang');
        $this->db->select('CONCAT_WS("", cat_url, url) as full_url', FALSE);
        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        return $this->db->get('content');
    }
        
    public function _cateogry_pages($id = 0)
    {
        $this->db->select('id, created, updated, lang, title as name');
        $this->db->select('CONCAT_WS("", cat_url, url) as full_url', FALSE);
        $this->db->where('lang', $this->config->item('cur_lang'));
        $this->db->where('category', $id);
        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        return $this->db->get('content');
    }
        
    private function generate_xml($items = array())
    {
        $data = '';

        while ($item = current($items) )
        {
            $data .= "<url>\n";
                foreach($item as $k => $v)
                {
                    if ($v != '')
                    {
                        $data .= "\t<$k>$v</$k>\n";
                    }
                }
            $data .= "</url>\n";

            next($items);
        }

        return "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n".$data."\t</urlset>";
    }

    /**
     * Get language prefix by lang id
     */
    private function _get_lang_prefix($id)
    {
        foreach($this->langs as $k => $v)
        {
            if ($v['id'] === $id)
            {
                return $k;
            }
        }
    }

    public function ping_google()
    {
        $host = 'http://www.google.com';
        $sitemap_url = site_url('sitemap.xml.gz');

        $fp = fsockopen($host, 80, $errno, $errstr, 30);
        if (!$fp) 
        {
            // $errno $errstr
        } 
        else
        {
            $req = 'GET /ping?sitemap=';
            $req = urlencode( $sitemap_url ) . " HTTP/1.1\r\n";
            $req = "Host: $host\r\n";
            $req = "User-Agent: Mozilla/5.0 (compatible; ".PHP_OS.") PHP/" . PHP_VERSION . "\r\n";
            $req = "Connection: Close\r\n\r\n";

            fwrite($fp, $req);
            while (!feof($fp)) 
            {
                //echo fgets($fp, 128);
            }
            fclose($fp);
        }
    }

    public function gzip()        
    {
        $this->_create_map();
        echo gzencode($this->result, $this->gzip_level);
    }

    public function _load_settings()
    {
        $this->db->select('settings');
        $this->db->where('name', 'sitemap');
        $query = $this->db->get('components', 1)->row_array();

        return unserialize($query['settings']);
    }

    function _install()
    {
        $data = array(
            'main_page_priority'   => 1,
            'cats_priority'        => '0.9',
            'pages_priority'       => '0.5',
            'main_page_changefreq' => 'weekly',
            'pages_changefreq'     => 'weekly'
            );

        $this->db->where('name', 'sitemap');
        $this->db->update('components', array('enabled' => '1', 'settings' => serialize($data)));
    }

}

/* End of file sitemap.php */

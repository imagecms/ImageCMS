<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Menu module
 */

class Menu extends Controller{

	private $current_uri;

	public $menu_array     = array(); // the root of the menu tree
    public $sub_menu_array = array(); // the list of menu items
    public $select_hidden  = FALSE;
    public $html           = '';
    public $activate_by_sub_urls = TRUE;

    private $expand        = array(); // items id to expand
    private $cache_key     = '';

	function __construct()
	{
		parent::Controller();
        $this->load->module('core');
        $this->cache_key = 'menu_data_'; 
        $this->cache_key = $this->cache_key.$this->dx_auth->get_role_id();

        $this->load->helper('string');
	}

	function index()
    {
        redirect();
    }

    public function autoload()
    {
        $this->load->helper('menu'); 

        $this->current_uri = site_url( $this->uri->uri_string() );
	}

	/**
	 * Prepare and display menu
	 *
	 * @param string $menu menu name
	 * @access public
	 */
	public function render($menu)
    {
        $this->clear();

        $this->prepare_menu_array($menu);
		$this->get_expand_items( $this->current_uri );

        $this->current_uri = site_url( $this->uri->uri_string() ); 

		$this->html .= $this->display_menu($this->menu_array);

        echo $this->html;
	}

    private function clear()
    {
	    $this->menu_array     = array(); 
        $this->sub_menu_array = array();
        $this->select_hidden  = FALSE;
        $this->html           = '';
        $this->activate_by_sub_urls = TRUE;
        $this->expand        = array();
    }

	/**
	 * Recursive function to display menu ul list
     * TODO: Rewrite this part of code to display valid html list
	 *
	 * @param array $menu_array
	 * @access public
	 */
	public function display_menu($menu_array)
	{
		$this->html .=  "<ul>\n";
		foreach ($menu_array as $item)
        {
                // Translate title
                if (isset($item['lang_title_'.$this->config->item('cur_lang')]))
                {
                    $item['title'] = $item['lang_title_'.$this->config->item('cur_lang')]; 
                }

                if ($item['item_type'] != 'url')
                {
                    $site_url = site_url($item['link']); 
                }else{
                    $site_url = $item['link'];
                }


                if ($this->activate_by_sub_urls === TRUE)
                {
                    $exp = explode('/', trim_slashes($this->uri->uri_string()));
                    $exp2 = explode('/', trim_slashes($item['link']));

                    $matches = 0;
                    foreach($exp2 as $k => $v)
                    {
                        if ($v == $exp[$k])
                        {
                            $matches++;
                        }
                    }

                    if ($matches == count($exp2))
                    {
                        $active_cur = TRUE;
                    }
                    else
                    {
                        $active_cur = FALSE;
                    }
                }
    
 				if ( $site_url == $this->current_uri OR $active_cur === TRUE)
				{
					$this->expand[$item['id']] = TRUE;
                    $CSS_class = ' class="active"';
				}
                else
                {
                    // Make link active if link is / and no segments in url
                    if ($item['link'] == '/' AND $this->uri->total_segments() == 0)
                    {
                        $CSS_class = ' class="active"'; 
                    }
                    else
                    {
					    $CSS_class = "";
                    }
                }            

                $this->html .= "<li".$CSS_class.">";

                $item['item_type'] == 'url' ? $href = $item['link']: $href = site_url($item['link']);                 

				$this->html .= '<a href="'.$href.'">'.$item['title'].'</a>';

					$sub_menus = $this->_get_sub_menus($item['id']);
					if (isset($this->expand[$item['id']]) AND $this->expand[$item['id']] == TRUE AND count($sub_menus) > 0)
					{
						$this->display_menu($sub_menus);
					}
                    /*
                    else
                    {
                        if ($this->display_menu($sub_menus) != NULL)
                        {
                            $this->html .= "<div id=\"menu_sub_items\">";
                                $this->display_menu($sub_menus);
                            $this->html.= "</div>";
                        }
                    }
                    */

            $this->html .= "</li>\n";
        }

		$this->html .= "</ul>\n";
	}

	/**
	 * Find sub menus
	 *
	 * @param integer $id
	 * @access public
	 * @return mixed
	 */
	public function _get_sub_menus($id)
	{
		$sub_menus = array();

		foreach ($this->sub_menu_array as $sub_menu)
		{
			if ($sub_menu['parent_id'] == $id)
			{
				array_push($sub_menus,$sub_menu);

					if( site_url($item['link']) == $this->current_uri )
					{
						$this->expand[ $item['id'] ] == TRUE;
					}
			}
		}

		if ( count($sub_menus > 0) )
		{
			return $sub_menus;
		}else{
			return FALSE;
		}
	}

	/**
	 * Find menus ids we must open
	 *
	 * @param string $url
	 * @access private
	 * @return bool
	 */
	private function get_expand_items($url)
	{
        foreach($this->sub_menu_array as $item)
		{
			if ( site_url($item['link']) == $url AND $item['parent_id'] != 0)
			{
				$this->expand[ $item['parent_id'] ] = TRUE;
				$this->get_expand_items( site_url($this->sub_menu_array[$item['parent_id']]['link']) );
			}
		}
		return TRUE;
	}

	/**
     * Select menu data from DB and separate menus is two arrays: root and submenus.
     *
     * @param string $menu - menu name
	 * @access public
	 */
	public function prepare_menu_array($menu)
    {
        if (($menu_data = $this->cache->fetch($this->cache_key.$menu, 'menus')) !== FALSE)
        {
            $this->menu_array     = $menu_data['menu_array'];
            $this->sub_menu_array = $menu_data['sub_menu_array'];
        }
        else
        {
            $this->db->select('menus.name', FALSE);
            //$this->db->select('menus.main_title', FALSE);
            $this->db->select('menus_data.id AS id', FALSE);
            $this->db->select('menus_data.menu_id AS menu_id', FALSE);
            $this->db->select('menus_data.item_type AS item_type', FALSE);
            $this->db->select('menus_data.item_id AS item_id', FALSE);
            $this->db->select('menus_data.title AS title', FALSE);
            $this->db->select('menus_data.hidden AS hidden', FALSE);
            $this->db->select('menus_data.position AS position', FALSE);
            $this->db->select('menus_data.roles AS roles', FALSE);
            $this->db->select('menus_data.parent_id AS parent_id', FALSE);
            $this->db->select('menus_data.description AS description', FALSE);
            $this->db->select('menus_data.add_data AS add_data', FALSE);

            $this->db->join('menus_data', 'menus_data.menu_id = menus.id');
            $this->db->where('menus.name', $menu);
            $this->db->where('menus_data.hidden', 0);
            $this->db->order_by('position','asc');

            // Select hidden items
            if ($this->select_hidden == TRUE)
            {
                $this->db->or_where('menus_data.hidden', 1); 
            }

            $menus = $this->db->get('menus');

            if ($menus->num_rows() == 0)
            {
               //echo 'Ошибка загрузки меню '.$menu;
               return FALSE;
            }else{
               $menus = $menus->result_array();
            }

            // detect roles
            $cnt = count($menus);
            for ($i = 0; $i < $cnt; $i++) 
            {
                if ($menus[$i]['roles'] != FALSE)
                {
                    $access = $this->_check_roles(unserialize($menus[$i]['roles']));
                    if ($access == FALSE)
                        unset($menus[$i]);
                }
            }

            $this->cur_menu_id = $menus[0]['menu_id'];
            $this->load->model('menu_model','item');

            $menus = array_values($menus);

            $langs = $this->db->get('languages');

            if ($langs->num_rows() > 0)
            {
                $langs = $langs->result_array();
            }
            else
            {
                $langs = FALSE;
            }

            // Create links
            $cnt = count($menus);
            for ($i = 0; $i < $cnt; $i++) 
            { 
                switch ($menus[$i]['item_type'])
                {
                    case 'page':
                        $url = $this->item->get_page_url($menus[$i]['item_id']);
                        $menus[$i]['link'] = $url['cat_url'].$url['url'];
                    break;

                    case 'category':
                        $category = $this->lib_category->get_category($menus[$i]['item_id']);
                        $menus[$i]['link'] = $category['path_url'];
                    break;

                    case 'module':
                        $mod_info = unserialize($menus[$i]['add_data']);
                        $mod_url = $this->item->get_module_link($mod_info['mod_name']);

                        if ($menus[$i]['add_data'] != NULL)
                        {
                            $method = $mod_info['method'];

                            if (substr($method,0,1) == '/')
                                $url = $mod_url.$method;
                            else
                                $url = $mod_url.'/'.$method;
                        
                        }

                        $menus[$i]['link'] = $url;
                    break;

                    case 'url':
                        $menus[$i]['link'] = $menus[$i]['add_data'];    
                    break;  
                }


                if ($langs != FALSE)
                {
                    foreach ($langs as $lang)
                    {
                        $this->db->where('item_id', $menus[$i]['id']);
                        $this->db->where('lang_id', $lang['id']);
                        $t_query = $this->db->get('menu_translate');
                            
                            if ($t_query->num_rows() == 1)
                            {
                                $n_title = $t_query->row_array();
                                $menus[$i]['lang_title_'.$lang['id']] = $n_title['title'];
                            }
                    }
                }

                if($menus[$i]['parent_id'] == 0)
                {
                    $this->menu_array[$menus[$i]['id']] = $menus[$i];
                }else{
                    $this->sub_menu_array[$menus[$i]['id']] = $menus[$i];
                }
            }

            $data = array(
                'menu_array'     => $this->menu_array,
                'sub_menu_array' => $this->sub_menu_array
                );

            $this->cache->store($this->cache_key.$menu, $data, FALSE, 'menus');
        }
    }

    private function _check_roles($roles = array())
    {
        $access = FALSE;

        foreach ($roles as $key => $role_id)
        {
            $logged = $this->dx_auth->is_logged_in();
            $my_role = $this->dx_auth->get_role_id();

            // admin
            if($this->dx_auth->is_admin() === TRUE) $access = TRUE;

            // all users
            if ($role_id == 0) $access = TRUE;
            
            if ($role_id == $my_role)
            {
                $access = TRUE;
            }
        }

        return $access;
    }

    public function get_all_menus()
    {
        $this->db->select('name, main_title');
        $query = $this->db->get('menus');

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }else{
            return FALSE;
        }
    }

    public function _install()
    {
        $this->db->where('name', 'menu');
        $this->db->update('components', array('autoload' => 1));
    }

}
/* End of file tags.php */

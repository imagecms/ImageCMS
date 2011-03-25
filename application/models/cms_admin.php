<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cms_admin extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

/*************************************************************
 *	Pages
 ************************************************************/


	/**
	 * Add page into content table
	 *
	 * @return integer
	 */
	function add_page($data)
	{
		$this->db->limit(1);
		$this->db->insert('content',$data);

		return $this->db->insert_id();
	}

	/**
	 * Select page by id and lang_id
	 *
	 * @return array
	 */
	function get_page_by_lang($id,$lang = 0)
	{
		$this->db->where('id',$id);
		$this->db->where('lang',$lang);
		$query = $this->db->get('content',1);

		if ($query->num_rows == 1)
		{
			return $query->row_array();
		}

		return FALSE;

	}

	/**
	 * Select page by id
	 *
	 * @return array
	 */
	function get_page($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('content',1);

		if ($query->num_rows > 0)
		{
			return $query->row_array();
		}

		return FALSE;

	}

	function page_exists($id)
	{
		$this->db->select('id');
		$this->db->where('id',$id);
		$query = $this->db->get('content',1);

		if ($query->num_rows == 1)
		{
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Updating page by id
	 *
	 * @return integer
	 */
	function update_page($id, $data)
	{
		$page = $this->get_page($id);
		$alias = $page['lang_alias'];

		if($alias == 0)
		{
			$this->db->where('lang_alias', $page['id']);
			$this->db->update('content', array('category' => $data['category'], 'cat_url' => $data['cat_url'], 'url' => $data['url']));
        }
        else
        {
			$page = $this->get_page($alias);
			$this->db->where('lang_alias', $page['id']);
			$this->db->update('content', array('category' => $data['category'], 'cat_url' => $data['cat_url']));

			$this->db->where('id', $alias);
            $this->db->update('content', array('category' => $data['category'], 'cat_url' => $data['cat_url']));

            $data['url'] = $page['url'];
		}

		// update page
		$this->db->where('id',$id);
		$this->db->update('content', $data);
		// end update page

		return $this->db->affected_rows();
	}

/*************************************************************
 *	Categories
 ************************************************************/

	/**
	 * Creates new category
	 *
	 * @return integer
	 */
	function create_category($data)
	{
		$this->db->insert('category',$data);

		return $this->db->insert_id();
	}

	/*
	 * Update category data
	 *
	 * @access public
	 */
	function update_category($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('category',$data);
	}


	/**
	 * Select all categories
	 *
	 * @access public
	 * @return array
	 */
	function get_categories()
	{
		return $this->cms_base->get_categories();
	}

	/*
	 * Get category by id
	 */
	function get_category($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('category',1);

		if ($query->num_rows() > 0 )
		{
			return $query->row_array();
		}

		return FALSE;
	}

	/**
	 * Check if category is created
	 *
	 * @access public
	 * @return bool
	 */
	function is_category($url)
	{
		$this->db->where('url', $url);
		$query = $this->db->get('category',1);

		if ($query->num_rows == 1)
		{
			return TRUE;
		}

		return FALSE;
	}




/*************************************************************
 *	Settings
 ************************************************************/

	/**
	 *	Save settings
	 *
	 * @settings array
	 * @access public
	 */
	function save_settings($settings)
	{
		$this->db->where('s_name','main');
		$this->db->update('settings',$settings);
	}

	/**
	 * Selecting main settings
	 *
	 * @access public
	 * @return array
	 */
	function get_settings()
	{
		return $this->cms_base->get_settings();
	}

	/**
	 * Get editor theme
	 *
	 * @access public
	 * @return string
	 */
	function editor_theme()
	{
		$this->db->select('editor_theme');
		$this->db->where('s_name','main');
		$query = $this->db->get('settings',1);

		return $query->row_array();
	}


/*************************************************************
 *	Languages
 ************************************************************/


	/**
	 * Add page into content table
	 *
	 * @return integer
	 */
	function insert_lang($data)
	{
		$this->db->insert('languages',$data);

		return $this->db->insert_id();
	}

	function get_langs()
	{
		$query = $this->db->get('languages');

		return $query->result_array();
	}

	function get_lang($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('languages',1);

		if($query->num_rows() == 1 )
		{
			return $query->row_array();
		}

		return FALSE;
	}

	function update_lang($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('languages',$data);
	}

	function delete_lang($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('languages');
	}

	function set_default_lang($id)
	{
		$this->db->update('languages',array('default' => 0));

		$this->db->where('id',$id);
		$this->db->limit(1);
		$this->db->update('languages',array('default' => 1));
	}

	function get_default_lang()
	{
		$this->db->where('default',1);
		$query = $this->db->get('languages',1);
		return $query->row_array();
	}



}

/* End of cms_admin.php */

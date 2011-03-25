<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cms_base extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Select main settings
	 *
	 * @access public
	 * @return array
	 */
	public function get_settings()
	{
		$this->db->where('s_name','main');
		$query = $this->db->get('settings', 1);

		if ($query->num_rows() == 1)
		{
			return $query->row_array();
		}

		return FALSE;
	}

	/**
	 * Select site languages
	 *
	 * @access public
	 * @return array
	 */
	public function get_langs()
	{
		$query = $this->db->get('languages');

		return $query->result_array();
	}

	/**
	 * Load modules
	 */
	 public function get_modules()
	 {
        $this->db->select('id, name, identif, autoload, enabled');
        //$this->db->where('enabled', 1);
    	$query = $this->db->get('components');
        
        return $query;
	 }

	 public function get_category_pages($cat_id)
	 {
			$this->db->where('category', $cat_id);
			$this->db->where('post_status', 'publish');
			$this->db->where('publish_date <=', time());
			$this->db->where('lang_alias', 0);
			$this->db->where('lang', $this->config->item('cur_lang') );
			$this->db->order_by('created','desc');

			$query = $this->db->get('content');

			if ( $query->num_rows() > 0 )
			{
				return $query->result_array();
			}else{
				return FALSE;
			}
	 }

	 public function get_page_by_id($page_id = FALSE)
     {
         if($page_id != FALSE)
         {
			$this->db->where('post_status', 'publish');
			$this->db->where('publish_date <=', time());
			$this->db->where('id', $page_id);

            $query = $this->db->get('content', 1);

            if($query->num_rows() == 1)
            {
                return $query->row_array();
            }

         }

         return FALSE;
     }

     public function get_page($page_id = FALSE)
     {
        return $this->get_page_by_id($page_id);
     }

	/**
	 * Select all categories
	 *
	 * @access public
	 * @return array
	 */
	public function get_categories()
	{
		$this->db->order_by('position', 'ASC');
		$query = $this->db->get('category');

		if ($query->num_rows() > 0 )
		{
			$categories = $query->result_array();

            ($hook = get_hook('cmsbase_return_categories')) ? eval($hook) : NULL; 
            
            return $categories;
		}

		return FALSE;
	}

}

/* end of cms_base.php */

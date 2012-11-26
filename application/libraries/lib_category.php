<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Image CMS
 * lib_category.php
 * Library to work with categories
 *
 * TODO: Rewrites as module
 *       optimize it and write db model
 */

class Lib_category {

	public $categories = array();
	public $level = 0;
	public $path = array();
    public $unsorted_arr = FALSE;
    public $unsorted = FALSE;

 	function Lib_category()
 	{
 		$this->CI = get_instance();
 	}

	/**
	 * Check if categories tree is cached or build it
	 *
	 * @access public
	 * @return array
	 */
 	function build()
	{
		// check cache file
		if (($cache = $this->CI->cache->fetch_func($this, '_build')) !== false)
		{
			return $cache;
		}
        else
        {
			return $this->CI->cache->call(array($this, '_build'));
		}
	}

	/**
	 * Select and cache all categories from DB
	 *
	 * @access public
	 * @return array
	 */
	function unsorted()
    {
        if ($this->unsorted != FALSE)
        {
            return $this->unsorted_arr;
        }

		if (($cache = $this->CI->cache->fetch('categories_unsorted_array')) !== FALSE)
        {
            $this->unsorted_arr =& $cache;

            foreach($this->unsorted_arr as $k => $v)
            {
                $this->unsorted_arr[$k] = $this->translate($this->unsorted_arr[$k]);
            }

			return $this->unsorted_arr;
		}
        else
        {
			$key = 'categories_unsorted_array';

			$this->categories = $this->CI->cms_base->get_categories();
			$this->create_path();

			$cats = array();
			foreach($this->categories as $category)
			{
				$cats[$category['id']] = $category;
			}

            $this->CI->cache->store($key, $cats);
            $this->unsorted_arr =& $cats;

            foreach($this->unsorted_arr as $k => $v)
            {
                $this->unsorted_arr[$k] = $this->translate($this->unsorted_arr[$k]);
            }

			return $cats;
		}
	}

	/**
	 * Get category from an array
	 *
	 * @access public
	 * @return array
	 */
	function get_category($id)
	{
        if ($this->unsorted_arr == FALSE)
        {
            $this->unsorted();
        }

        if (is_array($id))
        {
            $temp_arr = array();

            foreach($id as $k => $v)
            {
                $temp_arr[$v] = $this->unsorted_arr[$v];
            }

            return $temp_arr;
        }

        return $this->unsorted_arr[$id];
	}

	/**
	 * Get value of category item
	 *
	 * @access public
	 */
	function GetValue($cat_id ,$param)
	{
		if ($this->unsorted_arr == FALSE)
        {
            $this->unsorted();
        }

		return $this->unsorted_arr[$cat_id][$param];
	}


    /**
	 * Get category from array by param
	 *
	 * @access public
	 * @return array
	 */
	function get_category_by($param, $value)
	{
		$categories = $this->unsorted();

        foreach($categories as $cat)
        {
            if($cat[$param] == $value)
                return $cat;
        }

		unset($categories);
		return FALSE;
	}

	/**
	 * Build categories array
	 *
	 * @access private
	 * @return array
	 */
	function _build()
	{
		$this->categories = $this->CI->cms_base->get_categories();
		$this->create_path();

		$new_cats = array();

		foreach($this->categories as $cats)
		{
			if($cats['parent_id'] == 0)
			{
				# Category Level
				$cats['level'] = $this->level;

                $cats = $this->translate($cats);

				# Build subcategories
				//$cats['subtree'] = $this->_get_sub_cats($cats['id']);
				$sub = $this->_get_sub_cats($cats['id']);
				if(count($sub)) $cats['subtree'] = $sub;

				array_push($new_cats, $cats);
			}
		}

		unset ($this->categories);
		return $new_cats;

	}

	/**
	 * Build sub categories
	 *
	 * @access private
	 * @return array
	 */
	function _get_sub_cats($parent_id)
	{
        $new_sub_cats = array();
		$this->level++;

        foreach ($this->categories as $sub_cats)
        {
			if ($sub_cats['parent_id'] == $parent_id )
            {
                $sub_cats['level'] = $this->level;

                $sub_cats = $this->translate($sub_cats);  

				$sub = $this->_get_sub_cats($sub_cats['id']);
				if(count($sub)) $sub_cats['subtree'] = $sub;

                array_push($new_sub_cats, $sub_cats);
            }
        }

		$this->level--;
        return $new_sub_cats;
	}

	/**
	 * Create path to each category
	 *
	 * @access public
	 */
	function create_path()
	{
		$path_str = '';

		// Create path to each category
		for ($i = 0, $cats_count = count($this->categories); $i < $cats_count; $i++) {
			$this->path = array(); // make path empty

			$path_arr = $this->_PathToCat($this->categories[$i]['id']);
			$this->categories[$i]['path'] = $path_arr; // path array

				// build path string 'cat1/sub_cat1/sub_cat2'
				foreach ($path_arr as $k)
				{
					 $path_str .= $k.'/';
				}

			$this->categories[$i]['path_url'] = $path_str; // path string

			unset($path_arr);
			unset($path_str);
		}
	}

	/**
	 * Build full patch to one category
	 *
	 * @access private
	 * @return array
	 */
	function _PathToCat($cat_id)
	{
		foreach($this->categories as $cats)
		{
			if($cats['id'] == $cat_id)
			{
                //array_push($this->path,$cats['url']);
                $this->path[ $cats['id'] ] = $cats['url'];
                //var_dump($cats);
				$this->_PathToCat($cats['parent_id']);
			}
		}

		return array_reverse($this->path, TRUE);
		//return $this->path;
	}

    function translate($category = array())
    {
        if (!$this->CI->config->item('cur_lang'))
        {
            return $category;
        }

        $translated = $this->get_translated_array();

        if (count($translated))
        {
            $t_cat = $translated[$category['id']];
        }
        else
        {
            $t_cat = FALSE;
        }

        if ($t_cat)
        {
            $category['name'] = $t_cat['name'];
            $category['image'] = $t_cat['image'];
            $category['description'] = $t_cat['description'];
            $category['keywords'] = $t_cat['keywords'];
            $category['short_desc'] = $t_cat['short_desc'];
            $category['title'] = $t_cat['title'];
        }

        return $category;
    }

    function get_translated_array()
    {
        $translated = array();
        $lang = $this->CI->config->item('cur_lang');
        $ck = 'categories_translated_array_'.$lang;

        if (($translated = $this->CI->cache->fetch($ck)) !== FALSE)
        {
            return $translated;
        }
        else
        {
            $this->CI->db->where('lang', $lang);
            $translated = $this->CI->db->get('category_translate');


            $parsed = array();
            if ($translated->num_rows() > 0)
            {
                foreach($translated->result_array() as $t)
                {
                    $parsed[$t['alias']] = $t;
                }
            }

            $this->CI->cache->store($ck, $parsed);

            return $parsed;
        }
    }

	/**
	 * Clear all cached functions
	 *
	 * @access public
	 */
	function clear_cache()
	{
		$this->CI->cache->delete_func($this,'_build');
		$this->CI->cache->delete('categories_unsorted_array');
        
        $query = $this->CI->db->get('category_translate');

        if ($query->num_rows() > 0)
        {
            foreach($query->result_array() as $k)
            {
                $ck = 'categories_translated_array_'.$k['lang'];
                $this->CI->cache->delete($ck);
            }
        }
	}

}

/* End of lib_category.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Page tags module
 */

class Tags extends MY_Controller {

    public $min_font_size = 10;
    public $max_font_size = 26;

    public $min_count = -1;
    public $max_count = -1;
    public $delimiter = ' ';
    public $tag_url_prefix  = '/tags/search/';

    public $tags = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->module('core');
       // $this->output->enable_profiler(TRUE);
	}

    public function index()
    {
        //$this->prepare_tags(); // Prepare tags array. Tags will be selected from content_tags table.

        /**
        $tags = array(
            array('value' => 'text 1', 'count' => '1'),
            array('value' => 'text 2', 'count' => '5'),
            array('value' => 'text 3', 'count' => '3'),
        );

        $this->prepare_tags($tags); // Prepare custom tags array.
        
        $this->_sort_tags(); // Sort tags by count or text.
               
        shuffle($this->tags); // Shuffle tags array.
        */

        //echo $this->build_cloud(); // Display tag cloud.
    }

	// Autoload default function
	public function autoload()
	{
        $this->load->helper('tags');
    }

    public function initialize($config = array())
    {
        if (count($config) > 0)
        {
            foreach ($config as $k => $v)
            {
                if (isset($this->$k))
                {
                    $this->$k = $v;
                }
            }
        }
    }

    /**
    * Search pages by tag
    */
    public function search($tag = '', $offset = 0)
    {
        $this->load->module('search');
        $this->search->search_tpl = 'search';

        $error = FALSE;

        $offset = $this->uri->segment($this->uri->total_segments());

        if ($offset < 0)
        {
            $offset = 0;
        }

        $tag = urldecode($tag);
        $tags = explode(':', $tag);

        if (count($tags) > 0)
        {
            for ($i=0;$i<count($tags);$i++)
            {
                $tags[$i] = urldecode($tags[$i]);
            }

            $this->db->where_in('value', $tags);

            $ids = $this->db->get('tags'); 
        }
        else
        {
            $this->search->_display(FALSE); 
        }

        if ($ids->num_rows() == 0)
        {
            $error = TRUE;
        }
        else
        {
            // Get pages
            $pages_id = array();
            $tags_ids = array();
            
            foreach ($ids->result_array() as $row)
            {
                $tags_ids[] = $row['id'];
            }

            if (count($tags_ids) > 0)
            {
                $this->db->where_in('tag_id', $tags_ids);
                $query = $this->db->get('content_tags');
            }

            foreach ($query->result_array() as $key)
            {
                $pages_id[] = $key['page_id'];
            }

            $pages_id = array_unique($pages_id);

            if (count($pages_id) > 0)
            {
                $this->db->select('content.*');
                $this->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url');
                $this->db->where('post_status', 'publish');
                $this->db->where('publish_date <=', time());
                $this->db->where('lang', $this->config->item('cur_lang'));
                $this->db->order_by('publish_date', 'DESC');
                $this->db->where_in('id', $pages_id);
                $pages = $this->db->get('content', $this->search->row_count, (int) $offset);

                if ($pages->num_rows() == 0)
                {
                    $this->search->_display(FALSE);
                    exit;
                }
                else
                {
                    $pages = $pages->result_array();

                    // Connect cfcm fields
                    ($hook = get_hook('core_return_category_pages')) ? eval($hook) : NULL;
                }

                //Pagination
                if (count($pages) >= $this->search->row_count)
                {
                    $this->load->library('Pagination');

                    $config['base_url']    = site_url('tags/search/'.$tag.'/');
                    $config['total_rows']  = count($pages_id);
                    $config['per_page']    = $this->search->row_count;
                    $config['uri_segment'] = $this->uri->total_segments();
                    $config['first_link']  = lang('first_link');
                    $config['last_link']   = lang('last_link');

                    $config['cur_tag_open']  = '<span class="active">';
                    $config['cur_tag_close'] = '</span>';

                    $this->pagination->num_links = 5;
                    $this->pagination->initialize($config);
                    $this->template->assign('pagination', $this->pagination->create_links());
                }
                //End pagination
            }

            if (count($pages_id) == 0)
            {
                $error = TRUE;
            }
            else
            {
                $this->core->set_meta_tags(lang('search_title').$this->search->title_delimiter.$tag);
                $this->template->assign('search_title', htmlspecialchars($tag));
                $this->search->_display($pages);
            }
        }

        if ($error === TRUE)
        {
            $this->search->_display(FALSE);
        }
    }

	public function prepare_tags($array = array())
    {
        $unique_tags = array();
        $result = array();

        if (count($array) > 0)
        {
            $result = $array;
        }
        else
        {
            $tags = $this->get_all_tags();

            if (count($tags) > 0)
            {
                $frequency = array();
                $tag_values = array();

                $this->db->select('tag_id');
                $content_tags = $this->db->get('content_tags')->result_array();

                foreach ($content_tags as $val)
                {
                    $tag_id = $val['tag_id'];

                    if (isset($frequency[$tag_id]))
                    {
                        $frequency[$tag_id]++;
                    }
                    else
                    {
                        $frequency[$tag_id] = 1;
                    }
                }

                foreach ($tags as $tag)
                {
                    array_push($result, array('value' => $tag['value'], 'count' => $frequency[$tag['id']]));
                }
            }
        }

        // Find min. and max. tag count value
        foreach($result as $k => $v)
        {
            $count = $v['count'];

            if ($count > $this->max_count)
            {
                $this->max_count = $count;
            }

            if ($count < $this->min_count OR $this->min_count == -1)
            {
                $this->min_count = $count;
            }
        }
 
        $this->tags = $result;
    }

    /**
     * Build tags cloud
     *
     * @param string $return_type - possible values: html/array
     */
    public function build_cloud($return_type = 'html')
    {
        $this->load->helper('url');

        switch ($return_type)
        {
            case 'html':
                $tags_cloud = '';
            break;

            case 'array':
                $tags_cloud = array();
            break;
        }
        $tags = $this->tags;

        if (count($tags) > 0)
        {
            $font_size_diff = $this->max_font_size - $this->min_font_size;
            $count_diff = $this->max_count - $this->min_count; 

            if ($font_size_diff > 0 AND $count_diff > 0)
            {
                $increase = $font_size_diff / $count_diff;
            }
            else
            {
                $increase = 0;
            }

            $n = 0;
            foreach ($tags as $tag)
            {
                $font_size = round($this->min_font_size + ($tag['count'] * $increase)); 

                if ($font_size > $this->max_font_size)
                    $font_size = $this->max_font_size;
            
                if ($font_size < $this->min_font_size)
                    $font_size = $this->max_font_size;

                if ($return_type == 'html')
                {
                    //$tags_cloud .= $this->delimiter.'<span style="font-size:'.$font_size.'px">'.anchor($this->tag_url_prefix.$tag['value'], $tag['value']).'</span>';
                    $tags_cloud .= $this->delimiter.anchor($this->tag_url_prefix.$tag['value'], $tag['value'], 'style="font-size:'.$font_size.'px;text-decoration:none;"');
                }
                else
                {
                    $tag['font_size'] = $font_size;
                    array_push($tags_cloud, $tag);
                }
            }
        }

        return $tags_cloud;
    }

    /**
     * Sort tags
     *
     * @param string $sort_var - value to sort array.
     * @param string $order - possible values: SORT_DESC, SORT_ASC
     */
    public function _sort_tags($sort_var = 'count', $order = SORT_DESC)
    {
        $values = array();

        if ($sort_var != 'count' AND $sort_var != 'value')
        {
            $sort_var = 'count';
        }

        foreach ($this->tags as $k => $v) 
        {
            $values[$k]  = $v[$sort_var];
        }

        array_multisort($values, $order, $this->tags);
    }

	public function _set_page_tags($tags_str = '', $page_id)
	{
		$tags_arr = explode(',',$tags_str);

        $this->db->delete('content_tags', array('page_id' => $page_id));

		if(count($tags_arr) > 0)
		{
			foreach($tags_arr as $k => $v)
			{
                if (trim($v) != '')
                {
                    // Check if tag exits
                    if ($this->db->get_where('tags', array('value' => trim($v)))->num_rows() > 0)
                    {
                        $this->db->limit(1);
                        $query = $this->db->get_where('tags', array('value' => trim($v)))->row();
                        $tag_id = $query->id;
                    }
                    else
                    {
                        // Create new tag
                        $this->db->insert('tags', array('value' => trim($v)));
                        $tag_id = $this->db->insert_id(); 
                    }

                    if (mb_strlen($v, 'utf-8') > 1)
                    $this->db->insert('content_tags', array('page_id' => $page_id, 'tag_id' => $tag_id));
                }
			}
        }

        $this->_remove_orphans();
	}

    public function _remove_orphans()
    {
        $this->db->select('page_id, tag_id');
        $query = $this->db->get('content_tags');
        
        if ($query->num_rows() > 0)
        {
            $tags = array();

            foreach ($query->result_array() as $tag)
            {
                $tags[] = $tag['tag_id'];
            }

            $this->db->where_not_in('id', $tags);
            $this->db->delete('tags');
        }
    }

	public function get_page_tags($page_id)
	{
		$this->db->where('page_id', $page_id);
		$query = $this->db->get('content_tags');

        if ($query->num_rows() > 0)
        {
            $tags = array();

            foreach ($query->result_array() as $val)
            {
                $tags[] = $val['tag_id'];
            }

            $this->db->where_in('id', $tags);
            return $this->db->get('tags')->result_array();
        }
	}

	public function get_all_tags()
	{
		return $this->db->get('tags')->result_array();
	}

	public function search_tags($search_value)
	{
		$this->db->like('value', $search_value);
		return $this->db->get('tags')->result_array();
	}

    // Create content_tags table
    // TODO: move install/deinstall to model.
    public function _install()
    {
    	if( $this->dx_auth->is_admin() == FALSE) exit;

        $this->load->dbforge();

        $fields = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'page_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'tag_id'  => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    ),
                );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('content_tags', TRUE);

        //autoload
        $this->db->where('name', 'tags');
        $this->db->update('components', array('autoload' => '1'));
    }

    // Delete tags table
    public function _deinstall()
    {
       	if( $this->dx_auth->is_admin() == FALSE) exit;
    
        $this->load->dbforge();
        $this->dbforge->drop_table('content_tags');
        $this->dbforge->drop_table('tags');
    }



}

/* End of file tags.php */

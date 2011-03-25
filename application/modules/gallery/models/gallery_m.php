<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Gallery main model
 */

class Gallery_m extends CI_Model {

	function Base()
	{
		parent::__construct();
    }

    function load_settings()
    {
        $this->db->select('settings');
        $query = $this->db->get_where('components', array('name' => 'gallery'))->row_array();

        return unserialize($query['settings']);
    }

    /**
     * Create new album
     */
    function create_album()
    {
        $this->db->select_max('position');
        $pos = $this->db->get('gallery_albums')->row_array();

        // Increase album position
        $data['position'] = $pos['position'] + 1;

        $data = array(
            'name'        => $this->input->post('name'),
            'description' => trim($this->input->post('description')),
            'created'     => time(),
            'category_id' => $this->input->post('category_id'),
        );

        $this->db->insert('gallery_albums', $data);

        return $this->db->insert_id();
    }


    function update_album($id, $data = array())
    {
        $this->db->where('id', $id);
        $this->db->update('gallery_albums', $data);
    }

    function delete_album($id)
    {
        // delete album
        $this->db->where('id', $id);
        $this->db->delete('gallery_albums');

        // delete images
        $this->db->where('album_id', $id);
        $this->db->delete('gallery_images');
    }

    /**
     * Get all albums
     */ 
    function get_albums($order_by = 'date', $sort_order = 'desc', $category_id = 0)
    {
        // Select albums

        if ($category_id > 0)
        {
            $this->db->where('gallery_albums.category_id', $category_id);
        }

        $this->db->select('gallery_albums.*');
        $this->db->select('gallery_images.file_name as cover_name', FALSE);
        $this->db->select('gallery_images.file_ext as cover_ext', FALSE);
        $this->db->join('gallery_images', 'gallery_images.id = gallery_albums.cover_id', 'left');

        // Subquery. album views.
        $this->db->select('(SELECT SUM(gallery_images.views) FROM gallery_images WHERE gallery_images.album_id = gallery_albums.id) AS views'); 

        if ($sort_order != 'desc' AND $sort_order != 'asc')
        {
            $sort_order = 'desc';
        }

        switch ($order_by)
        {
            case 'date':
                $this->db->order_by('created', $sort_order); 
                break;

            case 'name':
                $this->db->order_by('name', $sort_order); 
            break;

            case 'position':
                $this->db->order_by('position', $sort_order); 
            break;
        }

        $query = $this->db->get('gallery_albums');

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }


    function get_last_image($album_id)
    {
        $this->db->order_by('uploaded', 'desc');
        $this->db->where('album_id', $album_id);
        $query = $this->db->get('gallery_images', 1);

        if ($query->num_rows() == 1)
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Get Album info
     */
    function get_album($id = 0, $include_images = TRUE)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $query = $this->db->get('gallery_albums');

        if ($query->num_rows() > 0)
        {
            $album = $query->row_array();

            if ($include_images == TRUE)
            {
                $album['images'] = $this->get_album_images($album['id']);
            }

            return $album;
        }
        else
        {
            return FALSE;
        }
    }

    function get_album_images($album_id)
    {
        //$this->db->order_by('uploaded', 'asc');

        $this->db->select('*');
        $this->db->select('CONCAT_WS("", file_name, file_ext) as full_name', FALSE);
        $this->db->order_by('position', 'asc');
        $this->db->where('album_id', $album_id);
        $query = $this->db->get('gallery_images');

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }


    function set_album_cover($album_id, $image_id)
    {
        $this->db->where('id', $album_id);
        $this->db->update('gallery_albums', array('cover_id' => $image_id));
    }

    // --------------------------------------------------------------------

    function add_image($data = array())
    {
        $this->db->select_max('position');
        $pos = $this->db->get('gallery_images')->row_array();

        // Increase position
        $data['position'] = $pos['position'] + 1;

        $this->db->insert('gallery_images', $data);

        // Update album date
        $this->db->where('id', $data['album_id']);
        $this->db->update('gallery_albums', array('updated' => time()));

        return $this->db->insert_id();
    }

    function get_image_info($id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $query = $this->db->get('gallery_images');

        if ($query->num_rows() == 1)
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    function increase_image_views($id)
    {
        $this->db->limit(1);
        $this->db->set('views', 'views + 1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('gallery_images');
    }

    function rename_image($id, $name)
    {
        $this->db->where('id', $id);
        $this->db->update('gallery_images', array('file_name' => $name));
    }

    function delete_image($id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->delete('gallery_images');
    } 

    function update_description($id, $text)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->update('gallery_images', array('description' => $text));
    }

    function update_position($id, $position  = 0)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->update('gallery_images', array('position' => $position));
    }

    // --------------------------------------------------------------------

    function create_category($data = array())
    {
        $this->db->insert('gallery_category', $data);
    }

    function get_category($id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $query = $this->db->get('gallery_category');

        if ($query->num_rows() == 1)
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    function get_categories($order_by = 'name', $sort_order = 'desc')
    {
        if ($sort_order != 'desc' AND $sort_order != 'asc')
        {
            $sort_order = 'desc';
        }

        switch ($order_by)
        {
            case 'date':
                $this->db->order_by('created', $sort_order); 
                break;

            case 'name':
                $this->db->order_by('name', $sort_order); 
            break;

            case 'position':
                $this->db->order_by('position', $sort_order); 
            break;
        }

        $query = $this->db->get('gallery_category');

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    function update_category($data = array(), $id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);

        $this->db->update('gallery_category', $data);
    }

    function delete_category($id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->delete('gallery_category');
    }
 
}

/* End of file gallery_m.php */

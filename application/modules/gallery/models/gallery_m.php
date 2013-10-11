<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Gallery main model
 */
class Gallery_m extends CI_Model {

    function Base() {
        parent::__construct();
    }

    function load_settings() {
        $this->db->select('settings');
        $query = $this->db->get_where('components', array('name' => 'gallery'))->row_array();

        return unserialize($query['settings']);
    }

    /**
     * Create new album
     */
    function create_album() {
        $locale = $this->chose_locale();
        $this->db->select_max('position');
        $pos = $this->db->get('gallery_albums')->row_array();

        // Increase album position
        $data['position'] = $pos['position'] + 1;

        $data = array(
            //'name' => $this->input->post('name'),
            //'description' => trim($this->input->post('description')),
            'created' => time(),
            'category_id' => $this->input->post('category_id'),
            'tpl_file' => $this->input->post('tpl_file')
        );

        $this->db->insert('gallery_albums', $data);
        $lid = $this->db->insert_id();

        $data_locale = array(
            'id' => $lid,
            'locale' => $locale,
            'name' => $this->input->post('name'),
            'description' => trim($this->input->post('description')),
        );

        $this->db->insert('gallery_albums_i18n', $data_locale);




        return $lid;
    }

    function update_album($id, $data = array()) {
        $this->db->where('id', $id);
        $this->db->update('gallery_albums', $data);
    }

    function getTotalImages() {
        $query = $this->db->get('gallery_images')->result_array();
        return count($query);
    }

    function delete_album($id) {
        // delete album
        $this->db->where('id', $id);
        $this->db->delete('gallery_albums');
        $this->db->where('id', $id);
        $this->db->delete('gallery_albums_i18n');

        // delete images
        $ids = $this->db->where('album_id', $id)->get('gallery_images')->row_array();
        $this->db->where('album_id', $id);
        $this->db->delete('gallery_images');

        foreach ($ids as $i) {
            $this->db->where('album_id', $i->id);
            $this->db->delete('gallery_images_i18n');
        }
    }

    /**
     * Get all albums
     */
    function get_albums($order_by = 'date', $sort_order = 'desc', $category_id = 0) {
        // Select albums

        $locale = $this->chose_locale();
        $this->joinI18n($this->db, 'gallery_albums', $locale);
        if ($category_id > 0) {
            $this->db->where('gallery_albums.category_id', $category_id);
        }

        $this->db->select('gallery_albums.*, gallery_albums_i18n.name as name, gallery_albums_i18n.description as description');
        $this->db->select('gallery_images.file_name as cover_name', FALSE);
        $this->db->select('gallery_images.file_ext as cover_ext', FALSE);
        $this->db->join('gallery_images', 'gallery_images.id = gallery_albums.cover_id', 'left');

        // Subquery. album views.
        $this->db->select('(SELECT SUM(gallery_images.views) FROM gallery_images WHERE gallery_images.album_id = gallery_albums.id) AS views');

        // Subquery. album image count.
        $this->db->select('(SELECT COUNT(gallery_images.file_name) FROM gallery_images WHERE gallery_images.album_id = gallery_albums.id) AS count');

        if ($sort_order != 'desc' AND $sort_order != 'asc') {
            $sort_order = 'desc';
        }

        switch ($order_by) {
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

        // echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_last_image($album_id) {
        $this->db->order_by('uploaded', 'desc');
        $this->db->where('album_id', $album_id);
        $query = $this->db->get('gallery_images', 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    /**
     * Get Album info
     */
    function get_album($id = 0, $include_images = TRUE, $limit, $page, $locale = null) {
        if (null === $locale)
            $locale = $this->chose_locale();
        $this->db->limit(1);
        $this->db->where('gallery_albums.id', $id);
        $this->joinI18n($this->db, 'gallery_albums', $locale);
        $this->db->select('*, gallery_albums.id as id');
        $query = $this->db->get('gallery_albums');

        if ($query->num_rows() > 0) {
            $album = $query->row_array();

            if ($include_images == TRUE) {
                $album['images'] = $this->get_album_images($album['id'], $limit, $page, $locale);
                $album['count'] = $this->db->query("SELECT COUNT(file_name) AS count FROM gallery_images WHERE album_id = $id")->row()->count;
            }
            return $album;
        } else {
            return FALSE;
        }
    }

    function get_album_images($album_id, $limit, $ofset, $locale) {
        //$this->db->order_by('uploaded', 'asc');

        $this->db->select('*, gallery_images.id as id');
        $this->joinI18n($this->db, 'gallery_images', $locale);
        $this->db->select('CONCAT_WS("", file_name, file_ext) as full_name', FALSE);
        $this->db->order_by('position', 'asc');
        $this->db->where('album_id', $album_id);
        if (($limit) || ($ofset))
            $this->db->limit($limit, $ofset);
        $query = $this->db->get('gallery_images');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function set_album_cover($album_id, $image_id) {
        $this->db->where('id', $album_id);
        $this->db->update('gallery_albums', array('cover_id' => $image_id));
    }

    // --------------------------------------------------------------------

    function add_image($data = array()) {
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

    function get_image_info($id, $locale = null) {

        if (null === $locale)
            $locale = $this->chose_locale();

        $this->db->limit(1);
        $this->joinI18n($this->db, 'gallery_images', $locale);
        $this->db->select('*, gallery_images.id as id');
        $this->db->where('gallery_images.id', $id);
        $query = $this->db->get('gallery_images');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    function increase_image_views($id) {
        $this->db->limit(1);
        $this->db->set('views', 'views + 1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('gallery_images');
    }

    function rename_image($id, $name) {
        $this->db->where('id', $id);
        $this->db->update('gallery_images', array('file_name' => $name));
    }

    function delete_image($id) {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->delete('gallery_images');
    }

    function update_description($id, $text, $locale) {

        if ($this->db->where('id', $id)->where('locale', $locale)->get('gallery_images_i18n')->num_rows()) {
            $this->db->where('id', $id)->where('locale', $locale);
            $this->db->update('gallery_images_i18n', array('description' => $text));
        }
        else
            $this->db->insert('gallery_images_i18n', array('id' => $id, 'locale' => $locale, 'description' => $text));
    }

    function update_position($id, $position = 0) {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->update('gallery_images', array('position' => $position));
    }

    // --------------------------------------------------------------------

    function create_category($data = array()) {
        $this->db->insert('gallery_category', $data);
        return $this->db->insert_id();
    }

    function get_category($id, $locale = null) {
        if (null === $locale)
            $locale = $this->chose_locale();
        $this->db->limit(1);
        $this->db->where('gallery_category.id', $id);
        $this->db->select('*, gallery_category.id as id');
        $this->joinI18n($this->db, 'gallery_category', $locale);
        $query = $this->db->get('gallery_category');

        if ($query->num_rows() == 1)
            return $query->row_array();
        else
            return FALSE;
    }

    function joinI18n($con, $table, $locale) {
        $con->join($table . '_i18n', $table . "_i18n.id = " . $table . ".id and " . $table . "_i18n.locale = '" . $locale . "'", 'left');
        return $con;
    }

    function chose_locale() {

        $url = $this->uri->uri_string();
        $url_arr = explode('/', $url);

        $languages = $this->db->get('languages')->result_array();
        //echo $this->db->last_query();
        foreach ($languages as $l)
            if (in_array($l['identif'], $url_arr))
                $lang = $l['identif'];


        if (!$lang) {
            $languages = $this->db->where('default', 1)->get('languages')->row();
            $lang = $languages->identif;
        }

        return $lang;
    }

    function get_categories($order_by = 'name', $sort_order = 'desc') {
        if ($sort_order != 'desc' AND $sort_order != 'asc') {
            $sort_order = 'desc';
        }

        $locale = $this->chose_locale();
        $this->joinI18n($this->db, 'gallery_category', $locale);
        $this->db->select('*, gallery_category.id as id, gallery_category_i18n.name as name');

        switch ($order_by) {
            case 'date':
                $this->db->order_by('created', $sort_order);
                break;

            case 'name':
                $this->db->order_by('gallery_category_i18n.name', $sort_order);
                break;

            case 'position':
                $this->db->order_by('position', $sort_order);
                break;
        }

        $query = $this->db->get('gallery_category');

        if (!$query)
            return FALSE;

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function update_category($data = array(), $id) {
        $this->db->limit(1);
        $this->db->where('id', $id);

        $this->db->update('gallery_category', $data);
    }

    function delete_category($id) {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->delete('gallery_category');
        $this->db->where('id', $id);
        $this->db->delete('gallery_category_i18n');
    }

}

/* End of file gallery_m.php */

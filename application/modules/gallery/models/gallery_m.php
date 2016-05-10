<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Gallery main model
 */
class Gallery_m extends CI_Model
{

    public function Base() {
        parent::__construct();
    }

    public function load_settings() {
        $this->db->select('settings');
        $query = $this->db->get_where('components', ['name' => 'gallery'])->row_array();

        return unserialize($query['settings']);
    }

    /**
     * Create new album
     */
    public function create_album() {
        $locale = $this->chose_locale();
        $this->db->select_max('position');
        $pos = $this->db->get('gallery_albums')->row_array();

        // Increase album position
        $data['position'] = $pos['position'] + 1;

        $data = [
            //'name' => $this->input->post('name'),
            //'description' => trim($this->input->post('description')),
                 'created'     => time(),
                 'category_id' => $this->input->post('category_id'),
                 'tpl_file'    => $this->input->post('tpl_file'),
                ];

        $this->db->insert('gallery_albums', $data);
        $lid = $this->db->insert_id();

        $data_locale = [
                        'id'          => $lid,
                        'locale'      => $locale,
                        'name'        => $this->input->post('name'),
                        'description' => trim($this->input->post('description')),
                       ];

        $this->db->insert('gallery_albums_i18n', $data_locale);

        return $lid;
    }

    public function update_album($id, $data = []) {
        $this->db->where('id', $id);
        $this->db->update('gallery_albums', $data);
    }

    public function getTotalImages() {
        $query = $this->db->get('gallery_images')->result_array();
        return count($query);
    }

    public function delete_album($id) {
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
     * @param string $order_by
     * @param string $sort_order
     * @param int $category_id
     * @return bool
     */
    public function get_albums($order_by = 'date', $sort_order = 'desc', $category_id = 0) {
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
                $this->db->order_by('gallery_albums_i18n.name', $sort_order);
                break;

            case 'position':
                $this->db->order_by('position', $sort_order);
                break;
        }

        $query = $this->db->get('gallery_albums');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function get_last_image($album_id) {
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
     * @param int $id
     * @param bool $include_images
     * @param integer $limit
     * @param integer $page
     * @param null|string $locale
     * @return bool
     */
    public function get_album($id = 0, $include_images = TRUE, $limit, $page, $locale = null) {
        if (null === $locale) {
            $locale = $this->chose_locale();
        }
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

    /**
     *
     * @param integer $album_id
     * @param integer $limit
     * @param integer $offset
     * @param string $locale
     * @return false|array
     */
    public function get_album_images($album_id, $limit, $offset, $locale) {
        //$this->db->order_by('uploaded', 'asc');

        $this->db->select('*, gallery_images.id as id');
        $this->joinI18n($this->db, 'gallery_images', $locale);
        $this->db->select('CONCAT_WS("", file_name, file_ext) as full_name', FALSE);
        $this->db->order_by('position', 'asc');
        $this->db->where('album_id', $album_id);
        if ($limit || $offset) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('gallery_images');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /**
     * @param int $album_id
     * @param int $image_id
     */
    public function set_album_cover($album_id, $image_id) {
        $this->db->where('id', $album_id);
        $this->db->update('gallery_albums', ['cover_id' => $image_id]);
    }

    // --------------------------------------------------------------------

    /**
     * @param array $data
     * @return int
     */
    public function add_image($data = []) {
        $this->db->select_max('position');
        $pos = $this->db->get('gallery_images')->row_array();

        // Increase position
        $data['position'] = $pos['position'] + 1;

        $this->db->insert('gallery_images', $data);

        // Update album date
        $this->db->where('id', $data['album_id']);
        $this->db->update('gallery_albums', ['updated' => time()]);

        return $this->db->insert_id();
    }

    /**
     * @param int $id
     * @param null|string $locale
     * @return bool
     */
    public function get_image_info($id, $locale = null) {

        if (null === $locale) {
            $locale = $this->chose_locale();
        }

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

    /**
     * @param int $id
     */
    public function increase_image_views($id) {
        $this->db->limit(1);
        $this->db->set('views', 'views + 1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('gallery_images');
    }

    /**
     * @param int $id
     * @param string $name
     */
    public function rename_image($id, $name) {
        $this->db->where('id', $id);
        $this->db->update('gallery_images', ['file_name' => $name]);
    }

    /**
     * @param int $id
     */
    public function delete_image($id) {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->delete('gallery_images');

        $this->db->where('id', $id);
        $this->db->delete('gallery_images_i18n');
    }

    /**
     * @param int $id
     * @param array $data
     * @param string $locale
     */
    public function update_description($id, $data, $locale) {

        if ($this->db->where('id', $id)->where('locale', $locale)->get('gallery_images_i18n')->num_rows()) {
            $this->db->where('id', $id)->where('locale', $locale);
            $this->db->update('gallery_images_i18n', ['description' => $data['description'], 'title' => $data['title']]);
        } else {
            $this->db->insert('gallery_images_i18n', ['id' => $id, 'locale' => $locale, 'title' => $data['title'], 'description' => $data['description']]);
        }
    }

    public function update_position($id, $position = 0) {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->update('gallery_images', ['position' => $position]);
    }

    // --------------------------------------------------------------------

    public function create_category($data = []) {
        $this->db->insert('gallery_category', $data);
        return $this->db->insert_id();
    }

    public function get_category($id, $locale = null) {
        if (null === $locale) {
            $locale = $this->chose_locale();
        }
        $this->db->limit(1);
        $this->db->where('gallery_category.id', $id);
        $this->db->select('*, gallery_category.id as id');
        $this->joinI18n($this->db, 'gallery_category', $locale);
        $query = $this->db->get('gallery_category');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    /**
     * @param CI_DB_mysqli_driver|CI_DB_mysql_driver $con
     * @param string $table
     * @param string $locale
     * @return CI_DB_mysql_driver|CI_DB_mysqli_driver
     */
    public function joinI18n($con, $table, $locale) {
        $con->join($table . '_i18n', $table . '_i18n.id = ' . $table . '.id and ' . $table . "_i18n.locale = '" . $locale . "'", 'left');
        return $con;
    }

    /**
     * @return string
     */
    public function chose_locale() {
        return MY_Controller::getCurrentLocale();
    }

    public function get_categories($order_by = 'name', $sort_order = 'desc') {
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

        if (!$query) {
            return FALSE;
        }

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function update_category($data = [], $id) {
        $this->db->limit(1);
        $this->db->where('id', $id);

        $this->db->update('gallery_category', $data);
    }

    public function delete_category($id) {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->delete('gallery_category');
        $this->db->where('id', $id);
        $this->db->delete('gallery_category_i18n');
    }

}

/* End of file gallery_m.php */
<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Gallery module
 * Need Imagebox module
 * @property Gallery_m $gallery_m
 */
class Gallery extends MY_Controller {

    public $conf = array(
        'upload_url' => 'uploads/gallery/',
        'thumbs_folder' => '_thumbs',
    );

    private $settings = array();

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('gallery');

        $this->load->module('core');
        $this->load->model('gallery_m');

        // Load gallery settings
        $this->settings = $this->gallery_m->load_settings();
        $this->load->helper('gallery');
    }

    public function autoload() {

    }

    /**
     * List categories and get albums from first category
     */
    public function index() {
        $this->core->set_meta_tags(lang('Gallery', 'gallery'));

        $categories = $this->gallery_m->get_categories($this->settings['order_by'], $this->settings['sort_order']);
        $albums = $this->gallery_m->get_albums($this->settings['order_by'], $this->settings['sort_order']);

        $data = array(
            'gallery_category' => $categories,
            'total' => $this->gallery_m->getTotalImages(),
            'categories' => $categories
        );

        // Get covers
        $data['albums'] = is_array($albums) ? $this->create_albums_covers($albums) : NULL;

        \CMSFactory\assetManager::create()
                ->setData($data)
                ->registerStyle('style', FAlSE)
                ->render('index');
    }

    public function albums() {
        $this->core->set_meta_tags(lang('Gallery', 'gallery'));

        $categories = $this->gallery_m->get_categories($this->settings['order_by'], $this->settings['sort_order']);
        $albums = $this->gallery_m->get_albums($this->settings['order_by'], $this->settings['sort_order']);

        $data = array(
            'gallery_category' => $categories,
            'total' => $this->gallery_m->getTotalImages()
        );

        // Get covers
        $data['albums'] = is_array($albums) ? $this->create_albums_covers($albums) : NULL;

        \CMSFactory\assetManager::create()
                ->setData($data)
                ->registerStyle('style', FAlSE)
                ->render('albums');
    }

    /**
     * Display category albums
     */
    public function category($id = 0) {
        $this->core->set_meta_tags(lang('Gallery', 'gallery'));

        $category = $this->gallery_m->get_category($id);

        if ($category === FALSE) {
            redirect('gallery');
        } else {
            $albums = $this->gallery_m->get_albums($this->settings['order_by'], $this->settings['sort_order'], $category['id']);

            if ($albums !== FALSE) {
                $albums = $this->create_albums_covers($albums);
            }

            $data = array(
                'albums' => $albums,
                'current_category' => $category,
                'gallery_category' => $this->gallery_m->get_categories($this->settings['order_by'], $this->settings['sort_order']),
            );

            \CMSFactory\assetManager::create()
                    ->setData($data)
                    ->render('albums');
        }
    }

    // Display album images

    public function album($id = 0) {
        if (preg_match("/[A-Z]/", $this->uri->uri_string())) {
            redirect(site_url(strtolower($this->uri->uri_string())), 'location', 301);
        }

        $album = $this->gallery_m->get_album($id);
        if ($this->uri->total_segments() > 5) {
            $params = $this->uri->uri_to_assoc(5);
        } else {
            $params = $this->uri->uri_to_assoc(4);
        }

        if ($album == FALSE) {
            $this->core->error_404();
        }

        if ($params['image'] > 0) {
            $n = 0;
            foreach ($album['images'] as $image) {
                if ($image['id'] == $params['image']) {
                    $prev_img = $image;

                    // Create prev/next links
                    $next = $album['images'][$n + 1];
                    $prev = $album['images'][$n - 1];

                    $current_pos = $n + 1;
                }
                $n++;
            }
        } else {
            // Display first image prev
            $prev_img = $album['images'][0];

            $next = $album['images'][1];
            $prev = NULL;
            $current_pos = 1;
        }

        if ($prev_img == NULL) {
            $this->core->error_404();
            exit;
        }

            $prev_img['url'] = $this->conf['upload_url'] . $album['id'] . '/' . $prev_img['file_name'] . '_prev' . $prev_img['file_ext'];

            $data = array(
            'album' => $album,
            'thumb_url' => $this->conf['upload_url'] . $album['id'] . '/' . $this->conf['thumbs_folder'] . '/',
            'album_link' => 'gallery/album/' . $album['id'] . '/',
            'album_url' => $this->conf['upload_url'] . $album['id'] . '/',
            'prev_img' => $prev_img,
            'next' => $next,
            'prev' => $prev,
            'current_pos' => $current_pos,
            'current_category' => $this->gallery_m->get_category($album['category_id']),
            'gallery_category' => $this->gallery_m->get_categories($this->settings['order_by'], $this->settings['sort_order']),
            );

            $this->gallery_m->increase_image_views($prev_img['id']);
            $this->core->set_meta_tags(array($album['name']));

            \CMSFactory\assetManager::create()
                ->setData($data)
                ->registerStyle('jquery.fancybox-1.3.4', FAlSE)
                ->registerStyle('style', FAlSE)
                ->registerScript('jquery.fancybox-1.3.4.pack', TRUE)
                ->registerScript('jquery.easing-1.3.pack', TRUE)
                ->registerScript('jquery.mousewheel-3.0.4.pack', TRUE)
                ->render($album['tpl_file'] ? : 'album');
    }

    public function thumbnails($id = 0, $page = 0) {
        if (preg_match("/[A-Z]/", $this->uri->uri_string())) {
            redirect(site_url(strtolower($this->uri->uri_string())), 'location', 301);
        }

        $album = $this->gallery_m->get_album($id, true, 15, $page * 15);

        if ($album == FALSE) {
            $this->core->error_404();
            exit;
        }
        $this->load->library('Pagination');
        $this->pagination = new \CI_Pagination();
        $galleryThumbnailsPagination['uri_segment'] = 4;
        $galleryThumbnailsPagination['base_url'] = site_url('gallery/thumbnails/' . $id);
        $galleryThumbnailsPagination['page_query_string'] = false;
        $galleryThumbnailsPagination['total_rows'] = ceil($album[count] / 15);
        $galleryThumbnailsPagination['last_link'] = ceil($album[count] / 15);
        $galleryThumbnailsPagination['per_page'] = 1;
        include_once "./templates/{$this->config->item('template')}/paginations.php";

        $this->pagination->initialize($galleryThumbnailsPagination);

        $data = array(
            'album' => $album,
            'thumb_url' => $this->conf['upload_url'] . $album['id'] . '/' . $this->conf['thumbs_folder'] . '/',
            'album_link' => 'gallery/album/' . $album['id'] . '/',
            'album_url' => $this->conf['upload_url'] . $album['id'] . '/',
            'current_category' => $this->gallery_m->get_category($album['category_id']),
            'pagination' => $this->pagination->create_links(),
        );

        $this->core->set_meta_tags(array($album['name']));

        \CMSFactory\assetManager::create()
                ->setData($data)
                ->render('thumbnails');
    }

    public function post_comment() {
        $image_id = (int) $this->input->post('comment_item_id');

        $this->load->module('comments');
        $this->comments->module = 'gallery';

        if ($this->db->get_where('gallery_images', array('id' => $image_id))->num_rows() > 0) {
            $this->comments->add($image_id);
        } else {
            $this->core->error_404();
        }
    }

    // Create cover url to each album

    public function create_albums_covers($albums = array()) {
        $cnt = count($albums);
        for ($i = 0; $i < $cnt; $i++) {
            $thumb_url = '/' . $this->conf['upload_url'] . $albums[$i]['id'] . '/' . $this->conf['thumbs_folder'] . '/';

            $albums[$i]['cover_url'] = $thumb_url . $albums[$i]['cover_name'] . $albums[$i]['cover_ext'];

            if ($albums[$i]['cover_name'] == NULL) {
                $image = $this->gallery_m->get_last_image($albums[$i]['id']);

                $albums[$i]['cover_url'] = $thumb_url . $image['file_name'] . $image['file_ext'];
            } else {
                $albums[$i]['cover_url'] = $thumb_url . $albums[$i]['cover_name'] . $albums[$i]['cover_ext'];
            }
        }

        return $albums;
    }

    // Install

    public function _install() {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }
        $this->load->model('install')->make_install();
    }

    // Delete module

    public function _deinstall() {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }
        $this->load->model('install')->deinstall();
    }

    /**
     * Fetch template file
     */
    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file gallery.php */
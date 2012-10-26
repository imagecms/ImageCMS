<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * ImageCMS
 *
 * Gallery Module _Admin_
 */
class Admin extends MY_Controller {

    // Gallery config
    public $conf = array(
        'engine' => 'gd2', // Image library. Possible values: GD, GD2, ImageMagick, NetPBM 
        'max_file_size' => 5, // Max file size for upload in Mb.
        'max_archive_size' => 50,
        'max_width' => 0, // Max image width.
        'max_height' => 0, // Max image height.
        'allowed_types' => 'gif|jpg|jpeg|png|zip', // Allowed image types.
        'allowed_archive_types' => 'zip',
        'upload_path' => './uploads/gallery/', // Image upload dir. With ending slash.
        'upload_url' => 'uploads/gallery/', // Image upload url. With ending slash.
        'cache_path' => './system/cache/',
        'quality' => '90%', // Image quality
        'thumb_width' => '100', // Thumb width. min. 20px; max 1000px;
        'thumb_height' => '100', // Thumb height min. 20px; max 1000px;
        'thumb_marker' => '', // Thumb suffix
        'thumbs_folder' => '_thumbs', // Thumbs folder name. ! Without ending slash.
        'prev_img_marker' => '_prev', // Preview image suffix
        'maintain_ratio' => TRUE, // Specifies whether to maintain the original aspect ratio when resizing. 
        'maintain_ratio_prev' => TRUE, // Specifies whether to maintain the original aspect ratio when resizing prev image. 
        'maintain_ratio_icon' => TRUE, // Specifies whether to maintain the original aspect ratio when resizing icon.
        'crop' => TRUE, // Specifies whether to crop image for save the original aspect ratio when resizing.
        'crop_prev' => TRUE, // Specifies whether to crop image for save the original aspect ratio when resizing prev image.
        'crop_icon' => TRUE, // Specifies whether to crop image for save the original aspect ratio when resizing icon. 
        'prev_img_width' => '500', // Preview image width
        'prev_img_height' => '375', // Preview image height
        // Watermark params
        'watermark_text' => '', // Watermark text.
        'watermark_image' => '', // Path to watermark image.
        'watermark_image_opacity' => '', // Watermark image opacity.
        'watermark_type' => 'overlay', // Watermark type. Possible values: text/overlay.
        'wm_vrt_alignment' => 'bottom', // Watermark vertical position. Possible values: top, middle, bottom.
        'wm_hor_alignment' => 'right', // Watermark horizontal position. Possible values: left, center, right. 
        'watermark_font_path' => './system/fonts/1.ttf', // Path to watermark font.
        'watermark_font_size' => 16, // Watermark font size.
        'watermark_padding' => '-5', // Watermark padding.
        'watermark_color' => 'ffffff', // Watermark font color.
        'watermark_min_width' => '250', // Min. image width to draw watermark.
        'watermark_min_height' => '250', // Min. image height to draw watermark.
        // Albums
        'order_by' => 'date', // Albums order. Posiible values: date/name/position.
        'sort_order' => 'desc'          // Sort order. Possible values: desc/asc.
    );
    protected $lastnewid;

    public function __construct() {
        parent::__construct();

        if ($this->dx_auth->is_admin() == FALSE)
            exit;

        $this->load->model('gallery_m');
        $this->init_settings();

        $this->test_uploads_folder($this->conf['upload_path']);
    }

    /**
     * Test if gallery upload folder exists.
     */
    private function test_uploads_folder($path) {
        if (!file_exists($path)) {
            @mkdir($path);
            @chmod($path, 0777);
        }

        if (!is_really_writable($this->conf['upload_path']) OR !file_exists($this->conf['upload_path'])) {
            $this->template->add_array(array(
                'error' => lang('amt_delete_folder_to_continue') . $this->conf['upload_path'] . lang('amt_write_perm')
            ));

            $this->display_tpl('error');

            exit;
        }
    }

    /**
     * Load gallery settings
     */
    private function init_settings() {
        $settings = $this->gallery_m->load_settings();

        foreach ($settings as $k => $v) {
            $this->conf[$k] = $v;
        }

        return TRUE;
    }

    /**
     * Display categories list
     */
    public function index() {
        $categories = $this->gallery_m->get_categories('position', 'asc');
        $albums = $this->gallery_m->get_albums($this->conf['order_by'], $this->conf['sort_order']);

        if ($categories !== FALSE) {
            $cnt = count($categories);
            for ($i = 0; $i < $cnt; $i++) {
                $categories[$i]['albums_count'] = 0;

                if ($albums !== FALSE)
                    foreach ($albums as $album) {
                        if ($album['category_id'] == $categories[$i]['id']) {
                            $categories[$i]['albums_count']++;
                        }
                    }
            }
        }

        $this->template->add_array(array(
            'categories' => $categories,
            'albums' => $albums,
        ));

        $this->display_tpl('categories');
    }

    /**
     * Display category albums
     */
    public function category($id) {
        $albums = $this->gallery_m->get_albums('position', 'asc', $id);

        if ($albums != FALSE) {
            $cnt = count($albums);

            for ($i = 0; $i < $cnt; $i++) {
                // Create url to album cover
                $albums[$i]['cover_url'] = media_url($upload_url . $albums[$i]['id'] . '/_admin_thumbs/' . $albums[$i]['cover_name'] . $albums[$i]['cover_ext']);

                $upload_url = $this->conf['upload_url'];

                if ($albums[$i]['cover_name'] == NULL) {
                    $image = $this->gallery_m->get_last_image($albums[$i]['id']);

                    if ($image != FALSE) {
                        $albums[$i]['cover_url'] = media_url($upload_url . $albums[$i]['id'] . '/_admin_thumbs/' . $image['file_name'] . $image['file_ext']);
                    } else {
                        $albums[$i]['cover_url'] = 'empty';
                    }
                } else {
                    $albums[$i]['cover_url'] = media_url($upload_url . $albums[$i]['id'] . '/_admin_thumbs/' . $albums[$i]['cover_name'] . $albums[$i]['cover_ext']);
                }
            }

            $this->template->add_array(array(
                'albums' => $albums
            ));
        }

        $this->template->add_array(array(
            'category' => $this->gallery_m->get_category($id)
        ));

        $this->display_tpl('album_list');
    }

    /**
     * Display settings.tpl and update seetings.
     */
    public function settings($action = 'show') {
        switch ($action) {
            case 'show':
                $this->template->assign('settings', $this->gallery_m->load_settings());

                $this->display_tpl('settings');
                break;

            case 'update':

                $this->load->library('Form_validation');
                $val = $this->form_validation;

                $val->set_rules('max_file_size', lang('amt_file_size'), 'required|is_natural');
                $val->set_rules('max_width', lang('amt_max_width'), 'required|is_natural');
                $val->set_rules('max_height', lang('amt_max_height'), 'required|is_natural');
                $val->set_rules('quality', lang('amt_quality'), 'required|is_natural');
                $val->set_rules('prev_img_width', lang('amt_previmage_width'), 'required|is_natural');
                $val->set_rules('prev_img_height', lang('amt_previmage_height'), 'required|is_natural');
                $val->set_rules('thumb_width', lang('amt_col_width'), 'required|is_natural');
                $val->set_rules('thumb_height', lang('amt_col_height'), 'required|is_natural');
                $val->set_rules('watermark_text', lang('amt_watermark_text'), 'max_length[100]');
                $val->set_rules('watermark_font_size', lang('amt_font_size'), 'required|is_natural');
                $val->set_rules('watermark_image_opacity', lang('amt_transparency'), 'required|is_natural|min_length[1]|max_length[3]');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors(), false, 'r');
                    return FALSE;
                }

                // Check if watermark image exists.
                if ($_POST['watermark_type'] == 'overlay' AND !file_exists($_POST['watermark_image'])) {
                    showMessage(lang('amt_select_correct_path_to_image'), false, 'r');
                    return FALSE;
                }

                // Check if watermark font exists.
                if ($_POST['watermark_type'] == 'text' AND !file_exists($_POST['watermark_font_path'])) {
                    showMessage(lang('amt_select_correct_path_to_font'), false, 'r');
                    return FALSE;
                }

                $params = array(
                    'max_file_size' => $this->input->post('max_file_size'),
                    'max_width' => $this->input->post('max_width'),
                    'max_height' => $this->input->post('max_height'),
                    'quality' => $this->input->post('quality'),
                    'maintain_ratio' => (bool) $this->input->post('maintain_ratio'),
                    'maintain_ratio_prev' => (bool) $this->input->post('maintain_ratio_prev'),
                    'maintain_ratio_icon' => (bool) $this->input->post('maintain_ratio_icon'),
                    'crop' => (bool) $this->input->post('crop'),
                    'crop_prev' => (bool) $this->input->post('crop_prev'),
                    'crop_icon' => (bool) $this->input->post('crop_icon'),
                    'prev_img_width' => $this->input->post('prev_img_width'),
                    'prev_img_height' => $this->input->post('prev_img_height'),
                    'thumb_width' => $this->input->post('thumb_width'),
                    'thumb_height' => $this->input->post('thumb_height'),
                    // watermark settings
                    'watermark_text' => trim($this->input->post('watermark_text')),
                    'wm_vrt_alignment' => $this->input->post('wm_vrt_alignment'),
                    'wm_hor_alignment' => $this->input->post('wm_hor_alignment'),
                    'watermark_font_size' => trim($this->input->post('watermark_font_size')),
                    'watermark_color' => trim($this->input->post('watermark_color')),
                    'watermark_padding' => trim($this->input->post('watermark_padding')),
                    'watermark_font_path' => trim($this->input->post('watermark_font_path')),
                    'watermark_image' => trim($this->input->post('watermark_image')),
                    'watermark_image_opacity' => trim($this->input->post('watermark_image_opacity')),
                    'watermark_type' => trim($this->input->post('watermark_type')),
                    'order_by' => $this->input->post('order_by'),
                    'sort_order' => $this->input->post('sort_order'),
                );

                $this->db->where('name', 'gallery');
                $this->db->update('components', array('settings' => serialize($params)));

                showMessage(lang('amt_settings_saved'));

                break;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Create album
     */
    public function create_album() {
        $this->load->library('Form_validation');

        $this->form_validation->set_rules('name', lang('amt_name'), 'required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('email', lang('amt_description'), 'max_length[500]');
        $this->form_validation->set_rules('category_id', lang('amt_category'), 'required');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $album_id = $this->gallery_m->create_album();

            // Create album folder
            mkdir($this->conf['upload_path'] . $album_id);

            // Create thumbs folder
            mkdir($this->conf['upload_path'] . $album_id . '/' . $this->conf['thumbs_folder']);

            // Create folder for admin thumbs 
            mkdir($this->conf['upload_path'] . $album_id . '/_admin_thumbs');

            showMessage('Альбом создан');

            pjax(site_url('admin/components/cp/gallery/edit_album_params/' . $album_id));
        }
    }

    /**
     * Update album info
     */
    public function update_album($id) {
        $this->form_validation->set_rules('name', lang('a_name'), 'required');
        if ($this->form_validation->run() == false) {
            showMessage(validation_errors(), '', 'r');
            exit();
        } else {
            showMessage(lang('amt_changes_saved'));
        }
        $data = array(
            'category_id' => (int) $this->input->post('category_id'),
            'name' => $this->input->post('name'),
            'description' => trim($this->input->post('description')),
            'position' => (int) $this->input->post('position'),
            'tpl_file' => $this->input->post('tpl_file')
        );

        $this->gallery_m->update_album($id, $data);

        $album = $this->gallery_m->get_album($id);

        $_POST['action'] ? $action = $_POST['action'] : $action = 'edit';

        if ($action == 'edit')
            pjax('/admin/components/cp/gallery/edit_album_params/' . $category . $id);

        if ($action == 'close')
            pjax('/admin/components/cp/gallery/category/' . $album['category_id']);
    }

    public function edit_album_params($id) {
        $album = $this->gallery_m->get_album($id);

        if ($album != FALSE) {
            $this->template->add_array(array(
                'album' => $album,
                'categories' => $this->gallery_m->get_categories($album['category_id']),
            ));

            $this->display_tpl('album_params');
        } else {
            show_error(lang('amt_cant_load_album_info'));
        }
    }

    /**
     * Delete album
     */
    public function delete_album($id = FALSE) {
        if ($id == FALSE) {
            $id = (int) $this->input->post('album_id');
        }

        $album = $this->gallery_m->get_album($id);

        if ($album != FALSE) {
            if ($this->input->post('delete_folder') == TRUE) {
                $this->load->helper('file');

                // delete images.
                delete_files($this->conf['upload_path'] . $album['id'], TRUE);

                // delete album dir.
                rmdir($this->conf['upload_path'] . $album['id']);
            }
            $this->gallery_m->delete_album($album['id']);
            echo 'deleted';
            exit;
        } else {
            showMessage(lang('amt_cant_load_album_info'));
        }
    }

    /**
     * Display create_album template
     */
    public function show_crate_album() {
        // Select only category id and name for selectbox
        $this->db->select('id, name');
        $cats = $this->gallery_m->get_categories();

        $this->template->add_array(array(
            'categories' => $cats,
        ));

        $this->display_tpl('create_album');
    }

    /**
     * Show edit album template
     */
    public function edit_album($id = 0) {
        $album = $this->gallery_m->get_album($id);

        $this->template->add_array(array(
            'album' => $album,
            'category' => $this->gallery_m->get_category($album['category_id']),
            'album_url' => $this->conf['upload_url'] . $id
        ));

        $this->display_tpl('edit_album');
    }

    // --------------------------------------------------------------------

    public function edit_image($id) {
        $image = $this->gallery_m->get_image_info($id);

        if ($image != FALSE) {
            $album = $this->gallery_m->get_album($image['album_id'], FALSE);

            $this->template->add_array(array(
                'image' => $image,
                'album' => $album,
                'category' => $this->gallery_m->get_category($album['category_id']),
                'album_url' => $this->conf['upload_url'] . $album['id']
            ));

            $this->display_tpl('edit_image');
        } else {
            show_error(lang('amt_cant_load_image_info'));
        }
    }

    /**
     * Rename image
     */
    public function rename_image($id) {
        $image = $this->gallery_m->get_image_info($id);

        if ($image != FALSE) {
            $this->load->library('Form_validation');

            $this->form_validation->set_rules('new_name', lang('amt_name'), 'trim|required|alpha_dash');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), false, 'r');
            } else {
                $album = $this->gallery_m->get_album($image['album_id'], FALSE);
                $new_name = $this->input->post('new_name');

                $file_path = $this->conf['upload_path'] . $album['id'] . '/';

                // Rename original file
                rename($file_path . $image['file_name'] . $image['file_ext'], $file_path . $new_name . $image['file_ext']);

                // Rename preview file
                rename($file_path . $image['file_name'] . $this->conf['prev_img_marker'] . $image['file_ext'], $file_path . $new_name . $this->conf['prev_img_marker'] . $image['file_ext']);

                // Rename thumb
                rename($file_path . $this->conf['thumbs_folder'] . '/' . $image['file_name'] . $image['file_ext'], $file_path . $this->conf['thumbs_folder'] . '/' . $new_name . $image['file_ext']);

                // Rename admin thumb
                rename($file_path . '_admin_thumbs/' . $image['file_name'] . $image['file_ext'], $file_path . '_admin_thumbs/' . $new_name . $image['file_ext']);

                // Update file name in db
                $this->gallery_m->rename_image($id, $new_name);

                pjax('/admin/components/cp/gallery/edit_image/' . $image['id']);
                showMessage(lang('amt_changes_saved'));
            }
        } else {
            showMessage(lang('amt_cant_load_image_info'), false, 'r');
        }
    }

    /**
     * Delete image files
     */
    public function delete_image($ids = 0) {
        if ($this->input->post('id')) $ids = $this->input->post('id');
        foreach ($ids as $key => $id) {
            $image = $this->gallery_m->get_image_info($id);
            if ($image != FALSE) {
                $album = $this->gallery_m->get_album($image['album_id'], FALSE);
                $path = $this->conf['upload_path'] . $album['id'] . '/';

                // Delete image.
                unlink($path . $image['file_name'] . $image['file_ext']);

                // Delete thumb.
                unlink($path . $this->conf['thumbs_folder'] . '/' . $image['file_name'] . $image['file_ext']);

                // Delete preview file.
                unlink($path . $image['file_name'] . $this->conf['prev_img_marker'] . $image['file_ext']);

                // Delete admin thumb.
                unlink($path . '_admin_thumbs/' . $image['file_name'] . $image['file_ext']);

                // Delete image info.
                $this->gallery_m->delete_image($image['id']);
                showMessage(lang('a_photos_deleted'));
            }
        }
    }

    /**
     * Update image description/position
     */
    public function update_info($id) {
        $image = $this->gallery_m->get_image_info($id);

        if ($image != FALSE) {
            $album = $this->gallery_m->get_album($image['album_id'], FALSE);

            $this->gallery_m->update_description($id, trim($this->input->post('description')));

            $this->gallery_m->update_position($id, trim((int) $this->input->post('position')));

            if ($this->input->post('cover') == 1) {
                $this->gallery_m->set_album_cover($image['album_id'], $image['id']);
            } elseif ($this->input->post('cover') != 1 AND $album['cover_id'] == $image['id']) {
                $this->gallery_m->set_album_cover($image['album_id'], NULL);
            }

            //showMessage('Изменения сохранены');

            pjax('/admin/components/cp/gallery/edit_album/' . $image['album_id']);
        } else {
            showMessage(lang('amt_cant_load_image_info'), false, 'r');
        }
    }

    public function update_positions() {
        $positions = $this->input->post('positions');
        foreach ($positions as $key => $value) {
            $this->db->where('id', (int) $value)->set('position', $key)->update('gallery_category');
        }
        showMessage(lang('a_positions_updated'));
    }

    public function update_album_positions() {
        $positions = $this->input->post('positions');
        foreach ($positions as $key => $value) {
            $this->db->where('id', (int) $value)->set('position', $key)->update('gallery_albums');
        }
        showMessage(lang('a_positions_updated'));
    }

    public function update_img_positions() {
        $positions = $this->input->post('positions');
        foreach ($positions as $key => $value) {
            $this->db->where('id', (int) $value)->set('position', $key)->update('gallery_images');
        }
        showMessage(lang('a_positions_updated'));
    }

    /**
     * Add uploaded image to album
     */
    private function add_image($album_id = 0, $file_data = array()) {
        $this->load->helper('number');

        $size = $this->get_image_size($file_data['full_path']);

        $image_info = array(
            'album_id' => $album_id,
            'file_name' => $file_data['raw_name'],
            'file_ext' => $file_data['file_ext'],
            'file_size' => byte_format(filesize($file_data['full_path'])),
            'width' => $size['width'],
            'height' => $size['height'],
            'uploaded' => time(),
            'views' => 0
        );

        $this->gallery_m->add_image($image_info);
    }

    /**
     * Get image width and height
     */
    private function get_image_size($file_path) {
        if (function_exists('getimagesize')) {
            $image = @getimagesize($file_path);

            $size = array(
                'width' => $image[0],
                'height' => $image[1]
            );

            return $size;
        }

        return FALSE;
    }

    // --------------------------------------------------------------------
    // Categories
    // --------------------------------------------------------------------

    public function show_create_category() {
        $this->display_tpl('create_category');
    }

    public function create_category() {
        $this->load->library('Form_validation');
        $val = $this->form_validation;

        $val->set_rules('name', lang('amt_name'), 'trim|required|max_length[250]|min_length[1]');
        $val->set_rules('description', lang('amt_description'), 'max_length[500]');
        $val->set_rules('position', lang('amt_position'), 'numeric');

        if ($val->run() == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => trim($this->input->post('description')),
                'position' => $this->input->post('position'),
                'created' => time(),
            );

            $last_id = $this->gallery_m->create_category($data);

            //updateDiv('page', site_url('admin/components/cp/gallery'));

            $_POST['action'] ? $action = $_POST['action'] : $action = 'edit';

            if ($action == 'close')
                pjax('/admin/components/cp/gallery/index');
            if ($action == 'edit')
                pjax('/admin/components/cp/gallery/edit_category/' . $last_id);
        }
    }

    public function edit_category($id) {
        $category = $this->gallery_m->get_category($id);

        $this->template->add_array(array(
            'category' => $category
        ));

        $this->display_tpl('edit_category');
    }

    public function update_category($id) {
        $this->load->library('Form_validation');
        $val = $this->form_validation;

        $val->set_rules('name', lang('amt_name'), 'trim|required|max_length[250]|min_length[1]');
        $val->set_rules('description', lang('amt_description'), 'max_length[500]');
        $val->set_rules('position', lang('amt_position'), 'numeric');

        if ($val->run() == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => trim($this->input->post('description')),
                'position' => $this->input->post('position')
            );

            $this->gallery_m->update_category($data, $id);

            showMessage(lang('amt_changes_saved'));

            //updateDiv('page', site_url('admin/components/cp/gallery'));
            $_POST['action'] ? $action = $_POST['action'] : $action = 'edit';

            if ($action == 'close')
                pjax('/admin/components/cp/gallery/index');
            if ($action == 'edit')
                pjax('/admin/components/cp/gallery/edit_category/' . $id);
        }
    }

    public function delete_category() {
        foreach ($this->input->post('id') as $id) {
            //var_dump($id);
            // Delete category albums
            $albums = $this->gallery_m->get_albums('date', 'desc', $id);

            if (count($albums) > 0) {
                foreach ($albums as $album) {
                    $this->delete_album($album['id']);
                }
            }
            $this->gallery_m->delete_category($id);
        }
    }

    /**
     * Upload image
     *
     * Upload image to album folder. 
     *
     */
    public function upload_image($album_id = 0) {
        $temp_conf = $this->conf;

//         check if it's an atchive
// var_dump($_FILES);
// exit;
//         for ($i = 0; $i <= count($_FILES['file']['type']) - 1; $i++) {
// 			for ($i = 0; $i <= count($_FILES['file[]'])-1; $i++) {
        if (is_array($_FILES['newPic'])) {
            $i = 0;
            foreach ($_FILES['newPic']['name'] as $n) {
                //             if (in_array($_FILES['file']['type'][$i], array('application/x-zip', 'application/zip', 'application/x-zip-compressed', 'application/octet-stream'))) {
                //                 if ((count($_FILES['file']['type']) - 1) == 0) {
                //                     $this->upload_archive($album_id);
                //                     exit;
                //                 } else
                //                     continue;
                //             }

                $this->conf['upload_path'] = $this->conf['upload_path'] . $album_id;

                if (!is_dir($this->conf['upload_path']))
                    mkdir($this->conf['upload_path']);

                $config['upload_path'] = $this->conf['upload_path'];

                $config['allowed_types'] = $this->conf['allowed_types'];
                $config['max_size'] = 1024 * 1024 * $this->max_file_size;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('newPic', $i)) {
                    $data = array('error' => $this->upload->display_errors('', ''));
                } else {
                    $data[$i] = array('upload_data' => $this->upload->data());

                    // Resize Image and create thumb

                    $this->resize_and_thumb($data[$i]['upload_data']);

                    $this->add_image($album_id, $data[$i]['upload_data']);
                }
                $this->conf = $temp_conf;
                $i++;
            }
            if (isset($data['error']))
                showMessage($data['error']);
            else {
                showMessage('Upload success');
                pjax('');
            }
        }
    }

    public function upload_archive($album_id = 0) {

        $temp_directory = 'temp_' . MD5($album_id . time());
        $temp_path = $this->conf['cache_path'] . $temp_directory;
        $unpack_path = $this->conf['upload_path'] . $album_id;
        if (!file_exists($temp_path)) {
            @mkdir($temp_path);
            @chmod($temp_path, 0777);
        }

        if (!file_exists($unpack_path)) {
            @mkdir($unpack_path);
            @chmod($unpack_path, 0777);
        }
        //upload archive to temp folder

        $this->conf['upload_path'] = $this->conf['upload_path'] . $album_id . '/';

        $config['upload_path'] = $temp_path;
        $config['allowed_types'] = 'zip';
        $config['max_size'] = 1024 * 1024 * $this->conf['max_archive_size'];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $data = array('error' => $this->upload->display_errors('', ''));
        } else {
            $data = array('upload_data' => $this->upload->data());

            //extract pictures into temp_folder/unpacked

            $this->load->library('pclzip', $data['upload_data']['full_path']);
            $list = $this->pclzip->listContent();
            $file_list = array();
            foreach ($list as $item) {
                array_push($file_list, $item['filename']);
            }

            if (($zip_result = $this->pclzip->extract(PCLZIP_OPT_PATH, $unpack_path)) == 0) {

                delete_files($temp_path, TRUE);
                @unlink($data['upload_data']['full_path']);
                @rmdir($temp_path);
            } else {
                //scan directory and add all images to album

                if (!($dir = opendir($unpack_path))) {
                    
                }

                $album_data = $this->gallery_m->get_album($album_id);

                $album_images = array();
                if (is_array($album_data['images'])) {
                    foreach ($album_data['images'] as $image) {
                        array_push($album_images, $image['full_name']);
                    }
                }
                else
                    $album_data = array();
                //$this->load->library('image_lib');

                while ($file = readdir($dir)) {
                    if (($file != '.') && ($file != '..') && (in_array($file, $file_list))) {
                        if (get_mime_by_extension($file) == 'image/jpeg') {
                            $file_data = array();

                            $props = getimagesize($this->conf['upload_path'] . $file);

                            $file_data['file_name'] = $file;
                            $file_data['file_type'] = $props['mime'];
                            $file_data['file_path'] = $this->conf['upload_path'];
                            $file_data['full_path'] = $this->conf['upload_path'] . $file;
                            $file_data['file_ext'] = '';
                            if (strpos($file, '.jpg')) {
                                $file_data['raw_name'] = str_replace('.jpg', '', $file);
                                $file_data['file_ext'] = '.jpg';
                            } elseif (strpos($file, '.jpeg')) {
                                $file_data['raw_name'] = str_replace('.jpeg', '', $file);
                                $file_data['file_ext'] = '.jpeg';
                            }
                            $file_data['orig_name'] = $file;
                            $file_data['client_name'] = $file;
                            $file_data['file_size'] = '1';
                            $file_data['is_image'] = TRUE;
                            $file_data['image_width'] = $props[0];
                            $file_data['image_height'] = $props[1];
                            $file_data['image_type'] = '';
                            $file_data['image_size_str'] = $props[3];

                            // Resize Image and create thumb
                            $this->resize_and_thumb($file_data);
                            if (!in_array($file, $album_images)) {
                                $this->add_image($album_id, $file_data);
                            }
                        }
                    }
                }
            }
        }

        //remove temp folder
        delete_files($temp_path, TRUE);
        @unlink($data['upload_data']['full_path']);
        @rmdir($temp_path);

        echo json_encode($data);
    }

    /**
     * Resize image and create thumb
     */
    private function resize_and_thumb($file = array()) {
        //var_dump($file);
        $this->load->library('image_lib');

        // Resize image
        if ($this->conf['max_width'] > 0 AND $this->conf['max_height'] > 0)
            if ($file['image_width'] > $this->conf['max_width'] OR $file['image_height'] > $this->conf['max_height']) {
                $config = array();
                $config['image_library'] = $this->conf['engine'];
                $config['source_image'] = $file['full_path'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = $this->conf['maintain_ratio'];
                $config['width'] = $this->conf['max_width'];
                $config['height'] = $this->conf['max_height'];
                $config['quality'] = $this->conf['quality'];

                if (($this->conf['maintain_ratio']) AND ($this->conf['crop'])) { // Уменьшаем изображение и обрезаем края 
                    $size = $this->get_image_size($file['full_path']); // Получаем размеры сторон изображения

                    $size['width'] >= $size['height'] ? $config['master_dim'] = "height" : $config['master_dim'] = "width"; // Задаем master_dim 

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    $config['image_library'] = $this->conf['engine'];
                    $config['source_image'] = $file['full_path'];
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = $this->conf['max_width'];
                    $config['height'] = $this->conf['max_height'];

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->crop();
                } else { // Только уменьшаем
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        // Create image preview
        $config = array();
        $prev_img_name = $file['raw_name'] . '_prev' . $file['file_ext'];

        if ($file['image_width'] > $this->conf['prev_img_width'] OR $file['image_height'] > $this->conf['prev_img_height']) {
            $config['image_library'] = $this->conf['engine'];
            $config['source_image'] = $file['full_path'];
            $config['new_image'] = $prev_img_name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio_prev'] = $this->conf['maintain_ratio_prev'];
            $config['width'] = $this->conf['prev_img_width'];
            $config['height'] = $this->conf['prev_img_height'];
            $config['quality'] = $this->conf['quality'];

            if (($this->conf['maintain_ratio_prev']) AND ($this->conf['crop_prev'])) { // Уменьшаем изображение и обрезаем края 
                $size = $this->get_image_size($file['full_path']); // Получаем размеры сторон изображения

                $size['width'] >= $size['height'] ? $config['master_dim'] = "height" : $config['master_dim'] = "width"; // Задаем master_dim 

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $config['image_library'] = $this->conf['engine'];
                $config['source_image'] = $prev_img_name;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = $this->conf['prev_img_width'];
                $config['height'] = $this->conf['prev_img_height'];

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->crop();
            } else { // Только уменьшаем
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
            }
        } else {
            $this->load->helper('File');
            $file_data = read_file($file['full_path']);
            write_file($file['file_path'] . $prev_img_name, $file_data);
        }

//wtf
//echo $this->conf['upload_path'];
        // Create thumb file
        $config = array();
        $thumb_name = $this->conf['upload_path'] . '/' . $this->conf['thumbs_folder'] . '/' . $file['raw_name'] . $this->conf['thumb_marker'] . $file['file_ext'];

        if ($file['image_width'] > $this->conf['thumb_width'] OR $file['image_height'] > $this->conf['thumb_height']) {
            $config['image_library'] = $this->conf['engine'];
            $config['source_image'] = $file['full_path'];
            $config['new_image'] = $thumb_name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = $this->conf['maintain_ratio_icon'];
            $config['width'] = $this->conf['thumb_width'];
            $config['height'] = $this->conf['thumb_height'];
            $config['quality'] = $this->conf['quality'];


            if (($this->conf['maintain_ratio_icon']) AND ($this->conf['crop_icon'])) { // Уменьшаем изображение и обрезаем края 
                $size = $this->get_image_size($file['full_path']); // Получаем размеры сторон изображения

                $size['width'] >= $size['height'] ? $config['master_dim'] = "height" : $config['master_dim'] = "width"; // Задаем master_dim 

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize())
                    echo 'fck';

                $config['image_library'] = $this->conf['engine'];
                $config['source_image'] = $thumb_name;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = $this->conf['thumb_width'];
                $config['height'] = $this->conf['thumb_height'];

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->crop();
            }
            else { // Только уменьшаем
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize())
                    echo $this->image_lib->display_errors();
            }
        }
        else {
            // copy file to thumbs folder
            $this->load->helper('File');
            $file_data = read_file($file['full_path']);
            write_file($thumb_name, $file_data);
        }

        // Create admin thumb file
        $config = array();
        $thumb_name = $this->conf['upload_path'] . '/_admin_thumbs/' . $file['raw_name'] . $this->conf['thumb_marker'] . $file['file_ext'];

        if ($file['image_width'] > 100 OR $file['image_height'] > 100) {
            $config['image_library'] = $this->conf['engine'];
            $config['source_image'] = $file['full_path'];
            $config['new_image'] = $thumb_name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 100;
            $config['height'] = 100;
            $config['quality'] = '80%';

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        } else {
            $this->load->helper('File');
            $file_data = read_file($file['full_path']);
            write_file($thumb_name, $file_data);
        }


        // Draw watermark.
        if ($file['image_width'] > $this->conf['watermark_min_width'] AND $file['image_height'] > $this->conf['watermark_min_height']) {
            $this->make_watermark($file['full_path']);
            $this->make_watermark($file['file_path'] . $prev_img_name);
        }

        // Set file permissions
        // chmod($file['full_path'], 0777);
        // chmod($file['file_path'].$thumb_name, 0777);

        return TRUE;
    }

    /**
     * Watermarking an Image if watermark_text is not empty
     */
    private function make_watermark($file_path) {
        if ($this->conf['watermark_font_path'] == '') {
            $this->conf['watermark_font_path'] = './system/fonts/1.ttf';
        }

        $config = array();
        $config['source_image'] = $file_path;
        $config['wm_vrt_alignment'] = $this->conf['wm_vrt_alignment'];
        $config['wm_hor_alignment'] = $this->conf['wm_hor_alignment'];
        $config['wm_padding'] = $this->conf['watermark_padding'];

        if ($this->conf['watermark_type'] == 'overlay') {
            $config['wm_type'] = 'overlay';
            $config['wm_opacity'] = $this->conf['watermark_image_opacity'];
            $config['wm_overlay_path'] = $this->conf['watermark_image'];
        } else {
            if ($this->conf['watermark_text'] == '')
                return FALSE;

            $config['wm_text'] = $this->conf['watermark_text'];
            $config['wm_type'] = 'text';
            $config['wm_font_path'] = $this->conf['watermark_font_path'];
            $config['wm_font_size'] = $this->conf['watermark_font_size'];
            $config['wm_font_color'] = $this->conf['watermark_color'];
        }

        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();
    }

    /**
     * Display template file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

    /**
     * Fetch template file
     */
    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file admin.php */
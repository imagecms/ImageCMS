<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * ImageCMS
 *
 * Gallery Module _Admin_
 */
//class Admin extends MY_Controller {
class Admin extends BaseAdminController
{

    // Gallery config
    public $conf = [
                    'engine'                  => 'gd2', // Image library. Possible values: GD, GD2, ImageMagick, NetPBM
                    'max_file_size'           => 5, // Max file size for upload in Mb.
                    'max_archive_size'        => 50,
                    'max_width'               => 0, // Max image width.
                    'max_height'              => 0, // Max image height.
                    'allowed_types'           => 'gif|jpg|jpeg|png|zip', // Allowed image types.
                    'allowed_archive_types'   => 'zip',
                    'upload_path'             => './uploads/gallery/', // Image upload dir. With ending slash.
                    'upload_url'              => 'uploads/gallery/', // Image upload url. With ending slash.
                    'cache_path'              => './system/cache/',
                    'quality'                 => '90%', // Image quality
                    'thumb_width'             => '100', // Thumb width. min. 20px; max 1000px;
                    'thumb_height'            => '100', // Thumb height min. 20px; max 1000px;
                    'thumb_marker'            => '', // Thumb suffix
                    'thumbs_folder'           => '_thumbs', // Thumbs folder name. ! Without ending slash.
                    'prev_img_marker'         => '_prev', // Preview image suffix
                    'maintain_ratio'          => TRUE, // Specifies whether to maintain the original aspect ratio when resizing.
                    'maintain_ratio_prev'     => TRUE, // Specifies whether to maintain the original aspect ratio when resizing prev image.
                    'maintain_ratio_icon'     => TRUE, // Specifies whether to maintain the original aspect ratio when resizing icon.
                    'crop'                    => TRUE, // Specifies whether to crop image for save the original aspect ratio when resizing.
                    'crop_prev'               => TRUE, // Specifies whether to crop image for save the original aspect ratio when resizing prev image.
                    'crop_icon'               => TRUE, // Specifies whether to crop image for save the original aspect ratio when resizing icon.
                    'prev_img_width'          => '500', // Preview image width
                    'prev_img_height'         => '375', // Preview image height
        // Watermark params
                    'watermark_text'          => '', // Watermark text.
                    'watermark_image'         => '', // Path to watermark image.
                    'watermark_image_opacity' => '', // Watermark image opacity.
                    'watermark_type'          => 'overlay', // Watermark type. Possible values: text/overlay.
                    'wm_vrt_alignment'        => 'bottom', // Watermark vertical position. Possible values: top, middle, bottom.
                    'wm_hor_alignment'        => 'right', // Watermark horizontal position. Possible values: left, center, right.
                    'watermark_font_path'     => './system/fonts/1.ttf', // Path to watermark font.
                    'watermark_font_size'     => 16, // Watermark font size.
                    'watermark_padding'       => '-5', // Watermark padding.
                    'watermark_color'         => 'ffffff', // Watermark font color.
                    'watermark_min_width'     => '10', // Min. image width to draw watermark.
                    'watermark_min_height'    => '10', // Min. image height to draw watermark.
        // Albums
                    'order_by'                => 'date', // Albums order. Posiible values: date/name/position.
                    'sort_order'              => 'desc',// Sort order. Possible values: desc/asc.
                   ];

    protected $lastnewid;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('gallery');

        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }

        $this->lang->load('gallery');

        $this->load->model('gallery_m');
        $this->init_settings();

        $this->test_uploads_folder($this->conf['upload_path']);
        $this->load->helper('file');
        $this->load->helper('gallery');
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

            \CMSFactory\assetManager::create()
                ->setData(
                    [
                     'error' => lang('Create a directory to continue your work with the gallery', 'gallery') . $this->conf['upload_path'] . lang('Set the write access', 'gallery'),
                    ]
                )
                ->renderAdmin('error');
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

        \CMSFactory\assetManager::create()
            ->setData(
                ['categories' => $categories]
            )
            ->renderAdmin('categories');
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
                $albums[$i]['cover_url'] = media_url($upload_url . $albums[$i]['id'] . '/' . $albums[$i]['cover_name'] . $albums[$i]['cover_ext']);

                $upload_url = $this->conf['upload_url'];

                if ($albums[$i]['cover_name'] == NULL) {
                    $image = $this->gallery_m->get_last_image($albums[$i]['id']);

                    if ($image != FALSE) {
                        $albums[$i]['cover_url'] = media_url($upload_url . $albums[$i]['id'] . '/' . $image['file_name'] . $image['file_ext']);
                    } else {
                        $albums[$i]['cover_url'] = 'empty';
                    }
                } else {
                    $albums[$i]['cover_url'] = media_url($upload_url . $albums[$i]['id'] . '/' . $albums[$i]['cover_name'] . $albums[$i]['cover_ext']);
                }
            }

            $this->template->add_array([]);
        }

        \CMSFactory\assetManager::create()
            ->setData(
                [
                 'albums'   => $albums,
                 'category' => $this->gallery_m->get_category($id),
                ]
            )
            ->renderAdmin('album_list');
    }

    /**
     * Display settings.tpl and update seetings.
     */
    public function settings($action = 'show') {

        switch ($action) {
            case 'show':
                \CMSFactory\assetManager::create()
                    ->setData(
                        [
                         'settings' => $this->gallery_m->load_settings(),
                        ]
                    )
                    ->renderAdmin('settings');
                break;

            case 'update':

                $this->load->library('Form_validation');
                $val = $this->form_validation;

                $val->set_rules('max_image_size', lang('File size', 'gallery'), 'required|is_natural');
                $val->set_rules('max_width', lang('Maximum width', 'gallery'), 'required|is_natural');
                $val->set_rules('max_height', lang('Maximum height', 'gallery'), 'required|is_natural');
                $val->set_rules('quality', lang('Quality', 'gallery'), 'required|is_natural');
                $val->set_rules('prev_img_width', lang('Pre-image width', 'gallery'), 'required|is_natural');
                $val->set_rules('prev_img_height', lang('pre-image height', 'gallery'), 'required|is_natural');
                $val->set_rules('thumb_width', lang('Icon width', 'gallery'), 'required|is_natural');
                $val->set_rules('thumb_height', lang('Icon height', 'gallery'), 'required|is_natural');
                $val->set_rules('watermark_text', lang('Watermark text', 'gallery'), 'max_length[100]');
                $val->set_rules('watermark_font_size', lang('Font size', 'gallery'), 'required|is_natural');
                $val->set_rules('watermark_image_opacity', lang('Transparency', 'gallery'), 'required|is_natural|min_length[1]|max_length[3]');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors(), false, 'r');
                    break;
                }

                // Check if watermark image exists.
                if ($this->input->post('watermark_type') == 'overlay' && !file_exists('.' . $this->input->post('watermark_image'))) {
                    showMessage(lang('Specify the correct path to watermark image', 'gallery'), false, 'r');
                    break;
                }

                if (file_exists('./uploads/' . $this->input->post('watermark_image'))) {
                    $imagePath = './uploads/' . trim($this->input->post('watermark_image'));
                } elseif (file_exists('.' . $this->input->post('watermark_image'))) {
                    $imagePath = trim('.' . $this->input->post('watermark_image'));
                }

                // Check if watermark font exists.
                $params = [
                           'max_image_size'          => $this->input->post('max_image_size'),
                           'max_width'               => $this->input->post('max_width'),
                           'max_height'              => $this->input->post('max_height'),
                           'quality'                 => $this->input->post('quality'),
                           'maintain_ratio'          => (bool) $this->input->post('maintain_ratio'),
                           'maintain_ratio_prev'     => (bool) $this->input->post('maintain_ratio_prev'),
                           'maintain_ratio_icon'     => (bool) $this->input->post('maintain_ratio_icon'),
                           'crop'                    => (bool) $this->input->post('crop'),
                           'crop_prev'               => (bool) $this->input->post('crop_prev'),
                           'crop_icon'               => (bool) $this->input->post('crop_icon'),
                           'prev_img_width'          => $this->input->post('prev_img_width'),
                           'prev_img_height'         => $this->input->post('prev_img_height'),
                           'thumb_width'             => $this->input->post('thumb_width'),
                           'thumb_height'            => $this->input->post('thumb_height'),
                    // watermark settings
                           'watermark_text'          => trim($this->input->post('watermark_text')),
                           'wm_vrt_alignment'        => $this->input->post('wm_vrt_alignment'),
                           'wm_hor_alignment'        => $this->input->post('wm_hor_alignment'),
                           'watermark_font_size'     => trim($this->input->post('watermark_font_size')),
                           'watermark_color'         => trim($this->input->post('watermark_color')),
                           'watermark_padding'       => trim($this->input->post('watermark_padding')),
                           'watermark_image'         => $imagePath,
                           'watermark_image_opacity' => trim($this->input->post('watermark_image_opacity')),
                           'watermark_type'          => trim($this->input->post('watermark_type')),
                           'order_by'                => $this->input->post('order_by'),
                           'sort_order'              => $this->input->post('sort_order'),
                          ];
                $uploadPath = './uploads/';
                $this->load->library(
                    'upload',
                    [
                     'upload_path'   => $uploadPath,
                     'max_size'      => 1024 * 1024 * 2, //2 Mb
                        //'allowed_types' => 'ttf|fnt|fon|otf'
                     'allowed_types' => '*',
                    ]
                );
                // saving font file, if specified
                if (isset($_FILES['watermark_font_path'])) {
                    $uploadPath = './uploads/';
                    // TODO: there are no mime-types for fonts in application/config/mimes.php
                    $allowedTypes = [
                                     'ttf',
                                     'fnt',
                                     'fon',
                                     'otf',
                                    ];
                    $ext = pathinfo($_FILES['watermark_font_path']['name'], PATHINFO_EXTENSION);
                    if (in_array($ext, $allowedTypes)) {
                        if (!$this->upload->do_upload('watermark_font_path')) {
                            $this->upload->display_errors('', '');
                        } else {
                            $udata = $this->upload->data();
                            // changing value in the DB
                            $params['watermark_font_path'] = $uploadPath . $udata['file_name'];
                        }
                    }
                } else {
                    $params['watermark_font_path'] = trim($this->input->post('watermark_font_path_tmp'));
                }

                $postData = $this->input->post();
                if ($postData['watermark']['delete_watermark_font_path'] == 1) {
                    $path = trim($this->input->post('watermark_font_path_tmp'));
                    if (file_exists($path) && !is_dir($path)) {
                        chmod($path, 0777);
                        unlink($path);
                    }

                    $params['watermark_font_path'] = '';
                }

                $this->db->where('name', 'gallery');
                $this->db->update('components', ['settings' => serialize($params)]);

                $this->lib_admin->log(lang('Gallery settings was edited', 'gallery'));
                showMessage(lang('Settings have been saved', 'gallery'));

                break;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Create album
     */
    public function create_album() {
        $this->load->library('Form_validation');

        $this->form_validation->set_rules('name', lang('Name', 'gallery'), 'required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('email', lang('Description', 'gallery'), 'max_length[500]');
        $this->form_validation->set_rules('category_id', lang('Categories', 'gallery'), 'required');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $album_id = $this->gallery_m->create_album();

            // Create album folder
            @mkdir($this->conf['upload_path'] . $album_id);

            chmod($this->conf['upload_path'] . $album_id, 0777);

            // Create thumbs folder
            @mkdir($this->conf['upload_path'] . $album_id . '/' . $this->conf['thumbs_folder']);

            // Create folder for admin thumbs
            @mkdir($this->conf['upload_path'] . $album_id . '/_admin_thumbs');

            $this->lib_admin->log(lang('Gallery album was created', 'gallery'));
            showMessage(lang('Album created', 'gallery'));

            $this->input->post('action') ? $action = $this->input->post('action') : $action = 'edit';

            if ($action == 'edit') {
                pjax(site_url('admin/components/cp/gallery/edit_album_params/' . $album_id));
            }

            if ($action == 'exit') {
                pjax('/admin/components/cp/gallery/category/' . $this->input->post('category_id'));
            }
        }
    }

    /**
     * Update album info
     */
    public function update_album($id, $locale) {
        $this->form_validation->set_rules('name', lang('Name', 'gallery'), 'required');
        $tpl_file = $this->input->post('tpl_file');
        if (!preg_match('/[a-z]/', $tpl_file) && !empty($tpl_file)) {
            showMessage('wrong tpl name', '', 'r');
            exit();
        }
        if ($this->form_validation->run() == false) {
            showMessage(validation_errors(), '', 'r');
            exit();
        } else {
            $this->lib_admin->log(lang('Gallery album was updated', 'gallery') . '. Id: ' . $id);
            showMessage(lang('Changes have been saved', 'gallery'));
        }

        $data = [
                 'category_id' => (int) $this->input->post('cat_id'),
            // 'name' => $this->input->post('name'),
            // 'description' => trim($this->input->post('description')),
                 'position'    => (int) $this->input->post('position'),
                 'tpl_file'    => $this->input->post('tpl_file'),
                ];

        $this->gallery_m->update_album($id, $data);

        $data_locale = [
                        'id'          => $id,
                        'locale'      => $locale,
                        'name'        => $this->input->post('name'),
                        'description' => trim($this->input->post('description')),
                       ];

        if ($this->db->where('id', $id)->where('locale', $locale)->get('gallery_albums_i18n')->num_rows()) {
            $this->db->where('id', $id)->where('locale', $locale);
            $this->db->update('gallery_albums_i18n', $data_locale);
        } else {
            $this->db->insert('gallery_albums_i18n', $data_locale);
        }

        $album = $this->gallery_m->get_album($id);

        $this->input->post('action') ? $action = $this->input->post('action') : $action = 'edit';

        if ($action == 'edit') {
            pjax('/admin/components/cp/gallery/edit_album_params/' . $id . '/'. $locale);
        }

        if ($action == 'close') {
            pjax('/admin/components/cp/gallery/category/' . $album['category_id']);
        }
    }

    public function edit_album_params($id, $locale = null) {
        if (null === $locale) {
            $locale = $this->gallery_m->chose_locale();
        }

        $album = $this->gallery_m->get_album($id, true, false, false, $locale);

        if ($album != FALSE) {
            \CMSFactory\assetManager::create()
                ->setData(
                    [
                     'locale'     => $locale,
                     'languages'  => $this->db->get('languages')->result_array(),
                     'album'      => $album,
                     'categories' => $this->gallery_m->get_categories($album['category_id']),
                    ]
                )
                ->renderAdmin('album_params');
        } else {
            show_error(lang("Can't load album information", 'gallery'));
        }
    }

    /**
     * Delete album
     */
    public function delete_album($id = FALSE, $category = NULL) {
        if ($id == FALSE) {
            $id = (int) $this->input->post('album_id');
        }

        $album = $this->gallery_m->get_album($id);

        if ($album != FALSE) {
            //            if ($folder != FALSE) {
            $this->load->helper('file');

            // delete images.
            delete_files($this->conf['upload_path'] . $album['id'], TRUE);

            // delete album dir.
            exec('rmdir ' . $this->conf['upload_path'] . $album['id']);
            //            rmdir($this->conf['upload_path'] . $album['id'], TRUE);
            //            }
            $this->gallery_m->delete_album($album['id']);
            $this->lib_admin->log(lang('Gallery album was removed', 'gallery') . '. Id: ' . $id);
            pjax('/admin/components/cp/gallery/category/' . $category);
            //            echo 'deleted';
            //            exit;
        } else {
            showMessage(lang("Can't load album information", 'gallery'));
        }
    }

    /**
     * Display create_album template
     */
    public function show_crate_album() {
        // Select only category id and name for selectbox
        // $this->db->select('id, name');
        $cats = $this->gallery_m->get_categories('position', 'asc');
        $selectCategory = $this->input->get('category_id');

        \CMSFactory\assetManager::create()
            ->setData(
                [
                 'categories'     => $cats,
                 'selectCategory' => $selectCategory,
                ]
            )
            ->renderAdmin('create_album');
    }

    /**
     * Show edit album template
     */
    public function edit_album($id = 0) {
        $album = $this->gallery_m->get_album($id);

        \CMSFactory\assetManager::create()
            ->setData(
                [
                 'album'     => $album,
                 'category'  => $this->gallery_m->get_category($album['category_id']),
                 'album_url' => $this->conf['upload_url'] . $id,
                ]
            )
            ->renderAdmin('edit_album');
    }

    // --------------------------------------------------------------------

    public function edit_image($id, $locale = null) {
        if ($locale === null) {
            $locale = $this->gallery_m->chose_locale();
        }
        $image = $this->gallery_m->get_image_info($id, $locale);

        if ($image != FALSE) {
            $album = $this->gallery_m->get_album($image['album_id'], FALSE);

            \CMSFactory\assetManager::create()
                ->setData(
                    [
                     'locale'    => $locale,
                     'languages' => $this->db->get('languages')->result_array(),
                     'image'     => $image,
                     'album'     => $album,
                     'category'  => $this->gallery_m->get_category($album['category_id']),
                     'album_url' => $this->conf['upload_url'] . $album['id'],
                    ]
                )
                ->renderAdmin('edit_image');
        } else {
            show_error(lang("Can't load image information", 'gallery'));
        }
    }

    /**
     * Rename image
     */
    public function rename_image($id) {
        $image = $this->gallery_m->get_image_info($id);

        if ($image != FALSE) {
            $this->load->library('Form_validation');

            $this->form_validation->set_rules('new_name', lang('New name', 'gallery'), 'trim|required');

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
                showMessage(lang('Changes have been saved', 'gallery'));
            }
        } else {
            showMessage(lang("Can't load image information", 'gallery'), false, 'r');
        }
    }

    /**
     * Delete image files
     */
    public function delete_image($ids = 0) {
        if ($this->input->post('id')) {
            $ids = $this->input->post('id');
        }

        foreach ($ids as $key => $id) {
            $image = $this->gallery_m->get_image_info($id);
            if ($image != FALSE) {
                $album = $this->gallery_m->get_album($image['album_id'], FALSE);
                $path = $this->conf['upload_path'] . $album['id'] . '/';

                // Delete image.
                //./uploads/gallery/13/53e96a8b7146a2976f6dd3e064de61db.jpeg
                unlink($path . $image['file_name'] . $image['file_ext']);

                // Delete thumb.
                //./uploads/gallery/13/_thumbs/53e96a8b7146a2976f6dd3e064de61db.jpeg
                unlink($path . $this->conf['thumbs_folder'] . '/' . $image['file_name'] . $image['file_ext']);

                // Delete preview file.
                unlink($path . $image['file_name'] . $this->conf['prev_img_marker'] . $image['file_ext']);

                // Delete admin thumb.
                unlink($path . '_admin_thumbs/' . $image['file_name'] . $image['file_ext']);

                // Delete image info.
                $this->gallery_m->delete_image($image['id']);
                $this->lib_admin->log(lang('Album image deleted.', 'gallery') . '. Id: ' . $image['id']);
                showMessage(lang('Photos removed', 'gallery'));
            }
        }
    }

    /**
     * Update image description/position
     */
    public function update_info($id, $locale = null) {

        if (null === $locale) {
            $locale = $this->gallery_m->chose_locale();
        }
        $image = $this->gallery_m->get_image_info($id);

        if ($image != FALSE) {
            $album = $this->gallery_m->get_album($image['album_id'], FALSE);

            $data = [
                     'description' => trim($this->input->post('description')),
                     'title'       => trim($this->input->post('title')),
                    ];

            $this->gallery_m->update_description($id, $data, $locale);

            $this->gallery_m->update_position($id, trim((int) $this->input->post('position')));

            if ($this->input->post('cover') == 1) {
                $this->gallery_m->set_album_cover($image['album_id'], $image['id']);
            } elseif ($this->input->post('cover') != 1 AND $album['cover_id'] == $image['id']) {
                $this->gallery_m->set_album_cover($image['album_id'], NULL);
            }

            //showMessage(lang('Changes are saved', 'gallery'));

            pjax('/admin/components/cp/gallery/edit_album/' . $image['album_id']);
        } else {
            showMessage(lang("Can't load image information", 'gallery'), false, 'r');
        }
    }

    public function update_positions() {
        $positions = $this->input->post('positions');
        foreach ($positions as $key => $value) {
            $this->db->where('id', (int) $value)->set('position', $key)->update('gallery_category');
        }
        showMessage(lang('Positions updated', 'gallery'));
    }

    public function update_album_positions() {
        $positions = $this->input->post('positions');
        foreach ($positions as $key => $value) {
            $this->db->where('id', (int) $value)->set('position', $key)->update('gallery_albums');
        }
        showMessage(lang('Positions updated', 'gallery'));
    }

    public function update_img_positions() {
        $positions = $this->input->post('positions');
        foreach ($positions as $key => $value) {
            $this->db->where('id', (int) $value)->set('position', $key)->update('gallery_images');
        }
        showMessage(lang('Positions updated', 'gallery'));
    }

    /**
     * Add uploaded image to album
     */
    private function add_image($album_id = 0, $file_data = []) {
        $this->load->helper('number');

        $size = $this->get_image_size($file_data['full_path']);

        $size = byte_format(filesize($file_data['full_path']));

        $size = str_replace(
            [
             'bytes',
             'kilobyte_abbr',
             'megabyte_abbr',
             'gigabyte_abbr',
             'terabyte_abbr',
            ],
            [
             'B',
             'kB',
             'MB',
             'GB',
             'TB',
            ],
            $size
        );

        $image_info = [
                       'album_id'  => $album_id,
                       'file_name' => $file_data['raw_name'],
                       'file_ext'  => $file_data['file_ext'],
                       'file_size' => $size,
                       'width'     => $size['width'],
                       'height'    => $size['height'],
                       'uploaded'  => time(),
                       'views'     => 0,
                      ];

        $this->gallery_m->add_image($image_info);
    }

    /**
     * Get image width and height
     */
    private function get_image_size($file_path) {
        if (function_exists('getimagesize')) {
            $image = @getimagesize($file_path);

            $size = [
                     'width'  => $image[0],
                     'height' => $image[1],
                    ];

            return $size;
        }

        return FALSE;
    }

    // --------------------------------------------------------------------
    // Categories
    // --------------------------------------------------------------------

    public function show_create_category() {
        \CMSFactory\assetManager::create()->renderAdmin('create_category');
    }

    public function create_category() {

        $locale = $this->gallery_m->chose_locale();

        $this->load->library('Form_validation');
        $val = $this->form_validation;

        $val->set_rules('name', lang('Name', 'gallery'), 'trim|required|max_length[250]|min_length[1]');
        $val->set_rules('position', lang('Position', 'gallery'), 'numeric');

        if ($val->run() == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $data = [
                //'name' => $this->input->post('name'),
                //'description' => trim($this->input->post('description')),
                     'position' => $this->input->post('position'),
                     'created'  => time(),
                    ];

            $last_id = $this->gallery_m->create_category($data);

            $data_locale = [
                            'id'          => $last_id,
                            'locale'      => $locale,
                            'name'        => $this->input->post('name'),
                            'description' => trim($this->input->post('description')),
                           ];

            $this->db->insert('gallery_category_i18n', $data_locale);

            $this->lib_admin->log(lang('Gallery category was created', 'gallery'));
            //updateDiv('page', site_url('admin/components/cp/gallery'));
            //$this->input->post('action') ? $action = $this->input->post('action') : $action = 'edit';

            if ($this->input->post('action') == 'close') {
                pjax('/admin/components/cp/gallery/index');
            } else {
                pjax('/admin/components/cp/gallery/edit_category/' . $last_id);
            }
        }
    }

    public function edit_category($id, $locale = null) {

        if (null === $locale) {
            $locale = $this->gallery_m->chose_locale();
        }
        $category = $this->gallery_m->get_category($id, $locale);

        \CMSFactory\assetManager::create()
            ->setData(
                [
                 'category'  => $category,
                 'locale'    => $locale,
                 'languages' => $this->db->get('languages')->result_array(),
                ]
            )
            ->renderAdmin('edit_category');
    }

    public function update_category($id, $locale) {
        $this->load->library('Form_validation');
        $val = $this->form_validation;

        $val->set_rules('name', lang('Name', 'gallery'), 'trim|required|max_length[250]|min_length[1]');
        $val->set_rules('position', lang('Position', 'gallery'), 'numeric');

        if ($val->run() == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $data = [
                     'position' => $this->input->post('position'),
                    ];

            $this->gallery_m->update_category($data, $id);

            $data_locale = [
                            'id'          => $id,
                            'locale'      => $locale,
                            'name'        => $this->input->post('name'),
                            'description' => trim($this->input->post('description')),
                           ];

            if ($this->db->where('id', $id)->where('locale', $locale)->get('gallery_category_i18n')->num_rows()) {
                $this->db->where('id', $id)->where('locale', $locale);
                $this->db->update('gallery_category_i18n', $data_locale);
            } else {
                $this->db->insert('gallery_category_i18n', $data_locale);
            }

            $this->lib_admin->log(lang('Gallery category was edited', 'gallery') . '. Id: ' . $id);
            showMessage(lang('Changes have been saved', 'gallery'));

            //updateDiv('page', site_url('admin/components/cp/gallery'));
            $this->input->post('action') ? $action = $this->input->post('action') : $action = 'edit';

            if ($action == 'close') {
                pjax('/admin/components/cp/gallery/index');
            }
            if ($action == 'edit') {
                pjax('/admin/components/cp/gallery/edit_category/' . $id .'/' . $locale);
            }
        }
    }

    public function delete_category() {
        foreach ($this->input->post('id') as $id) {

            // Delete category albums
            $albums = $this->gallery_m->get_albums('date', 'desc', $id);

            if (count($albums) > 0) {
                foreach ($albums as $album) {
                    $this->delete_album($album['id']);
                }
            }
            $this->gallery_m->delete_category($id);
        }
        $this->lib_admin->log(lang('Gallery category was removed', 'gallery') . '. Ids: ' . implode(', ', $this->input->post('id')));
    }

    /**
     * In CI's class Upload not provided the input's files array (name='somefile[]')
     * So the structure of $_FILES must be
     * Array (
     *      [somefile] => Array (
     *            [name] => qwe.jpg
     *               ...
     *  ))
     * But in case of many file it is like this:
     * Array (
     *      [somefile] => Array (
     *            [name] => Array (
     *                  [0] => 'qwe.jpg',
     *                  [1] => 'asd.jpg',
     *                  ...
     *            )
     *               ...
     *  ))
     * There is a need to transform $_FILES like each file come from his own input
     *
     * @param string $field name of the input[name]
     */
    private function transform_FILES($field = 'userfile') {
        if (!array_key_exists($field, $_FILES)) {
            return FALSE;
        }

        $newFiles = [];
        $count = count($_FILES[$field]['name']);
        for ($i = 0; $i < $count; $i++) {
            $oneFileData = [];
            foreach ($_FILES[$field] as $assocKey => $fileDataArray) {
                $oneFileData[$assocKey] = $fileDataArray[$i];
            }
            $newFiles[$field . '_' . $i] = $oneFileData;
        }
        $_FILES = $newFiles;
        return TRUE;
    }

    /**
     * Upload image
     *
     * Upload image to album folder.
     *
     */
    public function upload_image($album_id = 0) {
        $temp_conf = $this->conf;
        if (is_array($_FILES['newPic'])) {

            if (count($_FILES['newPic']['name']) > ini_get('max_file_uploads')) {
                showMessage(langf('You can upload only |max_file_uploads| images at once', 'admin', ['max_file_uploads' => ini_get('max_file_uploads')]), lang('Error', 'admin'), 'r');
                exit;
            }

            // making transformation of $_FILES array for CodeIgniter's Upload class
            $this->transform_FILES('newPic');

            // configs for Upload
            $this->conf['upload_path'] = $this->conf['upload_path'] . $album_id;
            if (!is_dir($this->conf['upload_path'])) {
                mkdir($this->conf['upload_path']);
            }
            $config['upload_path'] = $this->conf['upload_path'];

            $config['allowed_types'] = $this->conf['allowed_types'];
            $config['max_size'] = 1024 * $this->conf['max_image_size'];
            $config['encrypt_name'] = TRUE;

            // init Upload
            $this->load->library('upload', $config);

            // saving each file
            $data = [];
            $i = 0;
            foreach ($_FILES as $fieldName => $filesData) {
                if (!$this->upload->do_upload($fieldName)) {
                    $error = $filesData['name'] . ' - ' . $this->upload->display_errors('', '') . '<br /> ';
                    $data['error'] .= $error;
                } else {
                    $data[$i] = ['upload_data' => $this->upload->data()];

                    // Resize Image and create thumb
                    $this->resize_and_thumb($data[$i]['upload_data']);
                    $this->add_image($album_id, $data[$i]['upload_data']);
                }
                $buf = $this->conf['upload_path'];
                $this->conf = $temp_conf;
                $this->conf['upload_path'] = $buf;
                $i++;
            }

            if (isset($data['error'])) {
                showMessage($data['error'], '', 'r');
            } else {
                showMessage(lang('Upload success', 'gallery'));
                pjax('');
            }
        }
        $this->lib_admin->log(lang('Photos in gallery the album are saved', 'gallery'));
    }

    /**
     * Resize image and create thumb
     */
    private function resize_and_thumb($file = []) {
        $this->load->library('image_lib');

        // Resize image
        if ($this->conf['max_width'] > 0 AND $this->conf['max_height'] > 0) {
            if ($file['image_width'] > $this->conf['max_width'] OR $file['image_height'] > $this->conf['max_height']) {
                $config = [];
                $config['image_library'] = $this->conf['engine'];
                $config['source_image'] = $file['full_path'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = $this->conf['maintain_ratio'];
                $config['width'] = $this->conf['max_width'];
                $config['height'] = $this->conf['max_height'];
                $config['quality'] = $this->conf['quality'];

                if (($this->conf['maintain_ratio']) AND ($this->conf['crop'])) { // Уменьшаем изображение и обрезаем края
                    $size = $this->get_image_size($file['full_path']); // Получаем размеры сторон изображения

                    $size['width'] >= $size['height'] ? $config['master_dim'] = 'height' : $config['master_dim'] = 'width'; // Задаем master_dim

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
        }
        // Create image preview
        $config = [];
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

                $size['width'] >= $size['height'] ? $config['master_dim'] = 'height' : $config['master_dim'] = 'width'; // Задаем master_dim

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

        // Create thumb file
        $config = [];
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

                $size['width'] >= $size['height'] ? $config['master_dim'] = 'height' : $config['master_dim'] = 'width'; // Задаем master_dim

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo 'fck';
                }

                $config['image_library'] = $this->conf['engine'];
                $config['source_image'] = $thumb_name;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = $this->conf['thumb_width'];
                $config['height'] = $this->conf['thumb_height'];

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->crop();
            } else { // Только уменьшаем
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
            }
        } else {
            // copy file to thumbs folder
            $this->load->helper('File');
            $file_data = read_file($file['full_path']);
            write_file($thumb_name, $file_data);
        }

        // Create admin thumb file
        $config = [];
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

        return TRUE;
    }

    /**
     * Watermarking an Image if watermark_text is not empty
     */
    private function make_watermark($file_path) {
        if (!$this->conf['watermark_font_path']) {
            $this->conf['watermark_font_path'] = './uploads/defaultFont.ttf';
        }

        $config = [];
        $config['source_image'] = $file_path;
        $config['wm_vrt_alignment'] = $this->conf['wm_vrt_alignment'];
        $config['wm_hor_alignment'] = $this->conf['wm_hor_alignment'];
        $config['wm_padding'] = $this->conf['watermark_padding'];

        if ($this->conf['watermark_type'] == 'overlay') {
            $config['wm_type'] = 'overlay';
            $config['wm_opacity'] = $this->conf['watermark_image_opacity'];
            $config['wm_overlay_path'] = $this->conf['watermark_image'];
        } else {
            if ($this->conf['watermark_text'] == '') {
                return FALSE;
            }

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

}

/* End of file admin.php */
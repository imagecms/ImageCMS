<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for Banners module
 * @uses BaseAdminController
 * @author L.Andriy <l.andriy@siteimage.com.ua>
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property banner_model $banner_model
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('banner_model');
        $this->load->helper('banners');

        $locale = $this->db->where('default', 1)->get('languages')->result_array();
        $this->def_locale = $locale[0]['identif'];

        $lang = new MY_Lang();
        $lang->load('banners');

        if (!$this->db->table_exists('mod_banner_groups')) {
            $this->banner_model->createGroupsTable();
        }

        $this->is_shop = SHOP_INSTALLED;
    }

    public function createGroup() {
        $name = $this->input->post('name');
        if ($this->db->where($name)->get('mod_banner_groups')) {
            return FALSE;
        }

        if ($this->db->table_exists('mod_banner_groups')) {
            $this->db->set('name', $name)->insert('mod_banner_groups');
        } else {
            $this->banner_model->createGroupsTable();

            $this->db->set('name', $name)->insert('mod_banner_groups');
        }
        if (!$this->db->_error_message()) {
            echo $this->db->insert_id();
        } else {
            echo 0;
        }
    }

    public function delGroup() {
        $name = $this->input->post('name');
        if ($this->db->table_exists('mod_banner_groups')) {
            $this->db->where('name', $name[0])->delete('mod_banner_groups');
        } else {
            $this->banner_model->createGroupsTable();

            $this->db->where('name', $name[0])->delete('mod_banner_groups');
        }
        if (!$this->db->_error_message()) {
            echo 1;
        } else {
            echo 0;
        }
    }

    /**
     * @access public
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function index() {
        /** Get all Banners from DB */
        $locale = $this->def_locale;
        $banners = $this->banner_model->get_all_banner($locale, 0, FALSE);

        /** Show Banners list */
        \CMSFactory\assetManager::create()
                ->registerScript('main')
                ->setData(['banners' => $banners, 'locale' => $locale, 'show_tpl' => $this->banner_model->get_settings_tpl()])
                ->renderAdmin('list');
    }

    /**
     * @access public
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function settings() {
        $st = (int) $this->input->post('status');

        $arr = serialize(['show_tpl' => $st]);
        $sql = $this->db->query("update  components set settings = '$arr' where name = 'banners'");
    }

    /**
     * Switch Banners activity status
     * @access public
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function chose_active() {
        $status = ($this->input->post('status')) === 'false' ? 1 : 0;
        $this->banner_model->chose_active($this->input->post('id'), $status);
        $this->lib_admin->log(lang("Banner status was edited", "banners") . '. Id: ' . $this->input->post('id'));
    }

    /**
     * Banners remove method
     * @access public
     * @param $_POST $id
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function delete() {
        /** Remove Banners by Ids */
        $ids = $this->input->post('id');
        foreach (json_decode($ids) as $key) {
            $this->banner_model->del_banner($key);
        }
        $this->lib_admin->log(lang("Banner was removed", "banners") . '. Ids: ' . implode(', ', json_decode($ids)));
    }

    /**
     * Сreate new Banner
     * @access public
     * @param $_POST
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function create() {
        if ($this->input->post()) {

            $this->load->library('Form_validation');
            /** Set Validation reles */
            $this->form_validation->set_rules('name', lang('Banner name', 'banners'), 'required|xss_clean|max_length[45]');
            $this->form_validation->set_rules('photo', lang('Image', 'banners'), 'required|xss_clean');
            if ($this->form_validation->run($this) !== FALSE) {
                /** Set Instart data */
                $data = [
                    'name' => $this->input->post('name'),
                    'active' => (int) $this->input->post('active'),
                    'description' => $this->input->post('description'),
                    'active_to' => $this->input->post('active_to_permanent') == 'on' ? -1 : (int) strtotime($this->input->post('active_to')),
                    'where_show' => count($this->input->post('data')) ? serialize(array_unique($this->input->post('data'))) : serialize([]),
                    'photo' => $this->input->post('photo'),
                    'url' => $this->input->post('url'),
                    'locale' => $this->def_locale,
                ];
                /** Create new banner from data-array */
                try {
                    $lid = $this->banner_model->add_banner($data);

                    $last_banner_id = $this->db->order_by("id", "desc")->get('mod_banner')->row()->id;
                    $this->lib_admin->log(lang("Banner created", "banners") . '. Id: ' . $last_banner_id);
                    showMessage(lang('Banner created', 'banners'));
                    /** Show successful message and redirect */
                    if ($this->input->post('action') == 'tomain') {
                        pjax('/admin/components/init_window/banners');
                    } elseif ($this->input->post('action') == 'toedit') {
                        pjax('/admin/components/init_window/banners/edit/' . $lid);
                    }
                } catch (Exception $e) {
                    showMessage($e->getMessage(), '', 'r');
                }
            } else {
                /** Show validation error message */
                showMessage(validation_errors(), false, 'r');
            }
        } else {

            /** Show empty form for create */
            \CMSFactory\assetManager::create()
                    ->registerScript('main')
                    ->registerStyle('style')
                    ->setData(['is_shop' => $this->is_shop, 'locale' => $locale, 'languages' => $lan])
                    ->renderAdmin('create');
        }
    }

    /**
     * Edit Banner by Id Banner
     * @access public
     * @param integer $id
     * @param string $locale
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function edit($id, $locale = null) {
        /** Locale value is necessary */
        ($locale != null) OR $locale = $this->def_locale;

        if ($this->input->post('name')) {

            $this->load->library('Form_validation');
            $this->form_validation->set_rules('name', lang('Banner name', 'banners'), 'required|xss_clean|max_length[45]');
            $this->form_validation->set_rules('photo', lang('Photo', 'banners'), 'required|xss_clean');

            if ($this->form_validation->run($this) != FALSE) {

                /** Set Update data */
                $data = [
                    'name' => $this->input->post('name'),
                    'active' => (int) $this->input->post('active'),
                    'description' => $this->input->post('description'),
                    'active_to' => $this->input->post('active_to_permanent') == 'on' ? -1 : (int) strtotime($this->input->post('active_to')),
                    'where_show' => count($this->input->post('data')) ? serialize(array_unique($this->input->post('data'))) : serialize([]),
                    'photo' => $this->input->post('photo'),
                    'url' => $this->input->post('url'),
                    'locale' => $locale,
                    'group' => serialize($this->input->post('group')),
                    'id' => (int) $id,
                ];
                /** Update banner from data-array */
                $this->banner_model->edit_banner($data);

                /** Show successful message and redirect */
                $this->lib_admin->log(lang("Banner was edited", "banners") . '. Id: ' . $id);
                showMessage(lang('Data is saved', 'banners'));
                if ($this->input->post('action') == 'tomain') {
                    pjax('/admin/components/init_window/banners');
                }
            } else {
                /** Show validation error message */
                showMessage(validation_errors(), false, 'r');
            }
        } else {

            $banner = $this->banner_model->get_one_banner($id, $locale);
            $groups = $this->banner_model->getGroups();

            if (!isset($banner['id']) OR empty($banner)) {
                $banner['id'] = $id;
            }

            /** Show Banner edit template */
            CMSFactory\assetManager::create()
                    ->registerScript('main')
                    ->registerStyle('style')
                    ->setData(
                        [
                                'is_shop' => $this->is_shop,
                                'banner' => $banner,
                                'locale' => $locale,
                                'languages' => $this->db->get('languages')->result_array(),
                                'groups' => $groups,
                            ]
                    )
                    ->renderAdmin('edit');
        }
    }

    /**
     * Data Autocomplete
     * @access public
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function autosearch() {
        switch ($this->input->post('queryString')) {
            case 'product':
                $entity = SProductsQuery::create()->joinWithI18n($this->def_locale)->filterByActive(true)->withColumn('SProductsI18n.Name', 'Name')->select(['Id', 'Name'])->find()->toArray();
                break;
            case 'shop_category':
                $entity = SCategoryQuery::create()->joinWithI18n($this->def_locale)->withColumn('SCategoryI18n.Name', 'Name')->select(['Id', 'Name'])->find()->toArray();
                break;
            case 'brand':
                $entity = SBrandsQuery::create()->joinWithI18n($this->def_locale)->withColumn('SBrandsI18n.Name', 'Name')->select(['Id', 'Name'])->find()->toArray();
                break;
            case 'category':
                $entity = $this->db->select('id as Id')->select('name as Name')->get('category')->result_array();
                break;
            case 'page':
                $entity = $this->db->select('id as Id')->select('title as Name')->get('content')->result_array();
                break;
            case 'main':
                $entity = [['Id' => 0, 'Name' => lang('Main', 'banners')]];
                break;
            default:
                break;
        }

        /** Show template with data */
        \CMSFactory\assetManager::create()
                ->setData('entity', $entity)
                ->render($this->input->post('tpl'), TRUE);
    }

    /**
     * Save banners positions
     * @access public
     * @author koloda90 <koloda90@gmail.com>
     */
    public function save_positions() {
        if (!is_array($this->input->post('positions'))) {
            return;
        }

        foreach ($this->input->post('positions') as $key => $value) {
            $this->db->where('id = ' . $value)
                ->update('mod_banner', ['position' => $key]);
        }

        showMessage(lang('Positions saved', 'banners'));
    }

}

/* End of file admin.php */
<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for Banners module
 * @uses BaseAdminController
 * @author L.Andriy <l.andriy@siteimage.com.ua>
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property Banner_model $banner_model
 */
class Admin extends BaseAdminController {

    function __construct() {
        parent::__construct();
        $this->load->model('banner_model');
        $this->load->helper('banners');

        $locale = $this->db->where('default', 1)->get('languages')->result_array();
        $this->def_locale = $locale[0]['identif'];

        
        $this->is_shop = SHOP_INSTALLED;
    }

    /**
     * @access public
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function index() {
        /** Get all Banners from DB */
        $locale = $this->def_locale;
        $banners = $this->banner_model->get_all_banner($locale);

        /** Show Banners list */
        \CMSFactory\assetManager::create()
                ->registerScript('main')
                ->setData(array('banners' => $banners, 'locale' => $locale))
                ->renderAdmin('list');
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
        foreach (json_decode($ids) as $key)
            $this->banner_model->del_banner($key);
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
            $this->form_validation->set_rules('name', 'Имя баннера', 'required|xss_clean|max_length[45]');
            $this->form_validation->set_rules('photo', 'Фото', 'required|xss_clean');

            if ($this->form_validation->run($this) !== FALSE) {
                /** Set Instart data */
                $data = array(
                    'name' => $this->input->post('name'),
                    'active' => (int) $this->input->post('active'),
                    'description' => $this->input->post('description'),
                    'active_to' => (int) strtotime($this->input->post('active_to')),
                    'where_show' => count($this->input->post('data')) ? serialize(array_unique($this->input->post('data'))) : serialize(array()),
                    'photo' => $this->input->post('photo'),
                    'url' => $this->input->post('url'),
                    'locale' => $this->def_locale,
                );
                /** Create new banner from data-array */

                $lid = $this->banner_model->add_banner($data);

                /** Reupdate banner info for each lang */
                foreach ($lan = $this->db->get('languages')->result_array() as $lan)
                    if ($lan['identif'] != $this->def_locale)
                        $this->banner_model->add_empty_banner($lid, $lan['identif']);

                /** Show successful message and redirect */
                pjax('/admin/components/init_window/banners');
            }else {
                /** Show validation error message */
                showMessage(validation_errors(), false, 'r');
            }
        } else {

            /** Show empty form for create */
            \CMSFactory\assetManager::create()
                    ->registerScript('main')
                    ->registerStyle('style')
                    ->setData(array('is_shop' => $this->is_shop, 'locale' => $locale, 'languages' => $lan))
                    ->renderAdmin('create');
        }
        
       

    }

    /**
     * Edit Banner by Id Banner
     * @access public
     * @param int $id
     * @param string $locale
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function edit($id, $locale = null) {
        /** Locale value is necessary */
        ($locale != null) OR $locale = $this->def_locale;

        if ($_POST) {

            $this->load->library('Form_validation');
            $this->form_validation->set_rules('name', 'Имя баннера', 'required|xss_clean|max_length[45]');
            $this->form_validation->set_rules('photo', 'Фото', 'required|xss_clean');


            if ($this->form_validation->run($this) != FALSE) {

                /** Set Update data */
                $data = array(
                    'name' => $_POST['name'],
                    'active' => (int) $this->input->post('active'),
                    'description' => $this->input->post('description'),
                    'active_to' => (int) strtotime($this->input->post('active_to')),
                    'where_show' => count($_POST['data']) ? serialize(array_unique($this->input->post('data'))) : serialize(array()),
                    'photo' => $this->input->post('photo'),
                    'url' => $this->input->post('url'),
                    'locale' => $locale,
                    'id' => (int) $id,
                );

                /** Update banner from data-array */
                $this->banner_model->edit_banner($data);

                /** Show successful message and redirect */
                showMessage('Даные сохранены');
            } else {
                /** Show validation error message */
                showMessage(validation_errors(), false, 'r');
            }
        } else {

            $banner = $this->banner_model->get_one_banner($id, $locale);


            /** Show Banner edit template */
            CMSFactory\assetManager::create()
                    ->registerScript('main')
                    ->registerStyle('style')
                    ->setData(array('is_shop' => $this->is_shop, 'banner' => $banner, 'locale' => $locale, 'languages' => $this->db->get('languages')->result_array()))
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
                $entity = SProductsQuery::create()->joinWithI18n($this->def_locale)->filterByActive(true)->withColumn('SProductsI18n.Name', 'Name')->select(array('Id', 'Name'))->find()->toArray();
                break;
            case 'shop_category':
                $entity = SCategoryQuery::create()->joinWithI18n($this->def_locale)->withColumn('SCategoryI18n.Name', 'Name')->select(array('Id', 'Name'))->find()->toArray();
                break;
            case 'brand':
                $entity = SBrandsQuery::create()->joinWithI18n($this->def_locale)->withColumn('SBrandsI18n.Name', 'Name')->select(array('Id', 'Name'))->find()->toArray();
                break;
            case 'category':
                $entity = $this->db->select('id as Id')->select('name as Name')->get('category')->result_array();
                break;
            case 'page':
                $entity = $this->db->select('id as Id')->select('title as Name')->get('content')->result_array();
                break;
            case 'main':
                $entity = array(array('Id' => 0, 'Name' => 'Главная'));
                break;
            default:
                break;
        }

        /** Show template with data */
        \CMSFactory\assetManager::create()
                ->setData('entity', $entity)
                ->render($this->input->post('tpl'), TRUE);
    }

}

/* End of file admin.php */

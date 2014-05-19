<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('new_level');
        $this->load->model('new_level_model');
        $currentTemplateName = \CI::$APP->db->get('settings')->row()->site_template;
        $this->path = TEMPLATES_PATH . $currentTemplateName;
    }

    /**
     * render admin page
     */
    public function index() {
        $settings = $this->new_level_model->getSettings();
        $categories = $this->new_level_model->getCategories();

        $thema = array();

        if ($handle = opendir($this->path . '/css/')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (!is_file($this->path . '/css/' . $file)) {
                        $thema[$file] = "css/$file";
                    }
                }
            }
            closedir($handle);
        }

        $cur_thema = $this->new_level_model->getthema();


//        \CMSFactory\assetManager::create()
//                ->registerScript('script')
//                ->setData(array('cur_thema' => $cur_thema, 'thema' => $thema, 'img' => '/templates/newLevel/' . $cur_thema . '/'))
//                ->renderAdmin('settings_thema');
//        }

        \CMSFactory\assetManager::create()
                ->registerScript('script')
                ->registerStyle('style')
                ->setData('properties', $this->new_level_model->getProperties())
                ->setData('property_types', $settings['propertiesTypes'])
                ->setData('categories', $categories)
                ->setData('columnCategories', $this->new_level_model->getColumnCategories())
                ->setData('columns', $settings['columns'])
                ->setData(array('cur_thema' => $cur_thema, 'thema' => $thema, 'img' => '/templates/newLevel/' . $cur_thema . '/'))
                ->renderAdmin('index');
    }

    /**
     * render settings page for theme
     */
    public function get_thema() {
        if ($_POST) {
            $settings = $this->new_level_model->getSettings();
            $settings['thema'] = $_POST['theme'];
            $sql = "update components set settings = '" . serialize($settings) . "' where name = 'new_level'";
            $this->db->query($sql);
        }
    }

    /**
     * save categories
     */
    public function saveCategories() {
        $categories_ids = $this->input->post('categories_ids');
        $column = $this->input->post('column');
        $this->new_level_model->clear_other_columns($categories_ids, $column);
        $this->new_level_model->saveCategories($categories_ids, $column);
    }

    /**
     * render settings page
     */
    public function settings() {
        \CMSFactory\assetManager::create()
                ->registerScript('script')
                ->setData('settings', $this->new_level_model->getSettings())
                ->renderAdmin('settings');
    }

    /**
     * add property type
     * @return string
     */
    public function addPropertyType() {
        $type = $this->input->post('type');
        $propertyId = $this->input->post('propertyId');
        if ($this->new_level_model->setPropertyType($propertyId, $type)) {
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * delete property type
     * @return type
     */
    public function deletePropertyType() {
        $type = $this->input->post('type');

        return $this->new_level_model->deletePropertyTypeFromSettings($type);
    }

    /**
     * edit property type
     * @return string
     */
    public function editPropertyType() {
        $oldType = $this->input->post('oldType');
        $newType = $this->input->post('newType');

        if ($this->new_level_model->editPropertyType($oldType, $newType)) {
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * add new type
     * @return type
     */
    public function addType() {
        $newType = $this->input->post('newType');
        $this->new_level_model->addType($newType);
        return $this->renderNewPropertyType($newType);
    }

    /**
     * render new property type template
     * @param string $type
     * @return type
     */
    public function renderNewPropertyType($type) {
        return \CMSFactory\assetManager::create()
                        ->setData('type', $type)
                        ->render('newPropertyType', true);
    }

    /**
     * remove property type 
     * @return string
     */
    public function removePropertyType() {
        $type = $this->input->post('type');
        $propertyId = $this->input->post('propertyId');
        if ($this->new_level_model->removePropertyType($propertyId, $type)) {
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * delete column
     * @return type
     */
    public function deleteColumn() {
        $column = $this->input->post('column');

        return $this->new_level_model->deleteColumnFromSettings($column);
    }

    /**
     * add new column
     * @return type
     */
    public function addColumn() {
        $newColumn = $this->input->post('newColumn');
        $this->new_level_model->addColumn($newColumn);
        return $this->renderNewColumn($newColumn);
    }

    /**
     * render new column template
     * @param string $column
     * @return type
     */
    public function renderNewColumn($column) {
        return \CMSFactory\assetManager::create()
                        ->setData('column', $column)
                        ->render('newColumn', true);
    }

    /**
     * edit column
     */
    public function editColumn() {
        $oldColumn = $this->input->post('oldColumn');
        $newColumn = $this->input->post('newColumn');

        $this->new_level_model->editColumn($oldColumn, $newColumn);
    }

}
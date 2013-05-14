<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Banners module.
 */
class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('banner_model');
        include 'application/modules/banners/helpers/banners.php';

        $locale = $this->db->where('default', 1)->get('languages')->result_array();
        $this->def_locale = $locale[0]['identif'];
        
        
        if(count($this->db->query("select * from components where name='shop'")->result_array())>0)
            $this->is_shop = true;
    }


    public function index() {
        /*
         * вывод всех баннеров
         */
        $locale = $this->def_locale;
        $banners = $this->banner_model->get_all_banner($locale);
        
        CMSFactory\assetManager::create()->setData(array('banners' => $banners, 'locale' => $locale))->renderAdmin('list');
    }

    public function chose_active() {
        
        /*
         * активность баннера (вкл / выкл)
         */
        $status = $_POST['status'] === 'false' ? 1 : 0;
        $this->banner_model->chose_active($_POST['id'], $status);
    }

    public function delete() {
        /*
         * удаление баннеров
         */
        $ids = $_POST['id'];
        foreach (json_decode($ids) as $key)
            $this->banner_model->del_banner($key);
    }
    
    
    public function create(){
        /*
         * создание баннера
         */
         if ($_POST) {
            
            $this->load->library('Form_validation');
            $this->form_validation->set_rules('name', lang('amt_dep_name'), 'required|xss_clean|max_length[45]'); 
            $this->form_validation->set_rules('photo', 'Фото', 'required|xss_clean'); 


            if ($this->form_validation->run($this) == FALSE)
                showMessage(validation_errors(),false,'r');
            
            else{
                $data['name'] = $_POST['name'];
                $data['active'] = (int)$_POST['active'];
                $data['description'] = $_POST['description'];
                $data['active_to'] = (int)strtotime($_POST['active_to']);
                $data['where_show'] = count($_POST['data']) ? serialize(array_unique($_POST['data'])) : serialize(array());
                $data['photo'] = $_POST['photo'];
                $data['url'] = $_POST['url'];
                $data['locale'] = $this->def_locale;

                
                $lid = $this->banner_model->add_banner($data);
                foreach($lan = $this->db->get('languages')->result_array() as $lan)
                    if ($lan['identif'] != $this->def_locale)
                        $this->banner_model->add_empty_banner($lid, $lan['identif']);
                showMessage('Даные сохранены перегрузите страницу');
                pjax('/admin/components/init_window/banners');

            }
            exit;
        }
        
        CMSFactory\assetManager::create()->registerScript('main')->registerStyle('style');


        CMSFactory\assetManager::create()->setData(array('is_shop' => $this->is_shop, 'locale' => $locale, 'languages' => $lan))->renderAdmin('create');
        
    }
    


    public function edit($id, $locale = null) {  
        /*
         * редактирования баннера
         */
        
        if ($locale == null)
            $locale = $this->def_locale;

        if ($_POST) {
            
            $this->load->library('Form_validation');
            $this->form_validation->set_rules('name', lang('amt_dep_name'), 'required|xss_clean|max_length[45]'); 
            $this->form_validation->set_rules('photo', 'Фото', 'required|xss_clean'); 


            if ($this->form_validation->run($this) == FALSE)
                showMessage(validation_errors(),false,'r');
            
            else{
                $data['name'] = $_POST['name'];
                $data['active'] = (int)$_POST['active'];
                $data['description'] = $_POST['description'];
                $data['active_to'] = (int)strtotime($_POST['active_to']);
                $data['where_show'] = count($_POST['data']) ? serialize(array_unique($_POST['data'])) : serialize(array());
                $data['photo'] = $_POST['photo'];
                $data['url'] = $_POST['url'];
                $data['locale'] = $locale;
                $data['id'] = (int)$id;
                
                $this->banner_model->edit_banner($data);
                showMessage('Даные сохранены');
            }
            exit;
        }

        $banner = $this->banner_model->get_one_banner($id, $locale);
        if (count($banner) == 0)
            $banner = $this->banner_model->get_one_banner_no_locale($id);
        
        CMSFactory\assetManager::create()->registerScript('main')->registerStyle('style');

        CMSFactory\assetManager::create()->setData(array('is_shop' => $this->is_shop,'banner' => $banner, 'locale' => $locale, 'languages' => $this->db->get('languages')->result_array()))->renderAdmin('edit');
    }

    public function autosearch() {
        
        /*
         * вывод объектов где будет отображаться баннер в автокомплити
         */

            switch ($_POST['queryString']) {
                case 'product':
                    $products = SProductsQuery::create()
                            ->joinWithI18n( $this->def_locale)
                            ->filterByActive(true)
                            ->withColumn('SProductsI18n.Name', 'Name')
                            ->select(array('Id','Name'))->find()->toArray();

                    $this->template->assign('entity', $products);                    
                    break;
                case 'shop_category':
                    $category_shop = SCategoryQuery::create()->joinWithI18n( $this->def_locale)->withColumn('SCategoryI18n.Name', 'Name')->select(array('Id','Name'))->find()->toArray();
                    $this->template->assign('entity', $category_shop);                    
                    break;
                case 'brand':
                    $brand = SBrandsQuery::create()->joinWithI18n( $this->def_locale)->withColumn('SBrandsI18n.Name', 'Name')->select(array('Id','Name'))->find()->toArray();
                    $this->template->assign('entity', $brand);                    
                    break;
                case 'category':
                    $category = $this->db->select('id as Id')->select('name as Name')->get('category')->result_array();
                    $this->template->assign('entity', $category);                    
                    break;
                case 'page':
                    $page = $this->db->select('id as Id')->select('title as Name')->get('content')->result_array();
                    $this->template->assign('entity', $page);                    
                    break;
                case 'main':
                    $main = array(array('Id' => 0, 'Name' => 'Главная'));
                    $this->template->assign('entity', $main);                    
                    break;

                default:
                    break;
            }
            \CMSFactory\assetManager::create()->render($_POST['tpl'], TRUE);
            exit();
        
    }

}

/* End of file admin.php */

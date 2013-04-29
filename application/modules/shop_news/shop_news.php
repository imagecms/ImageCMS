<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Shop news
 */
class Shop_news extends MY_Controller {
   
    public function __construct() {
        parent::__construct();
    }
   
    public static function adminAutoload() {
         \CMSFactory\Events::create()->on('BaseAdminPage:preEdit')->setListener('_extendPageAdmin');
    }
   
    public function _extendPageAdmin($shopNewsData){
        $shopNews = new Shop_news();
        
        $view = $shopNews->prepareInterface($shopNewsData, $shopNewsData['pageId']);
        \CMSFactory\assetManager::create()
                ->appendData('moduleAdditions', $view);
    }

    public function getShopNews($limit = 20){

        $this->load->model('shop_news_model');
        if ($this->core->core_data['data_type'] == 'shop_category'){
            $categoryId = $this->core->core_data['id']; 
        }elseif ($this->core->core_data['data_type'] == 'product'){
            $productId = $this->core->core_data['id'];
            $categoryId = $this->shop_news_model->getProductCategory($productId);
        }
        
        $contentIds = $this->shop_news_model->getContentIds($categoryId);
        $ids = array();
        foreach ($contentIds as $contentId){
            $ids[] .= $contentId['content_id'];
        }
        $content = $this->shop_news_model->getContent($ids, $limit);
        
        CMSFactory\assetManager::create()
                    ->setData(array('contentShopNews' => $content))
                    ->registerStyle('style')
                    ->registerScript('scripts')
                    ->render('content', true);
        
    }

    public function prepareInterface($data, $pageId){
        $currentCategories = $this->db->where('content_id', $pageId)->get('mod_shop_news')->row_array();
        $currentCategories = explode(',', $currentCategories['shop_categories_ids']);
        
        return \CMSFactory\assetManager::create()
                ->setData(array('shopNews' => $data, 'categories' => ShopCore::app()->SCategoryTree->getTree(),'currentCategories' => $currentCategories))
                ->registerScript('scripts')
                ->fetchTemplate('/admin/adminModuleInterface');
    }
    
    public function ajaxSaveShopCategories(){
        $data  = $this->input->post('data');
        $contentId = $this->input->post('contentId');
        $this->load->model('shop_news_model');
        
        $this->shop_news_model->saveCategories($contentId, $data);
        showMessage('Сохранено');
        
    }
    public function _install() {
       
        /** Create module's table **/
        ($this->dx_auth->is_admin()) OR exit;  
        $this->load->dbforge();
          
        $fields = array(
                    'content_id' => array('type' => 'INT', 'constraint' => 11),
                    'shop_categories_ids' => array('type' => 'VARCHAR', 'constraint' => 1000)
              );

        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_shop_news', TRUE);

        /** Update module settings **/
        $this->db->where('name', 'shop_news')
                 ->update('components', array('autoload' => '1', 'enabled' => '1'));

    }

    public function _deinstall() {
        
        $this->load->dbforge();
        $this->dbforge->drop_table('mod_shop_news');
    }

}

/* End of file sample_module.php */

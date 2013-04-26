<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Shop news
 */
class Shop_news extends MY_Controller {
   
    public function __construct() {
        parent::__construct();
        //$this->load->model('shop_news_model');
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

    
    public function prepareInterface($data, $pageId){
        $currentCategories = $this->db->where('content_id', $pageId)->get('mod_shop_news')->row_array();
        $currentCategories = explode(',', $currentCategories['shop_categories_ids']);
        
        return \CMSFactory\assetManager::create()
                ->setData(array('shopNews' => $data, 'categories' => ShopCore::app()->SCategoryTree->getTree(),'currentCategories' => $currentCategories))
                ->registerScript('script')
                ->fetchTemplate('/admin/adminModuleInterface');
    }
    
    public function ajaxSaveShopCategories(){
        $data  = $this->input->post('data');
        $contentId = $this->input->post('contentId');
        $this->saveCategories($contentId, $data);
        showMessage('Сохранено');
        
    }
    /**
     * To model!!!!!!!!!!!!!!!
     */
    public function saveCategories($contentId, $categories){
        if($this->db->where('content_id',$contentId)->get('mod_shop_news')->result_array() != null ){
            $this->db->where('content_id',$contentId)->update('mod_shop_news',  array('shop_categories_ids' => $categories));
        }else{
            $this->db->insert('mod_shop_news',  array('content_id'=>$contentId,'shop_categories_ids' => $categories));
        }
        return TRUE;
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

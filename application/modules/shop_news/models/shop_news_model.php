<?php

class Shop_news_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    /**
     * Save categories in wchich show content page
     * @param array $contentId
     * @param string $categories
     * @return boolean
     */
    public function saveCategories($contentId, $categories){
        if($this->db->where('content_id',$contentId)->get('mod_shop_news')->result_array() != null ){
            $this->db->where('content_id',$contentId)->update('mod_shop_news',  array('shop_categories_ids' => $categories));
        }else{
            $this->db->insert('mod_shop_news',  array('content_id'=>$contentId,'shop_categories_ids' => $categories));
        }
        return TRUE;
    }
    
    /**
     * Return array of content pages ids 
     * @param int $categoryId
     * @return type
     */
    public function getContentIds($categoryId){
       return $this->db->select('content_id')->like('shop_categories_ids', $categoryId)->get('mod_shop_news')->result_array();
    }
    
    /**
     * Return content pages for displaying in category
     * @param type $ids
     * @param type $limit
     * @return type
     */
    public function getContent($ids, $limit){
       if ($ids != null)
            return $this->db->where_in('id', $ids)->limit($limit)->get('content')->result_array(); 
    }
    /**
     * Return product category by product id
     * @param int $productId
     * @return int
     */
    public function getProductCategory($productId){
        $res = $this->db->select('category_id')->where('id', $productId)->get('shop_products')->row_array();
    
        return $res['category_id'];
    }
}
?>

<?php

class Shop_news_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    public function saveCategories($contentId, $categories){
        if($this->db->where('content_id',$contentId)->get('mod_shop_news')->result_array() != null ){
            $this->db->where('content_id',$contentId)->update('mod_shop_news',  array('shop_categoris_ids' => $categories));
        }else{
            $this->db->insert('mod_shop_news',  array('content_id'=>$contentId,'shop_categoris_ids' => $categories));
        }
        return TRUE;
    }
}
?>

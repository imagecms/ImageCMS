<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Discount_model_admin extends CI_Model {


    public function __construct(){
		parent::__construct();
    }
    
    /**
     * Get discounts List
     * 
     * @param int $row_count
     * @param int $offset
     */
    public function getDiscountsList($row_count = null, $offset = null) {
        
        $query = $this->db->get('mod_shop_discounts')->result_array();
        return $query;
        
    }
    
    /**
     * Change discount status active or not
     * @param int $id
     * @return string|boolean
     */
    public function changeActive($id) {
        $discount = $this->db->where('id',$id)->get('mod_shop_discounts')->row();
        $active = $discount->active;
        if ( $active == 1)
            $active = 0;
        else $active=1;

        if ($this->db->where('id',$id)->update('mod_shop_discounts',array('active'=>$active)))
            return 'true';
        
        return false;
    }
    
    /**
     * Get main currency symbol
     * @return boolean
     */
    public function getMainCurrencySymbol() {
        $query = $this->db->select('symbol')->where('main',1)->get('shop_currencies')->row_array();
        
        if ($query)
            return $query['symbol'];
        else
            return false;
        
    }
}

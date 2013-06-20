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
    
    /**
     * Check have any discoun with given key
     */
    public function checkDiscountCode($key) {
        $query = $this->db->where('key',$key)->get('mod_shop_discounts')->row_array();
    
        if ($query)
            return true;
        else
            return false;
    }
    
    /**
     * get users by id name email
     * @param string $term
     * @param int $limit
     */
    public function getUsersByIdNameEmail($term, $limit = 7) {
        $query = $this->db
                ->like('username', $term)
                ->or_like('email', $term)
                ->or_like('id', $term)
                ->limit($limit)
                ->get('users')
                ->result_array();
        
        if ($query)
            return $query;
        else
            return false;
                
    }
    
    /**
     * Get user groups
     * @param string $locale
     * @return boolean|array
     */
    public function getUserGroups($locale = 'ru') {
        
        $query = $this->db
                ->select('shop_rbac_roles.id, shop_rbac_roles_i18n.alt_name')
                ->from('shop_rbac_roles')
                ->join('shop_rbac_roles_i18n','shop_rbac_roles.id=shop_rbac_roles_i18n.id')
                ->where('locale',$locale)
                ->get()
                ->result_array();
        if ($query)
            return $query;
        else
            return false;
    }
    
    /**
     * 
     * @param string $term
     * @param int $limit
     */
    public function getProductsByIdNameNumber($term, $limit = 7) {
        $locale = MY_Controller::getCurrentLocale();
        $query = $this->db
                ->select('id, name')
                ->from('shop_products_i18n')
                ->where('locale', $locale )
                ->like('id', $term)
                ->or_like('name', $term)
                ->limit($limit)
                ->get()
                ->result_array();
        
        if ($query)
            return $query;
        else
            return false;
                
    }
}

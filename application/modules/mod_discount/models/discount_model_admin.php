<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Discount_model_admin extends CI_Model {


    public function __construct(){
		parent::__construct();
    }
    
    /**
     * Get discounts List
     * @param string $discountType
     * @param int $rowCount
     * @param int $offset
     * @return array
     */
    public function getDiscountsList($discountType = null, $rowCount = null, $offset = null) {
        
        $query = $this->db->order_by('active','desc')->order_by('id','desc');
                if ($discountType != null){
                $query = $query->where('type_discount',$discountType) ;
                }
                $query = $query->get('mod_shop_discounts')->result_array();
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
     * return boolean|array
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
     * @return boolean|array
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
    
    /**
     * Insert data, uses when create discount
     * @param string $tableName 
     * @param array $data 
     * @return boolean|int
     */
    public function insertDataToDB($tableName , $data) {
        try {
            $this->db->insert($tableName, $data);
            return $this->db->insert_id();
        }catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Update discount by id.
     * @param int $id
     * @param array $data
     * @return boolean
     */
    public function updateDiscountById($id , $data, $typeDiscountData) {
        $discountType = $data['type_discount'];
        $previousDiscount = $this->getDiscountAllDataById($id);
        
        $discountTypeTableNamePrevious = 'mod_discount_'.$previousDiscount['type_discount'];
        $discountTypeTableNameNew = 'mod_discount_'.$discountType;
        
        try {
            $this->db->where('id',$id)->update('mod_shop_discounts', $data);
            $this->db->where('discount_id',$id)->delete($discountTypeTableNamePrevious);
            $typeDiscountData['discount_id'] = $id;
            
            $this->db->insert($discountTypeTableNameNew, $typeDiscountData);
            
            return true;
        }catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Check have any comulativ discount max endValue
     * @return boolean
     */
    public function checkHaveAnyComulativDiscountMaxEndValue(){
        $query = $this->db->where('end_value',null)->or_where('end_value',0)->get('mod_discount_comulativ')->result_array();
        
        if (count($query))
            return true;
        else 
            return false;
    }
    
    /**
     * Get discount all data by id
     * @param int $id
     * @return boolean|array
     */
    public function getDiscountAllDataById($id) {
        $query = $this->db->from('mod_shop_discounts')->where('id',$id)->get()->row_array();
        
        $discountType = $query['type_discount'];
        
        if ($discountType)
            $queryDiscountType = $this->db->from('mod_discount_'.$discountType)->where('discount_id',$id)->get()->row_array();
        
        if ($queryDiscountType)
            $query[$discountType] = $queryDiscountType;
        
        if ($query)
            return $query;
        else 
            return false;
    }
    
    /**
     * Get username and email by id
     * @param int $id
     * @return string|boolean
     */
    public function getUserNameAndEmailById($id){
        
        $query = $this->db->select('username, email')->from('users')->where('id',$id)->get()->row_array();
        if ($query){
            $userInfo = $query['username'].' - '.$query['email'];
            return $userInfo;
        }
        
        return false;
    } 
    
    /**
     * Get product name by id
     * @param int $id
     * @return string|boolean
     */
    public function getProductById($id){
        $locale = MY_Controller::getCurrentLocale();
        $query = $this->db
                ->select('name')
                ->from('shop_products_i18n')
                ->where('id',$id)
                ->where('locale',$locale)
                ->get()
                ->row_array();
        
        if ($query)
            return $query['name'];
        
        return false;
    } 
    
    /**
     * Delete discount by id
     * @param type $id
     * @return boolean
     */
    public function deleteDiscountById($id) {
        $query = $this->db->from('mod_shop_discounts')->where('id',$id)->get()->row_array();
        $discountType = $query['type_discount'];
        
         try {
            $this->db->where('id',$id)->delete('mod_shop_discounts');
            $this->db->where('discount_id',$id)->delete('mod_discount_'.$discountType);
            return true;
        }catch (Exception $e) {
            return false;
        }
    }
    
    
    
}

<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

/**
 * @property Core $core
 */
class MY_Controller extends MX_Controller {

    public $pjaxRequest = false;
    public $ajaxRequest = false;

    public function __construct() {
        parent::__construct();
        
        if (in_array('X-PJAX', array_keys(getallheaders())))
        {
            $this->pjaxRequest = true;
            header('X-PJAX: true');
        }
        
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            $this->ajaxRequest = true;
        
        define('SHOP_INSTALLED', $this->checkForShop());
    }
    
        
    private function checkForShop()
    {
    if ($this->db)
    {
        $res = $this->db->where('identif', 'shop')
                ->get('components')
                ->result_array();
        
        return (bool) count($res);
    }
    else
    	return false;
    }

}

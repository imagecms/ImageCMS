<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public function __construct()
    {
        parent::__construct();

        $this->set_message('valid_date', 'Поле %s должно содержать правильную дату.');
    }

    // --------------------------------------------------------------------

    public function run($module = '', $group = '')
    {
        (is_object($module)) AND $this->CI =& $module;
        return parent::run($group);
    }

    /**
     * Valid Date (ISO format)
     *
     * @access    public
     * @param    string
     * @return    bool
     */
    public function valid_date($str)
    {
        if ( preg_match('/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2})/', $str) ) 
        {
            $arr = explode("-", $str);
            $yyyy = $arr[0]; 
            $mm = $arr[1];
            $dd = $arr[2];
            return (checkdate($mm, $dd, $yyyy));
        }
        else
        {
            return FALSE;
        }
    }
    
    /**
     * Validate time string
     * 
     * @param mixed $str time str. 
     * @access public
     * @return boolean
     */
    public function valid_time($str)
    {    
        if (preg_match('/([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/', $str))
            return TRUE;
        else
            return FALSE;
    }
    
}

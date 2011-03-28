<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public function __construct()
    {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Valid Date (ISO format)
     *
     * @access    public
     * @param    string
     * @return    bool
     */
    public function valid_date($str)
    {
        if ( ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $str) ) 
        {
            $arr = split("-", $str);    // splitting the array
            $yyyy = $arr[0];            // first element of the array is year
            $mm = $arr[1];              // second element is month
            $dd = $arr[2];              // third element is days
            return ( checkdate($mm, $dd, $yyyy) );
        } 
        else 
        {
            return FALSE;
        }
    }
    
    public function valid_time($str)
    {    
        if ( ereg("([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $str) ) 
        {
            return TRUE;
        } 
        else 
        {
            
            return FALSE;
        }
    }
    
}
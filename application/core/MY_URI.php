<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_URI extends CI_URI {

    private $GET_params_arr = array();

    public function __construct()
    {
        parent::__construct();
        parse_str( $_SERVER['QUERY_STRING'], $this->GET_params_arr );
    }

    public function getParam($key)
    {
        return $this->GET_params_arr[$key]; 
    }

    public function getAllParams()
    {
        return $this->GET_params_arr;
    }

    // Create from array string like: ?var1=value&var2=value
    public function array_to_uri($arr = array())
    {
        $n = 0;
        $str = '?';
        $cnt = count($arr);

        if ($cnt > 0)
        {
            foreach($arr as $k => $v)
            {
                $str .= $k.'='.$v; 
                $n++;
                if ($n < $cnt) $str .= '&';
            }
        }

        return $str;
    }

    /**
     * Enable Russian charaters in url
     */ 
    function _filter_uri($str)
    {
         if ($str != '' AND $this->config->item('permitted_uri_chars') != '')
         {
            if ( ! preg_match("|^[".($this->config->item('permitted_uri_chars'))."]+$|iu", rawurlencode($str)))
            {
                 exit('The URI you submitted has disallowed characters.');
            }
         }
             
         return $str;
    }

}
/* End of file MY_URI.php */

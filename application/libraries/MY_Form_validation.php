<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{

    function run($module = '', $group = '')
    {
        (is_object($module)) AND $this->CI =& $module;
        return parent::run($group);
    }
}
/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */
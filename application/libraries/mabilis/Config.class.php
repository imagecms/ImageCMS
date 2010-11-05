<?php

/***************************************************
 * Image CMS Template Engine (Mabilis TPL)
 *
 * Simple template engine for Image CMS based on regular expressions search and replace. 
 *
 * author: dev@imagecms.net
 * version: 0.2 Beta PHP5
 ***************************************************/

class Mabilis_Config{

    public $tpl_path; // Path to template files
    public $compile_path; // Path to compiled files
    public $function_path; // Path to compiled files
    public $function_ext  = '.php';
    public $use_filemtime = TRUE; // Recompile if tpl file modification time changed  

    public $compiled_ttl = 30; // Time to live compiled files

    // Delimiters will be rewrited as php open/close tags
    public  $l_delim = '{'; // Left delimiter 
    public  $r_delim = '}'; // Right delimiter
    public  $force_compile = TRUE;
    public  $compiled_ext  = '.php';

    public  $delimiters = array('{', '}');
    public  $php_delimiters = array('<?php ', ' ?>');


    function __construct($config = array())
    {
        $this->function_path = realpath(dirname(__FILE__)) . '/functions/'; 
    
        if (count($config) > 0)
        {
            $this->initialize($config);
        }
    }

    /**
     * Initialize config params
     *
     * @access pubic
     */ 
    public function initialize($config = array())
    {
        if (count($config) > 0)
        {
            foreach ($config as $key => $val) 
            {
                //if (isset($this->$key))
                //{
                    $this->$key = $val;
                //}                
            }
        }
    }


}

/* End of Config.class.php */

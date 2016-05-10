<?php

/** *************************************************
 * Image CMS Template Engine (Mabilis TPL)
 *
 * Simple template engine for Image CMS based on regular expressions search and replace.
 *
 * @author <dev@imagecms.net>
 * @version 0.3 PHP5
 ************************************************* */

class Mabilis_Config
{

    /**
     * @var string
     */
    public $tpl_path; // Path to template files

    /**
     * @var string
     */
    public $compile_path; // Path to compiled files

    /**
     * @var string
     */
    public $function_path; // Path to compiled files

    /**
     * @var string
     */
    public $function_ext = '.php';

    /**
     * @var bool
     */
    public $use_filemtime = TRUE; // Recompile if tpl file modification time changed

    /**
     * @var int
     */
    public $compiled_ttl = 120; // Time to live compiled files

    /**
     * Delimiters will be rewrited as php open/close tags
     * @var string
     */
    public $l_delim = '{'; // Left delimiter

    /**
     * @var string
     */
    public $r_delim = '}'; // Right delimiter

    /**
     * @var bool
     */
    public $force_compile = TRUE;

    /**
     * @var string
     */
    public $compiled_ext = '.php';

    /**
     * @var array
     */
    public $delimiters = [
                          '{',
                          '}',
                         ];

    /**
     * @var array
     */
    public $php_delimiters = [
                              '<?php ',
                              ' ?>',
                             ];

    /**
     * Mabilis_Config constructor.
     * @param array $config
     */
    public function __construct($config = []) {
        $this->function_path = realpath(__DIR__) . '/functions/';

        if (count($config) > 0) {
            $this->initialize($config);
        }
    }

    /**
     * Initialize config params
     *
     * @access pubic
     * @param array $config
     */
    public function initialize($config = []) {
        if (count($config) > 0) {
            foreach ($config as $key => $val) {
                $this->$key = $val;
            }
        }
    }

}

/* End of Config.class.php */
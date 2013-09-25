<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Template Class
 */
require 'mabilis/Mabilis.class.php';

class Template extends Mabilis {

    public $template_vars = array();

    public function __construct() {
        
        $this->load();
        if (file_exists('templates/' . $this->CI->config->item('template') . '/shop/helpers/helper.php'))
            require_once 'templates/' . $this->CI->config->item('template') . '/shop/helpers/helper.php';
    }

    public function load() {
        $this->CI = & get_instance();
        $this->modules_template_dir = TEMPLATES_PATH . 'modules/';
        $tpl = $this->CI->config->item('template');
        $config = array(
            'tpl_path' => TEMPLATES_PATH . $tpl . '/',
            'compile_path' => $this->CI->config->item('tpl_compile_path'),
            'force_compile' => $this->CI->config->item('tpl_force_compile'),
            'compiled_ttl' => $this->CI->config->item('tpl_compiled_ttl'),
            'compress_output' => $this->CI->config->item('tpl_compress_output'),
            'use_filemtime' => $this->CI->config->item('tpl_use_filemtime')
        );
        $this->load_config($config);

        $this->template_dir = $config['tpl_path'];

        /** URL to JS folder */
        $this->assign('JS_URL', base_url() . 'js');
        /** URL to template folder */
        $this->assign('THEME', base_url() . 'templates/' . $tpl . '/');
        $this->assign('CI', $this->CI);
    }

    public function assign($key, $value) {
        $this->template_vars[$key] = $value;
    }

    /**
     * Add array to template data
     *
     * @arr array
     * @return bool
     */
    public function add_array($arr) {
        if (count($arr) > 0) {
            $this->template_vars = array_merge($this->template_vars, $arr);

            return TRUE;
        }
        return FALSE;
    }

    /**
     * Display template file included in main.tpl if $load_main is TRUE
     *
     * @access public
     * @return true
     */
    public function show($file = FALSE, $load_main = TRUE, $data = array()) {
        $CI = &get_instance();
        if ($CI->uri->segment(1) == 'admin') {
            $load_main = (!$CI->input->is_ajax_request()) ? TRUE : FALSE;
        }

        $this->assign('BASE_URL', site_url()); //Base URL

        if (sizeof($data) > 0)
            $this->add_array($data);

        if ($file != FALSE) {
            $this->add_array(array('content' => $this->fetch($file . '.tpl')));
        }


        ob_start();
        $load_main == TRUE ? $this->view('main.tpl', $this->template_vars) : $this->view($file . '.tpl', $this->template_vars);
        $result = ob_get_contents();
        ob_end_clean();

        $result = $this->splitTplFiles($result);
        echo $result;
    }

    public function clear_all_assign() {
        $this->template_vars = array();
    }

    public function get_var($var) {
        return isset($this->template_vars[$var]) ? $this->template_vars[$var] : false;
    }

    public function run_info() {
        /*         * ********************* */
//        echo '<!--';
        echo '<div align="center">';
        echo 'Total Time:' . $this->CI->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end') . ', ';
        echo 'Queries: ' . $this->CI->db->total_queries();
        echo ', Cache get: ' . $this->CI->cache->get;
        echo ', Cache set: ' . $this->CI->cache->set;
        echo ', Memory Usage: ' . round(memory_get_usage() / 1024 / 1024, 4) . ' Mb';
        echo '</div>';
//        echo ' -->';
        /*         * ********************* */
    }

    /**
     * Fetch file
     *
     * @access public
     */
    public function read($file = FALSE, $data = array()) {
        if (count($data) > 0) {
            $this->add_array($data);
        }

        $this->assign('BASE_URL', site_url()); //Base URL
        return $this->view($file . '.tpl', $this->template_vars, TRUE);
    }

    public function fetch($file = FALSE, $data = array()) {
        return $this->read($file, $data);
    }

    public function display($file, $data = array(), $processOutput = true) {
        if (sizeof($data) > 0) {
            $this->add_array($data);
        }

        $this->assign('BASE_URL', site_url()); //Base URL
        $result = $this->view($file . '.tpl', $this->template_vars, true);
        if ($processOutput === true)
            echo $this->splitTplFiles($result);
        else
            echo $result;
    }

    public function view($file, $data = array(), $return = FALSE) {
        $file = preg_replace('/.tpl.tpl/', '.tpl', $file);

        return $this->splitTplFiles(parent::view($file, $data, $return));
    }

    public function include_tpl($name, $path) {
        $this->display('file:' . $path . '/' . $name);
    }

    public function include_shop_tpl($name, $path) {
        $this->display('file:' . $path . '/shop/' . $name);
    }

    /////////////////////////////////////////////////////////////////////////////////////////
    private $_css_files = array();
    private $_js_files = array();
    private $_js_code = array();
    private $_css_code = array();
    private $_css_str = array();
    private $_css_code_pos = array();
    private $_js_code_pos = array();
    private $_metas = array();
    private $_canonicals = array();
    private static $arr = array();
    private static $result_before = '';
    private static $result_after = '';

    /**
     * is tpl trimed
     * @var bool
     */
    public $trimed = false;

//    public function registerCssCode($name, $code, $position = 'before') {
//        $position = $this->_check_postion($position);
//        $this->_css_code[$name] = $code;
//        $this->_css_code_pos[$name] = $position;
//    }
//
//    public function registerJsCode($name, $code, $position = 'before') {
//        $position = $this->_check_postion($position);
//        $this->_js_code[$name] = $code;
//        $this->_js_code_pos[$name] = $position;
//    }
    // $position possible values: before, after
    public function registerCssFile($url, $position = 'before') {
        $position = $this->_check_postion($position);
        $this->_css_files[media_url($url)] = $position;
    }

    public function registerCss($css, $position = 'before') {
        $position = $this->_check_postion($position);
        $this->_css_str[$css] = $position;
    }

    public function registerJsFile($url, $position = 'before') {
        $position = $this->_check_postion($position);
        $this->_js_files[media_url($url)] = $position;
    }

    public function registerJsScript($script, $position = 'before') {
        $position = $this->_check_postion($position);
        $this->_js_script_files[$script] = $position;
    }

    /**
     * Place meta code before /head
     * @param type $name meta name
     * @param type $content meta content
     */
    public function registerMeta($name, $content) {
        $this->_metas[] = '<META NAME="' . $name . '" CONTENT="' . $content . '">';
    }

    /**
     * Place canonical code before /head
     * @param type $url canonical url
     */
    public function registerCanonical($url) {
        $this->_canonicals[] = "<link href='" . $url . "' rel='canonical'>";
    }

    /**
     *
     * @param string $position
     * @return string
     */
    private function _check_postion($position) {
        if ($position != 'before' AND $position != 'after')
            return $position = 'before';
        return $position;
    }

    public function splitTplFiles($tpl) {
//        $result_before = '';
//        $result_after = '';
//        $result_css_before = '';
//        $result_css_after = '';
//        $result_js_before = '';
//        $result_js_after = '';
        // split css files
        //self::$arr++;
        if (!$this->trimed) {
            $tpl = trim($tpl);
            $this->trimed = TRUE;
        }

        if (sizeof($this->_css_files) > 0) {
            foreach ($this->_css_files as $url => $pos) {
                if (!in_array($url, self::$arr)) {
                    switch ($pos) {
                        case 'before':
                            self::$result_before .= "<link data-arr=\"" . count(self::$arr) * 2 . "\" rel=\"stylesheet\" type=\"text/css\" href=\"$url\" />\n";
                            break;
                        case 'after':
                            self::$result_after .= "<link data-arr=\"" . count(self::$arr) . "\" rel=\"stylesheet\" type=\"text/css\" href=\"$url\" />\n";
                            break;
                    }
                    self::$arr[] = $url;
                }
            }
        }

        // split js files
        if (sizeof($this->_js_files) > 0) {
            foreach ($this->_js_files as $url => $pos) {
                if (!in_array($url, self::$arr)) {
                    switch ($pos) {
                        case 'before':
                            self::$result_before .= "<script type=\"text/javascript\" src=\"$url\"></script>\n";
                            break;
                        case 'after':
                            self::$result_after .= "<script type=\"text/javascript\" src=\"$url\"></script>\n";
                            break;
                    }
                    self::$arr[] = $url;
                }
            }
        }

        if (sizeof($this->_js_script_files) > 0) {
            foreach ($this->_js_script_files as $script => $pos) {
                if (!in_array($script, self::$arr)) {
                    switch ($pos) {
                        case 'before':
                            self::$result_before .= $script;
                            break;
                        case 'after':
                            self::$result_after .= $script;
                            break;
                        default :
                            self::$result_before .= $script;
                            break;
                    }
                    self::$arr[] = $script;
                }
            }
        }

        if (sizeof($this->_css_str) > 0) {
            foreach ($this->_css_str as $css => $pos) {
                if (!in_array($css, self::$arr)) {
                    switch ($pos) {
                        case 'before':
                            self::$result_before .= $css;
                            break;
                        case 'after':
                            self::$result_after .= $css;
                            break;
                        default :
                            self::$result_before .= $css;
                            break;
                    }
                    self::$arr[] = $css;
                }
            }
        }


//        // split css code
//        if (sizeof($this->_css_code) > 0) {
//            foreach ($this->_css_code as $key => $code) {
//                switch ($this->_css_code_pos[$key]) {
//                    case 'before':
//                        $result_css_before .= "$code\n";
//                        break;
//                    case 'after':
//                        $result_css_after .= "$code\n";
//                        break;
//                }
//            }
//        }
//
//        // split js code
//        if (sizeof($this->_js_code) > 0) {
//            foreach ($this->_js_code as $key => $code) {
//                switch ($this->_js_code_pos[$key]) {
//                    case 'before':
//                        $result_js_before .= "$code\n";
//                        break;
//                    case 'after':
//                        $result_js_after .= "$code\n";
//                        break;
//                }
//            }
//        }
        if (sizeof($this->_metas) > 0) {
            foreach ($this->_metas as $code) {
                if (!strstr(self::$result_before, $code)) {
                    self::$result_before .= "$code\n";
                }
            }
        }
        if (sizeof($this->_canonicals) > 0) {
            foreach ($this->_canonicals as $code) {
                if (!strstr(self::$result_before, $code)) {
                    self::$result_before .= "$code\n";
                }
            }
        }

//        $js_tpl_begin = "window.addEvent('domready', function() { ";
//        $js_tpl_end = " });";


        if (self::$result_before)
            if ($this->CI->input->is_ajax_request())
                $tpl = self::$result_before . $tpl;
            else
            if (!strstr($tpl, self::$result_before))
                $tpl = preg_replace('/\<\/head\>/', self::$result_before . '</head>' . "\n", $tpl, 1);

        if (self::$result_after)
            if ($this->CI->input->is_ajax_request())
                $tpl .= self::$result_after;
            else
            if (!strstr($tpl, self::$result_after))
                $tpl = preg_replace('/(\<\/body>(\s*|\n)<\/html>)(\s*|\n)$/', self::$result_after . "</body></html>", $tpl, 1);

//
//        if ($result_js_before) {
//            $result_js_before = "<script type=\"text/javascript\">$js_tpl_begin\n$result_js_before\n$js_tpl_end</script>\n";
//            $tpl = preg_replace('/\<\/head\>/', $result_js_before . "</head>\n", $tpl, 1);
//        }
//
//        if ($result_js_after) {
//            $result_js_after = "<script type=\"text/javascript\">$js_tpl_begin\n$result_js_after\n$js_tpl_end</script>\n";
//            $tpl = preg_replace('/\<\/html\>/', "</html>\n" . $result_js_after, $tpl, 1);
//        }
//
//        if ($result_css_before) {
//            $result_css_before = "<style type=\"text/css\">\n$result_css_before\n</style>\n";
//            $tpl = preg_replace('/\<\/head\>/', $result_css_before . "</head>\n", $tpl, 1);
//        }
//
//        if ($result_css_after) {
//            $result_css_after = "<style type=\"text/css\">\n$result_css_after\n</style>\n";
//            $tpl = preg_replace('/\<\/html\>/', "</html>\n" . $result_css_after, $tpl, 1);
//        }



        return $tpl;
    }

}

/* End of template.php */


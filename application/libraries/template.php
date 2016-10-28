<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 * Template Class
 */
require 'mabilis/Mabilis.class.php';

class Template extends Mabilis
{

    protected $main_layout = 'main';

    public $modules_template_dir;

    public $template_dir;

    public $template_vars = [];

    private $_css_files = [];

    private $_js_files = [];

    private $_links = [];

    private $_css_str = [];

    private $_custom_strings = [];

    private $_metas = [];

    private $_canonicals = '';

    private static $arr = [];

    private static $result_before = '';

    private static $result_after = '';

    /**
     * is tpl trimmed
     * @var bool
     */
    public $trimed = false;

    /**
     *
     * @var MY_Controller
     */
    public $CI;

    public function __construct() {
        $this->load();
        if (file_exists('templates/' . $this->CI->config->item('template') . '/shop/helpers/helper.php')) {
            include_once 'templates/' . $this->CI->config->item('template') . '/shop/helpers/helper.php';
        }
    }

    /**
     *
     * @param string $main_layout
     * @throws Exception
     */
    public function set_main_layout($main_layout) {
        $layoutPath = 'templates/' . $this->CI->config->item('template') . "/{$main_layout}.tpl";
        if (!is_string($main_layout) || !file_exists($layoutPath)) {
            throw new Exception(lang('Main layout file don\'t exist', 'main'));
        }
        $this->main_layout = $main_layout;
    }

    /**
     *
     * @param string $main_layout_full_path
     * @throws Exception
     */
    public function set_main_layout_by_full_path($main_layout_full_path) {
        $layoutPath = "dir:{$main_layout_full_path}.tpl";

        $this->main_layout = $layoutPath;
    }

    public function load() {
        $this->CI = &get_instance();
        $this->modules_template_dir = TEMPLATES_PATH . 'modules/';
        $tpl = $this->CI->config->item('template');

        if (MAINSITE and $tpl == 'administrator' and !is_dir(TEMPLATES_PATH . 'administrator')) {
            $config = [
                       'tpl_path'        => str_replace('system/', '', BASEPATH) . 'templates/' . $tpl . '/',
                       'compile_path'    => $this->CI->config->item('tpl_compile_path'),
                       'force_compile'   => $this->CI->config->item('tpl_force_compile'),
                       'compiled_ttl'    => $this->CI->config->item('tpl_compiled_ttl'),
                       'compress_output' => $this->CI->config->item('tpl_compress_output'),
                       'use_filemtime'   => $this->CI->config->item('tpl_use_filemtime'),
                      ];
        } else {
            $config = [
                       'tpl_path'        => TEMPLATES_PATH . $tpl . '/',
                       'compile_path'    => $this->CI->config->item('tpl_compile_path'),
                       'force_compile'   => $this->CI->config->item('tpl_force_compile'),
                       'compiled_ttl'    => $this->CI->config->item('tpl_compiled_ttl'),
                       'compress_output' => $this->CI->config->item('tpl_compress_output'),
                       'use_filemtime'   => $this->CI->config->item('tpl_use_filemtime'),
                      ];
        }
        /** URL to template folder */
        $this->assign('THEME', base_url() . 'templates/' . $tpl . '/');
        $this->assign('JS_URL', base_url() . 'js');

        $this->load_config($config);

        $this->template_dir = $config['tpl_path'];

        /** URL to JS folder */
        $this->assign('TEMPLATE', $tpl);
        $this->assign('CI', $this->CI);
    }

    /**
     *
     * @param string $key
     * @param string|array $value
     */
    public function assign($key, $value) {
        $this->template_vars[$key] = $value;
    }

    /**
     * Add array to template data
     *
     * @param $arr
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
     * @param string|boolean $file
     * @param boolean $load_main
     * @param array $data
     * @return boolean|null
     */
    public function show($file = FALSE, $load_main = TRUE, $data = []) {
        $CI = &get_instance();
        if ($CI->uri->segment(1) == 'admin') {
            $load_main = (!$CI->input->is_ajax_request()) ? TRUE : FALSE;
        }

        $this->assign('BASE_URL', site_url()); //Base URL

        if (count($data) > 0) {
            $this->add_array($data);
        }

        if ($file != FALSE) {
            $content = $data['js_langs_path'] ? $this->fetch($data['js_langs_path']) : '';
            $content .= $this->fetch($file . '.tpl');
            $this->add_array(['content' => $content]);
        }

        ob_start();
        $load_main == TRUE ? $this->view($this->main_layout . '.tpl', $this->template_vars) : $this->view($file . '.tpl', $this->template_vars);
        $result = ob_get_contents();
        ob_end_clean();

        $result = $this->splitTplFiles($result);
        echo $result;

        if (config_item('enable_profiler') && !\CI::$APP->input->is_ajax_request()) {
            \CI::$APP->output->enable_profiler(TRUE);
        }
    }

    public function clear_all_assign() {
        $this->template_vars = [];
    }

    /**
     *
     * @param string $name
     */
    public function clear_assign($name) {
        $this->template_vars[$name] = null;
    }

    /**
     *
     * @param string $var
     * @return string|integer|float|array|boolean
     */
    public function get_var($var) {
        return isset($this->template_vars[$var]) ? $this->template_vars[$var] : false;
    }

    /**
     *
     * @return string|integer|float|array|boolean
     */
    public function get_vars() {
        return $this->template_vars ?: [];
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
     * @param boolean|string $file
     * @param array $data
     * @return string
     */
    public function read($file = FALSE, $data = []) {
        if (count($data) > 0) {
            $this->add_array($data);
        }

        $this->assign('BASE_URL', site_url()); //Base URL
        return $this->view($file . '.tpl', $this->template_vars, TRUE);
    }

    /**
     *
     * @param boolean|string $file
     * @param array $data
     * @return string
     */
    public function fetch($file = FALSE, $data = []) {
        return $this->read($file, $data);
    }

    /**
     *
     * @param string $file
     * @param array $data
     * @param boolean $processOutput
     */
    public function display($file, $data = [], $processOutput = true) {
        if (count($data) > 0) {
            $this->add_array($data);
        }

        $this->assign('BASE_URL', site_url()); //Base URL
        $result = $this->view($file . '.tpl', $this->template_vars, true);
        if ($processOutput === true) {
            echo $this->splitTplFiles($result);
        } else {
            echo $result;
        }
    }

    /**
     *
     * @param string $file
     * @param array $data
     * @param boolean $return
     * @return string
     */
    public function view($file, $data = [], $return = FALSE) {
        return $this->splitTplFiles(parent::view($file, $data, $return));
    }

    /**
     *
     * @param string $name
     * @param string $path
     * @param array $data
     * @param boolean $processOutput
     */
    public function include_tpl($name, $path, $data = [], $processOutput = true) {
        $path = $path ?: TEMPLATES_PATH . $this->CI->config->item('template');
        $this->display('file:' . $path . '/' . $name, $data, $processOutput);
    }

    /**
     *
     * @param string $name
     * @param string $path
     * @param array $data
     * @param boolean $processOutput
     */
    public function include_shop_tpl($name, $path, $data = [], $processOutput = true) {
        $path = $path ?: TEMPLATES_PATH . $this->CI->config->item('template');
        $this->display('file:' . $path . '/shop/' . $name, $data, $processOutput);
    }

    /**
     *
     * @param string $url
     * @param string $position
     */
    public function registerCssFile($url, $position = 'before') {
        if (file_exists('./' . $url) && filesize('./' . $url) == 0) {
            return;
        }
        $position = $this->_check_postion($position);
        $this->_css_files[media_url($url)] = $position;
    }

    /**
     *
     * @param string $css
     * @param string $position
     */
    public function registerCss($css, $position = 'before') {
        $position = $this->_check_postion($position);
        $this->_css_str[$css] = $position;
    }

    /**
     *
     * @param string $url
     * @param string $position
     * @param boolean $fromThisSite
     */
    public function registerJsFile($url, $position = 'before', $fromThisSite = TRUE) {
        if (file_exists('./' . $url) && filesize('./' . $url) == 0) {
            return;
        }
        $position = $this->_check_postion($position);
        if ($fromThisSite === TRUE) {
            $this->_js_files[media_url($url)] = $position;
        } else {
            $this->_js_files[$url] = $position;
        }
    }

    /**
     *
     * @param string $script
     * @param string $position
     */
    public function registerJsScript($script, $position = 'before') {
        $position = $this->_check_postion($position);
        $this->_js_script_files[$script] = $position;
    }

    /**
     * @param string $script
     * @param string $position
     */
    public function registerString($script, $position = 'before') {
        $position = $this->_check_postion($position);
        $this->_custom_strings[$script] = $position;
    }

    /**
     * Place meta code before /head
     * @param string $name meta name
     * @param string $content meta content
     */
    public function registerMeta($name, $content) {
        $this->_metas[] = '<META NAME="' . $name . '" CONTENT="' . $content . '">';
    }

    /**
     *
     * @param string $url
     * @param string $rel
     */
    public function registerLink($url, $rel) {
        $this->_links[] = "<link href='$url' rel='$rel'>";
    }

    /**
     * Place canonical code before /head
     * @param string $url canonical url
     */
    public function registerCanonical($url) {
        if ($url != '') {
            $this->_canonicals = "<link href='" . $url . "' rel='canonical'>";
        }
    }

    /**
     *
     * @param string $position
     * @return string
     */
    private function _check_postion($position) {
        if ($position != 'before' AND $position != 'after') {
            return $position = 'before';
        }
        return $position;
    }

    /**
     *
     * @param string $tpl
     * @return string
     */
    public function splitTplFiles($tpl) {
        if (false === strpos($tpl, '</html>')) {
            return $tpl;
        }

        if (!$this->trimed) {
            $tpl = trim($tpl);
            $this->trimed = TRUE;
        }

        if (count($this->_css_files) > 0) {
            foreach ($this->_css_files as $url => $pos) {
                if (!in_array($url, self::$arr)) {
                    switch ($pos) {
                        case 'before':
                            self::$result_before .= '<link data-arr="' . count(self::$arr) * 2 . "\" rel=\"stylesheet\" type=\"text/css\" href=\"$url\" />\n";
                            break;
                        case 'after':
                            self::$result_after .= '<link data-arr="' . count(self::$arr) . "\" rel=\"stylesheet\" type=\"text/css\" href=\"$url\" />\n";
                            break;
                    }
                    self::$arr[] = $url;
                }
            }
        }

        // split js files
        if (count($this->_js_files) > 0) {
            foreach ($this->_js_files as $url => $pos) {
                if (!in_array($url, self::$arr) and $url != '') {
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

        $this->split($this->_js_script_files);

        $this->split($this->_css_str);

        $this->split($this->_custom_strings);

        $this->split(array_flip($this->_metas));

        self::$result_before .= $this->_canonicals;

        $this->split(array_flip($this->_links));

        if (self::$result_before) {
            if (!$this->CI->input->is_ajax_request()) {
                $tpl = preg_replace('/\<\/head\>/', self::$result_before . '</head>' . "\n", $tpl, 1);
            }
        }

        if (self::$result_after) {
            if (!$this->CI->input->is_ajax_request()) {
                $tpl = preg_replace('/(\<\/body>(\s*|\n)<\/html>)(\s*|\n)$/', self::$result_after . '</body></html>', $tpl, 1);
            }
        }

        return $tpl;
    }

    /**
     *
     * @param array $data
     */
    protected function split($data) {
        $count = count($data);
        if ($count > 0) {
            foreach ($data as $str => $pos) {
                /** @noinspection NotOptimalIfConditionsInspection */
                if (!in_array($str, self::$arr) && $str != '') {
                    switch ((string) $pos) {
                        case 'before':
                            self::$result_before .= $str;
                            break;

                        case 'after':
                            self::$result_after .= $str;
                            break;

                        default :
                            self::$result_before .= $str;
                            break;
                    }
                    self::$arr[] = $str;
                }
            }
        }
    }

}

/* End of template.php */
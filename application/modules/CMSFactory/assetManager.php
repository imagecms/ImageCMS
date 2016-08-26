<?php

namespace CMSFactory;

use CI;
use CI_Controller;
use CI_Input;
use CSSmin;
use Exception;
use Modules;
use MY_Controller;
use template_manager\classes\Template;

/**
 * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
 * @property CI_Input $input
 */
class assetManager
{

    /**
     * @var assetManager
     */
    protected static $_BehaviorInstance;

    /**
     * @var array
     */
    protected $callMapp;

    /**
     *
     * @var MY_Controller
     */
    protected $ci;

    /**
     * @var string
     */
    protected $module_js = 'jsLangs';

    /**
     *
     * @var Template
     */
    protected $template;

    /**
     * @var bool
     */
    protected $useCompress = false;

    /**
     * assetManager constructor.
     */
    private function __construct() {

    }

    private function __clone() {

    }

    /**
     * @param string|array $item
     * @param string|integer|float $value
     * @return assetManager
     * @access public
     * @copyright ImageCMS (c) 2013, Roman <dev@imagecms.net>
     */
    public function appendData($item, $value) {
        $this->setData($item, CI_Controller::get_instance()->template->get_var($item) . $value);
        return $this;
    }

    /**
     * @param string|array $item
     * @param string|integer|float|array|boolean $value
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function setData($item, $value = null) {
        if ($value != null AND !is_array($item)) {
            $data[$item] = $value;
        } else {
            $data = $item;
        }
        (empty($data)) OR CI_Controller::get_instance()->template->add_array((array) $data);
        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public static function create() {
        (null !== self::$_BehaviorInstance) OR self::$_BehaviorInstance = new self();
        self::$_BehaviorInstance->callMapp = debug_backtrace();
        return self::$_BehaviorInstance;
    }

    /**
     * fetch admin view
     * @param string $tpl Template file name
     * @param boolean $fetchLangsTpl
     * @return string
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function fetchAdminTemplate($tpl, $fetchLangsTpl = TRUE) {
        try {

            if ($fetchLangsTpl) {
                /** Start. Load template file */
                $view = CI_Controller::get_instance()->template->fetch('file:' . $this->_buildTemplatePath($this->module_js));
            }

            if (isset($view)) {
                return $view . CI_Controller::get_instance()->template->fetch('file:' . $this->_buildTemplatePath($tpl, null, true));
            } else {
                return CI_Controller::get_instance()->template->fetch('file:' . $this->_buildTemplatePath($tpl, null, true));
            }
            /** Start. Return template file */
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
    }

    /**
     * fetch public view
     * @param string $tpl Template file name
     * @param string $moduleName
     * @return string
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function fetchTemplate($tpl, $moduleName = null) {
        try {
            /** Start. Return template file */
            return CI_Controller::get_instance()->template->fetch('file:' . $this->_buildTemplatePath($tpl, $moduleName));
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
    }

    /**
     * @param string $item
     * @return string|integer|float|array|boolean
     * @access public
     * @author
     * @copyright
     */
    public function getData($item) {
        return CI_Controller::get_instance()->template->get_var($item);
    }

    /**
     *
     * @param string $path
     * @param string $position
     * @return assetManager
     */
    public function registerJsFullpath($path, $position = 'after') {
        CI_Controller::get_instance()->template->registerJsFile($path, $position, false);
        return $this;
    }

    /**
     * @param string $message
     * @param string $title
     * @param string $class
     */
    public function registerJsMessage($message, $title, $class = '') {
        $script = showMessage($message, $title, $class, true, true);
        CI_Controller::get_instance()->template->registerJsScript($script, 'after');
    }

    /**
     * @access public
     * @author a.gula
     * @param string $script
     * @param boolean $useCompress
     * @param string $position after|before
     * @param string $type
     * @return assetManager
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    public function registerJsScript($script, $useCompress = FALSE, $position = 'after', $type = 'text/javascript') {
        /** Start. Load JS script into template */
        if ($useCompress) {
            CI_Controller::get_instance()->template->registerJsScript("<script type='$type'>" . $this->compressJs($script) . '</script>', $position);
        } else {
            CI_Controller::get_instance()->template->registerJsScript("<script type='$type'>" . $script . '</script>', $position);
        }

        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @param string $name
     * @param boolean $useCompress
     * @param string $position
     * @return assetManager
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerScript($name, $useCompress = FALSE, $position = 'after') {
        /** Start. Load JS file into template */
        if ($useCompress) {
            CI_Controller::get_instance()->template->registerJsScript('<script>' . $this->compressJs(file_get_contents($this->buildScriptPath($name))) . '</script>', $position);
        } else {
            CI_Controller::get_instance()->template->registerJsFile('/' . $this->buildScriptPath($name), $position);
        }

        return $this;
    }

    /**
     * @param string $js
     * @return string
     * @todo compress and cache
     */
    private function compressJs($js) {
        return $js;
    }

    /**
     * Return formated path for JS - script files
     * @param string $fileName
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildScriptPath($fileName) {
        $this->template = CI_Controller::get_instance()->config->item('template');

        $moduleName = $this->getTrace();
        $path = sprintf('templates/%s/%s/js/%s.js', $this->template, $moduleName, $fileName);
        if (file_exists($path)) {
            $url = $path;
        } else {
            $url = $this->getModuleFilePath(
                [
                 sprintf('%s/assets/js/%s.js', $moduleName, $fileName),
                 sprintf('%s/assets/js/%s.js', CI::$APP->uri->segment(4), $fileName),
                ],
                false
            );
        }

        return str_replace(MAINSITE, '', $url);
    }

    /**
     * @param string $list
     * @return array
     * @access public
     * @author cutter
     */
    private function getTrace($list = 'first_file') {
        if ($list == 'first_file') {
            $paths = explode(DIRECTORY_SEPARATOR, $this->callMapp[0]['file']);
            return $paths[count($paths) - 2];
        }

        if ($list == 'first') {
            return $this->callMapp[0];
        }

        if ($list == 'all') {
            return $this->callMapp;
        }
        if (is_numeric($list)) {
            return $this->callMapp[$list];
        }
        return false;
    }

    /**
     * Checks if file exists in any of modules dirs. If exists returns its path
     * @param string|array $files example: ['menu/assets/css/style.css']
     * @param bool $noExt
     * @return bool|string returns file path or FALSE
     */
    private function getModuleFilePath($files, $noExt = true) {

        if (is_string($files)) {
            $files = [$files];
        }

        foreach (Modules::$locations as $path => $relPath) {
            foreach ($files as $fp) {
                $absPath = $path . ltrim($fp, '/');
                if (file_exists($absPath)) {
                    if ($noExt == true) {
                        $absPath = explode('.', $absPath);
                        array_pop($absPath);
                        return implode('.', $absPath);
                    } else {
                        return $absPath;
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param string $name
     */
    public function registerScriptWithoutTemplate($name) {
        $script = '/' . $this->buildScriptPath($name);
        $this->setData([$name => $script]);
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @param string $name
     * @param boolean $useCompress
     * @return assetManager
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerStyle($name, $useCompress = FALSE) {
        /** Start. Load file into template */

        $path = $this->buildStylePath($name);
        if ('' !== $path) {
            if ($useCompress) {
                if ($content = file_get_contents($path)) {
                    CI_Controller::get_instance()->template->registerCss('<style>' . $this->compressCss($content) . '</style>', 'before');
                }
            } else {
                CI_Controller::get_instance()->template->registerCssFile('/' . $path, 'before');
            }
        }

        return $this;
    }

    /**
     * @param string $path
     * @param string $position
     */
    public function assetTemplateFiles($path, $position = 'before') {

        $template_name = config_item('template');

        $path_info = pathinfo($path);

        $path = '/templates/' . $template_name . '/' . ltrim($path, '/');

        if ($path_info['extension'] == 'css') {

            CI_Controller::get_instance()->template->registerCssFile($path, $position);
        } elseif ($path_info['extension'] == 'js') {

            CI_Controller::get_instance()->template->registerJsFile($path, $position, false);
        }
    }

    /**
     * Compressing css file
     * @param string $css text of css file
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     * @return string
     */
    private function compressCss($css) {
        $compressor = new CSSmin();

        return $compressor->run($css);
    }

    /**
     * Put css string into template
     * @return assetManager
     * @access public
     * @author a.gula
     * @param string $css
     * @param boolean $useCompress
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    public function registerStyleStr($css, $useCompress = FALSE) {
        /** Start. Load file into template */
        if ($useCompress) {
            CI_Controller::get_instance()->template->registerCss('<style>' . $this->compressCss($css) . '</style>', 'before');
        } else {
            CI_Controller::get_instance()->template->registerCss('<style>' . $css . '</style>', 'before');
        }

        return $this;
    }

    /**
     * @param string $name
     */
    public function registerStyleWithoutTemplate($name) {
        $script = '/' . $this->buildStylePath($name);
        $this->setData([$name => $script]);
    }

    /**
     * Return formated path for css
     * @param string $fileName
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildStylePath($fileName) {
        if (!$this->template) {
            $this->template = CI_Controller::get_instance()->config->item('template');
        }

        $moduleName = $this->getTrace();
        $path = sprintf('templates/%s/%s/css/%s.css', $this->template, $moduleName, $fileName);
        if (file_exists($path)) {
            $url = $path;
        } else {
            $url = $this->getModuleFilePath(
                [
                 sprintf('%s/assets/css/%s.css', $moduleName, $fileName),
                 sprintf('%s/assets/css/%s.css', CI::$APP->uri->segment(4), $fileName),
                ],
                false
            );
        }
        return str_replace(MAINSITE, '', $url);
    }

    /**
     * Render public view
     * @param string $tpl Template file name
     * @param bool $ignoreWrap
     * @param bool $fetchJsTpl
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function render($tpl, $ignoreWrap = FALSE, $fetchJsTpl = TRUE) {
        $this->_render($tpl, $ignoreWrap, $fetchJsTpl);
    }

    /**
     * Render Admin view
     * @param string $tpl Template file name
     * @param bool $ignoreWrap
     * @param bool $fetchJsTpl
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function renderAdmin($tpl, $ignoreWrap = FALSE, $fetchJsTpl = TRUE) {
        $this->_render($tpl, $ignoreWrap, $fetchJsTpl, TRUE);
    }

    /**
     *
     * @param string $tpl
     * @param boolean $ignoreWrap
     * @param boolean $fetchJsTpl
     * @param boolean $admin
     */
    private function _render($tpl, $ignoreWrap = FALSE, $fetchJsTpl = TRUE, $admin = FALSE) {
        if (CI_Controller::get_instance()->input->is_ajax_request()) {
            $ignoreWrap = TRUE;
        }
        if (CI_Controller::get_instance()->input->post('ignoreWrap')) {
            $ignoreWrap = TRUE;
        }
        if (CI_Controller::get_instance()->input->post('template')) {
            $tpl = CI_Controller::get_instance()->input->post('template');
        }
        if (CI_Controller::get_instance()->input->get('ignoreWrap')) {
            $ignoreWrap = TRUE;
        }
        if (CI_Controller::get_instance()->input->get('template')) {
            $tpl = CI_Controller::get_instance()->input->get('template');
        }

        try {
            $data = [];
            if ($fetchJsTpl) {
                /** Start. If file doesn't exists thorow exception */

                $js_langs_path = $this->buildTemplatePath($this->module_js);
                if (file_exists($js_langs_path . '.tpl')) {
                    /** Start. Load template file */
                    if (MAINSITE) {
                        $data = ['js_langs_path' => 'file:' . $js_langs_path];
                    } else {
                        $data = ['js_langs_path' => 'file:./' . $js_langs_path];
                    }
                }
            }

            /** Start. Load template file */
            CI_Controller::get_instance()->template->show('file:' . $this->_buildTemplatePath($tpl, null, $admin), !$ignoreWrap, $data);
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
    }

    /**
     * Return formatted path
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     * @param string $tpl
     * @param string $moduleName
     * @return string
     */
    private function buildTemplatePath($tpl, $moduleName = null) {
        if (!$this->template) {
            $this->template = CI_Controller::get_instance()->config->item('template');
        }

        $path = 'templates/' . $this->template . '/' . $this->getTrace() . '/' . $tpl;
        $path = $this->makePath($path);

        if (file_exists($path . '.tpl')) {
            return $path;
        }

        if (!$moduleName) {
            $moduleName = $this->getTrace();
        }

        $modulePath = getModulePath($moduleName);
        return $this->makePath("{$modulePath}assets/$tpl");
    }

    /**
     *
     * @param string $path
     * @return string
     */
    protected function makePath($path) {
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $startSlash = strpos($path, '/') === 0 ? '/' : '';

        $absolutes = [];
        foreach ($parts as $part) {
            if ('.' == $part) {
                continue;
            }
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }

        return $startSlash . implode(DIRECTORY_SEPARATOR, $absolutes);
    }

    /**
     *
     * @param string $tpl
     * @param string $moduleName
     * @param boolean $admin
     * @return string
     * @throws Exception
     */
    private function _buildTemplatePath($tpl, $moduleName = null, $admin = FALSE) {
        if ($admin) {
            $path = $this->buildAdminTemplatePath($tpl);
        } else {
            $path = $this->buildTemplatePath($tpl, $moduleName);
        }
        /** Start. If file doesn't exists thorow exception */
        if (!file_exists($path . '.tpl')) {
            throw new Exception("Can't load template file: <i>$path.tpl</i>");
        }
        return $path;
    }

    /**
     * Return formatted path
     * @param string $fileName
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildAdminTemplatePath($fileName) {
        $path = $this->getModuleFilePath(
            [
             sprintf('%s/assets/admin/%s.tpl', $this->getTrace(), $fileName),
             sprintf('%s/assets/admin/%s.tpl', CI::$APP->uri->segment(4), $fileName),
            ]
        );
        return $path;
    }

    /**
     * Changing main layout file
     * @param string $mainLayout
     * @return assetManager
     */
    public function setMainLayout($mainLayout) {
        try {
            CI_Controller::get_instance()->template->set_main_layout($mainLayout);
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
        return $this;
    }

    /**
     * Changing main layout file by full path
     * @param string $mainLayout
     * @return assetManager
     */
    public function setMainLayoutByFullPath($mainLayout) {
        try {
            CI_Controller::get_instance()->template->set_main_layout_by_full_path($mainLayout);
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
        return $this;
    }

}
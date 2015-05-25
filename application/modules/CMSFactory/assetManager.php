<?php

namespace CMSFactory;

/**
 * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
 * @property \CI_Input $input
 */
class assetManager {

    protected static $_BehaviorInstance;

    protected $callMapp = null;

    protected $useCompress = false;

    protected $module_js = 'jsLangs';

    /**
     *
     * @var Template
     */
    protected $template;

    protected $ci;

    private function __construct() {

    }

    private function __clone() {

    }

    /**
     * Changing main layout file
     * @param string $mainLayout
     * @return \CMSFactory\assetManager
     */
    public function setMainLayout($mainLayout) {
        try {
            \CI_Controller::get_instance()->template->set_main_layout($mainLayout);
        } catch (\Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
        return $this;
    }

    /**
     * @param array $data Fetch data to template
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function setData($item, $value = null) {
        if ($value != null AND ! is_array($item)) {
            $data[$item] = $value;
        } else {
            $data = $item;
        }
        (empty($data)) OR \CI_Controller::get_instance()->template->add_array((array) $data);
        return $this;
    }

    /**
     * @param
     * @return assetManager
     * @access public
     * @author
     * @copyright
     */
    public function getData($item) {
        return \CI_Controller::get_instance()->template->get_var($item);
    }

    /**
     * @param
     * @return assetManager
     * @access public
     * @copyright ImageCMS (c) 2013, Roman <dev@imagecms.net>
     */
    public function appendData($item, $value) {
        $this->setData($item, \CI_Controller::get_instance()->template->get_var($item) . $value);
        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @param type $name
     * @param type $useCompress
     * @param type $position
     * @return \CMSFactory\assetManager
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerScript($name, $useCompress = FALSE, $position = 'after') {
        /** Start. Load JS file into template */
        if ($useCompress) {
            \CI_Controller::get_instance()->template->registerJsScript('<script>' . $this->compressJs(file_get_contents($this->buildScriptPath($name))) . '</script>', $position);
        } else {
            \CI_Controller::get_instance()->template->registerJsFile('/' . $this->buildScriptPath($name), $position);
        }

        return $this;
    }

    public function registerJsFullpath($path, $position = 'after') {
        \CI_Controller::get_instance()->template->registerJsFile($path, $position, false);
        return $this;
    }

    /**
     * @param string $name
     */
    public function registerScriptWithoutTemplate($name) {
        $script = '/' . $this->buildScriptPath($name);
        $this->setData(array($name => $script));
    }

    /**
     * @param string $name
     */
    public function registerStyleWithoutTemplate($name) {
        $script = '/' . $this->buildStylePath($name);
        $this->setData(array($name => $script));
    }

    /**
     * @return assetManager
     * @access public
     * @author a.gula
     * @param string $script
     * @param boolean $useCompress
     * @param string $position after|before
     * @return \CMSFactory\assetManager
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    public function registerJsScript($script, $useCompress = FALSE, $position = 'after', $type = 'text/javascript') {
        /** Start. Load JS script into template */
        if ($useCompress) {
            \CI_Controller::get_instance()->template->registerJsScript("<script type='$type'>" . $this->compressJs($script) . '</script>', $position);
        } else {
            \CI_Controller::get_instance()->template->registerJsScript("<script type='$type'>" . $script . '</script>', $position);
        }

        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @param type $name
     * @param type $useCompress
     * @return \CMSFactory\assetManager
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerStyle($name, $useCompress = FALSE) {
        /** Start. Load file into template */
        if ($useCompress) {
            \CI_Controller::get_instance()->template->registerCss('<style>' . $this->compressCss(file_get_contents($this->buildStylePath($name))) . '</style>', 'before');
        } else {
            \CI_Controller::get_instance()->template->registerCssFile('/' . $this->buildStylePath($name), 'before');
        }

        return $this;
    }

    /**
     * Put css string into template
     * @return assetManager
     * @access public
     * @author a.gula
     * @param type $css
     * @param type $useCompress
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    public function registerStyleStr($css, $useCompress = FALSE) {
        /** Start. Load file into template */
        if ($useCompress) {
            \CI_Controller::get_instance()->template->registerCss('<style>' . $this->compressCss($css) . '</style>', 'before');
        } else {
            \CI_Controller::get_instance()->template->registerCss('<style>' . $css . '</style>', 'before');
        }

        return $this;
    }

    /**
     * Render Admin view
     * @param string $tpl Template file name
     * @return void
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function renderAdmin($tpl, $ignoreWrap = FALSE, $fetchJsTpl = TRUE) {

        if (\CI_Controller::get_instance()->input->post('ignoreWrap')) {
            $ignoreWrap = TRUE;
        }
        if (\CI_Controller::get_instance()->input->post('template')) {
            $tpl = \CI_Controller::get_instance()->input->post('template');
        }
        if (\CI_Controller::get_instance()->input->get('ignoreWrap')) {
            $ignoreWrap = TRUE;
        }
        if (\CI_Controller::get_instance()->input->get('template')) {
            $tpl = \CI_Controller::get_instance()->input->get('template');
        }

        try {

            /** Start. If file doesn't exists thorow exception */
            if (!file_exists($this->buildAdminTemplatePath($tpl) . '.tpl')) {
                throw new \Exception(sprintf('Can\'t load template file: <i>%s/assets/admin/%s.tpl</i>', $this->getTrace(), $tpl));
            }

            $data = array();
            if ($fetchJsTpl) {
                /** Start. If file doesn't exists thorow exception */
                $js_langs_path = $this->buildTemplatePath($this->module_js);
                if (file_exists($js_langs_path . '.tpl')) {
                    /** Start. Load template file */
                    if (MAINSITE) {
                        $data = array('js_langs_path' => 'file:' . $js_langs_path);
                    } else {
                        $data = array('js_langs_path' => 'file:./' . $js_langs_path);
                    }
                }
            }

            /** Start. Load template file */
            \CI_Controller::get_instance()->template->show('file:' . $this->buildAdminTemplatePath($tpl), !$ignoreWrap, $data);
        } catch (\Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
    }

    /**
     * Render public view
     * @param string $tpl Template file name
     * @return void
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function render($tpl, $ignoreWrap = FALSE, $fetchJsTpl = TRUE) {
        if (\CI_Controller::get_instance()->input->post('ignoreWrap')) {
            $ignoreWrap = TRUE;
        }
        if (\CI_Controller::get_instance()->input->post('template')) {
            $tpl = \CI_Controller::get_instance()->input->post('template');
        }
        if (\CI_Controller::get_instance()->input->get('ignoreWrap')) {
            $ignoreWrap = TRUE;
        }
        if (\CI_Controller::get_instance()->input->get('template')) {
            $tpl = \CI_Controller::get_instance()->input->get('template');
        }

        try {

            /** Start. If file doesn't exists thorow exception */
            if (!file_exists($this->buildTemplatePath($tpl) . '.tpl')) {
                throw new \Exception(sprintf('Can\'t load template file: <i>%s/assets/%s.tpl</i>', $this->getTrace(), $tpl));
            }

            $data = array();
            if ($fetchJsTpl) {
                /** Start. If file doesn't exists thorow exception */
                $js_langs_path = $this->buildTemplatePath($this->module_js);
                if (file_exists($js_langs_path . '.tpl')) {
                    /** Start. Load template file */
                    if (MAINSITE) {
                        $data = array('js_langs_path' => 'file:' . $js_langs_path);
                    } else {
                        $data = array('js_langs_path' => 'file:./' . $js_langs_path);
                    }
                }
            }

            /** Start. Load template file */
            \CI_Controller::get_instance()->template->show('file:' . $this->buildTemplatePath($tpl), !$ignoreWrap, $data);
        } catch (\Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
    }

    /**
     * fetch public view
     * @param string $tpl Template file name
     * @return void
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function fetchTemplate($tpl, $moduleName = null) {
        try {

            if (!file_exists($this->buildTemplatePath($tpl, $moduleName) . '.tpl')) {
                throw new \Exception('Can\'t load template file: <i>' . $paths . DIRECTORY_SEPARATOR . $tpl . '.tpl</i>');
            }

            /** Start. Return template file */
            return \CI_Controller::get_instance()->template->fetch('file:' . $this->buildTemplatePath($tpl, $moduleName));
        } catch (\Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
    }

    /**
     * fetch admin view
     * @param string $tpl Template file name
     * @return void
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function fetchAdminTemplate($tpl, $fetchLangsTpl = TRUE) {
        try {

            if ($fetchLangsTpl) {
                /** Start. If file doesn't exists thorow exception */
                if (file_exists($this->buildTemplatePath($this->module_js) . '.tpl')) {
                    /** Start. Load template file */
                    $view = \CI_Controller::get_instance()->template->fetch('file:' . $this->buildTemplatePath($this->module_js));
                }
            }
            /** Start. If file doesn't exists thorow exception */
            if (!file_exists($this->buildAdminTemplatePath($tpl) . '.tpl')) {
                throw new \Exception('Can\'t load template file: <i>' . $paths . DIRECTORY_SEPARATOR . $tpl . '.tpl</i>');
            }

            if (isset($view)) {
                return $view . \CI_Controller::get_instance()->template->fetch('file:' . $this->buildAdminTemplatePath($tpl));
            } else {
                return \CI_Controller::get_instance()->template->fetch('file:' . $this->buildAdminTemplatePath($tpl));
            }
            /** Start. Return template file */
        } catch (\Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
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
     * @param string
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
     * Return formated path
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildTemplatePath($tpl, $moduleName = null) {
        if (!$this->template) {
            $this->template = \CI_Controller::get_instance()->config->item('template');
        }

        if ($path = file_exists('templates/' . $this->template . '/' . $this->getTrace() . '/' . $tpl . '.tpl')) {
            return sprintf('templates/%s/%s/%s', $this->template, $this->getTrace(), $tpl);
        } else {
            if (!$moduleName) {
                $moduleName = $this->getTrace();
            }
            $modulePath = getModulePath($moduleName);
            return sprintf($modulePath . 'assets/%s', $tpl);
        }
    }

    /**
     * Return formated path
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildAdminTemplatePath($fileName) {
        return $this->getModuleFilePath(
            array(
                    sprintf('%s/assets/admin/%s.tpl', $this->getTrace(), $fileName),
                    sprintf('%s/assets/admin/%s.tpl', \CI::$APP->uri->segment(4), $fileName)
            )
        );
    }

    /**
     * Return formated path for JS - script files
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildScriptPath($fileName) {
        $this->template = \CI_Controller::get_instance()->config->item('template');

        $moduleName = $this->getTrace();
        $path = sprintf('templates/%s/%s/js/%s.js', $this->template, $moduleName, $fileName);
        if (file_exists($path)) {
            $url = $path;
        } else {
            $url = $this->getModuleFilePath(
                array(
                sprintf('%s/assets/js/%s.js', $moduleName, $fileName),
                sprintf('%s/assets/js/%s.js', \CI::$APP->uri->segment(4), $fileName)
                    ),
                false
            );
        }

        return str_replace(MAINSITE, '', $url);
    }

    /**
     * Return formated path for css
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildStylePath($fileName) {
        if (!$this->template) {
            $this->template = \CI_Controller::get_instance()->config->item('template');
        }

        $moduleName = $this->getTrace();
        $path = sprintf('templates/%s/%s/css/%s.css', $this->template, $moduleName, $fileName);
        if (file_exists($path)) {
            $url = $path;
        } else {
            $url = $this->getModuleFilePath(
                array(
                sprintf('%s/assets/css/%s.css', $moduleName, $fileName),
                sprintf('%s/assets/css/%s.css', \CI::$APP->uri->segment(4), $fileName)
                    ),
                false
            );
        }
        return str_replace(MAINSITE, '', $url);
    }

    /**
     * Checks if file exists in any of modules dirs. If exists returns its path
     * @param string|array $files example: ['menu/assets/css/style.css']
     * @return string|bool(false) returns file path or FALSE
     */
    private function getModuleFilePath($files, $noExt = true) {
        if (is_string($files)) {
            $files = array($files);
        }

        foreach (\Modules::$locations as $path => $relPath) {
            foreach ($files as $fp) {
                $absPath = $path . ltrim($fp, '/');
                if (file_exists($absPath)) {
                    if ($noExt == true) {
                        $absPath = explode('.', $absPath);
                        $ext = array_pop($absPath);
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
     * Compressing js file
     * @param type $js text of js
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    private function compressJs($js) {
        $jz = new \Patchwork\JSqueeze();

        $minifiedJs = $jz->squeeze(
            $js, // $text of js
            true, // $singleLine
            false, // $keepImportantComments
            false   // $specialVarRx
        );

        return $minifiedJs;
    }

    /**
     * Compressing css file
     * @param type $css text of css file
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    private function compressCss($css) {
        $compressor = new \CSSmin();

        return $compressor->run($css);
    }

}
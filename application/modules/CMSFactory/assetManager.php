<?php

namespace CMSFactory;

/**
 * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
 */
class assetManager {

    public $useCompress = false;
    public $activePattern = null;

    protected static $_BehaviorInstance;
    protected $callMapp = null;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    /**
     * @param array $data Fetch data to template
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
     * @param string $name
     * @param string $pattern
     * @return \CMSFactory\assetManager
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerScript($name, $pattern = 'default') {
        /** Start. Load JS file into template */
        if ($this->useCompress)
            \CI_Controller::get_instance()->template->registerJsScript('<script>' . $this->compressJs(file_get_contents($this->buildScriptPath($name, $pattern))) . '</script>', 'after');
        else
            \CI_Controller::get_instance()->template->registerJsFile($this->buildScriptPath($name, $pattern), 'after');
        return $this;
    }
    
   
    public function registerScriptWithoutTemplate($name, $pattern = 'default') {
        $script = '/' . $this->buildScriptPath($name, $pattern);
        $this->setData(array($name=>$script));
        
    }
    public function registerStyleWithoutTemplate($name, $pattern = 'default') {
        $script = '/' . $this->buildStylePath($name, $pattern);
        $this->setData(array($name=>$script));
        
    }

    /**
     * @return assetManager
     * @access public
     * @author a.gula
     * @param string $script
     * @return \CMSFactory\assetManager
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    public function registerJsScript($script) {
        /** Start. Load JS script into template */
        if ($this->useCompress)
            \CI_Controller::get_instance()->template->registerJsScript('<script>' . $this->compressJs($script) . '</script>', 'after');
        else
            \CI_Controller::get_instance()->template->registerJsScript('<script>' . $script . '</script>', 'after');

        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @param string $name
     * @param string $pattern
     * @return \CMSFactory\assetManager
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerStyle($name, $pattern = 'default') {
        /** Start. Load file into template */
        if ($this->useCompress)
            \CI_Controller::get_instance()->template->registerCss('<style>' . $this->compressCss(file_get_contents($this->buildStylePath($name, $pattern))) . '</style>', 'before');
        else
            \CI_Controller::get_instance()->template->registerCssFile($this->buildStylePath($name, $pattern), 'before');

        return $this;
    }

    /**
     * Put css string into template
     * @return assetManager
     * @access public
     * @author a.gula    
     * @param string $css
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    public function registerStyleStr($css) {
        /** Start. Load file into template */
        if ($this->useCompress)
            \CI_Controller::get_instance()->template->registerCss('<style>' . $this->compressCss($css) . '</style>', 'before');
        else
            \CI_Controller::get_instance()->template->registerCss('<style>' . $css . '</style>', 'before');

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
    public function renderAdmin($tpl) {
        try {
            /** Start. If file doesn't exists thorow exception */
            file_exists($this->buildTemplatePath($tpl, 'admin') . '.tpl') OR throwException(sprintf('Can\'t load template file: <i>%s/assets/admin/%s.tpl</i>', $this->getTrace(), $tpl));

            /** Start. Load template file */
            \CI_Controller::get_instance()->template->show('file:' . $this->buildAdminTemplatePath($tpl));
        } catch (\Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
    }

    /** Render public view
     * @param string $tpl Template file name
     * @return void
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function render($tpl, $ignoreWrap = FALSE, $pattern = 'default') {
        try {
            /** Start. If file doesn't exists thorow exception */
            file_exists($this->buildTemplatePath($tpl, $pattern) . '.tpl') OR throwException(sprintf('Can\'t load template file: <i>%s/assets/%s.tpl</i>', $this->getTrace(), $tpl));

            /** Start. Load template file */
            \CI_Controller::get_instance()->template->show('file:' . $this->buildTemplatePath($tpl, $pattern), !$ignoreWrap);
        } catch (\Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
    }

    /** Render public view
     * @param string $tpl Template file name
     * @return string
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function fetchTemplate($tpl, $pattern = 'default') {
        try {
            /** Start. If file doesn't exists thorow exception */
            file_exists($this->buildTemplatePath($tpl, $pattern) . '.tpl') OR throwException('Can\'t load template file: <i>' . $paths /* ?? what is $paths ?? */ . DIRECTORY_SEPARATOR . $tpl . '.tpl</i>');

            /** Start. Return template file */
            return \CI_Controller::get_instance()->template->fetch('file:' . $this->buildTemplatePath($tpl, $pattern));
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
    private function buildTemplatePath($tpl, $pattern) {
        return sprintf('%smodules/%s/assets%s/%s', APPPATH, $this->getTrace(), $this->processingPatternName($pattern), $tpl);
    }

    /**
     * Return formated path for JS - script files
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildScriptPath($tpl, $pattern) {
        return sprintf('%smodules/%s/assets%s/js/%s.js', APPPATH, $this->getTrace(), $this->processingPatternName($pattern), $tpl);
    }

    /**
     * Return formated path for css
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildStylePath($tpl, $pattern) {
        return sprintf('%smodules/%s/assets%s/css/%s.css', APPPATH, $this->getTrace(), $this->processingPatternName($pattern), $tpl);
    }

    /**
     * Return formatted pattern name for include it in file path
     * @param string $pattern
     * @return string
     */
    private function processingPatternName($pattern) {
        if (is_string($this->activePattern)) $pattern = $this->activePattern;
        return !is_string($pattern) || empty($pattern) ? '' : '/' . trim($pattern, '\//');
    }

    /**
     * Compressing js file
     * @param string $js text of js
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    private function compressJs($js) {
        /* remove comments */
        $js = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $js);
        /* remove tabs, spaces, newlines, etc. */
        $js = str_replace(array("\r\n", "\r", "\t", "\n", '  ', '    ', '     '), '', $js);
        /* remove other spaces before/after ) */
        $js = preg_replace(array('(( )+\))', '(\)( )+)'), ')', $js);

        return $js;
    }

    /**
     * Compressing css file
     * @param string $css text of css file
     * @copyright ImageCMS (c) 2013, a.gula <a.gula@imagecms.net>
     */
    private function compressCss($css) {
        $css = preg_replace('#\s+#', ' ', $css);
        $css = preg_replace('#/\*.*?\*/#s', '', $css);
        foreach (str_split(';:{},') as $symbol) {
            $css = str_replace(' ' . $symbol, $symbol, $css);
            $css = str_replace($symbol . ' ', $symbol, $css);
        }
        $css = str_replace('- ', '-', $css);
        $css = str_replace(';}', '}', $css);

        return $css;
    }

}

/** End of file /application/modules/CMSFactory/assetManager.php */
?>
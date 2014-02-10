<?php

namespace template_manager\classes;

/**
 * 
 *
 * @author 
 */
class TemplateManager {

    /**
     *
     * @var TemplateManager 
     */
    private static $instance;

    /**
     *
     * @var array 
     */
    public $defaultComponents = array();

    /**
     * 
     * @return TemplateManager
     */
    public static function getInstance() {
        if (is_null(self::$instance))
            self::$instance = new self;
        return self::$instance;
    }

    /**
     * Getting core components
     */
    private function __construct() {
        $componentsPath = __DIR__ . '/../components/';
        $dirList = array();
        if ($handle = opendir($componentsPath)) {
            while (false !== ($componentName = readdir($handle))) {
                if ($componentName != "." && $componentName != "..") {
                    require_once $componentsPath . "$componentName/$componentName" . EXT;
                    $this->defaultComponents[$componentName] = new $componentName;
                }
            }
            closedir($handle);
        }
    }

    /**
     * 
     * @param type $template
     * @return boolean 
     */
    public function setTemplate(Template $template) {
        $dependenceDirector = new \template_manager\installer\DependenceDirector();
        if ($dependenceDirector->setDependicies($template->xml->dependencies->dependency)) {
            //hakhf
        } else {
            $dependenceDirector->getMessages();
            return false;
        }

        foreach ($template->xml->components->component as $component) {
            $attributes = $component->attributes();
            $handler = '' . $attributes['handler'];
            $instance = $template->getComponent($handler);
            $instance->setParamsXml($component->param);
        }

        $this->db->where('name', 'systemTemplatePath')->update('shop_settings', array('value' => './templates/' . $template->name . '/shop/'));
        $this->db->update('settings', array('site_template' => $template->name));
    }

    /**
     * 
     * @return array of Template
     */
    public function listLocal() {
        \CI::$APP->load->helper('file');
        $templatesNames = get_filenames('templates');
        $templates = array();
        foreach ($templatesNames as $name) {
            $templates[] = new Template($name);
        }
        return $templates;
    }

    /**
     * 
     * @param string $sourceUrl url of remote xml file with template data
     * @return array of Template
     */
    public function listRemote($sourceUrl) {
        
    }

    /**
     * 
     * @param string $url path to zip file
     * @return Template
     */
    public function moveToTempates($zipPath) {
        $zip = new ZipArchive();
        $zip->open($zipPath);
        $rez = $zip->extractTo('uploads/template_library/tmp');
        $zip->close();
        if (file_exists('uploads/template_library/tmp/param.xml')) {
            $xmlParam = simplexml_load_file('uploads/template_library/tmp/param.xml');
            $attributes = $xmlParam->attributes();
            if (TRUE) {
                // перенесення папки в шаблони із назвою із XML
            } else {
                // помилки
            }
        }
    }

}

?>

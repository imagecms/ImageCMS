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
        if (isset($template->xml->dependencies)) {
            if (isset($template->xml->dependencies->dependence)) {
                $dependenceDirector = new \template_manager\installer\DependenceDirector($template->xml->dependencies->dependence);
                $verifyRes = $dependenceDirector->verify();
                $massages = $dependenceDirector->getMessages();
                if (FALSE == $verifyRes) {
                    exit('No!');
                }
            }
        }

        foreach ($template->xml->components->component as $component) {
            $attributes = $component->attributes();
            $handler = '' . $attributes['handler'];
            $instance = $template->getComponent($handler);
            $instance->setParamsXml($component->param);
        }

        $this->db->where('name', 'systemTemplatePath')->update('shop_settings', array('value' => './templates/' . $template->name . '/shop/'));
        $this->db->update('settings', array('site_template' => $template->name));
        return TRUE;
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
    public function unpack($zipPath) {
        $templateName = pathinfo($zipPath, PATHINFO_FILENAME);
        $zip = new \ZipArchive();
        $zip->open($zipPath);

        // перевірка чи є файл із параметрами
        $paramsXml = FALSE;
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $innerFilePath = $zip->getNameIndex($i);
            if ($innerFilePath == "{$templateName}/params.xml") {
                $paramsXml = TRUE;
                break;
            }
        }

        if ($paramsXml == TRUE) {
            if (is_dir('templates/' . $templateName)) {
                return FALSE;
            }
            if (mkdir('templates/' . $templateName, 0777)) {
                $zip->extractTo('templates/');
                return TRUE;
            }
        }

        return FALSE;
    }

}

?>

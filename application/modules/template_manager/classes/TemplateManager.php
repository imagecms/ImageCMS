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
     * May have messages 
     * @var array
     */
    public $messages = array();

    /**
     * Current template
     * @var Template
     */
    private $currentTemplate;

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
     * @throws Exception
     */
    public function setTemplate(Template $template) {
        if ($this->currentTemplate->name == $template->name) {
            throw new \Exception('Template ' . $template->name . ' already installed');
        }

        // processing all dependicies 
        if (isset($template->xml->dependencies)) {
            if (isset($template->xml->dependencies->dependence)) {
                $dependenceDirector = new \template_manager\installer\DependenceDirector($template->xml->dependencies->dependence);
                $res = $dependenceDirector->verify();
                $this->massages = $dependenceDirector->getMessages();
                if (FALSE == $res) {
                    throw new \Exception('One or more dependency error');
                }
            }
        }

        foreach ($template->xml->components->component as $component) {
            $attributes = $component->attributes();
            $handler = (string) $attributes['handler'];
            $instance = $template->getComponent($handler);
            $instance->setParamsXml($component);
        }

        \CI::$APP->db->where('name', 'systemTemplatePath')->update('shop_settings', array('value' => './templates/' . $template->name . '/shop/'));
        \CI::$APP->db->update('settings', array('site_template' => $template->name));

        $this->currentTemplate = $template;
    }

    public function getCurentTemplate() {
        if (is_null($this->currentTemplate)) {
            $currentTemplateName = \CI::$APP->db->get('settings')->row()->site_template;
            $this->currentTemplate = new Template($currentTemplateName);
        }
        return $this->currentTemplate;
    }

    /**
     * 
     * @return array of Template
     */
    public function listLocal() {

        if ($handle = opendir('templates')) {
            while (false !== ($fileName = readdir($handle)))
                if ($fileName != "." && $fileName != ".." && is_dir('templates/' . $fileName)) {
                    $template = new Template($fileName);
                    if ($template->isValid())
                        $templates[] = $template;
                }
            closedir($handle);
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
     * @throws Exception
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

        if ($paramsXml == TRUE) { // imposible to download tamplate if such already exists
            if (is_dir(PUBPATH . 'templates/' . $templateName)) {
                throw new \Exception('Template already exists');
            }
            if (mkdir(PUBPATH . 'templates/' . $templateName, 0777)) {
                $zip->extractTo(PUBPATH . 'templates/');
                return TRUE;
            }
        } else {
            throw new \Exception('No "params.xml" file');
        }
    }

}

?>

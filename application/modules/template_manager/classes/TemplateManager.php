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
     * @var \SimpleXMLElement
     */
    private $xml;

    /**
     *
     * @var string
     */
    private $template;

    /**
     * 
     * @var array 
     */
    private $handlersClasses = array();

    public function getXml() {
        $this->template = CI::$APP->db
                        ->select('site_template')
                        ->get('settings')
                        ->row()->site_template;

        $xmlPath = 'templates/' . $this->template . '/params.xml';
        if (!file_exists($xmlPath)) {
            throw new Exception;
        }
        $this->xml = simplexml_load_file($xmlPath);
    }

    /**
     * Інклудить всі файли потрібні файли, кидає ексепшн якщо якогось немає
     */
    public function getIncludes() {
        $classes = array();
        foreach ($this->xml->components as $component) {
            require_once $component->attributes->handler; // TODO: перевірити
        }
        $this->handlersClasses;
    }

    /**
     * 
     * @param type $templateName
     * @return boolean 
     */
    public function setTemplate($templateName) {
        
    }

    /**
     * 
     * @return array 
     */
    public function listLocal() {
        
    }

    /**
     * 
     * @param string $sourceUrl url of remote xml file with template data
     * @return array 
     */
    public function listRemote($sourceUrl) {
        
    }

    /**
     * 
     * @param string $url path to zip file
     * @return bool
     */
    public function downloadTemplate($url) {
        
    }

    public function action($setParam,$handler, $key, $value) {
        $this->getComponent();
        $this->handlersClasses[$handler]->$setParam($key, $param);
    }

    public function getComponent($handler) {
        
    }

}

?>

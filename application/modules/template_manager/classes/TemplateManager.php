<?php

namespace template_manager\classes;

/**
 * 
 *
 * @author 
 */
class TemplateManager {

    private static $instance;

    /**
     *
     * @var \SimpleXMLElement
     */
    private $xml;
    private $components = array();

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

    public static function getInstance() {
        if (is_null(self::$instance))
            self::$instance = new self;
        return self::$instance;
    }

    private function __construct() {
        $this->_getXml();
        $this->_getComponents();
    }

    public function getXml() {
        return $this->xml;
    }

    public function getComponents($handlerName = NULL) {
        if (key_exists($handlerName, $this->components)) {
            return $this->components[$handlerName];
        }
        return $this->components;
    }

    private function _getXml() {
        $this->template = \CI::$APP->db
                        ->select('site_template')
                        ->get('settings')
                        ->row()->site_template;

        $xmlPath = 'templates/' . $this->template . '/params.xml';
        if (!file_exists($xmlPath)) {
            throw new \Exception;
        }
        $this->xml = simplexml_load_file($xmlPath);
    }

    private function _getComponents() {
        foreach ($this->xml->components->component as $component) {
            $attributes = $component->attributes();
            $handler = '' . $attributes['handler'];
            $pathCoreHandler = __DIR__ . '/../components/' . $handler . '/' . $handler . '.php';
            $pathTemplateHandler = 'templates/' . $this->template . '/components/' . $handler . '/' . $handler . '.php';

            if (file_exists($pathTemplateHandler)) {
                require_once $pathTemplateHandler;
                $this->components[$handler] = new $handler;
                continue;
            }


            if (file_exists($pathCoreHandler)) {
                require_once $pathCoreHandler;
                $this->components[$handler] = new $handler;
                continue;
            }
        }
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

    public function action($setParam, $handler, $key, $value) {
        $this->getComponent();
        $this->handlersClasses[$handler]->$setParam($key, $param);
    }

    public function getComponent($handler) {
        
    }

}

?>

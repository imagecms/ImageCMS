<?php

namespace template_manager\classes;

/**
 * 
 *
 * @author 
 */
class Template {

    /**
     *
     * @var \SimpleXMLElement
     */
    public $xml;
    public $description;
    public $screenshots = array();
    public $mainImage;
    public $type;
    public $label;
    public $templateCompomnents;
    public $version;
    public $components;
    public $name;

    /**
     * 
     * @param type $templateName
     */
    public function __construct($templateName) {
        $this->templateName = $templateName;
        $this->getXml(); //отримання XML
        $this->getData(); // дані про шаблон (назва, тип...)
        $this->getComponents(); // створення інстансів копонентів
    }

    /**
     * 
     * @throws \Exception
     */
    public function getXml() {
        $xmlPath = 'templates/' . $this->templateName . '/params.xml';
        if (!file_exists($xmlPath)) {
            throw new \Exception;
        }
        $this->xml = simplexml_load_file($xmlPath);
    }

    /**
     * 
     */
    protected function getData() {
        $attrs = $this->xml->attributes();
        $this->name = $attrs['name'];
        $this->label = $attrs['label'];
        $this->type = $attrs['type'];
        $this->version = $attrs['version'];
        $this->description = $this->xml->description;
        foreach ($this->xml->screenshots->screenshot as $screenshots) {
            $scrAttrs = $screenshots->attributes();
            if ($scrAttrs['main'] = 1) {
                $this->mainImage = $scrAttrs['url'];
            } else {
                $this->screenshots[] = $scrAttrs['url'];
            }
        }
    }

    /**
     * 
     */
    protected function getComponents() {
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

}

?>

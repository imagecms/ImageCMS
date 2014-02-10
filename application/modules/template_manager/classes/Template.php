<?php

namespace template_manager\classes;

/**
 * 
 *
 * @author 
 */
class Template {

    use \template_manager\traits\FileImportTrait;

    /**
     * Path to current template
     * @var string
     */
    protected $templatePath;

    /**
     * File params.xml
     * @var \SimpleXMLElement
     */
    public $xml;

    /**
     * System name of template (shoud match with template folder)
     * @var string
     */
    public $name;

    /**
     * Name of template for displaing
     * @var string 
     */
    public $label;

    /**
     * Corporate or shop template
     * @var string 
     */
    public $type;

    /**
     * Full description of template
     * @var string
     */
    public $description;

    /**
     * Url of main image of template (main thumbnail)
     * @var string 
     */
    public $mainImage;

    /**
     * Array of screenshots urls of template
     * @var string 
     */
    public $screenshots = array();

    /**
     * Version of template 
     * @var string 
     */
    public $version;

    /**
     * Components
     * @var array
     */
    public $components = array();

    /**
     * Instances of TComponent
     * Creates on appeal
     * @var array
     */
    protected $componentsInstances = array();

    /**
     * Getting all params
     * @param string $templateName
     */
    public function __construct($templateName) {
        $this->templatePath = TEMPLATES_PATH . $templateName . '/';
        $this->name = $templateName;
        $this->loadXml();
        $this->loadData();
        $this->loadComponents();
    }

    /**
     * Returns instance of component
     * It can be component of template or core template-component
     * @param string $componentName name of component
     * @return null|TComponent
     */
    public function getComponent($componentName) {
        // first check if it's core component
        $tm = \template_manager\classes\TemplateManager::getInstance();
        if (isset($tm->defaultComponents[$componentName])) {
            return $tm->defaultComponents[$componentName];
        }
        // searching in template
        if (!isset($this->componentsInstances[$componentName])) {     
            $this->import("components/{$componentName}/{$componentName}");
            $this->componentsInstances[$componentName] = new $componentName;
        }
        return $this->componentsInstances[$componentName];
    }

    /**
     * 
     * @throws \Exception
     */
    protected function loadXml() {
        $xmlPath = 'templates/' . $this->name . '/params.xml';
        if (!file_exists($xmlPath)) {
            throw new \Exception;
        }
        $this->xml = simplexml_load_file($xmlPath);
    }

    /**
     * Gets main fields from xml
     */
    protected function loadData() {
        $attrs = $this->xml->attributes();
        $this->name = (string) $attrs['name'];
        $this->label = (string) $attrs['label'];
        $this->type = (string) $attrs['type'];
        $this->version = (string) $attrs['version'];
        $this->description = (string) $this->xml->description;
        foreach ($this->xml->screenshots->screenshot as $screenshots) {
            $scrAttrs = $screenshots->attributes();
            if ($scrAttrs['main'] = 1) {
                $this->mainImage = (string) $scrAttrs['url'];
            } else {
                $this->screenshots[] = (string) $scrAttrs['url'];
            }
        }
    }

    /**
     * Loads all components from XML
     */
    protected function loadComponents() {
        if (!isset($this->xml->components)) {
            return;
        }
        if (!isset($this->xml->components->component)) {
            return;
        }
        $componentsBasePath = $this->templatePath . 'components/';
        foreach ($this->xml->components->component as $component) {
            $attributes = $component->attributes();
            array_push($this->components, (string) $attributes['handler']);
        }
        var_dump($this->components);
    }

}

?>

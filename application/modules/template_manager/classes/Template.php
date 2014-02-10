<?php

namespace template_manager\classes;

/**
 * 
 *
 * @author 
 */
class Template {

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
     * All components (core + template)
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
     * 
     * @var boolean
     */
    protected $isValid = TRUE;

    /**
     * Getting all params
     * @param string $templateName
     */
    public function __construct($templateName) {
        $this->templatePath = TEMPLATES_PATH . $templateName . '/';
        $this->name = $templateName;
        try {
            $this->loadXml();
            $this->loadData();
            $this->loadComponents();
        } catch (Exception $e) {
            $this->isValid = FALSE;
        }
    }

    /**
     * Check if template is no broken (has all need files and XML-data)
     * @return boolean 
     */
    public function isValid() {
        return $this->isValid;
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
            require_once $this->templatePath . "components/{$componentName}/{$componentName}" . EXT;
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
            throw new \Exception("XML-file 'params.xml' don't exist");
        }
        $this->xml = simplexml_load_file($xmlPath);
    }

    /**
     * Gets main fields from xml
     * @throws \Exception from \SimpleXMLElement
     */
    protected function loadData() {
        $attrs = $this->xml->attributes();
        $this->name = (string) $attrs['name'];
        $this->label = (string) $attrs['label'];
        $this->type = (string) $attrs['type'];
        $this->version = (string) $attrs['version'];
        $this->description = trim((string) $this->xml->description);
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
     * @throws \Exception from \SimpleXMLElement
     */
    protected function loadComponents() {
        // loading core components
        foreach (\template_manager\classes\TemplateManager::getInstance()->defaultComponents as $name => $instance) {
            array_push($this->components, $name);
            $this->componentsInstances[$name] = $instance;
        }
        if (!isset($this->xml->components)) {
            return;
        }
        if (!isset($this->xml->components->component)) {
            return;
        }
        $componentsBasePath = $this->templatePath . 'components/';
        foreach ($this->xml->components->component as $component) {
            $attributes = $component->attributes();
            $name = (string) $attributes['handler'];
            if (!in_array($name, $this->components)) {
                if (!file_exists($this->templatePath . "components/{$componentName}/{$componentName}" . EXT)) {
                    throw new \Exception("Component class {$name} don't exists");
                }
                array_push($this->components, $name);
            }
        }
    }

}

?>

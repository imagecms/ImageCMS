<?php

namespace template_manager\classes;

use Exception;

/**
 * Representing one template
 * Incapsulate info and methods for working with template
 *
 * @property-read string $description Description
 * @property-read string $mainImage
 * @property-read array $screenshots
 * @property-read string $version
 * @property-read array $components array of aviable components
 * @property-read string $author
 *
 */
class Template
{

    const COMPONENTS_TEMPLATE = 1;
    const COMPONENTS_CORE = 2;
    const COMPONENTS_ALL = 3;
    const PARAMS_FILE = 'params.xml';
    const TYPE_SHOP = 'shop';
    const TYPE_CORPORATE = 'corporate';
    const LICENSE_AGREEMENT_DIR = 'license_agreement';

    private $xml;

    /**
     * Parsed data from xml
     * @var array
     */
    private $xmlData = [
                        'author'      => null,
                        'label'       => null,
                        'description' => null,
                        'mainImage'   => null,
                        'screenshots' => [],
                        'version'     => null,
                        'components'  => [],
                        'xml'         => NULL,
                       ];

    /**
     * Path to current template
     * @var string
     */
    protected $templatePath;

    /**
     * System name of template (shoud match with template folder)
     * @var string
     */
    public $name;

    /**
     * Corporate or shop template
     * @var string
     */
    public $type;

    /**
     * Instances of TComponent
     * Creates on appeal
     * @var array
     */
    protected $componentsInstances = [];

    /**
     * Contain errors if template is not valid
     * @var array
     */
    protected $errors = [];

    /**
     * Demodata full archive exists
     * @var boolean
     */
    public $demodataArchiveExists = FALSE;

    /**
     * @var Params
     */
    protected $params;

    /**
     * Getting all params
     * @param string $templateName
     */
    public function __construct($templateName) {

        $this->templatePath = TEMPLATES_PATH . $templateName;
        //        if (!file_exists($this->templatePath)) {
        //            throw new \Exception(lang('Template does not exist in templates folder', 'template_manager'));
        //        }
        $this->templatePath .= '/';
        // setting default values. if xml-file is present, they will be override
        $this->name = $templateName;
        //$this->label = $templateName;
        if (file_exists($this->templatePath . 'shop')) {
            $this->type = self::TYPE_SHOP;
        } else {
            $this->type = self::TYPE_CORPORATE;
        }

        if ($this->demoArchiveExist($templateName)) {
            $this->demodataArchiveExists = TRUE;
        }
    }

    /**
     * @param string $template_name
     * @return bool
     */
    public function demoArchiveExist($template_name) {
        $demodata_atchive = realpath('templates/' . $template_name . '/demodata');
        $demodata_uploads = realpath('templates/' . $template_name . '/demodata/uploads.zip');
        $demodata_database = realpath('templates/' . $template_name . '/demodata/database.sql');

        if ($demodata_atchive && ($demodata_uploads || $demodata_database)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Checks if template is compatible with new template_manager module
     * @return boolean
     */
    public function isTMCompatible() {
        if (!file_exists($this->templatePath . Template::PARAMS_FILE)) {
            return false;
        }
        if (!file_exists($this->templatePath . 'components')) {
            return false;
        }
        return true;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws Exception
     */
    public function __get($name) {
        if (!array_key_exists($name, $this->xmlData)) {
            throw new Exception(langf('Class Template has no |0| property', 'template_manager', [$name]));
        }
        $this->loadDataFromXml();
        return $this->xmlData[$name];
    }

    public function getErrors() {
        return $this->errors;
    }

    /**
     * Returns instance of component
     * It can be component of template or core template-component
     * @param string $componentName name of component
     * @return null|TComponent
     * @throws Exception
     */
    public function getComponent($componentName) {
        // searching in template

        $this->loadDataFromXml();
        if (isset($this->componentsInstances[$componentName])) {
            return $this->componentsInstances[$componentName];
        }

        if (in_array($componentName, $this->xmlData['components'])) {
            include_once $this->templatePath . "components/{$componentName}/{$componentName}" . EXT;
            $this->componentsInstances[$componentName] = new $componentName;

            return $this->componentsInstances[$componentName];
        }

        // check if it's core component
        $tm = TemplateManager::getInstance();
        if (isset($tm->defaultComponents[$componentName])) {
            return $tm->defaultComponents[$componentName];
        }

        throw new Exception(langf('Component |0| not found', 'template_manager', [$componentName]));
    }

    /**
     *
     * @param integer $type 1 - only from template, 2 - only core components, 3 - all (default 3)
     * @return array
     */
    public function getComponents($type = self::COMPONENTS_ALL) {
        $tm = TemplateManager::getInstance();

        $this->loadDataFromXml();
        foreach ($this->xmlData['components'] as $componentName) {
            if (!isset($this->componentsInstances[$componentName])) {
                include_once $this->templatePath . "components/{$componentName}/{$componentName}" . EXT;
                $this->componentsInstances[$componentName] = new $componentName;
            }
        }

        $tm->loadDefaultComponents(array_keys($this->componentsInstances));

        if ($type == self::COMPONENTS_CORE) {
            return $tm->defaultComponents;
        }

        if ($type == self::COMPONENTS_TEMPLATE) {
            return $this->componentsInstances;
        }

        // template components has higher priority
        $componentsToReturn = $this->componentsInstances;
        foreach ($tm->defaultComponents as $name => $component) {
            if (!array_key_exists($name, $this->componentsInstances)) {
                $componentsToReturn[$name] = $component;
            }
        }

        return $componentsToReturn;
    }

    /**
     * Returns license agreement from template, or default agreement
     * @return string
     */
    public function getLicenseAgreement() {
        $licenses = $this->getLicensensesAgreements();
        $locale = getLanguage(['locale' => \CI::$APP->config->item('language')]);
        $locale = $locale ? $locale['identif'] : \MY_Controller::defaultLocale();

        if (count($licenses) > 0) {
            if (array_key_exists($locale, $licenses)) {
                $licenseText = file_get_contents($licenses[$locale]);
            }
            return str_replace('{template_name}', $this->label, $licenseText);
        }
        return 0;
    }

    /**
     * Returns all files with license agreement from template
     * @return array
     */
    private function getLicensensesAgreements() {
        $templateLicensesDir = $this->templatePath . self::LICENSE_AGREEMENT_DIR;
        if (!file_exists($templateLicensesDir)) {
            return [];
        }
        $licensesFiles = get_filenames($templateLicensesDir, TRUE);
        $licenses = [];
        foreach ($licensesFiles as $licensePath) {
            $locale = pathinfo($licensePath, PATHINFO_FILENAME);
            $licenses[$locale] = $licensePath;
        }
        return $licenses;
    }

    protected function loadDataFromXml() {
        if (null !== $this->xml) {
            return;
        }
        if ($this->loadXml()) {
            $this->loadComponentsXML();
            $this->loadDataXML();
            $this->loadScreenshotsXML();
        }
    }

    /**
     * Loads the xml-file
     * @return bool true if xml-file exist, false otherwise
     * @throws Exception
     */
    protected function loadXml() {
        $xmlPath = $this->templatePath . '/' . self::PARAMS_FILE;
        if (!file_exists($xmlPath)) {
            return false;
        }
        $this->xmlData['xml'] = simplexml_load_file($xmlPath);
        if ($this->xmlData['xml'] === null) {
            throw new Exception(lang('XML-file read error', 'template_manager'));
        }
        return true;
    }

    /**
     * Gets main fields from xml
     * @throws Exception from \SimpleXMLElement
     */
    protected function loadDataXML() {
        $attrs = $this->xmlData['xml']->attributes();
        $this->xmlData['label'] = (string) $attrs['label'];
        $this->type = (string) $attrs['type'];
        $this->xmlData['version'] = (string) $attrs['version'];
        $this->xmlData['description'] = trim((string) $this->xmlData['xml']->description);

        if (isset($this->xmlData['xml']->author)) {
            $this->xmlData['author'] = (string) $this->xmlData['xml']->author;
        }
    }

    /**
     * Loading screenshots
     */
    protected function loadScreenshotsXML() {
        if (!isset($this->xmlData['xml']->screenshots)) {
            return;
        }

        $scrs = (array) $this->xmlData['xml']->screenshots;
        if (!is_array($scrs['screenshot'])) {
            $scrs['screenshot'] = [$scrs['screenshot']];
        }
        foreach ($scrs['screenshot'] as $screen) {
            $attrs = $screen->attributes();

            $url = (string) $attrs['url'];
            $main = (int) $attrs['main'];

            if ($main == 1) {
                $this->xmlData['mainImage'] = $url;
            } else {
                if (!in_array($url, $this->xmlData['screenshots'])) {
                    array_push($this->xmlData['screenshots'], $url);
                }
            }
        }
    }

    /**
     * Loads all components from XML
     * @throws Exception from \SimpleXMLElement
     */
    protected function loadComponentsXML() {

        if (!isset($this->xmlData['xml']->components)) {
            return;
        }

        if (!isset($this->xmlData['xml']->components->component)) {
            return;
        }

        foreach ($this->xmlData['xml']->components->component as $component) {
            $attributes = $component->attributes();
            $name = (string) $attributes['handler'];
            if (!in_array($name, $this->xmlData['components'])) {
                if (!file_exists($this->templatePath . "components/{$name}/{$name}" . EXT)) {
                    $this->errors[] = langf('Component |component_name| is broken', 'template_manager', ['component_name' => $name]);
                    continue;
                }
                array_push($this->xmlData['components'], $name);
            }
        }
    }

    public function getParams() {
        return $this->params ?: $this->params = new Params($this->templatePath . '/' . self::PARAMS_FILE);
    }

}
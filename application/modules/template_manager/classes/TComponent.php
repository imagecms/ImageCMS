<?php

namespace template_manager\classes;

/**
 * Base class for components. Each component must extend current class
 * Components of the template are sort of modules
 * for CMS, but in template context
 */
abstract class TComponent {

    /**
     * Data from table `template_settings` of each component
     * @var array
     */
    protected static $componentsData = array();

    /**
     * Path to folder where component is located
     * @var string
     */
    protected $basePath;

    /**
     * TComponentAssetManager object
     * @var TComponentAssetManager
     */
    protected $cAssetManager;

    /**
     * Current template name
     * @var string
     */
    protected $currTemplate;

    /**
     * Name of component (name of class which extends TComponent)
     * @var string
     */
    protected $name;

    /**
     * Path to dir of current component
     * @var string
     */
    protected $componentDirPath;

    /**
     * Getting paths & data from DB
     */
    public function __construct() {
        $this->templateName = \CI::$APP->db->get('settings')->row()->site_template;
        $rfc = new \ReflectionClass($this);
        $this->basePath = dirname($rfc->getFileName());
        $this->cAssetManager = new TComponentAssetManager($this->basePath);
        $this->name = get_class($this);
    }

    /**
     * Setting params of components into DB
     * @param array $params one dimentional associative array
     */
    public function setParams($params = array()) {
        if (is_array($params) && !empty($params)) {
            \CI::$APP->db->where('component', $this->name)
                    ->where_in('key', array_keys($params))
                    ->delete('template_settings');

            foreach ($params as $key => $value) {
                \CI::$APP->db
                        ->insert('template_settings', array(
                            'component' => $this->name,
                            'key' => $key,
                            'data' => $value
                ));
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Gettins param/params of component
     * @param string $key (default null) params name (if no specified, then all params)
     * @param boolean $force (optional, default false) if false then data will be returned from strored vars, if true then from DB.
     * @return null|array array of key => data of component, or specified in argument value
     */
    public function getParam($key = NULL, $force = FALSE) {
        if (!isset(self::$componentsData[$this->name]) || $force != FALSE) {
            self::$componentsData[$this->name] = array();

            $result = \CI::$APP->db
                    ->where('component', $this->name)
                    ->get('template_settings');

            if ($result->num_rows > 0) {
                $result = $result->result_array();
                foreach ($result as $row) {
                    self::$componentsData[$this->name][$row['key']] = $row['data'];
                }
            }
        }

        if ($key === NULL) {
            return self::$componentsData[$this->name];
        }

        if (isset(self::$componentsData[$this->name][$key])) {
            return self::$componentsData[$this->name][$key];
        }

        return null;
    }

    /**
     * Update params/param of component
     * @param array $params - one dimentional associative array
     * @return boolean
     */
    public function updateParams($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $data) {
                $component = \CI::$APP->db->where('component', $this->name)->where('key', $key)->get('template_settings');

                if ($component->num_rows()) {
                    \CI::$APP->db->where('component', $this->name)->where('key', $key)->update('template_settings', array('data' => $data));
                } else {
                    \CI::$APP->db->insert('template_settings', array('component' => $this->name, 'key' => $key, 'data' => $data));
                }
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Type of component is its class name
     * @return string
     */
    public function getType() {
        return $this->name;
    }

    /** Needed to be overloaded with some pretty name = )
     * @return string Name of component (for admin view)
     */
    public function getLabel() {
        return $this->name;
    }

    /**
     * Method parses params of xml
     * each component can have it's own structure of param tags
     * Kind of template method - in the end need to run setParams() method
     * @param \SimpleXMLElement $nodes nodes from xml
     */
    abstract public function setParamsXml(\SimpleXMLElement $nodes);

    /**
     * Renders settings page of current component for admin panel
     * @return string html
     */
    abstract public function renderAdmin();
}

?>

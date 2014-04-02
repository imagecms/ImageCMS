<?php

namespace template_manager\classes;

/**
 * Базовий клас для для компонентів шаблону
 * Кожен компонент повинен розширювати даний клас
 * 
 * Компоненти шаблону - свого роду "модулі" для шаблону - тобто
 * розширення його фунціналу самого ід. 
 * 
 */
abstract class TComponent {

    /**
     * Path to folder where component is located
     * @var string 
     */
    protected $basePath;

    /**
     * Data from table `template_settings` of current component
     * @var array
     */
    protected $componentData = array();

    /**
     *
     * @var TComponentAssetManager 
     */
    protected $cAssetManager;

    /**
     * current template
     * @var string
     */
    protected $currTemplate;

    /**
     * Name of component (name of class which extends TComponent)
     * @var string 
     */
    protected $name;

    /**
     * Getting paths & data from DB
     */
    public function __construct() {
        //$this->currTemplate =
        $rfc = new \ReflectionClass($this);
        $this->basePath = dirname($rfc->getFileName());
        $this->cAssetManager = new TComponentAssetManager($this->basePath);
        $this->name = get_class($this);
    }

    /**
     * Setting params of components into DB
     * @param array $params one dimentional associative array 
     */
    public function setParams($params) {
        \CI::$APP->db->where('component', $this->name)
                ->delete('template_settings');

        foreach ($params as $key => $value) {
            \CI::$APP->db
                    ->insert('template_settings', array(
                        'component' => $this->name,
                        'key' => $key,
                        'data' => $value
            ));
        }
    }

    /**
     * Gettins param/params of component
     * @param string $key (default null) params name (if no specified, then all params)
     * @return null|array array of key => data of component, or specified in argument value
     */
    public function getParam($key = null) {
        if ($key === NULL) {
            $result = \CI::$APP->db
                    ->where('component', $this->name)
                    ->get('template_settings');

            if ($result) {
                $result = $result->result_array();
                $data = array();
                for ($i = 0; $i < count($result); $i++) {
                    $data[$result['key']] = $result['data'];
                }

                return $data;
            }
        } else {
            $result = \CI::$APP->db
                    ->where('component', $this->name)
                    ->where('key', $key)
                    ->get('template_settings');

            if ($result) {
                if ($result->num_rows > 0) {
                    return $result->row()->data;
                }
            }
        }
        return null;
    }

    public function updateParams($params) {
        if (count($params) > 0) {
            foreach ($params as $key => $data) {
                $component = \CI::$APP->db->where('component', $this->name)->where('key', $key)->get('template_settings');
                if ($component->num_rows()) {
                    \CI::$APP->db->update('template_settings', array('component' => $this->name, 'key' => $key, 'data' => $data));
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
     * Each component must have his own unique type
     */
    abstract public function getType();

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

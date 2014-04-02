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
     * Extended class name
     * @var string 
     */
    protected $handler;

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
     *
     * @var currTemplate 
     */
    protected $currTemplate;

    /**
     * Getting paths & data from DB
     */
    public function __construct() {
        $this->currTemplate =
                $this->handler = get_class($this);
        $rfc = new \ReflectionClass($this);
        $this->basePath = dirname($rfc->getFileName());
        $this->cAssetManager = new TComponentAssetManager($this->basePath);
    }

    /**
     * Setting params of components
     * @param array $params one dimentional associative array 
     */
    public function setParams($params) {
        \CI::$APP->db->where('type', $this->getType())->delete('template_settings');
        foreach ($params as $key => $data) {
            \CI::$APP->db->insert('template_settings', array('type' => $this->getType(), 'key' => $key, 'data' => $data));
        }
    }

    public function getParam($key = null) {

        if ($key === NULL) {
            return \CI::$APP->db->where('type', $this->getType())->get('template_settings')->result_array();
        } else {
            return \CI::$APP->db->where('type', $this->getType())->where('key', $key)->get('template_settings')->row_array();
        }
    }

    public function updateParams($params) {
        if (count($params) > 0) {
            foreach ($params as $key => $data) {
                $component = \CI::$APP->db->where('type', $this->getType())->where('key', $key)->get('template_settings');
                if ($component->num_rows()) {
                    \CI::$APP->db->update('template_settings', array('type' => $this->getType(), 'key' => $key, 'data' => $data));
                } else {
                    \CI::$APP->db->insert('template_settings', array('type' => $this->getType(), 'key' => $key, 'data' => $data));
                }
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Method parses params of 
     * @param \SimpleXMLElement $nodes nodes from xml
     */
    abstract public function setParamsXml(\SimpleXMLElement $nodes);

    /**
     * Each component must have his own unique type
     */
    abstract public function getType();

    /**
     * @return string Name of component (for view)
     */
    abstract public function getLabel();

    /**
     * @return string html
     */
    abstract public function renderAdmin();
}

?>

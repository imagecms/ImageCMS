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
     * Getting paths & data from DB
     */
    public function __construct() {
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

        
        \CI::$APP->db->where('type', $this->getId())->delete('template_settings');
        foreach ($params as $key => $value) {
            \CI::$APP->db->insert('template_settings', array('type' => $this->getId(), 'key' => $key, 'value' => $value));
        }
    }

    public function getParam($key = null) {

        if ($key === NULL) {
            return \CI::$APP->db->where('type', $this->getId())->get('template_settings')->result_array();
        } else {
            return \CI::$APP->db->where('type', $this->getId())->where('key', $key)->get('template_settings')->row_array();
        }
    }

    /**
     * Method parses params of 
     * @param \SimpleXMLElement $nodes nodes from xml
     */
    abstract public function setParamsXml(\SimpleXMLElement $nodes);

    /**
     * Each component must have his own unique id
     * @return int id for field `handler_id`
     */
    abstract public function getId();

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

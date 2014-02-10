<?php

namespace template_manager\classes;

/**
 * Базовий клас для для компонентів шаблону
 * Кожен компонент повинен розширювати даний клас
 * 
 * Компоненти шаблону - свого роду "модулі" для шаблону - тобто
 * розширення його фунціналу самого ід. 
 * 
 * 
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
     * Renders the template of component
     * (
     * @param string $tplName name of file
     * @param array $data data for template
     * @return string html ready html
     */
    public function fetch($tplName = 'main', array $data = array()) {
        return $this->cAssetManager->fetch('some_asset');
    }

    /**
     * Same as rander, but searches templates is admin folder
     * @param string $tplName name of file
     * @param array $data data for template
     * @return string html ready html
     */
    public function renderAdmin($tpl = 'main', array $data = array()) {
        if (count($data) == 0)
            $data = $this->getParam ();
        return $this->render('admin' . DIRECTORY_SEPARATOR . $tpl, $data);
    }

    /**
     * Setting params of components
     * @param array $params one dimentional associative array 
     */
    public function setParams($params) {
        
        \CI::$APP->db->where('type',  $this->handler)->delete('template_settings');
        foreach ($params as $key => $value)
            \CI::$APP->db->insert('template_settings', array('type'=>$this->handler, 'key' => $key, 'value' => $value));
            
        
        
    }

    public function getParam($key = null) {
        if ($key === NULL) {
            return \CI::$APP->db->where('type', $this->handler)->get('template_settings')->result_array();
        } else {
            return \CI::$APP->db->where('type', $this->handler)->where('key', $key)->get('template_settings')->result();
            
        }
        
    }

    /**
     * Method parses params of 
     * @param \SimpleXMLElement $nodes nodes from xml
     */
    abstract public function setParamsXml(\SimpleXMLElement $nodes);
    



}

?>

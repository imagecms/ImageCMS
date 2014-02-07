<?php

namespace template_manager\classes;

/**
 * Базовий клас для для компонентів шаблону
 * Кожен компонент повинен розширювати даний клас
 * 
 * Компоненти шаблону - свого роду "модулі" для шаблону - тобто
 * розширення його фунціналу. Він має свій ід, для БД.
 * 
 * 
 * 
 */
abstract class TComponent {

    private $handler;
    private $basePath;
    private $viewPath;
    private $viewAdminPath;

    public function __construct() {
        $this->handler = get_class($this);
        $rfc = new \ReflectionClass($this);
        $this->basePath = dirname($rfc->getFileName());

        $this->viewPath = $this->basePath . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR;
        $this->viewAdminPath = $this->viewPath . 'admin' . DIRECTORY_SEPARATOR;
    }

    public function render($tplName, array $data = array()) {
        
    }

    public function renderAdmin($tpl = 'main') {

        //fgdf
        extract($this->getParam());
        include_once $this->viewAdminPath . 'main.tpl';

//        $data = $this->getParam();
    }

    public function setParam($data){
        foreach ($data as $key => $value) {
            if (\CI::$APP->db->where('type', $this->handler)->where('key', $key)->get('template_settings')->num_rows()){
                    //jlkj
            }else{
                //insert
            
            }
            
            
        };
    }
    public function getParam($key = null) {

        return CI::$APP->db->where('type', $this->handler)->get('template_settings')->result_array();
    }

    abstract public function setParamsXml($nodes);
}

?>

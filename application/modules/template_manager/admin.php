<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * tenplate Manager Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        
        
        
//        $segmentComponent = $this->uri->segment(5);
//        $this->index($segmentComponent);
//        $this->TM = new \template_manager\classes\TemplateManager;
//        $components = $this->TM->getXml()->getIncludes();
//        if (in_array($segmentComponent, $components))
//                $instance = new $segmentComponent;
//        
//        if ($instance){
//            (!$_POST) ? $instance->getParam() : $instance->setParam();
//            exit;
//        }

        
        
    }

    public function index() {
        
        $components = \template_manager\classes\TemplateManager::getInstance()->getComponents();
        foreach ($components as $key => $component){
            $data[$key] = $component->renderAdmin();
        }
        $in->setParam();
        \CMSFactory\assetManager::create()->setData($data)->renderAdmin('main');
        
        //var_dump($data);
        
         // всі свойства компонентві
        
        
        
    }
    
    
    public function inslaller() {
        $xml = \template_manager\classes\TemplateManager::getInstance()->getXML();
        $dependenceDirector = new \template_manager\installer\DependenceDirector();
        if ($dependenceDirector->setDependicies($xml->dependencies->dependency)){
            //hakhf
        } else {
            $dependenceDirector->getMessages();
        }
        foreach ($this->xml->components->component as $component) {
            $attributes = $component->attributes();
            $handler = '' . $attributes['handler'];
            $instance = \template_manager\classes\TemplateManager::getInstance()->getComponents($handler);
            $instance->setParamsXml($component->param);
            
        }
        
        
        
    }
    
    
    

    
   


}
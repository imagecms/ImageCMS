<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

// trait for php files including
//require_once __DIR__ . DIRECTORY_SEPARATOR . 'traits' . DIRECTORY_SEPARATOR . 'FileImportTrait' . EXT;

/**
 * Image CMS 
 * tenplate Manager Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();

    }

    public function index() {

        $templateName = $this->db->get('settings')->row()->site_template;
        $template = new \template_manager\classes\Template($templateName);
        if ($_POST){
            $handlerComponent = $this->input->post('handler');
            $template->getComponent($handlerComponent)->setParams();
        }
        
        \CMSFactory\assetManager::create()->setData(array('template' => $template))->renderAdmin('main');
    }

    public function templates() {

        $templates = \template_manager\classes\TemplateManager::getInstance()->listLocal();
        \CMSFactory\assetManager::create()->setData(array('template' => $templates))->renderAdmin('list');

    }

    public function test() {
        $tm = \template_manager\classes\TemplateManager::getInstance();
        require_once '/var/www/image.loc/application/modules/template_manager/components/TColorScheme/TColorScheme.php';
        $colorScheme = new TColorScheme();
        echo $colorScheme->renderAdmin();
        \CMSFactory\assetManager::create()->renderAdmin('main');

    }

    /**
     * 
     * @param string $url
     * @return boolan|string хиба якщо помилка, назва шаблону якшо все ок
     */
    public function upload($url = '') {
        $tm = \template_manager\classes\TemplateManager::getInstance();
        if (isset($_FILES['template'])) {
            return $tm->moveToTempates($_FILES['template']['tmp_name']);
        } elseif (!empty($url)) {
            $name = end(explode('/', $url));
            file_put_contents('uploads/template_library/' . $name, file_get_contents($url));
            return $tm->moveToTempates('uploads/template_library/' . $name);
        }
    }

    public function inslaller($templateName) {
        $template = new \template_manager\classes\Template($templateName);
        $result = \template_manager\classes\TemplateManager::getInstance()->setTemplate($template);
    }

}
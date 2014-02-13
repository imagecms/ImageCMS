<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * tenplate Manager Module Admin
 */
class Admin extends BaseAdminController {

    public $errors = array();

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * render main with settings current template 
     */
    public function index() {

        $templateName = $this->db->get('settings')->row()->site_template;
        $template = new \template_manager\classes\Template($templateName);
        if ($_POST) {
            $handlerComponent = $this->input->post('handler');
            $template->getComponent($handlerComponent)->setParams();
        }

        \CMSFactory\assetManager::create()->setData(array('template' => $template))->renderAdmin('main');
    }
    
    /**
     * render template list
     */
    public function templates() {
        $templateNameCurr = $this->db->get('settings')->row()->site_template;
        $templates = \template_manager\classes\TemplateManager::getInstance()->listLocal();
        \CMSFactory\assetManager::create()->setData(array('templates' => $templates, 'currTpl' => $templateNameCurr))->renderAdmin('list');
    }

    /**
     * Template installing
     */
    public function install() {
        if ($_POST) {
            $template = new \template_manager\classes\Template($_POST['template_name']);
            if ($template->isValid()) {
                $res = \template_manager\classes\TemplateManager::getInstance()->setTemplate($template);
                echo '<pre>';
                var_dump($res);
                echo '</pre>';
                exit;
            } else {
                echo 'Template is broken';
            }
        } else {
            \CMSFactory\assetManager::create()->renderAdmin('install');
        }
    }

    /**
     * 
     * @param string $url
     * @return boolan|string хиба якщо помилка, назва шаблону якшо все ок
     */
    public function upload() {
        $name = time();
        if (!empty($_POST['template_url']) || !empty($_FILES['template_file'])) {
            if (!empty($_POST['template_url'])) {
                $zipPath = $this->uploadByUrl();
            } else {
                $zipPath = $this->uploadFromPc();
            }

            if ($zipPath != FALSE) {
                // розпакувати шаблон
                if (TRUE == \template_manager\classes\TemplateManager::getInstance()->unpack($zipPath)) {
                    echo 'Всьо чікі - показати список шаблонів';
                    exit; // переадресація на список шаблонів
                } else {
                    // помилка під час розпакування
                }
            } else {
                // помилка під час завантаження
            }
        }

        // добавити можливі помилки
        \CMSFactory\assetManager::create()
                ->registerStyle('style_admin')
                ->renderAdmin('upload');
    }

    /**
     * 
     */
    public function test() {
        $t = new \template_manager\classes\Template('administrator');
        echo '<pre>';
        var_dump($t);
        echo '</pre>';
        exit;
    }

    /**
     * 
     * @return boolean|string хиба, або шлях до файлу
     */
    private function uploadByUrl() {
        $fullName = array_pop(explode('/', $_POST['template_url']));
        $nameArray = explode('.', $fullName);
        $ext = array_pop($nameArray);
        $name = count($nameArray) > 1 ? implode('.', $nameArray) : $nameArray[0];

        if ($ext == 'zip') {
            $fullPath = './uploads/templates/' . $name . '.zip';
            if (file_put_contents($fullPath, file_get_contents($_POST['template_url'])) > 0) {
                return $fullPath;
            }
        }
        return FALSE;
    }

    /**
     * 
     * @return boolean|string хиба, або шлях до файлу
     */
    private function uploadFromPc() {
        $this->load->library('upload', array(
            'upload_path' => './uploads/templates/',
            'allowed_types' => 'zip',
            'max_size' => 1024 * 10, // 10 Mb
        ));
        if (!$this->upload->do_upload('template_file')) {
            $this->errors[] = $this->upload->display_errors();
            return FALSE;
        } else {
            $data = $this->upload->data();
            return $data['full_path'];
        }
    }

}
<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * tenplate Manager Module Admin
 */
class Admin extends BaseAdminController {

    public $errors = array();
    private $templatesUploadPath;

    public function __construct() {
        parent::__construct();
        $this->templateName = $this->db->get('settings')->row()->site_template;
        $this->templatesUploadPath = PUBPATH . 'uploads/templates';
    }

    /**
     * render main with settings current template 
     */
    public function index() {
        $error = '';
        $message = '';

        $currentTemplate = \template_manager\classes\TemplateManager::getInstance()->getCurentTemplate();

        if ($_POST) {
            try {
                if (isset($_POST['upload_template'])) { // UPLOAD TEMPLATE FROM PC OR BY URL
                    $this->upload();
                } elseif (isset($_POST['install_template'])) { // INSTALL TEMPLATE
                    $this->install($_POST['template_name']);
                    $message = 'Template ' . $template->name . ' is set';
                } elseif (isset($_POST['set_logofav'])) { // set logo &|| favicon
                    $this->setLogoFav();
                } else { // SETTING SOME PARAMS
                    $component = $this->input->post('handler');
                    $currentTemplate->getComponent($component)->setParams();
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        $templates = \template_manager\classes\TemplateManager::getInstance()->listLocal();

        \CMSFactory\assetManager::create()
                ->registerStyle('style_admin')
                ->registerScript('script_admin')
                ->setData(array(
                    'template' => $currentTemplate,
                    'error' => $error,
                    'message' => $message,
                    'templates' => $templates,
                    'currTpl' => $currentTemplate->name
                ))
                ->renderAdmin('main');
    }

    private function setLogoFav() {

        $this->load->library('SiteInfo');
        $imagesPath = PUBPATH . $this->siteinfo->imagesPath;

        $config['upload_path'] = $imagesPath;
        $config['allowed_types'] = 'jpg|jpeg|png|ico|gif';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        $siteinfo = $this->siteinfo->getSiteInfoData(TRUE);

        // upload or delete (or do nothing) favicon and logo
        if ($_POST['si_delete_favicon'] == 1) {
            if (isset($siteinfo['siteinfo_favicon']))
                $siteinfo['siteinfo_favicon'] = "";
        } else {
            $this->processLogoOrFavicon('siteinfo_favicon', $siteinfo);
        }

        if ($_POST['si_delete_logo'] == 1) {
            if (isset($siteinfo['siteinfo_logo']))
                $siteinfo['siteinfo_logo'] = "";
        } else {
            $this->processLogoOrFavicon('siteinfo_logo', $siteinfo);
        }

        $siteinfoString = serialize($siteinfo);

        CI::$APP->db
                ->limit(1)
                ->update('settings', array('siteinfo' => $siteinfoString), array('s_name' => 'main'));

        if (!empty(CI::$APP->db->_error_message())) {
            throw new Exception(lang('DB Error', 'template_manager'));
        }
    }

    /**
     * 
     * @param type $paramName
     */
    protected function processLogoOrFavicon($paramName, &$siteinfo) {
        if (!isset($_FILES[$paramName])) {
            return;
        }

        if (empty($_FILES[$paramName]['name'])) {
            return;
        }

        if (!$this->upload->do_upload($paramName)) {
            throw new Exception($this->upload->display_errors('', ''));
        } else {
            $uploadData = $this->upload->data();
            $siteinfo[$paramName] = $uploadData['file_name'];
        }
    }

    /**
     * 
     * @param type $templateName
     * @throws \Exception
     */
    private function install($templateName) {
        $template = new \template_manager\classes\Template($templateName);
        if ($template->isValid()) {
            \template_manager\classes\TemplateManager::getInstance()->setTemplate($template);
        } else {
            throw new \Exception('Template is broken');
        }
    }

    /**
     * 
     * @param string $url
     * @return boolan|string хиба якщо помилка, назва шаблону якшо все ок
     */
    private function upload() {
        if (!empty($_POST['template_url']) || !empty($_FILES['template_file'])) {
            if (!empty($_POST['template_url'])) {
                $zipPath = $this->uploadByUrl($_POST['template_url']);
            } else {
                $zipPath = $this->uploadFromPc('template_file');
            }
            // розпакувати шаблон
            if (TRUE == \template_manager\classes\TemplateManager::getInstance()->unpack($zipPath)) {
                return TRUE;
            } else {
                throw new Exception('Error while unpacking');
            }
        }
        throw new Exception('No input data specified');
    }

    /**
     * 
     * @return boolean|string хиба, або шлях до файлу
     */
    private function uploadByUrl($url) {
        if (!file_exists($this->templatesUploadPath)) {
            mkdir($this->templatesUploadPath, 0777);
        }
        $fullName = array_pop(explode('/', $url));
        $nameArray = explode('.', $fullName);
        $ext = array_pop($nameArray);
        $name = count($nameArray) > 1 ? implode('.', $nameArray) : $nameArray[0];

        if ($ext == 'zip') {
            $fullPath = './uploads/templates/' . $name . '.zip';
            if (file_put_contents($fullPath, file_get_contents($url)) > 0) {
                return $fullPath;
            }
        } else {
            throw new Exception('Wrong file type');
        }
    }

    /**
     * 
     * @return boolean|string хиба, або шлях до файлу
     */
    private function uploadFromPc($fieldName) {
        if (!file_exists($this->templatesUploadPath)) {
            mkdir($this->templatesUploadPath, 0777);
        }
        $this->load->library('upload', array(
            'upload_path' => $this->templatesUploadPath,
            'allowed_types' => 'zip',
            'max_size' => 1024 * 10, // 10 Mb
            'file_name' => $_FILES[$fieldName]['name'],
        ));
        $destination = $this->templatesUploadPath . '/' . $_FILES[$fieldName]['name'];

        if (file_exists($destination)) {
            unlink($destination);
        }
        if (!$this->upload->do_upload($fieldName)) {
            throw new Exception($this->upload->display_errors());
        } else {
            $data = $this->upload->data();
            return $data['full_path'];
        }
    }

    public function updateComponent($componentName) {
        $template = new \template_manager\classes\Template($this->templateName);
        $component = $template->getComponent($componentName);

        if ($component instanceof $componentName) {
            if ($component->updateParams()) {
                showMessage(lang('Component settings successfuly updated', 'template_maneger'));
            } else {
                showMessage(lang('Component settings can not update', 'template_maneger'), '', 'r');
            }
            pjax(site_url('admin/components/init_window/template_manager') . '/' . '#' . $componentName);
        }
    }

}
<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use CMSFactory\assetManager;
use CMSFactory\Events;
use template_manager\classes\TArchive as TArchive;
use template_manager\classes\Template as Template;
use template_manager\classes\TemplateManager as TemplateManager;
use template_manager\legacy\DemodataMigrationsControl;

/**
 * Image CMS
 * tenplate Manager Module Admin
 */
class Admin extends BaseAdminController
{

    /**
     * Templates repository url
     */
    const REMOTE_TEMPLATES_REPOSITORY = 'http://www.imagecms.net/addons/shop/remoteDownload/';

    /**
     * Errors array
     * @var array
     */
    public $errors = [];

    /**
     * Template uploads path
     * @var string
     */
    private $templatesUploadPath;

    /**
     * Current template object
     * @var Template
     */
    private $currentTemplate;

    public function __construct() {
        parent::__construct();
        $this->currentTemplate = TemplateManager::getInstance()->getCurentTemplate();
        $this->templatesUploadPath = PUBPATH . 'uploads/templates';
        $this->loadLangs();
        $this->cache->delete_all();

        Events::create()->setListener([new DemodataMigrationsControl, 'run'], TemplateManager::EVENT_DEMODATA_INSTALLED);
    }

    /**
     * Render main admin page with settings current template
     */
    public function index() {
        if ($this->input->post()) {
            try {
                switch ($this->input->post('action')) {
                    // Upload template from pc or url
                    case 'upload':
                        $this->upload();
                        showMessage(lang('Template was successfully uploaded.', 'template_manager'));
                        jsCode('location.href = "#list";location.reload();');
                        break;
                    // Install template
                    case 'install':
                        $this->install();
                        break;
                    // Set logo anf favicon
                    case 'setLogoFav':
                        $this->setLogoFav();
                        showMessage(lang('Changes saved.', 'template_manager'));
                        break;
                    // Delete template
                    case 'delete':
                        $template_name = $this->input->post('addData');
                        $this->deleteTemplate($template_name);
                        showMessage(lang('Template was successfully deleted.', 'template_manager'));
                        break;
                    // Download template
                    case 'download':
                        $template_id = $this->input->post('addData');
                        $this->getRemoteTemplate($template_id);
                        showMessage(lang('Template was successfully downloaded.', 'template_manager'));
                        ajax_redirect('/admin/components/init_window/template_manager/#list', 600);
                        break;
                    // Setting some params
                    default :
                        $component = $this->input->post('handler');
                        $this->currentTemplate->getComponent($component)->setParams();
                        break;
                }
            } catch (Exception $e) {
                showMessage($e->getMessage(), '', 'r');
            }
        } else {

            $listRemote = TemplateManager::getInstance()->listRemote();

            if (count($listRemote['Template'])) {
                $freeTpl = [];
                foreach ($listRemote['Template'] as $tpl) {
                    $freeTpl[$tpl['Name']] = $tpl['IsFree'];
                }
            }

            $this->registerJsVars();
            assetManager::create()
                    ->registerStyle('style_admin')
                    ->registerStyle('jquery.fancybox-1.3.4')
                    ->registerScript('jquery.fancybox-1.3.4.pack')
                    ->registerScript('script_admin')
                    ->setData(
                        [
                                'freeTpl' => $freeTpl,
                                'templateToPay' => TemplateManager::getTemplateToPay(),
                                'template' => $this->currentTemplate,
                                'templates' => TemplateManager::getInstance()->listLocal(),
                                'remoteTemplates' => $this->input->get('remote_templates') ? TemplateManager::getInstance()->listRemote() : [],
                                'currTpl' => $this->currentTemplate->name
                            ]
                    )
                    ->renderAdmin('main');
        }
    }

    public function installFullDemodata($templateName) {
        if (TemplateManager::getInstance()->installDemoArchive($templateName)) {
            $lang = new MY_Lang();
            $lang->load('template_manager');

            $this->lib_admin->log(lang('Template demo data was successfully installed', 'template_manager') . ' - ' . $templateName);
            return json_encode(['success' => TRUE, 'message' => lang('Template demo data was successfully installed', 'template_manager')]);
        } else {
            $error = TemplateManager::getInstance()->messages ? TemplateManager::getInstance()->messages : lang('Error', 'template_manager');
            return json_encode(['error' => TRUE, 'message' => $error]);
        }
    }

    /**
     * Registers data on page in window.templateManagerData object
     */
    public function registerJsVars() {
        $jsData = json_encode(
            [
                    'acceptLicenseError' => lang('Templates are the intellectual property, so if you <br /> want to install it, you must accept the license agreement.', 'template_manager'),
                    'wrongFileType' => lang('Wrong filetype. Zip-archives only', 'template_manager'),
                    'moduleAdminUrl' => site_url('admin/components/cp/template_manager/'),
                ]
        );
        $jsCode = "var templateManagerData = {$jsData};";
        assetManager::create()->registerJsScript($jsCode, false, 'before');
    }

    public function get_template_license() {
        try {
            $template = new Template($this->input->get('template_name'));
            echo json_encode(['status' => 1, 'license_text' => $template->getLicenseAgreement(), 'demodataArchiveExist' => $template->demodataArchiveExists]);
        } catch (Exception $e) {
            echo json_encode(['status' => 0, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Set Logo and Favicon
     * @throws Exception
     */
    private function setLogoFav() {

        $this->load->library('SiteInfo');
        $imagesPath = PUBPATH . $this->siteinfo->imagesPath;

        $config['upload_path'] = $imagesPath;
        $config['allowed_types'] = 'jpg|jpeg|png|ico|gif';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        $siteinfo = $this->siteinfo->getSiteInfoData(TRUE);

        // upload or delete (or do nothing) favicon and logo
        if ($this->input->post('si_delete_favicon') == 1 && !$_FILES['siteinfo_favicon']) {
            if (isset($siteinfo['siteinfo_favicon'])) {
                $siteinfo['siteinfo_favicon'] = '';
            }
        } else {
            $this->processLogoOrFavicon('siteinfo_favicon', $siteinfo);
        }

        if ($this->input->post('si_delete_logo') == 1 && !$_FILES['siteinfo_logo']) {
            if (isset($siteinfo['siteinfo_logo'])) {
                $siteinfo['siteinfo_logo'] = '';
            }
        } else {
            $this->processLogoOrFavicon('siteinfo_logo', $siteinfo);
        }

        $siteinfoString = serialize($siteinfo);

        CI::$APP->db
            ->limit(1)
            ->update('settings', ['siteinfo' => $siteinfoString], ['s_name' => 'main']);

        $message = lang('Template Logo and Favicon changed.', 'template_manager');
        $this->lib_admin->log($message);

        $error = CI::$APP->db->_error_message();
        if (!empty($error)) {
            throw new Exception(lang('DB Error', 'template_manager'));
        }
    }

    /**
     * Process and upload logo and favicon
     * @param string $paramName
     * @param SiteInfo $siteinfo
     * @throws Exception
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
     * Install template by name
     * @throws Exception
     */
    public function install() {
        try {
            // license agreement acception
            if ($this->input->post('accept_license_agreement') != 1) {
                throw new Exception(lang('Templates are the intellectual property, so if you <br /> want to install it, you must accept the license agreement.', 'template_manager'));
            }
            if (!$this->input->post('template_name')) {
                throw new Exception(lang('Error - template not specified', 'template_manager'));
            }

            TemplateManager::getInstance()->setTemplate(new Template($this->input->post('template_name')));
            $this->lib_admin->log(lang('Template was successfully installed.', 'template_manager') . ' - ' . $this->input->post('template_name'));
            showMessage(lang('Template was successfully installed.', 'template_manager'));
            if (MAINSITE) {
                $xmlShopId = $this->load->module('mainsaas')->getShopId();
                $code = "if (typeof ga == 'function') { ga('send', 'event', 'Clients-change-design', '" . $xmlShopId . "');}";
                jsCode($code);
            }
        } catch (Exception $e) {
            showMessage($e->getMessage(), '', 'r');
            exit;
        }
    }

    /**
     * Upload template
     * @return bool|string
     * @throws Exception
     */
    private function upload() {
        if (!$this->input->post('template_url') & empty($_FILES['template_file'])) {
            throw new Exception(lang('No input data specified', 'template_manager'));
        }

        if ($this->input->post('template_url')) {
            $zipPath = $this->uploadByUrl($this->input->post('template_url'));
        } else {
            $zipPath = $this->uploadFromPc('template_file');
        }

        if ($zipPath == false) {
            throw new Exception(lang('Failed to download the archive', 'template_manager'));
        }

        $archive = new TArchive($zipPath);
        $templateName = $archive->unpack();
        return $templateName;
    }

    /**
     * Upload template by URL
     * @param string $url - template upload url
     * @param string $content - template content
     * @return boolean|string
     * @throws Exception
     */
    private function uploadByUrl($url, $content = '') {
        if (!$content) {
            $ext = pathinfo($url, PATHINFO_EXTENSION);
            if ($ext != 'zip') {
                throw new Exception(lang('Wrong file type', 'template_manager'));
            }
            $fileName = pathinfo($url, PATHINFO_BASENAME);
            $content = file_get_contents($url);
        } else {
            $fileName = $url;
        }

        if (!file_exists($this->templatesUploadPath)) {
            mkdir($this->templatesUploadPath, 0777);
        }

        $tempFolder = PUBPATH . 'uploads/templates/';
        if (!file_exists($tempFolder)) {
            mkdir($tempFolder);
        }

        $fullPath = $tempFolder . $fileName;

        if (file_put_contents($fullPath, $content) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Upload template from PC
     * @param string $fieldName
     * @return bool|string
     * @throws Exception
     */
    private function uploadFromPc($fieldName) {
        if (!file_exists($this->templatesUploadPath)) {
            mkdir($this->templatesUploadPath, 0777);
        }

        // Set upload settings
        $this->load->library(
            'upload',
            [
            'upload_path' => $this->templatesUploadPath,
            'allowed_types' => 'zip',
            'max_size' => 1024 * 100, // 100 Mb
            'file_name' => $_FILES[$fieldName]['name'],
                ]
        );

        // Upload folder
        $destination = $this->templatesUploadPath . '/' . $_FILES[$fieldName]['name'];

        if (file_exists($destination)) {
            unlink($destination);
        }

        // Make Upload
        if (!$this->upload->do_upload($fieldName)) {
            throw new Exception($this->upload->display_errors());
        } else {
            $data = $this->upload->data();
            return $data['full_path'];
        }
    }

    /**
     * Update component by name
     * @param string $componentName - component name
     */
    public function updateComponent($componentName) {
        $template = new Template($this->currentTemplate->name);
        $component = $template->getComponent($componentName);

        if ($component instanceof $componentName) {
            if ($component->updateParams()) {
                $this->lib_admin->log(lang('Component settings successfuly updated', 'template_manager') . ' - template manager');
                showMessage(lang('Component settings successfuly updated', 'template_manager'));
            } else {
                showMessage(lang('Component settings can not update', 'template_manager'), '', 'r');
            }
        }
    }

    /**
     * Delete template by name
     * @param string $templateName - template name
     * @return bool
     * @throws Exception
     */
    public function deleteTemplate($templateName) {
        // Template directory path
        $dir = TEMPLATES_PATH . $templateName;
        $delete = TRUE;

        if (!$templateName) {
            throw new Exception(lang('Template name is not set.', 'template_manager'));
            $delete = FALSE;
        }

        if ($this->currentTemplate->name == $templateName) {
            throw new Exception(lang('Can not delete installed template.', 'template_manager'));
            $delete = FALSE;
        }

        if (!is_writable($dir)) {
            throw new Exception(lang('Can not delete template. Check files permissions.', 'template_manager'));
            $delete = FALSE;
        }

        if (!file_exists($dir)) {
            throw new Exception(lang('Template does not exists.', 'template_manager'));
            $delete = FALSE;
        }

        /**
         * Delete template
         */
        if ($delete) {
            $it = new RecursiveDirectoryIterator($dir);
            $it = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($it as $file) {
                if ('.' === $file->getBasename() || '..' === $file->getBasename()) {
                    continue;
                }
                if ($file->isDir()) {
                    rmdir($file->getPathname());
                } else {
                    unlink($file->getPathname());
                }
            }
            rmdir($dir);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get remote free template by ID
     * @param null|integer $templateId - template id
     * @return string
     * @throws Exception
     */
    public function getRemoteTemplate($templateId = NULL) {
        if ($templateId) {
            $template_content = file_get_contents(self::REMOTE_TEMPLATES_REPOSITORY . $templateId);
            if ($template_content) {

                // Upload template
                if ($this->uploadByUrl('module_' . $templateId . '.zip', $template_content)) {

                    // Unpack template into templates folder
                    $unzip = new TArchive('./uploads/templates/module_' . $templateId . '.zip');

                    $this->load->helper('cookie');
                    $cookie = [
                        'name' => 'DownloadedTemplateName',
                        'value' => $unzip->getTemplateName(),
                        'expire' => '10'
                    ];

                    set_cookie($cookie);
                    return $unzip->unpack();
                }
            } else {
                throw new Exception(lang('Can not upload template.', 'template_manager'));
            }
        } else {
            throw new Exception(lang('Can not upload template.', 'template_manager'));
        }
    }

    /**
     * Load language files
     */
    private function loadLangs() {
        $lang = new MY_Lang();
        $lang->load('template_manager');

        $this->config->set_item('template', $this->currentTemplate->name);
        $lang->load();
        $this->config->set_item('template', 'administrator');
    }

}
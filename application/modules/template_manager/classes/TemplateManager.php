<?php

namespace template_manager\classes;

use template_manager\classes\DemodataQueriesFilter;

class TemplateManager {

    const REMORE_UPDATE_INTERVAL = 7200; // 3 hours
    const EVENT_DEMODATA_INSTALLED = 'demodata:installed';
    const EVENT_DEMODATA_PRE_INSTALLED = 'demodata:preInstalled';

    /**
     *
     * @var TemplateManager
     */
    private static $instance;

    /**
     *
     * @var array
     */
    public $defaultComponents = [];

    /**
     * May have messages
     * @var array|string
     */
    public $messages = [];

    /**
     * Current template
     * @var Template
     */
    private $currentTemplate;

    /**
     *
     * @var string
     */
    private static $ImageCMSRepositoryURL = 'http://www.imagecms.net/addons/shop/templates_xml';

    /**
     *
     * @var array
     */
    public $loadedComponents = [];

    /**
     * Folders that not be included in local templates list
     * @var array
     */
    public $ignoreTemplates = [
        'administrator'
    ];

    public $current_template_components;

    /**
     *
     * @var array
     */
    private $allowedDemodataTables = [];

    /**
     *
     * @return TemplateManager
     */
    public static function getInstance() {
        self::$instance = self::$instance ? self::$instance : new self;
        return self::$instance;
    }

    /**
     * Getting core components
     */
    private function __construct() {
        if (SHOP_INSTALLED) {
            self::$ImageCMSRepositoryURL = self::$ImageCMSRepositoryURL . '/Shop';
        } else {
            self::$ImageCMSRepositoryURL = self::$ImageCMSRepositoryURL . '/Corporate';
        }
    }

    public function loadDefaultComponents(array $except = []) {
        if (count($this->defaultComponents) > 0) {
            return;
        }
        $componentsPath = __DIR__ . '/../components/';

        $dirList = [];
        if ($handle = opendir($componentsPath)) {
            while (false !== ($componentName = readdir($handle))) {
                if ($componentName != "." && $componentName != ".." && !in_array($componentName, $except)) {
                    include_once $componentsPath . "$componentName/$componentName" . EXT;
                    $this->defaultComponents[$componentName] = new $componentName;
                }
            }
            closedir($handle);
        }
    }

    /**
     *
     */
    public static function getTemplateToPay() {
        if (MAINSITE) {

            preg_match('/\/var\/www\/[a-zA-Z\d]+\/data\/www\/([a-zA-Z\d\.\-]+)\//', \CI::$APP->input->server('SCRIPT_FILENAME'), $matches);
            $dirToPay = MAINSITE . '/application/config/' . $matches[1] . '/payments/template';
            if ($handle = opendir($dirToPay)) {
                $templateList = [];
                while (false !== ($template = readdir($handle))) {
                    if ($template != '.' && $template != '..') {
                        $templateList[$template] = file_get_contents($dirToPay . '/' . $template);
                    }
                }
                return $templateList;
            }
            return false;
        } else {
            return false;
        }
    }

    /**
     * Fires event "postTemplateInstall"
     *
     * @param Template $template
     * @return boolean|null
     * @throws Exception
     */
    public function setTemplate(Template $template, $installDemodata = FALSE, $installDemoArchive = FALSE) {
        if ($this->currentTemplate->name == $template->name) {
            throw new \Exception(lang('Current installed template can not be installed again', 'template_manager'));
        }

        //Install template demodata
        //        if ($installDemodata) {
        if (isset($template->xml->demodata)) {
            $demodataDirector = new \template_manager\installer\DemodataDirector($template->xml->demodata);
            $res = $demodataDirector->install();
            $this->massages = $demodataDirector->getMessages();
            if (FALSE == $res) {
                throw new \Exception(lang('One or more dependency error', 'template_manager'));
            }
        }

        $this->copyUploads($template->name);
        //        }
        // Truncate table template_settings
        \CI::$APP->db->truncate('template_settings');

        foreach ($template->xml->components->component as $component) {
            $attributes = $component->attributes();
            $handler = (string) $attributes['handler'];
            $instance = $template->getComponent($handler);
            $instance->setParamsXml($component);
        }

        \CI::$APP->db->where('name', 'systemTemplatePath')->update('shop_settings', ['value' => './templates/' . $template->name . '/shop/']);
        \CI::$APP->db->update('settings', ['site_template' => $template->name]);

        $this->currentTemplate = $template;

        // processing all dependencies
        if (isset($template->xml->dependencies)) {
            if (isset($template->xml->dependencies->dependence)) {
                $dependenceDirector = new \template_manager\installer\DependenceDirector($template->xml->dependencies->dependence);
                $res = $dependenceDirector->verify($installDemodata);
                $this->massages = $dependenceDirector->getMessages();
                if (FALSE == $res) {
                    throw new \Exception(lang('One or more dependency error', 'template_manager'));
                }
            }
        }

        \CMSFactory\Events::create()->registerEvent($template, 'postTemplateInstall');
        \CMSFactory\Events::runFactory();
    }

    public function installDemoArchive($template_name) {
        try {
            \CMSFactory\Events::create()->raiseEvent(['templateName' => $template_name], self::EVENT_DEMODATA_PRE_INSTALLED);

            $demodata_atchive = realpath('templates/' . $template_name . '/demodata/uploads.zip');

            if ($demodata_atchive) {
                $uploads_folder = realpath('uploads');
                if ($uploads_folder) {
                    chmod($uploads_folder, 0777);
                    $backUpFolderName = $uploads_folder . '_backup_' . time();
                    rename($uploads_folder, $backUpFolderName);
                }

                $zip = new \ZipArchive();
                $zip->open($demodata_atchive);

                if (strstr($zip->getNameIndex(0), 'uploads')) {
                    $zip->extractTo('.');
                } else {
                    mkdir('./uploads');
                    chmod('./uploads', 0777);
                    $zip->extractTo(realpath('uploads'));
                }
                $zip->close();

                $changedDir = [];
                $uploads_folder = realpath('uploads');
                foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($uploads_folder)) as $entity) {
                    $directory = dirname($entity->getPathname());
                    if (!in_array($directory, $changedDir)) {
                        chmod($directory, 0777);
                        $changedDir[] = dirname($entity->getPathname());
                    }
                    chmod($entity->getPathname(), 0777);
                }
                chmod($uploads_folder, 0777);
                //move academy images to new uploads path
                $academyImages = $backUpFolderName . '/images/academy';
                chmod($academyImages, 0777);
                rename($academyImages, UPLOADSPATH . 'images/academy');
            }

            $demodata_db = realpath('templates/' . $template_name . '/demodata/database.sql');

            if ($demodata_db) {
                $this->db_backup();

                $db_file_content = file_get_contents($demodata_db);
                $this->query_from_file($db_file_content);
            }

            \CMSFactory\Events::create()->raiseEvent(['templateName' => $template_name], self::EVENT_DEMODATA_INSTALLED);

            return TRUE;
        } catch (\Exception $exc) {
            $this->messages = $exc->getMessage();
            return FALSE;
        }
    }

    public function db_backup() {
        if (!is_dir(BACKUPFOLDER)) {
            mkdir(BACKUPFOLDER);
            chmod(BACKUPFOLDER, 0777);
        }

        if (is_really_writable(BACKUPFOLDER)) {
            \CI::$APP->load->dbutil();
            $filePath = \libraries\Backup::create()->createBackup("sql", "backup_template_manager", TRUE);
            chmod(BACKUPFOLDER . 'backup_template_manager.sql', 0777);
            return pathinfo($filePath, PATHINFO_BASENAME);
        }
        return FALSE;
    }

    /**
     * @param string $file
     */
    public function query_from_file($file) {
        $string_query = rtrim($file, "\n;");

        $array_query = explode(";\n", str_replace(";\r\n", ";\n", $string_query));
        $demodataQueriesFilter = new DemodataQueriesFilter();

        foreach ($array_query as $query) {
            if (false !== ($updateQuery = $demodataQueriesFilter->filterSettings($query))) {
                \CI::$APP->db->query($updateQuery);
            }
            if ($demodataQueriesFilter->verifyQuery($query)) {
                \CI::$APP->db->query($query);
            }
        }
    }

    /**
     * @param string $templateName
     */
    private function copyUploads($templateName) {
        $templateUploadsFolder = "./templates/{$templateName}/uploads";

        if (is_dir($templateUploadsFolder)) {
            foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($templateUploadsFolder)) as $entity) {
                if ($entity->getFilename() != '.' && $entity->getFilename() != '..' && !strstr($entity->getPathname(), '/.')) {
                    preg_match('/uploads.*/', $entity->getPathname(), $matches);

                    $copyPath = './' . $matches[0];
                    $directoryName = dirname($copyPath);
                    $directories = explode('/', $directoryName);

                    $main_dir = './uploads';
                    foreach ($directories as $directory) {
                        if ($directory != '.' && $directory != 'uploads') {
                            $main_dir .= '/' . $directory;
                            if (!file_exists($main_dir)) {
                                mkdir($main_dir, 0777);
                            }
                        }
                    }

                    copy($entity->getPathname(), $copyPath);
                }
            }
        }
    }

    /**
     * Returns the current set template
     * @return Template
     */
    public function getCurentTemplate() {
        if ($this->currentTemplate === null) {
            $currentTemplateName = \CI::$APP->db->get('settings')->row()->site_template;
            $this->currentTemplate = new Template($currentTemplateName);
        }
        return $this->currentTemplate;
    }

    public function getCurrentTemplateComponents() {
        if ($this->current_template_components === null) {
            $this->current_template_components = $this->getCurentTemplate()
                ->getComponents();
        }
        return $this->current_template_components;
    }

    /**
     * Templates from ./templates directory
     * @param boolean $validOnly (optional, default TRUE) if false all
     * templates will be shown, if true only those wich have all needed files
     * @return array arrsy of Template objects
     */
    public function listLocal($validOnly = TRUE) {
        $templates = [];
        foreach (get_templates() as $templateName) {
            $templates[] = new Template($templateName);
        }

        usort(
            $templates,
            function($t1, $t2) {
                    $names1 = [$t1->name, $t2->name];
                    $names2 = $names1;
                    sort($names1);
                    return ($names1 === $names2) ? -1 : 1;
            }
        );

        return $templates;
    }

    /**
     * Gets data from remote feed with templates
     * @param string $sourceUrl url of remote xml file with template data
     * @return array of Template
     */
    public function listRemote($sourceUrl = '') {
        if (!$sourceUrl) {
            $sourceUrl = self::$ImageCMSRepositoryURL;
        }

        $pathToCachedFile = FCPATH . '/uploads/templates/' . md5($sourceUrl);
        if (file_exists($pathToCachedFile) && time() < (filemtime($pathToCachedFile) + self::REMORE_UPDATE_INTERVAL)) {
            $templatesXML = file_get_contents($pathToCachedFile);
        } else {
            $templatesXML = $this->getContents($sourceUrl);
            if (empty($templatesXML)) {
                if (file_exists($pathToCachedFile)) {
                    $templatesXML = file_get_contents($pathToCachedFile);
                }
            } else {
                file_put_contents($pathToCachedFile, $templatesXML);
            }
        }
        $xml = simplexml_load_string($templatesXML);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        return $array;
    }

    /**
     * @param string $url
     */
    protected function getContents($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

}
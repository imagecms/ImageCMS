<?php

use translator\classes\PoFileManager as PoFileManager;
use translator\classes\FileOperator as FileOperator;
use translator\classes\FilesParser as FilesParser;
use translator\classes\YandexTranslate as YandexTranslate;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Translator Module Admin
 * @version 1.0
 *
 */
class Admin extends BaseAdminController {

    public $modules_path = "./application/modules/";

    public $templates_path = "./templates/";

    public $main_path = "./application/language/main/";

    public $langs = array();

    public $langs_modules = array();

    public $langs_templates = array();

    public $langs_main = array();

    public $parsed_langs = array();

    public $exchangePoArray;

    public $js_langs = array();

    public $domain;

    public $fileError = '';

    public $filePermissionsErrors;

    public $allowed_extentions = array('php', 'tpl', 'js');

    public $poFileManager;

    private static $SAAS;

    private static $BILING;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('translator');
        $this->load->helper('translator');
        $this->poFileManager = new PoFileManager();
        self::$SAAS = MAINSITE ? TRUE : FALSE;
        self::$BILING = is_dir('./application/modules/saas') ? TRUE : FALSE;
    }

    /**
     * Save settings
     * @param array $settings
     * @return boolean
     */
    public function setSettings($settings) {
        $settings = getSettings();
        if ($this->input->post('originsLang')) {
            $settings['originsLang'] = $this->input->post('originsLang');
        }

        if ($this->input->post('YandexApiKey')) {
            $settings['YandexApiKey'] = $this->input->post('YandexApiKey');
        }

        if ($this->input->post('theme')) {
            $settings['editorTheme'] = $this->input->post('theme');
        }

        return updateSettings($settings);
    }

    public function settings() {

        if ($_POST) {
            $settings = $this->input->post('settings');
            updateSettings($settings);
            showMessage(lang('Settings was successfully updated', 'translator', FALSE));

            $this->lib_admin->log(lang('Translators settings was successfully updated.', 'translator'));

            if ($this->input->post('action') == 'exit') {
                pjax(site_url('admin/components/init_window/translator'));
            }
        } else {
            \CMSFactory\assetManager::create()
                ->registerScript('admin')
                ->registerStyle('admin')
                ->setData('settings', getSettings())
                ->setData('languages_names', get_language_names())
                ->renderAdmin('settings');
        }
    }

    public function index($isExchange = FALSE) {
        $translation = $this->session->userdata('translation');

        $po_table = '';
        $name = $_GET['name'] ? $_GET['name'] : $translation['name'];
        $type = $_GET['type'] ? $_GET['type'] : $translation['type'];
        $lang = $_GET['lang'] ? $_GET['lang'] : $translation['lang'];

        if (($translation || $_GET) && $name && $type && $lang) {

            if (!$isExchange) {
                $po_table = $this->renderModulePoFile($name, $type, $lang);
            } else {
                $po_table = $this->exchangePoArray;
            }
        }

        $this->getExistingLocales();

        $modules = $this->load->module('admin/components')->find_components();

        switch ($type) {
            case 'modules':
                $names = $this->renderModulesNames($lang);
                break;
            case 'templates':
                $names = $this->renderTemplatesNames($lang);
                break;
            default :
                $names = '';
        }

        \CMSFactory\assetManager::create()
            ->registerScript('admin')
            ->registerStyle('admin')
            ->setData('langs', $this->langs)
            ->setData('settings', getSettings())
            ->setData('languages_names', get_language_names())
            ->setData('editorStyles', getEditorStyles())
            ->setData('BILING', self::$BILING)
            ->setData('modules', $modules)
            ->setData('names', $names)
            ->renderAdmin('list');

        //        var_dumps_exit('33333');

        if ($translation) {
            $data = trim($po_table);

            jsCode("Translator.start(" . json_encode($data) . ",'" . $type . "', '" . $lang . "', '" . $name . "');");
        } else {
            jsCode("Translator.render('');");
        }
    }

    public function search($search = NULL, $searchType = NULL) {
        $data = $this->input->post();
        $search = $search ? $search : trim($data['search']);
        $search = urldecode($search);

        if ($_POST) {
            $searchType = trim($data['searchType']);

            if ($search) {
                if (translator\classes\PoFileSearch::getInstatce()->run($search, $searchType)) {
                    $searchResult = translator\classes\PoFileSearch::getInstatce()->getData();

                    $this->session->set_flashdata('searchResultsCount', translator\classes\PoFileSearch::getInstatce()->getResultsCount());
                    $this->session->set_flashdata('searchResult', $searchResult);
                } else {
                    $searchError = translator\classes\PoFileSearch::getInstatce()->getErrors();
                    $this->session->set_flashdata('searchError', $searchError);
                }
                redirect(site_url("/admin/components/init_window/translator/search/$search/$searchType"));
            } else {
                $this->session->set_flashdata('searchError', lang('Field Search string cannot be empty.', 'translator'));
                redirect(site_url("/admin/components/init_window/translator/search"));
            }
        } else {
            if ($search) {
                if (translator\classes\PoFileSearch::getInstatce()->run($search, $searchType)) {
                    $searchResult = translator\classes\PoFileSearch::getInstatce()->getData();
                    $searchResultsCount = translator\classes\PoFileSearch::getInstatce()->getResultsCount();
                } else {
                    $searchError = translator\classes\PoFileSearch::getInstatce()->getErrors();
                }
            }
            $languages = $this->db->get('languages')->result_array();
            $languages_data = array();
            foreach ($languages as $language) {
                $languages_data[$language['locale']] = $language['lang_name'];
            }

            \CMSFactory\assetManager::create()
                ->setData(
                    array(
                        'searchResult' => $searchResult ? $searchResult : $this->session->flashdata('searchResult'),
                        'searchError' => $searchError ? $searchError : $this->session->flashdata('searchError'),
                        'searchResultsCount' => $searchResultsCount ? $searchResultsCount : $this->session->flashdata('searchResultsCount'),
                        'languages' => $languages_data,
                        'search' => $search,
                        'searchType' => $searchType,
                    )
                )
                ->registerScript('admin')
                ->registerStyle('admin')
                ->renderAdmin('search');
        }
    }

    /**
     * Parse files to find new langs
     * @param type $module_template
     * @param type $type
     * @param type $lang
     * @return type
     */
    public function parse($module_template, $type, $lang) {
        $url_base = dirname($this->poFileManager->getPoFileUrl($module_template, $type, $lang));
        $url = get_mainsite_url($url_base);

        switch ($type) {
            case 'main':
                $domain = 'main';
                break;
            default :
                $domain = $module_template;
                break;
        }

        $paths = $this->input->post('paths');
        $parsedLangs = array();

        if ($paths) {
            $parsedLangs = FilesParser::getInstatce()->getParsedPathsLangs($url, $paths);

            if (MAINSITE && !is_client_module($module_template)) {
                $parsedLangs_base = FilesParser::getInstatce()->getParsedPathsLangs($url_base, $paths);
                if (!empty($parsedLangs_base)) {
                    if (isset($parsedLangs['parsed_langs'][0])) {
                        $parsedLangs['parsed_langs'][0] = array_merge($parsedLangs['parsed_langs'][0], $parsedLangs_base['parsed_langs'][0]);
                    }
                }
            }

            if (isset($parsedLangs['js_langs'])) {
                $this->updateJsLangsFile($parsedLangs['js_langs'], $domain, $type);
            }
        }

        $all_langs = array();
        foreach ($parsedLangs['parsed_langs'] as $key => $langsOne) {
            foreach ($langsOne as $origin => $paths) {
                $all_langs[$origin] = $paths;
            }
        }

        $results = array();
        $result = $this->poFileManager->toArray($module_template, $type, $lang);
        $currentLangs = $result['po_array'];

        foreach ($all_langs as $key => $newLang) {
            if (!isset($currentLangs[$key]) && trim($key)) {
                $results['new'][encode($key)] = $newLang;
            } else {
                unset($currentLangs[$key]);
            }
        }

        //        foreach ($results['new'] as $key => $langNew) {
        //            $results['new'][encode($key)] = $langNew;
        //        }

        $results['old'] = $currentLangs;
        foreach ($results['old'] as $key => $langOld) {
            unset($results['old'][$key]);
            $results['old'][encode($key)] = $langOld;
        }

        return json_encode($results);
    }

    /**
     * Update javascript langs file(jsLangs.js)
     * @param type $langs
     * @param type $domain
     */
    private function updateJsLangsFile($langs, $domain, $type) {
        if ($type == 'modules') {
            if (MAINSITE && !is_client_module($domain)) {
                return FALSE;
            }
        }

        $base_dir = ".";
        if (!empty($langs)) {
            $js_content = '<script>' . PHP_EOL;
            foreach ($langs as $langArray) {
                foreach ($langArray as $origin) {
                    $quote = strstr($origin, '"') ? "'" : '"';
                    $php_string = '<?php echo addslashes(lang(' . $quote . $origin . $quote . ', "' . $domain . '", FALSE))?>';
                    $js_content .= 'langs[' . $quote . mb_ereg_replace('([\s]+{.*?})', "<?php echo '\\0'?>", $origin) . $quote . '] = \'' . $php_string . '\';' . PHP_EOL;
                }
            }
            $js_content .= '</script>';

            if ($domain == "admin") {
                file_put_contents($base_dir . '/templates/administrator/inc/jsLangs.tpl', $js_content);
            } else {
                file_put_contents($base_dir . '/application/modules/' . $domain . '/assets/jsLangs.tpl', $js_content);
            }
        } else {
            if ($domain == "admin") {
                if (file_exists($base_dir . '/templates/administrator/inc/jsLangs.tpl')) {
                    unlink($base_dir . '/templates/administrator/inc/jsLangs.tpl');
                }
            } else {
                if (file_exists($base_dir . '/application/modules/' . $domain . '/assets/jsLangs.tpl')) {
                    unlink($base_dir . '/application/modules/' . $domain . '/assets/jsLangs.tpl');
                }
            }
        }
    }

    /**
     * Update po-file
     * @param type $module_template
     * @param type $type
     * @param type $lang
     * @return type
     */
    public function update($module_template, $type, $lang) {
        $strings = (array) json_decode($this->input->post('results'));
        $translations = $this->makeCorrectPoPaths($module_template, $type, $lang, TRUE);

        if (!$translations) {
            $translations = array();
        }

        $translationTEMP = array();
        $newStringsArray = (array) $strings['new'];
        $oldStringsArray = (array) $strings['old'];

        foreach ($newStringsArray as $origin => $newStrings) {
            $translationTEMP[$origin]['translation'] = '';
            $translationTEMP[$origin]['comment'] = '';
            $translationTEMP[$origin]['links'] = $newStrings;
            $translationTEMP[$origin]['fuzzy'] = false;
        }

        foreach ($oldStringsArray as $origin => $oldStrings) {
            if ($translations[$origin]) {
                unset($translations[$origin]);
            }
        }

        $can_edit_file = can_edit_file($module_template, $type);

        $result_array = array_merge($translationTEMP, $translations);
        $this->setSession($module_template, $type, $lang);
        return \CMSFactory\assetManager::create()
            ->setData('po_array', $result_array)
            ->setData('can_edit_file', $can_edit_file)
            ->fetchAdminTemplate('po_table', FALSE);
    }

    /**
     * Make correct po-file langs paths
     * @param type $module_template
     * @param type $type
     * @param type $lang
     * @param type $returnArray
     * @return type
     */
    public function makeCorrectPoPaths($module_template, $type, $lang, $returnArray = FALSE) {
        $url = dirname($this->poFileManager->getPoFileUrl($module_template, $type, $lang));
        //______________________________________________________
        $url = get_mainsite_url($url);
        //______________________________________________________
        $paths = $this->input->post('paths');
        $parsedLangs = FilesParser::getInstatce()->getParsedPathsLangs($url, $paths);
        $parsedLangs = $parsedLangs['parsed_langs'];

        $all_langs = array();
        foreach ($parsedLangs as $key => $langsOne) {
            foreach ($langsOne as $origin => $paths) {
                if ($all_langs[$origin]) {
                    array_push($all_langs[$origin], $paths);
                } else {
                    $all_langs[$origin] = $paths;
                }
            }
        }

        $result = $this->poFileManager->toArray($module_template, $type, $lang);
        $currentLangs = $result['po_array'];

        if (!$currentLangs && !$returnArray) {
            return json_encode(array('error' => TRUE, 'data' => lang('Update and save translation file befor this action.', 'translator')));
        }

        foreach ($all_langs as $origin => $paths) {
            if ($currentLangs[$origin]) {
                $needed_paths = array();
                foreach ($paths as $path) {
                    if (!is_array($path)) {
                        $needed_paths[] = $path;
                    }
                }

                $currentLangs[$origin]['links'] = $needed_paths;
            }
        }

        if ($returnArray) {
            return $currentLangs;
        } else {
            $this->setSession($module_template, $type, $lang);
            $can_edit_file = can_edit_file($module_template, $type);
            return \CMSFactory\assetManager::create()
                ->setData('po_array', $currentLangs)
                ->setData('page', 1)
                ->setData('rows_count', ceil(count($currentLangs) / 11))
                ->setData('can_edit_file', $can_edit_file)
                ->fetchAdminTemplate('po_table', FALSE);
        }
    }

    /**
     * Exchange translation between two po-files
     * @return type
     */
    public function exchangeTranslation() {
        if ($_POST) {
            $langExchanger = $this->input->post('langExchanger');
            $langReceiver = $this->input->post('langReceiver');

            $typeExchanger = $this->input->post('typeExchanger');
            $typeReceiver = $this->input->post('typeReceiver');

            $modules_templatesExchanger = $this->input->post('modules_templatesExchanger');
            $modules_templatesReceiver = $this->input->post('modules_templatesReceiver');
            if ($langExchanger && $langReceiver && $typeExchanger && $typeReceiver) {
                $resultExchanger = $this->poFileManager->toArray($modules_templatesExchanger, $typeExchanger, $langExchanger);
                $exchangerPoArray = $resultExchanger['po_array'];

                $resultReceiver = $this->poFileManager->toArray($modules_templatesReceiver, $typeReceiver, $langReceiver);
                $receiverPoArray = $resultReceiver['po_array'];

                foreach ($exchangerPoArray as $origin => $value) {
                    if ($receiverPoArray[$origin]) {
                        $receiverPoArray[$origin]['translation'] = $value['translation'];
                    }
                }

                $this->setSession($modules_templatesReceiver, $typeReceiver, $langReceiver);

                //                $this->setSession($module_template, $type, $lang);
                $can_edit_file = can_edit_file($module_template, $type);

                $this->exchangePoArray = \CMSFactory\assetManager::create()
                    ->setData('po_settings', $resultReceiver['settings'])
                    ->setData('po_array', $receiverPoArray)
                    ->setData('languages_names', get_language_names())
                    ->setData('page', 1)
                    ->setData('can_edit_file', $can_edit_file)
                    ->fetchAdminTemplate('po_table', FALSE);
                return $this->index(TRUE);
            }
        } else {
            $this->getExistingLocales();
            \CMSFactory\assetManager::create()
                ->registerScript('admin')
                ->registerStyle('admin')
                ->setData('langs', $this->langs)
                ->setData('languages_names', get_language_names())
                ->renderAdmin('exchange');
        }
    }

    /**
     * Render po-file data template
     * @param type $module_template
     * @param type $type
     * @param type $lang
     * @param type $offset
     * @param type $limit
     * @return type
     */
    public function renderModulePoFile($module_template, $type, $lang) {
        $this->session->unset_userdata('translation');
        $url = $this->poFileManager->getPoFileUrl($module_template, $type, $lang);

        if (!FileOperator::getInstatce()->checkFile($url)) {
            $error = FileOperator::getInstatce()->getErrors();
            $this->fileError = $error['error'];
            $this->filePermissionsErrors = $error['type'];
        } else {
            $result = $this->poFileManager->toArray($module_template, $type, $lang);
            $translations = $result['po_array'];
        }

        $can_edit_file = can_edit_file($module_template, $type);

        if ($translations) {
            $this->setSession($module_template, $type, $lang);

            return \CMSFactory\assetManager::create()
                ->setData('po_settings', $result['settings'])
                ->setData('po_array', $translations)
                ->setData('can_edit_file', $can_edit_file)
                ->fetchAdminTemplate('po_table', FALSE);
        } else {
            if (!$this->fileError && !$translations) {
                $this->setSession($module_template, $type, $lang);

                return \CMSFactory\assetManager::create()
                    ->setData('po_settings', $result['settings'])
                    ->setData('po_array', $translations)
                    ->setData('error', $this->fileError)
                    ->setData('can_edit_file', $can_edit_file)
                    ->fetchAdminTemplate('po_table', FALSE);
            }
            return json_encode(array('error' => TRUE, 'errors' => $this->fileError, 'type' => $this->filePermissionsErrors));
        }
    }

    /**
     * Create po-file
     * @param type $module_template
     * @param type $type
     * @param type $lang
     */
    public function createFile($module_template, $type, $lang) {
        if ($_POST) {
            $lang = $this->input->post('locale');
            $type = $this->input->post('type');
            $module_template = $this->input->post('module_template');

            $settings = $this->input->post();
            $settings['lang'] = $lang;
            if ($this->poFileManager->create($module_template, $type, $lang, $settings)) {
                showMessage(lang('File was succcessfuly created.', 'translator'), lang('Message', 'translator'));

                if ($this->input->post('action') == 'showEdit') {
                    $this->setSession($module_template, $type, $lang);
                    pjax('/admin/components/init_window/translator');
                }
            } else {
                foreach ($this->poFileManager->getErrors() as $error) {
                    showMessage($error, lang('Error', 'translator'), 'r');
                }
            }
        } else {
            $this->getExistingLocales();

            \CMSFactory\assetManager::create()
                ->registerScript('admin')
                ->registerStyle('admin')
                ->setData('langs', $this->langs)
                ->renderAdmin('create');

            if ($module_template && $type && $lang) {
                switch ($type) {
                    case 'modules':
                        $names = $this->renderModulesNames($lang);
                        $file_name = $module_template;
                        break;
                    case 'templates':
                        $names = $this->renderTemplatesNames($lang);
                        $file_name = $module_template;
                        break;
                    case 'main':
                        $file_name = $type;
                        break;
                }

                $names = trim(preg_replace('/\s\s+/', ' ', $names));
                jsCode("Translator.start('','" . $names . "', '" . $type . "', '" . $lang . "', '" . $file_name . "');");
            }
        }
    }

    /**
     * Save po-array
     * @param type $module_template
     * @param type $type
     * @param type $lang
     */
    public function savePoArray($module_template, $type, $lang) {
        $po_array = (array) json_decode($this->input->post('po_array'));
        $showMessage = (bool) $this->input->post('showMessage');

        if ($this->poFileManager->save($module_template, $type, $lang, $po_array)) {
            if ($showMessage) {
                showMessage(lang('Translation file was successfuly saved.', 'translator'), lang('Message', 'translator'));
            }
            $this->lib_admin->log(lang('Translation file was successfuly saved.', 'translator') . ' - ' . $module_template . ' | ' . $lang);
        } else {
            foreach ($this->poFileManager->getErrors() as $error) {
                showMessage($error, lang('Error', 'translator'), 'r');
            }
        }
    }

    /**
     * Clear translation path memory from session
     */
    public function canselTranslation() {
        $this->session->unset_userdata('translation');
        if (!$this->session->userdata('translation')) {
            showMessage(lang('Selection path memory was successfuly cleared.', 'translator'), lang('Message', 'translator'));
            jsCode('window.location.reload();');
        } else {
            showMessage(lang('Operation failed!', 'translator'), lang('Error', 'translator'), 'r');
        }
    }

    /**
     * Get existing locales and set it to session
     */
    public function getExistingLocales() {
        $this->langs_modules = FilesParser::getInstatce()->parseModules();
        $this->langs_templates = FilesParser::getInstatce()->parseTemplates();
        $this->langs_main = FilesParser::getInstatce()->parseMain();

        $this->langs = array_unique(
            array_merge(
                array_keys($this->langs_templates),
                array_keys($this->langs_main)
            )
        );

        $this->session->set_userdata('langs', $this->langs);
        $this->session->set_userdata('langs_modules', $this->langs_modules);
        $this->session->set_userdata('langs_templates', $this->langs_templates);
        $this->session->set_userdata('langs_main', $this->langs_main);
    }

    /**
     * Render modules names tpl
     * @param string $lang - locale
     * @return type
     */
    public function renderModulesNames($lang) {
        $langs = $this->session->userdata('langs_modules');
        $langs = $langs[$lang];
        $langs = sort_names($langs);

        if (self::$SAAS) {
            $tariff_modules = $this->load->module('mainsaas')->getNotPermited();

            foreach ($langs as $key => $lang) {
                if (!in_array($lang['module'], $tariff_modules)) {
                    unset($langs[$key]);
                }
            }
        }
        return \CMSFactory\assetManager::create()
            ->setData('langs', $langs)
            ->fetchAdminTemplate('modules_names', FALSE);
    }

    /**
     * Render Templates names tpl
     * @param string $lang - locale
     * @return type
     */
    public function renderTemplatesNames($lang) {
        $langs = $this->session->userdata('langs_templates');
        $langs = $langs[$lang];
        return \CMSFactory\assetManager::create()
            ->setData('langs', $langs)
            ->fetchAdminTemplate('templates_names', FALSE);
    }

    /**
     * Translate world
     * @param string $translationLanguage
     * @param string $textToTranslate
     * @return type
     */
    public function translateWord($translationLanguage, $textToTranslate = "") {
        $text = $textToTranslate ? $textToTranslate : $this->input->post('word');
        return YandexTranslate::getInstatce()->translate($translationLanguage, $text);
    }

    /**
     * Render translated table
     * @return json
     */
    public function translate() {
        $po_array = (array) json_decode($this->input->post('po_array'));
        $result = (array) json_decode($this->input->post('results'));
        $withEmptyTranslation = $this->input->post('withEmptyTranslation');

        $addUpdatedStrings = array();
        if ($po_array) {

            $counter = 0;
            foreach ($po_array as $origin => $value) {
                if ($origin) {
                    $po_array[$origin] = (array) $po_array[$origin];
                    if ($withEmptyTranslation != 'false') {
                        if (!strlen($po_array[$origin]['translation'])) {
                            $po_array[$origin]['translation'] = $result[$counter];
                            $addUpdatedStrings[$origin] = $result[$counter];
                        }
                    } else {
                        $po_array[$origin]['translation'] = $result[$counter];
                    }
                    $counter += 1;
                }
            }

            $can_edit_file = can_edit_file($module_template, $type);

            return json_encode(
                array(
                'data' => \CMSFactory\assetManager::create()
                    ->setData('po_array', $po_array)
                    ->setData('page', 1)
                    ->setData('rows_count', ceil(count($po_array) / 11))
                    ->setData('can_edit_file', $can_edit_file)
                    ->fetchAdminTemplate('po_table', FALSE)
                )
            );
        }
    }

    /**
     * Get set of language names
     * @return type
     */
    public function getLangaugesNames() {
        $languages = get_language_names();
        $language = mb_strtolower($this->input->get('term'));
        $data = array();

        foreach ($languages as $key => $lang) {
            if (strstr(mb_strtolower($lang), $language) && $language != 'all_languages') {
                $data[] = array('locale' => $key, 'label' => $lang);
            } elseif ($language == 'all_languages') {
                $data[] = array('locale' => $key, 'label' => $lang);
            }
        }
        return json_encode($data);
    }

    /**
     * Get langauge name by locale
     * @param string $locale - locale name
     * @return string
     */
    public function getLanguageByLocale($locale = '') {
        if ($locale) {
            $languages = get_language_names();
            if ($languages[$locale]) {
                return $languages[$locale];
            }
        }
    }

    /**
     * Render file
     * @return json
     */
    public function renderFile() {
        $filePath = $this->input->post('filePath');
        if (FileOperator::getInstatce()->getFile($filePath)) {
            return json_encode(array('success' => TRUE, 'data' => FileOperator::getInstatce()->getData()));
        } else {
            $error = FileOperator::getInstatce()->getErrors();
            return json_encode(array('error' => TRUE, 'errors' => $error['error']));
        }
    }

    /**
     * Save editing file
     * @return json
     */
    public function saveEditingFile() {
        $filePath = $this->input->post('filePath');
        $content = $this->input->post('content');

        if (FileOperator::getInstatce()->updateFile($filePath, $content)) {
            return json_encode(array('success' => TRUE, 'data' => TRUE));
        } else {
            return json_encode(array('error' => TRUE, 'errors' => FileOperator::getInstatce()->getErrors()));
        }
    }

    /**
     * Set session translator params
     * @param type $name
     * @param type $type
     * @param type $lang
     */
    private function setSession($name = '', $type = '', $lang = '') {
        $this->session->set_userdata(
            'translation',
            array(
            'name' => $name,
            'type' => $type,
            'lang' => $lang,
            )
        );
    }

    /**
     * Returns main translation file paths
     * @return json
     */
    public function getMainFilePaths() {
        $po_array = $this->poFileManager->toArray('main', 'main', CUR_LOCALE);

        foreach ($po_array['settings']['SearchPath'] as $key => $path) {
            $po_array['settings']['SearchPath'][$key] = str_replace('../../../', '', $path);
            if (!preg_match('/\w/', $path)) {
                unset($po_array['settings']['SearchPath'][$key]);
            }
        }

        return json_encode($po_array['settings']['SearchPath']);
    }

    public function updateOne() {
        $name = $this->input->post('name');
        $type = $this->input->post('type');
        $locale = $this->input->post('locale');
        $translation = $this->input->post('translation');
        $origin = $this->input->post('origin');

        $poFileManager = new PoFileManager();

        if ($name && $type && $locale && $origin) {
            $data[$origin] = array(
                'translation' => $translation
            );

            if ($poFileManager->update($name, $type, $locale, $data)) {
                return json_encode(array('success' => TRUE, 'message' => lang('Successfully translated.', 'translator')));
            } else {
                return json_encode(array('errors' => TRUE, 'message' => $poFileManager->getErrors()));
            }
        } else {
            return json_encode(array('errors' => TRUE, 'message' => lang('Not valid translation file attributes.', 'translator')));
        }
    }

    public function searchPoFileAutocomplete() {
        $data = $this->input->post();
        $result = $this->poFileManager->searchPoFileAutocomplete($data['modules_templates'], $data['types'], $data['locale'], $data['term']);

        $returnsData = [];
        foreach ($result as $item) {
            $returnsData[] = [
                'label' => $item,
                'value' => $item,
            ];
        }

        return json_encode(['results' => $returnsData]);
    }

}
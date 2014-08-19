<?php

use translator\classes\PoFileManager as PoFileManager;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Translator Module 
 */
class Translator extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('translator');
        $lang = new MY_Lang();
        $lang->load('translator');
    }

    public function index() {
        $this->core->error_404();
    }

    public function replaceKeys($templateName) {
//        $templateName = 'newLevel2';
//        var_dumps_exit($templateName);
        $templatesPath = './templates/' . $templateName;

        $fromLocale = 'en_US';
        $pofilePath = $templatesPath . '/language/' . $templateName . '/' . $fromLocale . '/LC_MESSAGES/' . $templateName . '.po';


        $poFile = file($pofilePath);

        $result = array();
        foreach ($poFile as $line) {
            $first2symbols = substr($line, 0, 2);

            if ($first2symbols == '#:') {
                $links[] = trim(substr($line, 2, -1));
                continue;
            }

            if (substr($line, 0, 5) == 'msgid') {
                if (preg_match('/"(.*?)"/', $line, $matches)) {
                    $origin = $matches[1];
                    if (!strlen($origin)) {
                        $origin = 0;
                    }
                }

                continue;
            }

            if (substr($line, 0, 6) == 'msgstr') {
                if ($origin) {
                    preg_match('/"(.*?)"/', $line, $translation);
                    $translation = $translation[1];
                    $result[] = array('paths' => $links, 'origin' => $origin, 'translation' => $translation);
                    unset($links);
                }
            }
        }

        foreach ($result as $key => $value) {
            foreach ($value['paths'] as $path) {
                $path = preg_replace('/:[\d]+/', '', $path);
                $file = file_get_contents($path);
                $translation = str_replace("'", '', $value['translation']);
                $translation = str_replace('"', '', $translation);
                $file = preg_replace('/(?<!\w)lang\([\"]{1}' . preg_quote($value['origin']) . '[\"]{1}/', "lang('" . $translation . "'", $file);
                $file = preg_replace("/(?<!\w)lang\([']{1}" . preg_quote($value['origin']) . "[']{1}/", "lang('" . $translation . "'", $file);
                file_put_contents($path, $file);
            }
        }

        foreach ($poFile as $key => $line) {
            if (strstr($line, 'msgid') && $key > 5) {
                $tmp = $poFile[$key];
                $poFile[$key] = $poFile[$key + 1];
                $poFile[$key + 1] = $tmp;
                $poFile[$key] = str_replace('msgstr', 'msgid', $poFile[$key]);
                $poFile[$key + 1] = str_replace('msgid', 'msgstr', $poFile[$key + 1]);
            }
        }

        $pofilePathRu = str_replace('en_US', 'ru_RU', $pofilePath);
        file_put_contents($pofilePath, implode("", $poFile));

        foreach ($poFile as $key => $line) {
            if (strstr($line, 'msgstr') && $key > 5) {
                $poFile[$key] = "msgstr \"\"\n";
            }
        }

        file_put_contents($pofilePath, implode("", $poFile));
        $poFileManager = new PoFileManager();

        $poFileManager->convertToMO($pofilePath);
        $poFileManager->convertToMO($pofilePathRu);
    }

    public static function adminAutoload() {
        self::fetchApiTpl();
    }

    public function autoload() {
        self::fetchApiTpl();
    }

    private static function fetchApiTpl() {
        $CI = & get_instance();
        $obj = $this ? $this : $CI;

        if (!$obj->input->is_ajax_request() || $obj->input->get('_pjax')) {
            $translator = $obj->db->where('name', 'translator')->get('components');

            if ($translator) {
                $translator = $translator->row_array();

                if ($translator['settings']) {
                    $translatorSettings = unserialize($translator['settings']);

                    if (isset($translatorSettings['showApiForm']) && $obj->dx_auth->is_admin()) {
                        if (!defined('ENABLE_TRANSLATION_API'))
                            define('ENABLE_TRANSLATION_API', TRUE);
                        $lang = new MY_Lang();
                        $lang->load('translator');
                        \CMSFactory\assetManager::create()->registerScript('translateSingleLang');
                        $obj->template->include_tpl('translationApiForm', './application/modules/translator/assets/');
                    }
                }
            }
        }
    }

    public function translate() {
        $domain = $this->input->post('domain');
        $translation = $this->input->post('translation');
        $origin = $this->input->post('origin');
        $comment = $this->input->post('comment');

        $poFileManager = new PoFileManager();

        $po_Attributes = getPoFileAttributes($domain);
        if ($po_Attributes) {
            $data[$origin] = array(
                'translation' => $translation,
                'comment' => $comment
            );
            if ($poFileManager->update($po_Attributes['name'], $po_Attributes['type'], $po_Attributes['lang'], $data)) {
                return json_encode(array('success' => TRUE, 'message' => lang('Successfully translated.', 'translator')));
            } else {
                return json_encode(array('errors' => TRUE, 'message' => $poFileManager->getErrors()));
            }
        } else {
            return json_encode(array('errors' => TRUE, 'message' => lang('Not valid translation file attributes.', 'translator')));
        }
    }

    public function getSettings() {
        $settings = getSettings();

        if (strstr($_SERVER['HTTP_REFERER'], 'admin')) {
            $langs = $this->config->item('languages');
            $language = $this->config->item('language');
            $locale = $langs[$language][0];
        } else {
            $locale = MY_Controller::getCurrentLocale();
        }

        $settings['curLocale'] = $locale;
        return json_encode($settings);
    }

    public function _install() {
        ($this->dx_auth->is_admin()) OR exit;

        $this->db->where('name', 'translator')
                ->update('components', array(
                    'autoload' => '1',
                    'enabled' => '1',
                    'settings' => serialize(array('originsLang' => 'en', 'editorTheme' => 'chrome'))
        ));
    }

    public function _deinstall() {
        ($this->dx_auth->is_admin()) OR exit;

        $this->db->where('name', 'translator')->delete('components');
    }

}

/* End of file sample_module.php */

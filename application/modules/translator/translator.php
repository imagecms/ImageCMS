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
    }

    public function index() {
        $this->core->error_404();
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

        if (!$obj->input->is_ajax_request()) {
            $translator = $obj->db->where('name', 'translator')->get('components');

            if ($translator) {
                $translator = $translator->row_array();

                if ($translator['settings']) {
                    $translatorSettings = unserialize($translator['settings']);

                    if (isset($translatorSettings['showApiForm'])) {
                        define('ENABLE_TRANSLATION_API', TRUE);
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
        $settings['curLocale'] = MY_Controller::getCurrentLocale();
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

<?php

namespace translator\classes;

use MY_Controller;

(defined('BASEPATH')) OR exit('No direct script access allowed');

class YandexTranslate
{

    /**
     * YandexTranslate instance
     * @var YandexTranslate
     */
    private static $instance;

    /**
     * Codeigniter object
     * @var MY_Controller
     */
    private $CI;

    /**
     * Source language
     * @var string
     */
    private $sourceLanguage;

    /**
     * Yandex Api key
     * @var string
     */
    private $yandexApiKey;

    private static $yandexApiUrl = 'https://translate.yandex.net/api/v1.5/tr.json/translate?';

    private function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->helper('translator');
        $this->initSettings();
    }

    /**
     * Get YandexTranslate instance
     * @return YandexTranslate
     */
    public static function getInstatce() {
        if (null === self::$instance) {
            return self::$instance = new self();
        } else {
            return self::$instance;
        }
    }

    private function initSettings() {
        $settings = getSettings();
        $this->sourceLanguage = $settings['originsLang'] ?: 'en';
        $this->yandexApiKey = $settings['YandexApiKey'] ?: '';
    }

    /**
     * @param string $url
     * @return mixed
     */
    private function open_https_url($url, $refer = '') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPTё_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)');
        if ($refer != '') {
            curl_setopt($ch, CURLOPT_REFERER, $refer);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * @param string $translationLanguage
     * @return bool|mixed|string
     */
    public function translate($translationLanguage, $textToTranslate = '', $sourceLanguage = FALSE) {
        $this->sourceLanguage = $sourceLanguage ?: $this->sourceLanguage;
        if ($translationLanguage) {
            $translationText = '&text=' . str_replace(' ', '%20', $textToTranslate);
            $translation = $this->open_https_url(self::$yandexApiUrl . 'key=' . $this->yandexApiKey . $translationText . '&lang=' . $translationLanguage . '-' . $this->sourceLanguage . '&format=plain');
            $translation = (array) json_decode($translation);

            if ($translation['code'] == '200') {
                return array_shift($translation['text']);
            } else {
                return $textToTranslate;
            }
        } else {
            return FALSE;
        }
    }

}
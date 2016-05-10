<?php

/**
 * Class works with site info
 *
 * @author kolia
 */
class SiteInfo
{

    /**
     * If TRUE then setting will be saved and getted for each locale
     * @var boolean
     */
    public $useLocales = TRUE;

    /**
     * For items witch are same for all locales
     * (only if $useLocales is TRUE)
     * @var array
     */
    protected $nonLocaleKeys = [
                                'siteinfo_logo',
                                'siteinfo_favicon',
                               ];

    /**
     * Current locale
     * @var string
     */
    public $locale;

    /**
     *
     * @var array
     */
    public $locales = [];

    /**
     *
     * @var array
     */
    protected $siteinfo;

    /**
     * Path to folder where images will be uploaded
     * ATTENTION! serves as url too!!!
     * @var string
     */
    public $imagesPath = '/uploads/images/';

    /**
     *
     * @var array
     */
    public static $siteInfoObject;

    /**
     * Setting class variables
     * @param string $locale locale to intiate class with
     */
    public function __construct($locale = NULL) {
        if ($this->useLocales === TRUE) {
            $this->locale = $locale !== null ? $locale : MY_Controller::getCurrentLocale();
        }

        if (!self::$siteInfoObject) {
            $locales_ = CI::$APP->cms_base->get_langs();

            foreach ($locales_ as $row) {
                $this->locales[$row['id']] = $row['identif'];
            }

            // getting data from DB
            $result = CI::$APP->db->select('siteinfo')->get('settings')->row_array();
            self::$siteInfoObject = unserialize($result['siteinfo']);
            if (is_array(self::$siteInfoObject)) {
                $this->siteinfo = self::$siteInfoObject;
            }
        } else {
            $this->siteinfo = self::$siteInfoObject;
        }
    }

    /**
     * Sets all params in one array (mostly on saving)
     * @param array $siteInfo
     */
    public function setSiteInfoData(array $siteInfo) {

        $languages = CI::$APP->db->get('languages')->result_array();

        if ($this->useLocales === TRUE) {
            if (!array_key_exists($this->locale, $this->siteinfo)) {
                $this->siteinfo[$this->locale] = [];
            }
            foreach ($siteInfo as $key => $value) {
                if (in_array($key, $this->nonLocaleKeys)) {
                    $this->siteinfo[$key] = $value;
                } else {
                    foreach ($languages as $lang) {
                        if ($lang['identif'] === $this->locale) {
                            $this->siteinfo[$this->locale][$key] = $value;
                        } elseif ($key == 'contacts') {
                            $this->contactsKeys($key, $lang);
                        }
                    }
                }
            }
        } else {
            $this->siteinfo = $siteInfo;
        }
    }

    /**
     * @param string $key
     * @param string $lang
     */
    private function contactsKeys($key, $lang) {
        $siteinfoAll = $this->getSiteInfoData(FALSE);
        $locale = MY_Controller::getCurrentLocale();
        $keysMain = [];

        foreach ($siteinfoAll[$locale][$key] as $name => $contacts) {
            $contacts = $contacts;
            $keysMain[] = $name;
        }

        foreach ($keysMain as $contacts) {
            if (isset($siteinfoAll[$locale][$key][$contacts])) {
                $this->siteinfo[$lang['identif']][$key][$contacts] = $siteinfoAll[$lang['identif']][$key][$contacts];
            } else {
                $this->siteinfo[$lang['identif']][$key][$contacts] = '';
            }
        }

        foreach ($this->siteinfo as $language => $datas) {
            foreach ($datas['contacts'] as $k => $data) {
                $data = $data;
                if (!in_array($k, $keysMain)) {
                    unset($this->siteinfo[$language][$key][$k]);
                }
            }
        }
    }

    /**
     * Saving data in DB
     */
    public function save() {
        $this->normalizeData();
        $siteinfo = $this->getSiteInfoData(FALSE);
        $string = serialize($siteinfo);
        return CI::$APP->db->update('settings', ['siteinfo' => $string]);
    }

    /**
     * Setting one value of site informations
     * @param string $key
     * @param string $value
     * @param boolean $contacts (optional, default false) true if value need to be setted in contacts
     * @return bool
     */
    public function setSiteInfoValue($key, $value, $contacts = FALSE) {
        if (0 !== strpos($key, 'siteinfo_')) {
            $key = 'siteinfo_' . $key;
        }

        if ($this->useLocales != TRUE || in_array($key, $this->nonLocaleKeys)) {
            if ($contacts == TRUE) {
                $this->siteinfo['contacts'][$key] = $value;
                return TRUE;
            } else {
                if (array_key_exists($key, $this->siteinfo)) {
                    $this->siteinfo[$key] = $value;
                    return TRUE;
                }
            }
        } else {
            if ($contacts == TRUE) {
                $this->siteinfo[$this->locale]['contacts'][$key] = $value;
                return TRUE;
            } else {
                if (array_key_exists($key, $this->siteinfo[$this->locale])) {
                    $this->siteinfo[$this->locale][$key] = $value;
                    return TRUE;
                }
            }
        }
        return false;
    }

    /**
     * @param string $key
     * @param bool|FALSE $contacts
     */
    public function deleteSiteInfoValue($key, $contacts = FALSE) {
        if (0 !== strpos($key, 'siteinfo_')) {
            $key = 'siteinfo_' . $key;
        }
        if ($this->useLocales != TRUE || in_array($key, $this->nonLocaleKeys)) {
            if ($contacts == TRUE) {
                unset($this->siteinfo['contacts'][$key]);
            } else {
                unset($this->siteinfo[$key]);
            }
        } else {
            if ($contacts == TRUE) {
                unset($this->siteinfo[$this->locale]['contacts'][$key]);
            } else {
                unset($this->siteinfo[$this->locale][$key]);
            }
        }
    }

    /**
     * Returns all params in one array (for serialize)
     * @param boolean $byLocale if true then will be returned data by locale, else all dataS
     * @return array
     */
    public function getSiteInfoData($byLocale = FALSE) {
        if ($this->useLocales == TRUE & $byLocale !== FALSE) {
            if (is_string($byLocale) & in_array($byLocale, $this->locales)) {
                $locale = $byLocale;
            } else {
                $locale = $this->locale;
            }
            if (array_key_exists($locale, $this->siteinfo)) {
                $returnArray = $this->siteinfo[$locale];

                $defaultContacts = $this->siteinfo[MY_Controller::defaultLocale()]['contacts'];
                foreach ($defaultContacts as $contactKey => $contactValue) {
                    if (!$returnArray['contacts'][$contactKey]) {
                        $returnArray['contacts'][$contactKey] = '';
                    }
                }

                foreach ($this->siteinfo as $key => $value) {
                    if (in_array($key, $this->nonLocaleKeys)) {
                        $returnArray[$key] = $value;
                    }
                }
                return $returnArray;
            }
        }

        return $this->siteinfo;
    }

    /**
     * Returns siteinfo item by param
     * @param string $name name of param
     * @return string
     */
    public function getSiteInfo($name = NULL) {
        // simple checks just in case
        if (!is_string($name)) {
            return '';
        }
        if (!(strlen($name) > 0)) {
            return '';
        }
        if (!is_array($this->siteinfo)) {
            return '';
        }

        if ($this->useLocales == TRUE) {
            // if it is non locale field
            if (array_key_exists($name, $this->siteinfo)) {
                return $this->siteinfo[$name];
            } elseif (isset($this->siteinfo['contacts'])) {
                $nameTemp = str_replace('siteinfo_', '', $name);
                if (array_key_exists($nameTemp, $this->siteinfo['contacts'])) {
                    return $this->siteinfo['contacts'][$nameTemp];
                }
            }
            if (array_key_exists($this->locale, $this->siteinfo)) {
                $siteinfo = $this->siteinfo[$this->locale];
            } else {
                return '';
            }
        } else {
            $siteinfo = $this->siteinfo;
        }

        // if key exists value will be returned
        if (array_key_exists($name, $siteinfo)) {
            return $siteinfo[$name];
        }

        $name = str_replace('siteinfo_', '', $name);
        if (array_key_exists($name, $siteinfo['contacts'])) {
            return $siteinfo['contacts'][$name];
        }

        return '';
    }

    /**
     * Changing array structure relatively to that locales are use or not
     */
    public function normalizeData() {
        if ($this->useLocales == TRUE) {
            // deleting non locale fields from data array (except those what are present $this->nonLocaleKeys)
            foreach ($this->siteinfo as $key => $value) {
                if (!in_array($key, $this->locales) & !in_array($key, $this->nonLocaleKeys)) {
                    unset($this->siteinfo[$key]);
                }
            }
            // deleting non-locale fields from each locale data
            foreach ($this->siteinfo as $locale => $localeData) {
                foreach ($localeData as $key => $value) {
                    if (in_array($key, $this->nonLocaleKeys)) {
                        unset($this->siteinfo[$locale][$key]);
                    }
                }
            }
        } else {
            // deleting locales data
            foreach ($this->siteinfo as $key => $value) {
                if (in_array($key, $this->locales)) {
                    unset($this->siteinfo[$key]);
                }
            }
        }
    }

}
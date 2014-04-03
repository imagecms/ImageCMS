<?php

/**
 * 
 *
 * @author kolia
 */
class SiteInfo {

    /**
     * CI instance
     * @var type 
     */
    public $ci;

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
    protected $nonLocaleKeys = array('siteinfo_logo', 'siteinfo_favicon');

    /**
     * Current locale
     * @var string
     */
    public $locale;

    /**
     * Name of current template name
     * @var string
     */
    protected $templateName;

    /**
     *
     * @var array
     */
    public $locales = array();

    /**
     *
     * @var array
     */
    protected $siteinfo;

    public function __construct($locale = NULL) {
        $this->ci = &get_instance();
        $settings = $this->ci->cms_base->get_settings();
        $this->templateName = $settings['site_template'];
        if ($this->useLocales == TRUE) {
            $this->locale = !is_null($locale) ? $locale : MY_Controller::getCurrentLocale();
            //$this->locale = 'ua';
        }

        $locales_ = $this->ci->db->select('identif,id')->get('languages')->result_array();
        foreach ($locales_ as $row) {
            $this->locales[$row['id']] = $row['identif'];
        }

        // getting data from DB
        $result = $this->ci->db->select('siteinfo')->get('settings');
        if ($result) {
            $result1 = $result->row_array();
            $siteinfo = @unserialize($result1['siteinfo']);
            if (is_array($siteinfo)) {
                $this->siteinfo = $siteinfo;
            }
        }
    }

    /**
     * Sets all params in one array (mostly on saving)
     * @param array $siteinfo
     */
    public function setSiteInfoData(array $siteinfo) {
        if ($this->useLocales == TRUE) {
            if (!key_exists($this->locale, $this->siteinfo)) {
                $this->siteinfo[$this->locale] = array();
            }
            foreach ($siteinfo as $key => $value) {
                if (in_array($key, $this->nonLocaleKeys)) {
                    $this->siteinfo[$key] = $value;
                } else {
                    $this->siteinfo[$this->locale][$key] = $value;
                }
            }
        } else {
            $this->siteinfo = $siteinfo;
        }
    }

    /**
     * Returns all params in one array (for serialize)
     * @param boolean $byLocale
     * @return type
     */
    public function getSiteInfoData($byLocale = FALSE) {
        if ($this->useLocales == TRUE & $byLocale !== FALSE) {
            if (is_string($byLocale) & in_array($byLocale, $this->locales)) {
                $locale = $byLocale;
            } else {
                $locale = $this->locale;
            }
            if (key_exists($locale, $this->siteinfo)) {
                $returnArray = $this->siteinfo[$locale];
                foreach ($this->siteinfo as $key => $value) {
                    if (in_array($key, $this->nonLocaleKeys)) {
                        $returnArray[$key] = $value;
                    }
                }
                return $returnArray;
            }
            //return FALSE;
        }
        return $this->siteinfo;
    }

    /**
     * Returns siteinfo item by param
     * @param string $name name of param
     * @return string
     */
    public function getSiteInfo($name = NULL) {
        // simple check just in case
        if (!is_string($name)) {
            return '';
        }

        if (!(strlen($name) > 0)) {
            return '';
        }

        // another simple check
        if (!is_array($this->siteinfo)) {
            return '';
        }

        if ($this->useLocales == TRUE) {
            // if it is non locale field
            //if (key_exists($name, $this->siteinfo) & in_array($name, $this->nonLocaleKeys)) {
            if (key_exists($name, $this->siteinfo)) {
                return $this->siteinfo[$name];
            } elseif (isset($this->siteinfo['contacts'])) {
                $nameTemp = str_replace('siteinfo_', '', $name);
                if (key_exists($nameTemp, $this->siteinfo['contacts'])) {
                    return $this->siteinfo['contacts'][$nameTemp];
                }
            }
            if (key_exists($this->locale, $this->siteinfo)) {
                $siteinfo = $this->siteinfo[$this->locale];
            } else {
                return '';
            }
        } else {
            $siteinfo = $this->siteinfo;
        }

        // if key exists value will be returned
        if (key_exists($name, $siteinfo)) {
            return $siteinfo[$name];
        }

        $name = str_replace('siteinfo_', '', $name);
        if (key_exists($name, $siteinfo['contacts'])) {
            return $siteinfo['contacts'][$name];
        }

        return '';
    }

    /**
     * Returns path to images folder
     * Depends from active template, and its 
     * type - for example newLevel template has different 
     * structure than commerce4x.
     * @return string|boolean Description
     */
    public function getFaviconLogoPath() {
        // looking for any color scheme (by folder existing)
        return PUBPATH . 'uploads/images';
    }

    /**
     * Returning full url with image
     * @param string siteinfo_logo|siteinfo_favicon $logoOrFavicon
     * @return string
     */
    public function getFaviconLogoUrl($logoOrFavicon) {
        $path = $this->getFaviconLogoPath($this->templateName);


        $fileData = $this->getSiteInfo($logoOrFavicon);

        if (!key_exists($this->templateName, $fileData) || empty($fileData)) {
            return '';
        }

        $path = str_replace(PUBPATH, '', $path);
        $path .= $fileData[$this->templateName];
        $path = trim($path, DIRECTORY_SEPARATOR);
        return '/' . str_replace(DIRECTORY_SEPARATOR, '/', $path);
    }

    /**
     * Returns current active template
     * @return string
     */
    public function getActiveTemplateName() {
        return $this->templateName;
    }

    /**
     * Changing array structure relatively to that locales are use or not
     */
    public function normalizeData() {
        if ($this->useLocales == TRUE) {
            // deleting non locale fields from data array (exept those is $this->nonLocaleKeys)
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

?>

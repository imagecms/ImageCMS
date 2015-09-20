<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Seoexpert_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @param string $LastModified_unix
     */
    public function setLastModified($LastModified_unix) {
        $LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
        $IfModifiedSince = false;

        if ($this->input->server('HTTP_IF_MODIFIED_SINCE')) {
            $IfModifiedSince = strtotime(substr($this->input->server('HTTP_IF_MODIFIED_SINCE'), 5));
        }
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
            header($this->input->server('SERVER_PROTOCOL') . ' 304 Not Modified');
            exit;
        }
        header('Last-Modified: ' . $LastModified);
    }

    /**
     * Get module settings
     * @return array
     */
    public function getSettings($locale = 'ru') {
        //        $this->db->cache_on();
        $settings = $this->db->select('settings')
            ->where('locale', $locale)
            ->get('mod_seo')
            ->row_array();
        //        $this->db->cache_off();
        $settings = unserialize($settings['settings']);
        if ($settings) {
            return $settings;
        }
        return FALSE;
    }

    /**
     * Save settings
     * @param array $settings
     * @return boolean
     */
    public function setSettings($settings, $locale = 'ru') {
        $data = $this->db->select('locale')
            ->where('locale', $locale)
            ->get('mod_seo')
            ->row_array();
        if (empty($data)) {
            return $this->db->insert('mod_seo', ['locale' => $locale, 'settings' => serialize($settings)]);
        }

        return $this->db->where('locale', $locale)
            ->update(
                'mod_seo',
                ['settings' => serialize($settings)
                                ]
            );
    }

    /**
     * Get categories by ID, NAME
     * @param string $term id,name
     * @param integer $limit limit for results
     * @return boolean|array
     */
    public function getCategoriesByIdName($term, $limit = 7) {
        $locale = MY_Controller::defaultLocale();

        $sql = "SELECT * 
                FROM  `shop_category_i18n` 
                WHERE  (`locale` =  '" . $locale . "'
                AND  `name` LIKE  '%" . $term . "%')
                OR (`id` LIKE '%" . $term . "%' AND `locale` =  '" . $locale . "')
                LIMIT 0 , " . $limit;
        $query = $this->db->query($sql);

        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Get top Brands in category
     * @param int $categoryId
     * @param string $locale
     * @return boolean|array
     */
    public function getTopBrandsInCategory($categoryId = FALSE, $limit = 3, $locale = FALSE) {
        if (!$categoryId) {
            return FALSE;
        }
        if (!$locale) {
            $locale = \MY_Controller::getCurrentLocale();
        }

        if (!$limit) {
            $limit = 3;
        }

        $productsIds = ShopProductCategoriesQuery::create()
                ->select('ProductId')
                ->distinct()
                ->filterByCategoryId($categoryId)
                ->find()
                ->toArray();

        $res = $this->db
            ->select('shop_products.brand_id, shop_brands_i18n.name , COUNT(shop_products.brand_id) AS  count')
            ->join('shop_brands_i18n', 'shop_brands_i18n.id = shop_products.brand_id')
            ->where('shop_brands_i18n.locale', $locale)
            ->where_in('shop_products.id', $productsIds)
            ->group_by('brand_id')
            ->order_by('count', 'DESC')
            ->get('shop_products', $limit);

        if ($res) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    /**
     * Get language id
     * @param string $locale
     * @return boolean|int
     */
    public function getLangIdByLocale($locale = FALSE) {
        if (!$locale) {
            $locale = \MY_Controller::getCurrentLocale();
        }

        $res = $this->db->select('id')->where('identif', $locale)->get('languages')->row_array();
        if ($res) {
            return $res['id'];
        }

        return FALSE;
    }

    /**
     * Get base settings
     * @param int $langId
     * @return boolean|array
     */
    public function getBaseSettings($langId = FALSE) {
        if (!$langId || is_numeric($langId) == FALSE) {
            return FALSE;
        }
        $settings = $this->db->select('add_site_name, add_site_name_to_cat, delimiter, create_keywords, create_description')->where('s_name', 'main')->get('settings')->row_array();
        $settingsIn = $this->db->where('lang_ident', $langId)->get('settings_i18n')->row_array();

        $res = array_merge($settings, $settingsIn);

        if ($res) {
            return $res;
        }
        return FALSE;
    }

    /**
     * Set Base settings
     * @param int $langId
     * @param array $settings
     * @return boolean
     */
    public function setBaseSettings($langId = FALSE, $settings) {
        if (!$langId) {
            return FALSE;
        }
        // Update shop settings table
        $mainSettings = [
            'add_site_name' => $settings['add_site_name'],
            'add_site_name_to_cat' => $settings['add_site_name_to_cat'],
            'delimiter' => $settings['delimiter'],
            'create_keywords' => $settings['create_keywords'],
            'create_description' => $settings['create_description']
        ];
        $this->db->where('s_name', 'main')->update('settings', $mainSettings);

        //Check exists settings with current langId
        $checkLangSettings = $this->db->where('lang_ident', $langId)->get('settings_i18n')->row_array();

        $mainSettingsIn = [
            'name' => $settings['name'],
            'short_name' => $settings['short_name'],
            'description' => $settings['description'],
            'keywords' => $settings['keywords']
        ];

        // Update or insert shop setiings I18n table
        if ($checkLangSettings) {
            return $this->db->where('lang_ident', $langId)->update('settings_i18n', $mainSettingsIn);
        } else {
            $mainSettingsIn['lang_ident'] = $langId;
            return $this->db->insert('settings_i18n', $mainSettingsIn);
        }

        return FALSE;
    }

    /**
     * Install
     * @return boolean
     */
    public function install() {

        $sql = "CREATE TABLE IF NOT EXISTS `mod_seo` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `locale` varchar(5) DEFAULT NULL,
                    `settings` text DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->db->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `mod_seo_products` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `cat_id` int(11) NOT NULL,
                    `locale` varchar(5) DEFAULT NULL,
                    `settings` text DEFAULT NULL,
                    `active` tinyint(4) DEFAULT NULL,
                    `empty_meta` int(11) DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->db->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `mod_seo_inflect` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `original` varchar(250) NOT NULL,
                `inflection_id` int(11) NOT NULL,
                `inflected` varchar(250) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
        $this->db->query($sql);

        $this->db->where('name', 'mod_seo')->update('components', ['autoload' => 1, 'in_menu' => 1]);
        return TRUE;
    }

    /**
     * Deinstall
     * @return boolean|null
     */
    public function deinstall() {

        $this->load->dbforge();
        $this->dbforge->drop_table('mod_seo');
        $this->dbforge->drop_table('mod_seo_products');
        $this->dbforge->drop_table('mod_seo_inflect');
    }

}
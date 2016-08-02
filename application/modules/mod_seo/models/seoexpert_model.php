<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Seoexpert_model extends CI_Model
{

    /**
     * Seoexpert_model constructor.
     */
    public function __construct() {

        parent::__construct();
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

    /**
     * Get base settings
     * @param bool|int $langId
     * @return array|bool
     */
    public function getBaseSettings($langId = false) {

        if (!$langId || is_numeric($langId) === false) {
            return false;
        }
        $settings = $this->db->select('add_site_name, add_site_name_to_cat, delimiter, create_keywords, create_description')->where('s_name', 'main')->get('settings')->row_array();
        $settingsIn = $this->db->where('lang_ident', $langId)->get('settings_i18n')->row_array();

        $res = array_merge($settings, $settingsIn);

        if ($res) {
            return $res;
        }
        return false;
    }

    /**
     * Get categories by ID, NAME
     * @param string  $term  id,name
     * @param integer $limit limit for results
     * @return boolean|array
     */
    public function getCategoriesByIdName($term, $limit = 7) {

        $locale = MY_Controller::defaultLocale();

        $sql = "SELECT *
                FROM  `shop_category_i18n`
                WHERE  (`locale` =  '$locale'
                AND  `name` LIKE  '%$term%')
                OR (`id` LIKE '%$term%' AND `locale` =  '$locale')
                LIMIT 0 , $limit";
        $query = $this->db->query($sql);

        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

     /**
     * Get language id
     * @param bool|string $locale
     * @return bool|int
     */
    public function getLangIdByLocale($locale = false) {

        if (!$locale) {
            $locale = \MY_Controller::getCurrentLocale();
        }

        $res = $this->db->select('id')->where('identif', $locale)->get('languages')->row_array();
        if ($res) {
            return $res['id'];
        }

        return false;
    }

    /**
     * Get module settings
     * @param string $locale
     * @return array
     */
    public function getSettings($locale = 'ru') {

        $settings = $this->db->select('settings')
            ->where('locale', $locale)
            ->get('mod_seo')
            ->row_array();

        $settings = unserialize($settings['settings']);
        return $settings ?: false;
    }

    /**
     * Install
     * @return boolean
     */
    public function install() {

        $sql = 'CREATE TABLE IF NOT EXISTS `mod_seo` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `locale` varchar(5) DEFAULT NULL,
                    `settings` text DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';

        $this->db->query($sql);

        $sql = 'CREATE TABLE IF NOT EXISTS `mod_seo_products` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `cat_id` int(11) NOT NULL,
                    `locale` varchar(5) DEFAULT NULL,
                    `settings` text DEFAULT NULL,
                    `active` tinyint(4) DEFAULT NULL,
                    `empty_meta` int(11) DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';

        $this->db->query($sql);

        $sql = 'CREATE TABLE IF NOT EXISTS `mod_seo_inflect` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `original` varchar(250) NOT NULL,
                `inflection_id` int(11) NOT NULL,
                `inflected` varchar(250) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
        $this->db->query($sql);

        $this->db->where('name', 'mod_seo')->update('components', ['autoload' => 1, 'in_menu' => 1]);
        return true;
    }

    /**
     * Set Base settings
     * @param bool|int $langId
     * @param array    $settings
     * @return bool
     */
    public function setBaseSettings($langId = false, $settings) {

        if (!$langId) {
            return false;
        }
        // Update shop settings table
        $mainSettings = [
                         'add_site_name'        => $settings['add_site_name'],
                         'add_site_name_to_cat' => $settings['add_site_name_to_cat'],
                         'delimiter'            => $settings['delimiter'],
                         'create_keywords'      => $settings['create_keywords'],
                         'create_description'   => $settings['create_description'],
                        ];
        $this->db->where('s_name', 'main')->update('settings', $mainSettings);

        //Check exists settings with current langId
        $checkLangSettings = $this->db->where('lang_ident', $langId)->get('settings_i18n')->row_array();

        $mainSettingsIn = [
                           'name'        => $settings['name'],
                           'short_name'  => $settings['short_name'],
                           'description' => $settings['description'],
                           'keywords'    => $settings['keywords'],
                          ];

        // Update or insert shop settings I18n table
        if ($checkLangSettings) {
            return $this->db->where('lang_ident', $langId)->update('settings_i18n', $mainSettingsIn);
        } else {
            $mainSettingsIn['lang_ident'] = $langId;
            return $this->db->insert('settings_i18n', $mainSettingsIn);
        }
    }

    /**
     * Save settings
     * @param array $settings
     * @param string $locale
     * @return bool
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
                [
                 'settings' => serialize($settings),
                ]
            );
    }

    /**
     * @param array $setting
     * @param string $type
     * @return array
     */
    public function Actions_settings($setting, $type) {

        $type = strtolower($type);

        if ($setting) {

            if ($type == 'all') {

                $data = [
                         'usePattern'       => $setting['useBestsellerPattern'],
                         'TitleTemplate'    => $setting['BestsellerTemplate'],
                         'TemplateDesc'     => $setting['BestsellerTemplateDesc'],
                         'KeywordsTemplate' => $setting['BestsellerTemplateKey'],
                        ];
            } else {

                $type = ucfirst($type);

                $data = [
                         'usePattern'       => $setting['useBestseller' . $type . 'Pattern'] ?: '',
                         'TitleTemplate'    => $setting['Bestseller' . $type . 'Template'] ?: '',
                         'TemplateDesc'     => $setting['Bestseller' . $type . 'TemplateDesc'] ?: '',
                         'KeywordsTemplate' => $setting['Bestseller' . $type . 'TemplateKey'] ?: '',
                        ];
            }

            return $data;

        }
    }

}
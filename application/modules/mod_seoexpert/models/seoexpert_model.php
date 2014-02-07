<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Seoexpert_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get module settings
     * @return array
     */
    public function getSettings($locale = 'ru') {
//        $this->db->cache_on();
        $settings = $this->db->select('settings')
                ->where('locale', $locale)
                ->get('mod_seoexpert')
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
                ->get('mod_seoexpert')
                ->row_array();
        if (empty($data))
            return $this->db->insert('mod_seoexpert', array('locale' => $locale, 'settings' => serialize($settings)));


        return $this->db->where('locale', $locale)
                        ->update('mod_seoexpert', array('settings' => serialize($settings)
        ));
    }

    /**
     * Get categories by ID, NAME
     * @param string $term id,name
     * @param type $limit limit for results
     * @return boolean|array
     */
    public function getCategoriesByIdName($term, $limit = 7) {
        $locale = MY_Controller::getCurrentLocale();

        $sql = "SELECT * 
                FROM  `shop_category_i18n` 
                WHERE  `locale` =  '".$locale."'
                AND  `name` LIKE  '%".$term."%'
                OR `id` LIKE '%".$term."%'
                LIMIT 0 , ".$limit;
        $query = $this->db->query($sql);


        if ($query)
            return $query->result_array();
        else
            return false;
    }

    /**
     * Install
     * @return boolean
     */
    public function install() {
        $sql = "CREATE TABLE IF NOT EXISTS `mod_seoexpert` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `locale` varchar(5) DEFAULT NULL,
                    `settings` text DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->db->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `mod_seoexpert_products` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `cat_id` int(11) NOT NULL,
                    `locale` varchar(5) DEFAULT NULL,
                    `settings` text DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->db->query($sql);

        $this->db->where('name', 'mod_seoexpert')->update('components', array('autoload' => 1, 'in_menu' => 1));
        return TRUE;
    }

    /**
     * Deinstall
     * @return boolean
     */
    public function deinstall() {
        $sql = "DROP TABLE `mod_seoexpert`;DROP TABLE `mod_seoexpert_products`;";
        $this->db->query($sql);
        return TRUE;
    }

}

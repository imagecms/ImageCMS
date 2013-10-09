<?php

/**
 * @property CI_DB_active_record $db
 * @property Documentation_model $documentation_model
 */
class Documentation_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Chech has other page url
     * @param string $url
     * @return boolean
     */
    public function checkUrl($url = '') {
        if ($url != '') {
            /** Select page by url * */
            $res = $this->db->where('url', $url)->get('content')->row_array();
            if ($res != null) {
                /** If has other page url * */
                return true;
            } else {
                /** If not has other page url * */
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Insert data to database
     * @param array $data
     * @return boolean
     */
    public function createNewPage($data = false) {
        if ($data != false) {
            if ($this->db->insert('content', $data)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Get page by Id
     * @param type $id
     * @return boolean
     */
    public function getPageById($id = null, $langId = null) {
        /** Check is it main page * */
        $page = $this->db->where('id', $id)->get('content')->row_array();
        if ($page['lang_alias'] != '0') {
            $id = $page['lang_alias'];
        }

        /** Get page data * */
        $query = "  
                    SELECT 
                        `content`.*,
                        `category`.`name` as `category_name`
                    FROM 
                        `content` 
                    LEFT JOIN `category` ON `content`.`category` = `category`.`id`
                    WHERE (`content`.`id` = '" . $id . "'
                    OR `content`.`lang_alias` ='" . $id . "')";
        if ($langId != null) {
            $query .="AND `content`.`lang` = '" . $langId . "'";
        }
        $res = $this->db->query($query)->row_array();
        if (!$res) {
            return false;
        } else {
            return $res;
        }
    }

    /**
     * Get languages
     * @return boolean|array
     */
    public function getLangs() {
        $res = $this->db->get('languages')->result_array();
        if (!$res) {
            return false;
        } else {
            return $res;
        }
    }

    public function updatePage($id = false, $langId = false, $data = false) {

        if ($id != false && $data != false) {
            /** Get page id * */
            $query = "SELECT id 
                    FROM `content`
                    WHERE (`content`.`id` = '" . $id . "'
                    OR `content`.`lang_alias` ='" . $id . "')
                    AND `content`.`lang` = '" . $langId . "'
                ";
            $res = $this->db->query($query)->row_array();

            /** Update page * */
            $this->db->where('id', $res['id'])->update('content', $data);

            /** Update page category id and url on other languages * */
            $this->db->where('lang_alias', $id)
                    ->update('content', array(
                        'url' => $data['url'],
                        'category' => $data['category']
                            )
            );

            if ($this->db->last_query()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Get page id by main page id and lang id
     * @param int $mainPageId
     * @param int $langId
     * @return boolean|int
     */
    public function getPageIdByMainPageIdAndLangId($mainPageId = false, $langId = false) {
        if ($mainPageId != false && $langId != false) {
            /** Get page id * */
            $query = "SELECT id 
                    FROM `content`
                    WHERE (`content`.`id` = '" . $mainPageId . "'
                    OR `content`.`lang_alias` ='" . $mainPageId . "')
                    AND `content`.`lang` = '" . $langId . "'
                ";
            $res = $this->db->query($query)->row_array();
        }
        if ($res != null) {
            return $res['id'];
        }
        return false;
    }

    /**
     * Save page to history table after editing
     * @param int $id
     * @return boolean
     */
    public function make_backup($id = null) {
        if ($id == null) {
            $id = $this->input->post('id');
        }
        $old_data = $this->db
                ->where('id', $id)
                ->get('content')
                ->row_array();

        $old_data['page_id'] = $old_data['id'];
        unset($old_data['id']);
        $old_data['user_id'] = $this->dx_auth->get_user_id();
        if ($this->db->insert('mod_documentation_history', $old_data)) {
            return true;
        }
        return false;
    }

    /**
     * Get count of `content` table by conditions
     * @param array $params
     * @return int
     */
    public function getContentsCount($params) {
        if (is_array($params))
            $this->db->where($params);

        $this->db->from('content');
        return (int) $this->db->count_all_results();
    }

    /**
     * Get data from `content` table by conditions
     * @param array $params params for AR where
     * @return array
     */
    public function getContents($params = NULL) {
        if (is_array($params)) {
            $this->db->where($params);
        }
        $data = array();
        $result = $this->db->get('content');
        foreach ($result->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Returns specified page data
     * @param int $pageId
     * @return array
     */
    public function getPageData($pageId) {
        $this->db->where('id', $pageId);
        $result = $this->db->get('content');
        $data = $result->result_array();
        return $data[0];
    }

    /**
     * Module install
     */
    public function install() {
        ($this->dx_auth->is_admin()) OR exit;

        /** Query for creating module table * */
        $query = "
            CREATE TABLE IF NOT EXISTS `mod_documentation_history` (
                  `id` bigint(11) NOT NULL AUTO_INCREMENT,
                  `page_id` bigint(11) NOT NULL,
                  `title` varchar(500) NOT NULL,
                  `meta_title` varchar(300) DEFAULT NULL,
                  `url` varchar(500) NOT NULL,
                  `cat_url` varchar(260) DEFAULT NULL,
                  `keywords` text,
                  `description` text,
                  `prev_text` text,
                  `full_text` longtext NOT NULL,
                  `category` int(11) NOT NULL,
                  `full_tpl` varchar(50) DEFAULT NULL,
                  `main_tpl` varchar(50) NOT NULL,
                  `position` smallint(5) NOT NULL,
                  `comments_status` smallint(1) NOT NULL,
                  `comments_count` int(9) DEFAULT '0',
                  `post_status` varchar(15) NOT NULL,
                  `author` varchar(50) NOT NULL,
                  `publish_date` int(11) NOT NULL,
                  `created` int(11) NOT NULL,
                  `updated` int(11) NOT NULL,
                  `showed` int(11) NOT NULL,
                  `lang` int(11) NOT NULL DEFAULT '0',
                  `lang_alias` int(11) NOT NULL DEFAULT '0',
                  `user_id` int(11) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`),
                  KEY `url` (`url`(333)),
                  KEY `lang` (`lang`),
                  KEY `post_status` (`post_status`(4)),
                  KEY `cat_url` (`cat_url`),
                  KEY `publish_date` (`publish_date`),
                  KEY `category` (`category`),
                  KEY `created` (`created`),
                  KEY `updated` (`updated`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
                ";
        $this->db->query($query);

        /** Update module settings * */
        $this->db->where('name', 'documentation')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));
    }

    /** Module deinstall * */
    public function deinstall() {
        ($this->dx_auth->is_admin()) OR exit;
        $this->load->dbforge();
        $this->dbforge->drop_table('mod_documentation_history');
    }

    /**
     * Returns page history
     * @param int $pageId
     */
    public function getPageHistory($pageId, $perPage = 5, $offset = 0) {
        $result = $this->db
                ->select('mod_documentation_history.*,users.username')
                ->where('page_id', $pageId)
                ->order_by('id', 'DESC')
                ->join('users', 'users.id = mod_documentation_history.user_id')
                ->limit($perPage, $offset)
                ->get('mod_documentation_history');
        return $result->result_array();
    }

    public function getPageHistoryCount($params) {
        if (is_array($params))
            $this->db->where($params);

        $this->db->from('mod_documentation_history');
        return (int) $this->db->count_all_results();
    }

    /**
     * Restosing article from history
     * @param int $pageId
     * @param int $historyId
     */
    public function restoreArticleFromHistory($pageId, $historyId) {
//        $this->make_backup($pageId);
        $someOldData = $this->db
                ->where('id', $historyId)
                ->get('mod_documentation_history')
                ->row_array();

        //print_r($someOldData);
        $delColumns = array(
            'page_id', 'id', 'user_id'
        );
        foreach ($delColumns as $col) {
            if (key_exists($col, $someOldData))
                unset($someOldData[$col]);
        }
        var_dump($this->db->where('id', $pageId)->update('content', $someOldData));
        echo $this->db->_error_message();
    }

    public function deleteHistoryRow($historyId) {
        $this->db->delete('mod_documentation_history', array('id' => $historyId));
    }

    /**
     * Get module settings
     * @return array
     */
    public function getSettings() {
        $settings = $this->db->select('settings')
                ->where('identif', 'documentation')
                ->get('components')
                ->row_array();
        $settings = unserialize($settings['settings']);

        if (is_array($settings)) {
            return $settings;
        }

        return array();
    }

    /**
     * Save settings
     * @param array $settings
     * @return boolean
     */
    public function setSettings($settings) {
        return $this->db->where('identif', 'documentation')
                        ->update('components', array('settings' => serialize($settings)
        ));
    }

    public function getRoles() {
        $locale = \MY_Controller::getCurrentLocale();
        $result = $this->db
                ->join('shop_rbac_roles_i18n', 'shop_rbac_roles_i18n.id = shop_rbac_roles.id')
                ->where('shop_rbac_roles_i18n.locale', $locale)
                ->get('shop_rbac_roles');
        return $result->result_array();
    }

}

?>

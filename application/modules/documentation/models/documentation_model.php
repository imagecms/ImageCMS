<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
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
            $this->db->insert('content', $data);
            if ($this->db->last_query()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function updatePage($id = false, $data = false) {
        if ($id != false && $data != false) {
            $this->db->where('id', $id)->update('content', $data);
            if ($this->db->last_query()) {
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
    public function getPageById($id = null) {
        $res = $this->db->where('id', $id)->get('content')->row_array();
        if (!$res) {
            return false;
        } else {
            return $res;
        }
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

}

?>

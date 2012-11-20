<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class email_model extends CI_Model {

    private $db_name;

    function __construct() {
        parent::__construct();
        $this->db_name = "emails";
    }

    public function fromArray($data = array()) {
        if (count($data) > 0) {
            if (isset($data['name']) && ($data['name'] != '')) {
                if (count($this->db->query("SELECT * FROM `" . $this->db_name . "` WHERE `name`='" . $data['name'] . "' AND `locale`='" . $data['locale'] . "' ")->row_array()) > 0) {
                    $this->db->query("UPDATE `" . $this->db_name . "` SET `template`='" . $data['text'] . "',`settings`='" . serialize($data['settings']) . "', `description`='" . $data['description'] . "' WHERE `name`='" . $data['name'] . "' AND `locale`='" . $data['locale'] . "'");
                } else {
                    $this->db->query("INSERT INTO `" . $this->db_name . "` (`name`, `template`, `settings`, `locale`, `description`) VALUES ('" . $data['name'] . "', '" . $data['text'] . "', '" . serialize($data['settings']) . "', '" . $data['locale'] . "', '" . $data['description'] . "')");
                }
            }
        }
    }

    public function getMailArray($name, $locale) {
        return $this->db->query("SELECT * FROM `" . $this->db_name . "` WHERE `locale`='" . $locale . "' AND `name`='" . $name . "' LIMIT 1")->row_array();
    }

    public function getList($locale) {
        if ($locale != '' && $locale != null)
            return $this->db->query("SELECT * FROM `" . $this->db_name . "` WHERE `locale`='" . $locale . "'")->result_array();
        else
            return false;
    }

    public function delete($names = array()) {
        if (count($names) > 0) {
            $arr = "(";
            foreach ($names as $key => $name) {
                $arr .= "'" . $name . "'";
                if (count($names) - 1 > $key)
                    $arr .= " , ";
                else
                    $arr .= ")";
            }
            $query = "DELETE FROM `" . $this->db_name . "` WHERE `name` IN " . $arr;
            $this->db->query($query);
        }else {
            return false;
        }
    }

}
?>

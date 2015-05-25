<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH . "third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {

    public function database($params = '', $return = FALSE, $active_record = NULL) {

        if (class_exists('CI_DB', FALSE) AND $return == FALSE AND $active_record == NULL AND isset(CI::$APP->db) AND is_object(CI::$APP->db))
            return;

        require_once APPPATH . '/core/database/DB' . EXT; // this is the only line that was changed - this file is overloaded

        if ($return === TRUE)
            return DB($params, $active_record);

        CI::$APP->db = DB($params, $active_record);

        return CI::$APP->db;
    }

}

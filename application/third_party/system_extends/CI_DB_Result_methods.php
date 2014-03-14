<?php

namespace third_party\system_extends;

trait CI_DB_Result_methods {

    /**
     * 
     */
    function result_column() {
        $result = $this->result_array();
        if (count($result) == 0) {
            return array();
        }

        $key = key($result[0]);

        for ($i = 0; $i < count($result); $i++) {
            $result[$i] = $result[$i][$key];
        }

        return $result;
    }

}
<?php

namespace template_manager\installer;

/**
 * 
 *
 * @author 
 */
class ModuleDependence extends DependenceBase {

    public function verify() {
        $this->getModules();
        switch ($relation) {
            case "required":
                return $this->required();
            case "wishful":
                return $this->wishful();
        }
        return FALSE;
    }

    private function getModules() {
        $components = \CI::$APP->db
                ->select('identif')
                ->get('components')
                ->result_array();

        $this->components = array();
        foreach ($components as $row) {
            $this->components[] = $row['name'];
        }
    }

    private function required() {
        if (!in_array($this->name, $this->components)) {
            return FALSE;
        }
        return TRUE;
    }

    private function wishful() {
        if (!in_array($this->name, $this->components)) {
            $this->messages[] = '';
        }
        return TRUE;
    }

}

?>

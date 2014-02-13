<?php

/**
 * 
 *
 * @author 
 */
class ModuleDependence extends \template_manager\installer\DependenceBase {

    public function verify() {
        $this->getModules();
        switch ($this->relation) {
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
            $this->components[] = $row['identif'];
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

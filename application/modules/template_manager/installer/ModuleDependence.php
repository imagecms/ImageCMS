<?php

/**
 * Image CMS
 * Module Template_manager
 * class ModuleDependence
 */
class ModuleDependence extends \template_manager\installer\DependenceBase {

    /**
     * Verify module dependence relations
     * @return boolean
     */
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

    /**
     * Prepare installed modules array
     */
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

    /**
     * Check if module dependence is required
     * @return boolean
     */
    private function required() {
        if (!in_array($this->name, $this->components)) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Check if module dependence is wishful
     * @return boolean
     */
    private function wishful() {
        if (!in_array($this->name, $this->components)) {
            $this->messages[] = '';
        }
        return TRUE;
    }

}

?>

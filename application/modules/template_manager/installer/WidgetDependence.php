<?php

/**
 * Image CMS
 * Module Template_manager
 * class WidgetDependence
 */
class WidgetDependence extends \template_manager\installer\DependenceBase {

    /**
     * Verify widgets dependence relations
     * @return boolean
     */
    public function verify() {
        $this->getWidgets();
        switch ($this->relation) {
            case "add":
                return $this->add();
            case "required":
                return $this->required();
            case "wishful":
                return $this->wishful();
        }
        return FALSE;
    }

    /**
     * Prepare installed widgets array
     */
    private function getWidgets() {
        $widgets = \CI::$APP->db
                ->select('name')
                ->get('widgets')
                ->result_array();

        $this->widgets = array();
        foreach ($widgets as $row) {
            $this->widgets[] = $row['name'];
        }
    }

    /**
     * Add widget
     * @return boolean
     */
    private function add() {
        if (in_array($this->name, $this->widgets)) {
            $this->messages[] = 'Widget already exists';
            return FALSE;
        }

        $data = (string) $this->node;

        if (empty($data)) {
            $this->messages[] = 'Widget must have content';
            return FALSE;
        }

        $attrs = $this->node->attributes();
        $description = (string) $attrs['description'];

        $result = \CI::$APP->db->insert('widgets', array(
            'name' => $this->name,
            'description' => $description,
            'data' => $data,
            'type' => 'html'
        ));

        if ($result == FALSE) {
            $this->messages[] = 'Error on edding to DB';
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Check if widget is required
     * @return boolean
     */
    private function required() {
        if (!in_array($this->name, $this->widgets)) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Check if widget is wishful
     * @return boolean
     */
    private function wishful() {
        if (!in_array($this->name, $this->widgets)) {
            $this->messages[] = '';
        }
        return TRUE;
    }

}

?>

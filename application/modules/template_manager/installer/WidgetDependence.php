<?php

/**
 * 
 *
 * @author 
 */
class WidgetDependence extends \template_manager\installer\DependenceBase {

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

    private function required() {
        if (!in_array($this->name, $this->widgets)) {
            return FALSE;
        }
        return TRUE;
    }

    private function wishful() {
        if (!in_array($this->name, $this->widgets)) {
            $this->messages[] = '';
        }
        return TRUE;
    }

}

?>

<?php

namespace template_manager\installer;

/**
 * 
 *
 * @author 
 */
class WidgetDependence extends DependenceBase {

    public function verify() {
        $this->getWidgets();
        switch ($relation) {
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

        $content = $this->node->asXML();
        $attrs = $this->node->attributes();
        $description = $attrs['description'];

        $result = \CI::$APP->db->insert('widgets', array(
            'name' => $this->name,
            'description' => $description,
            'data' => $content,
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

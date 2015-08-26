<?php

namespace template_manager\installer;

/**
 * Image CMS
 * Module Template_manager
 * class ModuleDependence
 */
class ModuleDependence extends DependenceBase {

    /**
     * Module relation (required, wishful, add)
     * @var string 
     */
    public $relation;

    /**
     * Module name
     * @var string 
     */
    public $name;

    /**
     * Type (widget, module)
     * @var string 
     */
    public $type;

    /**
     * Dependency SimpleXMLElement node
     * @var \SimpleXMLElement 
     */
    public $node;
    

    public function __construct(\SimpleXMLElement $node) {
        $attributes = $node->attributes();
        
       /**
        * Set module attributes
        */
        $this->relation = (string) $attributes['type'];
        $this->name = (string) $attributes['name'];
        $this->type = (string) $attributes['entityName'];
        
        $this->ci = & get_instance();
    }

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
            case "add":
                return $this->add();
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
            $this->messages[] = lang('This module is required', 'template_manager');
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
            $this->messages[] = lang('This module is wishful', 'template_manager');
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Check if this modyle need to install and install it if it posible
     * @return boolean
     */
    private function add() {
        if (!in_array($this->name, $this->components)) {
            if (file_exists(BASEPATH . '../application/modules/' . $this->name . '/' . $this->name . '.php')) {
                include_once BASEPATH . '../application/modules/' . $this->name . '/' . $this->name . '.php';

                $this->ci->load->module($this->name);
                $module = $this->name;
                if (method_exists($this->ci->$module, '_install')) {
                    // Make module install
                    $data = array(
                        'name' => $this->name,
                        'identif' => $this->name
                    );

                    $this->ci->db->insert('components', $data);

                    $this->ci->$module->_install();
                }
            } else {
                $this->messages[] = lang('This module is not exists', 'template_manager');
                return FALSE;
            }
        }

        return TRUE;
    }

}

?>

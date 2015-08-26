<?php

namespace template_manager\installer;

/**
 * Image CMS
 * Module Template_manager
 * class WidgetDependence
 */
class WidgetDependence extends DependenceBase {

    /**
     * Widget relation (required, wishful, add)
     * @var string 
     */
    public $relation;

    /**
     * Widget name
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

    /**
     * Method name for module widget
     * @var string 
     */
    private $method;

    /**
     * Widget desctiption
     * @var string 
     */
    private $description;

    /**
     * Module name for module widget
     * @var string 
     */
    private $module;

    /**
     * Widget type (module, html)
     * @var string 
     */
    private $widgetType;

    /**
     * Module settings for module widget
     * @var string 
     */
    private $moduleSettings;

    /**
     * Widget locale
     * @var string 
     */
    private $locale;

    /**
     * Check install demodata or not
     * @var type 
     */
    private $rewriteData;

    public function __construct(\SimpleXMLElement $node) {
        $attributes = $node->attributes();

        /**
         * Set widget attributes
         */
        $this->node = $node;
        $this->relation = (string) $attributes['type'];
        $this->name = (string) $attributes['name'];
        $this->type = (string) $attributes['entityName'];
        $this->widgetType = (string) $attributes['widgetType'];
        $this->module = (string) $attributes['module'];
        $this->method = (string) $attributes['method'];
        $this->description = (string) $attributes['description'];
        $this->locale = (string) $attributes['locale'];
        $this->moduleSettings = '';

        $this->ci = & get_instance();
    }

    /**
     * Verify widgets dependence relations
     * @return boolean
     */
    public function verify($rewriteData = FALSE) {
        $this->rewriteData = $rewriteData;
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
        if (!in_array($this->name, $this->widgets) || $this->rewriteData) {
            /**
             * Check widget type(module, html) adn prepare widget data
             */
            switch ($this->widgetType) {
                case 'module':
                    if (isset($this->node->settings)) {
                        foreach ((array) $this->node->settings as $settingName => $settingValue) {
                            if (isset($settingValue->settings)) {
                                foreach ((array)$settingValue->settings as $settingNameInc => $settingInc){
                                    $settingInc = trim($settingInc);
                                    if(strstr($settingNameInc, 'number')){
                                        $this->moduleSettings[$settingName][(int)str_replace('number', '', $settingNameInc)] = $settingInc;
                                    }else{
                                        $this->moduleSettings[$settingName][$settingNameInc] = $settingInc;
                                    }
                                    
                                }
                                
                            } else {
                                $this->moduleSettings[$settingName] = trim($settingValue);
                            }
                        }
                    }
                    $widgetData = $this->module;
                    break;
                default :
                    $widgetData = '';
                    break;
            }

            /**
             * Prepare data to insert into DB table `widgets`
             */
            $data = array(
                'name' => $this->name,
                'description' => $this->description,
                'data' => $widgetData,
                'type' => $this->widgetType,
                'method' => $this->method,
                'settings' => $this->moduleSettings ? serialize($this->moduleSettings) : '',
                'description' => $this->description,
                'created' => time()
            );


            if ($this->rewriteData) {
                \CI::$APP->db->where('name', $data['name'])->delete('widgets');
            }

            // Insert widget data into DB table `widgets`
            $result = \CI::$APP->db->insert('widgets', $data);

            /**
             * Prepare data to insert into DB table `widget_i18n`
             */
            $widget_id = \CI::$APP->db->insert_id();
            $data_i18n = array();
            if (isset($this->node->widget_i18n)) {
                foreach ($this->node->widget_i18n as $widget_i18n) {
                    $attributes = $widget_i18n->attributes();

                    $data = '';
                    if (isset($widget_i18n->data)) {
                        foreach ($widget_i18n->data->children() as $child) {
                            $data .= $child->asXML();
                        }
                    } else {
                        $data = '';
                    }

                    $data_i18n[] = array(
                        'id' => $widget_id,
                        'locale' => (string) $attributes->locale ? (string) $attributes->locale : \MY_Controller::getCurrentLocale(),
                        'data' => $data
                    );
                }
            }

            if ($data_i18n) {
                $result = \CI::$APP->db->insert_batch('widget_i18n', $data_i18n);
            }


            if ($result == FALSE) {
                $this->messages[] = lang('Error on adding to DB', 'template_manager');
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Check if widget is required
     * @return boolean
     */
    private function required() {
        if (!in_array($this->name, $this->widgets)) {
            $this->messages[] = lang('This widget is required', 'template_manager');
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
            $this->messages[] = lang('This widget is wishful', 'template_manager');
            return FALSE;
        }
        return TRUE;
    }

}

?>

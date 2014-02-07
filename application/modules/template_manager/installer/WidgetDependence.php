<?php

namespace template_manager\installer;

/**
 * 
 *
 * @author 
 */
class WidgetDependence implements IDependence {

    public function verify() {
        $attributes = $node->attributes();
        switch ($attributes['type']) {
            
        }
        
        return TRUE;
    }

    public function getMessage() {
        
    }

}

?>

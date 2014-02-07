<?php

/**
 *
 * @author 
 */
interface IDependence {

    /**
     * 
     * @param string $name
     */
    public function setName($name);

    /**
     * 
     * @param string $type required|wishful|add
     *      - required: if entity not set, then template will not be installed
     *      - wishful: template will be installed, but with notice
     *      - add: entity (for example page or category) will be added to base
     * 
     */
    public function setType($type);

    /**
     * 
     * @return boolean 
     */
    public function verify();
}


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
     * @param type $type
     */
    public function setType($type);

    /**
     * 
     * @return boolean 
     */
    public function verify();
}


<?php

/**
 * 
 *
 * @author kolia
 */
abstract class ControllerBase {

    /**
     * Instance of main admin controler
     * @var Admin 
     */
    protected $controller;

    /**
     *
     * @var \CMSFactory\assetManager 
     */
    protected $assetManager;

    public function __construct($controller) {
        $this->controller = $controller;
        $this->assetManager = $controller->assetManager;
    }

}

?>

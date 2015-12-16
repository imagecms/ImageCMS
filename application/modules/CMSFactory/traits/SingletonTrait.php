<?php

namespace CMSFactory\traits;

/**
 * Trait for easy creation of singleton
 *
 * Instead of constructor you may declare init() method
 */
trait SingletonTrait
{

    protected static $instance;

    protected function __construct() {

    }

    protected function __clone() {

    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self;
            self::$instance->init();
        }
        return self::$instance;
    }

    abstract protected function init();

}
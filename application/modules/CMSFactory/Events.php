<?php

namespace CMSFactory;

/**
 * Events Class
 * <p>Сlass that implements the events in system. Is a Singleton class.</p>
 * @package CMSFactory
 * @copyright ImageCMS (c) 2013, <dev@imagecms.net>
 */
class Events extends BaseEvents
{

    protected static $_BehaviorInstance;

    public $storage = [];

    public $key = null;

    private function __construct() {

    }

    private function __clone() {

    }

    /**
     *
     * @return Events
     */
    public static function create() {
        (null !== self::$_BehaviorInstance) OR self::$_BehaviorInstance = new self();
        self::$_BehaviorInstance->key = null;
        return self::$_BehaviorInstance;
    }

}
<?php

define('BASEPATH', '');

include __DIR__ . '/../../../third_party/autoload.php';
include __DIR__ . '/../../../config/database.php';
include __DIR__ . '/../../../../system/helpers/url_helper.php';



//for propel
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->setAdapterClass('Shop', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();

$manager->setConfiguration(array(
    'dsn' => 'mysql:host=' . 'localhost' . ';dbname=' . $db['default']['database'],
    'user' => $db['default']['username'],
    'password' => $db['default']['password'],
    'settings' => array(
        'charset' => 'utf8',
    ),
));

$serviceContainer->setConnectionManager('Shop', $manager);

if (!function_exists('lang')) {

    function lang($arg) {
        return $arg;
    }

}

if (!function_exists('dd')) {

    function dd() {
        codecept_debug(func_get_args());
    }

}

function site_url($uri = '') {
    return 'http://host/' . $uri;
}
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['tempDir'] = PUBPATH . 'uploads/cmlTemp/';
$config['characteristicsStorageFilePath'] = $config['tempDir'] . '1c_characteristics.json';
$config['salesQuery:exportCharacteristics'] = true;
$config['filesize'] = 2048000;
$config['validIP'] = '127.0.0.1';
$config['password'] = '';
$config['usepassword'] = false;
$config['userstatuses'] = array();
$config['autoresize'] = 'off';
$config['debug'] = false;
$config['email'] = false;


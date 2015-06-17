<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	http://codeigniter.com/user_guide/general/hooks.html
  |
 */

$hook['pre_system'][] = array(
    'class' => '',
    'function' => 'checkPhpVersionOrDie',
    'filename' => 'system_validation_hooks.php',
    'filepath' => 'third_party'
);
$hook['post_controller'][] = array(
    'class' => '',
    'function' => 'runFactory',
    'filename' => 'hooks.php',
    'filepath' => 'third_party'
);

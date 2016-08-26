<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config['cfcm']['filter_xss_post'] = true;
$config['cfcm']['error_inline'] = true;
$config['cfcm']['upload_file'] = [
                                  'upload_path'   => './uploads/files',
                                  'allowed_types' => 'zip|rar|txt',
                                  'max_size'      => '2048',
                                 ];
$config['cfcm']['upload_image'] = [
                                   'upload_path'   => './uploads/images',
                                   'allowed_types' => 'gif|jpg|png',
                                   'max_size'      => '2048',
                                   'max_width'     => '1024',
                                   'max_height'    => '768',
                                  ];
$config['cfcm']['error_inline_html'] = '<div class="error_field_text el_magrin">%s</div>';
$config['cfcm']['error_block_html'] = '<div class="errors">%s</div>';
$config['cfcm']['help_text_html'] = '<span class="help-block">%s</span>';
$config['cfcm']['validation_errors_prefix'] = '';
$config['cfcm']['validation_errors_suffix'] = '<br />';
$config['cfcm']['field_error_class'] = 'field_error';
$config['cfcm']['element_prefix'] = '<p class="clear">';
$config['cfcm']['element_suffix'] = '</p>';
$config['cfcm']['label_class'] = '';
$config['cfcm']['required_flag'] = ' *';
$config['cfcm']['required_label_class'] = 'required';
$config['cfcm']['checkgroup_delimiter'] = '';
$config['cfcm']['radiogroup_delimiter'] = '';
$config['cfcm']['default_attr'] = [
                                   'captcha' => [
                                                 'label' => lang('Protection code', 'cfcm'),
                                                ],
                                  ];
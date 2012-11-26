<?php

$config['filter_xss_post'] = TRUE;

// Display errors before each field
$config['error_inline'] = TRUE;

$config['upload_file'] = array(
            'upload_path'   => './uploads/files',
            'allowed_types' => 'zip|rar|txt',
            'max_size'	    => '2048',
        );

$config['upload_image'] = array(
            'upload_path'   => './uploads/images',
            'allowed_types' => 'gif|jpg|png',
            'max_size'	    => '2048',
            'max_width'     => '1024',
            'max_height'    => '768',
        );

// Html code for single error
$config['error_inline_html'] = '<div class="error_field_text el_magrin">%s</div>';

// Html code for all errors
$config['error_block_html'] = '<div class="errors">%s</div>';
$config['help_text_html']   = '<br/><span class="help_text">%s</span>';

// Prefix and suffix for validation_errors() function
$config['validation_errors_prefix'] = '';
$config['validation_errors_suffix'] = '<br />';

$config['field_error_class'] = 'field_error';

// Wraps around all elements
$config['element_prefix'] 	= '<p class="clear">';
$config['element_suffix'] 	= '</p>';

$config['label_class'] = 'left';

$config['required_flag'] = ' *';
$config['required_label_class'] = 'required';

// This string will be inserted after each check/radio in group.
$config['checkgroup_delimiter'] = '';
$config['radiogroup_delimiter'] = '';

// Element default values
$config['default_attr'] = array(
    'textarea' => array(
        'attributes' => 'rows="10" cols="50"',
    ),
    'captcha' => array(
        'label' => 'Код протекции',
    ),
);

/* End of file forms.php */
/* Location: ./application/config/forms.php */

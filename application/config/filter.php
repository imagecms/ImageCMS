<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * List of valid filter params
 */
$config['filter'] = array(
    'p', 'brand', 'lp', 'rp', 
    'order', 'per_page', 'user_per_page', 
    'category', 'utm_medium', 'utm_campaign', 
    'utm_source', 'utm_term', 'utm_content', 
    'gclid', 'filtermobile');
<?php

return array(
    array(
        'name' => lang('Orders', 'mod_stats'),
        'controller' => 'orders',
        'items' => array(
            array(
                'name' => lang('Sum and count charts', 'mod_stats'),
                'controller' => 'orders',
                'action' => 'charts',
            ),
            array(
                'name' => lang('Collected info', 'mod_stats'),
                'controller' => 'orders',
                'action' => 'info',
            ),
            array(
                'name' => lang('By users', 'mod_stats'),
                'controller' => 'orders',
                'action' => 'users',
            ),
        )
    ),
    array(
        'name' => lang('Users', 'mod_stats'),
        'controller' => 'users',
        'items' => array(
            array(
                'name' => lang('Online', 'mod_stats'),
                'controller' => 'users',
                'action' => 'online',
            ),
            array(
                'name' => lang('Registered', 'mod_stats'),
                'controller' => 'users',
                'action' => 'registered',
            ),
            array(
                'name' => lang('Attendance', 'mod_stats'),
                'controller' => 'users',
                'action' => 'attendance',
            ),
            array(
                'name' => lang('Robots attendance', 'mod_stats'),
                'controller' => 'users',
                'action' => 'robots_attendance',
            ),
        )
    ),
    array(
        'name' => lang('Products', 'mod_stats'),
        'controller' => 'products',
        'items' => array(
            array(
                'name' => lang('Categories', 'mod_stats'),
                'controller' => 'products',
                'action' => 'categories',
            ),
            array(
                'name' => lang('Brands', 'mod_stats'),
                'controller' => 'products',
                'action' => 'brands',
            ),
            array(
                'name' => lang('Product information', 'mod_stats'),
                'controller' => 'products',
                'action' => 'productInfo',
            ),
        )
    ),
    array(
        'name' => lang('Product\'s categories', 'mod_stats'),
        'controller' => 'categories',
        'items' => array(
            array(
                'name' => lang('Categories attendance', 'mod_stats'),
                'controller' => 'categories',
                'action' => 'attendance',
            ),
            array(
                'name' => lang('Brands in category', 'mod_stats'),
                'controller' => 'categories',
                'action' => 'brandsInCategories',
            ),
        )
    ),
    array(
        'name' => lang('Search', 'mod_stats'),
        'controller' => 'search',
        'items' => array(
            array(
                'name' => lang('Searched keywords', 'mod_stats'),
                'controller' => 'search',
                'action' => 'keywords',
            ),
            array(
                'name' => lang('Brands in search results', 'mod_stats'),
                'controller' => 'search',
                'action' => 'brandsInSearch',
            ),
            array(
                'name' => lang('Categories in search results', 'mod_stats'),
                'controller' => 'search',
                'action' => 'categoriesInSearch',
            ),
//            array(
//                'name' => lang('No results', 'mod_stats'),
//                'controller' => 'search',
//                'action' => 'noResults',
//            ),
        )
    ),
);

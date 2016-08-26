<?php

return [
        [
         'name'       => lang('Orders', 'mod_stats'),
         'controller' => 'orders',
         'items'      => [
//            array(
//                'name' => lang('Sum and count charts', 'mod_stats'),
//                'controller' => 'orders',
//                'action' => 'charts',
//            ),
                          [
                           'name'       => lang('Collected info', 'mod_stats'),
                           'controller' => 'orders',
                           'action'     => 'info',
                          ],
                          [
                           'name'       => lang('By users', 'mod_stats'),
                           'controller' => 'orders',
                           'action'     => 'users',
                          ],
                         ],
        ],
        [
         'name'       => lang('Users', 'mod_stats'),
         'controller' => 'users',
         'items'      => [
                          [
                           'name'       => lang('Online', 'mod_stats'),
                           'controller' => 'users',
                           'action'     => 'online',
                          ],
                          [
                           'name'       => lang('Registered', 'mod_stats'),
                           'controller' => 'users',
                           'action'     => 'registered',
                          ],
                          [
                           'name'       => lang('Attendance', 'mod_stats'),
                           'controller' => 'users',
                           'action'     => 'attendance',
                          ],
                          //            array(
                          //                'name' => lang('Robots attendance', 'mod_stats'),
                          //                'controller' => 'users',
                          //                'action' => 'robots_attendance',
                          //            ),
                         ],
        ],
        [
         'name'       => lang('Products', 'mod_stats'),
         'controller' => 'products',
         'items'      => [
                          [
                           'name'       => lang('Categories', 'mod_stats'),
                           'controller' => 'products',
                           'action'     => 'categories',
                          ],
                          [
                           'name'       => lang('Brands', 'mod_stats'),
                           'controller' => 'products',
                           'action'     => 'brands',
                          ],
                          [
                           'name'       => lang('Product information', 'mod_stats'),
                           'controller' => 'products',
                           'action'     => 'productInfo',
                          ],
                         ],
        ],
        [
         'name'       => lang("Product's categories", 'mod_stats'),
         'controller' => 'categories',
         'items'      => [
        //            array(
        //                'name' => lang('Categories attendance', 'mod_stats'),
        //                'controller' => 'categories',
        //                'action' => 'attendance',
        //            ),
                          [
                           'name'       => lang('Brands in category', 'mod_stats'),
                           'controller' => 'categories',
                           'action'     => 'brandsInCategories',
                          ],
                         ],
        ],
        [
         'name'       => lang('Search', 'mod_stats'),
         'controller' => 'search',
         'items'      => [
                          [
                           'name'       => lang('Searched keywords', 'mod_stats'),
                           'controller' => 'search',
                           'action'     => 'keywords',
                          ],
                          [
                           'name'       => lang('Brands in search results', 'mod_stats'),
                           'controller' => 'search',
                           'action'     => 'brandsInSearch',
                          ],
                          [
                           'name'       => lang('Categories in search results', 'mod_stats'),
                           'controller' => 'search',
                           'action'     => 'categoriesInSearch',
                          ],
                          //            array(
                          //                'name' => lang('No results', 'mod_stats'),
                          //                'controller' => 'search',
                          //                'action' => 'noResults',
                          //            ),
                         ],
        ],
       ];
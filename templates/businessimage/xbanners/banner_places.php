<?php

// Examples:
//  page_type:
//    - main,
//    - category,
//    - page,
//    - shop_category,
//    - product,
//    - brand,
//    - search

return [
    'main_banner' => [
        'name' => 'Main page big banner',
        'width' => '1980',
        'height' => '572',
        'page_type' => 'main',
        'effects' => [
            'autoplay' => 1,
            "autoplaySpeed" => 3,
            "arrows" => 1,
            "dots" => 1,
        ]
    ],
    'partners' => [
        'name' => 'Our partners',
        'width' => '164',
        'height' => '45',
        'page_type' => 'main'
    ]
];
<?php

$widgets = [
            [
             'title'       => lang('Recent comments', 'comments'),
             'description' => lang('Displays a list of recent comments.', 'comments'),
             'method'      => 'recent_comments',
            ],
            [
             'title'             => lang('Latest Product Reviews', 'comments'),
             'description'       => lang('Showing latest product reviews.', 'comments'),
             'method'            => 'recent_product_comments',
             'allowed_cms_types' => [
                                     'premium',
                                     'professional',
                                    ],
            ],
           ];
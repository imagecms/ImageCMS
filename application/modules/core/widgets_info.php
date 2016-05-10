<?php

$widgets = [
            [
             'title'       => lang('Latest news', 'core'),
             'description' => lang('Displaying the last or popular pages in the selected category.', 'core'),
             'method'      => 'recent_news',
            ],

            [
             'title'       => lang('Similar pages', 'core'),
             'description' => lang('Displays a list of pages that are linked title.', 'core'),
             'method'      => 'similar_posts',
            ],
           ];
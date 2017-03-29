<?php

$widgets = [
    [
        'title'       => lang('Recent images', 'gallery'),
        'description' => lang('Displays the most recently added to the image gallery.', 'gallery'),
        'method'      => 'latest_fotos',
    ],
    [
        'title'       => lang('Album images', 'gallery'),
        'description' => lang('Displays a list of images of the specified album.', 'gallery'),
        'method'      => 'album_images',
    ],
];
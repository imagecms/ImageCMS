<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('gallery_latest_images')) {

    // Get gallery latest uploaded fotos
    // return array

    function gallery_latest_images($count = 5, $order = 'latest') {
        $ci = & get_instance();

        if ($count > 0) {
            $ci->db
                ->select('gallery_images.*, gallery_images_i18n.*')
                ->limit((int) $count);

            if ($order == 'latest') {
                $ci->db->order_by('uploaded', 'DESC');
            } elseif ($order == 'random') {
                $ci->db->order_by('uploaded', 'RANDOM');
            } else {
                $ci->db->order_by('uploaded', 'DESC');
            }

            $locale = MY_Controller::getCurrentLocale();
            $query = $ci->db
                ->join('gallery_images_i18n', "gallery_images_i18n.id=gallery_images.id AND locale='$locale'", 'left')
                ->get('gallery_images');

            if ($query && $query->num_rows() > 0) {
                $result = $query->result_array();

                $rescount = count($result);

                for ($i = 0; $i < $rescount; $i++) {
                    $result[$i]['url'] = 'gallery/album/' . $result[$i]['album_id'] . '/image/' . $result[$i]['id'];
                    $result[$i]['file_path'] = 'uploads/gallery/' . $result[$i]['album_id'] . '/' . $result[$i]['file_name'] . '_prev' . $result[$i]['file_ext'];
                }

                return $result;
            } else {
                return array();
            }
        }
    }

}

if (!function_exists('count_albums')) {

    // Get gallery latest uploaded fotos
    // return array

    function count_albums($id) {

        $ci = & get_instance();
        return $ci->db->where('category_id', $id)->get('gallery_albums')->num_rows();
    }

}
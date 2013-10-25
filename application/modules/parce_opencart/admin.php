<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 * @property CI_DB_active_record $db_opencart 
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('module_frame');
        $this->load->helper('translit');
    }

    public function index() {
        $db['hostname'] = 'localhost';
        $db['username'] = 'root';
        $db['password'] = '';
        $db['database'] = 'simpla';
        $db['dbdriver'] = 'mysql';
        $db['dbprefix'] = '';
        $db['pconnect'] = FALSE;
        $db['db_debug'] = FALSE;
        $db['cache_on'] = FALSE;
        $db['cachedir'] = 'system/cache';
        $db['char_set'] = 'utf8';
        $db['dbcollat'] = 'utf8_general_ci';
        $db['swap_pre'] = '';
        $db['autoinit'] = TRUE;
        $db['stricton'] = FALSE;

        $this->db_opencart = $this->load->database($db, TRUE, TRUE);
        $this->insert_category();
    }

    public function insert_category() {
        $data = $this->db_opencart
                ->join('category_description', 'category.category_id=category_description.category_id')
                ->order_by('category.category_id')
                ->get('category')
                ->result_array();

        $urls = $this->db_opencart
                ->like('query', 'category_id')
                ->get('url_alias')
                ->result_array();

        foreach ($urls as $key => $url) {
            $id = str_replace('category_id=', '', $url['query']);
            $u[$id] = $url['keyword'];
        }

        foreach ($data as $d) {
            $array[$d['category_id']] = $d;
        }

        $data = $array;

        foreach ($data as $d) {
            $parentId = $d['parent_id'];
            $fp[$d['category_id']][] = $u[$d['category_id']];

            while ($parentId != 0) {
                $fpi[$d['category_id']][] = (int) $parentId;
                $fp[$d['category_id']][] = $u[$parentId];

                $parentId = $data[$parentId]['parent_id'];
            }

            if (count($fpi[$d['category_id']]) == 0) {
                $fpi[$d['category_id']] = array();
            }

            $fp[$d['category_id']] = implode('/', array_reverse($fp[$d['category_id']]));
            $fpi[$d['category_id']] = serialize($fpi[$d['category_id']]);

            $insert[] = array(
                'id' => $d['category_id'],
                'url' => $u[$d['category_id']],
                'parent_id' => translit_url($d['parent_id']),
                'position' => $d['category_id'],
                'full_path' => $fp[$d['category_id']],
                'full_path_ids' => $fpi[$d['category_id']],
                'active' => $d['status'],
                'image' => '',
                'tpl' => '',
                'order_method' => '',
            );

            $insert_i18n[] = array(
                'id' => $d['category_id'],
                'locale' => 'ru',
                'name' => $d['name'],
                'h1' => $d['seo_h1'],
                'description' => $d['description'],
                'meta_desc' => $d['meta_description'],
                'meta_title' => $d['seo_title'],
                'meta_keywords' => $d['meta_keyword'],
            );

            $thash[] = array(
                'trash_url' => $fp[$d['category_id']],
                'trash_redirect_type' => 'category',
                'trash_redirect' => site_url() . 'shop/category/' . $fp[$d['category_id']],
                'trash_type' => 301,
            );
        }

        $this->db->insert_batch('shop_category1', $insert);
        $this->db->insert_batch('shop_category_i18n1', $insert_i18n);
        $this->db->insert_batch('trash', $thash);
    }

}

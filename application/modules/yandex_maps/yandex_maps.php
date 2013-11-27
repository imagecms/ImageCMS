<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Yandex_maps extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->core->set_meta_tags('Квартиры на карте Москвы');
        
        $adresses = $this->db
                ->select('*, shop_products.mainImage as image')
                ->join('shop_products', 'shop_products.id=shop_product_properties_data.product_id')
                ->join('shop_product_variants', 'shop_products.id=shop_product_variants.product_id')
                ->join('shop_products_i18n', 'shop_products.id=shop_products_i18n.id')
                ->where('property_id', 41)
                ->where('active', 1)
                ->order_by('value')
                ->group_by('value')
                ->get('shop_product_properties_data')
                ->result_array();

        $coords = $this->db
                ->get('mod_yandex_maps')
                ->result_array();

        foreach ($coords as $data) {
            $coord[$data['prop_id']] = $data['coord'];
        }

        foreach ($adresses as $data) {
            if (!$coord[$data['id']]) {
                $params = array(
                    'geocode' => $data['value'], // адрес
                    'format' => 'json', // формат ответа
                    'results' => 1, // количество выводимых результатов
                    'key' => 'AAoLw1EBAAAAO_JHYAIAsJj6iF3T4sBvntf_l4063PqmMz4AAAAAAAAAAAAGXVjwOb6GwUQMsRR6E-Xcp_vHTQ==', // ваш api key
                );
                $coord[$data['id']] = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));
                $coord[$data['id']] = $coord[$data['id']]->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;

                $coord[$data['id']] = implode(', ', array_reverse(explode(' ', $coord[$data['id']])));
                $this->db
                        ->set('prop_id', $data['id'])
                        ->set('coord', $coord[$data['id']])
                        ->insert('mod_yandex_maps');
            }
            $crd .='[' . (string) $coord[$data['id']] . '], ';
            $url[] = $data['url'];
            $array[] = $data['name'];
            $desc[] = $data['full_description'];
            $img[] = $data['image'];
            $ids[] = $data['id'];
            $price[] = $data['price'];
        }
        $crd = rtrim($crd, ', ');

        $this->template->add_array(
                array(
                    'adr' => $array,
                    'img' => $img,
                    'ids' => $ids,
                    'url' => $url,
                    'price' => $price,
                    'desc' => $desc,
                    'crd' => $crd
                )
        );

        $this->display_tpl('main');
    }

    public function autoload() {
        
    }

    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/assets/' . $file;
        $this->template->show('file:' . $file);
    }

    public function _install() {

        $this->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
            ),
            'prop_id' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'coord' => array(
                'type' => 'VARCHAR',
                'constraint' => 30,
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_yandex_maps', TRUE);

        $this->db->where('name', 'yandex_maps')
                ->update('components', array('autoload' => '0', 'enabled' => '1'));
    }

    public function _deinstall() {
        /**
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_empty');
         *
         */
    }

}

/* End of file sample_module.php */

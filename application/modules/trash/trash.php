<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс редиректа удаленных товаров
 */
class Trash extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
    }

    public function index() {
        $this->core->error_404();
    }

    public function autoload() {
//        \behaviorFactory\BehaviorFactory::get();
        
        $row = $this->db->get_where('trash', array('trash_url' => $this->uri->uri_string()))->row();
        if ($row != null) {
            ($row->trash_redirect_type != '404') OR $this->core->error_404();
            redirect($row->trash_redirect, 'location', 301);
        }
    }

    public function addProductWhenDelete(SProducts $model) {
        $array = array(
            'trash_id' => $model->category_id,
            'trash_url' => 'shop/product/' . $model->url,
            'trash_redirect_type' => 'category',
            'trash_redirect' => shop_url('category/' . $model->getMainCategory()->getFullPath())
        );

        $this->db->insert('trash', $array);
    }

    public function _install() {
        ($this->dx_auth->is_admin()) OR exit;
        $sql = "
CREATE  TABLE IF NOT EXISTS `trash` (
  `id` INT NULL AUTO_INCREMENT ,
  `trash_id` VARCHAR(200) NULL ,
  `trash_url` VARCHAR(200) NULL ,
  `trash_redirect_type` VARCHAR(200) NULL ,
  `trash_redirect` VARCHAR(200) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;
";
        $this->db->query($sql);
        $this->db->limit(1);
        $this->db->where('name', 'trash');
        $this->db->update('components', array('enabled' => 0, 'autoload' => 1));
    }

    public function _deinstall() {
        ($this->dx_auth->is_admin()) OR exit;
        $sql = "DROP TABLE `trash`;";
        $this->db->query($sql);
    }

}

/* End of file trash.php */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Для подключения, нужно прописать в шаблоне:
  {$CI->load->module('star_rating')->show_star_rating()}

 * Также, включить автозагрузку и доступ по url.
 * Star rating module
 *
 */
class Star_rating extends MY_Controller {

    private $new_votes = 0;
    private $new_rating = 0;
    private $list_for_show = array('main', 'category', 'brand', 'product', 'shop_category', 'page');

    public function __construct() {
        parent::__construct();
        $this->load->library('template');
        $this->load->helper('path');
    }

    public function show_star_rating($item = null) {
        $this->template->set_config_value('tpl_path', set_realpath('application/modules/star_rating/templates/'));
        $get_settings = $this->db->select('settings')->where('name', 'star_rating')->get('components')->row_array();
        $this->list_for_show = json_decode($get_settings['settings'], true);
        if ($this->list_for_show == null)
        {
            $this->list_for_show = array();
        }
        
        $id = $this->core->core_data['id'];
        $type = $this->core->core_data['data_type'];
        
        // product rating
        if ($item != null && $item instanceof SProducts){
            $star_rating = array (
                'id_type' => $item->getId(),
                'type' => 'product',
                'votes' => $item->getVotes(),
                'rating' => $item->getRating()*$item->getVotes()
                
            );
            $this->template->add_array(array(
                    'star_rating' => $star_rating
                ));
            $this->template->display('product_star_rating');
        
        //product rating in shop category    
        }else if ($item != null && $item instanceof stdClass){
            $star_rating = array (
                'id_type' => $item->id,
                'type' => 'cat_product',
                'votes' => $item->votes,
                'rating' => $item->rating
                    );
            
              $this->template->add_array(array(
                    'star_rating' => $star_rating
                ));
            $this->template->display('product_star_rating');   
            
            
       
        }else{
              if (in_array($type, array_keys($this->list_for_show))) {
                $star_rating = $this->get_rating($id, $type);
                $this->template->add_array(array(
                    'star_rating' => $star_rating
                ));
                
                
                $this->template->display('star_rating');
                }
            }
        
       $this->template->set_config_value('tpl_path', set_realpath('templates/commerce'));     
    }

    private function get_rating($id_g = null, $type_g = null) {
        $res = $this->db->where('id_type', $id_g)->where('type', $type_g)->get('rating')->row();
        return $res;
    }

    public function ajax_rate() {
        $id = $_POST['cid'];
        $type = $_POST['type'];
        $rating = (int) $_POST['val'];

        if ($id != null && $type != null && !$this->session->userdata('voted_g' . $id . $type) == true) {
            //check if rating exists 
            $check = $this->get_rating($id, $type);
            if ($check != null) {
                $this->new_votes = $check->votes + 1;
                $this->new_rating = $check->rating + $rating;
                $data = array(
                    'votes' => $this->new_votes,
                    'rating' => $this->new_rating
                );
                $rating_res = $this->new_rating / $this->new_votes;
                $votes_res = $this->new_votes;
                $this->db->where('id_type', $id)->where('type', $type)->update('rating', $data);
            } else {
                $data = array(
                    'id_type' => $id,
                    'type' => $type,
                    'votes' => 1,
                    'rating' => $rating
                );
                $votes_res = 1;
                $rating_res=$rating;
                $this->db->insert('rating', $data);
            }
            
            if ($type == 'product'){
            
                if (SProductsQuery::create()->findPk($id) !== null) {
                        $model = SProductsRatingQuery::create()->findPk($id);
                        if ($model === null) {
                            $model = new SProductsRating;
                            $model->setProductId($id);
                        }
                        $rating_res = ($model->getRating() + $rating) / ($model->getVotes() + 1);
                        $votes_res = $model->getVotes() + 1;
                        
                        $model->setVotes($model->getVotes() + 1);
                        $model->setRating($model->getRating() + $rating);
                        $model->save();
                    }
            }
            $this->session->set_userdata('voted_g' . $id . $type, true);
            
            $rating_res = $this->count_stars(round($rating_res));
            
            if ($this->input->is_ajax_request()) {
                return json_encode(array("classrate" => "$rating_res",
                            "votes" => "$votes_res"
                        ));
            }
        } else {
            return json_encode(array("classrate" => null));
        }
    }

    private function count_stars($rating = null) {
        if ($rating == 1)
            $rating = "onestar";
        if ($rating == 2)
            $rating = "twostar";
        if ($rating == 3)
            $rating = "threestar";
        if ($rating == 4)
            $rating = "fourstar";
        if ($rating == 5)
            $rating = "fivestar";
        return $rating;
    }
    
    
    
    
    public function _install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'id_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => TRUE,
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => TRUE,
            ),
            'votes' => array(
                'type' => 'INT',
            ),
            'rating' => array(
                'type' => 'INT',
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('rating');

        $this->db->where('name', 'star_rating');
        $this->db->update('components', array('enabled' => 1));
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('rating');
    }

}

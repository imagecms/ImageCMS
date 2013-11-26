<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * In oder to show "Star rating" type in template:
  {$CI->load->module('star_rating')->show_star_rating()}
 *
 * If you want to show "Star rating" for product
 * {$CI->load->module('star_rating')->show_star_rating(SProducts $product)}

 *
 * More turn on autoload and url access.
 *
 * Star rating module
 *
 */
class Star_rating extends MY_Controller {

    private $new_votes = 0;
    private $new_rating = 0;
    private $list_for_show = array('main', 'category', 'brand', 'product', 'shop_category', 'page');

    public function __construct() {
        parent::__construct();
        $this->load->helper('path');
        $this->load->model('rating_model');
        $obj = new MY_Lang();
        $obj->load('star_rating');
    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    public function autoload() {
        
    }

    /**
     * Show star_rating
     * @param SProducts $item
     */
    public function show_star_rating($item = null, $registerScript = true) {
        $get_settings = $this->rating_model->get_settings();
        //prepare array with pages which can display "Star rating"
        $this->list_for_show = json_decode($get_settings['settings'], true);
        if ($this->list_for_show == null) {
            $this->list_for_show = array();
        }
        $id = $this->core->core_data['id'];
        $type = $this->core->core_data['data_type'];

        // product rating
        if ($item != null && $item instanceof SProducts) {

            if ($item->getRating() != null)
                $rating_s = (int) $item->getRating() * 20; // rating in percent
            else
                $rating_s = 0;

            $data = array(
                'id_type' => $item->getId(),
                'type' => 'product',
                'votes' => $item->getVotes(),
                'rating' => $rating_s
            );
            $template = 'product_star_rating';
        }else {
            if (in_array($type, array_keys($this->list_for_show))) {
                $rating = $this->rating_model->get_rating($id, $type);
                if ($rating->votes != 0) {
                    $rating_s = $rating->rating / $rating->votes * 20; //rating in percent
                } else {
                    $rating_s = 0;
                }
                $data = array(
                    'id' => $rating->id,
                    'type' => $rating->type,
                    'votes' => $rating->votes,
                    'rating' => $rating_s
                );

                $template = 'star_rating';
            } else {
                $template = null;
                return false;
            }
        }

        //Show template with prepared parametrs
        if ($template !== null)
            $renderTemplate = CMSFactory\assetManager::create();
        $renderTemplate->setData($data)
                ->registerStyle('style');
//                    if ($template != 'product_star_rating')$registerScript
        if ($registerScript) {
            $renderTemplate->registerScript('scripts');
        }
        $renderTemplate->render($template, true);
        return $this;
    }

    /**
     * Change rating for pages / product
     * @return type
     */
    public function ajax_rate() {
        $id = $_POST['cid'];
        $type = $_POST['type'];
        $rating = (int) $_POST['val'];

        if ($id != null && $type != null && !$this->session->userdata('voted_g' . $id . $type) == true) {
            //Check if rating exists
            $check = $this->rating_model->get_rating($id, $type);
            if ($check != null) {
                $this->new_votes = $check->votes + 1;
                $this->new_rating = $check->rating + $rating;
                $data = array(
                    'votes' => $this->new_votes,
                    'rating' => $this->new_rating
                );
                $rating_res = $this->new_rating / $this->new_votes * 20;
                $votes_res = $this->new_votes;
                $this->rating_model->update_rating($id, $type, $data);
            } else {
                $data = array(
                    'id_type' => $id,
                    'type' => $type,
                    'votes' => 1,
                    'rating' => $rating
                );
                $votes_res = 1;
                $rating_res = $rating * 20;
                $this->rating_model->insert_rating($data);
            }
            //Change rating for product
            if ($type == 'product') {
                if (SProductsQuery::create()->findPk($id) !== null) {
                    $model = SProductsRatingQuery::create()->findPk($id);
                    if ($model === null) {
                        $model = new SProductsRating;
                        $model->setProductId($id);
                    }
                    $rating_res = (($model->getRating() + $rating) / ($model->getVotes() + 1)) * 20;
                    $votes_res = $model->getVotes() + 1;

                    $model->setVotes($model->getVotes() + 1);
                    $model->setRating($model->getRating() + $rating);
                    $model->save();
                }
            }
            //Save in session user's info
            $this->session->set_userdata('voted_g' . $id . $type, true);

            //If ajax request than return data for with new rating and votes
            if ($this->input->is_ajax_request()) {
                return json_encode(array("rate" => "$rating_res",
                    "votes" => "$votes_res"
                ));
            }
        } else {
            return json_encode(array("rate" => null));
        }
    }

    /**
     * Install module
     */
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

    /**
     * Deinstall module
     */
    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('rating');
    }

}

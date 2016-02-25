<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Seo_snippets_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function getAggregateRating($id) {
        if ($this->db->table_exists('comments')) {
            return $this->db
                ->select('sum(rate) as reviewCount, COUNT(rate) as ratingCount, MAX(rate) as bestRating, MIN(rate) as worstRating')
                ->where('item_id', $id)
                ->where('module', 'shop')
                ->where('rate > 0')
                ->get('comments')
                ->row_array();
        }
    }

}
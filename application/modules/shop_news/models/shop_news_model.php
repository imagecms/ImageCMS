<?php

class Shop_news_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Save categories in which show content page
     * @param array $contentId
     * @param string $categories
     * @return boolean
     */
    public function saveCategories($contentId, $categories) {
        if ($this->db->where('content_id', $contentId)->get('mod_shop_news')->result_array() != null) {
            $this->db->where('content_id', $contentId)->update('mod_shop_news', ['shop_categories_ids' => $categories]);
        } else {
            $this->db->insert('mod_shop_news', ['content_id' => $contentId, 'shop_categories_ids' => $categories]);
        }
        return TRUE;
    }

    /**
     * Return array of content pages ids
     * @param integer $categoryId
     * @return array
     */
    public function getContentIds($categoryId) {
        return $this->db->select('content_id')->like('shop_categories_ids', $categoryId)->get('mod_shop_news')->result_array();
    }

    /**
     * Return content pages for displaying in category
     * @param array $ids
     * @param int $limit
     * @return array
     */
    public function getContent($ids, $limit) {
        if ($ids != null) {
            $query = $this->db
                ->select('content.*')
                ->select("IF(route.parent_url <> '', concat(route.parent_url, '/', route.url), route.url) as full_url", false)
                ->join('route', 'route.id = content.route_id')
                ->where_in('content.id', $ids)
                ->limit($limit)
                ->get('content');

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return [];
        }
    }

    /**
     * Return product category by product id
     * @param integer $productId
     * @return int
     */
    public function getProductCategory($productId) {
        $res = $this->db->select('category_id')->where('id', $productId)->get('shop_products')->row_array();

        return $res['category_id'];
    }

}
<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property CI_DB_active_record $db
 * Class Base
 */
class Base extends CI_Model
{

    /**
     * @var array
     */
    public $comments_product_id = [];

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param int $item_id
     * @param int $status
     * @param string $module
     * @param int $limit
     * @param string $order_by
     * @return bool|array
     */
    public function get($item_id, $status = 0, $module, $limit = 999999, $order_by) {
        if ($this->db->table_exists('comments')) {

            $this->db->where('item_id', $item_id);
            $this->db->where('status', $status);
            $this->db->where('module', $module);

            $order_by = $order_by ?: 'date.desc';
            $order_column = array_shift(explode('.', $order_by));
            $order_way = array_pop(explode('.', $order_by));
            $this->db->order_by($order_column, $order_way);
            $query = $this->db->get('comments', $limit);

            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
        }

        return FALSE;
    }

    public function get_one($id) {
        $this->db->limit(1);
        return $this->db->get_where('comments', ['id' => $id])->row_array();
    }

    public function add($data) {
        $this->db->insert('comments', $data);

        return $this->db->insert_id();
    }

    public function all($row_count, $offset) {
        $this->db->order_by('date', 'desc');

        if ($row_count > 0 AND $offset >= 0) {
            $query = $this->db->get('comments', $row_count, $offset);
        } else {
            $query = $this->db->get('comments');
        }

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function get_item_comments_status($item_id) {
        $this->db->select('id, comments_status');
        $this->db->where('id', $item_id);
        $query = $this->db->get('content', 1);

        if ($query->num_rows() == 1) {
            $status = $query->row_array();

            if ($status['comments_status'] == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function update($id, $data = []) {
        $this->db->where('id', $id);
        $this->db->update('comments', $data);

        return TRUE;
    }

    public function setYes($id) {
        $row = $this->db->where('id', $id)->get('comments')->row();
        $like = $row->like + 1;
        $data = ['like' => $like];
        $this->db->where('id', $id);
        $res = $this->db->update('comments', $data);
        return $res ? $like : false;
    }

    public function setNo($id) {
        $row = $this->db->where('id', $id)->get('comments')->row();
        $disslike = $row->disslike + 1;
        $data = ['disslike' => $disslike];
        $this->db->where('id', $id);
        $res = $this->db->update('comments', $data);
        return $res ? $disslike : false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        if (is_array($id)) {
            foreach ($id as $item) {
                $this->changeVotesAfterDelete($item);
            }

            $this->db->where_in('id', $id);
            $this->db->delete('comments');
            //delete child comments
            $this->db->where_in('parent', $id);
            $this->db->delete('comments');
        } else {
            $this->changeVotesAfterDelete($id);
            $this->db->limit(1);
            $this->db->where('id', $id);
            $this->db->delete('comments');
            //delete child comments
            $this->db->where('parent', $id);
            $this->db->delete('comments');
        }

        $this->setVoutesAfterDelete();

        return TRUE;
    }

    /**
     * @param int $id
     */
    public function changeVotesAfterDelete($id) {

            $comments = $this->db->get_where('comments', ['id' => (int) $id])->row_array();

        if (!in_array($comments['item_id'], $this->comments_product_id)) {
            $this->comments_product_id[] = $comments['item_id'];
        }
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setVoutesAfterDelete() {

        foreach ($this->comments_product_id as $item) {

            $query = $this->db->select('SUM(rate) AS rate , COUNT(rate) AS votes')
                ->from('comments')
                ->where('item_id', (int) $item)
                ->where('rate >', 0)
                ->get();

            $mod_shop = $this->db->get_where('comments', ['item_id' => $item, 'module' => 'shop']);

            /* Если коментарии относятся к shop  тогда записываем рейтинг */
            if ($mod_shop->num_rows() > 0) {

                $rate = 0;
                $votes = 0;

                /** Если значений больше 0 вставляем их в rate и votes */
                if ($query->num_rows() > 0) {
                    list($rate, $votes) = array_values($query->row_array());

                }

                $products = SProductsRatingQuery::create()
                    ->findOneByProductId($item);
                $products->setVotes($votes);
                $products->setRating($rate);
                $products->save();

            }
        }

    }

    /**
     * @param int $status
     * @return int
     */
    public function count_by_status($status = 0) {
        $this->db->where('status', $status);
        $this->db->from('comments');

        return $this->db->count_all_results();
    }

    /**
     * @return array
     */
    public function get_settings() {
        $this->db->where('name', 'comments');
        $query = $this->db->get('components')->row_array();

        return unserialize($query['settings']);
    }

    /**
     * @param array $data
     */
    public function save_settings($data) {
        $this->db->where('name', 'comments');
        $this->db->update('components', ['settings' => serialize($data)]);
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function get_many($ids) {
        if (is_array($ids)) {
            return $this->db->where_in('id', $ids)->get('comments')->result_array();
        }
    }

    /**
     * @param int $id
     * @return int
     */
    public function get_count_comments($id) {

        /** @var CI_DB_result $test */
        $test = $this->db->select('COUNT(id) as count')
            ->from('comments')
            ->where('item_id', $id)
            ->where('status', 0)
            ->get();

        $count = $test->num_rows() > 0 ? $test->row()->count : 0;

        return $count;
    }

}

/* End of base.php */
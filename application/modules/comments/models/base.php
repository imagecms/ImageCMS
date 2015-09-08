<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Base extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param string $module
     * @param string $order_by
     */
    public function get($item_id, $status = 0, $module, $limit = 999999, $order_by) {
        $this->db->where('item_id', $item_id);
        $this->db->where('status', $status);
        $this->db->where('module', $module);

        $order_by = $order_by ? $order_by : 'date.desc';
        $order_column = array_shift(explode('.', $order_by));
        $order_way = array_pop(explode('.', $order_by));
        $this->db->order_by($order_column, $order_way);
        $query = $this->db->get('comments', $limit);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return FALSE;
    }

    public function get_one($id) {
        $this->db->limit(1);
        return $this->db->get_where('comments', array('id' => $id))->row_array();
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

    public function update($id, $data = array()) {
        $this->db->where('id', $id);
        $this->db->update('comments', $data);

        return TRUE;
    }

    public function setYes($id) {
        $row = $this->db->where('id', $id)->get('comments')->row();
        $like = $row->like + 1;
        $data = array('like' => $like);
        $this->db->where('id', $id);
        $res = $this->db->update('comments', $data);
        return $res ? $like : false;
    }

    public function setNo($id) {
        $row = $this->db->where('id', $id)->get('comments')->row();
        $disslike = $row->disslike + 1;
        $data = array('disslike' => $disslike);
        $this->db->where('id', $id);
        $res = $this->db->update('comments', $data);
        return $res ? $disslike : false;
    }

    public function delete($id) {
        if (is_array($id)) {
            $this->db->where_in('id', $id);
            $this->db->delete('comments');
            //delete child comments
            $this->db->where_in('parent', $id);
            $this->db->delete('comments');
        } else {
            $this->db->limit(1);
            $this->db->where('id', $id);
            $this->db->delete('comments');
            //delete child comments
            $this->db->where('parent', $id);
            $this->db->delete('comments');
        }
        return TRUE;
    }

    public function count_by_status($status = 0) {
        $this->db->where('status', $status);
        $this->db->from('comments');

        //        if($status == 0)
        //            var_dumps($this->db->get()->result_array());

        return $this->db->count_all_results();
    }

    public function get_settings() {
        $this->db->where('name', 'comments');
        $query = $this->db->get('components')->row_array();

        return unserialize($query['settings']);
    }

    public function save_settings($data) {
        $this->db->where('name', 'comments');
        $this->db->update('components', array('settings' => serialize($data)));
    }

    public function get_many($ids) {
        if (is_array($ids)) {
            return $this->db->where_in('id', $ids)->get('comments')->row_array();
        }
    }

}

/* End of base.php */
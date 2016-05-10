<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Custom_scripts_model extends CI_Model
{

    /**
     * @param $position 1 /body| -1 /header
     * @return string|null
     */
    public function getScript($position = 1) {
        $query = $this->db->select('value')->where('position', $position)->get('custom_scripts');

        return $query->num_rows() ? $query->row_array()['value'] : null;

    }

    /**
     * @param $position 1 /body| -1 /header
     * @param string $script
     * @return null|string
     * @throws Exception
     */
    public function saveScript($position, $script) {
        if (!in_array($position, [1, -1])) {
            throw new Exception('Undefined position');
        }

        $query = $this->db->select('value')->where('position', $position)->get('custom_scripts');

        $create = $query->num_rows() < 1;

        $this->db->set('value', trim($script));
        if ($create) {
            $this->db->set('position', $position);
            $this->db->insert('custom_scripts');
        } else {
            $this->db->where('position', $position);
            $this->db->update('custom_scripts');
        }

    }

}
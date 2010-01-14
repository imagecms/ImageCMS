<?php

    function page_tags($page_id = 0)
    {
        $ci =& get_instance();

        $ci->db->select('value');
        $ci->db->where('page_id', $page_id);
        $query = $ci->db->get('content_tags');

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }else{
            return FALSE;
        }
    }

/* End of tags_helper.php  */

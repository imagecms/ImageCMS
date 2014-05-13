<?php

if (!function_exists('page_tags'))
{
    function page_tags($page_id = 0)
    {
        $ci =& get_instance();

        $ci->db->select('tag_id');
        $ci->db->where('page_id', $page_id);
        $query = $ci->db->get('content_tags');

        if ($query->num_rows() > 0)
        {
            // get page tags
            $tags = array();

            foreach ($query->result_array() as $key)
            {
                $tags[] = $key['tag_id'];
            }

            if (count($tags) > 0)
            {
                $ci->db->where_in('id', $tags);
                return $ci->db->get('tags')->result_array();
            }
        }
        
        
        return FALSE;
    }
}

/* End of tags_helper.php  */

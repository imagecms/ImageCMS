<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('gallery_latest_images'))
{
    // Get gallery latest uploaded fotos
    // return array
	function gallery_latest_images($count = 5, $order = 'latest')
    {
        $ci =& get_instance();

        if ($count > 0)
        {
            $ci->db->limit((int) $count);

            if ($order == 'latest')
                $ci->db->order_by('uploaded', 'DESC');
            elseif($order=='random')
                $ci->db->order_by('uploaded', 'RANDOM');
            else
                $ci->db->order_by('uploaded', 'DESC');

            $query = $ci->db->get('gallery_images');

            if ($query->num_rows() > 0)
            {
                $result = $query->result_array(); 

                for ($i=0;$i<count($result);$i++)
                {
                    $result[$i]['url']  = 'gallery/album/'.$result[$i]['album_id'].'/image/'.$result[$i]['id'];
                    $result[$i]['file_path'] = 'uploads/gallery/'.$result[$i]['album_id'].'/'.$result[$i]['file_name'].'_prev'.$result[$i]['file_ext'];
                }

                return $result;
            }
            else
            {
                return array();
            }
        }
    }
}

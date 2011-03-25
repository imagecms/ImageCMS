<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//error_reporting(0);

/**
 * Image CMS
 *
 * Imagebox module.
 */

class Admin extends MY_Controller {

    public $settings = array(
            'upload_folder' => './uploads/imagebox/',
            'thumbs_folder' => './uploads/imagebox/thumbs/',
            'max_width' => '800',
            'max_height' => '600',
            'thumb_width' => '100',
            'thumb_height' => '100',
            'allowed_types'       => 'gif|jpg|jpeg|png',
            'maintain_ratio' => TRUE,
            'quality' => '95%',
            'link_rel' => 'lightbox',
        );

	function __construct()
	{
		parent::__construct();

        $this->load->library('DX_Auth');
        cp_check_perm('module_admin'); 

        $settings = $this->get_settings();

        if (is_array($settings))
        {
            foreach($settings as $k => $v)
            {
                $this->settings[$k] = $v;
            }
        }
	}

    /**
     * Display install settings
     */
    public function index()
    {
        $this->display_tpl('install');
    }

	public function main()
    {
        $this->template->add_array(array(
                'settings' => $this->settings
            ));

	    $this->display_tpl('main_window');
	}

    public function upload()
    {
        $this->load->library('image_lib'); 

        if ($_POST['file_url'] != '')
        {
            $url = $this->input->post('file_url');

            $ext = end(explode('.', $url));

            if (strstr($this->settings['allowed_types'], $ext) == FALSE)
            {
                echo 'Error: Вы пытаетесь загрузить запрещенный тип файла.';
                return;
            }
            

            $p = @fopen($url, 'rb');
            
            if (!$p)
            {
                echo 'Error: Ошибка загрузки файла.';
                return;
            }

            $image_data = stream_get_contents($p);
            fclose($p);

            $this->load->helper('file');

            $name = md5( time() ).'.'.$ext;
            write_file($this->settings['upload_folder'].$name, $image_data);

            $sizes = $this->get_image_size( $this->settings['upload_folder'].$name );

            $file = array(
                    'image_width'  => $sizes['width'],
                    'image_height' => $sizes['height'],
                    'full_path'    => $this->settings['upload_folder'].$name,
                    'file_name'    => $name,
                );
        }
        else
        {   
            $config['upload_path']   = $this->settings['upload_folder'];
            $config['allowed_types'] = $this->settings['allowed_types'];
            //$config['max_size']      = 1024 * 1024 * $this->max_file_size;
            
            $this->load->library('upload', $config);
        
            if ( ! $this->upload->do_upload())
            {
                echo 'Error: '. $this->upload->display_errors('', '');
                return;
            }	
            else
            {
                $file = $this->upload->data();
        }
        }

        $this->_resize($file);

        $thumb_img_url = $this->settings['thumbs_folder'].$file['file_name'];
        $link_url      = $this->settings['upload_folder'].$file['file_name'];

        echo '<a href="'.$link_url.'" rel="'.$this->settings['link_rel'].'" ><img src="'.$thumb_img_url.'" /></a>'; 
    }


    private function _resize($file)
    {
        if ($file['image_width'] > $this->settings['max_width'] OR $file['image_height'] > $this->settings['max_height']) 
        {
            $config['image_library']  = 'gd2';
            $config['source_image']   = $file['full_path'];
            $config['maintain_ratio'] = $this->settings['maintain_ratio'];
            $config['width']          = $this->settings['max_width'];
            $config['height']         = $this->settings['max_height'];
            $config['quality']        = $this->settings['quality'];

            $this->image_lib->clear(); 
            $this->image_lib->initialize($config); 
            $this->image_lib->resize();
        }

        $config['image_library']  = 'gd2';
        $config['source_image']   = $file['full_path'];
        $config['new_image']      = $this->settings['thumbs_folder'].$file['file_name'];
        $config['maintain_ratio'] = $this->settings['maintain_ratio'];
        $config['width']          = $this->settings['thumb_width'];
        $config['height']         = $this->settings['thumb_height'];
        $config['quality']        = $this->settings['quality'];

        $this->image_lib->clear(); 
        $this->image_lib->initialize($config); 
        $this->image_lib->resize();
    }

    /**
     * Get image width and height
     */
    private function get_image_size($file_path)
    {
		if (function_exists('getimagesize'))
		{
			$image = @getimagesize($file_path);

            $size = array(
                'width'  => $image[0],
                'height' => $image[1]
                );

			return $size;
        }

        return FALSE;
    }

    public function get_settings()
    {
        $this->db->where('name', 'imagebox');
        $query = $this->db->get('components')->row_array();

        return unserialize($query['settings']);
    }

    public function save_settings()
    {
        $data = array(
            'max_width'      => (int)$this->input->post('max_width'),
            'max_height'     => (int)$this->input->post('max_height'),
            'thumb_width'    => (int)$this->input->post('thumb_width'),
            'thumb_height'   => (int)$this->input->post('thumb_height'),
            'maintain_ratio' => (bool)$this->input->post('maintain_ratio'),
            'quality'        => $this->input->post('quality'),
            );

        $this->db->where('name', 'imagebox');
        $this->db->update('components', array('settings' => serialize($data)));

        showMessage('Изменения сохранены.');
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file =  realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

}

/* End of file admin.php */

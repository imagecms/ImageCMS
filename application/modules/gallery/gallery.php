<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Gallery module
 * Need Imagebox module
 */

class Gallery extends MY_Controller {

    public $conf = array(
        'upload_url'    => 'uploads/gallery/',
        'thumbs_folder' => '_thumbs',
        );

    private $settings = array();

	function __construct()
	{
        parent::__construct();

        $this->load->module('core');
        $this->load->model('gallery_m');

        // Load gallery settings
        $this->settings = $this->gallery_m->load_settings();
	}

    function autoload()
    {
        $this->load->helper('gallery');
        $this->load->module('imagebox')->autoload();
    }
    

    /**
     * List categories and get albums from first category
     */
	function index()
	{
        $categories = $this->gallery_m->get_categories($this->settings['order_by'], $this->settings['sort_order']);
        $albums = $this->gallery_m->get_albums($this->settings['order_by'], $this->settings['sort_order']);

        // Get covers
        if (is_array($albums))
        {
            $this->template->add_array(array(
                'albums'           => $this->create_albums_covers($albums),
                'gallery_category' => $categories
                ));
        }

        $this->display_tpl('albums');
    }

    /**
     * Display category albums
     */
    function category($id = 0)
    {
        $category = $this->gallery_m->get_category($id);

        if ($category === FALSE)
        {
            redirect('gallery');
        }
        else
        {
            $albums = $this->gallery_m->get_albums($this->settings['order_by'], $this->settings['sort_order'], $category['id']); 

            if ($albums !== FALSE)
            {
                $albums = $this->create_albums_covers($albums);
            }

            $this->template->add_array(array(
                'albums'           => $albums,
                'current_category' => $category,
                'gallery_category' => $this->gallery_m->get_categories($this->settings['order_by'], $this->settings['sort_order']), 
            ));

            $this->display_tpl('albums');
        }
    }

    // Display album images
    function album($id = 0)
    {
        $album = $this->gallery_m->get_album($id);
	if ($this->uri->total_segments() > 5 )
	    $params =  $this->uri->uri_to_assoc(5);
	else
	    $params =  $this->uri->uri_to_assoc(4);
	    
        if ($album == FALSE)
        {
            show_error('Can\'t load album.');
        }
        else
        {
            // Get preview image
            if ($params['image'] > 0)
            {
                $n = 0;
                foreach ($album['images'] as $image)
                {
                    if ($image['id'] == $params['image'])
                    {
                        $prev_img = $image;
                        
                        // Create prev/next links
                        $next = $album['images'][$n + 1];
                        $prev = $album['images'][$n - 1];
                        
                        $current_pos = $n + 1;
                    }
                    $n++;
                }
            }
            else
            {
                // Display first image prev
                $prev_img = $album['images'][0];

                $next = $album['images'][1];
                $prev = NULL;
                $current_pos = 1;
            }

            if ($prev_img == NULL)
            {
                $this->core->error_404();
                exit;
            }

            $prev_img['url'] = $this->conf['upload_url'] . $album['id'] .'/'. $prev_img['file_name'] .'_prev'. $prev_img['file_ext'];

            // Comments
            $this->load->module('comments');
            $this->comments->module = 'gallery';
            $this->comments->comment_controller = 'gallery/post_comment';
            $this->comments->build_comments($prev_img['id']);

            $this->template->add_array(array(
                'album'      => $album,
                'thumb_url'  => $this->conf['upload_url'] . $album['id'] . '/' . $this->conf['thumbs_folder'] . '/',
                'album_link' => 'gallery/album/' . $album['id'] . '/', 
                'album_url'  => $this->conf['upload_url'] . $album['id'] . '/',
                'prev_img'   => $prev_img,
                'next'       => $next,
                'prev'       => $prev,
                'current_pos'=> $current_pos,

                'current_category' => $this->gallery_m->get_category($album['category_id']), 
                'gallery_category' => $this->gallery_m->get_categories($this->settings['order_by'], $this->settings['sort_order']),
            ));

            $this->gallery_m->increase_image_views($prev_img['id']);
           
            $this->core->set_meta_tags(array($album['name'])); 

            $this->display_tpl('album');
        }
    }

    function thumbnails($id = 0)
    {
        $album = $this->gallery_m->get_album($id);

        if ($album == FALSE)
        {
            $this->core->error_404();
            exit;
        }

        $this->template->add_array(array(
            'album'      => $album,
            'thumb_url'  => $this->conf['upload_url'] . $album['id'] . '/' . $this->conf['thumbs_folder'] . '/',
            'album_link' => 'gallery/album/' . $album['id'] . '/', 
            'album_url'  => $this->conf['upload_url'] . $album['id'] . '/',
            'current_category' => $this->gallery_m->get_category($album['category_id']),
        ));
      
        $this->core->set_meta_tags(array($album['name']));

        $this->display_tpl('thumbnails');
    }

    function post_comment()
    {
        $image_id = (int) $this->input->post('comment_item_id');
 
        $this->load->module('comments');
        $this->comments->module = 'gallery';

        if ($this->db->get_where('gallery_images', array('id' => $image_id))->num_rows() > 0)
        {
            $this->comments->add($image_id);
        }
        else
        {
            $this->core->error_404();
        }
    }

    // Create cover url to each album
    function create_albums_covers($albums = array())
    {
        $cnt = count($albums);
        for($i = 0; $i < $cnt; $i++)
        {
            $thumb_url = $this->conf['upload_url'] . $albums[$i]['id'] .'/'. $this->conf['thumbs_folder'].'/';

            $albums[$i]['cover_url'] = media_url($thumb_url . $albums[$i]['cover_name'] . $albums[$i]['cover_ext']);

            if ($albums[$i]['cover_name'] == NULL)
            {
                $image = $this->gallery_m->get_last_image($albums[$i]['id']);

                $albums[$i]['cover_url'] = media_url($thumb_url . $image['file_name'] . $image['file_ext']);
            }
            else
            {
                 $albums[$i]['cover_url'] = media_url($thumb_url . $albums[$i]['cover_name'] . $albums[$i]['cover_ext']);
            }
        }

        return $albums;
    }

    // Install 
    function _install()
    {
    	if( $this->dx_auth->is_admin() == FALSE) exit;
        $this->load->model('install')->make_install();
    }

    // Delete module
    function _deinstall()
    {
        if( $this->dx_auth->is_admin() == FALSE) exit;
        $this->load->model('install')->deinstall();
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
    {
        /**
        if ( file_exists($this->template->template_dir . 'gallery') )
        {
            if ( file_exists($this->template->template_dir . 'gallery/main.tpl')   )
            {
                $this->template->add_array(array(
                        'content' => $this->template->fetch('gallery/' . $file),
                    ));

                $this->template->display('gallery/main');
            }
            else
            {
                $this->template->show('gallery/' . $file);
            }
        }
        else
        {
            $this->template->add_array(array(
                'content' => $this->fetch_tpl($file),
            ));

            $file = realpath(dirname(__FILE__)).'/templates/public/main.tpl';  
		    $this->template->display('file:' . $file);
        }
        **/

        $this->template->add_array(array(
                'content' => $this->fetch_tpl($file),
            ));

        if (file_exists(realpath(dirname(__FILE__)).'/templates/public/main.tpl'))
        {
            $file = realpath(dirname(__FILE__)).'/templates/public/main.tpl';  
		    $this->template->display('file:' . $file);
        }
        else
        {
            // Use main site template
            $this->template->show();
            exit;
        }
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
        $file =  realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

/* End of file gallery.php */

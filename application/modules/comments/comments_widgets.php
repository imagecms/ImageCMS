<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Comments widgets
 */

class Comments_Widgets extends MY_Controller {

    private $defaults = array(
            'comments_count' => 100,
            'symbols_count'  => 0,
        );

   	public function __construct()
	{
		parent::__construct();
    } 

    // Get and display recent comments
    public function recent_comments($widget = array())
    {
        if ( $widget['settings'] == FALSE)
        {
            $settings = $this->defaults;
        }
        else
        {
            $settings = $widget['settings'];
        }

        $this->db->select('comments.*');
        $this->db->select('CONCAT_WS("", ,content.cat_url, content.url) as url', FALSE); // page full url
        $this->db->where('content.lang', $this->config->item('cur_lang'));
        $this->db->where('comments.module', 'core');
        $this->db->join('content','content.id = comments.item_id', 'left');
        $this->db->order_by('date', 'desc'); 
        $query = $this->db->get('comments', $settings['comments_count']);

        if ($query->num_rows() > 0)
        {
            $comments = $query->result_array();

            if ($settings['symbols_count'] > 0)
            {
                $cnt = count($comments);
                for ($i = 0; $i < $cnt; $i++) 
                {
                    if (mb_strlen($comments[$i]['text'], 'utf-8') > $settings['symbols_count'])
                    {
                        $comments[$i]['text'] = mb_substr($comments[$i]['text'], 0, $settings['symbols_count'], 'utf-8').'...';                     
                    }
                }
            }

            return $this->template->fetch('widgets/'.$widget['name'],  array('comments' => $comments) );
        }
    }

    // Configure widget settings
    public function recent_comments_configure($action = 'show_settings', $widget_data = array())
    {
        if( $this->dx_auth->is_admin() == FALSE) exit; // Only admin access 
 
        switch ($action)
        {
            case 'show_settings':
                $this->display_tpl('recent_comments_form', array('widget' => $widget_data));
            break;

            case 'update_settings':
                $this->form_validation->set_rules('comments_count', 'Количество комментариев', 'trim|required|is_natural_no_zero|min_length[1]');
                $this->form_validation->set_rules('symbols_count', 'Количество символов', 'required|trim|is_natural');

                if ($this->form_validation->run($this) == FALSE)
                {
                    showMessage( validation_errors() );
                }
                else{
                    $data = array(
                        'comments_count' => $_POST['comments_count'],
                        'symbols_count'  => $_POST['symbols_count']
                    ); 

                    $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
                    showMessage('Настройки сохранены.');
                }
            break;

            case 'install_defaults':
                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $this->defaults);            
            break;
        }
    }
    // Get and display recent product comments
    public function recent_product_comments($widget = array())
    {
        if ( $widget['settings'] == FALSE)
        {
            $settings = $this->defaults;
        }
        else
        {
            $settings = $widget['settings'];
        }

        $this->db->select('comments.*');
        $this->db->select('CONCAT_WS("", ,content.cat_url, content.url) as url', FALSE); // page full url
        $this->db->where('comments.module', 'shop');
        $this->db->join('content','content.id = comments.item_id', 'left');
        $this->db->order_by('date', 'desc'); 
        $query = $this->db->get('comments', $settings['comments_count']);


        if ($query->num_rows() > 0)
        {
            $comments = $query->result_array();

            if ($settings['symbols_count'] > 0)
            {
                $cnt = count($comments);
                for ($i = 0; $i < $cnt; $i++) 
                {
                    if (mb_strlen($comments[$i]['text'], 'utf-8') > $settings['symbols_count'])
                    {
                        $comments[$i]['text'] = mb_substr($comments[$i]['text'], 0, $settings['symbols_count'], 'utf-8').'...';                     
                    }
                }
            }

            return $this->template->fetch('widgets/'.$widget['name'],  array('comments' => $comments) );
        }
    }

    // Configure widget settings
    public function recent_product_comments_configure($action = 'show_settings', $widget_data = array())
    {
        if( $this->dx_auth->is_admin() == FALSE) exit; // Only admin access 
 
        switch ($action)
        {
            case 'show_settings':
                $this->display_tpl('recent_product_comments_form', array('widget' => $widget_data));
            break;

            case 'update_settings':
                $this->form_validation->set_rules('comments_count', 'Количество отзывов', 'trim|required|is_natural_no_zero|min_length[1]');
                $this->form_validation->set_rules('symbols_count', 'Количество символов', 'required|trim|is_natural');

                if ($this->form_validation->run($this) == FALSE)
                {
                    showMessage( validation_errors() );
                }
                else{
                    $data = array(
                        'comments_count' => $_POST['comments_count'],
                        'symbols_count'  => $_POST['symbols_count']
                    ); 

                    $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
                    showMessage('Настройки сохранены.');
                }
            break;

            case 'install_defaults':
                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $this->defaults);            
            break;
        }
    } 

    // Template functions
	function display_tpl($file, $vars = array())
    {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

	function fetch_tpl($file, $vars = array())
    {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

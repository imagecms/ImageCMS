<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 * Widget manager class
 */ 

class Widgets_Manager extends MY_Controller {

	public function __construct()
	{
        parent::__construct();

		$this->load->library('DX_Auth');
        admin_or_redirect(); 

		$this->load->library('lib_admin');
		$this->lib_admin->init_settings();
    }

    /**
     * Display widgets list
     */ 
    public function index()
    {
        $this->_is_wratible();

        $this->db->order_by('created', 'desc');
        $query = $this->db->get('widgets');

        if ($query->num_rows() > 0)
        {
            $widgets = $query->result_array();
            $cnt = count($widgets);

            for ($i = 0; $i < $cnt; $i++)
            {
                $form_file = APPPATH.'modules/'.$widgets[$i]['data'].'/templates/'.$widgets[$i]['method'].'_form.tpl';

                if ( file_exists(realpath($form_file)) )
                {
                    $widgets[$i]['config'] = TRUE;
                }
            }
        }


        $this->template->add_array(array(
            'widgets' => $widgets
            ));

        $this->template->show('widgets_list', FALSE);
    }

    /*
    * Check if widgets folder is wratible
    */
    private function _is_wratible()
    {
        $this->db->where('s_name', 'main');
        $this->db->select('site_template');
        $query = $this->db->get('settings')->row_array();

        $widgets_path = PUBPATH.'/templates/'.$query['site_template'].'/widgets/';

        if ( !is_really_writable($widgets_path) )
        {
            echo '<div id="notice_error">
                Для продолжения работы с виджетами установите права на запись директории <b>'.$widgets_path.'</b>
            </div>';
            exit;
        }
    }


    public function create()
    {
        cp_check_perm('widget_create'); 

        $this->load->library('form_validation');

        $type = $this->input->post('type');

        if ($this->db->get_where('widgets', array('name' => $this->input->post('name')))->num_rows() > 0)
        {
            showMessage('Виджет с таким именем уже создан. Укажите другое имя.', 'Ошибка');
            return FALSE;
        }
            
        if ($type == 'module')
        {
            $this->form_validation->set_rules('desc', 'Описание', 'trim|min_length[1]|max_length[500]');
            $this->form_validation->set_rules('name', 'Имя', 'trim|required|alpha_dash');
            $this->form_validation->set_rules('module', 'Модуль', 'trim|required');
            $this->form_validation->set_rules('method', 'Метод', 'trim|required');

            if ($this->form_validation->run($this) == FALSE)
            {
                showMessage (validation_errors());
            }else{
                $data = array(
                    'description' => $this->input->post('desc'),
                    'method' => $this->input->post('method'), 
                    'data' => $this->input->post('module'), // module name
                    'name' =>  $this->input->post('name'), 
                    'type' => $type,
                    'created' => time()
                    );

                $this->db->insert('widgets', $data);
                $data['id'] = $this->db->insert_id();

                // Copy widgets template
                $tpl_file = PUBPATH.'/'.APPPATH.'modules/'.$data['data'].'/templates/'.$data['method'].'.tpl';
    
                if ( file_exists($tpl_file) )
                {
                    // Get current template folder
                    $this->db->where('s_name', 'main');
                    $this->db->select('site_template');
                    $query = $this->db->get('settings')->row_array();

                    $this->load->helper('file');

                    $tpl_data = read_file($tpl_file);

                    write_file(PUBPATH.'/templates/'.$query['site_template'].'/widgets/'.$data['name'].'.tpl', $tpl_data);
                    chmod(PUBPATH.'/templates/'.$query['site_template'].'/widgets/'.$data['name'].'.tpl', '511');
                }

                // Try to install widget default settings
                $this->load->module($data['data'].'/'.$data['data'].'_widgets');
                $m = $data['method'].'_configure'; 

                if ( method_exists($data['data'].'_widgets', $m) )
                {
                    $module = $data['data'].'_widgets';
                    $this->$module->$m('install_defaults', $data);
                }

                $this->lib_admin->log('Создал виджет '.$data['name']);

                //showMessage('Виджет создан.');
                updateDiv('page', site_url('admin/widgets_manager'));
            }
        }elseif ($type == 'html') {

            $this->form_validation->set_rules('desc', 'Описание', 'trim|min_length[1]|max_length[500]');
            $this->form_validation->set_rules('name', 'Имя', 'trim|required|alpha_dash');
            $this->form_validation->set_rules('html_code', 'HTML', 'trim|required');
            
            if ($this->form_validation->run($this) == FALSE)
            {
                showMessage (validation_errors());
            }else{
                $data = array(
                    'description' => $this->input->post('desc'),
                    'data' => $this->input->post('html_code'), 
                    'name' =>  $this->input->post('name'), 
                    'type' => $type,
                    'created' => time()
                );

                $this->lib_admin->log('Создал виджет '.$data['name']);

                $this->db->insert('widgets', $data);

                updateDiv('page', site_url('admin/widgets_manager'));
            }
        }
    }

    /**
     * Display widget_create.tpl
     */
    public function create_tpl()
    {
        cp_check_perm('widget_create');

        $this->template->show('widget_create', FALSE);
    }

    public function edit($id)
    {
        cp_check_perm('widget_access_settings');

        $widget = $this->get($id);

        if ($widget->num_rows() == 1)
        {
            $widget = $widget->row_array();

            if($widget['type'] == 'module')
            {
                $widget['settings'] = unserialize($widget['settings']);
                echo modules::run($widget['data'].'/'.$widget['data'].'_widgets/'.$widget['method'].'_configure' , array('show_settings', $widget));

            }elseif($widget['type'] == 'html'){
            }
        }else{
            show_error('Error: widget not found!');
        }
    }

    public function update_widget($id, $update_info = FALSE)
    {
        cp_check_perm('widget_access_settings');

        $widget = $this->get($id);

        if ($widget->num_rows() == 1)
        {
            $widget = $widget->row_array();

            if ($update_info == 'info')
            {
                $this->form_validation->set_rules('desc', 'Описание', 'trim|min_length[1]|max_length[500]');
                $this->form_validation->set_rules('name', 'Имя', 'trim|required|alpha_dash');
            
                if ($this->form_validation->run($this) == FALSE)
                {
                    showMessage (validation_errors());
                    return FALSE;
                }

                $data = array(
                    'description' => $_POST['desc'],
                    'name' =>  $this->input->post('name')
                    );

                $this->db->where('id', $widget['id']);
                $this->db->update('widgets', $data);

                $this->lib_admin->log('Изменил виджет '.$data['name']);

                showMessage('Изменения сохранены');
                return TRUE;
            }

            if($widget['type'] == 'module')
            {
                $widget['settings'] = unserialize($widget['settings']);
                echo modules::run($widget['data'].'/'.$widget['data'].'_widgets/'.$widget['method'].'_configure', array('update_settings', $widget));

            }elseif($widget['type'] == 'html'){

            $this->form_validation->set_rules('desc', 'Описание', 'trim|min_length[1]|max_length[500]');
            $this->form_validation->set_rules('name', 'Имя', 'trim|required|alpha_dash');
            $this->form_validation->set_rules('html_code', 'HTML', 'trim|required');
            
            if ($this->form_validation->run($this) == FALSE)
            {
                showMessage (validation_errors());
                return FALSE;
            }
        
                $data = array(
                    'description' => $_POST['desc'],
                    'data' => $this->input->post('html_code'), 
                    'name' =>  $this->input->post('name'), 
                    //'type' => $type,
                    //'created' => time()
                );

                $this->db->where('id', $id);
                $this->db->update('widgets', $data);

                $this->lib_admin->log('Изменил виджет '.$data['name']);

                //updateDiv('page', site_url('admin/widgets_manager'));
                showMessage('Изменения сохранены');
            }
        }else{
            show_error('Error: widget not found!');
        } 
    }

    // Update widget config
    public function update_config($id = FALSE, $new_settings =  array())
    {
        cp_check_perm('widget_access_settings');

        if ($id != FALSE AND count($new_settings) > 0)
        {
            $settings = serialize($new_settings);
            $this->db->where('id', $id);
            $this->db->update('widgets', array('settings' => $settings));
        }        
    }

    public function delete()
    {
        cp_check_perm('widget_delete'); 

        $name = $this->input->post('widget_name');

        $this->db->where('name', $name);
        $this->db->limit(1);
        $this->db->delete('widgets');

        $this->db->where('s_name', 'main');
        $this->db->select('site_template');
        $query = $this->db->get('settings')->row_array();

        if ( file_exists(PUBPATH.'/templates/'.$query['site_template'].'/widgets/'.$name.'.tpl') )
        {
            @unlink(PUBPATH.'/templates/'.$query['site_template'].'/widgets/'.$name.'.tpl'); 
        }

        $this->lib_admin->log('Удалил виджет '.$name);
    }

    public function get($id)
    {
        return $this->db->get_where('widgets', array('id' => $id));
    }

    public function edit_html_widget($id)
    {
        cp_check_perm('widget_access_settings');

        $widget = $this->get($id);

        $this->template->add_array(array(
            'widget' => $widget->row_array()
            ));

        $this->template->show('widget_edit_html', FALSE);
    }

    public function edit_module_widget($id)
    {
        cp_check_perm('widget_access_settings'); 

        $widget = $this->get($id);

        $this->template->add_array(array(
            'widget' => $widget->row_array()
            ));

        $this->template->show('widget_edit_module', FALSE);
    }

    /**
     * Search for aviable widgets in all modules except admin module
     */ 
    public function display_create_tpl($type = FALSE)
    {
        switch($type)
        {
            case 'module':
                $this->load->library('lib_xml');

                $modules = $this->db->get('components')->result_array();

                array_push($modules, array('name' => 'core')); // Add core module

                $widgets = array();

                foreach($modules as $k)
                {
                    $xml_file = realpath(PUBPATH.'/'.APPPATH.'modules/'.$k['name'].'/widgets.xml');   
                    $widgets_file = realpath(PUBPATH.'/'.APPPATH.'modules/'.$k['name'].'/'.$k['name'].'_widgets.php');    

                        if (file_exists($xml_file) AND file_exists($widgets_file))
                        {
                            $widgets[] = array(
                                'widgets' => $this->parse_widget_xml($k['name']),
                                'module' => $k['name'],
                                'module_name' => $this->get_module_name($k['name'])
                            );
                        }
                }

                $this->template->add_array(array(
                    'widgets' => $widgets
                    ));
        
                $this->template->show('widget_create_module', FALSE);
            break;

            case 'html':
                $this->template->show('widget_create_html', FALSE);
            break;
        }
    }

    /**
     * Get widget info title/description/method
     */
    private function parse_widget_xml($xml_folder)
    {
        if ($this->lib_xml->load('modules/'.$xml_folder.'/widgets')) 
        {
            $widgets_array = $this->lib_xml->parse();
            $info = $widgets_array['widgets'][0]['widget'];

            $return = array();

            foreach($info as $k => $v)
            {
                $temp = array(
                    'title' => $v['title'][0],
                    'description' => $v['description'][0],
                    'method' => $v['method'][0],
                );

                array_push($return, $temp);
            }

            if (count($return) > 0)
            {
                return $return;
            }
        } 

        return FALSE;
    }

    private function get_module_name($dir)
    {
        if ($dir == 'core')
        {
            return 'Ядро';
        }

        $info = $this->load->module('admin/components')->get_module_info($dir); 
        return $info['menu_name'];
    }


}

/* End of widgets.php */

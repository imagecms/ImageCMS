<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Image CMS
 * Components Class
 */

class Components extends MY_Controller{

	function __construct()
	{
		parent::__construct();

		$this->load->library('DX_Auth');
        admin_or_redirect();

		$this->load->library('lib_admin');
		$this->lib_admin->init_settings();
	}

	function index()
	{
		// index
	}

	function modules_table()
	{
		$not_installed = array();

		$fs_modules = $this->find_components();
		$db_modules = $this->db->get('components')->result_array();

		// Find not installed modules
		$count = count($fs_modules);
		for ($i = 0; $i < $count; $i++)
		{
			if ( $this->is_installed($fs_modules[$i]['com_name']) == 0 )
			{
				$info = $this->get_module_info( $fs_modules[$i]['com_name'] );

				$fs_modules[$i]['name'] = $info['menu_name'];
				$fs_modules[$i]['version'] = $info['version'];
				$fs_modules[$i]['description'] = $info['description'];

				array_push($not_installed,$fs_modules[$i]);
			}
		}

		// process modules info
		$count = count($db_modules);
		for ($i = 0; $i < $count; $i++)
		{
			$info = $this->get_module_info( $db_modules[$i]['name'] );

			$db_modules[$i]['menu_name'] = $info['menu_name'];
			$db_modules[$i]['version'] = $info['version'];
			$db_modules[$i]['description'] = $info['description'];
			$db_modules[$i]['identif'] = anchor($db_modules[$i]['identif'],$db_modules[$i]['identif']);

			if ( file_exists(APPPATH.'modules/'.$db_modules[$i]['name'].'/admin.php') )
			{
				$db_modules[$i]['admin_file'] = 1;
			}else{
				$db_modules[$i]['admin_file'] = 0;
			}
		}


		$this->template->assign('installed',$db_modules);
		$this->template->assign('not_installed',$not_installed);
		$this->template->show('module_table',FALSE);
	}

	function is_installed($mod_name)
	{
		return $this->db->get_where('components',array('name' => $mod_name),1)->num_rows();
	}

	function install($module = '')
	{
        cp_check_perm('module_install');

		$module = strtolower($module);

        ($hook = get_hook('admin_install_module')) ? eval($hook) : NULL;

		if ( file_exists(APPPATH.'modules/'.$module.'/'.$module.'.php') AND $this->is_installed($module) == 0 )
		{
			// Make module install
			$data = array(
			'name' => $module,
			'identif' => $module
			);

			$this->db->insert('components',$data);

			$this->load->module($module);

				if ( method_exists($module, '_install') === TRUE )
				{
					$this->$module->_install();
				}

            // Update hooks
            $this->load->library('cms_hooks');
            $this->cms_hooks->build_hooks();

            $this->lib_admin->log('Установил модуль '.$data['name']);

			//showMessage('Модуль Установлен');
            return TRUE;
		}
        else
        {
			//showMessage('Ошибка установки модуля.');
			return FALSE;
		}
	}

	function deinstall($module = '')
	{
        cp_check_perm('module_deinstall');

		$module = strtolower($module);

        ($hook = get_hook('admin_deinstall_module')) ? eval($hook) : NULL;

		if ( file_exists(APPPATH.'modules/'.$module.'/'.$module.'.php')  AND $this->is_installed($module) == 1 )
		{
			$this->load->module($module);

				if ( method_exists($module, '_deinstall') === TRUE )
				{
					$this->$module->_deinstall();
				}

			$this->db->limit(1);
			$this->db->delete('components',array('name' => $module));

            $this->lib_admin->log('Удалил модуль '.$module);

		}
        else
        {
			showMessage('Ошибка удаления модуля.');
		}

        // Update hooks
        $this->load->library('cms_hooks');
        $this->cms_hooks->build_hooks();

		$this->modules_table();
	}

	function find_components($in_menu = FALSE)
	{
        $components = array();
        if ($in_menu == TRUE) 
        {
            $this->db->where('in_menu', 1);
        }
        $installed  = $this->db->get('components')->result_array();

		if ($com_path = opendir(APPPATH.'modules/')) {
			while (false !== ($file = readdir($com_path))) {
				if ($file != "." && $file != ".." && $file != "index.html" && !is_file($file) )
				{
					$info_file = APPPATH.'modules/'.$file.'/module_info.php';
					$com_file_admin = APPPATH.'modules/'.$file.'/admin.php';

					if(file_exists($info_file))
					{
						include ($info_file);

						if(file_exists($com_file_admin))
						$admin_file = 1;
						else
						$admin_file = 0;

                        $ins = FALSE;

                        foreach($installed as $k)
                        {
                            if ($k['name'] == $file)
                            {
                                $ins = TRUE;
                            }
                        }

						$new_com = array(
										'menu_name' => $com_info['menu_name'],
										'com_name' => $file,
                                        'admin_file' => $admin_file,
                                        'installed' => $ins
										);
     
						array_push($components, $new_com);
					}
				}
			}
			closedir($com_path);
		}

		return $components;
	}

	function component_settings($component)
	{
        cp_check_perm('module_admin');

		$this->db->where('name', $component);
		$query = $this->db->get('components', 1);

		if ($query->num_rows() == 1)
		{
			$com = $query->row_array();
			$this->template->add_array($com);
		}else{
			$this->template->assign('com_name', $component);
			$this->template->assign('identif', $component);
			$this->template->assign('status', 0);
		}

		$this->template->show('component_settings', FALSE);
	}

	// Save component settings
	function save_settings($component)
	{
        cp_check_perm('module_admin');

		$this->db->where('name', $component);
		$query = $this->db->get('components',1);
        
        $com = $query->row_array();

        ($hook = get_hook('admin_component_save_settings')) ? eval($hook) : NULL;

		if ($query->num_rows() >= 1)
		{
			$data = array(
				'enabled' => (int)$this->input->post('status'),
				//'identif' => $this->input->post('identif'),
				'identif' => $com['name'],
				'autoload' => (int)$this->input->post('autoload'),
				'in_menu' => (int)$this->input->post('in_menu')
			);

			$this->db->where('name',$component);
			$this->db->update('components',$data);

            $this->lib_admin->log('Изменил настройки модуля '.$com['name']);

			//showMessage('Настройки сохранены');
		}else{
			// Error, module not found
		}

		jsCode("ajax_div('modules_table',base_url + 'admin/components/modules_table/');");

	}


	// Load component admin class in iframe/xhr
	function init_window()
	{
		// buildWindow($id,$title,$contentURL,$width,$height,$method = 'iframe')
		$module = $this->input->post('component');
		$info_file = realpath(APPPATH.'modules/'.$module).'/module_info.php';

		if(file_exists($info_file))
		{
			include_once ($info_file);

			switch($com_info['admin_type'])
			{
				case 'window':
				buildWindow($module.'_window','Модуль: '.$com_info['menu_name'],site_url('admin/components/cp/'.$module),$com_info['w'],$com_info['h'],$com_info['window_type']);
				break;

				case 'inside':
				updateDiv('page',site_url('admin/components/cp/'.$module));
				break;
			}
		}
	}

	function cp($module)
	{
		$func = $this->uri->segment(5);
		if($func == FALSE) $func = 'index';

        ($hook = get_hook('admin_run_module_panel')) ? eval($hook) : NULL;

		$this->load->module('core/core');
		$args = $this->core->grab_variables(6);

		$this->template->assign('SELF_URL',site_url('admin/components/cp/'.$module));

		echo '<div id="'.$module.'_module_block">'.modules::run($module.'/admin/'.$func,$args).'</div>';

		//ajax_links($module);
	}

    /** 
     * Run module
     */ 
	function run($module)
	{
        $func = $this->uri->segment(5);
		if($func == FALSE) $func = 'index';

        ($hook = get_hook('admin_run_module_admin')) ? eval($hook) : NULL;

		$this->load->module('core/core');
		$args = $this->core->grab_variables(6);

		$this->template->assign('SELF_URL',site_url('admin/components/cp/'.$module));

		echo modules::run($module.'/admin/'.$func, $args);
	}

	function com_info()
	{
		$com_info = $this->get_module_info($this->input->post('component'));

		if($com_info != FALSE)
		{
			$info_text = '<h1>'.$com_info['menu_name'].'</h1><p>'.$com_info['description'].'</p><p><b>Автор:</b> '.$com_info['author'].'<br/><b>Версия:</b> '.$com_info['version'].'</p>';

			jsCode("alertBox.info('".$info_text."');");

		}else{
			showMessage('Can\'t load module info file');
		}
	}

	function get_module_info($mod_name)
	{
       ($hook = get_hook('admin_get_module_info')) ? eval($hook) : NULL; 

		$info_file = realpath(APPPATH.'modules/'.$mod_name).'/module_info.php';
		if(file_exists($info_file))
		{
			include ($info_file);
			return $com_info;
		}else{
			return FALSE;
		}
	}


}

/* End of components.php */

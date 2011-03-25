<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Image CMS
 *
 */

class Mod_search extends MY_Controller {

    private $api_url = '';

	public function __construct()
	{
		parent::__construct();

		$this->load->library('DX_Auth');
        admin_or_redirect();


        $this->load->helper('file');

        $this->config->load('api');
        $this->api_url = $this->config->item('mod_search_api_url');

		$this->load->library('lib_admin');
		$this->load->library('lib_category');
		$this->lib_admin->init_settings(); 

        // set category list
        $request = $this->curl_post();
        $data = $request['result'];


        $this->template->add_array(array(
                    'categories' => $data['categories'],
                ));

        if (is_really_writable(APPPATH.'modules/'))
        {
            $this->template->assign('install_type', 'dir');
        }
        else
        {
            $this->template->assign('install_type', 'ftp');
        }
	}

    public function index()
    {
        $this->template->assign('action', 'main');
        $this->template->show('modules_search', FALSE);
    }

    public function category($id = 0, $offset = 0)
    {
        $request = $this->curl_post(array(
                'action'   => 'by_category', 
                'category' => $id,
                'offset'   => $offset,
            ));

        $data = $request['result']; 

        //Pagination
        $this->load->library('Pagination');

        $config['base_url']    = site_url('admin/mod_search/category/'.$id);
        $config['total_rows']  = $data['category_modules_count'];
        $config['per_page']    = $data['per_page'];
        $config['uri_segment'] = 5;

        $config['cur_tag_open']  = '<span class="active">';
        $config['cur_tag_close'] = '</span>';

        $this->pagination->num_links = 5;
        $this->pagination->initialize($config);
        $this->template->assign('pagination', $this->pagination->create_links_ajax());
        //End pagination

        $this->template->add_array(array(
                'action'              => 'list_modules',
                'modules'             => $data['modules'],
                'modules_count'       => $data['category_modules_count'],
                'download_url_prefix' => $data['download_url_prefix'],
                ));

        $this->template->show('modules_search', FALSE); 
    }

    public function display_install_window($id)
    {
        $request = $this->curl_post(array('action' => 'get_module', 'id' => (int) $id));
        $module_data = $request['result'];

        if ($module_data['module_data'] == FALSE)
        {
            echo 'Ошибка. Информация о модуле не найдена.';
            return;
        }

        $this->template->add_array(array(
                        'module' => $module_data['module_data'],
                    ));

        $this->template->show('mod_install', FALSE);
    }

    // Connect to ftp server
    public function connect_ftp($id)
    {
        cp_check_perm('module_install');

        if (is_really_writable(APPPATH.'modules/'))
        {
            $use_dir = TRUE;
        }
        else
        {
            $use_dir = FALSE;
        }

        if (!function_exists('ftp_connect') AND $use_dir == FALSE)
        {
            showMessage('Функция ftp_connect недоступна.');
            exit;
        }

        if ($use_dir == FALSE)
        {
            $this->load->library('ftp');

            $config['hostname'] = $_POST['host'];
            $config['username'] = $_POST['login'];
            $config['password'] = $_POST['password'];
            $config['port']     = $_POST['port'];
            $config['passive']  = FALSE;
            $config['debug']    = FALSE;

            if ($this->ftp->connect($config) == FALSE)
            {
                showMessage('Ошибка подключения к серверу. Проверте имя пользователя или пароль.');
            }
        }
        
        $this->load->helper('string');
        $this->load->helper('file');

        $root = '/'.trim_slashes($_POST['root_folder']).'/';

        if ($root == '//') $root = '/';

        // Try to find self.
        if ($use_dir == FALSE)
        {
            $list = $this->ftp->list_files($root.'application/modules/admin');

            $error = TRUE;
            foreach($list as $k => $v)
            {
                if ($v == 'mod_search.php')
                {
                    $error = FALSE;
                }
            }

            if ($error == TRUE)
            {
                showMessage('Ошибка. Не правильный путь к корневой директории.');
                exit;
            }
            else
            {
                // Store connection settings in cookie or db;
            }
        }

        //Download module zip file to tmp folder 
        $request = $this->curl_post(array('action' => 'get_module', 'id' => (int) $id));
        $module_data = $request['result']['module_data'];

        if(($fh = fopen($module_data['file'], 'r')) == FALSE)
        {
            showMessage('Ошибка загрузки файла.');
        }
        else
        {
            $name = end(explode('/', $module_data['file']));
            $name = explode('.', $name);
            $name = $name[0];

            $tmp_folder = './system/cache/';

            // Delete temp dir
            @delete_files($tmp_folder.$name.'/', TRUE);
            @rmdir($tmp_folder.$name.'/');

            // Download file
            $contents = stream_get_contents($fh);

            // Save file
            write_file($tmp_folder.$name.'.zip', $contents);

            // Create temp folder
            if ($use_dir == FALE)
            {
                if ( ! mkdir($tmp_folder.$name.'/'))
                {
                    showMessage('Ошибка создания временной директории.');
                    fclose($fh);

                    if ($use_dir == FALSE)
                        $this->ftp->close();

                    exit;
                }
            }

            // Uzip module files        
            $zip_file = $tmp_folder.$name.'.zip';

            $this->load->library('pclzip', $zip_file);

            if ($use_dir == TRUE)
            {
                if (!file_exists(APPPATH.'modules/'.$name))
                {
                    mkdir(APPPATH.'modules/'.$name);
                    chmod(APPPATH.'modules/'.$name, 0777);
                }
                else
                {
                    showMessage('Для продолжения уставки удалите директорию '.APPPATH.'modules/'.$name);
                    exit;
                }

                if (($zip_result = $this->pclzip->extract(PCLZIP_OPT_PATH, APPPATH.'modules/'.$name.'/')) == 0)
                {
                    showMessage('Ошибка извлечения файлов из архива.');
                    exit;
                }

                $this->chmod_r(APPPATH.'modules/'.$name);

                // Make install
                $this->load->module('admin/components');
            
                if (!$this->components->install($name))
                {
                    showMessage('Ошибка установки модуля.');
                }

                // Delete temp dir
                @delete_files($tmp_folder.$name.'/', TRUE);
                @rmdir($tmp_folder.$name.'/');

                // Delete temp .zip file
                @unlink($tmp_folder.$name.'.zip');

                showMessage('Модуль установлен.');

                // Close install window
                closeWindow('mod_install_w');

                exit; 
            }

            if (($zip_result = $this->pclzip->extract(PCLZIP_OPT_PATH, $tmp_folder.$name.'/')) == 0)
            {
                showMessage('Ошибка извлечения файлов из архива.');
            }
            else
            {
                // Files extracted
                
                // Create module folder
                $dest_folder = $root.'application/modules/'.$name.'/'; 

                if ($use_dir == FALSE)
                {
                    $this->ftp->mkdir($dest_folder);
                }

                // Copy file to modules folder
                if ($use_dir == FALSE)
                {
                    if (!$this->ftp->mirror($tmp_folder.$name.'/', $dest_folder))
                    {
                        showMessage('Ошибка создания временной директории.'); 
                    }
                }

                // Make install
                $this->load->module('admin/components');
            
                if (!$this->components->install($name))
                {
                    showMessage('Ошибка установки модуля.');
                }

                // Delete temp dir
                @delete_files($tmp_folder.$name.'/', TRUE);
                @rmdir($tmp_folder.$name.'/');

                // Delete temp .zip file
                @unlink($tmp_folder.$name.'.zip');

                showMessage('Модуль установлен.');

                // Close install window
                closeWindow('mod_install_w');
            }

            fclose($fh);
        }

        if ($use_dir == FALSE)
            $this->ftp->close();
        
    }
   
    private function curl_post($data = array()) 
    {
        $url = $this->api_url;

        $options = array();
        $options[CURLOPT_HEADER]         = FALSE;
        $options[CURLOPT_RETURNTRANSFER] = TRUE;
        $options[CURLOPT_POST]           = TRUE;
        $options[CURLOPT_POSTFIELDS]     = $data;

        $handler = curl_init($url);

        curl_setopt_array($handler, $options);
        $resp = curl_exec($handler);

        $result['code']   = curl_getinfo($handler, CURLINFO_HTTP_CODE);
        $result['result'] = unserialize($resp);
        $result['error']  = curl_errno($handler);

        curl_close($handler);
        return $result; 
    }

    private function chmod_r($path, $perm = 0777)
    {
        $h = opendir($path);
        while ($file = readdir($h) )
        {
            if (($file != '.') && ($file != '..') && ($file != 'index.html') )
            {
                if (is_dir($file))
                {
                    $this->chmod_r($path.'/'.$file, $perm);
                }

                chmod ($path.'/'.$file, $perm);
            }
        }
    }

}

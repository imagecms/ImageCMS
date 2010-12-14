<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Install extends Controller {

    public $host  = '';
    public $useSqlFile = 'sqlSite.sql'; // sqlShop.sql
    private $exts = FALSE;

	public function __construct()
	{
        error_reporting(0);
        parent::__construct();

        $this->host = 'http://'.str_replace('index.php', '',$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']).'index.php/';
        $this->load->helper('string');
        $this->host = reduce_multiples($this->host);
        $this->load->language('main', 'russian');
	}

    public function index()
    {
        $data = array(
                'content' => $this->load->view('license', array('next_link' => $this->host.'install/step_1' ), TRUE),
            );
        $this->load->view('main', $data);
    }

	public function step_1()
    { 
        $result = TRUE;

        // Check folders permissions
        $dir_array = array(
                './application/config/config.php' => 'ok',
                './system/cache'       => 'ok',
                './system/cache/templates_c' => 'ok',
                './uploads/'           => 'ok',
                './uploads/images'     => 'ok',
                './uploads/files'      => 'ok',
                './uploads/media'      => 'ok',
            );

        foreach ($dir_array as $k => $v)
        {
            if ( is_really_writable($k) === TRUE )
            {
                $dir_array[$k] = 'ok';
            }
            else
            {
                $dir_array[$k] = 'err';
                $result = FALSE;
            }
        }

        // Check server params

        $allow_params = array(
            'register_globals' => 'ok',
            'safe_mode'        => 'ok',
        );

        foreach($allow_params as $k => $v)
        {
            if ( ini_get($k) == 1 )
            {
                $allow_params[$k] = 'warning';
            }else{
                $allow_params[$k] = 'ok';
            }
        }

        // Check installed php exts.
        $exts = array(
            'curl' => 'ok',
            'json' => 'ok',
            'mbstring' => 'ok',
            'iconv' => 'ok',
            'gd' => 'ok',
            'zlib' => 'ok',
            );

        foreach($exts as $k => $v)
        {
            if ( $this->_get_ext($k) === FALSE )
            {
                $exts[$k] = 'warning';

                if ($k == 'json')
                {
                    $exts[$k] = 'err';
                    $result = FALSE;
                }

                if ($k == 'mbstring')
                {
                    $exts[$k] = 'err';
                    $result = FALSE;
                }

                if ($k == 'curl')
                {
                    $exts[$k] = 'err';
                    $result = FALSE;
                }
            }
        }

        $data = array(
            'dirs'         => $dir_array,
            'need_params'  => $need_params,
            'allow_params' => $allow_params,
            'exts'         => $exts,
            'next_link'    => $this->_get_next_link($result, 1),
            );
		$this->_display( $this->load->view('step_1', $data, TRUE) );
    }

    private function _get_ext($name = '')
    {
        if ($this->exts === FALSE)
        {
            ob_start();
            phpinfo(INFO_MODULES);
            $this->exts = ob_get_contents();
            ob_end_clean();
            $this->exts = strip_tags($this->exts,'<h2><th><td>');
        }

        $result = preg_match("/<h2>.*$name.*<\/h2>/", $this->exts, $m);

        if (count($m) == 0)
        {
            return FALSE;
        }

        return TRUE;
    }

    public function step_2()
    {
        $this->load->library('Form_validation');
        $this->form_validation->set_error_delimiters('', '');
        
        $result = TRUE;
        $other_errors = '';

        if (count($_POST) > 0)
        {
            $this->form_validation->set_rules('host_name', 'Домен', 'required');
            $this->form_validation->set_rules('site_title', 'Название сайта', 'required');
            $this->form_validation->set_rules('db_host', 'Хост', 'required');
            $this->form_validation->set_rules('db_user', 'Имя пользователя БД', 'required');
            //$this->form_validation->set_rules('db_pass', 'Пароль БД', 'required');
            $this->form_validation->set_rules('db_name', 'Имя БД', 'required');
            $this->form_validation->set_rules('admin_login', 'Логин администратора', 'required|min_length[4]');
            $this->form_validation->set_rules('admin_pass', 'Пароль администратора', 'required|min_length[4]');
            $this->form_validation->set_rules('admin_mail', 'Почта администратра', 'required|valid_email');

            if ($this->form_validation->run() == FALSE)
            {
                $result = FALSE;
            }
            else
            {
                // Test database conn.
                if( $this->test_db() == FALSE )
                {
                    $other_errors .= 'Ошибка подключения к базе данных.<br/>';
                    $result = FALSE;
                }
            }

            if ($result == TRUE)
            {
                $this->make_install();
            }
        }

        $data = array(
            'next_link'    => $this->_get_next_link($result, 2),
            'other_errors' => $other_errors,
            'host'         => $this->host,
            );
		$this->_display( $this->load->view('step_2', $data, TRUE) );
    }

    private function make_install()
    {
        $this->load->helper('file');
        $this->load->helper('url');

        $db_server = $this->input->post('db_host');
        $db_user   = $this->input->post('db_user');
        $db_pass   = $this->input->post('db_pass');
        $db_name   = $this->input->post('db_name');
            
        $link = mysql_connect($db_server, $db_user, $db_pass); 
        $db_sel = mysql_select_db($db_name); 

        // Drop all tables in DB
        $tables = array();
        $sql = "SHOW TABLES FROM $db_name";
        if($result = mysql_query($sql, $link))
        {
            while($row = mysql_fetch_row($result))
            {
                $tables[] = $row[0];
            }
        }

        if (count($tables) > 0)
        {
            foreach($tables as $t)
            {
                $sql = "DROP TABLE $db_name.$t";
                if(!mysql_query($sql, $link))
                {
                    die ("MySQL error. Can\'t delete $db_name.$t");
                }
            }
        }

        // Insert sql data
        mysql_query('SET NAMES `utf8`;', $link);    

        $sqlFileData = read_file(dirname(__FILE__).'/'.$this->useSqlFile);

        $queries = explode(";\n", $sqlFileData);

        foreach ($queries as $q)
        {
            $q = trim($q);
            
            if ($q != '')
            {
                mysql_query($q.';',$link);
            }
        }

        // Update site title
        mysql_query('UPDATE `settings` SET `site_title`=\''.mysql_real_escape_string($this->input->post('site_title')).'\' ', $link);

        // Create admin account
        $this->load->library('DX_Auth');
        $admin_pass = crypt($this->dx_auth->_encode( $this->input->post('admin_pass') ));
        $admin_login = mysql_real_escape_string( $this->input->post('admin_login') );
        $admin_mail = mysql_real_escape_string( $this->input->post('admin_mail') );

        $admin_created = date('Y-m-d H:i:s', time());

        $sql = "INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 2, '$admin_login', '$admin_pass', '$admin_mail', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '$admin_created', '0000-00-00 00:00:00'); ";

        mysql_query($sql,$link);

        // Rewrite config file
        $this->write_config_file();

        //redirect('install/done','refresh');
        header("Location: ".$this->host."install/done");
        }

    public function done()
    {
        $this->_display( $this->load->view('done', '',TRUE) );
    }

    private function write_config_file()
    {
        $config_file = APPPATH.'config/config.php';
        $config_file_copy = APPPATH.'modules/install/config.php';

        $this->load->helper('file');
        $config = read_file($config_file_copy);

        $new_url = $this->input->post('host_name');

        $db_server = $this->input->post('db_host');
        $db_user   = $this->input->post('db_user');
        $db_pass   = $this->input->post('db_pass');
        $db_name   = $this->input->post('db_name');

        $db_settings='$config[\'database\'][\'default\'][\'hostname\'] = "'.$db_server.'";
$config[\'database\'][\'default\'][\'username\'] = "'.$db_user.'";
$config[\'database\'][\'default\'][\'password\'] = "'.$db_pass.'";
$config[\'database\'][\'default\'][\'database\'] = "'.$db_name.'";
$config[\'database\'][\'default\'][\'dbdriver\'] = "mysql";
$config[\'database\'][\'default\'][\'dbprefix\'] = "";
$config[\'database\'][\'default\'][\'pconnect\'] = false;
$config[\'database\'][\'default\'][\'db_debug\'] = true;
$config[\'database\'][\'default\'][\'cache_on\'] = false;
$config[\'database\'][\'default\'][\'cachedir\'] = "";
$config[\'database\'][\'default\'][\'char_set\'] = "utf8";
$config[\'database\'][\'default\'][\'dbcollat\'] = "utf8_general_ci";
        ';

        $config = str_replace('//--DB-SETTINGS', $db_settings, $config);

        if ( ! write_file($config_file, $config))
        {
            die('Ошибка записи файла config.php');
        }
    }

    private function _get_next_link($result = FALSE, $step = 1)
    {
        if ($result === TRUE)
        {
            $next_link = $this->host.'install/step_'.($step + 1);
        }
        else
        {
            $next_link = $this->host.'install/step_'.$step;
        }

        return $next_link;
    }

    public function _display($content)
    {
        $data = array(
            'content' => $content,
            );

        $this->load->view('main', $data);
    }

    private function test_db()
    {
        $result = TRUE;

        $db_server = $this->input->post('db_host');
        $db_user   = $this->input->post('db_user');
        $db_pass   = $this->input->post('db_pass');
        $db_name   = $this->input->post('db_name');
            
        $link = mysql_connect($db_server, $db_user, $db_pass); 
        $db_sel = mysql_select_db($db_name); 

        if ($link == FALSE OR $db_sel == FALSE)
        {
            $result = FALSE;
        }

        mysql_close($link);

        return $result;
    }
        

}

/* End of file install.php */
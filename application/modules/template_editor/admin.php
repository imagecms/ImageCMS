<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Template Editor Module
 */

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	    cp_check_perm('module_admin');

        //TEMPLATES_PATH 
        $this->load->helper('directory');
	}

    // Find templates and redner list of first template folder
	public function index()
	{
        $this->renderDir();
	}

    public function renderDir($path=null)
    {
        if ($path==null)
            $path_to_display=TEMPLATES_PATH;
        else
        {
            $t=$this->uri->uri_to_assoc(6);
            $path = $this->uri->assoc_to_uri($t);
            $path_to_display=TEMPLATES_PATH.$path;
        }

        $map = directory_map($path_to_display);
        unset($map['administrator']);

        // Create navigation
        $parts=explode('/',$path);

        if (!empty($parts))
        {
            // root link
            $url=site_url('admin/components/cp/template_editor/renderDir/');
            $html.='<li><a href="javascript:ajax_div(\'page\',\''.$url.'\');">root / </a></li>';

            $path_segments='';
            for($i=0;$i<count($parts);$i++)
            {
                if($parts[$i] != '' && $parts[$i] != '/')
                {
                    $path_segments.=$parts[$i].'/';
                    $url= site_url('admin/components/cp/template_editor/renderDir/'.$path_segments); 
                    $html.='<li><a href="javascript:ajax_div(\'page\',\''.$url.'\');">'.$parts[$i].' / </a></li>';
                }
            }
        }

        $this->template->add_array(array(
            'files'=>$map,
            'path'=>$path,
            'navigation'=>$html,
        ));

	    $this->display_tpl('index');
    }

    public static function get_file_ext($filename)
    {
   		$x = explode('.', $filename);
		return end($x);  
    }

    public function edit_file()
    {
        $this->load->helper('string');
        $this->load->helper('file');

        $assoc=$this->uri->uri_to_assoc(6);
        $path = trim_slashes($this->uri->assoc_to_uri($assoc));
        $file=TEMPLATES_PATH.$path; 
        
        if ($this->get_file_ext($file)=='php')
            die('Доступ запрещен.');

        if (file_exists($file))
            $file_data = read_file($file);
        else
            die('Файл не найден.');
        
        $this->template->add_array(array(
            'file_data'=>$file_data,
            'path'=>$path,
        ));

        $this->display_tpl('edit');
    }
       
    public function update_file()
    {
        $this->load->helper('file');
        $file=TEMPLATES_PATH.$this->input->post('path');

        if (file_exists($file))
        {
            if ( ! write_file($file, $this->input->post('data'))) 
                showMessage('Ошибка записи файла. Проверьте права на запись.'); 
            else
                showMessage('Изменения сохранены.');
        }
        else
            showMessage('Файл не найден.');  
    }

    public function create_file()
    {
        $this->load->helper('string');
        $assoc=$this->uri->uri_to_assoc(6);
        $path = trim_slashes($this->uri->assoc_to_uri($assoc));
 
        if (!empty($_POST))
        {
            // create file
            $file_name = $this->input->post('file_name');

            if (trim($file_name) == '')
            {
                showMessage('Укажите имя файла.');
                exit;
            }
            else
            {
                $this->load->helper('file');

                $file=htmlspecialchars(TEMPLATES_PATH.$path.'/'.$file_name.'.tpl');
                
                if ( ! write_file($file, ' ')) 
                    showMessage('Ошибка записи файла. Проверьте права на запись.'); 
                else
                {
                    showMessage('Файл создан.');
                    closeWindow('create_filetemplate_window');
                    updateDiv('page',site_url('admin/components/cp/template_editor/renderDir/'.$path));
                }
            }
        }
        else
        {
            $this->template->add_array(array(
                'path'=>$path,
            ));
            $this->display_tpl('create');
        }
    }

    public function delete_file()
    {
        $path=$this->input->post('path');
        
        if (file_exists(TEMPLATES_PATH.$path) && $this->get_file_ext($path) == 'tpl')
        {
            if (!unlink(TEMPLATES_PATH.$path))
            {
                showMessage('Ошибка удаления файла.');
            }
            else
            {
                $path=str_replace(strrchr($path, '/'),'',$path);
                closeWindow('edit_template_window');
                updateDiv('page', site_url('admin/components/cp/template_editor/renderDir/'.$path));
            }
        }
        else
        {
            showMessage('Ошибка укаления');
        }
    }

    protected function list_directory($dir,$top=false)
    {
        return directory_map($dir,$top);
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}


/* End of file admin.php */

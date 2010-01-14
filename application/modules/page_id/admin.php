<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс администрирования модуля Page_id
 */

class Admin extends Controller {

	public function __construct()
	{
		parent::Controller();

        // Only admin access 
        // Do not delete this code !
		if( $this->dx_auth->is_admin() == FALSE) exit;
	}

    /**
    * Выводим шаблон ./templates/admin/settings.tpl
    */
	public function index()
	{
        $this->display_tpl('settings');	
	}

    /**
    * Сохраняем настройки
    */
    public function save_settings()
    {
        $settings = array(
            'message' => $_POST['message'],
        );

        $this->db->limit(1);
        $this->db->where('name', 'page_id');
        $this->db->update('components', array('settings' => serialize($settings)));

        showMessage('Изменения сохранены.');
    }

    /**
    * Загрузка настроек.
    */
    private function load_settings()
    {
        $this->db->limit(1);
        $this->db->where('name', 'page_id');
        $query = $this->db->get('components');

        if ($query->num_rows() == 1)
        {
            $settings = $query->row_array();
            return unserialize($settings['settings']);
        }
    }

    /**
    * Отображение шаблона
    */
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
    * Чтение шаблона в переменную
    */
	private function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}


/* End of file admin.php */

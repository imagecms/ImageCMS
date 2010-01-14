<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс отображения страниц по ID.
 */

class Page_id extends Controller {

    public $settings = array();

	public function __construct()
	{
		parent::Controller();

		$this->load->module('core');

        // Загрузка настроек.
        $this->load_settings();
	}

    /**
    * Отображение страницы по ID.
    */
	public function index($id = NULL)
	{
        // Если не указан ID страницы
        // выводим ошибку.
        if ($id == NULL)
        {
            $this->core->error($this->settings['message'] , FALSE);
        }

        //Генерация запроса к БД.
        $this->db->limit(1);
        $this->db->where('id', $id);
        // Ищем только опубликованные страницы. 
        $this->db->where('publish_date <=', time());
        $query = $this->db->get('content');

        // Если страница не найдена выводим ошибку 404.
        if ($query->num_rows() == 0)
        {
            $this->core->error_404();
        }
        else
        {
            $page = $query->row_array();

            // Если полный текст страницы отсутствует
            // выводим предварительный текст.
            if ($page['full_text'] == '')
            {
                $page['full_text'] = $page['prev_text'];
            }

            // Если не указан шаблон страницы
            // то используем шаблон page_static
            if ($page['full_tpl'] == NULL)
            {
                $page['full_tpl'] = 'page_static';
            }

            // Устанавливаем мета теги.
            $this->core->set_meta_tags($page['title'], $page['keywords'], $page['description']);

            $this->template->assign('page', $page);

            // Читаем шаблон страницы в переменную {$content}
            // и выводим main.tpl
            $this->template->show($page['full_tpl']);
        }
	}

    /**
    * Загрузка настроек модуля 
    */
    private function load_settings()
    {
        $this->db->limit(1);
        $this->db->where('name', 'page_id');
        $query = $this->db->get('components');

        if ($query->num_rows() == 1)
        {
            $settings = $query->row_array();
            $this->settings = unserialize($settings['settings']);
        }
    }

    /**
    * Функция будет вызвана при установке модуля из панели управления
    */
    public function _install()
    {
        if($this->dx_auth->is_admin() == FALSE) exit;

        // Включаем доступ к модулю по URL
        $this->db->limit(1);
        $this->db->where('name', 'page_id');
        $this->db->update('components', array('enabled' => 1));
    }
    
    /**
    * Отображение шаблона
    */
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';
		$this->template->display('file:'.$file);
	}

    /**
    * Чтение шаблона в переменную
    */
	private function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

/* End of file page_id.php */

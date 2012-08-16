<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

        // Only admin access 
        // Do not delete this code !
		 cp_check_perm('module_admin');
		 $this->load->model('xform_m');
	}

	//Дашбоард
	public function index()
	{
		$form = $this->xform_m->get_all_form();
		$this->template->assign('forms',$form);
		$this->display_tpl('admin');
	}
	
	/*РАБОТА С ФОРМАМИ*/
	
	public function create_form()
	{
		$this->display_tpl('create_form');
		
		if(count($_POST)>0)
		{
			//Проверяем данные
			$this->load->library('Form_validation');
			$val = $this->form_validation;

			$val->set_rules('page_title', 'Заголовок', 'trim|required|max_length[255]|min_length[1]');
			$val->set_rules('page_url', 'URL формы', 'max_length[255]|trim|xss_clean|required');
			$val->set_rules('subject', 'Тема', 'max_length[255]|trim|xss_clean|required');
			$val->set_rules('good', 'Сообщение', 'trim|xss_clean|max_length[255]|required');
					
			if ($val->run() == FALSE)
			{
				showMessage( validation_errors() );
			}
			else
			{
			//Формируем массив данных
				$data = array(
					'title' => $_POST['page_title'],
					'url' => $_POST['page_url'],
					'desc' => $_POST['desc'],
					'seccuss' => $_POST['good'],
					'subject' => $_POST['subject'],
					'email' => $_POST['email'],
				);
			//Добавляем в БД
				if($this->db->insert('xform',$data)) {
					showMessage('Форма успешно добавлена');
					updateDiv('page', site_url('admin/components/cp/xform'));
				}
			}
		}
		
	}
	
	public function edit_form($id) 
	{
		//Собираем данные формы
		$this->db->where('id',$id);
		$form = $this->db->get('xform')->row_array();
		$this->template->assign('form',$form);
		$this->display_tpl('edit_form');
		
		if(count($_POST)>0)
		{
			//Обрабатываем введённые данные
			$this->load->library('Form_validation');
			$val = $this->form_validation;

			$val->set_rules('page_title', 'Заголовок', 'trim|required|max_length[255]|min_length[1]');
			$val->set_rules('page_url', 'URL формы', 'max_length[255]|trim|xss_clean|required');
			$val->set_rules('subject', 'Тема', 'max_length[255]|trim|xss_clean|required');
			$val->set_rules('good', 'Сообщение', 'trim|xss_clean|max_length[255]|required');
					
			if ($val->run() == FALSE)
			{
				showMessage( validation_errors() );
			}
			else
			{
				//Собираем массив данных
				$data = array(
					'title' => $_POST['page_title'],
					'url' => $_POST['page_url'],
					'desc' => $_POST['desc'],
					'seccuss' => $_POST['good'],
					'subject' => $_POST['subject'],
					'email' => $_POST['email'],
				);
				
				$this->db->where('id',$id);
			
			//Обновляем данные
				if($this->db->update('xform',$data)) {
					showMessage('Форма успешно обновлена');
					updateDiv('page', site_url('admin/components/cp/xform'));
				}
			}
		}
	}
	
	public function delete_form() 
	{
		if(count($_POST)>0) 
		{
			if($this->db->where('id',$_POST['id'])->delete('xform')) 
			{
				$this->db->where('fid',$_POST['id'])->delete('xform_field');
				showMessage('Форма успешно удалена');
			}
		}
	}
	
	/*РАБОТА С ПОЛЯМИ*/
	
	public function fields($id)
	{
		$fields = $this->xform_m->get_all_field($id);
		
		$form_name = $this->xform_m->get_form_name($id);
		
		$this->template->assign('fields',$fields);
		$this->template->assign('form_name',$form_name);
		$this->template->assign('form_id',$id);
		
		$this->display_tpl('admin_field');
	}
	
	public function mix_field($fid,$field)
	{
		if($field) 
		{
			$field = $this->xform_m->get_field($field);
			$this->template->assign('field',$field);
		}
		
		$this->template->assign('fid',$fid);
		$this->display_tpl('mix_field');
		
		if(count($_POST)>0)
		{
			//Обрабатываем введённые данные
			$this->load->library('Form_validation');
			$this->load->helper('translit');
			$val = $this->form_validation;

			$val->set_rules('name', 'Имя', 'trim|required|max_length[255]|min_length[1]');
			$val->set_rules('value', 'Значение', 'trim|xss_clean');
			$val->set_rules('desc', 'Описание', 'trim|xss_clean');
			$val->set_rules('oper', 'Операции', 'trim');
			$val->set_rules('position', 'Описание', 'trim|xss_clean|numeric');
			$val->set_rules('max', 'Максимальное значение', 'trim|xss_clean|numeric');
					
			if ($val->run() === FALSE)
			{
				showMessage( validation_errors() );
			}
			else
			{
				$data = array(
					'fid' => $fid,
					'name' => translit_url($_POST['name']),
					'type' => $_POST['type'],
					'label' => $_POST['name'],
					'value' => $_POST['value'],
					'desc' => $_POST['desc'],
					'operation' => $_POST['oper'],
					'position' => $_POST['position'],
					'maxlength' => $_POST['max'],
					'checked' => $_POST['check'],
					'disabled' => $_POST['disable'],
					'require' => $_POST['required'],
				);
				
				if(!$field) 
				{
					$this->db->insert('xform_field',$data);
					showMessage('Поле успешно добавлено!');
				}
				else
				{
					$this->db->where('id',$field['id']);
					$this->db->set($data);
					$this->db->update('xform_field');
					showMessage('Поле успешно сохранено!');
				}
				
				updateDiv('page', site_url('admin/components/cp/xform/fields/'.$fid));
			}
		}
	}
	
	public function delete_field()
	{
		if(count($_POST)>0) 
		{
			if($this->db->where('id',$_POST['id'])->delete('xform_field')) 
			{
				showMessage('Поле успешно удалено.');
			}
		}
	}
	
	public function save_positions()
    {
        foreach ($_POST['items_pos'] as $k => $v)
        {
            $item = explode('_', substr($v, 4));
            $this->set_item_position((int)$item[0],$item[1]);
        }
		
    }
	
	private function set_item_position($item_id = FALSE, $pos = FALSE)
    {
        if ($item_id != FALSE AND $pos != FALSE)
        {
            $this->db->where('id',$item_id);
            $this->db->update('xform_field', array('position' => $pos ));

            return TRUE;
        }else{
            return FALSE;
        }
    }

    
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}


}
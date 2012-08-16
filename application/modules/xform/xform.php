<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Xform extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->module('core');
		$this->load->model('xform_m');
	}

	// Index function
	public function index($url)
	{
        if($url == $this->uri->segment(2))
		{
			$this->show($url);
		}
		else {
			$this->core->error_404();
		}
	}
	
	public function show($url) 
	{
		$id = $this->xform_m->get_form_id($url);
		$form = $this->xform_m->get_form($id);
		$this->core->set_meta_tags($form['title']);
		$fields = $this->xform_m->get_all_field($id);
		
		if(count($_POST)>0 AND $_POST['captcha']=='') 
		{
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			
			$msg.="Вам пришло сообщение с сайта - ".site_url()." с0 следующими данными:\n<br/>";
			
			foreach($_POST as $key => $data)
			{
				$field = $this->xform_m->get_field($key,'name');
				
				$require = ($field['require']==1) ? 'required|' : '';
				$valid_mail = ($key=='e-mail') ? 'valid_email|' : '';
				
				$this->form_validation->set_rules($key,$field['label'],'trim|xss_clean|'.$require.$valid_mail);
				
				if($data!=='' AND $key!=='cms_token') {
					$msg.="<b>".$field['label'].":</b> ".$data."<br/>\n";
				}
				
			}
			
			if ($this->form_validation->run($this) == FALSE)
            {
                $this->template->assign('result',validation_errors());
            }
            else
            {
				$from = ($_POST['e-mail'])?$_POST['e-mail']:$form['email'];
				
				$config['charset'] = 'UTF-8';
				$config['wordwrap'] = FALSE;
				$config['mailtype'] = 'html';

				$this->load->library('email');
				$this->email->initialize($config);

				$this->email->from($from);
				$this->email->to($form['email']); 

				$this->email->subject($form['subject']);
				$this->email->message($msg);	

				$this->email->send();
				
                $this->template->assign('result',$form['seccuss']);
            }
		}
		
		$this->template->assign('form',$form);
		$this->template->assign('fields',$fields);
		$this->display_tpl('xform');
	}

	// Autoload default function
	public function autoload()
	{
        //code
	}


    // Install 
    public function _install()
    {
        
    	if( $this->dx_auth->is_admin() == FALSE) exit;

        $this->load->dbforge();

        $xform = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'title' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'url' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'desc' => array(
                         'type' => 'text',
                     ),
			'seccuss' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'subject' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'email' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'title' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
                 );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($xform);
        $this->dbforge->create_table('xform', TRUE);
		
		$xform_field = array(
			'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'fid' => array(
                         'type' => 'int',
                         'constraint' => 11,
                     ),
            'type' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'name' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'label' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'value' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'desc' => array(
                         'type' => 'varchar',
                         'constraint' => 255,
                     ),
			'position' => array(
                         'type' => 'int',
                         'constraint' => 11,
						 'default' => 0
                     ),
			'maxlength' => array(
                         'type' => 'int',
                         'constraint' => 11,
                     ),
			'checked' => array(
                         'type' => 'int',
                         'constraint' => 2,
						 'default' => 0
                     ),
			'disabled' => array(
                         'type' => 'int',
                         'constraint' => 2,
						 'default' => 0
                     ),
			'require' => array(
                         'type' => 'int',
                         'constraint' => 2,
						 'default' => 0
                     ),
			'operation' => array(
                         'type' => 'text',
                     ),
					 
			);
			
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->add_field($xform_field);
			$this->dbforge->create_table('xform_field', TRUE);

        // Enable module autoload
        $this->db->where('name', 'xform');
        $this->db->update('components', array('enabled' => '1'));

    }

    // Delete module
    public function _deinstall()
    {
        
       	if( $this->dx_auth->is_admin() == FALSE) exit;
    
        $this->load->dbforge();
        $this->dbforge->drop_table('xform');
		$this->dbforge->drop_table('xform_field');
        
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file;  
		$this->template->show('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

/* End of file sample_module.php */

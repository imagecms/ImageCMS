<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Image CMS
 * 
 * Backup Class
 *
 */

class Backup extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('DX_Auth');
        admin_or_redirect(); 

        $this->load->library('lib_admin');
		$this->lib_admin->init_settings();

        cp_check_perm('backup_create');
	}

	public function index()
	{
        $this->template->add_array(array(
            'user' => $this->get_admin_info(),
        ));

        $this->template->show('backup', FALSE);
    }

    // Create backup file
    public function create()
    {
        if (!is_really_writable('./application/backups'))
        {
            showMessage('Директория ./application/backups не доступна для записи.');
            exit;
        }

        switch ($_POST['save_type'])
        {
            case 'local':
                jsCode("window.location = '".site_url('admin/backup/force_download/'.$_POST['file_type'])."'");
            break;

            case 'server':
                $this->load->helper('file');
                write_file('./application/backups/'.$this->generate_file_name($_POST['file_type']), $this->get_backup_str($_POST['file_type']));

                $this->done();
            break;

            case 'email':
                $this->send_to_email();
            break;
        }
    }

    private function send_to_email()
    {
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper('file');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			
		if ($this->form_validation->run($this) == FALSE)
		{
			showMessage( validation_errors() );
		}
		else
		{
            $user = $this->get_admin_info();

            $tmp_file = './system/cache/'.$this->generate_file_name($_POST['file_type']); 
            write_file($tmp_file, $this->get_backup_str($_POST['file_type']));  

		    $this->email->to($_POST['email']);
            $this->email->from($user['email']);
            $this->email->subject('Резервное копирование '.date('d-m-Y H:i:s'));
            $this->email->message(' ');
            $this->email->attach($tmp_file);
            $this->email->send();

            @unlink($tmp_file);

            $this->done();
		}
    }

    // Direct download
    public function force_download($file_type)
    {
        $this->load->helper('download');
        force_download($this->generate_file_name($file_type), $this->get_backup_str($file_type));
    }

    private function get_backup_str($file_type)
    {
        $this->load->dbutil();

        $conf = array(
                'format' => $file_type,
              );

        $backup =& $this->dbutil->backup($conf);

        return $backup;
    }


    private function done()
    {
        showMessage('Резервное копирование завершено.');
    }

    private function generate_file_name($file_type)
    {
        return "sql_".date("d-m-Y_H.i.s.").$file_type;
    }

    private function get_admin_info()
    {
        return $this->db->get_where('users', array('id' => $this->dx_auth->get_user_id()))->row_array();
    }
    
}

/* End of backup.php */

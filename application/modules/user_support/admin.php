<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * User support module.
 */

class Admin extends MY_Controller {

    public $tickets_per_page = 20;

	function __construct()
	{
		parent::__construct();

        // Only admin access 
        // Do not delete this code !
        if( $this->dx_auth->is_admin() == FALSE) exit;

	    $this->load->model('tickets');
        $this->load->model('departments');

        $this->load->helper('user_support');
	}


    /** 
     * Display list of tickets
     */
	public function index($offset = 0)
    {
        $row_count = $this->tickets_per_page;

        $tickets = $this->tickets->get_all(FALSE, $this->tickets_per_page, $offset)->result_array();

        $this->db->from($this->tickets->table);
        $total = $this->db->count_all_results();

        if ($total > $row_count)
        {
            $this->load->library('Pagination');

            $config['base_url']    = site_url('admin/components/cp/user_support/index');
            $config['total_rows']  = $total;
            $config['per_page']    = $row_count;
            $config['uri_segment'] = $this->uri->total_segments();

            $config['cur_tag_open']  = '<span class="active">';
            $config['cur_tag_close'] = '</span>';

            $config['first_link'] = 'Первая';
            $config['last_link']  = 'Последняя';

            $this->pagination->num_links = 5;
            $this->pagination->initialize($config);
            $this->template->assign('paginator', $this->pagination->create_links_ajax());
        }

	$n=0;
	foreach ($tickets as $t)
        {
		$this->db->where('id', $t['user_id']);
		$q = $this->db->get('users')->row_array();
		$tickets[$n]['author'] = $q['username'];
	$n++;
        }

        $this->template->add_array(array(
                'tickets' => $tickets,
            ));

        $this->display_tpl('tickets');
	}

    public function view_ticket($id = 0)
    {
        $this->load->model('ticket_comments');
        $this->load->module('user_support');

        $ticket = $this->tickets->get($id)->row_array();

        $ticket['comments'] = $this->ticket_comments->get($ticket['id'])->result_array();

        $this->template->add_array(array(
            'ticket'     => $ticket,
            'statuses'   => $this->user_support->statuses,
            'priorities' => $this->user_support->priorities,
            'departments' => $this->db->get('support_departments')->result_array(),
            ));

        $this->display_tpl('view_ticket');
    }    


    public function add_comment($ticket_id = 0)
    {
        $this->load->model('ticket_comments');

        $ticket = $this->tickets->get($ticket_id)->row_array();

        if ($this->dx_auth->is_admin() === TRUE)
        {
            $user_status = 1;
        }
        else
        {
            $user_status = 0;
        }

        $data = array(
            'ticket_id'   => $ticket['id'],
            'user_id'     => $this->dx_auth->get_user_id(),
            'user_name'   => $this->dx_auth->get_username(),
            'text'        => htmlspecialchars( $this->input->post('text') ),
            'user_status' => $user_status,
            'date'        => time(),
        );

        $this->ticket_comments->create($data);
        $this->tickets->change_update_date($ticket['id'], time() );
        $this->tickets->set_last_comment_author($ticket['id'], $data['user_name']);

        updateDiv('page', site_url('admin/components/cp/user_support/view_ticket/' . $ticket['id']));
    }

    public function update_ticket($id = 0)
    {
        $data = array(
                'priority' => $this->input->post('priority'),
                'status'   => $this->input->post('status'),
                'updated'  => time(),
                'department'=> $this->input->post('department'),
                //'text'     => $this->input->post('text'),
            );

        $this->tickets->update($id, $data);

        showMessage('Изменения сохранены.');
    }

    public function delete_comment()
    {
        $c_id = $this->input->post('id');

        $this->load->model('ticket_comments');
        $this->ticket_comments->delete($c_id);
    }

    public function delete_ticket()
    {
        $id = $this->input->post('id');

        $this->tickets->delete($id);

        // Delete ticket comments
        $this->load->model('ticket_comments');
        $this->ticket_comments->delete_ticket_comments($id);
    }

    // Delete selected tickets
    public function delete_tickets()
    {
        if (!empty($_POST['tickets']))
        {
            $this->load->model('ticket_comments'); 

            foreach ($_POST['tickets'] as $key=>$val)
            {    
                $id=$page_id = substr($val,5); 
                $this->tickets->delete($id);
                $this->ticket_comments->delete_ticket_comments($id);
            }
        }
    }

    /*******************************************
    ** Departments
    ********************************************/

    // Show departments list
    public function departments()
    {
        $this->db->order_by('name', 'asc');
        $departments = $this->db->get('support_departments');

        if ($departments->num_rows() > 0)
        {
            $this->template->add_array(array(
                'departments'=>$departments->result_array(),
            ));
        }
        else
            $departments=null;

        $this->display_tpl('departments'); 
    }

    // Create new department
    public function create_department()
    {
        if (!empty($_POST))
        {
            $this->load->library('Form_validation');
            $this->form_validation->set_rules('name', 'Название департамента', 'required|xss_clean|max_length[45]'); 

            if ($this->form_validation->run($this) == FALSE)
            {
                showMessage(validation_errors());
            }
            else
            {
                $this->db->insert('support_departments',array(
                    'name'=>htmlspecialchars($this->input->post('name')),
                ));

                showMessage('Департамент создан');
                updateDiv('page', site_url('admin/components/cp/user_support/departments'));
            } 
        }

        $this->display_tpl('create_department');
    }

    // Update department data
    public function edit_department()
    {
        $this->db->limit(1);
        $this->db->where('id', $this->uri->segment(6));
        $query = $this->db->get('support_departments');

        if ($query->num_rows() == 1)
        {  
            if (!empty($_POST))
            {
                $this->load->library('Form_validation');
                $this->form_validation->set_rules('name', 'Название департамента', 'required|xss_clean|max_length[45]'); 

                if ($this->form_validation->run($this) == FALSE)
                {
                    showMessage(validation_errors());
                }
                else
                {
                    $this->db->where('id', $this->uri->segment(6));
                    $this->db->update('support_departments',array(
                        'name'=>$this->input->post('name'),         
                    ));

                    showMessage('Изменения сохранены');
                    updateDiv('page', site_url('admin/components/cp/user_support/departments'));
                }
            }


            $this->template->add_array(
                array(
                    'model'=>$query->row_array(),
                )            
            );

            $this->display_tpl('edit_department'); 
        }
        else
        {
            //          
        }
    }

    // Delete department and its tickets
    public function delete_department()
    {
        $this->db->limit(1);
        $this->db->where('id',$this->input->post('id'));
        $query = $this->db->delete('support_departments');

        // Delete tickets and comments
        $tickets = $this->db->where(array('department'=>$this->input->post('id')))->get('support_tickets');

        if ($tickets->num_rows() > 0)
        {
            foreach ($tickets->result_array() as $t)
            {
                $this->db->limit(1);
                $this->db->where('id',$t['id']);
                $this->db->delete('support_tickets');

                // Delete ticket comments
                $this->db->where('ticket_id', $t['id']);
                $this->db->delete('support_comments');
            }
        }
    }

	private function display_tpl($file = '', $data = array())
    {
        if (count($data) > 0)
        {
            $this->template->add_array($data);
        }

        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
        echo $this->template->fetch('file:'.$file);
    }

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '', $data = array())
    {
        if (count($data) > 0)
        {
            $this->template->add_array($data);
        }

        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
        return $this->template->fetch('file:'.$file);
	}

}

/* End of file admin.php */

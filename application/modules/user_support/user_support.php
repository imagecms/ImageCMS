<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * User support module
 *
 */

class User_support extends MY_Controller {

    public $user_id   = '';

    public $departments_arr  = FALSE; 
    public $tickets_per_page = 20;

    public $statuses  = array(
                            '0' => 'Открыт',
                            '1' => 'Закрыт',
                            '2' => 'В обработке',
                        );

    public $priorities = array(
                            '0' => 'Низкий',
                            '1' => 'Средний',
                            '2' => 'Высокий',
                            '3' => 'Срочно',
                        );

    // Colors
    public $statuses_colors = array(
                            '0' => 'green',
                            '1' => '#E26363',
                            '2' => '#32ACCF',
                        );

    public $priorities_colors = array(
                                '0' => '#B3B3B3',
                                '1' => '#94BC33',
                                '2' => '#EF662E',
                                '3' => '#FF4A00',
                            );


	public function __construct()
	{
        parent::__construct();
        $this->load->module('core');

        // Check user login
        if ( !$this->dx_auth->is_logged_in() )
        {
            $this->core->error(lang('lang_access_deny'));
        }

        $this->load->helper('user_support');
        
        $this->user_id  = $this->dx_auth->get_user_id();
    }

	public function index()
	{
        $this->core->set_meta_tags('Поддержка пользователей');
        $this->load->model('tickets');
        $this->load->model('departments');

        $this->db->limit(5);
        $my_tickets = $this->tickets->user_tickets( $this->user_id )->result_array();

        $data = array(
                'tickets'     => $my_tickets,
                'departments' => $this->departments->get_all(),
            ); 

        $this->template->add_array(array(
                'my_tickets_list' => $this->fetch_tpl('my_tickets', $data),  
            ));

        $this->show_tpl('index');
    }

    // Create new ticket
    public function create_ticket()
    {
        $this->core->set_meta_tags('Создать Билет'); 

        $this->load->library('Form_validation');
        $this->load->model('departments');

        // Validate form and insert new ticket
        if (count($_POST) > 0)
        {
            $this->form_validation->set_rules('theme', 'Тема', 'required|min_length[5]|xss_clean'); 
            $this->form_validation->set_rules('text', 'Описание', 'required|min_length[15]|xss_clean|max_length[5000]'); 
            $this->form_validation->set_rules('department', 'Отдел', 'required|xss_clean'); 
            $this->form_validation->set_rules('priority', 'Приоритет', 'required|xss_clean'); 

            if ($this->form_validation->run($this) == FALSE)
            {
                // error
            }
            else
            {
                // Load tickets model
                $this->load->model('tickets');

                $ticket = array(
                        'user_id'    => $this->user_id,
                        'text'       => htmlspecialchars($this->input->post('text')),
                        'theme'      => htmlspecialchars($this->input->post('theme')),
                        'department' => (int)$this->input->post('department'),
                        'priority'   => (int)$this->input->post('priority'),
                        'status'     => 0,
                        'date'       => time(),
                        'updated'       => time(),
                    );

                $id = $this->tickets->create($ticket);

                // Redirect to ticket
                redirect('user_support/ticket/'.$id, 'refresh');                
            } 

        }

        $this->template->add_array(array(
            'user_id'     => $this->user_id,
            'user_name'   => $this->dx_auth->get_username(),
            'departments' => $this->departments->get_all(),
            'statuses'    => $this->statuses,
            'priorities'  => $this->priorities,
            ));

        $this->show_tpl('create_ticket');
    }

    public function ticket($id = 0)
    {
        $this->load->model('tickets');
        $this->load->model('departments');
        $this->load->model('ticket_comments');

        $ticket = $this->tickets->get($id);

        if ($ticket->num_rows() == 0)
        {
            $this->core->error_404();
        }

        // Check user access to ticket
        // View and post comments to tickets may only admin and user who created it.
        if ($this->_check_ticket_access($ticket->row_array()) === FALSE)
        {
            $this->core->error_404();
        }
        
        $ticket = $ticket->row_array();

        $ticket['comments'] = $this->ticket_comments->get($ticket['id'])->result_array();

        $data = array(
            'ticket'      => $ticket,
            'user_id'     => $this->user_id,
            'user_name'   => $this->dx_auth->get_username(),
            'department'  => $this->departments->get( $ticket['department'] ),
            'status'      => $this->statuses[ $ticket['status'] ],
            'priority'    => $this->priorities[ $ticket['priority'] ],

            'status_color'   => $this->statuses_colors[ $ticket['status'] ],
            'priority_color' => $this->priorities_colors[ $ticket['priority'] ],
            );

        $this->core->set_meta_tags('Билет номер '.$ticket['id']);
        $this->show_tpl('ticket', $data);
    }

    private function _check_ticket_access($ticket = array())
    {
        if ($this->dx_auth->is_admin() === TRUE)
        {
            return TRUE;
        }

        if ($ticket['user_id'] != $this->dx_auth->get_user_id() )
        {
            return FALSE;
        }
    }

    public function close_ticket($id = 0)
    {
        $this->load->model('tickets');

        $ticket = $this->tickets->get($id)->row_array();

        if ($this->_check_ticket_access($ticket) === FALSE)
        {
            $this->core->error_404();
        }

        $this->tickets->close($ticket['id']);

        redirect('user_support/ticket/'.$ticket['id'], 'refresh');
    }

    public function add_comment($ticket_id = 0)
    {
        $this->load->library('Form_validation');
        $this->load->model('tickets');
        $this->load->model('ticket_comments');

        $ticket = $this->tickets->get($ticket_id)->row_array();

        if ($this->_check_ticket_access($ticket) === FALSE)
        {
            $this->core->error_404();
        }

        $this->form_validation->set_rules('text', 'Текст сообщения', 'required|xss_clean|max_length[500]'); 

        if ($this->form_validation->run($this) == FALSE)
        {
            $this->ticket($ticket['id']);

            return FALSE;
        }
        else
        {
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
                'user_id'     => $this->user_id,
                'user_name'   => $this->dx_auth->get_username(),
                'text'        => htmlspecialchars( $this->input->post('text') ),
                'user_status' => $user_status,
                'date'        => time(),
                );

            $this->ticket_comments->create($data);
            $this->tickets->change_update_date($ticket['id'], time() );
            $this->tickets->set_last_comment_author($ticket['id'], $data['user_name']);

            // Redirect to ticket
            redirect('user_support/ticket/'.$ticket['id'], 'refresh');
        }
    }

    /** 
     * Display all user tickets
     */
    public function my_tickets($offset = 0)
    {
        $this->core->set_meta_tags('Мои билеты');
    
        $row_count = $this->tickets_per_page;

        $this->load->model('tickets');

        $my_tickets = $this->tickets->all_my_tickets( $this->user_id, $row_count, $offset )->result_array();

        $this->db->where(array('user_id' => $this->user_id));
        $this->db->from($this->tickets->table);
        $total = $this->db->count_all_results();

        if ($total > $row_count)
        {
            $this->load->library('Pagination');

            $config['base_url']    = site_url('user_support/my_tickets');
            $config['total_rows']  = $total;
            $config['per_page']    = $row_count;
            $config['uri_segment'] = $this->uri->total_segments();

            $config['cur_tag_open']  = '<span class="active">';
            $config['cur_tag_close'] = '</span>';

            $config['first_link'] = 'Первая';
            $config['last_link']  = 'Последняя';

            $this->pagination->num_links = 5;
            $this->pagination->initialize($config);
            $this->template->assign('pagination', $this->pagination->create_links());
        }

        $this->template->add_array(array(
                'tickets' => $my_tickets,  
            ));
        
        $this->show_tpl('all_my_tickets');
    }

    public function get_department_name($id)
    {
        if ($this->departments_arr === FALSE)
        {
            $this->load->model('departments');

            $departments = $this->departments->get_all();

            foreach ($departments as $d)
            {
                $this->departments_arr[$d['id']] = $d['name'];
            }
        }

        return $this->departments_arr[$id];
    }

    public function _install()
    {
        if( $this->dx_auth->is_admin() == FALSE) exit;

        // Create tables
        $sql2="
            INSERT INTO `support_departments` (`id`, `name`) VALUES
            (1, 'Техническая поддержка');
        ";

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `support_comments` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `ticket_id` int(11) NOT NULL,
              `user_id` int(11) NOT NULL,
              `user_status` int(11) NOT NULL,
              `user_name` varchar(100) NOT NULL,
              `text` varchar(500) NOT NULL,
              `date` int(11) NOT NULL,
              UNIQUE KEY `id` (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;        
        ");
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `support_departments` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(45) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;        
        ");
        $this->db->query("

            CREATE TABLE IF NOT EXISTS `support_tickets` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) DEFAULT NULL,
              `last_comment_author` varchar(50) NOT NULL,
              `text` text,
              `theme` varchar(100) NOT NULL,
              `department` int(11) NOT NULL,
              `status` smallint(1) DEFAULT NULL,
              `priority` varchar(15) DEFAULT NULL,
              `date` int(11) DEFAULT NULL,
              `updated` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;       
        ");

        $this->db->query($sql2);

        $this->db->where('name', 'user_support');
        $this->db->update('components', array('enabled' => 1));

    }

    public function _deinstall()
    {
        if( $this->dx_auth->is_admin() == FALSE) exit;

        $this->load->dbforge();
        $this->dbforge->drop_table('support_comments');
        $this->dbforge->drop_table('support_tickets');
        $this->dbforge->drop_table('support_departments');
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '', $data = array())
    {
        if (count($data) > 0)
        {
            $this->template->add_array($data);
        }

        $file = realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
        $content = $this->template->fetch('file:'.$file);

        $this->template->add_array(array(
                'content' => $content
            ));

        $this->template->show();
    }

    private function show_tpl($file, $data = array())
    {
        if (count($data) > 0)
        {
            $this->template->add_array($data);
        }

        $this->template->add_array(array(
                'user_support_content' => $this->fetch_tpl($file)
            ));

        $this->display_tpl('main');
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

        $file = realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
        return $this->template->fetch('file:'.$file);
	}

}

/* End of file user_support.php */

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Polls Module Admin
 */

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        cp_check_perm('module_admin');
	}


	public function index()
	{
	    $polls = $this->db->get('cms_polls');

        $this->template->assign('polls',$polls);
        $this->display_tpl('list');
	}

    public function create()
    {
        if ($_POST)
        {
            // Validate end create new polls
            $this->load->library('Form_validation');
            $this->form_validation->set_rules('name', 'Название', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
                exit();
            }
            else
            {
                // Create new poll.
                $this->db->insert('cms_polls', array(
                    'name'=>$_POST['name'],
                ));

                // Process answers
                if (sizeof($_POST['answers']) > 0)
                {
                    // Get poll id
                    $poll_id = $this->db->insert_id();
                    $position = 0;

                    foreach ($_POST['answers'] as $answer)
                    {
                        if ($answer != '')
                        {
                            $this->db->insert('cms_polls_answers', array(
                                'poll_id'=>$poll_id,
                                'text'=>$answer,
                                'position'=>(int)$position,
                            ));

                            $position++;
                        }
                    }
                }

                updateDiv('page', site_url('admin/components/cp/polls/edit/'.$poll_id));
            }
        }else{
            $this->display_tpl('create');
        }
    }

    public function edit($id = null)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $poll = $this->db->get('cms_polls');

        if ($poll->num_rows() == 0)
            exit('Голосование не найдено.');

        $poll = $poll->row_array();

        // Load answers
        $this->db->where('poll_id',$poll['id']);
        $this->db->order_by('position','ASC');
        $answers = $this->db->get('cms_polls_answers');

        $this->template->assign('poll',$poll);
        $this->template->assign('answers',$answers->result_array());


        if($_POST)
        {
            // Save polls name
            $this->load->library('Form_validation');
            $this->form_validation->set_rules('name', 'Название', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors());
                exit();
            }
            else
            {
                // Update poll name
                $this->db->where('id',$poll['id']);
                $this->db->update('cms_polls',array('name'=>$_POST['name']));

                // Update existing answers
                if (sizeof($_POST['answers']) > 0)
                {
                    foreach ($_POST['answers'] as $key=>$val)
                    {
                        if ($val != '')
                        {
                            $this->db->where('id',$key);
                            $this->db->where('poll_id',$poll['id']);
                            $this->db->update('cms_polls_answers',array('text'=>$val));
                        }
                    }
                }

                // Insert next answer
                if ($_POST['next_answer'] != '')
                {
                    $this->db->where('poll_id',$poll['id']);
                    $this->db->select_max('position');
                    $max_query = $this->db->get('cms_polls_answers')->row_array();
                    $max_position = $max_query['position'];

                    $this->db->insert('cms_polls_answers', array(
                        'poll_id'=>$poll['id'],
                        'text'=>$_POST['next_answer'],
                        'position'=>(int)$max_position+1,
                    ));
                }
            }

            updateDiv('page', site_url('admin/components/cp/polls/edit/'.$poll['id']));
        }

        $this->display_tpl('edit');
    }

    /**
     * Delete answer/votes and redirect back to poll
     *
     * @param  $id
     * @return void
     */
    public function delete_answer($poll_id=null, $id=null)
    {
        $this->db->delete('cms_polls_answers', array(
            'poll_id' => $poll_id,
            'id'=>$id,
        ));
        $this->db->delete('cms_polls_voters', array(
            'poll_id' => $poll_id,
            'answer_id'=>$id,
        ));

        updateDiv('page', site_url('admin/components/cp/polls/edit/'.$poll_id));
    }

    public function delete($poll_id=null)
    {
        $this->db->delete('cms_polls', array(
            'id' => $poll_id,
        ));
        $this->db->delete('cms_polls_answers', array(
            'poll_id' => $poll_id,
        ));
        $this->db->delete('cms_polls_voters', array(
            'poll_id' => $poll_id,
        ));

        updateDiv('page', site_url('admin/components/cp/polls/index'));
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

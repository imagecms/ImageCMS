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
        $this->render('list');
    }

    public function create()
    {
        if ($_POST)
        {
            // Validate end create new polls
            $this->load->library('Form_validation');
            $this->form_validation->set_rules('name', lang('amt_tname'), 'required');

            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors(),false,'r');
                exit();
            }

            // Create new poll.
            $this->db->insert('cms_polls', array(
                'name'=>  $this->input->post('name'),
            ));

            // Process answers
            if (sizeof($_POST['answers']) > 0)
            {
                // Get poll id
                $poll_id = $this->db->insert_id();

                $toInsert = array();
                $p=0;
                foreach ($this->input->post('answers') as $answer)
                {
                    if ($answer != '')
                    {
                        $toInsert[] = array(
                            'poll_id'=>$poll_id,
                            'text'=>$answer,
                            'position'=>$p,
                        );
                        $p++;
                    }
                }

                if (count($toInsert))
                    $this->db->insert_batch('cms_polls_answers', $toInsert);
            }

            showMessage('Poll created success');

            if ($this->input->post('action') == 'close')
                pjax('/admin/components/cp/polls/');
            else
                pjax('/admin/components/cp/polls/edit/'.$poll_id);
        }
        else
            $this->render('create');
    }

    public function edit($id = null)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $poll = $this->db->get('cms_polls');

        if ($poll->num_rows() == 0)
            exit(lang('amt_poll_not_found'));

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
            $this->form_validation->set_rules('name', lang('amt_tname'), 'required');

            if ($this->form_validation->run() == FALSE)
            {
                showMessage(validation_errors(),false,'r');
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
                    $variants = array();
                    foreach ($_POST['answers'] as $key=>$val)
                    {
                        if ($val != '')
                        {
                            $this->db->where('id',$key);
                            $this->db->where('poll_id',$poll['id']);
                            $this->db->update('cms_polls_answers',array('text'=>$val));
                            $variants[] = $val;
                        }
                    }
                    
                    // Insert next answers
                    foreach ($this->input->post('new_answer') as $answer)
                    {
                        if ( !in_array($answer, $variants) && trim($answer) != '')
                        {
                            $key++;
                            $this->db->insert('cms_polls_answers', array(
                                'poll_id'=>$poll['id'],
                                'text'=>$answer,
                                'position'=>$key
                                ));
                        }
                    }
                }
            }

            showMessage('Poll update successfull');
            if ($this->input->post('action') == 'close')
                pjax('/admin/components/cp/polls/');
            else
                pjax('');
        }
        else
            $this->render('edit');
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

        showMessage('Answer deleted success');
        pjax('');
    }

    public function delete($poll_id=null)
    {
        if ($poll_id)
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

            showMessage('Poll deleted success');
            pjax('');
        }
    }
    
    
    private function render($file)
    {
        if ($this->ajaxRequest)
            echo $this->fetch_tpl ($file);
        else
            $this->display_tpl($file);
    }

    /**
     * Display template file
     */ 
    private function display_tpl($file = '')
    {
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file;  
        $this->template->show('file:'.$file);
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

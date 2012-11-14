<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Polls Module
 * Usage:
* 	    <!-- Отображаем голосование по ID -->
        {echo modules::load('polls')->displayPoll(3)}
 * 
 */

class Polls extends MY_Controller {

    protected $poll = null;

	public function __construct()
	{
		parent::__construct();
		$this->load->module('core');
	}

	// Index function
	public function index()
	{
        return false;
	}

	// Autoload default function
	public function autoload()
	{
        if (isset($_POST['cms_polls_make_vote']))
        {
            $answer_id = (int)$_POST['cms_polls_make_vote'];

            // Load answer
            $this->db->limit(1);
            $this->db->where('id',$answer_id);
            $answer = $this->db->get('cms_polls_answers')->row_array();

            if (sizeof($answer) > 0 && get_cookie('imagecms_polls_cookie_'.$answer['poll_id']) === false)
            {
                // Insert new vote
                $this->db->insert('cms_polls_voters',array(
                    'poll_id'=>$answer['poll_id'],
                    'answer_id'=>$answer['id'],
                    'date'=>time(),
                    'ip'=>$this->input->ip_address(),
                ));

                $this->load->helper('cookie');
                $cookie = array(
                   'name'   => 'imagecms_polls_cookie_'.$answer['poll_id'],
                   'value'  => true,
                   'expire' => 60*60*24*31,
                   'path'   => '/',
               );

                set_cookie($cookie);
                redirect($this->uri->uri_string());
            }
        }
	}

    public function getPoll($pollId=null)
    {
        // Load poll
        $this->db->limit(1);
        $this->db->where('id', $pollId);
        $poll = $this->db->get('cms_polls');

        if ($poll->num_rows() == 0)
            return false;
        else
            $poll = $poll->row_array();

        $this->poll = $poll;

        // Load answers
        $this->db->where('poll_id',$poll['id']);
        $this->db->order_by('position','ASC');
        $answers = $this->db->get('cms_polls_answers');

        if (sizeof($answers) == 0)
            return false;
        else
            $answers = $answers->result_array();

        // Calculate percent of votes for each answer
        $totalVotes=0;
        for($i=0;$i<count($answers);$i++)
        {
            $this->db->where('answer_id',$answers[$i]['id']);
            $this->db->where('poll_id',(int)$poll['id']);
            $this->db->from('cms_polls_voters');
            $answers[$i]['totalVotes']=$this->db->count_all_results();
            $totalVotes = $totalVotes+$answers[$i]['totalVotes'];
        }

        for($i=0;$i<count($answers);$i++)
        {
            $answers[$i]['percent'] = @round($answers[$i]['totalVotes'] / $totalVotes * 100);
        }

        return array(
            'totalVotes'=>$totalVotes,
            'poll'=>$poll,
            'answers'=>$answers,
            'userVoted'=>$this->hasVoted(),
        );
    }

    protected function hasVoted()
    {
        if ($this->poll !== null)
        {
            if(get_cookie('imagecms_polls_cookie_'.$this->poll['id']) === false)
                return false;
            else
                return true;
        }
    }

    // Install 
    public function _install()
    {

    	if( $this->dx_auth->is_admin() == FALSE) exit;

        $this->db->query('
        CREATE TABLE  `cms_polls` (
        `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
        `name` VARCHAR( 255 ) NOT NULL ,
        PRIMARY KEY (  `id` )
        ) ENGINE = MYISAM DEFAULT CHARSET=utf8;');

        $this->db->query('
        CREATE TABLE  `cms_polls_answers` (
        `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
        `poll_id` INT( 11 ) NOT NULL ,
        `text` VARCHAR( 255 ) NOT NULL ,
        PRIMARY KEY (  `id` )
        ) ENGINE = MYISAM DEFAULT CHARSET=utf8;');

        $this->db->query('ALTER TABLE  `cms_polls_answers` ADD INDEX (  `poll_id` );');

        $this->db->query('
        CREATE TABLE  `cms_polls_voters` (
        `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
        `poll_id` INT( 11 ) NOT NULL ,
        `answer_id` INT( 11 ) NOT NULL ,
        `date` INT( 11 ) NOT NULL ,
        `ip` VARCHAR( 50 ) NOT NULL ,
        PRIMARY KEY (  `id` ) ,
        INDEX (  `poll_id` ,  `answer_id` )
        ) ENGINE = MYISAM DEFAULT CHARSET=utf8;');

        $this->db->query('ALTER TABLE  `cms_polls_answers` ADD  `position` INT( 5 ) NOT NULL ,
        ADD INDEX (  `position` )');
    }

    // Delete module
    public function _deinstall()
    {
       	if( $this->dx_auth->is_admin() == FALSE) exit;
        $this->load->dbforge();
        $this->dbforge->drop_table('cms_polls');
        $this->dbforge->drop_table('cms_polls_answers');
        $this->dbforge->drop_table('cms_polls_voters');
    }

    /*
     * Display poll by ID
     */
    
    public function displayPoll($id)
    {
        echo 'sd lfhksdjfh ksjdfkj sdfjsgdkj dfkjsdf kjsdfkj skd fkjsgd f';
        $this->template->assign('data', $this->getPoll($id));
        $this->display_tpl('poll');
    }
    /**
     * Display template file
    */ 
    private function display_tpl($file = '')
    {
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
        $this->template->display('file:'.$file);
    }

}

/* End of file polls.php */

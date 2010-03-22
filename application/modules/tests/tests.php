<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 * Tests module
 *
 * TODO: Delete after testing.
 */



class Tests extends Controller {

    public $conf = 'conf';

	public function __construct()
	{
		parent::Controller();
		$this->load->module('core');
		$this->load->module('forms');
	}

    // Index function
	public function index()
	{
        $years = array(1,2,3);
        $selected = array(1);

        // Checkbox group values;
        $interests = array('Linux', 'PHP', 'Python');
        $interests = "a
        b
        c";
        $interests_selected = array(1);

        $fields = array(
            'username' => array(
                'type'       => 'checkbox',
                'label'      => 'Пользователь',
                'help_text'  => 'sd fsdf sdf sdfsdf sdf ',
                //'error_text' => 'Some error',
            ),
            'username2' => array(
                'type'       => 'text',
                'label'      => 'Пользователь 2',
                'validation' => 'required|min_length[3]', 
                'initial'    => 'user2',
                //'error_text' => 'Some error',
                'inline' => TRUE,
            ),
            'message' => array(
                'type'     => 'hidden',

            ),
            'select1' => array(
                'type'     => 'select',
                'label'    => 'Select label',
                'initial'  => $interests,
                'validation' => 'required',
                'multiple' => FALSE,
            ),
            'checks' => array(
                'type'    => 'checkgroup',
                'label'   => 'interests',
                'initial' => $interests,
            ),
            'html1' => array(
                'type' => 'html',
                'initial' => 'sdfsdfs sdfsdsdf ',
            ),
            'radios' => array(
                'type'    => 'radiogroup',
                'label'   => 'interests',
                'initial' => $interests,
            ),
        );

        //$form = $this->forms->add_fields($fields);

        $form = $this->forms->add_fields($fields);

        if ($_POST)
            $form->setAttributes($_POST);

        if ($form->isValid())
        {
            var_dump($form->getData());
        }
        
        //echo $form->render();
        $this->template->add_array(array(
            'form' => $form,
        ));

        $this->display_tpl('test_form');
	}

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/'.$file;  
		$this->template->show('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
    }

}


/* End of file sample_module.php */

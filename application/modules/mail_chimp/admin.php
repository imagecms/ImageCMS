<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * MailChimp Admin
 * @property Mailchimp $mailChimp instance of MailChimp
 */
class Admin extends BaseAdminController {

    public $mailChimp;

    public function __construct() {
        parent::__construct();
        //$lang = new MY_Lang();
        //$lang->load('mail_chimp');
        require_once('classes/Mailchimp.php');
        $this->mailChimp = new Mailchimp('d1c21e881ec90a3f72ff9335e4bbfc7c-us3'); //mine
        
//        $this->UnSubscribeAll('ada53b97a7');
        $users = $this->db->get('users')->result_array();
        $this->SubscribeAll($users, 'ada53b97a7');
        

        $members = $this->mailChimp->lists->members('ada53b97a7');
        var_dump($members['data']);
        exit;

        $this->mailChimp->debug = TRUE;
        $this->mailChimp->ssl_verifyhost = FALSE;
        $this->mailChimp->ssl_verifypeer = FALSE;

        \CMSFactory\assetManager::create()
                ->registerScript('mail_chimp');
    }

    public function index() {
        try {
            $campains = $this->mailChimp->campaigns->getList();

            \CMSFactory\assetManager::create()
                    ->setData('model', $campains)
                    ->renderAdmin('list');
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), FALSE, 'r');
        }
    }

    function send($id) {
        try {
            $this->mailChimp->campaigns->send($id);
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), FALSE, 'r');
        }
        pjax('/admin/components/init_window/mail_chimp');
    }

    function delete() {
        foreach ($this->input->post('ids') as $id) {
            try {
                $this->mailChimp->campaigns->delete($id);
                showMessage(lang('Successfuly deleted', 'mail_chimp'));
            } catch (Exception $exc) {
                showMessage($exc->getMessage(), FALSE, 'r');
            }
        }
    }

    function edit_campain($id) {
        try {
            $campaign = $this->mailChimp->campaigns->getList(array('campaign_id' => $id));
            if ($campaign['total'] == 0)
                throwException(lang('Campain not found', 'mail_chimp'));

            $data = $this->mailChimp->campaigns->content($id);
            $model['html'] = preg_replace('/<center>(.|\n)*<\/center>/', '', $data['html']);
            $model = array_merge($model, $campaign);

            $lists = $this->mailChimp->lists->getList();



            \CMSFactory\assetManager::create()
                    ->setData('model', $model)
                    ->setData('lists', $lists)
                    ->renderAdmin('edit');
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), FALSE, 'r');
            pjax('/admin/components/init_window/mail_chimp');
        }
    }

    function edit() {
        try {
            $this->mailChimp->campaigns->delete($this->input->post('id'));
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), FALSE, 'r');
        }
        $options->list_id = $this->input->post('list');
        $options->subject = $this->input->post('subject');
        $options->from_email = $this->input->post('from_email');
        $options->from_name = $this->input->post('from_name');
        $options->auto_footer = FALSE;
        $options->auto_tweet = FALSE;
        $options->auto_fb_post = '';

        $content->html = $this->input->post('text');
        $content->text = $this->input->post('text');

        try {
            $this->mailChimp->campaigns->create('regular', $options, $content, $segment_opts, $type_opts);
            showMessage(lang('Campain create successful', 'mail_chimp'));
            pjax('/admin/components/init_window/mail_chimp');
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), FALSE, 'r');
        }
    }

    function create_campain() {

        $lists = $this->mailChimp->lists->getList();

        \CMSFactory\assetManager::create()
                ->setData('lists', $lists)
                ->renderAdmin('main');
    }

    function create() {

        $options->list_id = $this->input->post('list');
        $options->subject = $this->input->post('subject');
        $options->from_email = $this->input->post('from_email');
        $options->from_name = $this->input->post('from_name');
        $options->auto_footer = FALSE;
        $options->auto_tweet = FALSE;
        $options->auto_fb_post = '';

        $content->html = $this->input->post('text');
        $content->text = $this->input->post('text');


        try {
            $this->mailChimp->campaigns->create('regular', $options, $content, $segment_opts, $type_opts);
            showMessage(lang('Campain create successful', 'mail_chimp'));
            pjax('/admin/components/init_window/mail_chimp');
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), FALSE, 'r');
        }
    }

    public function SubscribeAll($users, $listId) {

        $batch = array();
        foreach ($users as $user) {
            unset($obj);
            unset($obj_add);
            $obj->email = $user['email'];
            $obj_add->FNAME = $user['username'];
            $data = array('EMAIL' => $obj, 'merge_vars' => $obj_add);
            $batch[] = $data;
        }

        try {
            $this->mailChimp->lists->batchSubscribe($listId, $batch, FALSE, TRUE, TRUE);
        } catch (Exception $exc) {
            showMessage($exc->getMessage(), FALSE, 'r');
        }
    }

    public function UnSubscribeAll($listId) {

        $members = $this->mailChimp->lists->members($listId);
        $batch = array();
        foreach ($members['data'] as $user)
            $batch[]['email'] = $user['email'];




        try {
            $this->mailChimp->lists->batchUnsubscribe($listId, $batch, TRUE, FALSE, FALSE);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function viewLists(){
        
        $lists = $this->mailChimp->lists->getList();
        \CMSFactory\assetManager::create()
                ->setData('lists', $lists)
                ->renderAdmin('listAll');
        
    }
    
    public function edit_list($id){
        
        $members = $this->mailChimp->lists->members($id);
        
        \CMSFactory\assetManager::create()
                ->setData('users', $members)
                ->renderAdmin('listAll');

        
    }

}

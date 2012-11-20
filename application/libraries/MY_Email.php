<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Email extends CI_Email {

    private $locale;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('email_model');
        $this->CI->load->module('core');
        $this->locale = $this->CI->core->def_lang[0]['identif'];
    }
    /*
     * function extends Email->send() function
     * needs data array with such structure:
     * data['variables'] - array to replace using in mail template variables with normal values
     * data['to'] - receiver address
     * model - array which implements needed mail template 
     */
    
    public function sendMail($tplName, $data = array()) {
        $locale = $this->locale;
        $model = $this->CI->email_model->getMailArray($tplName, $locale);
        if (count($model) > 0) {
            $model['settings'] = unserialize($model['settings']);
            $config['mailtype'] = $model['settings']['mail_type'];
            $this->initialize($config);
            $this->from($model['settings']['from_mail'], $model['settings']['from']);
            $this->to($data['to']);
            $this->subject($model['settings']['theme']);
            $message = str_replace(array_keys($data['variables']), $data['variables'], $model['template']);
            $this->message($message);
            $this->send();
        } else {
            return false;
        }
    }
}

?>

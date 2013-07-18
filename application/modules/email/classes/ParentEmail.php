<?php

namespace email\classes;

/**
 * Image CMS
 * Module Wishlist
 * @property \Email_model $email_model
 * @property \DX_Auth $dx_auth
 * @property \CI_URI $uri
 * @property \CI_DB_active_record $db
 * @property \CI_Input $input
 * @version 1.0 big start!
 */
class ParentEmail extends \MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('email_model');
    }
    
    /**
     * replace variables in patern and wrap it
     * 
     * @param array $variables
     * @param string $patern
     * @return string
     */
    public function replaceVariables($patern = 'sdfsdf %user% asdfsdf, %user% sdfsd, %user_mail% fsdfsdfsdfsdf', $variables = array('%user%' => 'Mark', '%user_mail%' => 'sheme4ko@mail.ru')){
        foreach($variables as $variable => $replase_value){
           $patern = str_replace($variable, $replase_value, $patern);
        }
        
        $wraper = $this->email_model->getWraper();
        
        if($wraper){
           $patern = str_replace('$content', $patern, $wraper); 
        }
        
        return $patern;        
    }

    public function autoload() {

    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    public function _install() {
        $this->email_model->install();
    }

    public function _deinstall() {
        $this->email_model->deinstall();
    }

}
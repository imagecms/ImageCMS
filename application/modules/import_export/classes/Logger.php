<?php

namespace import_export\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property Core $core
 * @property CI_DB_active_record $db
 */
class Logger  {
    
    /**
     * Class Logger
     * @var Logger 
     */
    private static $object;
    /**
     * Path to file log.txt
     * @var string 
     */
    private $pathFile = "./application/modules/import_export/backups/log.txt";
    private $pathFolder = "./application/modules/import_export/";
    
    /**
     * Function create()
     * @return Logger
     * @access public
     */
    public static function create(){
        if (!self::$object)
            self::$object = new Logger();
        return self::$object;    
    }
    
    private function __construct() {
        
    }
    
    /**
     * Open or create log.txt and write errors
     * @param string $message
     * @access public
     */
    public function set($message){
        if(!file_exists($this->pathFolder)){
            $handler = fopen($this->pathFile, 'w') or print(' Cannot write log.txt. ');
        } else {
            $handler = fopen($this->pathFile, 'a') or print(' Cannot create log.txt. ');
        }
        $message = 'Error userId - ' . \CI::$APP->dx_auth->get_user_id() . '. time - ' . date("d.m.Y H:i", time()) . '. Message: ' . $message . "\n";
        fwrite($handler, $message);
        fclose($handler);        
    }
}
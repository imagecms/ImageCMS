<?php

namespace import_export\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property Core $core
 * @property CI_DB_active_record $db
 */
class Logger  {
    
    /**
     *
     * @var type 
     */
    private static $object;
    /**
     *
     * @var type 
     */
    private $pathFile = "./application/modules/import_export/backups/log.txt";
    
    /**
     * 
     * @return object
     */
    public static function create(){
        if (!self::$object)
            self::$object = new Logger();
        return self::$object;    
    }
    
    private function __construct() {
        
    }
    
    /**
     * 
     * @param string $message
     */
    public function set($message){
        if(!file_exists($this->pathFile)){            
            chmod($this->pathFile, 0777);
            $handler = fopen($this->pathFile, 'w') or die('Cannot open log.txt');
        } else {
            $handler = fopen($this->pathFile, 'a') or die('Cannot open log.txt');
        }
        $message = 'Error userId - ' . \CI::$APP->dx_auth->get_user_id() . '. time - ' . date("d.m.Y H:i", time()) . '. Message: ' . $message . "\n";
        fwrite($handler, $message);
        fclose($handler);
        chmod($this->pathFile, 0777);
    }
}
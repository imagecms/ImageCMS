<?php

namespace translator\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

class FileOperator {

    /**
     * FileOperator instance
     * @var FileOperator object
     */
    private static $instance;

    /**
     * File path
     * @var type 
     */
    private $filePath;

    /**
     * Errors array
     * @var type 
     */
    private $errors = array();

    /**
     * File data 
     * @var type 
     */
    private $data;

    private function __construct() {
        
    }

    /**
     * Get FileOperator instance
     * @return FileOperator
     */
    public static function getInstatce() {
        if (null === self::$instance)
            return self::$instance = new self();
        else
            return self::$instance;
    }

    /**
     * Open file
     * @param string $filePath - file path
     * @return boolean
     */
    public function getFile($filePath) {
        $this->_corectFilePath($filePath);
        if ($this->checkFile($filePath)) {
            $this->setData(file_get_contents($filePath));
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Update file
     * @param string $filePath - file path
     * @param string $content - file content
     * @return boolean
     */
    public function updateFile($filePath, $content) {
        if ($this->checkFile($filePath)) {
            file_put_contents($filePath, $content);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Macke corect file path
     * @param string $filePath - file path
     * @return string
     */
    private function _corectFilePath($filePath) {
        $this->filePath = str_replace('/', '\\', $filePath);
        $this->filePath = preg_replace('/application[\W\w]+/', '', __DIR__) . $this->filePath;
        $this->filePath = str_replace('\\', '/', $this->filePath);

        return $this->filePath;
    }

    /**
     * Check file on errors
     * @param string $filePath - file path
     * @return boolean
     */
    public function checkFile($filePath, $langOn = TRUE) {
        clearstatcache();

        if (file_exists($filePath)) {
            if (!is_readable($filePath)) {
                if ($langOn) {
                    $error = lang('File cant be read. Please, set read file permissions.', 'translator');
                } else {
                    $error = 'File cant be read. Please, set read file permissions.';
                }
                $this->setError($error, 'read');
                return FALSE;
            }

            if (!is_writable($filePath)) {
                if ($langOn) {
                    $error = lang('File cant be written. Please, set write file permissions.', 'translator');
                } else {
                    $error = 'File cant be written. Please, set write file permissions.';
                }
                $this->setError($error, 'write');
                return FALSE;
            }
            return TRUE;
        } else {
            if ($langOn) {
                $error = lang('File does not exist or check perrmissions to the file.', 'translator');
            } else {
                $error = 'File does not exist or check perrmissions to the file.';
            }
            $this->setError($error, 'create');
            return FALSE;
        }
    }

    /**
     * Set error
     * @param string $error - error text
     * @param string $type - error type
     */
    private function setError($error, $type = '') {
        $this->errors = array('error' => $error, 'type' => $type);
    }

    /**
     * Get errors
     * @return type
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Set file data
     * @param string $data - file data
     */
    private function setData($data) {
        $this->data = $data;
    }

    /**
     * Get file data
     * @return string
     */
    public function getData() {
        return $this->data;
    }

}

?>
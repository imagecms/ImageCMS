<?php

namespace import_export\classes;

use CI_DB_active_record;
use Core;
use libraries\Backup;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property Core $core
 * @property CI_DB_active_record $db
 */
class ImportBootstrap
{

    /**
     * Errors
     * @var array
     */
    protected $messages;

    /**
     * Class ImportBootstrap
     * @var ImportBootstrap
     */
    protected static $_instance;

    /**
     * Backup dir
     * @var string
     */
    public $uploadDir = './application/backups/';

    private function __construct() {

    }

    private function __clone() {

    }

    /**
     * Returns a new ImportBootstrap object.
     * @return ImportBootstrap
     * @access public static
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Start products import
     * @param integer $offers The final position
     * @param integer $limit Step
     * @param integer $countProd count products
     * @author Kaero
     * @return ImportBootstrap
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function startProcess($offers = 0, $limit = 0, $countProd = 0, $EmptyFields = null) {
        $result = BaseImport::create()
                ->setFileName($this->getFileNameFromPost(TRUE))
                ->setSettings($this->getSettingsFromPost())
                ->setImportType(Factor::ImportProducts)
                ->makeImport($offers, $limit, $countProd, $EmptyFields);
        return $this;
    }

    /**
     * Checks whether there is an error
     * @param string $type
     * @return bool
     * @access public static
     */
    public static function noErrors($type = Factor::MessageTypeError) {
        return (count(self::create()->messages[$type])) ? FALSE : TRUE;
    }

    /**
     * Checks whether an error
     * @param string $type
     * @return bool
     * @access public static
     */
    public static function hasErrors($type = Factor::MessageTypeError) {
        return (count(self::create()->messages[$type])) ? TRUE : FALSE;
    }

    /**
     * Add error message
     * @param string $msg
     * @param string $type
     * @return bool
     * @access public static
     */
    public static function addMessage($msg, $type = Factor::MessageTypeError) {
        self::create()->messages[$type][] = $msg;
        return ($type == Factor::MessageTypeError) ? FALSE : TRUE;
    }

    /**
     * @return array
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function resultAsArray() {
        return $this->messages;
    }

    /**
     * Implode result in a string with separator
     * @param string $separateBy String separator
     * @return array
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function resultAsString($separateBy = '<br/>') {
        $result[Factor::MessageTypeSuccess] = FALSE;
        $result[Factor::MessageTypeError] = FALSE;
        if (isset($this->messages[Factor::MessageTypeError])) {
            $result[Factor::MessageTypeError] = TRUE;
            $result['message'] = @implode($separateBy, $this->messages[Factor::MessageTypeError]);
        } else {
            $result[Factor::MessageTypeSuccess] = TRUE;
            $result['message'] = @implode($separateBy, $this->messages[Factor::MessageTypeSuccess]);
        }
        $result['report'] = $this->messages['report'];

        $result['content'] = $this->messages['content'];

        return $result;
    }

    /**
     * Get file name from Post
     * @return string
     * @param bool $fullPath Add full path
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function getFileNameFromPost($fullPath = FALSE) {
        $extension = 'csv';
        $target = 'csvfile';
        $prefix = 'product_csv';
        $posibleValues = [
                          1,
                          2,
                          3,
                         ];
        $uploadDir = ($fullPath) ? $this->uploadDir : '';

        $fileNumber = (in_array($_POST[$target], $posibleValues)) ? intval($_POST[$target]) : 1;
        return sprintf('%s%s_%d.%s', $uploadDir, $prefix, $fileNumber, $extension);
    }

    /**
     * Get file name from Post
     * @return array()
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public static function getSettingsFromPost() {
        return [
                'attributes'  => trim($_POST['attributes']),
                'import_type' => trim($_POST['import_type']),
                'delimiter'   => trim($_POST['delimiter']),
                'enclosure'   => trim($_POST['enclosure']),
                'encoding'    => trim($_POST['encoding']),
                'currency'    => trim($_POST['currency']),
                'languages'   => trim($_POST['language']),
               ];
    }

    /**
     * Get upload dir
     * @return string
     */
    public static function getUploadDir() {
        return self::create()->uploadDir;
    }

    /**
     * Make DB Backup file before start Import. Destination folder is "./application/backups"
     * @return ImportBootstrap
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function withBackup($forced = FALSE) {
        $this->messages['report']['DBBackuName'] = $this->messages['report']['DBBackup'] = FALSE;
        if (FALSE == $forced && !isset($_POST['withBackup'])) {
            return $this;
        }

        Backup::create()->createBackup('zip', 'import');
        $this->messages['report']['DBBackup'] = TRUE;
        $this->messages['report']['DBBackuName'] = $backupName;
        return $this;
    }

}
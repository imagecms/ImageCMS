<?php

namespace libraries;

/**
 * Creating DB backups
 * getting backup files
 * deleting old backup-files
 *
 * @author kolia
 */
class Backup {

    /**
     *
     * @var Backup 
     */
    protected static $instanse;

    /**
     * Backup directory
     * @var string
     */
    protected $directory = './application/backups';

    /**
     * Aviable extentions
     * @var array
     */
    protected $ext = array('sql', 'zip', 'gzip');

    /**
     * Patterns for backup file names
     * key - regex pattern, value - boolean (allow delete)
     * @var array
     */
    protected $filePatterns = array(
        // для файлів із авт. підбором імені.
        '/^[a-zA-Z]{1,10}_[0-9]{2}-[0-9]{2}-[0-9]{4}_[0-9]{2}.[0-9]{2}.[0-9]{2}.(zip|gzip|sql|txt)$/' => array(
            'allowDelete' => TRUE,
            'type' => "default"
        ),
        // для старіших бекапів із обновлення
        '/^[0-9]{10}.(zip|gzip|sql|txt)$/' => array(
            'allowDelete' => TRUE,
            'type' => "update"
        ),
        // для новіших бекапів із обновлення
        '/^backup.(zip|gzip|sql|txt)$/' => array(
            'allowDelete' => FALSE,
            'type' => "update"
        )
    );

    /**
     *
     * @var CodeIgniter
     */
    protected $ci;

    /**
     *
     * @var string
     */
    public $error;

    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->dbutil();
    }

    /**
     * 
     * @return Backup
     */
    public static function create() {
        (null !== self::$instanse) OR self::$instanse = new self();
        return self::$instanse;
    }

    /**
     * Setting the backup value into the DB
     * @param string $key
     * @param string|int $value
     */
    public function setSetting($key, $value) {
        $settings = $this->getSetting();
        if (!is_array($settings)) { //no settings yet
            $settings = array();
        }
        $settings[$key] = $value;
        return $this->ci->db->update('settings', array('backup' => serialize($settings)));
    }

    /**
     * Getting the backup value from the DB
     * @param string
     * @return mixed settings array or specified value
     */
    public function getSetting($key = NULL) {
        $result = $this->ci->db->select('backup')->get('settings');
        if($result){
            $row = $result->result_array();
        }else{
            $row = array();
        }
        
        $backupSettings = unserialize($row[0]['backup']);
        if (!is_array($backupSettings)) { // no settings yet
            return NULL;
        }
        if (!is_null($key)) {
            if (!key_exists($key, $backupSettings)) {
                return NULL;
            }
            return $backupSettings[$key];
        }
        return $backupSettings;
    }

    /**
     * Creating the backup file
     * @param string $ext extention (txt|zip|gzip)
     * @param string $fileName (optional) filename 
     * @return string|boolean filename|FALSE
     */
    public function createBackup($ext, $prefix = NULL, $fullName = FALSE) {
        if (is_really_writable($this->directory)) {
            if (is_null($prefix)) {
                $prefix = "sql";
            }
            if ($fullName === TRUE) {
                $fileName = $prefix;
            } else {
                $fileName = $prefix . "_" . date("d-m-Y_H.i.s");
            }
            $backup = & $this->ci->dbutil->backup(array('format' => $ext == 'sql' ? 'txt' : $ext));
            if (write_file($this->directory . '/' . $fileName . '.' . $ext, $backup)) {
                return $this->directory . '/' . $fileName . '.' . $ext;
            }
            $this->error = 'Невозможно создать файл, проверте папку /application/backups на возможность записи';
            return FALSE;
        } else {
            $this->error = 'Невозможно создать снимок базы, проверте папку /application/backups на возможность записи';
            return FALSE;
        }
    }

    /**
     * 
     * @return boolean
     */
    public function deleteOldFiles() {
        $term = $this->getSetting('backup_term');
        $maxSize = ($this->getSetting('backup_maxsize') * 1024 * 1024);

        $maxSize = 5 * 1024 * 1024;
        // if time of file will be lower then delete
        $time = time() - (60 * 60 * 24 * 30.5 * $term);

        $files = $this->backupFiles();
        // get summary backup size
        $size = 0;
        foreach ($files as $file) {
            $size += $file['size'];
        }

        // start deleting if overload more then max size
        if ($size > $maxSize) {
            $deleteSize = $size - $maxSize;
            $deletEdOnSize = 0;
            $filesCount = 0;
            do {
                $fileToDelete = $this->getOldestFileToDelete();
                if ($fileToDelete == FALSE) { // if FALSE then no more files to delete
                    break;
                }
                if ($fileToDelete['timeUpdate'] > $time) { // check if not overrun max date
                    break;
                }
                $filesCount++;
                $deletEdOnSize += $fileToDelete['size'];
                unlink($this->directory . "/" . $fileToDelete['filename']);
            } while ($deletEdOnSize < $deleteSize);

            return array('count' => $filesCount, 'size' => $deletEdOnSize);
        }
        return FALSE;
    }

    /**
     * 
     * @return boolean
     */
    public function getOldestFileToDelete() {
        $files_ = $this->backupFiles();
        // getting only files that allow to delete by pattern
        $files = array();
        foreach ($files_ as $file) {
            if ($this->checkFileName($file['filename'], 'allowDelete') && $file['locked'] != 1)
                $files[] = $file;
        }

        if (!count($files) > 0)
            return FALSE;

        $minKey = 0;
        $minTime = $files[0]['timeUpdate'];
        for ($i = 1; $i < count($files); $i++) {
            if ($minTime > $files[$i]['timeUpdate']) {
                $minTime = $files[$i]['timeUpdate'];
                $minKey = $i;
            }
        }
        return $files[$minKey];
    }

    /**
     * Getting list of backup files
     * @return array
     */
    public function backupFiles() {
        $lockedFiles = $this->getSetting('lockedFiles');
        if (!is_array($lockedFiles)) {
            $lockedFiles = array();
        }
        $files = array();
        if ($dir = opendir($this->directory)) {
            while (FALSE !== ($fileName = readdir($dir))) {
                if ($fileName != "." & $fileName !== "..") {
                    if (TRUE === $this->checkFileName($fileName)) {
                        $file = array(
                            'filename' => $fileName,
                            'allowDelete' => $this->checkFileName($fileName, 'allowDelete') == TRUE ? 1 : 0,
                            'type' => $this->checkFileName($fileName, 'type'),
                            'ext' => pathinfo($fileName, PATHINFO_EXTENSION),
                            'size' => filesize($this->directory . "/" . $fileName),
                            'timeUpdate' => filemtime($this->directory . "/" . $fileName)
                        );
                        if ($file['type'] == "default") {
                            $prefIndex = strpos($fileName, "_");
                            $file['prefix'] = substr($fileName, 0, $prefIndex);
                        } else {
                            $file['prefix'] = 'update';
                        }
                        if (in_array($fileName, $lockedFiles)) {
                            $file['locked'] = 1;
                        } else {
                            $file['locked'] = 0;
                        }
                        $files[] = $file;
                    }
                }
            }
            closedir($dir);
        }
        return $files;
    }

    /**
     * Checking file name by pattern
     * @param string $fileName 
     * @param boolean $returnValue
     * @return boolean
     */
    protected function checkFileName($fileName, $returnValue = FALSE) {
        foreach ($this->filePatterns as $pattern => $params) {
            if (preg_match($pattern, $fileName)) {
                return $returnValue !== FALSE ? $params[$returnValue] : TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Deleting backup file
     * @param string $file
     * @return boolean true on success, false on error
     */
    public function deleteFile($file) {
        if (FALSE === $this->checkFileName($file, "allowDelete")) {
            return FALSE;
        }
        if (file_exists($this->directory . "/" . $file)) {
            return unlink($this->directory . "/" . $file);
        }
        return FALSE;
    }

}

?>

<?php

namespace libraries;

/**
 * Creating DB backups
 * getting backup files
 * deleting old backup-files
 *
 * @author kolia
 */
class Backup
{

    /**
     *
     * @var Backup
     */
    protected static $instance;

    /**
     * Backup directory
     * @var string
     */
    protected $directory = BACKUPFOLDER;

    /**
     * Aviable extentions
     * @var array
     */
    protected $ext = [
                      'sql',
                      'zip',
                      'gzip',
                     ];

    /**
     * Patterns for backup file names
     * key - regex pattern, value - boolean (allow delete)
     * @var array
     */
    protected $filePatterns = [
        // для файлів із авт. підбором імені.
                               '/^[a-zA-Z]{1,10}_[0-9]{2}-[0-9]{2}-[0-9]{4}_[0-9]{2}.[0-9]{2}.[0-9]{2}.(zip|gzip|sql|txt)$/' => [
                                                                                                                                 'allowDelete' => TRUE,
                                                                                                                                 'type'        => 'default',
                                                                                                                                ],
                               // для старіших бекапів із обновлення
                               '/^[0-9]{10}.(zip|gzip|sql|txt)$/'                                                            => [
                                                                                                                                 'allowDelete' => TRUE,
                                                                                                                                 'type'        => 'update',
                                                                                                                                ],
                               // для новіших бекапів із обновлення
                               '/^backup.(zip|gzip|sql|txt)$/'                                                               => [
                                                                                                                                 'allowDelete' => FALSE,
                                                                                                                                 'type'        => 'update',
                                                                                                                                ],
                              ];

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
        (null !== self::$instance) OR self::$instance = new self();
        return self::$instance;
    }

    /**
     * Setting the backup value into the DB
     * @param string $key
     * @param string|int $value
     */
    public function setSetting($key, $value) {
        $settings = $this->getSetting();
        if (!is_array($settings)) { //no settings yet
            $settings = [];
        }
        $settings[$key] = $value;
        return $this->ci->db->update('settings', ['backup' => serialize($settings)]);
    }

    /**
     * Getting the backup value from the DB
     * @param string
     * @param string $key
     * @return mixed settings array or specified value
     */
    public function getSetting($key = NULL) {
        $result = $this->ci->db->select('backup')->get('settings');
        if ($result) {
            $row = $result->result_array();
        } else {
            $row = [];
        }

        $backupSettings = unserialize($row[0]['backup']);
        if (!is_array($backupSettings)) { // no settings yet
            return NULL;
        }
        if ($key != null) {
            if (!array_key_exists($key, $backupSettings)) {
                return NULL;
            }
            return $backupSettings[$key];
        }
        return $backupSettings;
    }

    /**
     * Creating the backup file
     * @param string $ext extention (txt|zip|gzip)
     * @param string $prefix
     * @param bool|string $fullName (optional) filename
     * @param array $params
     * @return false|string filename|FALSE
     */
    public function createBackup($ext, $prefix = NULL, $fullName = FALSE, $params = []) {
        if (is_really_writable($this->directory)) {
            if ($prefix == null) {
                $prefix = 'sql';
            }
            if ($fullName === TRUE) {
                $fileName = $prefix;
            } else {
                $fileName = $prefix . '_' . date('d-m-Y_H.i.s');
            }

            $params = [
                       'format' => $ext == 'sql' ? 'txt' : $ext,
                      ];

            $currentDbInstance = $this->ci->db;

            $this->initBackupDB();

            $backup = & $this->ci->dbutil->backup($params);

            $this->ci->db = $currentDbInstance;

            if (write_file($this->directory . '/' . $fileName . '.' . $ext, $backup)) {
                return $this->directory . '/' . $fileName . '.' . $ext;
            }
            $this->error = 'Невозможно создать файл, проверте папку ' . BACKUPFOLDER . ' на возможность записи';
            return FALSE;
        } else {
            $this->error = 'Невозможно создать снимок базы, проверте папку ' . BACKUPFOLDER . ' на возможность записи';
            return FALSE;
        }
    }

    /**
     * Init DB for backup with msql driver
     */
    private function initBackupDB() {
        // this is just all config keys
        $configNames = [
                        'hostname',
                        'username',
                        'password',
                        'database',
                        'dbdriver',
                        'dbprefix',
                        'pconnect',
                        'db_debug',
                        'cache_on',
                        'cachedir',
                        'char_set',
                        'dbcollat',
                        'swap_pre',
                        'autoinit',
                        'stricton',
                       ];

        $config = [];
        foreach ($configNames as $key) {
            $config[$key] = $key == 'dbdriver' ? 'mysql' : $this->ci->db->$key;
        }

        $this->ci->db = $this->ci->load->database($config, TRUE);
        $this->ci->load->dbutil();
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
            $deleteEdOnSize = 0;
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
                $deleteEdOnSize += $fileToDelete['size'];
                unlink($this->directory . '/' . $fileToDelete['filename']);
            } while ($deleteEdOnSize < $deleteSize);

            return [
                    'count' => $filesCount,
                    'size'  => $deleteEdOnSize,
                   ];
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
        $files = [];
        foreach ($files_ as $file) {
            if ($this->checkFileName($file['filename'], 'allowDelete') && $file['locked'] != 1) {
                $files[] = $file;
            }
        }

        if (!count($files) > 0) {
            return FALSE;
        }

        $minKey = 0;
        $minTime = $files[0]['timeUpdate'];

        $countFiles = count($files);
        for ($i = 1; $i < $countFiles; $i++) {
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
            $lockedFiles = [];
        }
        $files = [];
        if ($dir = opendir($this->directory)) {
            while (FALSE !== ($fileName = readdir($dir))) {
                if ($fileName != '.' & $fileName !== '..') {
                    if (TRUE === $this->checkFileName($fileName)) {
                        $file = [
                                 'filename'    => $fileName,
                                 'allowDelete' => $this->checkFileName($fileName, 'allowDelete') == TRUE ? 1 : 0,
                                 'type'        => $this->checkFileName($fileName, 'type'),
                                 'ext'         => pathinfo($fileName, PATHINFO_EXTENSION),
                                 'size'        => filesize($this->directory . '/' . $fileName),
                                 'timeUpdate'  => filemtime($this->directory . '/' . $fileName),
                                ];
                        if ($file['type'] == 'default') {
                            $prefIndex = strpos($fileName, '_');
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

        foreach ($files as $key => $row) {
            $backaps[$key] = $row['timeUpdate'];
        }

        array_multisort($backaps, SORT_DESC, $files);

        return $files;
    }

    /**
     * Checking file name by pattern
     * @param string $fileName
     * @param boolean|string $returnValue
     * @return boolean|string
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
        if (FALSE === $this->checkFileName($file, 'allowDelete')) {
            return FALSE;
        }
        if (file_exists($this->directory . '/' . $file)) {
            return unlink($this->directory . '/' . $file);
        }
        return FALSE;
    }

}
<?php

use libraries\Backup;

/**
 * ImageCMS System Update Class
 * @copyright ImageCMS(c) 2013
 * @version 0.1 big start
 */
class Update
{

    private $arr_files;

    private $files_dates = [];

    private $restore_files = [];

    /**
     * update server
     * @var string
     */
    private $US = 'http://upd.imagecms.net/';

    /**
     * path to update server
     * @var string
     */
    private $pathUS;

    /**
     * папки, які не враховувати при обновлені
     * @var array
     */
    private $distinctDirs = [
                             '.',
                             '..',
                             '.git',
                             'uploads',
                             'cache',
                             'templates',
                             'tests',
                             'captcha',
                             'nbproject',
                             'uploads_site',
                             'backups',
                             'cmlTemp',
                            ];

    /**
     * файли, які не враховувати при обновлені
     * @var array
     */
    private $distinctFiles = [
                              'md5.txt',
                              '.htaccess',
                              'config.php',
                             ];

    /**
     * instance of ci
     * @var MY_Controller
     */
    public $ci;

    /**
     * SoapClient
     * @var SoapClient
     */
    public $client;

    /**
     *
     * @var array
     */
    public $settings;

    public function __construct() {

        $this->ci = &get_instance();
        $this->pathUS = $this->US . 'application/modules/update/UpdateService.wsdl';
        $this->client = new SoapClient($this->pathUS);
        $this->settings = $this->getSettings();
    }

    /**
     * check new Version
     * @return mixed
     * @throws Exception
     */
    public function getStatus() {

        $domen = $this->ci->input->server('SERVER_NAME');

        $result = $this->client->getStatus($domen, BUILD_ID, IMAGECMS_NUMBER);

        if (mb_strlen($result) < 5 and $result == !0) {
            throw new Exception(lang('Cant get status', 'admin'));
        }
        $this->setSettings(['newVersion' => $result]);
        $this->setSettings(['checkTime' => time()]);

        return unserialize($result);
    }

    /**
     * getting hash from setting
     * @return array
     * @throws Exception
     */
    public function getHashSum() {

        $domen = $this->ci->input->server('SERVER_NAME');
        $key = $this->getSettings('careKey');

        $result = $this->client->getHashSum($domen, IMAGECMS_NUMBER, BUILD_ID, $key);

        $error = (array) json_decode($result);
        if ($error['error']) {
            throw new Exception($error['error']);
        }

        write_file(BACKUPFOLDER . 'md5.txt', $result);
        $result = (array) json_decode($result);

        $this->setSettings(['checkTime' => time()]);

        return $result;
    }

    public function getUpdate() {

        ini_set('soap.wsdl_cache_enabled', '0');
        $domain = $this->ci->input->server('SERVER_NAME');

        $href = $this->client->getUpdate($domain, IMAGECMS_NUMBER, $this->settings['careKey']);
        if (!$href) {
            throw new Exception(lang('Wrong generated hash code', 'admin'));
        }

        $all_href = $this->US . 'update/takeUpdate/' . $href . '/' . $domain . '/' . IMAGECMS_NUMBER . '/' . BUILD_ID;
        file_put_contents(BACKUPFOLDER . 'updates.zip', file_get_contents($all_href));
    }

    /**
     *
     * @param string $file
     * @return string
     */
    public function getOldMD5File($file = 'md5.txt') {

        return (array) json_decode(read_file($file));
    }

    /**
     * zipping files
     * @param array $files
     * @return bool
     * @throws Exception
     */
    public function add_to_ZIP($files = []) {

        if (empty($files)) {
            throw new Exception(lang('Nothing to create', 'admin'));
        }

        $zip = new ZipArchive();
        $filename = BACKUPFOLDER . 'backup.zip';

        if (file_exists($filename)) {

            $nameFolder = filemtime($filename);
            rename($filename, BACKUPFOLDER . "$nameFolder.zip");
            touch($filename, $nameFolder);

        }

        if ($zip->open($filename, ZipArchive::CREATE) !== true) {
            throw new Exception(lang('Dont have permissions folder backup', 'admin'));
        }

        foreach (array_keys($files) as $key) {
            if (!is_readable('.' . $key)) {
                continue;
            }
            $zip->addFile('.' . $key, $key);
        }
        $zip->close();
    }

    /**
     * @throws Exception
     */
    public function createBackUp() {

        $old = $this->getOldMD5File(BACKUPFOLDER . 'md5.txt');
        $array = $this->parse_md5();
        $diff = array_diff($array, $old);
        chmod(BACKUPFOLDER, 0755);

        if (!is_writable(BACKUPFOLDER)) {
            throw new Exception(lang('Dont have permissions folder backup', 'admin'));
        }

        $this->add_to_ZIP($diff);

        $filename = BACKUPFOLDER . 'backup.zip';
        $zip = new ZipArchive();
        $zip->open($filename);

        $db = $this->db_backup();
        $zip->addFile(BACKUPFOLDER . $db, $db);
        $zip->close();

        chmod(BACKUPFOLDER . $db, 0777);
        unlink(BACKUPFOLDER . $db);
    }

    /**
     * restore file to zip
     * @param string $file
     * @param mixed|string $destination
     * @return bool
     * @throws Exception
     */
    public function restoreFromZIP($file, $destination = FCPATH) {

        if (!$file) {
            $file = BACKUPFOLDER . 'backup.zip';
        }

        if (!file_exists($file) || substr(decoct(fileperms($destination)), 2) != '777') {
            throw  new Exception(lang('Dont have permissions folder backup', 'admin'));
        }

        $zip = new ZipArchive();
        $zip->open($file);
        $rez = $zip->extractTo($destination);
        $zip->close();

        if ($rez) {
            $this->db_restore($destination . '/backup.sql');
        }

        return $rez;
    }

    /**
     * Бере контрольні суми файлів текущих файлів і файлів старої теперішньої версії
     * Записує іх у відповідні файли з настройок, як серіалізований масив ключ - шлях до файлу, значення - контрольна сума
     * запускати два рази переоприділивши $this->path_parse
     * $this->path_parse = realpath('') текущі.
     * $this->path_parse = rtrim($this->dir_old_upd, '\')
     * @param null|string $directory
     * @return array
     */
    public function parse_md5($directory = null) {

        $dir = null === $directory ? realpath('') : $directory;

        $handle = opendir($dir);
        if ($handle) {
            while (FALSE !== ($file = readdir($handle))) {
                if (!in_array($file, $this->distinctDirs)) {
                    if (is_file($dir . DIRECTORY_SEPARATOR . $file) && !in_array($file, $this->distinctFiles)) {
                        $this->arr_files[str_replace(realpath(''), '', $dir) . DIRECTORY_SEPARATOR . $file] = md5_file($dir . DIRECTORY_SEPARATOR . $file);
                        $this->files_dates[str_replace(realpath(''), '', $dir) . DIRECTORY_SEPARATOR . $file] = filemtime($dir . DIRECTORY_SEPARATOR . $file);
                    }
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $file)) {
                        $this->parse_md5($dir . DIRECTORY_SEPARATOR . $file);
                    }
                }
            }
        }

        return $this->arr_files;
    }

    /**
     * database backup
     * @return string
     */
    public function db_backup() {

        if (is_really_writable(BACKUPFOLDER)) {
            $this->ci->load->dbutil();
            $filePath = Backup::create()->createBackup('sql', 'backup', TRUE);
            return pathinfo($filePath, PATHINFO_BASENAME);
        } else {
            showMessage(langf('Can not create a database snapshot, Check the folder {0} on the ability to record', 'admin', [BACKUPFOLDER]));
        }
    }

    /**
     * database restore
     * @param string $file
     * @return boolean
     */
    public function db_restore($file) {

        if (empty($file)) {
            return FALSE;
        }

        if (is_readable($file)) {
            $restore = file_get_contents($file);
            return $this->query_from_file($restore);
        }
        return FALSE;
    }

    /**
     * Create restore files list
     * @return boolean|array
     */
    public function restore_files_list() {

        if (is_readable(BACKUPFOLDER)) {
            $dh = opendir(BACKUPFOLDER);
            while ($filename = readdir($dh)) {
                if (filetype($filename) != 'dir') {
                    $file_type = '';
                    preg_match('/\.[a-z]{2,3}/', $filename, $file_type);
                    if ($file_type[0] == '.zip') {
                        $zip = new ZipArchive();
                        $zip->open(BACKUPFOLDER . $filename);
                        if ($zip->statName('backup.sql')) {
                            $this->restore_files[] = [
                                                      'name'        => $filename,
                                                      'size'        => round(filesize(BACKUPFOLDER . $filename) / 1024 / 1024, 2),
                                                      'create_date' => filemtime(BACKUPFOLDER . $filename),
                                                     ];
                        }
                        $zip->close();
                    }
                }
            }
            return $this->restore_files;
        } else {
            return FALSE;
        }
    }

    /**
     * remove dir recursive
     * @param string $dir - path to directory
     */
    public function removeDirRec($dir) {

        if ($objs = glob($dir . '/*')) {
            foreach ($objs as $obj) {
                is_dir($obj) ? $this->removeDirRec($obj) : unlink($obj);
            }
        }
        if (is_dir($dir)) {
            rmdir($dir);
        }
    }

    /**
     * db update
     * @param string $file_name
     * @return boolean
     */
    public function db_update($file_name = 'sql_19-08-2013_17.16.14.txt') {

        if (is_readable(BACKUPFOLDER . $file_name)) {
            $restore = file_get_contents(BACKUPFOLDER . $file_name);
            return $this->query_from_file($restore);
        } else {
            return FALSE;
        }
    }

    /**
     * ganerate sql query from file
     * @param string $file
     * @return boolean
     */
    public function query_from_file($file) {

        $string_query = rtrim($file, "\n;");
        $array_query = explode(";\n", $string_query);

        foreach ($array_query as $query) {
            if ($query) {
                if (!$this->ci->db->query($query)) {
                    echo 'Невозможно виполнить запрос: <br>';
                    return FALSE;
                }
            }
        }
        return TRUE;
    }

    public function get_files_dates() {

        if (!empty($this->files_dates)) {
            return $this->files_dates;
        } else {
            return FALSE;
        }
    }

    /**
     * @param bool|string $param
     * @return string
     */
    public function getSettings($param = false) {

        $settings = $this->ci->db
            ->get('settings')
            ->row_array();
        $settings = unserialize($settings['update']);

        if (!$param) {
            return $settings;
        } else {
            return $settings[$param];
        }
    }

    /**
     *
     * @param array $settings
     * @return bool
     */
    public function setSettings($settings) {

        if (!is_array($settings)) {
            return FALSE;
        }
        $s = (array) $this->getSettings();

        foreach ($settings as $key => $value) {
            $s[$key] = $value;
        }

        return $this->ci->db
            ->set('update', serialize($s))
            ->update('settings');
    }

}
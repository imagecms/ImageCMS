<?php

/**
 * ImageCMS System Update Class
 * @copyright ImageCMS(c) 2013
 * @version 0.1 big start
 */
class Update {

    private $arr_files;
    private $files_dates = array();
    private $restore_files = array();

    /**
     * update server
     * @var string
     */
    private $US = "http://upd.imagecms.net/";

    /**
     * path to update server
     * @var string
     */
    private $pathUS;

    /**
     * папки, які не враховувати при обновлені
     * @var array
     */
    private $distinctDirs = array(
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
    );

    /**
     * файли, які не враховувати при обновлені
     * @var array
     */
    private $distinctFiles = array(
        'product.php',
        'category.php',
        'brand.php',
        'cart.php',
        'md5.txt',
        '.htaccess',
        'config.php'
    );

    /**
     * instance of ci
     * @var CI
     */
    public $ci;

    /**
     * SoapClient
     * @var SoapClient
     */
    public $client;

    public function __construct() {
        $this->ci = &get_instance();
        $this->pathUS = $this->US . "application/modules/update/UpdateService.wsdl";
        $this->client = new SoapClient($this->pathUS);
    }

    /**
     * check for new version
     * @return array return info about new relise or 0 if version is actual
     */
    public function getStatus() {
        if (time() >= $this->getSettings('checkTime') + 60 * 60 * 10) {
            $domen = $_SERVER['SERVER_NAME'];
            $result = $this->client->getStatus($domen, BUILD_ID, IMAGECMS_NUMBER);

            $this->setSettings(array("newVersion" => $result));
            $this->setSettings(array("checkTime" => time()));
        } else {
            $result = $this->getSettings('newVersion');
        }
        return unserialize($result);
    }

    /**
     * getting hash from server
     * @return array Array of hashsum files new version
     */
    public function getHashSum() {
        if (time() >= $this->getSettings('checkTime') + 60 * 60 * 10) {
            $domen = $_SERVER['SERVER_NAME'];
            $key = $this->getSettings('careKey');
            $result = $this->client->getHashSum($domen, IMAGECMS_NUMBER, BUILD_ID, $key);

            write_file('./application/backups/md5.txt', $result);
            $result = (array) json_decode($result);

            $this->setSettings(array("checkTime" => time()));
        } else {
            $result = (array) json_decode(read_file('./application/backups/md5.txt'));
        }

        return $result;
    }

    public function getUpdate() {
        ini_set("soap.wsdl_cache_enabled", "0");
        $domen = $_SERVER['SERVER_NAME'];
        $href = $this->client->getUpdate($domen, IMAGECMS_NUMBER, $this->getSettings('careKey'));
        $all_href = $this->US . 'update/takeUpdate/' . $href . '/' . $domen . '/' . IMAGECMS_NUMBER . '/' . BUILD_ID;
        file_put_contents('./application/backups/updates.zip', file_get_contents($all_href));
    }

    /**
     * form XML doc
     */
    public function formXml() {
        $modules = get_dir_file_info('./application/modules/');
        $array = array();
        foreach ($modules as $key => $modul) {
            $ver = read_file("./application/modules/$key/module_info.php");
            preg_match("/'version'(\s*)=>(\s*)'(.*)',/", $ver, $find);
            $array[$key] = end($find);
        }

        $array['core'] = IMAGECMS_NUMBER;
        header('content-type: text/xml');
        $xml = "<?xml version='1.0' encoding='UTF-8'?>" . "\n" .
                "<КонтейнерСписков ВерсияСхемы='0.1'  ДатаФормирования='" . date('Y-m-d') . "'>" . "\n";
        foreach ($array as $key => $arr) {
            $xml.='<modul>';
            $xml.="<name>$key</name>";
            $xml.="<version>$arr</version>";
            $xml.='</modul>';
        }
        $xml .= "</КонтейнерСписков>\n";
        echo $xml;
        exit;
    }

    public function getOldMD5File($file = 'md5.txt') {
        return (array) json_decode(read_file($file));
    }

    /**
     * zipping files
     * @param array $files
     */
    public function add_to_ZIP($files = array()) {
        if (empty($files))
            return FALSE;

        $zip = new ZipArchive();
        $time = time();
        $filename = "./application/backups/backup.zip";

        if (file_exists($filename))
            rename($filename, "./application/backups/$time.zip");

        if ($zip->open($filename, ZipArchive::CREATE) !== TRUE)
            exit("cannot open <$filename>\n");

        foreach ($files as $key => $value)
            $zip->addFile('.' . $key, $key);

//        echo "numfiles: " . $zip->numFiles . "\n";
//        echo "status:" . $zip->status . "\n";

        $zip->close();
    }

    public function createBackUp() {
        $old = $this->getOldMD5File('./application/backups/md5.txt');
        $array = $this->parse_md5();
        $diff = array_diff($array, $old);
        $this->add_to_ZIP($diff);

        $filename = "./application/backups/backup.zip";
        $zip = new ZipArchive();
        $zip->open($filename);
        $db = $this->db_backup();
        $zip->addFile('./application/backups/' . $db, $db);
        $zip->close();

        chmod('./application/backups/' . $db, 0777);
        unlink('./application/backups/' . $db);
    }

    /**
     * restore files from zip
     * @param string $file path to zip file
     * @param string $destination path to destination folder
     */
    public function restoreFromZIP($file = "./application/backups/backup.zip", $destination = '.') {
        if (!file_exists($file) || substr(decoct(fileperms($destination)), 2) != '777')
            return FALSE;

        $zip = new ZipArchive();
        $zip->open($file);
        $rez = $zip->extractTo($destination);
        $zip->close();

        if ($rez)
            $this->db_restore($destination . '/backup.sql');

        return $rez;
    }

    /**
     * Бере контрольні суми файлів текущих файлів і файлів старої теперішньої версії
     * Записує іх у відповідні файли з настройок, як серіалізований масив ключ - шлях до файлу, значення - контрольна сума
     * запускати два рази переоприділивши $this->path_parse
     * $this->path_parse = realpath('') текущі.
     * $this->path_parse = rtrim($this->dir_old_upd, '\')
     * @return Array
     */
    public function parse_md5($directory = null) {

        $dir = null === $directory ? realpath('') : $directory;

        $handle = opendir($dir);
        if ($handle)
            while (FALSE !== ($file = readdir($handle)))
                if (!in_array($file, $this->distinctDirs)) {
                    if (is_file($dir . DIRECTORY_SEPARATOR . $file) && !in_array($file, $this->distinctFiles)) {
                        $this->arr_files[str_replace(realpath(''), '', $dir) . DIRECTORY_SEPARATOR . $file] = md5_file($dir . DIRECTORY_SEPARATOR . $file);
                        $this->files_dates[str_replace(realpath(''), '', $dir) . DIRECTORY_SEPARATOR . $file] = filemtime($dir . DIRECTORY_SEPARATOR . $file);
                    }
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $file))
                        $this->parse_md5($dir . DIRECTORY_SEPARATOR . $file);
                }

        return $this->arr_files;
    }

    /**
     * Заміна файлів з обновлення
     * 1. Заміняються файли, які не відрізняються від старої текущої версії
     * 2. заміняються файли які вдалося обєднати
     * 3. Створюється файл з приставкою _update в текущій папці даного файлу (користувач сам обєднює такі файли або обєднює такі файли система, не несучи за це відповідальності)
     */
    public function replacement() {

        $arr_curr_file = unserialize(file_get_contents($this->file_mass_curr));
        $diff_arr_file = unserialize(file_get_contents($this->file_mass_diff));
        $dont_arr_marge_file = unserialize(file_get_contents($this->file_dont_marge));
        foreach ($arr_curr_file as $file => $data) {
            if (file_exists($this->dir_upd . $file)) {
                if (!in_array($this->dir_upd . $file, $diff_arr_file)) {
                    unlink($this->dir_curr . $file);
                    copy($this->dir_upd . $file, $this->dir_curr . $file);
                } else {
                    if (!in_array($this->dir_upd . $file, $dont_arr_marge_file)) {
                        unlink($this->dir_curr . $file);
                        copy($this->dir_marge . $file, $this->dir_curr . $file);
                    }
                    else
                        copy($this->dir_upd . $file . '_update', $this->dir_curr . $file);
                }
            }
        }
    }

    /**
     * database backup
     */
    public function db_backup() {
        if (is_really_writable('./application/backups')) {
            $this->ci->load->dbutil();
            $filePath = \libraries\Backup::create()->createBackup("sql", "backup", TRUE);
            return pathinfo($filePath, PATHINFO_BASENAME);
        } else {
            showMessage('Невозможно создать снимок базы, проверте папку /application/backups на возможность записи');
        }

        return $name;
    }

    /**
     * database restore
     * @param string $file
     */
    public function db_restore($file) {
        if (empty($file))
            return FALSE;

        if (is_readable($file)) {
            $restore = file_get_contents($file);
            return $this->query_from_file($restore);
        } else {
            return FALSE;
        }
    }

    /**
     * Create restore files list
     */
    public function restore_files_list() {
        if (is_readable('./application/backups/')) {
            $dh = opendir('./application/backups/');
            while ($filename = readdir($dh)) {
                if (filetype($filename) != 'dir') {
                    $file_type = '';
                    preg_match('/\.[a-z]{2,3}/', $filename, $file_type);
                    if ($file_type[0] == '.zip') {
                        $zip = new ZipArchive();
                        $zip->open('./application/backups/' . $filename);
                        if ($zip->statName('backup.sql')) {
                            $this->restore_files[] = array(
                                'name' => $filename,
                                'size' => round(filesize('./application/backups/' . $filename) / 1024 / 1024, 2),
                                'create_date' => filemtime('./application/backups/' . $filename)
                            );
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
        if ($objs = glob($dir . "/*"))
            foreach ($objs as $obj)
                is_dir($obj) ? $this->removeDirRec($obj) : unlink($obj);
        if (is_dir($dir))
            rmdir($dir);
    }

    /**
     * db update
     * @param string $file_name
     */
    public function db_update($file_name = 'sql_19-08-2013_17.16.14.txt') {
        if (is_readable('./application/backups/' . $file_name)) {
            $restore = file_get_contents('./application/backups/' . $file_name);
            $this->query_from_file($restore);
        } else {
            return FALSE;
        }
    }

    /**
     * ganerate sql query from file
     * @param string $file
     */
    public function query_from_file($file) {
        $string_query = rtrim($file, "\n;");
        $array_query = explode(";\n", $string_query);

        foreach ($array_query as $query) {
            if ($query) {
                if (!$this->ci->db->query($query)) {
                    echo 'Невозможно виполнить запрос: <br>';
                    return FALSE;
                } else {
//                    return TRUE;
                }
            }
        }
    }

    public function get_files_dates() {
        if (!empty($this->files_dates)) {
            return $this->files_dates;
        } else {
            return FALSE;
        }
    }

    public function getSettings($param = false) {
        $settings = $this->ci->db
                ->get('settings')
                ->row_array();
        $settings = unserialize($settings['update']);

        if (!$param)
            return $settings;
        else
            return $settings[$param];
    }

    /**
     *
     * @param array $settings
     * @return bool
     */
    public function setSettings($settings) {
        if (!is_array($settings))
            return FALSE;
        $s = (array) $this->getSettings();

        foreach ($settings as $key => $value) {
            $s[$key] = $value;
        }

        return $this->ci->db
                        ->set('update', serialize($s))
                        ->update('settings');
    }

}
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Cache Class
 */
class Cache {

    public $CI;
    public $get = 0;
    public $set = 0;
    public $disableCache = 0;
//Cache config
// TODO: Rewrite auto_clean to fetch date from DB
    public $_Config = array('store' => 'cache',
        'auto_clean' => 500, //Random number to run _Clean();
        'auto_clean_life' => 3600,
        'auto_clean_all' => TRUE,
        'ttl' => 3600); //one hour

    public function __construct() {
        $this->CI = & get_instance();
        if ($this->CI->config->item('cache_path') != '') {
            $this->_Config['default_store'] = $this->CI->config->item('cache_path');
            $this->_Config['store'] = $this->CI->config->item('cache_path');
        } else {
            $this->_Config['default_store'] = BASEPATH . 'cache/';
            $this->_Config['store'] = BASEPATH . 'cache/';
        }
        $this->disableCache = (boolean) $this->CI->config->item('disable_cache');

// Is cache folder wratible?
        if (!is_writable($this->_Config['store'])) {
            $this->log_cache_error('Constructor :: Store ' . $this->_Config['store'] . ' is not writable');
        }

// autoclean if random is 1
        if (($this->_Config['auto_clean'] !== false) && (rand(1, $this->_Config['auto_clean']) === 1)) {
            $this->Clean();
        }
    }

    /**
     * Fetch Cached File
     *
     * @param string $key
     *
     * @return mixed
     */
    public function fetch($key, $group = FALSE) {
        if ($this->disableCache === true) {
            return false;
        }

        $this->set_group($group);

        if (($ret = $this->_fetch($key)) === false) {
            return false;
        } else {
            return $ret;
        }
    }

    private function _fetch($key) {
        $file = $this->_Config['store'] . 'cache_' . $this->generatekey($key);
        $this->set_default_group();

        if (!file_exists($file))
            return FALSE;

        if (!($fp = fopen($file, 'r'))) {
            $this->log_cache_error('Fetch :: Error Opening File ' . $file);
            return FALSE;
        }

// Only reading
        flock($fp, LOCK_SH);

// Cache data
        $data = unserialize(file_get_contents($file));
        fclose($fp);

// if cache not expried return cache file
        if (time() < $data['expire']) {
            $this->get++;
            return $data['cache'];
        } else {
            return FALSE;
        }
    }

    /**
     * Fetch cached function
     */
    public function fetch_func($object, $func, $args = array()) {

        $file = $this->_Config['store'] . 'cache_' . $this->generatekey(get_class($object) . '::' . $func . '::' . serialize($args));
        $this->set_default_group();

        if (!file_exists($file))
            return false;

        if (!($fp = fopen($file, 'r'))) {
            $this->log_cache_error('Fetch :: Error Opening File ' . $file);
            return false;
        }

        flock($fp, LOCK_SH);

        $data = unserialize(file_get_contents($file));
        fclose($fp);

        if (time() < $data['expire']) {
            $this->get++;
            return $data['cache'];
        } else {
            return FALSE;
        }
    }

    /**
     * Store Cache Item
     *
     * @param string  $key
     * @param mixed   $data
     * @param int     $ttl
     *
     * @return bool
     */
    public function store($key, $data, $ttl = false, $group = false) {
        if (!$ttl)
            $ttl = $this->_Config['ttl'];

        $this->set_group($group);

        $file = $this->_Config['store'] . 'cache_' . $this->generatekey($key);
        $data = serialize(array('expire' => ($ttl + time()), 'cache' => $data));

        if (!($fp = fopen($file, 'a+')))
            $this->log_cache_error('Store :: Error Opening file ' . $file);

        flock($fp, LOCK_EX);
        fseek($fp, 0);
        ftruncate($fp, 0);   // Clear file

        if (fwrite($fp, $data) === false)
            $this->log_cache_error('Store :: Error writing to file ' . $file);

        fclose($fp);

        $this->set_default_group();
        $this->set++;

        return true;
    }

    /**
     * Group Function
     *
     * @param string $group
     *
     * @access public
     */
    public function set_group($group) {
        if ($group == FALSE) {
            $this->_Config['store'] = $this->_Config['default_store'];
            return;
        }

        if (!is_dir($this->_Config['store'] . $group)) {
            mkdir($this->_Config['store'] . $group);
            @chmod($this->_Config['store'] . $group, 0777);
        }
        $this->_Config['store'] .= $group . '/';
    }

    public function set_default_group() {
        $this->_Config['store'] = $this->_Config['default_store'];
    }

    /**
     * Cache Function
     *
     * @return mixed
     * @access public
     */
    function call($func = array(), $args = array(), $ttl = false) {
        if ($ttl == false) {
            $ttl = $this->_Config['ttl'];
        }

        $arguments = func_get_args();

//class_name::function
        $key = get_class($arguments[0][0]) . '::' . $arguments[0][1] . '::' . serialize($args);

        if (($cache = $this->fetch($key)) !== false) {
            $this->set_default_group();
            return $cache;
        } else {

            $target = array_shift($arguments);
            $result = call_user_func_array($target, $args);

            $this->set_default_group();

            if (!$this->store($key, $result, false))
                return false;

            return $result;
        }
    }

    public function Clean() {
        if (!($dh = opendir($this->_Config['store']))) {
            $this->log_cache_error('Clean :: Error Opening Store ' . $this->_Config['store']);
            return false;
        }

        $this->log_cache_error('Clean :: Autoclean started');

        $n = 0;

        while ($file = readdir($dh)) {
            $stat = stat($this->_Config['store']);
            if (($file != '.') && ($file != '..') && ($file != 'index.html')) {

                if (substr($file, 0, 6) != 'cache_' && $file != 'hooks.php' && $file != "." && $file != ".." && $file != "/" && strstr($file, '.') != TRUE && (time() - $stat['mtime']) > $this->_Config['auto_clean_life']) {

                    $files_all = opendir("./system/cache/" . $file);
                    while (false !== ($fileT = readdir($files_all))) {
                        $stat = stat($this->_Config['store']);
// echo $stat['mtime'];
                        if ($fileT != "." && $fileT != ".." && $fileT != "/" && (time() - @$stat['mtime']) > $this->_Config['auto_clean_life']) {
                            @unlink("./system/cache/" . $file . "/" . $fileT);
                            $n++;
                        }
                    }
                }

                if (strstr($file, '.') === TRUE && (time() - $stat['mtime']) > $this->_Config['auto_clean_life']) {
                    @unlink($file);
                    $n++;
                }
            }
        }

        $this->log_cache_error('Clean :: Autoclean done');

        return $n;
    }

    /**
     * Delete Cache Item
     *
     * @param string $key
     *
     * @return bool
     */
    public function delete($key, $group = FALSE) {
        $this->set_group($group);

        $file = $this->_Config['store'] . 'cache_' . $this->generatekey($key);

        $this->set_default_group();

        if (file_exists($file)) {
            return @unlink($file);
        } else {
            return false;
        }
    }

    /**
     * Delete group folder
     *
     * @param string $group
     * @access public
     */
    public function delete_group($group) {
        if ($group != '.' AND $group != '..' AND $group != 'templates_c') {
            $file = BASEPATH . 'cache/' . $group;
            $this->CI->load->helper('file');
            delete_files($file);
        }
    }

    /**
     * Delete Cached Function
     *
     * @return bool
     */
    public function delete_func($object, $func, $args = array()) {
        $file = $this->_Config['store'] . 'cache_' . $this->generatekey(get_class($object) . '::' . $func . '::' . serialize($args));
        $this->set_default_group();

        if (file_exists($file))
            return @unlink($file);
        else
            return false;
    }

    /**
     * Delete All Cache Items
     *
     * @return bool
     * @access public
     */
    public function delete_all() {
        $n = 0;

        $cache_store_dir = $this->_Config['store'] . "/";
        if (is_dir($cache_store_dir) and ($root_dir_handle = opendir($cache_store_dir))) {
            while (false !== ($file = readdir($root_dir_handle))) {

                if (substr($file, 0, 6) != 'cache_' && $file != 'hooks.php' && $file != "." && $file != ".." && $file != "/") {
                    $cache_sub_dir = $cache_store_dir . $file . "/";
                    if (is_dir($cache_sub_dir) and ($sub_dir_handle = opendir($cache_sub_dir))) {
                        while (FALSE !== ($fileT = readdir($sub_dir_handle))) {

                            if ($fileT != "." && $fileT != ".." && $fileT != "/") {

                                $n++;
                                @unlink($cache_sub_dir . $fileT);
                            }
                        }
                    }
                }
                if (substr($file, 0, 6) == 'cache_' || $file == 'hooks.php' || strstr($file, '.') === TRUE) {

                    $n++;
                    @unlink($cache_store_dir . $file);
                }
            }
        }

        $cache_sub_dir = $cache_store_dir . "templates_c/HTML/";
        if (is_dir($cache_sub_dir) and ($sub_dir_handle = opendir($cache_sub_dir))) {
            while (false !== ($fileT = readdir($sub_dir_handle))) {

                if ($fileT != "." && $fileT != ".." && $fileT != "/") {

                    @unlink($cache_sub_dir . $fileT);
                }
            }
        }


        $this->log_cache_error('All cache files deleted');

        return $n;
    }

    public function clearCacheFolder($folder = NULL) {

        if ($folder !== NULL) {
            if ($files_all = opendir("./system/cache/" . $folder . "/")) {
                while (false !== ($fileT = readdir($files_all))) {

                    if ($fileT != "." && $fileT != ".." && $fileT != "/" && substr($fileT, 0, 6) == 'cache_' || $fileT != 'hooks.php') {
                        @unlink("./system/cache/" . $folder . "/" . $fileT);
                    }
                }
            } else {
                log_message('error', 'Library cache, Function clearCacheFolder , opendir Patch:' . "./system/cache/" . $folder . "/" . ' RETURN FALSE');
                return false;
            }
        } else {
            log_message('error', 'Library cache, Function clearCacheFolder. Do not get the name of the directory to delete cache');
            return false;
        }
    }

    public function cache_file() {
        $n = 0;

        $cache_store_dir = $this->_Config['store'] . "/";
        if (is_dir($cache_store_dir) and ($root_dir_handle = opendir($cache_store_dir))) {
            while (false !== ($file = readdir($root_dir_handle))) {

                if (substr($file, 0, 6) != 'cache_' && $file != 'hooks.php' && $file != "." && $file != ".." && $file != "/") {
                    $cache_sub_dir = $cache_store_dir . $file . "/";
                    if (is_dir($cache_sub_dir) and ($sub_dir_handle = opendir($cache_sub_dir))) {
                        while (false !== ($fileT = readdir($sub_dir_handle))) {

                            if ($fileT != "." && $fileT != ".." && $fileT != "/" && strstr($fileT, '~') != TRUE) {
                                $n++;
                            }
                        }
                    }
                }
                if (substr($file, 0, 6) == 'cache_' || $file == 'hooks.php' && strstr($fileT, '~') != TRUE) {
                    $n++;
                }
            }
        }

        $this->log_cache_error('All cache files deleted');

        return $n;
    }

    public function generatekey($key) {
        return md5($key);
    }

    private function log_cache_error($msg) {
        $log_path = APPPATH . 'logs/';

        $filepath = $log_path . 'cache_log-' . date('Y-m-d') . EXT;
        $message = '';

        if (!file_exists($filepath)) {
            $message .= "<" . "?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?" . ">\n\n";
        }

        if (!$fp = @fopen($filepath, FOPEN_WRITE_CREATE)) {
            return FALSE;
        }

        $message .= date('Y-m-d H:i:s') . ' --> ' . $msg . "\n";

        flock($fp, LOCK_EX);
        fwrite($fp, $message);
        flock($fp, LOCK_UN);
        fclose($fp);

        @chmod($filepath, FILE_WRITE_MODE);
    }

}

/* End of cache.php */

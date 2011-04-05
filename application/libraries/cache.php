<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 * Cache Class
 */

class Cache
{
    public $CI;
    public $get = 0;
    public $set = 0;

	//Cache config
    // TODO: Rewrite auto_clean to fetch date from DB
    public $_Config = array('store'        => 'cache',
                         'auto_clean'      => 500, //Random number to run _Clean();
                         'auto_clean_life' => 3600,
                         'auto_clean_all'  => TRUE,
                         'ttl'             => 3600); //one hour

    public function __construct()
    {
        $this->CI =& get_instance();

        if ($this->CI->config->item('cache_path') != '')
        {
            $this->_Config['store'] = $this->CI->config->item('cache_path');
        }
        else
        {
            $this->_Config['store'] = BASEPATH.'cache/';
        }

        // Is cache folder wratible?
        if (!is_writable($this->_Config['store']))
        {
            $this->log_cache_error('Constructor :: Store '.$this->_Config['store'].' is not writable');
        }

        // autoclean if random is 1
        if (($this->_Config['auto_clean'] !== false) && (rand(1, $this->_Config['auto_clean']) === 1))
        {
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
    public function fetch($key, $group = FALSE)
    {
    	$this->set_group($group);

	    if (($ret = $this->_fetch($key)) === false)
        {
           return false;
        }
        else
        {
           return $ret;
        }
     }

    private function _fetch($key)
    {
        $file  = $this->_Config['store'].'cache_'.$this->generatekey($key);
    	$this->set_default_group();

        if (!file_exists($file))
            return FALSE;

        if (!($fp = fopen($file, 'r')))
        {
            $this->log_cache_error('Fetch :: Error Opening File '.$file);
            return FALSE;
        }

        // Only reading
        flock($fp, LOCK_SH);

        // Cache data
        $data = unserialize(file_get_contents($file));
        fclose($fp);

        // if cache not expried return cache file
        if (time() < $data['expire'])
        {
            $this->get++;
            return $data['cache'];
        }else{
                return FALSE;
        }
    }


	/**
	 * Fetch cached function
	 */
	public function fetch_func($object,$func,$args = array())
	{

	    $file = $this->_Config['store'].'cache_'.$this->generatekey(get_class($object).'::'.$func.'::'.serialize($args));
	    $this->set_default_group();

	    if (!file_exists($file))
		return false;

	    if (!($fp = fopen($file, 'r')))
	    {
		$this->log_cache_error('Fetch :: Error Opening File '.$file);
		return false;
	    }

	    flock($fp, LOCK_SH);

	    $data = unserialize(file_get_contents($file));
	    fclose($fp);

	    if (time() < $data['expire'])
	    {
            $this->get++;
            return $data['cache'];
	    }else{
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
    public function store($key, $data, $ttl = false, $group = false)
    {
        if (!$ttl)
            $ttl = $this->_Config['ttl'];

	    $this->set_group($group);

        $file  = $this->_Config['store'].'cache_'.$this->generatekey($key);
        $data  = serialize(array('expire' => ($ttl + time()), 'cache' => $data));

        if (!($fp = fopen($file, 'a+')))
            $this->log_cache_error('Store :: Error Opening file '.$file);

        flock($fp, LOCK_EX);
        fseek($fp, 0);
        ftruncate($fp, 0);   // Clear file

        if (fwrite($fp, $data) === false)
            $this->log_cache_error('Store :: Error writing to file '.$file);

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
    public function set_group($group)
    {

	if($group == FALSE)
	{
	    $this->_Config['store'] = BASEPATH.'cache/';
	    return;
	}

	if( ! is_dir( $this->_Config['store'].$group))
	{
	    mkdir($this->_Config['store'].$group);
	    @chmod($this->_Config['store'].$group, 0777);
	}

	$this->_Config['store'] .= $group.'/';
    }

    public function set_default_group()
    {
	    $this->_Config['store'] = BASEPATH.'cache/';
    }

    /**
     * Cache Function
     *
     * @return mixed
     * @access public
     */
    function call($func = array(), $args = array(),$ttl = false)
    {
    	if ($ttl == false)
	    $ttl = $this->_Config['ttl'];

	    $arguments = func_get_args();

	    //class_name::function
	    $key = get_class($arguments[0][0]).'::'.$arguments[0][1].'::'.serialize($args);

        if (($cache = $this->fetch($key)) !== false)
        {
	    	$this->set_default_group();
		    return $cache;
    	}else{

            $target = array_shift($arguments);
            $result = call_user_func_array($target, $args);

	        $this->set_default_group();

            if (!$this->store($key, $result, false))  return false;

	    return $result;
	    }
    }

    public function Clean()
    {
    	if (!($dh = opendir($this->_Config['store'])))
        {
            $this->log_cache_error('Clean :: Error Opening Store '.$this->_Config['store']);
            return false;
        }

         $this->log_cache_error('Clean :: Autoclean started');

	    $n = 0;

        while ($file = readdir($dh))
        {
            if (($file != '.') && ($file != '..') && ($file != 'index.html') && is_file($cache_file = $this->_Config['store'].$file))
            {
                if (($this->_Config['auto_clean_all'] == TRUE) || (substr($file, 0, 8) == 'cache_'))
                {
                    if ((time() - @filemtime($cache_file)) > $this->_Config['auto_clean_life'])
                    { 
                        @unlink($cache_file); $n++; 
                    }
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
    public function delete($key,$group = FALSE)
    {
        $this->set_group($group);

        $file = $this->_Config['store'].'cache_'.$this->generatekey($key);

        $this->set_default_group();

        if (file_exists($file))
        {
            return @unlink($file);
        }else{
            return false;
        }
    }

    /**
     * Delete group folder
     *
     * @param string $group
     * @access public
     */
    public function delete_group($group)
    {
        if ($group != '.' AND $group != '..' AND $group != 'templates_c')
        {
            $file = BASEPATH.'cache/'.$group;
            $this->CI->load->helper('file');
            delete_files($file); 
        }
    }

    /**
     * Delete Cached Function
     *
     * @return bool
     */
    public function delete_func($object,$func,$args = array())
    {
        $file =  $this->_Config['store'].'cache_'.$this->generatekey(get_class($object).'::'.$func.'::'.serialize($args));
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
    public function delete_all()
    {
        if (!($dh = opendir($this->_Config['store'])))
        {
            $this->log_cache_error('Delete All :: Error Opening Store '.$this->_Config['store']);
            return false;
        }

    	$n = 0;

        // Remove any expired cache items
        while ($file = readdir($dh))
        {
            if (($file != '.') && ($file != '..') && ($file != 'index.html') && is_file($cache_file = $this->_Config['store'].$file))
            {
                if (substr($file, 0, 6) == 'cache_' OR ($file == 'hooks.php'))
                {
                    @unlink($cache_file);
		            $n++;
		        }
	    }

	    if(is_dir($this->_Config['store'].$file) AND $file != 'templates_c')
	        {
    		    $this->delete_group($file);
	        }
        }

    	$this->log_cache_error('All cache files deleted');

        return $n;
    }


    public function generatekey($key)
    {
        return md5($key);
    }

    private function log_cache_error($msg)
    {
	    $log_path = APPPATH.'logs/';

	    $filepath = $log_path.'cache_log-'.date('Y-m-d').EXT;
	    $message  = '';

	    if ( ! file_exists($filepath))
	    {
		    $message .= "<"."?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?".">\n\n";
	    }

	    if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
	    {
		    return FALSE;
	    }

	    $message .= date('Y-m-d H:i:s'). ' --> '.$msg."\n";

	    flock($fp, LOCK_EX);
	    fwrite($fp, $message);
	    flock($fp, LOCK_UN);
	    fclose($fp);

	    @chmod($filepath, FILE_WRITE_MODE);
    }
}

/* End of cache.php */

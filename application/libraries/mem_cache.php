<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Image CMS
 * Memcache Class
 *
 */
class Mem_cache extends Memcache
{
    public $CI;
    public $get = 0;
    public $set = 0;
    public $key_prefix = '';

	//Cache config
    public $_Config = array(
        'store' => 'cache',
        'ttl'   => 3600);

    public function __construct()
    {
        $this->CI =& get_instance();
    	$this->connect('localhost', 11211) or die ("Could not connect to memcache server.");
        $this->key_prefix = base_url();
    }

    /**
     * Fetch Cache
     *
     * @param string $key
     *
     * @return mixed
     */
    public function fetch($key, $group = FALSE)
    {
		if (($ret = $this->_fetch($key)) === false)
	    {
	        return false;
        }else{
           return $ret;
        }
     }

    public function _fetch($key)
    {
        $key = $this->generatekey($key);

        $this->get++;

        return $this->get($key);
    }

    /**
     * Fetch cached function
     */
    public function fetch_func($object, $func, $args = array())
    {
        $key = $this->generatekey(get_class($object).'::'.$func.'::'.serialize($args));

        $this->get++;

	    return $this->get($key);
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
        {
            $ttl = $this->_Config['ttl'];
        }

        $this->set($this->generatekey($key), $data, FALSE, $ttl);

    	$this->set++;
        return TRUE;
    }

    /**
     * Cache Function
     *
     * @return mixed
     * @access public
     */
    public function call($func = array(), $args = array(),$ttl = FALSE)
    {
	    if ($ttl === FALSE)
    	    $ttl = $this->_Config['ttl'];

		    $arguments = func_get_args();

		    //class_name::metohd
		    $key = get_class($arguments[0][0]).'::'.$arguments[0][1].'::'.serialize($args);

		    if (($cache = $this->fetch($key)) !== false)
		    {
		        return $cache;
            }
            else
            {
		        $target = array_shift($arguments);
		        $result = call_user_func_array($target, $args);

		        if (!$this->store($key, $result, false))  return FALSE;

		    return $result;
	    }
    }

    /**
     * Clean all cache objects
     *
     * @return void
     */
    public function Clean()
    {
    	$this->flush();
    }

    /**
     * Clean all cache objects
     *
     * @return void
     */
    public function delete_group()
    {
	    $this->flush();
    }

    /**
     * Delete Cache Item
     *
     * @param string $key - cache item key
     *
     * @return bool
     */
    public function delete($key)
    {
    	$this->delete($this->generatekey($key));
    }

    /**
     * Delete Cached Function
     *
     * @return bool
     */
    public function delete_func($object, $func, $args = array())
    {
	    $file = $this->generatekey(get_class($object).'::'.$func.'::'.serialize($args));
	    $this->delete($file);
    }

    /**
     * Delete All Cache Items
     *
     * @return bool
     * @access public
     */
    public function delete_all()
    {
        $this->flush();
    }

    /**
     * Generate key
     *
     * @param  $key
     * @return string */
    public function generatekey($key)
    {
        return md5($this->key_prefix.$key);
    }
}

/* End of cache.php */

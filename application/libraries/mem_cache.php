<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Image CMS
 * Memcache Class
 *
 */
class Mem_cache extends Memcache
{
    public $CI;
    private $get = 0;
    private $set = 0;

	//Cache config
    public $_Config = array(
        'store' => 'cache',
        'ttl'   => 3600);

    function Mem_cache()
    {
        $this->CI =& get_instance();
    	$this->connect('localhost', 11211) or die ("Could not connect to memcache.");
     }

    /**
     * Fetch Cache
     *
     * @param string $key
     *
     * @return mixed
     */
    function fetch($key, $group = FALSE)
    {
		if (($ret = $this->_fetch($key)) === false)
			{
			   return false;
			}else{
			   return $ret;
			}
     }

    function _fetch($key)
    {
        $key = $this->generatekey($key);

        $this->get++;

        return $this->get($key);
    }


    /**
     * Fetch cached function
     */
    function fetch_func($object, $func, $args = array())
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
    function store($key, $data, $ttl = false, $group = false)
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
    function call($func = array(), $args = array(),$ttl = FALSE)
    {
	    if ($ttl == FALSE)
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

    function Clean()
    {
    	$this->flush();
    }

    function delete_group()
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
    function delete($key)
    {
    	$this->delete($this->generatekey($key));
    }

    /**
     * Delete Cached Function
     *
     * @return bool
     */
    function delete_func($object, $func, $args = array())
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
    function delete_all()
    {
        $this->flush();
    }



    function generatekey($key)
    {
        return md5($key);
    }
}

/* End of cache.php */

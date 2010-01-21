<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Config extends CI_Config {

    private $GET_params_arr = array();

    public function MY_URI()
    {
        parent::CI_Config();
    }

	/**
	 * Site URL
	 *
	 * @access	public
	 * @param	string	the URI string
	 * @return	string
	 */
	function site_url($uri = '')
	{
		if (is_array($uri))
		{
			$uri = implode('/', $uri);
		}

		if ($uri == '')
		{
			return $this->slash_item('base_url').$this->item('index_page');
		}
		else
		{
			$suffix = ($this->item('url_suffix') == FALSE) ? '' : $this->item('url_suffix');

            $segs = explode('/', $uri);

            // Diable url_suffix for admin panel
            if ($segs[0] == 'admin')
            {
                $suffix = '';
            }

			return $this->slash_item('base_url').$this->slash_item('index_page').preg_replace("|^/*(.+?)/*$|", "\\1", $uri).$suffix;
		}
	}

}

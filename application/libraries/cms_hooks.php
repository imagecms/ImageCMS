<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_hooks {

    private $hooks_file = NULL;

    public function __construct()
    {
        $ci =& get_instance();

        if (!$ci->config->item('is_installed') && !function_exists('get_hook'))
        {
            function get_hook() 
            { 
                return FALSE; 
            }

            return FALSE;
        }

        $this->hooks_file = BASEPATH.'cache/hooks'.EXT;

        if (!file_exists($this->hooks_file) OR $ci->config->item('rebuild_hooks_tree') === TRUE)
        {
            $this->build_hooks();
        } 

        if (file_exists($this->hooks_file))
        {
            include($this->hooks_file);
        }
        else
        {
            show_error('Ошибка загрузки файла хуков.');
        }
    }

    public function build_hooks()
    {
        $ci =& get_instance();

        $ci->load->library('lib_xml');

        $xml = '<?xml version="1.0" encoding="UTF-8"?><hooks>';

        // Get all installed modules
        $ci->db->select('name');
        $modules = $ci->db->get('components')->result_array();

        $modules[]['name'] = 'core';

        // Search for hooks.xml in all installed modules
        foreach($modules as $m)
        {
            $xml_file = APPPATH.'modules/'.$m['name'].'/hooks.xml';
            
            if (file_exists($xml_file))
            {
                $xml .= file_get_contents($xml_file);
            }
        }

        $xml .= "\n</hooks>";

        $parser = xml_parser_create();
    	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 0);
    	xml_parse_into_struct($parser, $xml, $vals);
	    xml_parser_free($parser);

        $tmp = array();

        foreach($vals as $k => $v)
        {
            if (isset($v['type']) && isset($v['value']) && isset($v['attributes']) )
            {
                $hookId =  trim($v['attributes']['id']);
                
                if (empty($tmp[$hookId]))
                {
                    $tmp[$hookId] = '';
                }

                $hookValue = trim($v['value']);
                if ($v['type'] === 'complete' && !empty($hookValue) && !empty($hookId))
                {
                    $tmp[$hookId] .= $hookValue;
                }
            }
        }


        $this->create_hooks_file($tmp);
    }

    private function create_hooks_file($hooks_arr = array())
    {
        $ci =& get_instance();
        $ci->load->helper('file');

        $tmp = '';

        if (count($hooks_arr) > 0)
        {
            foreach($hooks_arr as $k => $v)
            {
                $tmp = $tmp . '\''.$k.'\''.' => \''.str_replace("'", "\'",$v).'\','."\n";
            }
        }
        
        $tmp = str_replace("\\\'", "\'", $tmp); 

        $template = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_hook(\$hook_id)
{
\$cms_hooks = array (
    ".$tmp."
);

    if (isset(\$cms_hooks[\$hook_id]))
    {
        return \$cms_hooks[\$hook_id];
    }
    else
    {
       return FALSE;
    }
}

";
        write_file($this->hooks_file, $template);
    }
}

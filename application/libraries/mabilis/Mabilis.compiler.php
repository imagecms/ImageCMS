<?php

/***************************************************
 * Image CMS Template Engine (Mabilis TPL)
 *
 * Simple template engine for Image CMS based on regular expressions search and replace. 
 *
 * author: dev@imagecms.net
 * version: 1.3 Beta PHP5
 *
 ***************************************************/

class Mabilis_Compiler extends Mabilis {

    public $config = NULL;

    // Array with functions that are in ./functions/ folder
    // Each of this function will be renamed as tpl_$func
    private $func_prefix = 'func_';
    private $func_array = array('counter', 'truncate');

    // Constructor
    function __construct(&$config_obj)
    {
        $this->config =& $config_obj;
    }

    /**
     * Compile template file to php code
     *
     * @access public
     * @param string template filename
     */ 
    public function compile($file)
    {
        // Read template data
        $tpl_data = $this->read_tpl_file($file);

        if ($tpl_data === FALSE)
        {
            $this->error('File ' . $file . ' not found;' );
            return FALSE;
        }else{

            $curFilePath = dirname(realpath($file));

            $include_functions = array();

            // Replace all {$variable} as echo $variable 
            //$tpl_data = preg_replace('/({\s*)\s*(\$\w*?)\s*(\s*\})/', '$1 echo $2;$3', $tpl_data);
            $tpl_data = preg_replace('/\{(\$\w*?)\}/', '{ echo $1; }', $tpl_data);

            // For arrays like $arr['1']['2']
            $tpl_data = preg_replace('/\{(\$.*?\[.*?\])\}/', '{ echo $1; }', $tpl_data);

            // Replace $arr.key to $arr['key']
            $tpl_data = preg_replace('/\{(\$\w*)?\.(\w*)?\.(\w*)\}/', '{ echo $1[\'$2\'][\'$3\']; }', $tpl_data);
            $tpl_data = preg_replace('/\{(\$\w*)?\.(\w*)\}/', '{ echo $1[\'$2\']; }', $tpl_data);

            $tpl_data = preg_replace('/\{(.*?)(\$\w*)\.(\w*)\.(\w*)(.*?)\s*\}/', '{ $1 $2[\'$3\'][\'$4\'] $5 }', $tpl_data);

            for ($i=0;$i<15;$i++)
            {
                $tpl_data = preg_replace('/\{(.*?)(\$\w*)\.(\w*)(.*?)\}/', '{ $1 $2[\'$3\'] $4 }', $tpl_data);
            }

            // Find end replace template functions
            foreach($this->func_array as $func)
            {
                // Replace { function(params) } as { echo functon(params); }
                if ( preg_match_all('/\{\s*('.$func.')\s*(\(.*?\))\s*\}/', $tpl_data, $_match) > 0)
                {
                    // Function found
                    $tpl_data = preg_replace('/\{\s*('.$func.')\s*(\(.*?\))\s*\}/', '{ echo '.$this->func_prefix.'$1 $2; }', $tpl_data);

                    // Include function
                    $include_functions[$func] = TRUE;
                }

                // If we want to assign function result to variable
                // tpl code { $var = function(params) }
                if ( preg_match_all('/\{\s*\$.*?\=\s*('.$func.')\s*(\(.*?\))\s*\}/', $tpl_data, $_match) > 0)
                {
                    // Function found
                    $tpl_data = preg_replace('/\{\s*(\$.*?)\=\s*('.$func.')\s*(\(.*?\))\s*\}/', '{ $1 = '.$this->func_prefix.'$2 $3; }', $tpl_data);

                    // Include function
                    $include_functions[$func] = TRUE;
                }

            }

            // PHP functions
            $tpl_data = preg_replace('/\{\s*(\w*)\s*(\(.*?\))\s*\}/', '{ echo $1 $2; }', $tpl_data);

            // Replace PHP tags
            $tpl_data = preg_replace("/<\?php(.*?)\?>/si", '<!user_php $1 user_php!>',$tpl_data);

            // Replace literal tags
            $tpl_data = preg_replace("/\{\s*literal\s*\}(.*?)\{\s*\/literal\}/si", '<!user_literal$1user_literal!>',$tpl_data);

            // Replace delimiters to php tags
            $tpl_data = preg_replace('/(\s*)\{(\s*)/', '$1<?php $2', $tpl_data);
            $tpl_data = preg_replace('/(\s*)\}(\s*)/', '$1 ?>$2', $tpl_data);


            /******************************************
             * Functions
             * Replace all between php tags to php code
             ******************************************/

            // If
            $tpl_data = preg_replace('/<\?php\s*\/if\s*\?>/', '<?php endif; ?>', $tpl_data);
            $tpl_data = preg_replace('/<\?php.*elseif (.*).*\?>/', '<?php elseif ($1): ?>', $tpl_data);
            $tpl_data = preg_replace('/<\?php\s*?(if)\s*(.*?)\s*(\?>)/', '<?php $1($2): ?>', $tpl_data);

            // Foreach
            $tpl_data = preg_replace('/<\?php\s*\/foreach\s*\?>/', '<?php }} ?>', $tpl_data);
            $tpl_data = preg_replace('/<\?php\s*(foreach)\s*(\$.*?)\s*as\s*(\$.*?)\s*\?>/', "<?php if(is_true_array($2)){ $1 ($2 as $3){ ?>", $tpl_data);
            $tpl_data = preg_replace('/<\?php\s*(foreach)\s*(.*?)\s*as\s*(\$.*?)\s*\?>/', "<?php  \$result = $2; \n if(is_true_array(\$result)){ $1 (\$result as $3){ ?>", $tpl_data);

            // For
            $tpl_data = preg_replace('/<\?php\s*\/for\s*\?>/', '<?php } ?>', $tpl_data);
            $tpl_data = preg_replace('/<\?php\s*(for) (.*?)\s*\?>/', '<?php $1($2){?>', $tpl_data);

            // Switch
            $tpl_data = preg_replace('/<\?php\s*\/switch\s*\?>/', '<?php } ?>', $tpl_data);
            $tpl_data = preg_replace('/<\?php\s*(switch)(.*)\?>/', '<?php $1($2){ default: break; ?>', $tpl_data);

            // While
            $tpl_data = preg_replace('/<\?php.*\/while\s*?>/', '<?php } ?>', $tpl_data);
            $tpl_data = preg_replace('/<\?php.*while(.*).*\?>/', '<?php while ($1){ ?>', $tpl_data);

            // Include_tpl
            $tpl_data = preg_replace('/<\?php.*include\_tpl.*\((.*)\).*\?>/', '<?php $this->include_tpl($1, \''.$curFilePath.'\'); ?>', $tpl_data);

            preg_match_all("/<\!user_php(.*)\s*user_php\!>/", $tpl_data, $_match);

            $php_patterns = array('/<\?php/','/\?>/');

            foreach($_match[0] as $k => $v)
            {
                $text = preg_replace($php_patterns, $this->config->delimiters, $v);
                $tpl_data = str_replace($v, $text, $tpl_data);
            }

            $tpl_data = preg_replace('/\s*<\!user_php/','<?php',$tpl_data);
            $tpl_data = preg_replace('/user_php!>/','?>',$tpl_data);

            // Replace php tags to { } between literal tags
            preg_match_all("/<\!user_literal(.*?)user_literal\!>/si", $tpl_data, $_match);

            $php_patterns = array('/<\?php/','/\?>/');

            foreach($_match[0] as $k => $v)
            {
                $text = preg_replace($php_patterns, $this->config->delimiters, $v);
                $tpl_data = str_replace($v, $text, $tpl_data);
            }

            $tpl_data = preg_replace('/\s*<\!user_literal/','',$tpl_data);
            $tpl_data = preg_replace('/user_literal!>/','',$tpl_data);

            // Replace all 'echo $var' to if(isset($var)) { echo $var }
            $tpl_data = preg_replace('/(<\?php)\s*(echo)\s*(\$\w*?);\s*(\?>)/', '$1 if(isset($3)){ $2 $3; } $4', $tpl_data);

            $add_data = '';

            if (count($include_functions) > 0)
            {
                foreach($include_functions as $k => $v)
                {
                    $add_data .= 'include (\''.$this->config->function_path.'func.'.$k.$this->config->function_ext.'\'); ';
                }

                $add_data = '<?php '.$add_data.' ?>';
            }

            $del_time = time() + $this->config->compiled_ttl;
            $modifi_time = '';

            if ($this->config->use_filemtime == TRUE)
            {
                $modifi_time = '$mabilis_last_modified='.filemtime($file).';';
            }

            $ttl_string = '<?php $mabilis_ttl='.$del_time.'; '.$modifi_time.' //'.$file.' ?>';

            $this->write_compiled_file($file, $add_data.$tpl_data.$ttl_string);

            return TRUE;
        }
    }

    // Read template file
    public function read_tpl_file($file)
    {
        if (file_exists($file))
        {
            return file_get_contents($file);
        }else{
            // File no found
            return FALSE;
        }
    }

    // Write compiled template file
    private function write_compiled_file($file, $data)
    {
		if ( ! $fp = fopen($this->config->compile_path . md5($file) . $this->config->compiled_ext, 'w'))
		{
			return FALSE;
		}
		
		flock($fp, LOCK_EX);
		fwrite($fp, $data);
		flock($fp, LOCK_UN);
		fclose($fp);	

        @chmod ($this->config->compile_path . md5($file) . $this->config->compiled_ext, 0777);

		return TRUE;
    }

    private function error($text)
    {
        echo '<p>Error: ' . $text.'</p>';
    }
}
/* End of Mabilis.compiler.php */
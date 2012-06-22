<?php

    /**
     * Truncate function
     */ 
    if (! function_exists('func_truncate'))
    {       
        function func_truncate($var, $chars = 0, $end = '...')
        {
            if ($chars > 0 AND mb_strlen($var, 'utf-8') >= $chars  )
            {
                return mb_substr($var, 0, $chars,'utf-8').$end;
            }else{
                return $var;
            }
        }
    }

/* End of file */

<?php

    /**
     * Counter function
     */ 
    if (! function_exists('func_counter'))
    {       
        function func_counter()
        {
            static $count = array();
            static $n;    

            $params = func_get_args();
            $count  = func_num_args();

            $n = $n + 1;

            if ($n > $count)
            {
                $n = 1;
            }

            return $params[$n - 1];
        }
    }
/* End of file */

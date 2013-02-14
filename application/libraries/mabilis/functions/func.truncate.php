<?php

/**
 * Truncate function
 */
if (!function_exists('func_truncate')) {

    function func_truncate($var, $chars = 0, $end = '...') {

        if ($chars > 0 AND mb_strlen($var, 'utf-8') >= $chars) {
            $att = mb_substr($var, 0, $chars, 'utf-8') . $end;

            return extension_loaded('tidy') ?
                    call_user_func(function () use ($att) {
                                $tidy = new tidy();
                                $tidy->parseString($att, array('show-body-only' => TRUE, 'indent' => TRUE, 'output-xhtml' => TRUE, 'wrap' => 200), 'utf8');
                                return $tidy->value . $end;
                            }) : strip_tags($att);
        } else 
            return extension_loaded('tidy') ?
                    call_user_func(function () use ($var) {
                                $tidy = new tidy();
                                $tidy->parseString($var, array('show-body-only' => TRUE, 'indent' => TRUE, 'output-xhtml' => TRUE, 'wrap' => 200), 'utf8');
                                return $tidy->value . $end;
                            }) : strip_tags($var);
    }
}

/* End of file */

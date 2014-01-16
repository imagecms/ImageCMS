<?php

/**
 * Truncate function
 */
if (!function_exists('func_truncate')) {

    /**
     * 
     * @param string $var
     * @param int $chars
     * @param string $end
     * @param bool $strip_tags
     * @return string
     */
    function func_truncate($var, $chars = 0, $end = '...', $strip_tags = FALSE) {

        if ($strip_tags) {
            $var = strip_tags($var);
        }

        if ($chars > 0 AND mb_strlen($var, 'utf-8') >= $chars) {
            $att = mb_substr($var, 0, $chars, 'utf-8') . $end;

            return extension_loaded('tidy') ?
                    call_user_func(function () use ($att) {
                        $tidy = new tidy();
                        $tidy->parseString($att, array('show-body-only' => TRUE, 'indent' => TRUE, 'output-xhtml' => TRUE, 'wrap' => 200), 'utf8');
                        return $tidy->value . $end;
                    }) : $att;
        } else {
            return extension_loaded('tidy') ?
                    call_user_func(function () use ($var) {
                        $tidy = new tidy();
                        $tidy->parseString($var, array('show-body-only' => TRUE, 'indent' => TRUE, 'output-xhtml' => TRUE, 'wrap' => 200), 'utf8');
                        return $tidy->value . $end;
                    }) : $var;
        }
    }

}

/* End of file */

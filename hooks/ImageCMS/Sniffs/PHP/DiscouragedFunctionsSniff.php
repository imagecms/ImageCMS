<?php

if (class_exists('Generic_Sniffs_PHP_ForbiddenFunctionsSniff', true) === false) {
    throw new PHP_CodeSniffer_Exception('Class Generic_Sniffs_PHP_ForbiddenFunctionsSniff not found');
}

class ImageCMS_Sniffs_PHP_DiscouragedFunctionsSniff extends Generic_Sniffs_PHP_ForbiddenFunctionsSniff {

    /**
     * A list of forbidden functions with their alternatives.
     *
     * The value is NULL if no alternative exists. IE, the
     * function should just not be used.
     *
     * @var array(string => string|null)
     */
    public $forbiddenFunctions = array(
        'print_r' => null,
        'my_print_r' => null,
        'var_dump' => null,
        'var_dumps' => null,
        'var_dumps_exit' => null,
        'dump' => null,
        'dd' => null,
        'ajax_var_dumps' => null,
        'ajax_dd' => null,
        'ajax_var_dumps_exit' => null,
    );

    /**
     * If true, an error will be thrown; otherwise a warning.
     *
     * @var bool
     */
    public $error = false;

}

//end class
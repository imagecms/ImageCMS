<?php

if (!function_exists('isSaas')) {

    function is_saas() {
        return is_dir(realpath('./application/modules/saas'));
    }

}

<?php

use CMSFactory\DummyModule;
use Currency\Currency;
use shop\classes\Money\EmmetMoneyFormatter;

if (!function_exists('module')) {

    /**
     * Module loader
     *
     * @param string $moduleName
     * @return DummyModule
     */
    function module($moduleName) {

        $module = CI::$APP->load->module($moduleName);
        return $module ?: new DummyModule($moduleName);
    }

}

if (!function_exists('view')) {

    /**
     * Returns or show template with only local variables visibility
     *  Add new vars but not replace origin template data
     *
     * @param string $fileName
     * @param array $data
     * @return mixed
     */
    function view($fileName, array $data = []) {

        $definedVars = CI::$APP->template->get_vars();
        return CI::$APP->template->view($fileName, array_replace($definedVars, $data));
    }

}

if (!function_exists('get_value')) {

    /**
     * Returns old field value from session flash data
     * @param $fieldName
     * @param string $default
     * @return string
     */
    function get_value($fieldName, $default = '') {

        if (set_value($fieldName)) {
            return set_value($fieldName);
        }
        $values = CI::$APP->session->flashdata('_field_data');
        $value = $default;
        if (isset($values[$fieldName]) && isset($values[$fieldName]['postdata'])) {
            $value = is_array($values[$fieldName]['postdata']) ? array_shift($values[$fieldName]['postdata']) : $values[$fieldName]['postdata'];
        }

        return $value;
    }

}

if (!function_exists('get_error')) {

    /**
     * Returns field error from session flash data
     * @param $fieldName
     * @return mixed
     */
    function get_error($fieldName) {

        if (form_error($fieldName)) {
            return form_error($fieldName);
        }
        $error = false;
        $errors = CI::$APP->session->flashdata('_error_array');
        if (isset($errors[$fieldName]) && $errors[$fieldName]) {
            $error = $errors[$fieldName];
        }
        return $error;
    }

}

if (!function_exists('get_errors')) {

    /**
     * Return form errors as string
     *
     * @param string $prefix
     * @param string $suffix
     * @return string
     */
    function get_errors($prefix = '', $suffix = '') {

        if (validation_errors()) {
            return validation_errors($prefix = '', $suffix = '');
        }
        $errors = CI::$APP->session->flashdata('_error_array');
        $str = '';
        foreach ($errors as $val) {
            if ($val != '') {
                $str .= $prefix . $val . $suffix . "\n";
            }
        }
        return $str;
    }

}

/**
 * Template Formatters
 * All formatters use Emmet format to render price
 *
 */

if (!function_exists('emmet_money')) {

    /**
     * Format money wrapped by rendered tags from emmet string
     * and formatted according to currency format
     *
     * @param $price
     * @param string|null $priceWrapper
     * @param string|null $coinsWrapper
     * @param string|null $symbolWrapper
     * @param null|SCurrencies $currency
     * @return EmmetMoneyFormatter
     */
    function emmet_money($price, $priceWrapper = null, $coinsWrapper = null, $symbolWrapper = null, $currency = null) {

        $currency = $currency ?: Currency::create()->getMainCurrency();
        $formatter = new EmmetMoneyFormatter($price, $currency);
        $formatter->setWrappers($priceWrapper, $coinsWrapper, $symbolWrapper);
        return $formatter;
    }

}

if (!function_exists('emmet_money_additional')) {

    /**
     *
     * Array of prices converted to all currencies available on site(with column showOnSite == 1)
     * formatted according to each currency format
     *
     * @param $price
     * @param integer|float $priceWrapper
     * @param string|null $coinsWrapper
     * @param string|null $symbolWrapper
     * @return array
     * @internal param $moduleName
     */
    function emmet_money_additional($price, $priceWrapper = null, $coinsWrapper = null, $symbolWrapper = null) {

        $formatters = [];
        foreach (Currency::create()->getOnSiteCurrencies() as $currency) {
            $convertedPrice = $price * $currency->getRate();
            array_push($formatters, emmet_money($convertedPrice, $priceWrapper, $coinsWrapper, $symbolWrapper, $currency));
        }
        return $formatters;
    }

}


if (!function_exists('flashdata')) {

    /**
     * Session flashdata
     *
     * @param string $key
     * @return string
     */
    function flashdata($key) {

        return CI::$APP->session->flashdata($key);
    }

}

if (!function_exists('tpl_register_asset')) {

    /**
     * @param string|array $path
     * @param string $position
     */
    function tpl_register_asset($path, $position = 'before') {

        if (is_array($path)) {

            foreach ($path as $value) {

                tpl_register_asset($value, $position);
            }
        } else {
            \CMSFactory\assetManager::create()
                ->assetTemplateFiles($path, $position);
        }

    }
}
<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Form_validation extends CI_Form_validation
{

    public function __construct() {

        parent::__construct();
        $this->set_message('valid_date', lang('Поле %s должно содержать правильную дату.'));
        $this->set_message('valid_time', lang('Поле %s должно содержать правильное время.'));
        $this->set_message('phone', lang('Поле %s должно содержать корректный номер.'));
        $this->set_message('least_one_symbol', lang('Поле %s должно содержать как минимум один символ.'));
        $this->set_message('alpha_dash_slash', lang('alpha_dash'));
    }

    public function getErrorsArray() {

        return $this->_error_array;
    }

    // --------------------------------------------------------------------

    public function run($module = '', $group = '') {

        (is_object($module)) AND $this->CI = &$module;
        $result = parent::run($group);
        if (!CI::$APP->input->is_ajax_request()) {
            CI::$APP->session->set_flashdata(
                [
                 '_error_array' => $this->_error_array,
                 '_field_data'  => $this->_field_data,
                ]
            );
        }
        return $result;
    }

    public function alpha_dash_slash($str) {
        return ( ! preg_match('/^([-a-z\/0-9_-])+$/i', $str)) ? FALSE : TRUE;

    }

    public function least_one_symbol($str) {

        return preg_match('/[a-zA-Z]/', $str) ? true : false;
    }

    /**
     * Valid Date (ISO format)
     *
     * @access    public
     * @param    string
     * @return    bool
     */
    public function valid_date($str) {

        if (preg_match('/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2})/', $str)) {
            $arr = explode('-', $str);
            $yyyy = $arr[0];
            $mm = $arr[1];
            $dd = $arr[2];
            return (checkdate($mm, $dd, $yyyy));
        } else {
            return FALSE;
        }
    }

    /**
     * Validate time string
     *
     * @param mixed $str time str.
     * @access public
     * @return boolean
     */
    public function valid_time($str) {

        if (preg_match('/([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/', $str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * VAlidete phone number symbols
     * +-)([0-9]
     * @param string $number
     * @return boolean
     */
    public function phone($number) {

        return (bool) !preg_match('/[^\d\-\+\s\)\(]/', $number);
    }

}
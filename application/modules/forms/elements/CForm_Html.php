<?php

class CForm_Html {

    public $ci = NULL;
    public $name = '';
    public $field = NULL;

    public function __construct($name, $field = array())
    {
        $this->form =& get_instance();
        $this->form = $this->form->load->module('forms');

        $this->name = $name;
        $this->field = (object) $field;

        return $this;
    }

    public function render()
    {
        return $this->field->initial;
    }

    public function setInitial($data)
    {
        return;
    }

    public function setAttributes($data)
    {
        return;
    }

    public function getData()
    {
        return FALSE;
    }

    public function runValidation()
    {
        return FALSE;
    }

    public function renderHtml()
    {
        return $this->field->initial;
    }

}

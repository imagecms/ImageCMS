<?php

class CForm_Radiogroup {

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
        $this->field->html = $this->renderHtml();
        $result = $this->form->standartRender($this->name, $this->field);
        return $result;
    }

    public function setInitial($data)
    {
        $this->field->initial = $data;  
    }

    public function setAttributes($data)
    {
        $this->field->selected = $data;
    }

    public function getData()
    {
        if (isset($_POST[$this->name]))
            return $_POST[$this->name];
    }

    public function runValidation()
    {
        if ($this->field->validation)
            $this->form->form_validation->set_rules($this->name, $this->field->label, $this->field->validation);
            if ($this->form->form_validation->run($this->ci) == FALSE)
                return form_error($this->name, ' ', ' ');
            else
                return FALSE;
    }

    public function renderHtml()
    {
        $result = '';
        $name .= $this->name.'[]';

        if (is_string($this->field->initial))
            $this->field->initial = explode("\n", $this->field->initial);

        if (is_string($this->field->selected))
            $this->field->selected = explode("\n", $this->field->selected);
        

        if (count($this->field->initial) == 0)
        {
            return;
        }

        foreach ($this->field->initial as $key => $val)
        {
            $checked = '';
            $val = trim($val);

            if ($this->field->selected != NULL)
                foreach ($this->field->selected as $s_key => $s_val)
                {
                    if (trim($s_val) == $key)
                    {
                        $checked = 'checked="checked"';
                    }
                }

            $result .= '<label><input type="radio" '.$this->form->_check_attr($name, $this->field).' value="'.$key.'" '.$checked.' /> '.$val.'</label> ';
            $result .= $this->form->_config['radiogroup_delimiter'];
        }

        return $result;
    }

}

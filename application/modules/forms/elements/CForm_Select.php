<?php

class CForm_Select {

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
        {
            $this->form->form_validation->set_rules($this->name, $this->field->label, $this->field->validation);
             
            if ($this->form->form_validation->run($this->ci) == FALSE)
            { 
                return form_error($this->name, ' ', ' ');
            }
            else
            {
                return FALSE;
            }
        }
    }

    public function renderHtml()
    {
        $name = $this->name;

        if (is_string($this->field->initial))
        {
            $this->field->initial = explode("\n", $this->field->initial);
        }

        if (is_string($this->field->selected))
        {
            $this->field->selected = explode("\n", $this->field->selected);
        }

        if (!isset($this->field->selected))
            $this->field->selected = array();

        if (isset($this->field->multiple) AND $this->field->multiple == TRUE)
        {
            $multiple = 'multiple="multiple"';
            $name .= '[]';
        }

        $select = '<select '.$this->form->_check_attr($name, $this->field).' '.$multiple.'>';

        if (isset($this->field->initial) AND count($this->field->initial))
        {
            foreach ($this->field->initial as $key => $val)
            {
                if(trim($val) != '')
                {
                    $selected = '';
                
                    foreach ($this->field->selected as $s_key => $s_val)
                    {
                        if ($s_val == $key)
                        {
                            $selected = 'selected="selected"';
                        }
                    }

                    $select .= '<option value="'.$key.'" '.$selected.'>'.trim($val).'</option>';
                }
            }
        }

        return $select.'</select>'; 
    }

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * Image CMS
 *
 * Forms Module
 *
 */

interface CFormObject {
    public function renderHtml();
    public function setInitial();
    public function rePopulate();
    public function getUserData();
}

class Forms extends MY_Controller {

 	public $ci;
    public $instance     = NULL;
    public $fields       = array();
    public $_config      = array();
    public $field_errors = array();
    public $upload_data  = array();

 	public function __construct()
 	{
 		parent::__construct();

        $this->load->library('form_validation');

        // Load config 
        $this->config->load('forms', TRUE);
        $this->_config = $this->config->item('forms');

        /** Standart object
        
            array(
                'username' => array (
                        'type'       => 'field_type',
                        'id'         => 'field id',
                        'label'      => 'Username',
                        'initial'    => 'Initial text',
                        'validation' => 'min_length[3]|max_length[50]'
                        'help_text'  => 'Field description text',
                        'attributes' => 'Html object attributes',
                        'style'      => 'color:#fff',
                        'class'      => 'css class name',
                        'error_text' => 'Custom error text',
                    ),
            );

            select/radiogroup/checkgroup:
                initial: array with values, or coma separated string
                selected: array with selected values, or coma separated string
                multiple: boolean

            checkbox:
                checked: boolean
        **/
        return $this;
 	}

    // Set config
    public function set_config($config = array())
    {
        if (count($config))
        {
            foreach ($config as $key => $val)
            {
                $this->_config[$key] = $val;
            }

            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    // Add fields array
    public function add_fields($fields = array())
    {
        $defaults = $this->_config['default_attr'];

        // Parse default settings
        foreach ($fields as $key => $field)
        {
            $class = ucfirst($field['type']);
            $class_name = 'CForm_'.$class;

            if (isset($defaults[$field['type']]))
            {
                $def = $defaults[$field['type']];
                $fields[$key] = array_merge($field, $def);
                $field = array_merge($field, $def);
            }

            // Load form classes.
            if (!class_exists('CForm_'.$class))
                require 'elements/CForm_'.$class.EXT;
            
            if (isset($field['type']) AND class_exists('CForm_'.$class))
            {
                $this->$key = new $class_name($key, $field);
            }
	    
	    if ($field['enable_tinymce_editor'] == 1)
	    {
		$fields[$key]['class'] = 'mceEditor2';
	    }
        }

        $this->fields = $fields;
	
        return $this;
    }

    // Standart form renderer
    public function render()
    {
        $result  = '';
        foreach ($this->fields as $name => $field)
        {
            //$pos  = array_search($name, $keys = array_keys($this->fields));
            //$next = $keys[$pos + 1];
 
            $result .= $this->$name->render();
        }

        if (!$this->_config['error_inline'])
                $result = $this->_validation_errors().$result; 

        return $result;
    }

    public function renderTable()
    {
        $result = '';    
        foreach ($this->fields as $key => $field)
        {
            if ($field['type'] != 'hidden')
            {
                $result .= '<tr>';
                $result .= '<td>'.$this->label($key, $field['label']).'</td>';
                $result .= '<td>';
                    $result .= $this->_get_inline_error($key);
                    $result .= $this->$key->renderHtml();
                    $result .= $this->_get_element_help_text($key);
                $result .= '</td>';
                $result .= '</tr>';
            }
            else
            {
                $result .= $this->$key->renderHtml(); 
            }
        }

        return $result;
    }

    public function standartRender($name, $field)
    {
        $result = '';
        $result .= $this->_config['element_prefix'];
        $result .= $this->_get_inline_error($name);
        $result .= $this->label($name, $field->label);
        $result .= $field->html;
        $result .= $this->_get_element_help_text($name);
        $result .= $this->_config['element_suffix'];
        return $result;
    }

    public function asArray()
    {
        $result = array();

        foreach ($this->fields as $key => $html)
        {
            $result[$key] = array(
                'label'     => $this->label($key, $this->fields[$key]['label']),
                'field'     => $this->$key->renderHtml(),
                'help_text' => $this->_get_element_help_text($key),
                'error_text'=> $this->_get_inline_error($key),
                'info'=>$this->fields[$key],
                'name'=>$key,
            );
        }

        //$result['form_errors'] = sprintf($this->config['error_block_html'], $this->_validation_errors());

        return $result;
    }

    public function _get_element_help_text($name)
    {
        $field = $this->fields[$name];

        if (isset($field['help_text']))
        {
            return sprintf($this->_config['help_text_html'], $field['help_text']);
        }
        else
        {
            return '';
        }
    }

    public function _get_inline_error($key)
    {
        if (array_key_exists($key, $this->field_errors) AND $this->_config['error_inline'] === TRUE)
        {
            return sprintf($this->_config['error_inline_html'], $this->field_errors[$key]); 
        }
        else
        {
            return '';
        } 
    }

    public function _validation_errors()
    {
        if (count($this->field_errors) > 0)
        {
            $result = '';

            foreach ($this->field_errors as $key => $val)
            {
                $result .= $this->_config['validation_errors_prefix'].$val.$this->_config['validation_errors_suffix'];
            }

            $result = sprintf($this->_config['error_block_html'], $result);

            return $result;
        }
    }

    public function getErrors()
    {
        if (count($this->field_errors) > 0)
            return $this->field_errors;
        else
            return FALSE;
    }

    // Set each field initial value.
    public function setInitial($data = array())
    {
        if (count($data))
            foreach ($data as $key => $val)
            {
                if (isset($this->$key) AND method_exists($this->$key, 'setInitial'))
                    $this->$key->setAttributes($val);
            }
    }

    // Repopulate form fields from $_POST or user data.
    public function setAttributes($data = array())
    {
        if (count($data) > 0 AND $data != FALSE)
        {
            foreach ($data as $key => $val)
            {
                if (isset($this->$key) AND method_exists($this->$key, 'setAttributes'))
                    $this->$key->setAttributes($val);
            }
        }
    }

    public function isValid()
    {
        $this->runValidation();

        if (count($this->field_errors) > 0 OR count($_POST) == 0)
            return FALSE;
        else
            return TRUE;
    }

    public function getData()
    {
        $data = array();
        foreach ($this->fields as $key => $val)
        {
            if (isset($this->$key) AND method_exists($this->$key, 'getData'))
            {
                $result = $this->$key->getData();
                if ($result !== FALSE AND $result !== NULL)
                    $data[$key] = $result;
            }
        }
        return $data;
    }

    public function runValidation()
    {
        if (count($_POST))
            foreach ($this->fields as $key => $val)
            {
                if (isset($this->$key) AND method_exists($this->$key, 'runValidation'))
                {
                    if(($result = $this->$key->runValidation()))
                        $this->field_errors[$key] = $result;
                }
            }
    }

    // Splits name, id, class, style and other attributes into one string
    function _check_attr($name = '', $field)
    {
        $return = '';

        if ($name)
        {
            $result .= ' name="'.$name.'" ';
        }

        $name = str_replace('[]', '', $name);

        if (isset($field->id))
        {
            $result .= ' id="'.$field->id.'" ';
        }
        else
        {
            $result .= ' id="'.$name.'" ';
        }

        if (isset($field->class) OR $this->field_errors[$name] != '')
        {
            $class = $field->class;
            if ($this->field_errors[$name] != '')
            {
                if ($class != NULL)
                {
                    $class .= ' ';
                }

                $class .= $this->_config['field_error_class'];
            }

            $result .= ' class="'.$class.'" ';
        }

        if (isset($field->attributes))
        {
            $result .= ' '.$field->attributes.' ';
        }

        if (isset($field->style))
        {
            $result .= ' style="'.$field->style.'" ';
        }
	
	if (isset($field->enable_tinymce_editor) && ($field->enable_tinymce_editor == 1))
	{
	    $field->class .= ' mceEditor2';
	}

        return $result;
    }

    public function label($for = '', $text = '')
    {
        $r_class = '';

        if (isset($this->$for) AND method_exists($this->$for, 'label'))
            return $this->$for->label();


        if ($text == '')
        {
            return '';
        }
        
        // Add required flag to label text
        if (isset($this->fields[$for]['validation']) AND strpos($this->fields[$for]['validation'], 'required') !== FALSE)
        {
            $text .= $this->_config['required_flag'];
            $r_class = ' '.$this->_config['required_label_class'];
        }

        return '<label for="'.$for.'" class="'.$this->_config['label_class'].$r_class.'">'.$text.'</label>';
    }
}



/* End of file ./application/modules/forms/forms.php */

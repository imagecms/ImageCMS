<?php

class Cfcm_forms extends MY_Controller {

    public
        $field_types = array(
            'text'       => 'Text',
            'textarea'   => 'Textarea',
            'select'     => 'Select',
            'checkbox'   => 'Checkbox',
            'checkgroup' => 'Checkgroup',
            'radiogroup' => 'Radiogroup',
        );

    public function __construct()
    {
        parent::__construct();

        $this->load->module('forms');
    }

    public function create_field()
    {
        $fields = array(
            'field_name' => array(
                'type'       => 'text',
                'label'      => 'Имя',
                'validation' => 'required|alpha_dash|max_length[255]',
                'help_text'  => 'К имени будет добавлен префикс field_',
            ),
            'label' => array(
                'type'       => 'text',
                'label'      => 'Label',
                'validation' => 'required|max_length[255]',
            ),
            'in_search' => array(
                'type'       => 'checkbox',
                'label'      => 'Участвует в поиске',
                'initial'    => '1',
            ),
            'type' => array(
                'type'       => 'select',
                'label'      => 'Тип',
                'initial'    => $this->field_types,
            ),
            'group' => array(
                'type'       => 'select',
                'label'      => 'Группа',
                'initial'    => self::prepare_groups_select(),
            ), 
        );

        return $this->forms->add_fields($fields);
    }

    public function edit_field($type)
    {
        $f = array();

        $f['initial'] = array(
            'type'    => 'textarea',
            'label'   => 'Начальное значение',
        );
        $f['help_text'] = array(
            'type'      => 'text',
            'label'     => 'Подсказка',
            'help_text' => 'Описание поля.',
        );
        $f['required'] = array(
            'type'    => 'checkbox',
            'label'   => 'Обязательное поле',
            'initial' => '1',
        );
        
        if (in_array($type, array('select', 'checkgroup', 'radiogroup')))
            $f['initial']['help_text'] = 'Укажите возможные значения в новой строке.';

        if ($type == 'select')
            $f['multiple'] = array(
                'type'    => 'checkbox',
                'label'   => 'Multiple',
                'initial' => '1',
                'checked' => FALSE,
            );
        
        if ($type == 'checkbox')
            $f['checked'] = array(
                'type'    => 'checkbox',
                'label'   => 'Checked',
                'initial' => '1',
                'checked' => FALSE,
            );

        if ($type == 'text' OR $type == 'textarea')
        {
            $f['enable_image_browser'] = array(
                'type'    => 'checkbox',
                'label'   => 'Включить просмотр изображений',
                'initial' => '1',
                'checked' => FALSE,
            );

            $f['enable_file_browser'] = array(
                'type'    => 'checkbox',
                'label'   => 'Включить просмотр файлов',
                'initial' => '1',
                'checked' => FALSE,
            );
            
        }
        
        if ($type == 'textarea')
        {
                $f['enable_tinymce_editor'] = array(
                'type'  => 'checkbox',
                'label' => 'Включить редактор Tinymce',
                'initial'=> '1',
                'checked'=> FALSE,
            );
        }

        $f['validation'] = array(
            'type'      => 'text',
            'label'     => 'Условия проверки',
            'help_text' => 'Например: valid_email|max_length[255]',
        );

        return $this->forms->add_fields($f);
    
    }

    public function create_group_form()
    {
        return $this->forms->add_fields(array(
            'name' => array(
                'type'  => 'text',
                'label' => 'Имя',
                'validation' => 'required|max_length[255]',
            ),
            'description' => array(
                'type'  => 'textarea',
                'label' => 'Описание',
            ),
        ));
    }

    // Return groups array: group_id => name
    public function prepare_groups_select()
    {
        $this->db->select('id, name');
        $groups = $this->db->get('content_field_groups');

        $list = array('0' => 'Без группы');
        if ($groups->num_rows() > 0)
        { 
            foreach ($groups->result_array() as $group)
            {
                $list[$group['id']] = $group['name'];
            }
        }

        return $list;
    }

}

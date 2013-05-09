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
                'label'      => lang('Name'),
                'validation' => 'alpha_dash|max_length[255]',
                'help_text'  => lang('To name will be prefixed with') . 'field_',
                'class'      => 'required alphanumeric'
            ),
            'label' => array(
                'type'       => 'text',
                'label'      => 'Label',
                'validation' => 'max_length[255]',
                'class'      => 'required'
            ),
            'in_search' => array(
                'type'       => 'checkbox',
                'label'      => lang('Participate in search'),
                'initial'    => '1',
            ),
            'type' => array(
                'type'       => 'select',
                'label'      => lang('Type'),
                'initial'    => $this->field_types,
            ),
            'groups' => array(
                'type'       => 'select',
                'label'      => lang('Group'),
                'initial'    => self::prepare_groups_select(),
                'multiple'   => true,
                'class'      => 'required'
            ), 
		'data'       => array(
                    'type'       => 'hidden',
                    'validation' => 'alpha_dash',
                    'initial'    => '',
            ),
        );

        return $this->forms->add_fields($fields);
    }

    public function edit_field($type)
    {
        $f = array();

         $f['label'] = array(
                'type'       => 'text',
                'label'      => 'Label',
                'validation' => 'max_length[255]',
                'class'      => 'required',
         );
        $f['initial'] = array(
            'type'    => 'textarea',
            'label'   => lang('The initial value'),
        );
        $f['help_text'] = array(
            'type'      => 'text',
            'label'     => lang('Hint'),
            'help_text' => lang('Field description ') . '.',
        );
        $f['required'] = array(
            'type'    => 'checkbox',
            'label'   => lang('Required field'),
            'initial' => '1',
        );
        $f['type'] = array(
                'type'       => 'select',
                'label'      => lang('Type'),
                'initial'    => $this->field_types,
        );
        
        if (in_array($type, array('select', 'checkgroup', 'radiogroup')))
            $f['initial']['help_text'] = lang('Specify the possible values in the new row') . '.';

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
                'label'   => lang('Enable images viewing'),
                'initial' => '1',
                'checked' => FALSE,
            );

            $f['enable_file_browser'] = array(
                'type'    => 'checkbox',
                'label'   => lang('Enable file viewing'),
                'initial' => '1',
                'checked' => FALSE,
            );
            
        }
        
//        if ($type == 'textarea')
//        {
//                $f['enable_tinymce_editor'] = array(
//                'type'  => 'checkbox',
//                'label' => lang('Enable Tinymce editor'),
//                'initial'=> '1',
//                'checked'=> FALSE,
//            );
//        }

        $f['validation'] = array(
            'type'      => 'text',
            'label'     => lang('Check conditions'),
            'help_text' => lang('For example') . ': valid_email|max_length[255]',
        );
        $f['groups'] = array(
                'type'       => 'select',
                'label'      => lang('Group'),
                'initial'    => self::prepare_groups_select(),
                'multiple'   => true,
                'class'     => 'required'
            );
        return $this->forms->add_fields($f);
    
    }

    public function create_group_form()
    {
        return $this->forms->add_fields(array(
            'name' => array(
                'type'  => 'text',
                'label' => lang('Name'),
                'validation' => 'max_length[255]',
                'class'     => 'required'
            ),
            'description' => array(
                'type'  => 'textarea',
                'label' => lang('Description'),
            ),
        ));
    }

    // Return groups array: group_id => name
    public function prepare_groups_select()
    {
        $this->db->select('id, name');
        $groups = $this->db->get('content_field_groups');

        $list = array('-1' => lang('Without group'));
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

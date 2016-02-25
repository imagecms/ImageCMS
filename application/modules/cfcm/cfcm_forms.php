<?php

class Cfcm_forms extends MY_Controller
{

    public $field_types = [
        'text' => 'Text',
        'textarea' => 'Textarea',
        'select' => 'Select',
        'checkbox' => 'Checkbox',
        'checkgroup' => 'Checkgroup',
        'radiogroup' => 'Radiogroup',
    ];

    public function __construct() {
        parent::__construct();

        $this->load->module('forms');
        $lang = new MY_Lang();
        $lang->load('cfcm');
    }

    public function create_field() {
        $fields = [
            'field_name' => [
                'type' => 'text',
                'label' => lang('Name', 'cfcm') . ': '."<span class='must'>*</span>",
                'validation' => 'alpha_dash|max_length[255]',
                'help_text' => lang('To name will be prefixed with', 'cfcm') . ' field_',
                'class' => 'required alphanumeric'
            ],
            'label' => [
                'type' => 'text',
                'label' => lang('Label', 'cfcm') . ': '."<span class='must'>*</span>",
                'validation' => 'max_length[255]',
                'class' => 'required'
            ],
            //            'in_search' => [
            //                'type' => 'checkbox',
            //                'label' => lang('Participate in search', 'cfcm'),
            //                'initial' => '1',
            //            ],
            'type' => [
                'type' => 'select',
                'label' => lang('Type', 'cfcm') . ':',
                'initial' => $this->field_types,
            ],
            'groups' => [
                'type' => 'select',
                'label' => lang('Group', 'cfcm') . ':',
                'initial' => self::prepare_groups_select(),
                'multiple' => true,
                'help_text' => lang('Tighten Ctrl to select multiple items', 'admin'),
                'class' => 'required'
            ],
            'data' => [
                'type' => 'hidden',
                'validation' => 'alpha_dash',
                'initial' => '',
            ],
        ];

        return $this->forms->add_fields($fields);
    }

    public function edit_field($type) {
        $f = [];

        $f['label'] = [
            'type' => 'text',
            'label' => lang('Label', 'cfcm') . ': '."<span class='must'>*</span>",
            'validation' => 'max_length[255]',
            'class' => 'required',
        ];
        $f['initial'] = [
            'type' => 'textarea',
            'label' => lang('The initial value', 'cfcm') . ':',
        ];
        $f['help_text'] = [
            'type' => 'text',
            'label' => lang('Hint', 'cfcm') . ':',
            'help_text' => lang('Field description ', 'cfcm') . '.',
        ];
        $f['required'] = [
            'type' => 'checkbox',
            'label' => lang('Required field', 'cfcm'),
            'initial' => '1',
        ];
        $f['type'] = [
            'type' => 'text',
            'style' => 'display: none'
        ];

        if (in_array($type, ['select', 'checkgroup', 'radiogroup'])) {
            $f['initial']['help_text'] = lang('Specify the possible values in the new row', 'cfcm') . '.';
        }

        if ($type == 'select') {
            $f['multiple'] = [
                'type' => 'checkbox',
                'label' => lang('Multiple', 'cfcm'),
                'initial' => '1',
                'checked' => FALSE,
            ];
        }

        if ($type == 'checkbox') {
            $f['checked'] = [
                'type' => 'checkbox',
                'label' => lang('Checked', 'cfcm'),
                'initial' => '1',
                'checked' => FALSE,
            ];
        }

        if ($type == 'text' OR $type == 'textarea') {
            $f['enable_image_browser'] = [
                'type' => 'checkbox',
                'label' => lang('Enable images viewing', 'cfcm'),
                'initial' => '1',
                'checked' => FALSE,
            ];

            $f['enable_file_browser'] = [
                'type' => 'checkbox',
                'label' => lang('Enable file viewing', 'cfcm'),
                'initial' => '1',
                'checked' => FALSE,
            ];
        }

        //        if ($type == 'textarea')
        //        {
        //                $f['enable_tinymce_editor'] = array(
        //                'type'  => 'checkbox',
        //                'label' => lang('Enable Tinymce editor', 'cfcm'). ':',
        //                'initial'=> '1',
        //                'checked'=> FALSE,
        //            );
        //        }

        $f['validation'] = [
            'type' => 'text',
            'label' => lang('Check conditions', 'cfcm') . ':',
            'help_text' => lang('For example', 'cfcm') . ': valid_email|max_length[255]',
        ];
        $f['groups'] = [
            'type' => 'select',
            'label' => lang('Group', 'cfcm') . ': ',
            'initial' => self::prepare_groups_select(),
            'multiple' => true,
            'help_text' => lang('Tighten Ctrl to select multiple items', 'admin'),
            'class' => 'required'
        ];
        return $this->forms->add_fields($f);
    }

    public function create_group_form() {
        return $this->forms->add_fields(
            [
                    'name' => [
                        'type' => 'text',
                        'label' => lang('Name', 'cfcm').': '."<span class='must'>*</span>",
                        'validation' => 'max_length[255]',
                        'class' => 'required'
                    ],
                    'description' => [
                        'type' => 'textarea',
                        'label' => lang('Description', 'cfcm'),
                    ],
            ]
        );
    }

    // Return groups array: group_id => name

    public function prepare_groups_select() {
        $this->db->select('id, name');
        $groups = $this->db->get('content_field_groups');

        $list = ['-1' => lang('Without group', 'cfcm')];
        if ($groups->num_rows() > 0) {
            foreach ($groups->result_array() as $group) {
                $list[$group['id']] = $group['name'];
            }
        }

        return $list;
    }

}
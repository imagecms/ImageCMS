<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * CFCFM Module
 */
class Cfcm extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $obj = new MY_Lang();
        $obj->load('cfcm');

        $this->load->module('forms');
        $this->load->library('form_validation');
        $this->_set_forms_config();
    }

    public function _set_forms_config() {
        $config = array();
        $config['filter_xss_post'] = TRUE;
        $config['error_inline'] = TRUE;
        $config['upload_file'] = array(
            'upload_path' => './uploads/files',
            'allowed_types' => 'zip|rar|txt',
            'max_size' => '2048',
        );
        $config['upload_image'] = array(
            'upload_path' => './uploads/images',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => '2048',
            'max_width' => '1024',
            'max_height' => '768',
        );
        $config['error_inline_html'] = '<div class="error_field_text el_magrin">%s</div>';
        $config['error_block_html'] = '<div class="errors">%s</div>';
        $config['help_text_html'] = '<span class="help-block">%s</span>';
        $config['validation_errors_prefix'] = '';
        $config['validation_errors_suffix'] = '<br />';
        $config['field_error_class'] = 'field_error';
        $config['element_prefix'] = '<p class="clear">';
        $config['element_suffix'] = '</p>';
        $config['label_class'] = '';
        $config['required_flag'] = ' *';
        $config['required_label_class'] = 'required';
        $config['checkgroup_delimiter'] = '';
        $config['radiogroup_delimiter'] = '';
        $config['default_attr'] = array(
            'captcha' => array(
                'label' => lang("Protection code", 'cfcm'),
            ),
        );

        $this->forms->set_config($config);
    }

    public function save_item_data($item_id, $type = 'page') {
        $this->load->module('forms');

        $group = (int) $this->input->post('cfcm_use_group');

        if ($group != '0') {
            if (($fields = $this->get_group_fields($group))) {
                $form = $this->forms->add_fields($fields);

                if ($form->isValid()) {
                    if ($item_id > 0) {
                        // Save fields data
                        $data = $form->getData();

                        $this->update_fields_data($item_id, $data, $type);

                        // Delete empty fields
                        foreach ($fields as $name => $field) {
                            if (!array_key_exists($name, $data)) {
                                $this->db->where('item_id', $item_id);
                                $this->db->where('field_name', $name);
                                $this->db->where('item_type', $type);
                                $this->db->delete('content_fields_data');
                            }
                        }
                    }
                } else {
                    showMessage($form->_validation_errors(), false, 'r');
                    die();
                }
            }
        }
    }

    public function get_form($category_id = FALSE, $item_id = FALSE, $item_type = FALSE, $tpl = '_onpage_form') {
        if ('page' === $category_id) {
            $item_type = 'page';
            $item_id = 0;
            $category_id = 0;
        }

        if ($item_id === 'page') {
            $item_type = 'page';
            $item_id = $category_id;
            $category_id = 0;
        }

        $category = (object) $this->lib_category->get_category($category_id);
        if ($item_type == 'category')
            $category->field_group = $category->category_field_group;

        if ($category_id == '0')
            $category->field_group = -1;

        if ($category->field_group != '0') {
            // Get group
            $group = $this->db->get_where('content_field_groups', array('id' => $category->field_group))->row();

            // Get all fields in group
            $fg = (int) $category->field_group;
            $query = $this->db->select('*')
                    ->from('content_fields')
                    ->join('content_fields_groups_relations', 'content_fields_groups_relations.field_name = content_fields.field_name')
                    ->where("content_fields_groups_relations.group_id = $category->field_group")
                    ->order_by('weight', 'ASC')
                    ->get();

            if ($query->num_rows() > 0) {
                $form_fields = array();
                $fields = $query->result_array();

                foreach ($fields as $field) {
                    $f_data = unserialize($field['data']);
                    if ($f_data == FALSE)
                        $f_data = array();

                    $form_fields[$field['field_name']] = array(
                        'type' => $field['type'],
                        'label' => encode($field['label']),
                    );

                    $form_fields[$field['field_name']] = array_merge($form_fields[$field['field_name']], $f_data);
                }

                $form = $this->forms->add_fields($form_fields);

                // Set form attributes
                if ($item_id != FALSE AND $item_type != FALSE) {

                    $attributes = $this->get_form_attributes($fields, $item_id, $item_type);

                    if (count($attributes) > 0 AND is_array($attributes)) {
                        $form->setAttributes($attributes);
                    }
                }
                $form->title = $group->name;

                $gid = isset($group->id) ? $group->id : -1;

                $hiddenField = '<input type="hidden" name="cfcm_use_group" value="' . $gid . '" />';
            } else {
               $form = array();
            }
        } 

        $this->template->add_array(array(
            'form' => $form,
            'hf' => $hiddenField
        ));

        $this->display_tpl($tpl);
    }

    public function get_form_attributes($fields, $item_id, $item_type) {
        $this->db->where('item_id', $item_id);
        $this->db->where('item_type', $item_type);
        $query = $this->db->get('content_fields_data');

        if ($query->num_rows() == 0)
            return FALSE;

        $result = array();
        $data = $query->result_array();

        foreach ($data as $row) {
            if (!isset($result[$row['field_name']])) {
                $result[$row['field_name']] = $row['data'];
            } elseif (isset($result[$row['field_name']])) {
                $result[$row['field_name']] = (array) $result[$row['field_name']];
                $result[$row['field_name']][] = $row['data'];
            }
        }

        return $result;
    }

    public function get_group_fields($group_id = -1) {
//        if (!$group_id)
//            $group_id = -1;
        //Chech if we need fields without group
//        if ($group_id == 0)
//        {
//            $queryStr = "SELECT * 
//                FROM  `content_fields` 
//                WHERE field_name NOT 
//                IN (
//                    SELECT field_name
//                    FROM content_fields_groups_relations
//                )";
//            $query = $this->db->query($queryStr);
//        }
//        else
        // Get all fields in group
        $query = $this->db
                ->where('group_id', $group_id)
                ->join('content_fields', 'content_fields_groups_relations.field_name = content_fields.field_name')
                ->order_by('weight', 'ASC')
                ->get('content_fields_groups_relations');

        if ($query->num_rows() > 0) {
            $form_fields = array();
            $fields = $query->result_array();

            foreach ($fields as $field) {
                $f_data = unserialize($field['data']);
                if ($f_data == FALSE)
                    $f_data = array();

                $form_fields[$field['field_name']] = array(
                    'type' => $field['type'],
                    'label' => $field['label'],
                );

                $form_fields[$field['field_name']] = array_merge($form_fields[$field['field_name']], $f_data);
            }

            return $form_fields;
        }
        else {
            return FALSE;
        }
    }

    // Merge item array with fields data
    // select/checkgroup/radiogroup always returned as array
    public function connect_fields($item_data, $item_type) {
        if (($cache_result = $this->cache->fetch('cfcm_field_' . $item_data['id'] . $item_type)) !== FALSE) {
            $item_data = array_merge($item_data, $cache_result);
            return $item_data;
        }

        $replace = array();
        $wight = array();
        $fields_data = array();

        $item_id = $item_data['id'];

        $this->db->where('item_id', $item_id);
        $this->db->where('item_type', $item_type);
        $query = $this->db->get('content_fields_data');

        if ($query->num_rows() == 0)
            return $item_data;

        $result = array();
        $data = $query->result_array();

        foreach ($data as $row) {
            if (!isset($result[$row['field_name']])) {
                $result[$row['field_name']] = $row['data'];
            } elseif (isset($result[$row['field_name']])) {
                $result[$row['field_name']] = (array) $result[$row['field_name']];
                $result[$row['field_name']][] = $row['data'];
            }
        }

        foreach ($result as $key => $val) {
            $field = $this->db->get_where('content_fields', array('field_name' => $key))->row();

            $weight[$field->field_name] = $field->weight;

            if (is_array($val) OR in_array($field->type, array('select', 'checkgroup', 'radiogroup'))) {
                $field = unserialize($field->data);

                if (is_array($field) AND count($field) > 0 AND $field['initial'] != '') {
                    $values = explode("\n", $field['initial']);

                    $result[$key] = array_flip((array) $result[$key]);
                    foreach ($result[$key] as $s_key => $s_val) {
                        $result[$key][$s_key] = $values[$s_key];
                    }

                    ksort($result[$key]);
                }
            }
        }

        //Sort fields by weight
        array_multisort($weight, SORT_ASC, $result, SORT_DESC, $result);

        if (count($result) > 0) {
            // Display many many values
            foreach ($result as $key => $val) {
                if (is_array($val))
                    $result[$key] = implode(', ', $val);
            }

            $this->cache->store('cfcm_field_' . $item_data['id'] . $item_type, $result);
            $item_data = array_merge($item_data, $result);
        }

        return $item_data;
    }

    // Save fields data in DB
    private function update_fields_data($item_id, $data, $type) {
        if (count($data) > 0) {
            foreach ($data as $key => $val) {
                $field_data = array(
                    'item_id' => $item_id,
                    'item_type' => $type,
                    'field_name' => $key,
                );

                if (!is_array($val)) {
                    if ($this->db->get_where('content_fields_data', $field_data)->num_rows() > 0) {
                        $this->db->where($field_data);
                        $field_data['data'] = $val;
                        $this->db->update('content_fields_data', $field_data);
                    } else {
                        $field_data['data'] = $val;
                        $this->db->insert('content_fields_data', $field_data);
                    }
                } else {
                    // Clear
                    $this->db->where($field_data);
                    $this->db->delete('content_fields_data');

                    foreach ($val as $sub_key => $sub_val) {
                        $field_data['data'] = $sub_val;
                        $this->db->insert('content_fields_data', $field_data);
                    }
                }
            }
        }
    }

    // Get field info.
    public function get_field($name) {
        $this->db->limit(1);
        $this->db->where('field_name', $name);
        $query = $this->db->get('content_fields');

        if ($query->num_rows() == 1) {
            $data = $query->row_array();
            $data['data'] = unserialize($data['data']);

            return $data;
        } else {
            return FALSE;
        }
    }

    /**
     * Display template file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    /**
     * Fetch template file
     */
    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file sample_module.php */

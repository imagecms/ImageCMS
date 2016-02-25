<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * CFCFM Module
 * @property Lib_category $lib_category
 * @property Forms $forms
 */
class Cfcm extends MY_Controller
{

    public function __construct() {

        parent::__construct();
        $obj = new MY_Lang();
        $obj->load('cfcm');

        $this->load->module('forms');
        $this->load->library('form_validation');
        $this->_set_forms_config();
    }

    public function _set_forms_config() {

        $this->load->config('cfcm');

        $this->forms->set_config($this->config->item('cfcm'));
    }

    /**
     * @param integer $item_id
     * @param string $type
     */
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
                        foreach (array_keys($fields) as $name) {
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

    /**
     * @param bool|false|int $category_id
     * @param bool|false|int $item_id
     * @param bool|false|int $item_type
     * @param string $tpl
     */
    public function get_form($category_id = false, $item_id = false, $item_type = false, $tpl = '_onpage_form') {

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
        if ($item_type == 'category') {
            $category->field_group = $category->category_field_group;
        }

        if ($category_id == '0') {
            $category->field_group = -1;
        }

        if ($category->field_group != '0') {
            // Get group
            $group = $this->db->get_where('content_field_groups', ['id' => $category->field_group])->row();

            // Get all fields in group
            $query = $this->db->select('*')
                ->from('content_fields')
                ->join('content_fields_groups_relations', 'content_fields_groups_relations.field_name = content_fields.field_name')
                ->where("content_fields_groups_relations.group_id = $category->field_group")
                ->order_by('weight', 'ASC')
                ->get();

            if ($query) {
                $form_fields = [];
                $fields = $query->result_array();

                foreach ($fields as $field) {
                    $f_data = unserialize($field['data']);
                    if ($f_data == false) {
                        $f_data = [];
                    }

                    $form_fields[$field['field_name']] = [
                        'type' => $field['type'],
                        'label' => encode($field['label']),
                    ];

                    $form_fields[$field['field_name']] = array_merge($form_fields[$field['field_name']], $f_data);
                }

                $form = $this->forms->add_fields($form_fields);

                // Set form attributes
                if ($item_id != false AND $item_type != false) {

                    $attributes = $this->get_form_attributes($fields, $item_id, $item_type);

                    if (count($attributes) > 0 AND is_array($attributes)) {
                        $form->setAttributes($attributes);
                    }
                }
                $form->title = $group->name;

                $gid = isset($group->id) ? $group->id : -1;

                $hiddenField = '<input type="hidden" name="cfcm_use_group" value="' . $gid . '" />';
            } else {
                $form = [];
            }
        }

        $this->template->add_array(
            [
                'form' => $form,
                'hf' => $hiddenField
            ]
        );

        $this->display_tpl($tpl);
    }

    /**
     * @param array $fields
     * @param integer $item_id
     * @param string|boolean $item_type
     * @return array|bool
     */
    public function get_form_attributes(array $fields, $item_id, $item_type) {

        $this->db->where('item_id', $item_id);
        $this->db->where('item_type', $item_type);
        $query = $this->db->get('content_fields_data');

        $result = [];
        if ($query->num_rows() > 0) {

            $data = $query->result_array();

            foreach ($data as $row) {

                foreach ($fields as $key => $field) {
                    if ($field['field_name'] === $row['field_name']) {
                        unset($fields[$key]);
                    }
                }
                if (!isset($result[$row['field_name']])) {
                    $result[$row['field_name']] = $row['data'];
                } elseif (isset($result[$row['field_name']])) {
                    $result[$row['field_name']] = (array) $result[$row['field_name']];
                    $result[$row['field_name']][] = $row['data'];
                }
            }

        }
        //add unchecked checkboxes
        if (count($fields) > 0) {
            foreach ($fields as $field) {
                if ($field['type'] == 'checkbox') {
                    $result[$field['field_name']] = false;
                }
            }
        }

        return count($result) ? $result : false;
    }

    /**
     * @param int $group_id
     * @return array|bool
     */
    public function get_group_fields($group_id = -1) {

        // Get all fields in group
        $query = $this->db
            ->where('group_id', $group_id)
            ->join('content_fields', 'content_fields_groups_relations.field_name = content_fields.field_name')
            ->order_by('weight', 'ASC')
            ->get('content_fields_groups_relations');

        if ($query->num_rows() > 0) {
            $form_fields = [];
            $fields = $query->result_array();

            foreach ($fields as $field) {
                $f_data = unserialize($field['data']);
                if ($f_data == false) {
                    $f_data = [];
                }

                $form_fields[$field['field_name']] = [
                    'type' => $field['type'],
                    'label' => $field['label'],
                ];

                $form_fields[$field['field_name']] = array_merge($form_fields[$field['field_name']], $f_data);
            }

            return $form_fields;
        } else {
            return false;
        }
    }

    /**
     * Merge item array with fields data
     * select/checkgroup/radiogroup always returned as array
     * @param array $item_data
     * @param string $item_type
     * @return array
     */
    public function connect_fields($item_data, $item_type) {

        if (($cache_result = $this->cache->fetch('cfcm_field_' . $item_data['id'] . $item_type)) !== false) {
            $item_data = array_merge($item_data, $cache_result);
            return $item_data;
        }

        $item_id = $item_data['id'];

        $this->db->where('item_id', $item_id);
        $this->db->where('item_type', $item_type);
        $query = $this->db->get('content_fields_data');

        if ($query->num_rows() == 0) {
            return $item_data;
        }

        $result = [];
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
            $field = $this->db->get_where('content_fields', ['field_name' => $key])->row();

            $weight[$field->field_name] = $field->weight;

            if (is_array($val) OR in_array($field->type, ['select', 'checkgroup', 'radiogroup'])) {
                $field = unserialize($field->data);

                if (is_array($field) AND count($field) > 0 AND $field['initial'] != '') {
                    $values = explode("\n", $field['initial']);

                    $result[$key] = array_flip((array) $result[$key]);
                    foreach (array_keys($result[$key]) as $s_key) {
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
                if (is_array($val)) {
                    $result[$key] = implode(', ', $val);
                }
            }

            $this->cache->store('cfcm_field_' . $item_data['id'] . $item_type, $result);
            $item_data = array_merge($item_data, $result);
        }

        return $item_data;
    }

    /**
     * Save fields data in DB
     * @param integer $item_id
     * @param array $data
     * @param string $type
     */
    private function update_fields_data($item_id, $data, $type) {

        if (count($data) > 0) {
            foreach ($data as $key => $val) {
                $field_data = [
                    'item_id' => $item_id,
                    'item_type' => $type,
                    'field_name' => $key,
                ];

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

                    foreach ($val as $sub_val) {
                        $field_data['data'] = $sub_val;
                        $this->db->insert('content_fields_data', $field_data);
                    }
                }
            }
        }
    }

    /**
     * Get field info.
     * @param string $name
     * @return bool|array
     */
    public function get_field($name) {

        $this->db->limit(1);
        $this->db->where('field_name', $name);
        $query = $this->db->get('content_fields');

        if ($query->num_rows() == 1) {
            $data = $query->row_array();
            $data['data'] = unserialize($data['data']);

            return $data;
        } else {
            return false;
        }
    }

    /**
     * Display template file
     * @param string $file
     */
    private function display_tpl($file = '') {

        $file = realpath(__DIR__) . '/templates/public/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

}
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * CFCM Admin
 */
class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        cp_check_perm('module_admin');

        parent::__construct();

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
                'label' => lang('amt_protection_code'),
            ),
        );

        $this->forms->set_config($config);
    }

    public function index() {
        $this->template->add_array(array(
            'fields' => $this->db->order_by('weight', 'ASC')->get('content_fields')->result_array(),
            'groups' => $this->load->module('cfcm/cfcm_forms')->prepare_groups_select(),
        ));
        
        $groups = $this->db->get('content_field_groups');

        if ($groups->num_rows() > 0) {
            $this->template->assign('groups', $groups->result_array());
        }

        $this->render('index');
//         echo $this->display_tpl('index');
    }

    public function create_field() {
        $form = $this->get_form('create_field');
        $form->action = $this->get_url('create_field');
        $form->title = lang('amt_field_creating');

        if ($_POST) {

            if (empty($_POST['field_name'])) {
                showMessage(lang('amt_type_field_name'), false, 'r');
                exit;
            }
            if (empty($_POST['label'])) {
                showMessage(lang('amt_type_field_label'), false, 'r');
                exit;
            }
            if (!preg_match("/^[0-9a-z_]+$/i", $_POST['field_name'])) {
                showMessage(lang('amt_just_latin'), false, 'r');
                exit;
            }

            if ($form->isValid()) {
                
                $data = $form->getData();
                $groups = $data['groups'];
                unset($data['groups']);
                $data['field_name'] = 'field_' . $data['field_name'];
                if ($this->db->get_where('content_fields', array('field_name' => $data['field_name']))->num_rows() > 0) {
                    showMessage(lang('amt_select_another_name'), false, 'r');
                } else {
                    // Set field weight.
                    $this->db->select_max('weight');
                    $query = $this->db->get('content_fields')->row();
                    $data['weight'] = $query->weight + 1;

                    $this->db->insert('content_fields', $data);
                    
                    //write relations
                    $toInsert = array();
                    if (count($groups))
                    {
                        foreach($groups as $group)
                            $toInsert[] = array('field_name' => $data['field_name'],
                                    'group_id' => $group
                                );

                        if (count($toInsert))
                            $this->db->insert_batch ('content_fields_groups_relations', $toInsert);
                    }
                    
                    showMessage(lang('amt_field_created'));
                    pjax( $this->get_url('edit_field/' . $data['field_name']));
                    exit;
                }
            } else {
                showMessage($form->_validation_errors(), false, 'r');
            }
        }

        $this->template->add_array(array(
            'form' => $form,
        ));

        //$this->display_tpl('top_navigation');
//         $this->display_tpl('_form');
        $this->render('_form');
    }

    public function edit_field_data_type($field_name) {
        $form = $this->get_form('create_field');
        $form->action = $this->get_url('edit_field_data_type/' . $field_name);
        $form->title = lang('amt_field_edit');

        $field = $this->db->get_where('content_fields', array('field_name' => $field_name))->row_array();

        if ($_POST) {
            $_POST['field_name'] = $field['field_name'];

            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['field_name']);

                if (!$data['in_search'])
                    $data['in_search'] = 0;

                $this->db->limit(1);
                $this->db->where('field_name', $field_name);
                $this->db->update('content_fields', $data);

                showMessage(lang('amt_field_updated'));
                pjax($this->get_url('index'));
                exit;
            }
            else {
                showMessage($form->_validation_errors(), false, 'r');
                exit;
            }
            exit;
        }

        $form->setAttributes($field);
        $form->field_name->field->attributes = 'disabled="disabled"';

        $this->template->add_array(array(
            'form' => $form,
        ));

//         $this->display_tpl('_form');
        $this->render('_form');
    }

    public function delete_field($field_name) {
        $field_name = urldecode($field_name);
        
        $this->db->where('field_name', $field_name)
                ->delete('content_fields');

        $this->db->where('field_name', $field_name)
                ->delete('content_fields_data');
        
        $this->db->where('field_name', $field_name)
                ->delete('content_fields_groups_relations');
        
        showMessage(lang('a_field_deleted_success'));
        pjax($this->get_url('index'));
    }

    public function edit_field($name = '') {
        $name = urldecode($name);
        $this->db->limit(1);
        $field = $this->db->get_where('content_fields', array('field_name' => (string) $name));

        if ($field->num_rows() == 1) {
            $field = $field->row();
            $field_data = unserialize($field->data);

            $form = $this->load->module('cfcm/cfcm_forms')->edit_field($field->type);

            $form->title = lang('amt_field_editing') . $field->label;
            $form->action = $this->get_url('edit_field/' . $name);

            $form->setAttributes($field_data);

            $form->validation->setInitial(str_replace('required|', '', $field_data['validation']));

            if ($_POST) {
                $data = $form->getData();

                if (isset($data['required']))
                    $data['validation'] = 'required|' . $data['validation'];
                unset($data['validation_required']);

                $this->db->where('field_name', $field->field_name);
                $this->db->update('content_fields', array('data' => serialize($data)));
                showMessage(lang('amt_field_updated'));
                if ($this->input->post('action') == 'close')
                    pjax( $this->get_url('index'));
                else
                    pjax( $_SERVER['HTTP_REFERER']);
                exit;
            }

            $this->template->add_array(array(
                'form' => $form,
            ));
            
//             $this->display_tpl('_form');
            $this->render('_form');
        }
        else
            echo lang('amt_field_not_found');
    }

    public function create_group() {
        $form = $this->get_form('create_group_form');
        $form->action = $this->get_url('create_group');
        $form->title = lang('a_create_group_m');

        if ($_POST) {
            if (empty($_POST['name'])) {
                showMessage(lang('amt_type_group_name'), false, 'r');
                exit;
            }

            if ($form->isValid()) {
                $this->db->insert('content_field_groups', $form->getData());
                showMessage(lang('amt_group_created'));

                pjax('/admin/components/cp/cfcm');
            } else {
                showMessage($form->_validation_errors(), false, 'r');
            }
            exit;
        }

        $this->template->add_array(array(
            'form' => $form,
        ));

//         $this->display_tpl('_form');
        $this->render('_form');
    }

    public function edit_group($id) {
        $id = (int) $id;

        $group = $this->db->get_where('content_field_groups', array('id' => $id));

        if ($group->num_rows() == 1) {
            $group = $group->row_array();
        } else {
            showMessage(lang('amt_group_not_found'), false, 'r');
            exit;
        }

        $form = $this->get_form('create_group_form');
        $form->action = $this->get_url('edit_group/' . $id);
        $form->title = lang('amt_group_editing_id') . $group['id'];

        if ($_POST)
            if ($form->isValid()) {
                $data = $form->getData();

                $this->db->limit(1);
                $this->db->where('id', $id);
                $this->db->update('content_field_groups', $data);
                showMessage(lang('amt_group_updated'));

                pjax( $this->get_url('index'));
                exit;
            } else {
                showMessage($form->_validation_errors(), false, 'r');
                exit;
            }

        $form->setAttributes($group);

        $this->template->add_array(array(
            'form' => $form,
        ));

//         $this->display_tpl('_form');
        $this->render('_form');
    }

    public function delete_group($id) {
        //todo: delete group
        $this->db->where('id', $id)
                ->delete('content_field_groups');

        $this->db->where('group_id', $id)
                ->update('content_fields_groups_relations', array('group_id' => '0'));

        $this->db->where('field_group', $id)
                ->update('category', array('field_group' => '-1'));
        
        $this->db->where('category_field_group', $id)
                ->update('category', array('category_field_group' => '-1'));
        
        showMessage(lang('a_group_deleted_success'));
        pjax($this->get_url('index'));
    }

    // Create form from category field group
    // on add/edit page tpl.
    public function form_from_category_group($category_id = FALSE, $item_id = FALSE, $item_type = FALSE) {
        if ($category_id == 'page') {
            $item_type = 'page';
            $item_id = 0;
            $category_id = 0;
        }

        if ($item_id == 'page') {
            $item_type = 'page';
            $item_id = $category_id;
            $category_id = 0;
        }

        $category = (object) $this->lib_category->get_category($category_id);

        if ($item_type == 'category')
            $category->field_group = $category->category_field_group;

        if ($category_id == '0')
            $category->field_group = 0;


        if ($category->field_group != '-1') {
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

                $hiddenField = '<input type="hidden" name="cfcm_use_group" value="' . $group->id . '" />';
                $this->template->add_array(array(
                    'form'  => $form,
                    'hf'    => $hiddenField  
                ));
                
                $this->display_tpl('_onpage_form');
                
            } else {
                echo '<div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">'
                    .lang('amt_no_field_in_group').
                    '</div>';
            }
        } else {
            echo '<div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">'
                .lang('amt_for_category') . $category->name . lang('amt_field_group_not_selected').
                '</div>';
        }
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

    public function save_weight() {
        if (count($_POST['fields_names']) > 0) {
            foreach ($_POST['fields_names'] as $k => $v) {
                $name = (string) substr($v, 5);
                $weight = (int) $_POST['fields_pos'][$k];

                $this->db->where('field_name', $name);
                $this->db->update('content_fields', array('weight' => $weight));
            }
        }
    }
    
//     render template
    public function render($viewName, array $data = array(), $return = false) {
    	if (!empty($data))
    		$this->template->add_array($data);
    

		if ($this->ajaxRequest)    	
    		echo $this->template->fetch('file:' . 'application/modules/cfcm/templates/admin/' . $viewName);
		else
			$this->template->show('file:' . 'application/modules/cfcm/templates/admin/' . $viewName);
//     	$this->template->fetch('file:' . 'application/modules/cfcm/templates/admin/' . $viewName);
    	exit;
    }

    /**
     * Display template file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    /**
     * Fetch template file
     */
    private function fetch_tpl($file = '', $data = array()) {
        $this->template->add_array($data);

        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

    public function get_url($segments) {
        return site_url('admin/components/cp/cfcm/' . $segments);
    }

    public function get_form($name) {
        return $this->load->module('cfcm/cfcm_forms')->$name();
    }

}
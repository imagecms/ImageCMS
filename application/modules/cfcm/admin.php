<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * CFCM Admin
 * @property Forms $forms
 * @property Cfcm $cfcm
 */
class Admin extends BaseAdminController
{

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        //cp_check_perm('module_admin');

        parent::__construct();

        $this->load->module('forms');
        $this->load->module('cfcm');

        $this->load->library('form_validation');
        $this->cfcm->_set_forms_config();

        $obj = new MY_Lang();
        $obj->load('cfcm');
    }

    public function create_field() {
        $form = $this->get_form('create_field');
        $form->action = $this->get_url('create_field');
        $form->title = lang('Field creating', 'cfcm');

        if ($this->input->post()) {

            if (!$this->input->post('field_name')) {
                showMessage(lang('Specify the field name', 'cfcm'), false, 'r');
                exit;
            }
            if (!$this->input->post('label')) {
                showMessage(lang('Specify <b>Label</b> field', 'cfcm'), false, 'r');
                exit;
            }
            if (!preg_match('/^[0-9a-z_]+$/i', $this->input->post('field_name'))) {
                showMessage(lang('Field Name cant contain only Latin alphanumeric characters', 'cfcm'), false, 'r');
                exit;
            }

            if ($form->isValid()) {

                $data = $form->getData();
                $groups = $data['groups'];

                $data['data'] = serialize($data);
                unset($data['groups']);
                $data['field_name'] = 'field_' . $data['field_name'];
                if ($this->db->get_where('content_fields', ['field_name' => $data['field_name']])->num_rows() > 0) {
                    showMessage(lang('Select another  name', 'cfcm'), false, 'r');
                } else {
                    // Set field weight.
                    $this->db->select_max('weight');
                    $query = $this->db->get('content_fields')->row();
                    $data['weight'] = $query->weight + 1;

                    $this->db->insert('content_fields', $data);

                    //write relations
                    $toInsert = [];
                    if (count($groups)) {
                        foreach ($groups as $group) {
                            $toInsert[] = [
                                           'field_name' => $data['field_name'],
                                           'group_id'   => $group,
                                          ];
                        }

                        if (count($toInsert)) {
                            $this->db->insert_batch('content_fields_groups_relations', $toInsert);
                        }
                    }

                    $this->lib_admin->log(lang('Field created', 'cfcm') . ' - field_' . $this->input->post('field_name'));
                    showMessage(lang('Field created', 'cfcm'));

                    if ($this->input->post('action') === 'close') {
                        pjax($this->get_url());
                    } else {
                        pjax($this->get_url('edit_field/' . $data['field_name']));
                    }
                    exit;
                }
            } else {
                showMessage($form->_validation_errors(), false, 'r');
            }
        } else {
            $this->template->add_array(
                ['form' => $form]
            );

            $this->render('_form');
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get_form($name) {
        return $this->load->module('cfcm/cfcm_forms')->$name();
    }

    /**
     * @param string $segments
     * @return string
     */
    public function get_url($segments) {
        return site_url('admin/components/cp/cfcm/' . $segments);
    }

    public function create_group() {
        $form = $this->get_form('create_group_form');
        $form->action = $this->get_url('create_group');
        $form->title = lang('Creating a group', 'cfcm');
        $form->type = 'group';
        if ($this->input->post()) {
            if (!$this->input->post('name')) {
                showMessage(lang('Specify the group name', 'cfcm'), false, 'r');
                exit;
            }

            if ($form->isValid()) {
                $this->db->insert('content_field_groups', $form->getData());

                $last_field_id = $this->db->order_by('id', 'desc')->get('content_field_groups')->row()->id;
                $this->lib_admin->log(lang('Group has been created', 'cfcm') . '. Id: ' . $last_field_id);
                showMessage(lang('Group has been created', 'cfcm'));
                if ($this->input->post('action') == 'edit') {
                    pjax('/admin/components/cp/cfcm/edit_group/' . $last_field_id);
                } else {
                    pjax('/admin/components/cp/cfcm#fields_groups');
                }
            } else {
                showMessage($form->_validation_errors(), false, 'r');
            }
            exit;
        }

        $this->template->add_array(
            ['form' => $form]
        );

        $this->render('_form');
    }

    /**
     * @param string $field_name
     */
    public function delete_field($field_name) {
        $field_name = urldecode($field_name);

        $this->db->where('field_name', $field_name)
            ->delete('content_fields');

        $this->db->where('field_name', $field_name)
            ->delete('content_fields_data');

        $this->db->where('field_name', $field_name)
            ->delete('content_fields_groups_relations');

        $this->lib_admin->log(lang('Field deleted successfuly', 'cfcm') . ' - ' . $field_name);
        showMessage(lang('Field deleted successfuly', 'cfcm'));
        pjax($this->get_url('index'));
    }

    /**
     * @param int $id
     */
    public function delete_group($id) {
        //todo: delete group
        $this->db->where('id', $id)
            ->delete('content_field_groups');

        $this->db->where('group_id', $id)
            ->update('content_fields_groups_relations', ['group_id' => '0']);

        $this->db->where('field_group', $id)
            ->update('category', ['field_group' => '-1']);

        $this->db->where('category_field_group', $id)
            ->update('category', ['category_field_group' => '-1']);

        $this->lib_admin->log(lang('Group deleted successfuly', 'cfcm') . '. Id: ' . $id);
        showMessage(lang('Group deleted successfuly', 'cfcm'));
        pjax('/admin/components/cp/cfcm#fields_groups');
    }

    /**
     * @param string $name
     */
    public function edit_field($name = '') {
        $name = urldecode($name);
        $this->db->limit(1);
        $field = $this->db->get_where('content_fields', ['field_name' => (string) $name]);

        if ($field->num_rows() == 1) {
            $field = $field->row();
            $field_data = unserialize($field->data);

            $form = $this->load->module('cfcm/cfcm_forms')->edit_field($this->input->post('type')?:$field->type);

            $form->title = lang('Field editing', 'cfcm') . ': ' . $field->label;
            $form->action = $this->get_url('edit_field/' . $name);

            $form->setAttributes($field_data);

            $form->validation->setInitial(str_replace('required|', '', $field_data['validation']));

            if ($this->input->post()) {
                $data = $form->getData();

                if (isset($data['required'])) {
                    $data['validation'] = 'required|' . $data['validation'];
                }
                unset($data['validation_required']);

                /** Проверка на наличие сетнутых пунктов изображений и файлов*/
                if ($data['type'] == 'textarea') {

                    if (($data['enable_image_browser'] || $data['enable_file_browser']) || ($data['enable_image_browser'] && $data['enable_file_browser'])) {
                        $data['type'] = 'text';

                    }
                }

                $this->db->where('field_name', $field->field_name);
                $this->db->update(
                    'content_fields',
                    [
                     'data'  => serialize($data),
                     'type'  => $data['type'],
                     'label' => $data['label'],
                    ]
                );

                $groups = $data['groups'];
                $data['field_name'] = end($this->uri->segment_array());

                $this->db->delete('content_fields_groups_relations', ['field_name' => $data['field_name']]);
                if (count($groups)) {
                    foreach ($groups as $group) {
                        $toInsert[] = [
                                       'field_name' => $data['field_name'],
                                       'group_id'   => $group,
                                      ];
                    }

                    $this->db->insert_batch('content_fields_groups_relations', $toInsert);
                }

                $this->lib_admin->log(lang('Field has been updated', 'cfcm') . ' - ' . $name);
                showMessage(lang('Field has been updated', 'cfcm'));

                if ($this->input->post('action') == 'close') {
                    pjax('/admin/components/cp/cfcm/index#additional_fields');
                }
            } else {
                $modulePath = getModulePath('cfcm');
                $this->template->registerJsFile($modulePath . 'templates/scripts/admin.js', 'after');
                $this->template->add_array(
                    ['form' => $form]
                );

                $this->render('_form');
            }
        } else {

            echo lang('Field has not been found', 'cfcm');
        }
    }

    /**
     * @param string $field_name
     */
    public function edit_field_data_type($field_name) {
        $form = $this->get_form('create_field');
        $form->action = $this->get_url('edit_field_data_type/' . $field_name);
        $form->title = lang('Field editing', 'cfcm');

        $field = $this->db->get_where('content_fields', ['field_name' => $field_name])->row_array();

        if ($this->input->post()) {
            $_POST['field_name'] = $field['field_name'];

            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['field_name']);

                if (!$data['in_search']) {
                    $data['in_search'] = 0;
                }

                $this->db->limit(1);
                $this->db->where('field_name', $field_name);
                $this->db->update('content_fields', $data);

                showMessage(lang('Field has been updated', 'cfcm'));
                pjax($this->get_url('index'));
                exit;
            } else {
                showMessage($form->_validation_errors(), false, 'r');
                exit;
            }
            exit;
        }

        $form->setAttributes($field);
        $form->field_name->field->attributes = 'disabled="disabled"';

        $this->template->add_array(
            ['form' => $form]
        );

        $this->render('_form');
    }

    /**
     * @param int $id
     */
    public function edit_group($id) {
        $id = (int) $id;

        $group = $this->db->get_where('content_field_groups', ['id' => $id]);

        if ($group->num_rows() == 1) {
            $group = $group->row_array();
        } else {
            showMessage(lang('Group has not been found', 'cfcm'), false, 'r');
            exit;
        }

        $form = $this->get_form('create_group_form');
        $form->action = $this->get_url('edit_group/' . $id);
        $form->title = lang('ID group editing', 'cfcm') . $group['id'];
        $form->type = 'group';
        if ($this->input->post()) {
            if ($form->isValid()) {
                $data = $form->getData();

                $this->db->limit(1);
                $this->db->where('id', $id);
                $this->db->update('content_field_groups', $data);

                $this->lib_admin->log(lang('Group has been updated', 'cfcm') . '. Id: ' . $id);

                showMessage(lang('Group has been updated', 'cfcm'));
                if ('close' === $this->input->post('action')) {
                    pjax($this->get_url('index#fields_groups'));
                } else {
                    pjax($this->get_url('edit_group/' . $id));
                }
                exit;
            } else {
                showMessage($form->_validation_errors(), false, 'r');
                exit;
            }
        }

        $form->setAttributes($group);

        $this->template->add_array(
            ['form' => $form]
        );

        $this->render('_form');
    }

    /**
     * Create form from category field group
     * on add/edit page tpl.
     * @param bool|false|int $category_id
     * @param bool|false|int $item_id
     * @param bool|false|int $item_type
     */
    public function form_from_category_group($category_id = FALSE, $item_id = FALSE, $item_type = FALSE) {
        $this->cfcm->get_form($category_id, $item_id, $item_type);
    }

    /**
     * @param null|string $type
     */
    public function getFormFields($type = NULL) {
        if ($type) {

            $form = $this->load->module('cfcm/cfcm_forms')->edit_field($type);

            $findType = FALSE;
            $fieldsData = [];
            foreach ($form->fields as $key => $field) {

                if ($findType && $key != 'validation') {
                    $fieldsData[$key] = $field;
                }

                if ($key == 'type') {
                    $findType = TRUE;
                }

                if ($key == 'validation') {
                    break;
                }
            }

            return $this->render('one_type_field', ['fields' => $fieldsData], TRUE);
        }
    }

    /**
     * @param array $fields
     * @param integer $item_id
     * @param string|boolean $item_type
     * @return array|bool
     */
    public function get_form_attributes(array $fields, $item_id, $item_type) {
        return $this->cfcm->get_form_attributes($fields, $item_id, $item_type);
    }

    public function index() {
        $this->template->add_array(
            [
             'fields'    => $this->db->order_by('weight', 'ASC')->get('content_fields')->result_array(),
             'groups'    => $this->load->module('cfcm/cfcm_forms')->prepare_groups_select(),
             'groupRels' => $this->db
                 ->select('*')
                 ->join('content_field_groups', 'content_field_groups.id = content_fields_groups_relations.group_id OR content_fields_groups_relations.group_id = -1')
                 ->order_by('content_field_groups.id')
                 ->get('content_fields_groups_relations')
                 ->result_array(),
            ]
        );

        $groups = $this->db->get('content_field_groups');

        if ($groups->num_rows() > 0) {
            $this->template->assign('groups', $groups->result_array());
        } else {
            $this->template->assign('groups', false);
        }
        $this->render('index');
    }

    /**
     * render template
     * @param string $viewName
     * @param array $data
     */
    public function render($viewName, array $data = []) {
        if (!empty($data)) {
            $this->template->add_array($data);
        }

        if ($this->ajaxRequest) {
            echo $this->template->fetch('file:' . realpath(__DIR__) . '/templates/admin/' . $viewName);
        } else {
            $this->template->show('file:' . realpath(__DIR__) . '/templates/admin/' . $viewName);
        }
        exit;
    }

    public function save_weight() {
        if (count($this->input->post('fields_names')) > 0) {
            foreach ($this->input->post('fields_names') as $k => $v) {
                $name = (string) substr($v, 5);
                $weight = (int) $this->input->post('fields_pos')[$k];

                $this->db->where('field_name', $name);
                $this->db->update('content_fields', ['weight' => $weight]);
            }
        }
    }

}
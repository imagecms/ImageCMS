<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sys_update extends BaseAdminController
{

    /**
     * instance of Update library
     * @var Update
     */
    private $update;

    /**
     * Sys_update constructor.
     */
    public function __construct() {

        if (!extension_loaded('soap')) {
            showMessage(lang('PHP SOAP extension is not installed'), '', 'r');
            pjax('/admin');
        }
        parent::__construct();
        $this->update = new Update();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
        ini_set('soap.wsdl_cache_enabled', '0');
    }

    /**
     *
     */
    public function index() {

        if (!file_exists('md5.txt')) {
            write_file('md5.txt', json_encode($this->update->parse_md5()));
        }
        try {
            $array = $this->update->getStatus();

        } catch (Exception $e) {

            $error = $e->getMessage();
            $this->lib_admin->log($error);
        }

        $error = $error ?: null;

        if ($array) {
            $data = [
                     'build'     => $array['build_id'],
                     'date'      => date('Y-m-d', $array['time']),
                     'size'      => number_format($array['size'] / 1024 / 1024, 3),
                     'newRelise' => TRUE,
                    ];
        } else {
            $data = [
                     'newRelise' => FALSE,
                     'error'     => $error,
                    ];
        }

        $this->template->show('sys_update_info', FALSE, $data);
    }

    /**
     * initiate update process
     */
    public function do_update() {

        chmod(DOCUMENT_ROOT . DIRECTORY_SEPARATOR . 'backup.sql', 777);
        unlink(DOCUMENT_ROOT . DIRECTORY_SEPARATOR . 'backup.sql');

        set_time_limit(99999999999999);

        try {
            $this->update->createBackUp();
            $this->update->getUpdate();
            $this->cache->delete_all();
            $this->update->restoreFromZIP(BACKUPFOLDER . 'updates.zip');

            chmod($this->input->server('DOCUMENT_ROOT'), 0777);
            unlink(BACKUPFOLDER . 'updates.zip');

        } catch (Exception $e) {

            $this->lib_admin->log($e->getMessage());
            echo $e->getMessage();
        }

    }

    /**
     * @param string $sort_by
     * @param string $order
     */
    public function update($sort_by = 'create_date', $order = 'asc') {
        $this->load->library('pagination');

        // Show upgrade window;
        try {

            $status = $this->update->getStatus();
            $result = $this->update->getHashSum();

        } catch (Exception $e) {

            $result['error'] = $e->getMessage();
            $this->lib_admin->log($result['error']);
        }
        // Create pagination
        $filesCount = count($result);
        $config['base_url'] = '/admin/sys_update/update?';
        $config['page_query_string'] = true;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $filesCount;
        $config['per_page'] = 25;
        $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
        $config['controls_tag_close'] = '</ul></div>';
        $config['next_link'] = lang('Next', 'admin') . '&nbsp;&gt;';
        $config['prev_link'] = '&lt;&nbsp;' . lang('Prev', 'admin');
        $config['cur_tag_open'] = '<li class="btn-primary active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $result = array_chunk($result, 25, true);
        $this->pagination->initialize($config);

        $page_num = $this->input->get('per_page') >= 25 ? $this->input->get('per_page') / 25 : 0;
        if (!$result[0]['error']) {
            $data = [
                     'paginator'        => $this->pagination->create_links_ajax(),
                     'filesCount'       => $filesCount,
                     'sort_by'          => $sort_by,
                     'order'            => $order,
                     'diff_files_dates' => $this->update->get_files_dates(),
                     'diff_files'       => $result[$page_num],
                     'restore_files'    => $this->sort($this->update->restore_files_list(), $sort_by, $order),
                     'new_version'      => $status ? TRUE : FALSE,
                    ];
        } else {
            $data = [
                     'restore_files' => $this->sort($this->update->restore_files_list(), $sort_by, $order),
                     'error'         => $result[0]['error'],
                    ];
        }
        $this->template->show('sys_update', FALSE, $data);
    }

    /**
     * @return void
     */
    public function restore() {

        try {
            echo $this->update->restoreFromZIP($this->input->post('file_name'));
        } catch (Exception $e) {
            $error = $e->getMessage();
            $this->lib_admin->log($error);
        }

    }

    /**
     * @return void
     */
    public function renderFile() {

        $file_path = $this->input->post('file_path');
        if (file_exists('.' . $file_path)) {
            echo htmlspecialchars(file_get_contents('.' . $file_path));
        } else {
            echo '';
        }
    }

    /**
     * @return void
     */
    public function properties() {

        if ($this->input->post()) {
            $this->form_validation->set_rules('careKey', lang('careKey must required', 'admin'), 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {

                $this->update->setSettings(['careKey' => trim($this->input->post('careKey'))]);
                showMessage(lang('Changes saved', 'admin'));
            }
        } else {
            $data = [
                     'careKey' => $this->update->getSettings('careKey'),
                    ];
            $this->template->show('sys_update_properties', FALSE, $data);
        }
    }

    /**
     * @return void
     */
    public function get_license() {

        if (false === $shopPath = getModulePath('shop')) {
            echo 0;
            return;
        }
        $licenseFile = $shopPath . 'license.key';
        if (!file_exists($licenseFile)) {
            echo 0;
            return;
        }
        echo file_get_contents($licenseFile);
    }

    /**
     * @return void
     */
    public function backup() {

        try {
            $this->update->createBackUp();

        } catch (Exception $e) {

            $this->lib_admin->log($e->getMessage());
            echo $e->getMessage();
        }

    }

    /**
     * @param array $array
     * @param string $sort_by
     * @param string $order
     * @return array
     */
    public function sort($array, $sort_by, $order) {

        $arrayCount = count($array);
        for ($i = 0; $i < $arrayCount; $i++) {
            for ($y = ($i + 1); $y < $arrayCount; $y++) {
                if ($order == 'asc') {
                    if ($array[$i][$sort_by] < $array[$y][$sort_by]) {
                        $c = $array[$i];
                        $array[$i] = $array[$y];
                        $array[$y] = $c;
                    }
                } else {
                    if ($array[$i][$sort_by] > $array[$y][$sort_by]) {
                        $c = $array[$i];
                        $array[$i] = $array[$y];
                        $array[$y] = $c;
                    }
                }
            }
        }
        return $array;
    }

    public function delete_backup($file_name) {

        echo unlink(BACKUPFOLDER . $file_name);
    }

    /**
     * @param string $file
     */
    public function getQuerys($file = 'backup.sql') {

        $restore = file_get_contents($file);

        $string_query = rtrim($restore, "\n;");
        $array_query = explode(";\n", $string_query);

        echo json_encode($array_query);
    }

    /**
     * @return bool
     */
    public function Querys() {

        foreach ($this->input->post('data') as $query) {
            if ($query) {
                if (!$this->db->query($query)) {
                    echo 'Невозможно выполнить запрос: <br>';
                    return FALSE;
                }
            }
        }
        echo $this->db->total_queries();
    }

}
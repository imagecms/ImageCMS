<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Backup Class
 *
 */
class Backup extends BaseAdminController {

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();

        //cp_check_perm('backup_create');
    }

    public function save_settings() {
        $backup = \libraries\Backup::create();

        $settings = [
            'backup_del_status' => isset($_POST['backup_del_status']) ? $_POST['backup_del_status'] : 0,
            'backup_term' => isset($_POST['backup_term']) ? $_POST['backup_term'] : 6,
            'backup_maxsize' => isset($_POST['backup_maxsize']) ? $_POST['backup_maxsize'] : 1000,
        ];

        $bad = [];
        foreach ($settings as $key => $value) {
            if (false == $backup->setSetting($key, $value)) {
                $bad[] = $key;
            }
        }

        if (count($bad) > 0) {
            showMessage(lang('Some of settings not saved', 'admin'), 'Error', 'r');
        } else {
            showMessage(lang('Settings saved', 'admin'));
        }
    }

    public function file_actions() {
        $file = trim($_POST['file']);
        $locked = isset($_POST['locked']) ? $_POST['locked'] : null;
        switch ($_POST['action']) {
            case "backup_lock":
                $this->filesLocking($file, $locked);
                $dataTitle = $locked ? lang('unlock', 'admin') : lang('lock', 'admin');
                echo json_encode(['locked' => $locked, 'dataTitle' => lang($dataTitle, 'admin')]);
                break;
            case "backup_delete":
                $bool = \libraries\Backup::create()->deleteFile($file);
                echo json_encode(['deleted' => $bool ? "deleted" : "error"]);
                break;
        }
    }

    public function download_file() {
        echo "file";
    }

    protected function filesLocking($file, $locked) {
        $backup = \libraries\Backup::create();
        $lockedFiles = $backup->getSetting('lockedFiles');
        if (!is_array($lockedFiles)) {
            $lockedFiles = [];
        }
        if (in_array($file, $lockedFiles) && (int) $locked == 0) {
            foreach ($lockedFiles as $key => $file_) {
                if ($file == $file_) {
                    unset($lockedFiles[$key]);
                }
            }
        } else {
            $lockedFiles[] = $file;
        }
        $backup->setSetting('lockedFiles', $lockedFiles);
    }

    public function index() {
        $backup = \libraries\Backup::create();

        $del_status = $backup->getSetting('backup_del_status');
        $maxSize = $backup->getSetting('backup_maxsize');
        $term = $backup->getSetting('backup_term');

        $files = $backup->backupFiles();

        $this->template->add_array(
            [
                    'user' => $this->get_admin_info(),
                    'backup_del_status' => $del_status == null ? 0 : $del_status,
                    'backup_term' => $term == null ? 6 : $term,
                    'backup_maxsize' => $maxSize == null ? 1000 : $maxSize,
                    'files' => $files
                ]
        );

        $this->template->show('backup', false);
    }

    // Create backup file

    public function create() {
        if (!file_exists(BACKUPFOLDER)) {
            mkdir(BACKUPFOLDER);
            chmod(BACKUPFOLDER, 0777);
        }

        if (!is_really_writable(BACKUPFOLDER)) {
            showMessage(langf('Directory |0| has no writing permission', 'admin', [BACKUPFOLDER]), false, 'r');
            exit;
        }
        switch ($_POST['save_type']) {
            case 'local':
                return jsCode("window.location = '" . site_url('admin/backup/force_download/' . $_POST['file_type']) . "'");

            case 'server':
                $this->load->helper('file');

                $backup = \libraries\Backup::create();
                $deleteOld = $backup->getSetting('backup_del_status');
                if ($deleteOld == 1) {
                    $deleteData = $backup->deleteOldFiles();
                } else {
                    $deleteData = null;
                }
                if (FALSE !== $backup->createBackup($_POST['file_type'])) {
                    $message = lang('Backup copying has been completed', 'admin');
                    if (is_array($deleteData)) {
                        $mb = number_format($deleteData['size'] / 1024 / 1024, 2);
                        $message .= "<br /> Deleted {$deleteData['count']} files on {$mb} Mb";
                    }
                    showMessage($message);
                }
                break;

            case 'email':
                $this->send_to_email();
                break;
        }
        pjax('/admin/backup');
    }

    private function send_to_email() {
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper('file');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run($this) == false) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $user = $this->get_admin_info();

            $fileName = \libraries\Backup::create()->createBackup($_POST['file_type'], "sql");

            $this->email->to($_POST['email']);
            $this->email->from($user['email']);
            $this->email->subject(lang("Backup copying", "admin") . date('d-m-Y H:i:s'));
            $this->email->message(' ');
            $this->email->attach($fileName);
            $this->email->send();

            @unlink($fileName);

            $this->done();
        }
        pjax('/admin/backup');
    }

    // Direct download

    public function force_download($file_type) {
        $this->load->helper('download');
        $fileName = \libraries\Backup::create()->createBackup($file_type, "sql");
        $fileContents = file_get_contents($fileName);
        force_download(pathinfo($fileName, PATHINFO_BASENAME), $fileContents);
    }

    private function done() {
        showMessage(lang("Backup copying has been completed", "admin"));
    }

    private function get_admin_info() {
        return $this->db->get_where('users', ['id' => $this->dx_auth->get_user_id()])->row_array();
    }

}
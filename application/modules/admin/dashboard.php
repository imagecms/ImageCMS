<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends BaseAdminController {

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();

       // $this->lang->load_gettext('ru','utf-8', 'default', 'application/language/admiin');
        //$this->lang->load_gettext('en','utf-8', 'messages', 'application/language');
        //$this->lang->load_gettext('en','utf-8', 'newdomen', 'application/language');
    }

    public function index() {
        // get latest pages
        $this->db->limit(5);
        $this->db->order_by('created', 'DESC');
        $this->db->where('lang_alias', 0);
        $latest = $this->db->get('content')->result_array();

        // get recenly updated pages
        $this->db->limit(5);
        $this->db->order_by('updated', 'DESC');
        $this->db->where('updated >', 0);
        $this->db->where('lang_alias', 0);
        $updated = $this->db->get('content')->result_array();

        // get comments
        if ($this->db->get_where('components', array('name' => 'comments'))->row()) {
            $comments = $this->db->where('status', '0')
                    ->or_where('status', '1')
                    ->order_by('date', 'DESC')
                    ->get('comments')
                    ->result_array();
            $total_comments = count($comments);
            $comments = array_slice($comments, 0, 5);
        } else {
            $total_comments = 0;
        }

        // total pages
        $this->db->where('post_status', 'publish');
        $this->db->from('content');
        $total_pages = $this->db->count_all_results();

        // total categories
        $this->db->from('category');
        $total_cats = $this->db->count_all_results();

        $this->template->add_array(array(
            'latest' => $latest,
            'updated' => $updated,
            'comments' => $comments,
            'total_cats' => $total_cats,
            'total_pages' => $total_pages,
            'total_comments' => $total_comments,
        ));

        // If we are online - load system news.
        $s_ip = substr($_SERVER['SERVER_ADDR'], 0, strrpos($_SERVER['SERVER_ADDR'], '.'));

        switch ($s_ip) {
            case '127.0.0':
            case '127.0.1':
            case '10.0.0':
            case '172.16.0':
            case '192.168.0':
                $on_local = TRUE;
                break;
        }

        if (($api_news = $this->cache->fetch('api_news_cache')) !== FALSE) {
            $this->template->assign('api_news', $api_news);
        } else {
            if ($on_local !== TRUE) {
                $this->config->load('api');

                $api_news = $this->_curl_post($this->config->item('imagecms_latest_news'), array('for' => IMAGECMS_NUMBER));

                if (count(unserialize($api_news['result'])) > 1 AND $api_news['code'] == '200') {
                    $this->template->assign('api_news', unserialize($api_news['result']));
                    $this->cache->store('api_news_cache', unserialize($api_news['result']));
                } else {
                    $this->cache->store('api_news_cache', 'false');
                }
            }
        }

        // Get system upgrade info
//        $this->load->module('admin/sys_upgrade');

//        $status = $this->sys_upgrade->_check_status();

        // Get next version number
        $next_v = explode('_', $status['upgrade_file']);

        if (isset($next_v[2])) {
            $this->template->assign('next_v', str_replace('.zip', '', $next_v[2]));
        }

        $this->template->add_array(array(
            'cms_number' => IMAGECMS_NUMBER,
            'sys_status' => $status,
        ));

        \CMSFactory\Events::create()->registerEvent('', 'Dashboard:show');
        \CMSFactory\Events::runFactory();

        $this->template->show('dashboard', FALSE);
    }

    private function _curl_post($url = '', $data = array()) {
        $options = array();
        $options[CURLOPT_HEADER] = FALSE;
        $options[CURLOPT_RETURNTRANSFER] = TRUE;
        $options[CURLOPT_POST] = FALSE;
        $options[CURLOPT_POSTFIELDS] = $data;
        $options[CURLOPT_REFERER] = base_url();

        $handler = curl_init($url);

        curl_setopt_array($handler, $options);
        $resp = curl_exec($handler);

        $result['code'] = curl_getinfo($handler, CURLINFO_HTTP_CODE);
        $result['result'] = $resp;
        $result['error'] = curl_errno($handler);

        curl_close($handler);
        return $result;
    }

}

/* End of dashboard.php */

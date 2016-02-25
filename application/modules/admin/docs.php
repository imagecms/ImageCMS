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
class Docs extends BaseAdminController
{

    protected $jsonListFile;

    protected $docsPath;

    public function __construct() {
        parent::__construct();
        $this->docsPath = PUBPATH . 'manual/';
        $this->jsonListFile = $this->docsPath . 'list.json';

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
    }

    public function show($pageName) {
        $page = file_get_contents($this->docsPath . "$pageName.html");
        $this->template->add_array(['page' => $page, 'd_b' => true, 'active_docs_page' => $pageName]);
        $this->template->show('docs', TRUE);
    }

    public function getPages() {
        $pages = (array) json_decode(file_get_contents($this->jsonListFile));
        foreach ($pages as $key => $page) {
            $pages[$key]->full_url = site_url('admin/docs/show/' . $page->full_url);
        }
        return $pages;
    }

    private function exportData() {
        $dsn = 'mysqli://root:root@localhost/premmerce';
        $db = $this->load->database($dsn,true);

        $result = $db->select(['title', 'url', 'full_text'])
            ->where(['lang' => '3', 'category' => 92, 'post_status' => 'publish'])
            ->order_by('position')
            ->get('content')->result_array();
//        dd($result);

        $jsonsDataArray = [];
        foreach ($result as $pageFromDatabase) {
            $jsonsDataArray[] = ['full_url' => $pageFromDatabase['url'], 'title' => $pageFromDatabase['title']];

            $pageTitle = '<div class="title-default-main"><div class="title">'
                    . $pageFromDatabase['title'] . '</div></div>';

            $pageFromDatabase['full_text'] = str_replace('/academy/start-s-nyla/filling-store', '/admin/docs/show', $pageFromDatabase['full_text']);
            $cont = $pageTitle . $pageFromDatabase['full_text'];
            $path = $this->docsPath . $pageFromDatabase['url'] . '.html';

            echo nl2br($path . "\n");
            $pageFromDatabase = file_put_contents($path, $cont);
        }
        file_put_contents($this->jsonListFile, json_encode($jsonsDataArray));
    }

}
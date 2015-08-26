<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 * @property Similar_Posts similar_library
 */
class Core_Widgets extends MY_Controller {

    private $defaults = array(
        'news_count' => 10,
        'max_symdols' => 150,
        'display' => 'recent' //possible values: recent/popular
    );

    public function __construct() {
        parent::__construct();
        $obj = new MY_Lang();
        $obj->load('core');
    }

    // Display recent or popular news

    public function recent_news($widget = array()) {
        if ($widget['settings'] == FALSE) {
            $settings = $this->defaults;
        } else {
            $settings = $widget['settings'];
        }

        $this->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url, content.id, content.title, prev_text, publish_date, showed, comments_count, author, category.name as cat_name, content.cat_url', FALSE);
        $this->db->join('category', 'category.id=content.category');
        $this->db->where('post_status', 'publish');
        $this->db->where('prev_text !=', 'null');
        $this->db->where('publish_date <=', time());
        $this->db->where('lang', $this->config->item('cur_lang'));

        if (count($settings['categories']) > 0) {
            $this->db->where_in('category', $settings['categories']);
        }

        if ($settings['display'] == 'recent') {
            $this->db->order_by('publish_date', 'desc'); // Recent news
        } elseif ($settings['display'] == 'popular') {
            $this->db->order_by('showed', 'desc'); // Pupular news
        }

        $query = $this->db->get('content', $settings['news_count']);

        if ($query->num_rows() > 0) {
            $news = $query->result_array();

            $cnt = count($news);
            for ($i = 0; $i < $cnt; $i++) {
                $news[$i]['prev_text'] = htmlspecialchars_decode($news[$i]['prev_text']);

                // Truncate text
                if ($settings['max_symdols'] > 0 AND mb_strlen($news[$i]['prev_text'], 'utf-8') > $settings['max_symdols']) {
                    $news[$i]['prev_text'] = strip_tags(mb_substr($news[$i]['prev_text'], 0, $settings['max_symdols'], 'utf-8')) . '...';
                }
            }

            $data['recent_news'] = $news;

            return $this->template->fetch('widgets/' . $widget['name'], $data);
            //return $this->fetch_tpl('recent_news', $data);
        } else {
            return '';
        }
    }

    // Configure form

    public function recent_news_configure($action = 'show_settings', $widget_data = array()) {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }

        switch ($action) {
            case 'show_settings':
                $this->load->library('lib_category');
                $cats = $this->lib_category->build();

                //$this->display_tpl('recent_news_form', array('widget' => $widget_data, 'cats' => $cats));
                $this->render('recent_news_form', array('widget' => $widget_data, 'cats' => $cats));
                break;

            case 'update_settings':
                $this->form_validation->set_rules('news_count', lang("Amount of news", "core"), 'trim|required|is_natural_no_zero|min_length[1]');
                $this->form_validation->set_rules('max_symdols', lang("Maximum number of characters", "core"), 'trim|required|is_natural|min_length[1]');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors());
                } else {
                    $data = array(
                        'news_count' => $this->input->post('news_count'),
                        'max_symdols' => $this->input->post('max_symdols'),
                        'categories' => $this->input->post('categories'),
                        'display' => $this->input->post('display'),
                    );

                    $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);

                    showMessage(lang("Settings have been saved", 'core'));

                    if ($this->input->post('action') == 'tomain') {
                        pjax('/admin/widgets_manager/index');
                    }
                }
                break;

            case 'install_defaults':
                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $this->defaults);
                break;
        }
    }

    public function similar_posts_configure($action = 'show_settings', $widget_data = array()) {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }
        $this->load->library('similar_posts', null, 'similar_library');

        switch ($action) {
            case 'show_settings':
                $this->load->library('lib_category');
                $cats = $this->lib_category->build();

                $this->render('similar_posts_form', array('widget' => $widget_data, 'cats' => $cats));
                break;

            case 'update_settings':
                $settings = $this->input->post('settings');

                $this->form_validation->set_rules('settings[limit]', lang("Similar pages limit", "core"), 'trim');
                $this->form_validation->set_rules('settings[max_short_description_words]', lang("Maximum short description words count", "core"), 'trim');

                if (!$this->form_validation->run($this)) {
                    showMessage(validation_errors(), '', 'r');
                    exit;
                } else {
                    $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $settings);

                    showMessage(lang("Settings have been saved", 'core'));

                    if ($this->input->post('action') == 'tomain') {
                        pjax('/admin/widgets_manager/index');
                    }
                }
                break;

            case 'install_defaults':
                $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $this->similar_library->getDefaultSettings());
                break;
        }
    }

    // Similar posts

    /**
     * @param array $widget
     * @return mixed|string
     */
    public function similar_posts($widget = array()) {
        $this->load->library('similar_posts', null, 'similar_library');

        $this->load->module('core');
        if ($this->core->core_data['data_type'] == 'page') {
            $title = $this->core->page_content['title'];
            $similarPages = $this->similar_library->find($this->core->page_content['id'], $title, $widget['settings']);

            $data = array(
                'pages' => $similarPages ? $similarPages : [],
            );
            return $this->template->fetch('widgets/' . $widget['name'], $data);
        }
    }

    // Template functions

    public function display_tpl($file, $vars = array()) {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    public function fetch_tpl($file, $vars = array()) {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

    public function render($viewName, array $data = array()) {
        if (!empty($data)) {
            $this->template->add_array($data);
        }
        $this->template->show('file:' . APPPATH . getModContDirName('core') . '/core/templates/' . $viewName);
    }

}
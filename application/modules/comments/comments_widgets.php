<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Comments widgets
 */
class Comments_Widgets extends MY_Controller
{

    /**
     * @var array
     */
    private $defaults = [
                         'comments_count' => 100,
                         'symbols_count'  => 0,
                        ];

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('comments');
    }

    /**
     * Get and display recent comments
     * @param array $widget
     * @return string
     */
    public function recent_comments(array $widget = []) {
        if ($widget['settings'] === FALSE) {
            $settings = $this->defaults;
        } else {
            $settings = $widget['settings'];
        }

        $this->db->select('comments.*');
        $this->db->select("IF(route.parent_url <> '', concat(route.parent_url, '/', route.url), route.url) as url", FALSE); // page full url
        $this->db->where('content.lang', $this->config->item('cur_lang'));
        $this->db->where('comments.module', 'core');
        $this->db->where('comments.status', 0);
        $this->db->join('content', 'content.id = comments.item_id', 'left');
        $this->db->join('route', 'content.id = route.entity_id', 'left');
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('comments', $settings['comments_count']);

        if ($query->num_rows() > 0) {
            $comments = $query->result_array();

            if ($settings['symbols_count'] > 0) {
                $cnt = count($comments);
                for ($i = 0; $i < $cnt; $i++) {
                    if (mb_strlen($comments[$i]['text'], 'utf-8') > $settings['symbols_count']) {
                        $comments[$i]['text'] = mb_substr($comments[$i]['text'], 0, $settings['symbols_count'], 'utf-8') . '...';
                    }
                }
            }

            return $this->template->fetch('widgets/' . $widget['name'], ['comments' => $comments]);
        }
    }

    /**
     * @param string $viewName
     * @param array $data
     */
    public function render($viewName, array $data = []) {
        if (!empty($data)) {
            $this->template->add_array($data);
        }

        $this->template->show('file:application/' . getModContDirName('comments') . '/comments/templates/' . $viewName);
    }

    /**
     * Configure widget settings
     * @param string $action
     * @param array $widget_data
     */
    public function recent_comments_configure($action = 'show_settings', array $widget_data = []) {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit; // Only admin access
        }
        switch ($action) {
            case 'show_settings':
                assetManager::create()->setData('widget', $widget_data)->renderAdmin('recent_comments_form');
                break;

            case 'update_settings':
                $this->form_validation->set_rules('comments_count', lang('Number of comments', 'comments'), 'trim|required|is_natural_no_zero|min_length[1]');
                $this->form_validation->set_rules('symbols_count', lang('Number of characters', 'comments'), 'required|trim|is_natural');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors());
                } else {
                    $data = [
                             'comments_count' => $this->input->post('comments_count'),
                             'symbols_count'  => $this->input->post('symbols_count'),
                            ];

                    $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
                    showMessage(lang('Settings have been saved', 'comments'));
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

    /**
     * Get and display recent product comments
     * @param array $widget
     * @return string
     */
    public function recent_product_comments(array $widget = []) {
        if ($widget['settings'] === FALSE) {
            $settings = $this->defaults;
        } else {
            $settings = $widget['settings'];
        }

        $this->db->select('comments.*');
        $this->db->select("IF(route.parent_url <> '', concat(route.parent_url, '/', route.url), route.url) as url", FALSE); // page full url
        $this->db->where('comments.module', 'shop');
        $this->db->where('comments.status', 0);
        $this->db->join('content', 'content.id = comments.item_id', 'left');
        $this->db->join('route', 'content.id = route.entity_id', 'left');
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('comments', $settings['comments_count']);

        if ($query->num_rows() > 0) {
            $comments = $query->result_array();

            if ($settings['symbols_count'] > 0) {
                $cnt = count($comments);
                for ($i = 0; $i < $cnt; $i++) {
                    if (mb_strlen($comments[$i]['text'], 'utf-8') > $settings['symbols_count']) {
                        $comments[$i]['text'] = mb_substr($comments[$i]['text'], 0, $settings['symbols_count'], 'utf-8') . '...';
                    }
                }
            }

            /** Перебор комментариев, и подставка url продукта */
            foreach ($comments as $key => $comment) {

                $url = SProductsQuery::create()
                    ->findOneById($comment['item_id']);

                $comments[$key]['product_url'] = $url ? $url->getUrl() : $url;

            }

            return $this->template->fetch('widgets/' . $widget['name'], ['comments' => $comments]);
        }
    }

    /**
     * Configure widget settings
     * @param string $action
     * @param array $widget_data
     */
    public function recent_product_comments_configure($action = 'show_settings', array $widget_data = []) {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit; // Only admin access
        }
        switch ($action) {
            case 'show_settings':
                assetManager::create()->setData('widget', $widget_data)->renderAdmin('recent_product_comments_form');
                break;

            case 'update_settings':
                $this->form_validation->set_rules('comments_count', lang('Number of responses'), 'trim|required|is_natural_no_zero|min_length[1]');
                $this->form_validation->set_rules('symbols_count', lang('Number of characters'), 'required|trim|is_natural');

                if ($this->form_validation->run($this) == FALSE) {
                    showMessage(validation_errors());
                } else {
                    $data = [
                             'comments_count' => $this->input->post('comments_count'),
                             'symbols_count'  => $this->input->post('symbols_count'),
                            ];

                    $this->load->module('admin/widgets_manager')->update_config($widget_data['id'], $data);
                    showMessage(lang('Settings have been saved', 'comments'));
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

}
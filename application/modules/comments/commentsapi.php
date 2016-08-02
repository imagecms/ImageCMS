<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Commentsapi extends Comments
{

    public $validation_errors;

    /**
     * @var string $comments_locale
     */
    private $comments_locale;

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
        $this->module = $this->getModule($this->input->server('HTTP_REFERER'));
        $lang = new MY_Lang();
        $lang->load('comments');

        $this->tpl_name = 'comments_api';
    }

    /**
     * New comments realization
     * @param string $url
     * @return array comments
     */
    public function getComments($url) {
        $this->load->model('base');
        $this->_init_settings();
        $this->module = $this->getModule($url);
        $item_id = $this->parsUrl($url);

        $comments = $this->base->get($item_id, 0, $this->module, 99999, $this->order_by);

        // Read comments template
        // Set page id for comments form
        if ($comments != FALSE) {
            $this->cache->store('comments_' . $item_id . $this->module, $comments, $this->cache_ttl, 'comments');
        }

        $comment_ch = [];

        if (is_array($comments)) {
            $i = 0;
            foreach ($comments as $comment) {
                if ($comment['parent'] > 0) {
                    $comment_ch[] = $comment;
                    unset($comments[$i]);
                }
                $i++;
            }
        }

        $data = [
                 'comments_arr'       => $comments,
                 'comment_ch'         => $comment_ch,
                 'comment_controller' => $this->comment_controller,
                 'total_comments'     => lang('Total comments: ', 'comments') . count($comments),
                 'can_comment'        => $this->can_comment,
                 'use_captcha'        => $this->use_captcha,
                 'use_moderation'     => $this->use_moderation,
                 'enable_comments'    => $this->enable_comments,
                ];

        if ($this->use_captcha == TRUE) {
            $this->dx_auth->captcha();
            $data['cap_image'] = $this->dx_auth->get_captcha_image();
        }
        return $data;
    }

    /**
     * @param string $url
     * @return array
     */
    public function renderAsArray($url) {
        $this->load->model('base');
        $this->_init_settings();

        $this->module = $this->getModule($url);
        $item_id = $this->parsUrl($url);
        $commentsCount = $this->getTotalCommentsForProducts($item_id);

        $comments = $this->base->get($item_id, 0, $this->module, 99999, $this->order_by);

        // Read comments template
        // Set page id for comments form
        if ($comments != FALSE) {
            $this->cache->store('comments_' . $item_id . $this->module, $comments, $this->cache_ttl, 'comments');
        }

        if ($comments != null) {
            $comments_count = count($comments);
        } else {
            $comments_count = 0;
        }

        $comment_ch = [];

        if (is_array($comments)) {
            $i = 0;
            foreach ($comments as $comment) {
                if ($comment['parent'] > 0) {
                    $comment_ch[] = $comment;
                    unset($comments[$i]);
                }
                $i++;
            }
        }

        $data = [
                 'comments_arr'       => $comments,
                 'comment_ch'         => $comment_ch,
                 'comment_controller' => $this->comment_controller,
                 'total_comments'     => lang('Total comments: ', 'comments') . count($comments),
                 'can_comment'        => $this->can_comment,
                 'use_captcha'        => $this->use_captcha,
                 'use_moderation'     => $this->use_moderation,
                 'enable_comments'    => $this->enable_comments,
                ];

        if ($this->use_captcha == TRUE) {
            $this->dx_auth->captcha();
            $data['cap_image'] = $this->dx_auth->get_captcha_image();
        }
        ($hook = get_hook('comments_read_com_tpl')) ? eval($hook) : NULL;

        $comments = $this->_fetchComments($data);

        ($hook = get_hook('comments_assign_tpl_data')) ? eval($hook) : NULL;
        return [
                'comments'          => $comments,
                'commentsCount'     => $commentsCount[$item_id],
                'total_comments'    => $comments_count ? $comments_count . ' ' . SStringHelper::Pluralize($comments_count, [lang('comment', 'comments'), lang('comment', 'comments'), lang('comments', 'comments')]) : lang('Leave comment', 'comments'),
                'validation_errors' => $this->validation_errors,
               ];
    }

    public function renderPosts() {
        $this->load->model('base');
        $this->_init_settings();

        $item_id = $this->parsUrl($this->input->server('HTTP_REFERER'));

        $commentsCount = $this->getTotalCommentsForProducts($item_id);
        $comments = $this->base->get($item_id, 0, $this->module, $this->input->post('countcomment')?:null, $this->order_by);

        // Read comments template
        // Set page id for comments form
        if ($comments != FALSE) {
            ($hook = get_hook('comments_store_cache')) ? eval($hook) : NULL;
            $this->cache->store('comments_' . $item_id . $this->module, $comments, $this->cache_ttl, 'comments');
        }

        if ($comments != null) {
            $comments_count = count($comments);
        } else {
            $comments_count = 0;
        }

        if (is_array($comments)) {
            $i = 0;
            foreach ($comments as $comment) {
                if ($comment['parent'] > 0) {
                    $comment_ch[] = $comment;
                    unset($comments[$i]);
                }
                $i++;
            }
        }

        $data = [
                 'comments_arr'       => $comments,
                 'comment_ch'         => $comment_ch,
                 'comment_controller' => $this->comment_controller,
                 'total_comments'     => lang('Total comments: ', 'comments') . count($comments),
                 'can_comment'        => $this->can_comment,
                 'use_captcha'        => $this->use_captcha,
                 'use_moderation'     => $this->use_moderation,
                 'enable_comments'    => $this->enable_comments,
                 'visibleMainForm'    => $this->input->post('visibleMainForm'),
                ];

        if ($this->use_captcha == TRUE && !$this->dx_auth->is_admin()) {
            $this->dx_auth->captcha();
            $data['cap_image'] = $this->dx_auth->get_captcha_image();
        }
        ($hook = get_hook('comments_read_com_tpl')) ? eval($hook) : NULL;

        $comments = $this->_fetchComments($data);

        ($hook = get_hook('comments_assign_tpl_data')) ? eval($hook) : NULL;

        echo json_encode(
            [
             'comments'          => $comments,
             'total_comments'    => $comments_count ? $comments_count . ' ' . SStringHelper::Pluralize($comments_count, [lang('review', 'comments'), lang('reviews', 'comments'), lang('review', 'comments')]) : lang('Leave a comment', 'comments'),
             'commentsCount'     => $commentsCount[$item_id],
             'validation_errors' => $this->validation_errors,
            ]
        );
    }

    /**
     * Determinate commented page.
     *
     * if product - return id
     * @param string $url
     * @return string
     */
    public function parsUrl($url) {

        if (strstr($url, '/product/')) {
            $url = parse_url($url);
            /** Check is lang segment and remove it from url path * */
            $urlArraySegments = explode('/', $url['path']);

            $id = $this->db->select('id, enable_comments')
                ->where('url', end($urlArraySegments))
                ->get('shop_products')
                ->row();

            if ($id->enable_comments == 0) {
                $this->enable_comments = false;
            }
            return $id->id;
        }

        if (strstr($url, '/image/')) {
            $url = explode(DS, $url);
            $url = $url[count($url) - 1];

            return $url;
        }
        if (strstr($url, '/album/')) {
            $url = explode(DS, $url);
            $url = $url[count($url) - 1];

            return $url;
        }

        if ($url == site_url()) {
            $id = $this->db->select('main_page_id, comments_status')
                ->join('content', 'settings.main_page_id=content.id')
                ->get('settings')
                ->row();

            if ($id->comments_status == 0) {
                $this->enable_comments = false;
            }
            return $id->main_page_id;
        }

        $paths = explode('/', $url);
        $paths = $paths[count($paths) - 1];

        $lang_id = $this->getCommentsLocale() ?: MY_Controller::getCurrentLanguage('id');

        $page = $this->db->select('id, comments_status, category')
            ->where('url', $paths)
            ->where('lang', $lang_id)
            ->get('content');

        if ($page) {
            $page = $page->row();

            $pageCategory = $this->db->select('id, comments_default')
                ->where('id', $page->category)
                ->get('category');

            if ($pageCategory) {
                $pageCategory = $pageCategory->row();
                $page->comments_status = $pageCategory->comments_default ? TRUE : $page->comments_status;
            }
        }

        if ($page->comments_status == 0) {
            $this->enable_comments = FALSE;
        }

        return $page->id;
    }

    /**
     * @param string $url
     * @return string
     */
    public function getModule($url) {
        $url = '/' . $url;

        if (strstr($url, '/shop/')) {
            return 'shop';
        }

        if (strstr($url, '/bloh/')) {
            return 'core';
        }

        if (strstr($url, '/gallery/')) {
            return 'gallery';
        }

        if ($url == site_url()) {
            return 'core';
        }

        return 'core';
    }

    /**
     * New comments realization
     * @return array validation data
     */
    public function addPost() {

        $this->setCommentsLocale();
        $this->load->model('base');
        $this->_init_settings();
        $this->load->library('user_agent');
        $this->load->library('form_validation');
        $this->load->model('base');

        $referer = explode('?', $this->input->server('HTTP_REFERER'));
        $item_id = $this->parsUrl($referer[0]);

        if ($this->period > 0 && !$this->check_comment_period()) {
            return [
                    'answer'            => 'error',
                    'validation_errors' => ['time_error' => lang('The following comment can be left through', 'comments') . ' ' . $this->period . ' ' . lang('minutes', 'comments')],
                   ];
        }

        // Validate email and nickname from unregistered users.
        if (!$this->dx_auth->is_logged_in()) {
            $this->form_validation->set_rules('comment_email', lang('Email', 'comments'), 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('comment_author', lang('Your name', 'comments'), 'trim|required|xss_clean|max_length[50]');
            $this->form_validation->set_rules('comment_site', lang('Site', 'comments'), 'trim|xss_clean|max_length[250]');
        }

        // Check captcha code if captcha_check enabled and user in not admin.
        if ($this->use_captcha AND ! $this->dx_auth->is_admin()) {
            $this->form_validation->set_message('callback_captcha_check', lang('Wrong code protection', 'comments'));
            if ($this->dx_auth->use_recaptcha) {
                $this->form_validation->set_rules('recaptcha_response_field', lang('Code protection', 'comments'), 'trim|required|xss_clean|callback_captcha_check');
            } else {
                $this->form_validation->set_rules('captcha', lang('Code protection', 'comments'), 'trim|required|xss_clean|callback_captcha_check');
            }
        }

        if ($this->max_comment_length != 0) {
            $this->form_validation->set_rules('comment_text', lang('Comment', 'comments'), 'trim|required|xss_clean|max_length[' . $this->max_comment_length . ']');
        } else {
            $this->form_validation->set_rules('comment_text', lang('Comment', 'comments'), 'trim|required|xss_clean');
        }

        if (!$this->form_validation->run($this)) {
            //            $this->dx_auth->captcha();
            //            $cap_image = $this->dx_auth->get_captcha_image();
            return [
                    'answer'            => 'error',
                    'validation_errors' => $this->form_validation->getErrorsArray(),
                   ];
        } else {
            if (!$this->dx_auth->is_logged_in()) {
                $comment_author = $this->input->post('comment_author');
                $comment_email = $this->input->post('comment_email');

                // Write on cookie nickname and email
                $this->_write_cookie($comment_author, $comment_email, $this->input->post('comment_site'));
            } else {
                $user = $this->db->get_where('users', ['id' => $this->dx_auth->get_user_id()])->row_array();
                $comment_author = $user['username'];
                $comment_email = $user['email'];
            }

            $comment_text = nl2br($this->input->post('comment_text'));
            $comment_text_plus = nl2br($this->input->post('comment_text_plus'));
            $comment_text_minus = nl2br($this->input->post('comment_text_minus'));
            $rate = $this->input->post('ratec');
            if ($rate && SHOP_INSTALLED && class_exists('SProductsQuery') && SProductsQuery::create()->findPk($item_id) !== null) {
                $model = SProductsRatingQuery::create()->findPk($item_id);
                if ($model === null) {
                    $model = new SProductsRating;
                    $model->setProductId($item_id);
                }
                $model->setVotes($model->getVotes() + 1);
                $model->setRating($model->getRating() + $rate);
                $model->save();
            }
            $email = $this->db->select('email')
                ->get_where('users', ['id' => $this->dx_auth->get_user_id()], 1)
                ->row();

            $comment_data = [
                             'module'     => $this->module,
                             'user_id'    => $this->dx_auth->get_user_id(), // 0 if unregistered
                             'user_name'  => $this->dx_auth->is_logged_in() ? $this->dx_auth->get_username() : $this->input->post('comment_author'),
                             'user_mail'  => $this->dx_auth->is_logged_in() ? $email->email : $this->input->post('comment_email'),
                             'user_site'  => $this->input->post('comment_site'),
                             'text'       => $comment_text,
                             'text_plus'  => $comment_text_plus,
                             'text_minus' => $comment_text_minus,
                             'item_id'    => $item_id,
                             'status'     => $this->_comment_status(),
                             'agent'      => $this->agent->agent_string(),
                             'user_ip'    => $this->input->ip_address(),
                             'date'       => time(),
                             'rate'       => $this->input->post('ratec'),
                             'parent'     => $this->input->post('comment_parent'),
                            ];
            $this->db->insert('comments', $comment_data);
            $this->_recount_comments($item_id, $comment_data['module']);
            \CMSFactory\Events::create()->registerEvent(['commentId' => $this->db->insert_id()]);
            $this->validation_errors = '';

            //return sucesfull answer
            return [
                    'answer'             => 'sucesfull',
                    'moderation_enabled' => $this->_comment_status(),
                   ];
        }
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function newPost() {
        $this->load->model('base');
        $this->_init_settings();

        ($hook = get_hook('comments_on_add')) ? eval($hook) : NULL;

        $this->load->library('user_agent');
        $this->load->library('form_validation');
        $this->load->model('base');

        $item_id = $this->parsUrl($this->input->server('HTTP_REFERER'));

        if ($this->period > 0) {
            if ($this->check_comment_period() == FALSE) {
                echo json_encode(
                    [
                     'answer'            => 'error',
                     'validation_errors' => lang('The following comment can be left through', 'comments') . ' ' . $this->period . ' ' . lang('minutes', 'comments'),
                    ]
                );
                return;
            }
        }

        // Validate email and nickname from unregistered users.
        if ($this->dx_auth->is_logged_in() == FALSE) {
            ($hook = get_hook('comments_set_val_rules')) ? eval($hook) : NULL;

            $this->form_validation->set_rules('comment_email', lang('Email', 'comments'), 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('comment_author', lang('Your name', 'comments'), 'trim|required|xss_clean|max_length[50]');
            $this->form_validation->set_rules('comment_site', lang('Site', 'comments'), 'trim|xss_clean|max_length[250]');
        }

        // Check captcha code if captcha_check enabled and user in not admin.
        if ($this->use_captcha == TRUE AND $this->dx_auth->is_admin() == FALSE) {
            ($hook = get_hook('comments_set_captcha')) ? eval($hook) : NULL;
            $this->form_validation->set_message('callback_captcha_check', lang('Wrong code protection', 'comments'));
            if ($this->dx_auth->use_recaptcha) {
                $this->form_validation->set_rules('recaptcha_response_field', lang('Code protection', 'comments'), 'trim|required|xss_clean|callback_captcha_check');
            } else {
                $this->form_validation->set_rules('captcha', lang('Code protection', 'comments'), 'trim|required|xss_clean|callback_captcha_check');
            }
        }

        if ($this->max_comment_length != 0) {
            $this->form_validation->set_rules('comment_text', lang('Comment', 'comments'), 'trim|required|xss_clean|max_length[' . $this->max_comment_length . ']');
        } else {
            $this->form_validation->set_rules('comment_text', lang('Comment', 'comments'), 'trim|required|xss_clean');
        }

        if ($this->form_validation->run($this) == FALSE) {
            ($hook = get_hook('comments_validation_failed')) ? eval($hook) : NULL;
            //$this->core->error( validation_errors() );
            //            $this->template->assign('comment_errors', validation_errors());
        } else {
            if ($this->dx_auth->is_logged_in() == FALSE) {
                ($hook = get_hook('comments_author_not_logged')) ? eval($hook) : NULL;

                $comment_author = trim(htmlspecialchars($this->input->post('comment_author')));
                $comment_email = trim(htmlspecialchars($this->input->post('comment_email')));

                // Write on cookie nickname and email
                $this->_write_cookie($comment_author, $comment_email, $this->input->post('comment_site'));
            } else {
                ($hook = get_hook('comments_author_logged')) ? eval($hook) : NULL;

                $user = $this->db->get_where('users', ['id' => $this->dx_auth->get_user_id()])->row_array();
                $comment_author = $user['username'];
                $comment_email = $user['email'];
            }

            $comment_text = trim(htmlspecialchars($this->input->post('comment_text')));
            $comment_text = str_replace("\n", '<br/>', $comment_text);
            $comment_text_plus = trim(htmlspecialchars($this->input->post('comment_text_plus')));
            $comment_text_plus = str_replace("\n", '<br/>', $comment_text_plus);
            $comment_text_minus = trim(htmlspecialchars($this->input->post('comment_text_minus')));
            $comment_text_minus = str_replace("\n", '<br/>', $comment_text_minus);
            $rate = $this->input->post('ratec');
            if ($this->input->post('ratec')) {
                if (class_exists('SProductsQuery')) {
                    if (SProductsQuery::create()->findPk($item_id) !== null) {
                        $model = SProductsRatingQuery::create()->findPk($item_id);
                        if ($model === null) {
                            $model = new SProductsRating;
                            $model->setProductId($item_id);
                        }
                        $model->setVotes($model->getVotes() + 1);
                        $model->setRating($model->getRating() + $rate);
                        $model->save();
                    }
                }
            }
        }
        if ($this->input->post('action') == 'newPost') {
            $email = $this->db->select('email')
                ->get_where('users', ['id' => $this->dx_auth->get_user_id()], 1)
                ->row();

            if (!validation_errors()) {
                $comment_data = [
                                 'module'     => $this->module,
                                 'user_id'    => $this->dx_auth->get_user_id(), // 0 if unregistered
                                 'user_name'  => $this->dx_auth->is_logged_in() ? $this->dx_auth->get_username() : trim(htmlspecialchars($this->input->post('comment_author'))),
                                 'user_mail'  => $this->dx_auth->is_logged_in() ? $email->email : trim(htmlspecialchars($this->input->post('comment_email'))),
                                 'user_site'  => htmlspecialchars($this->input->post(comment_site)),
                                 'text'       => $comment_text,
                                 'text_plus'  => $comment_text_plus,
                                 'text_minus' => $comment_text_minus,
                                 'item_id'    => $item_id,
                                 'status'     => $this->_comment_status(),
                                 'agent'      => $this->agent->agent_string(),
                                 'user_ip'    => $this->input->ip_address(),
                                 'date'       => time(),
                                 'rate'       => $this->input->post('ratec'),
                                 'parent'     => $this->input->post('comment_parent'),
                                ];

                $this->db->insert('comments', $comment_data);
                $this->_recount_comments($item_id, $comment_data['module']);
                \CMSFactory\Events::create()->registerEvent(['commentId' => $this->db->insert_id()]);
                $this->validation_errors = '';

                //return sucesfull JSON answer
                echo json_encode(
                    ['answer' => 'sucesfull']
                );
            } else {

                if ($this->dx_auth->use_recaptcha) {
                    $field_name = 'recaptcha_response_field';
                } else {
                    $field_name = 'captcha';
                }

                //                if ($this->form_validation->error($field_name)) {
                $this->dx_auth->captcha();
                $cap_image = $this->dx_auth->get_captcha_image();
                //                }
                //                if ($this->use_captcha == TRUE && !$this->dx_auth->is_admin()) {
                //                    $this->dx_auth->captcha();
                //                    $data['cap_image'] = $this->dx_auth->get_captcha_image();
                //                }
                echo json_encode(
                    [
                     'answer'            => 'error',
                     'validation_errors' => validation_errors(),
                     'cap_image'         => $cap_image,
                    ]
                );
            }
        }
    }

    public function setyes() {
        $comid = $this->input->post('comid');
        if ($this->session->userdata('commentl' . $comid) != 1) {
            $row = $this->db->where('id', $comid)->get('comments')->row();
            $like = $row->like;
            $like = $like + 1;
            $data = ['like' => $like];
            $this->db->where('id', $comid);
            $this->db->update('comments', $data);
            $this->session->set_userdata('commentl' . $comid, 1);
            if ($this->input->is_ajax_request()) {
                return json_encode(['y_count' => "$like"]);
            } else {
                $like--;
                return json_encode(['y_count' => "$like"]);
            }
        }
    }

    public function setno() {
        $comid = $this->input->post('comid');
        if ($this->session->userdata('commentl' . $comid) != 1) {
            $row = $this->db->where('id', $comid)->get('comments')->row();
            $disslike = $row->disslike;
            $disslike = $disslike + 1;
            $data = ['disslike' => $disslike];
            $this->db->where('id', $comid);
            $this->db->update('comments', $data);
            $this->session->set_userdata('commentl' . $comid, 1);
            if ($this->input->is_ajax_request()) {
                return json_encode(['n_count' => "$disslike"]);
            } else {
                $disslike--;
                return json_encode(['n_count' => "$disslike"]);
            }
        }
    }

    /**
     * @param array $ids
     * @param string $module
     * @param int $status
     * @return array|void
     */
    public function getTotalCommentsForProducts($ids, $module = 'shop', $status = 0) {
        if ($ids == null || !$this->db->table_exists('comments')) {
            return;
        }

        $this->db->select('item_id, COUNT(comments.id) AS `count`');
        $this->db->group_by('item_id');
        $this->db->where_in('item_id', $ids);
        $this->db->where('status', $status);
        $this->db->where('module = ', $module);
        $query = $this->db->get('comments')->result_array();

        $result = [];

        foreach ($query as $q) {
            $result[$q['item_id']] = $q['count'] . ' ' . SStringHelper::Pluralize((int) $q['count'], [lang('review', 'comments'), lang('reviews', 'comments'), lang('review', 'comments')]);
        }

        foreach ((array) $ids as $id) {
            if (!$result[$id]) {
                $result[$id] = 0 . ' ' . SStringHelper::Pluralize('0', [lang('review', 'comments'), lang('reviews', 'comments'), lang('comments', 'comments')]);
            }
        }

        return $result;
    }

    /**
     * Get count answers to comment by id
     * @param integer $commentId
     * @return boolean|int
     */
    public function getCountCommentAnswersByCommentId($commentId) {
        $query = $this->db->where('parent', $commentId)->get('comments')->result_array();
        if ($query) {
            return count($query);
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getCommentsLocale() {

        /** @var CI_DB_result $locale */
        $locale = $this->db->get_where('languages', ['identif' => $this->comments_locale]);

        if ($locale->num_rows() > 0) {

            $locale_arr = $locale->row_array();
            return $locale_arr['id'];

        }
        return false;

    }

    /**
     * @return void
     */
    public function setCommentsLocale() {

        $this->comments_locale = MY_Controller::getCurrentLocale();
    }

}
<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Comments component
 * @property Base $base
 */
class Comments extends MY_Controller
{

    public $period = 5;      // Post comment period in minutes. If user is unregistered, check will be made by ip address. 0 - To disable this method.

    public $can_comment = 0;      // Possible values: 0 - all, 1 - registered only.

    public $max_comment_length = 500;    // Max. comments text lenght.

    public $use_captcha = FALSE;  // Possible values TRUE/FALSE;

    public $cache_ttl = 86400;

    public $module = 'core';

    public $order_by = 'date.desc';

    public $comment_controller = 'comments/add';

    public $tpl_name = 'comments'; // Use comments.tpl

    public $use_moderation = TRUE;

    public $enable_comments = TRUE;

    public function __construct() {

        parent::__construct();
        $this->load->module('core');
        $this->load->language('comments');
        $this->load->helper('cookie');

        $obj = new MY_Lang();
        $obj->load('comments');
    }

    public function show() {

        $url = $this->uri->uri_string();
        $comments = $this->load->module('comments/commentsapi')->getComments($url);
        if (($result = $this->session->flashdata('result'))) {
            $comments = (array_merge($result, $comments));
        }

        $locale = MY_Controller::getCurrentLocale() == MY_Controller::getDefaultLanguage()['identif'] ? '' : '/'. MY_Controller::getCurrentLocale();

        assetManager::create()
            ->setData($comments)
            ->setData(['locale' => $locale])
            ->render('comments', TRUE);
    }

    public function addPost() {

        $result = $this->load->module('comments/commentsapi')->addPost();
        $result['parent_id'] = $this->input->post('comment_parent');
        if ('error' == $result['answer']) {
            $result['old_text'] = $this->input->post('comment_text');
            $result['old_ratec'] = $this->input->post('ratec');
            $result['old_author'] = $this->input->post('comment_author');
            $result['old_email'] = $this->input->post('comment_email');
        }
        $this->session->set_flashdata(['result' => $result]);
        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     * Default function to access module by URL
     */
    public function index() {

        return FALSE;
    }

    public static function adminAutoload() {

        \CMSFactory\Events::create()->onShopProductDelete()->setListener(
            function ($data){
                $models = $data['model'];
                $ids = [];
                foreach ($models as $model) {
                    $ids[] = $model->getId();
                }
                CI::$APP->db->where('module', 'shop')->where_in('item_id', $ids)->delete('comments');
            }
        );
    }

    /**
     *
     * @param array $data
     * @return string
     */
    public function _fetchComments($data) {

        if ($this->enable_comments) {
            $comments = assetManager::create()
                ->setData($data)
                ->registerStyle('comments', TRUE)
                ->fetchTemplate($this->tpl_name);
        } else {
            $comments = '';
        }
        return $comments;
    }

    public function commentsDeleteFromCategory($product) {

        if (!$product) {
            return;
        }

        $CI = &get_instance();

        $ids = [];
        foreach ($product[ShopCategoryId] as $key => $p) {
            $ids[$key] = $p;
        }

        $array = $CI->db
            ->select('item_id')
            ->join('shop_products', 'comments.item_id=shop_products.id')
            ->where_in('shop_products.category_id', $ids)
            ->where('module', 'shop')
            ->group_by('item_id')
            ->get('comments')
            ->result_array();

        $ids = [];
        foreach ($array as $key => $a) {
            $ids[$key] = $a['item_id'];
        }

        $CI->db->where_in('item_id', $ids);
        $CI->db->where('module', 'shop');
        $CI->db->delete('comments');
    }

    /**
     *
     * @param string $page_id
     * @param string $module
     * @return boolean
     */
    public function _recount_comments($page_id, $module) {

        if ($module != 'core') {
            return FALSE;
        }

        $this->db->where('item_id', $page_id);
        $this->db->where('status', 0);
        $this->db->where('module', 'core');
        $this->db->from('comments');
        $total = $this->db->count_all_results();

        $this->db->limit(1);
        $this->db->where('id', $page_id);
        $this->db->update('content', ['comments_count' => $total]);
        return TRUE;
    }

    public function commentsDeleteFromProduct($product) {

        if (!$product) {
            return;
        }

        $CI = &get_instance();

        $product = $product[model];
        $ids = [];
        foreach ($product as $key => $p) {
            $ids[$key] = $p->id;
        }

        $CI->db->join('shop_products', 'comments.item_id=shop_products.id');
        $CI->db->where_in('item_id', $ids);
        $CI->db->where('module', 'shop');
        $CI->db->delete('comments');
    }

    public function init($model) {

        assetManager::create()
            ->registerScript('comments', TRUE);

        if ($model instanceof SProducts) {
            $productsCount = $this->load->module('comments/commentsapi')->getTotalCommentsForProducts($model->getId());
        } else {
            $ids = [];
            if ($this->core->core_data['module'] != 'shop') {
                foreach ((array) $model as $key => $id) {
                    if (is_array($id)) {
                        $ids[$key] = $id[id];
                    } else {
                        $ids[$key] = $id;
                    }
                }
                $productsCount = $this->load->module('comments/commentsapi')->getTotalCommentsForProducts($ids, 'core');
            } else {
                foreach ($model as $id) {
                    $ids[] = $id->getId();
                }
                $productsCount = $this->load->module('comments/commentsapi')->getTotalCommentsForProducts($ids);
            }
        }
        return $productsCount;
    }

    public function _init_settings() {

        $settings = $this->base->get_settings();

        ($hook = get_hook('comments_settigs_init')) ? eval($hook) : NULL;
        if (is_array($settings)) {
            foreach ($settings as $k => $v) {
                $this->$k = $v;
            }
        }

        $this->use_moderation = $this->dx_auth->is_admin() ? FALSE : $settings['use_moderation'];
        $this->use_captcha = $this->dx_auth->is_admin() ? FALSE : $settings['use_captcha'];
    }

    /**
     * Fetch comments and load template
     */
    public function build_comments($item_id = 0) {

        $this->load->model('base');
        $this->_init_settings();

        //        if (($comments = $this->cache->fetch('comments_' . $item_id . $this->module, 'comments')) !== FALSE) {
        //            ($hook = get_hook('comments_fetch_cache_ok')) ? eval($hook) : NULL;
        //            // Comments fetched from cahce file
        //        } else {
        $this->db->where('module', $this->module);
        $comments = $this->base->get($item_id, 0, $this->module, $this->input->post('countcomment'), $this->order_by);

        // Read comments template
        // Set page id for comments form
        if ($comments != FALSE) {
            ($hook = get_hook('comments_store_cache')) ? eval($hook) : NULL;
            $this->cache->store('comments_' . $item_id . $this->module, $comments, $this->cache_ttl, 'comments');
        }
        //}

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
        //        $this->load->library('pagination');
        //
        //        $config['base_url'] = '';
        //        $config['total_rows'] = '200';
        //        $config['per_page'] = '20';
        //
        //        $this->pagination->initialize($config);
        //
        //        echo $this->pagination->create_links();

        if ($comments != null) {
            $comments_count = count($comments);
        } else {
            $comments_count = 0;
        }

        $data = [
                 'comments_arr'       => $comments,
                 'comment_ch'         => $comment_ch,
                 'comment_controller' => $this->comment_controller,
                 'total_comments'     => lang('Total comments: ', 'comments') . count($comments),
                 'can_comment'        => $this->can_comment,
                 'use_captcha'        => $this->use_captcha,
                 'item_id'            => $item_id,
                ];

        if ($this->use_captcha == TRUE) {
            $this->dx_auth->captcha();
            $data['cap_image'] = $this->dx_auth->get_captcha_image();
        }

        ($hook = get_hook('comments_read_com_tpl')) ? eval($hook) : NULL;

        $comments = $this->template->read($this->tpl_name, $data);

        ($hook = get_hook('comments_assign_tpl_data')) ? eval($hook) : NULL;
        //$this->render('comments_list', array('comments'=>$comments));

        $this->template->add_array(
            ['comments' => $comments]
        );
    }

    /**
     * Add comment
     * @deprecated ImageCMS 4.3
     */
    public function add() {

        ($hook = get_hook('comments_on_add')) ? eval($hook) : NULL;

        // Load comments model
        $this->load->model('base');
        $this->_init_settings();

        // Check access only for registered users
        if ($this->can_comment === 1 AND $this->dx_auth->is_logged_in() == FALSE) {
            ($hook = get_hook('comments_login_for_comments')) ? eval($hook) : NULL;
            $this->core->error(lang('Only authorized users can leave comments.', 'comments') . '<a href="%s" class="loginAjax"> ' . lang('log in, please.', 'comments') . '</ a>');
        }

        $item_id = $this->input->post('comment_item_id');

        // Check if page comments status.
        if ($this->module == 'core') {
            if ($this->base->get_item_comments_status($item_id) == FALSE) {
                ($hook = get_hook('comments_page_comments_disabled')) ? eval($hook) : NULL;
                $this->core->error(lang('Commenting on recording is prohibited.', 'comments'));
            }
        }

        $this->load->library('user_agent');
        $this->load->library('form_validation');
        //        $this->form_validation->CI = & $this;
        // Check post comment period.
        if ($this->period > 0) {
            if ($this->check_comment_period() == FALSE) {
                ($hook = get_hook('comments_period_error')) ? eval($hook) : NULL;
                $this->core->error(sprintf(lang('Allowed to comment once in %s minutes.', 'comments'), $this->period));
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
            if ($this->dx_auth->use_recaptcha) {
                $this->form_validation->set_rules('recaptcha_response_field', lang('Code protection'), 'trim|required|xss_clean|callback_captcha_check');
            } else {
                $this->form_validation->set_rules('captcha', lang('Code protection'), 'trim|required|xss_clean|callback_captcha_check');
            }
        }

        $this->form_validation->set_rules('comment_text', lang('Comment', 'comments'), 'trim|required|xss_clean|max_length[' . $this->max_comment_length . ']');

        if ($this->form_validation->run($this) == FALSE) {
            ($hook = get_hook('comments_validation_failed')) ? eval($hook) : NULL;

            $this->template->assign('comment_errors', validation_errors());
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
                if (SProductsQuery::create()->setComment(__METHOD__)->findPk($item_id) !== null) {
                    $model = SProductsRatingQuery::create()->setComment(__METHOD__)->findPk($item_id);
                    if ($model === null) {
                        $model = new SProductsRating;
                        $model->setProductId($item_id);
                    }
                    $model->setVotes($model->getVotes() + 1);
                    $model->setRating($model->getRating() + $rate);
                    $model->save();
                }
            }
            $parent = $this->input->post('parent');

            if ($comment_text != '') {
                $comment_data = [
                                 'module'     => $this->module,
                                 'user_id'    => $this->dx_auth->get_user_id(), // 0 if unregistered
                                 'user_name'  => htmlspecialchars($comment_author),
                                 'user_mail'  => $comment_email,
                                 'user_site'  => htmlspecialchars($this->input->post('comment_site')),
                                 'text'       => $comment_text,
                                 'text_plus'  => $comment_text_plus,
                                 'text_minus' => $comment_text_minus,
                                 'item_id'    => $item_id,
                                 'status'     => $this->_comment_status(),
                                 'agent'      => $this->agent->agent_string(),
                                 'user_ip'    => $this->input->ip_address(),
                                 'date'       => time(),
                                 'rate'       => $rate,
                                 'parent'     => $parent,
                                ];

                ($hook = get_hook('comments_db_insert')) ? eval($hook) : NULL;

                $this->base->add($comment_data);

                if ($comment_data['status'] == 0) {
                    ($hook = get_hook('comments_update_count')) ? eval($hook) : NULL;

                    $this->db->set('comments_count', 'comments_count + 1', FALSE);
                    $this->db->where('id', $comment_data['item_id']);
                    $this->db->update('content');
                }

                // Drop cached comments
                $this->cache->delete('comments_' . $item_id . $this->module, 'comments');

                ($hook = get_hook('comments_goes_redirect')) ? eval($hook) : NULL;
                // Redirect back to page
                //redirect($this->input->post('redirect'));
                if ($this->input->post('redirect')) {
                    redirect((substr($this->input->post('redirect'), 0, 1) == '/') ? $this->input->post('redirect') : '/' . $this->input->post('redirect'), 301);
                } else {
                    redirect('/');
                }
            } else {
                ($hook = get_hook('comments_empty_text')) ? eval($hook) : NULL;
                $this->core->error(lang('Fill text in comment.', 'comments'));
            }
        }
    }

    /**
     * Determinate comment status.
     *
     *  Comment statuses
     *  0 - Normal(approved) comment.
     *  1 - Waiting for moderation(pending).
     *  2 - Spam.
     */
    public function _comment_status() {

        ($hook = get_hook('comments_on_get_status')) ? eval($hook) : NULL;

        $status = 0;

        if ($this->dx_auth->is_admin() == TRUE) {
            return 0;
        }

        if ($this->use_moderation == TRUE) {
            $status = 1;
        } elseif ($this->use_moderation == FALSE) {
            $status = 0;
        }

        return $status;
    }

    /**
     * Write in cookie author nickname and email
     *
     * @param string $name
     * @param string $email
     * @param string $site
     * @return boolean
     */
    public function _write_cookie($name, $email, $site) {

        $this->load->helper('cookie');

        ($hook = get_hook('comments_write_cookie')) ? eval($hook) : NULL;

        $cookie_name = [
                        'name'   => 'comment_author',
                        'value'  => $name,
                        'expire' => '30000000',
                       ];

        $cookie_email = [
                         'name'   => 'comment_email',
                         'value'  => $email,
                         'expire' => '30000000',
                        ];

        $cookie_site = [
                        'name'   => 'comment_site',
                        'value'  => $site,
                        'expire' => '30000000',
                       ];

        set_cookie($cookie_name);
        set_cookie($cookie_email);
        set_cookie($cookie_site);

        return TRUE;
    }

    protected function check_comment_period() {

        ($hook = get_hook('comments_on_check_period')) ? eval($hook) : NULL;

        if ($this->dx_auth->is_admin() == TRUE) {
            return TRUE;
        }

        $this->db->select('id, date');
        $this->db->order_by('date', 'desc');

        if ($this->dx_auth->is_logged_in() == TRUE) {
            $this->db->where('user_id', $this->dx_auth->get_user_id());
        } else {
            $this->db->where('user_ip', $this->input->ip_address());
        }

        $query = $this->db->get('comments', 1);

        if ($query->num_rows() == 1) {
            $query = $query->row_array();

            $latest_comment = $query['date'];
            $allow_time = $latest_comment + ($this->period * 60);

            if ($allow_time > time()) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    public function captcha_check($code) {

        ($hook = get_hook('comments_captcha_check')) ? eval($hook) : NULL;

        if (!$this->dx_auth->captcha_check($code)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_comments_number($id) {

        $this->where('item_id', $id);
        $query = $this->db->get('comments')->result_array();
        return count($query);
    }

    public function setyes($id = false) {

        $like = false;
        $comid = $this->input->post('comid') ?: $id;
        if ($this->session->userdata('commentl' . $comid) != 1) {
            $like = $this->load->model('base')->setYes($comid);
            $this->session->set_userdata('commentl' . $comid, 1);
        }
        if ($this->input->is_ajax_request()) {
            return json_encode(['y_count' => $like]);
        } else {
            redirect($this->input->server('HTTP_REFERER'));
        }
    }

    public function setno($id = false) {

        $disslike = false;
        $comid = $this->input->post('comid') ?: $id;
        if ($this->session->userdata('commentl' . $comid) != 1) {
            $disslike = $this->load->model('base')->setNo($comid);
            $this->session->set_userdata('commentl' . $comid, 1);
        }
        if ($this->input->is_ajax_request()) {
            return json_encode(['n_count' => $disslike]);
        } else {
            redirect($this->input->server('HTTP_REFERER'));
        }
    }

    public function _install() {

        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }

        $this->load->dbforge();

        $fields = [
                   'id'         => [
                                    'type'           => 'INT',
                                    'constraint'     => 11,
                                    'auto_increment' => TRUE,
                                   ],
                   'module'     => [
                                    'type'       => 'varchar',
                                    'constraint' => 25,
                                   ],
                   'user_id'    => [
                                    'type'       => 'INT',
                                    'constraint' => 11,
                                   ],
                   'user_name'  => [
                                    'type'       => 'varchar',
                                    'constraint' => 50,
                                   ],
                   'user_mail'  => [
                                    'type'       => 'varchar',
                                    'constraint' => 50,
                                   ],
                   'user_site'  => [
                                    'type'       => 'varchar',
                                    'constraint' => 250,
                                   ],
                   'item_id'    => [
                                    'type'       => 'bigint',
                                    'constraint' => 11,
                                   ],
                   'text'       => [
                                    'type'       => 'varchar',
                                    'constraint' => 500,
                                   ],
                   'date'       => [
                                    'type'       => 'int',
                                    'constraint' => 11,
                                   ],
                   'status'     => [
                                    'type'       => 'smallint',
                                    'constraint' => 1,
                                   ],
                   'agent'      => [
                                    'type'       => 'varchar',
                                    'constraint' => 250,
                                   ],
                   'user_ip'    => [
                                    'type'       => 'varchar',
                                    'constraint' => 64,
                                   ],
                   'rate'       => [
                                    'type'       => 'int',
                                    'constraint' => 11,
                                   ],
                   'text_plus'  => [
                                    'type'       => 'varchar',
                                    'constraint' => 500,
                                   ],
                   'text_minus' => [
                                    'type'       => 'varchar',
                                    'constraint' => 500,
                                   ],
                   'like'       => [
                                    'type'       => 'int',
                                    'constraint' => 11,
                                    'default'    => 0,
                                   ],
                   'disslike'   => [
                                    'type'       => 'int',
                                    'constraint' => 11,
                                    'default'    => 0,
                                   ],
                   'parent'     => [
                                    'type'       => 'int',
                                    'constraint' => 11,
                                   ],
                  ];
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('comments', TRUE);

        // Enable module autoload
        $this->db->where('name', 'comments');
        $this->db->update('components', ['autoload' => '1']);
    }

    public function _deinstall() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('comments');
    }

    public function getWaitingForMaderationCount() {

        $count = $this->db->where('status', 1)->count_all_results('comments');
        return $count;
    }

}
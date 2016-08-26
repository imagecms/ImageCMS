<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use CMSFactory\assetManager;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;

/**
 * Image CMS
 * Sample Module Admin
 * @property Cms_admin $cms_admin
 */
class Admin extends BaseAdminController
{

    protected $perPage = 10;

    public function __construct() {
        parent::__construct();

        $lang = new MY_Lang();
        $lang->load('callbacks');
        $this->perPage = $this->input->cookie('per_page') ?: $this->perPage;
        assetManager::create()->setData(['ADMIN_URL' => site_url('/admin/components/run') . '/']);
    }

    /**
     * Callbacks list
     */
    public function index() {
        /** Callbacks Pagination */
        if ($this->input->get('per_page')) {
            $callbacksSession = [
                                 'callback_url' => '?per_page=' . $this->input->get('per_page'),
                                ];
            $this->session->set_userdata($callbacksSession);
        } else {
            $this->session->unset_userdata('callback_url');
        }
        $offset = $this->input->get('per_page');
        $model = SCallbacksQuery::create()
            ->joinSCallbackStatuses(null, 'left join')
            ->joinSCallbackThemes(null, 'left join');

        if ($this->input->get('filterID') > 0) {
            $model = $model->filterById((int) $this->input->get('filterID'));
        }

        if ($user_name = $this->input->get('user_name')) {
            $user_name = (false !== strpos($user_name, '%')) ? $user_name : '%' . $user_name . '%';
            $model->condition('name', 'SCallbacks.Name LIKE ?', $user_name);
            $model->where(['name'], Criteria::LOGICAL_OR);
        }

        if ($phone = $this->input->get('phone')) {
            $phone = (false !== strpos($phone, '%')) ? $phone : '%' . $phone . '%';
            $model->condition('phone', 'SCallbacks.Phone LIKE ?', $phone);
            $model->where(['phone'], Criteria::LOGICAL_OR);
        }

        if ($this->input->get('ThemeId')) {
            if ($this->input->get('ThemeId') > 0) {
                $model = $model->filterByThemeId((int) $this->input->get('ThemeId'));
            }

            if ($this->input->get('ThemeId') === 'without') {
                $model = $model->where('SCallbacks.ThemeId = ?', 0);
            }
        }

        if ($this->input->get('StatusId') > 0) {
            $model = $model->filterByStatusId((int) $this->input->get('StatusId'));
        }

        if ($this->input->get('created_from')) {
            $model = $model->where('FROM_UNIXTIME(SCallbacks.Date, \'%Y-%m-%d\') >= ?', date('Y-m-d', strtotime($this->input->get('created_from'))));
        }

        if ($this->input->get('created_to')) {
            $model = $model->where('FROM_UNIXTIME(SCallbacks.Date, \'%Y-%m-%d\') <= ?', date('Y-m-d', strtotime($this->input->get('created_to'))));
        }

        $model->orderById(Criteria::DESC);

        // Count total orders
        $totalCallbacks = $model->count();

        $model = $model
            ->limit($this->perPage)
            ->offset((int) $offset)
            ->find();

        $callbackStatuses = SCallbackStatusesQuery::create()->setComment(__METHOD__)->joinWithI18n(MY_Controller::defaultLocale(), Criteria::RIGHT_JOIN)
            ->where('SCallbackStatusesI18n.Locale = "' . MY_Controller::defaultLocale() . '"')
            ->orderBy('IsDefault', Criteria::DESC)
            ->orderById()
            ->find();
        $callbackThemes = SCallbackThemesQuery::create()->setComment(__METHOD__)->joinWithI18n(MY_Controller::defaultLocale(), Criteria::JOIN)->orderByPosition()->find();

        // Create pagination
        $pagination = $this->initPagination($totalCallbacks);

        assetManager::create()
            ->setData(compact('model', 'pagination', 'totalCallbacks', 'callbackStatuses', 'callbackThemes'))
            ->renderAdmin('list');
    }

    /**
     * Create or update callback
     *
     * @param int|null $callbackId
     * @throws PropelException
     */
    public function update($callbackId = null) {
        $model = SCallbacksQuery::create()->setComment(__METHOD__)->findPk((int) $callbackId);

        $paginationBrand = $this->session->userdata('callback_url');
        $paginationBrand = $paginationBrand ?: null;

        if ($model === null) {
            $this->error404(lang('Error', 'admin'));
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules($model->rules());

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), lang('Error'), 'r');
            } else {
                $model->fromArray($this->input->post());
                if ($model->getStatusId() !== $this->input->post('StatusId')) {
                    $model->setUserId($this->dx_auth->get_user_id());
                }
                $model->save();

                $this->lib_admin->log(lang('Callback edited', 'callbacks') . '. Id: ' . $callbackId);
                showMessage(lang('Changes have been saved', 'callbacks'));

                if ($this->input->post('action') == 'close') {
                    $redirect_url = '/admin/components/run/callbacks'. $paginationBrand;
                }

                if ($this->input->post('action') == 'edit') {
                    $redirect_url = '/admin/components/run/callbacks/update/' . $model->getId();
                }

                pjax($redirect_url);
            }
        } else {

            $statuses = SCallbackStatusesQuery::create()
                ->joinWithI18n(MY_Controller::defaultLocale(), Criteria::LEFT_JOIN)
                ->orderByIsDefault(Criteria::DESC)
                ->orderById()
                ->find();

            $themes = SCallbackThemesQuery::create()
                ->joinWithI18n(MY_Controller::defaultLocale(), Criteria::LEFT_JOIN)
                ->orderByPosition()->orderById()
                ->find();

            assetManager::create()
                ->setData(compact('model', 'statuses', 'themes', 'paginationBrand'))
                ->renderAdmin('edit');
        }
    }

    /**
     * Display list of callback statuses
     *
     * @return void
     */
    public function statuses() {
        $locale = self::defaultLocale();
        $model = SCallbackStatusesQuery::create()
            ->joinWithI18n($locale, Criteria::JOIN)
            ->orderBy('IsDefault', Criteria::DESC)
            ->orderById(Criteria::ASC)
            ->find();

        assetManager::create()
            ->setData(compact('model', 'locale'))
            ->renderAdmin('status_list');
    }

    /**
     * Create new status
     *
     * @throws PropelException
     */
    public function createStatus() {
        $model = new SCallbackStatuses();
        $locale = self::defaultLocale();

        if ($this->input->post()) {
            $this->form_validation->set_rules($model->rules());

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                $postData = $this->input->post();
                if (!$postData['IsDefault']) {
                    $postData['IsDefault'] = false;
                }
                $model->fromArray($postData);
                $model->save();

                $this->lib_admin->log(lang('Status callback created', 'callbacks') . '. Id: ' . $model->getId());
                showMessage(lang('Position created', 'callbacks'));

                if ($postData['action'] == 'new') {
                    $redirect_url = '/admin/components/run/callbacks/updateStatus/' . $model->getId();
                }

                if ($postData['action'] == 'exit') {
                    $redirect_url = '/admin/components/run/callbacks/statuses';
                }

                pjax($redirect_url);
            }
        } else {
            assetManager::create()
                ->setData(compact('model', 'locale'))
                ->renderAdmin('create_status');
        }
    }

    /**
     * Update new status
     *
     * @param int|null $statusId
     * @param null|string $locale
     * @throws PropelException
     */
    public function updateStatus($statusId = null, $locale = null) {
        $locale = $locale ?: self::defaultLocale();

        $model = SCallbackStatusesQuery::create()->setComment(__METHOD__)->findPk((int) $statusId);

        if ($model === null) {
            showMessage(lang('Such status does not exist', 'callbacks'), '404', 'r');
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules($model->rules());

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors());
            } else {
                $postData = $this->input->post();
                if (!$postData['IsDefault']) {
                    unset($postData['IsDefault']);
                }

                $postData['Locale'] = $locale;

                $model->fromArray($postData);
                $model->save();

                $this->lib_admin->log(lang('Status callback edited', 'callbacks') . '. Id: ' . $statusId);
                showMessage(lang('Changes have been saved', 'callbacks'));

                if ($postData['action'] == 'close') {
                    $redirect_url = '/admin/components/run/callbacks/statuses';
                }

                if ($postData['action'] == 'edit') {
                    $redirect_url = '/admin/components/run/callbacks/updateStatus/' . $model->getId() . '/' . $locale;

                }

                pjax($redirect_url);
            }
        } else {
            $model->setLocale($locale);
            $languages = $this->cms_admin->get_langs(true);
            assetManager::create()->setData(compact('model', 'languages', 'locale'))
                ->renderAdmin('edit_status');
        }
    }

    public function setDefaultStatus() {
        if ($this->input->post('id') && is_numeric($this->input->post('id'))) {
            $model = SCallbackStatusesQuery::create()->setComment(__METHOD__)->findPk($this->input->post('id'));
            if ($model) {
                if ($model->getIsDefault() == FALSE) {
                    showMessage(lang('Default status was changed', 'callbacks'));
                }
                $model->setIsDefault(true);
                $model->save();

                $message = lang('Callback default status changed. New default status ID:', 'callbacks') . ' ' . $model->getId();
                $this->lib_admin->log($message);
            }
        }
    }

    public function changeStatus() {
        $callbackId = (int) $this->input->post('CallbackId');
        $statusId = (int) $this->input->post('StatusId');

        $model = SCallbacksQuery::create()
            ->findPk($callbackId);

        $newStatusId = SCallbackStatusesQuery::create()->setComment(__METHOD__)->joinWithI18n(MY_Controller::defaultLocale())->findOneById((int) $statusId);

        if ($newStatusId && $model) {
            $model->setStatusId($statusId);
            $model->setUserId($this->dx_auth->get_user_id());
            $model->save();

            $message = lang('Callback status changed to', 'callbacks') . ' ' . $newStatusId->getText() . '. '
                . lang('Id:', 'callbacks') . ' '
                . $callbackId;
            $this->lib_admin->log($message);

            showMessage(lang("Callback's status was changed", 'callbacks'));
            pjax('/admin/components/run/callbacks#callbacks_' . $this->input->post('StatusId'));

        }
    }

    public function reorderThemes() {
        $positions = $this->input->post('positions');
        if (count($positions) > 0) {
            foreach ($positions as $pos => $id) {
                SCallbackThemesQuery::create()
                    ->filterById($id)
                    ->update(['Position' => (int) $pos]);
            }
            showMessage(lang('Positions saved successfully', 'callbacks'));
        }
    }

    public function changeTheme() {
        $callbackId = (int) $this->input->post('CallbackId');
        $themeId = (int) $this->input->post('ThemeId');

        $model = SCallbacksQuery::create()
            ->findPk($callbackId);

        if ($model !== null) {
            $model->setThemeId($themeId);
            $model->setUserId($this->dx_auth->get_user_id());
            $model->save();

            $theme = SCallbackThemesI18nQuery::create()->setComment(__METHOD__)->filterById($themeId)->filterByLocale(MY_Controller::defaultLocale())->findOne();

            $message = lang('Callback theme changed to', 'callbacks') . ' ' . ($theme ? $theme->getText() : lang('Does not have', 'callbacks')) . '. '
                . lang('Id:', 'callbacks') . ' '
                . $callbackId;
            $this->lib_admin->log($message);

            showMessage(lang('Callback theme is changed', 'callbacks'));
        }
    }

    /**
     * Delete callback
     *
     * @return void
     * @throws PropelException
     */
    public function deleteCallback() {
        $id = $this->input->post('id');
        if (is_numeric($id)) {
            SCallbacksQuery::create()->setComment(__METHOD__)->findPk($id)->delete();

            $this->lib_admin->log(lang('Callback was removed', 'callbacks') . '. Id: ' . $id);
            showMessage(lang('Callback was removed', 'callbacks'));
        }

        if (is_array($id)) {
            SCallbacksQuery::create()->setComment(__METHOD__)->findBy('id', $id)->delete();
            $this->lib_admin->log(lang('Callback(s) was removed', 'callbacks') . '. Id: ' . implode(', ', $id));
            showMessage(lang('Callback(s) was removed', 'callbacks'));
        }

        pjax('/admin/components/run/callbacks');
    }

    /**
     * Delete status and related callbacks
     *
     * @return void
     */
    public function deleteStatus() {
        $id = (int) $this->input->post('id');
        $model = SCallbackStatusesQuery::create()->setComment(__METHOD__)->findPk($id);
        $mainStatId = $this->db->where('is_default', '1')->get('shop_callbacks_statuses')->row()->id;

        if ($model !== null) {
            if ($model->getIsDefault() == true) {
                showMessage(lang('Unable to remove default status', 'callbacks'), lang('Error', 'callbacks'), 'r');
                exit;
            }
            $this->db->where('status_id', $model->getId())
                ->update('shop_callbacks', ['status_id' => $mainStatId]);

            $model->delete();
            SCallbackStatusesI18nQuery::create()->setComment(__METHOD__)->findById($id)->delete();

            $this->lib_admin->log(lang('Status callback was removed', 'callbacks') . '. Id: ' . $id);
            showMessage(lang('Status was removed', 'callbacks'));
            pjax('/admin/components/run/callbacks/statuses');
        }
    }

    /**
     * Display list of callback themes
     *
     * @return void
     */
    public function themes() {
        $model = SCallbackThemesQuery::create()
            ->joinWithI18n(\MY_Controller::defaultLocale(), Criteria::JOIN)
            ->orderByPosition()
            ->orderById(Criteria::ASC)
            ->find();
        $locale = self::defaultLocale();

        assetManager::create()->setData(compact('model', 'locale'))->renderAdmin('themes_list');
    }

    public function createTheme() {
        $model = new SCallbackThemes;

        if ($this->input->post()) {
            $this->form_validation->set_rules($model->rules());

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors());
            } else {
                $postData = $this->input->post();
                $locale = array_key_exists('Locale', $postData) ? $postData['Locale'] : self::defaultLocale();
                $postData['Locale'] = $locale;

                $model->fromArray($postData);
                $model->save();

                $last_theme_id = $this->db->order_by('id', 'desc')->get('shop_orders')->row()->id;
                $this->lib_admin->log(lang('Topic callbacks created', 'callbacks') . '. Id: ' . $last_theme_id);
                showMessage(lang('Topic started', 'callbacks'));

                if ($postData['action'] == 'close') {
                    $redirect_url = '/admin/components/run/callbacks/themes';
                }

                if ($postData['action'] == 'edit') {
                    $redirect_url = '/admin/components/run/callbacks/updateTheme/' . $model->getId();
                }

                pjax($redirect_url);
            }
        } else {
            $locale = self::defaultLocale();
            assetManager::create()
                ->setData(compact('model', 'locale'))->renderAdmin('create_theme');
        }
    }

    /**
     * @param null|int $themeId
     * @param null|string $locale
     * @throws PropelException
     */
    public function updateTheme($themeId = null, $locale = null) {
        $locale = $locale ?: self::defaultLocale();

        $model = SCallbackThemesQuery::create()->setComment(__METHOD__)->findPk((int) $themeId);

        if (!$model) {
            $this->error404(lang('Error', 'callbacks'));
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules($model->rules());

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors());
            } else {
                $postData = $this->input->post();
                $postData['Locale'] = $locale;

                $model->fromArray($postData);
                $model->save();

                $this->lib_admin->log(lang('Topic callbacks edited', 'callbacks') . '. Id: ' . $themeId);
                showMessage(lang('Changes have been saved', 'callbacks'));

                if ($postData['action'] == 'close') {
                    $redirect_url = '/admin/components/run/callbacks/themes';
                }

                if ($postData['action'] == 'edit') {
                    $redirect_url = '/admin/components/run/callbacks/updateTheme/' . $model->getId() . '/' . $locale;
                }

                pjax($redirect_url);
            }
        } else {
            $model->setLocale($locale);
            $languages = $this->cms_admin->get_langs(true);

            assetManager::create()
                ->setData(compact('model', 'languages', 'locale'))
                ->renderAdmin('edit_theme');
        }
    }

    /**
     * Delete status and related callbacks
     *
     * @return void
     * @throws PropelException
     */
    public function deleteTheme() {
        $id = (int) $this->input->post('id');
        $model = SCallbackThemesQuery::create()->setComment(__METHOD__)->findPk($id);

        if ($model !== null) {
            $this->db
                ->where('status_id', $model->getId())
                ->update('shop_callbacks', ['theme_id' => '0']);
            $model->delete();
            $this->lib_admin->log(lang('Topic callbacks deleted', 'callbacks') . '. Id: ' . $id);
            showMessage(lang('Topic deleted', 'callbacks'));
            pjax('/admin/components/run/callbacks/themes');
        }
    }

    protected function initPagination($totalCallbacks) {
        $this->load->library('pagination');
        $config['base_url'] = site_url('/admin/components/run/callbacks/index?') . http_build_query($this->input->get());
        $config['container'] = 'shopAdminPage';
        $config['uri_segment'] = 6;
        $config['page_query_string'] = true;
        $config['total_rows'] = $totalCallbacks;
        $config['per_page'] = $this->perPage;
        $config['separate_controls'] = true;
        $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
        $config['controls_tag_close'] = '</ul></div>';
        $config['next_link'] = lang('Next', 'callbacks') . '&nbsp;&gt;';
        $config['prev_link'] = '&lt;&nbsp;' . lang('Prev', 'callbacks');
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
        $this->pagination->num_links = 6;
        $this->pagination->initialize($config);
        return $this->pagination->create_links_ajax();
    }

}
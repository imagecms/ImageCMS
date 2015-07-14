<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use Banners\Managers\ImagesManager;
use Banners\Models\BannerImage;
use Banners\Models\BannerImageI18n;
use Banners\Models\BannerImageQuery;
use Banners\Models\BannerImageI18nQuery;
use Banners\Managers\BannerPageTypesManager;
use Banners\UrlFinder\DelegationFinder;

/**
 * Image CMS
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('xbanners');
        $this->load->library('form_validation');
        $this->load->helper('xbanners');

        ClassLoader::getInstance()->registerNamespacedPath(__DIR__ . '/models/propel/generated-classes')->registerAlias(__DIR__ . '/src', 'Banners');
    }

    public function deleteA() {
        \Banners\Models\BannersQuery::create()->deleteAll();
    }

    /**
     * Banners places list page
     */
    public function index() {

        ImagesManager::getInstance()->setInactiveOnTimeOut();
        $banners = \Banners\Models\BannersQuery::create()->joinWithI18n(MY_Controller::defaultLocale())->find();

        \CMSFactory\assetManager::create()
            ->setData(
                [
                    'banners' => $banners,
                    'pageTypes' => BannerPageTypesManager::getInstance()->getPagesTypes(),
                ]
            )
            ->registerStyle('style')
            ->registerScript('script')
            ->renderAdmin('banner/list');
    }

    /**
     * Edit banner page
     * @param int $id - banner id
     * @param string $locale - locale name
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function edit_banner($id, $locale = NULL) {
        $locale = $locale ? $locale : MY_Controller::defaultLocale();

        $banner = \Banners\Models\BannersQuery::create()
            ->findPk($id);

        if (!$banner) {
            $this->core->error_404();
        }

        $banner->setLocale($locale);

        if ($this->input->post()) {
            $this->form_validation->set_rules('banner[name]', lang('Name', 'xbanners'), 'reguired|min_length[2]|max_length[255]|trim');
            $this->form_validation->set_rules('options[autoplaySpeed]', lang('autoplaySpeed', 'xbanners'), 'reguired|min_length[1]|max_length[5]|trim|numeric');
            $this->form_validation->set_rules('options[speed]', lang('speed', 'xbanners'), 'reguired|min_length[2]|max_length[5]|trim|numeric');

            if ($this->form_validation->run($this) === FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                $data = $this->input->post('banner');
                $banner->setName($data['name']);

                $banner->setEffects($this->input->post('options'));

                $banner->save();

                showMessage(lang('Banner successfully update', 'xbanners'), lang('Success', 'admin'));
            }
        } else {
            $bannerImages = \Banners\Managers\ImagesManager::getInstance()->getImagesByPageType($banner, $locale);
            $allowedPagesOptions = BannerPageTypesManager::getInstance()->getView($banner->getPageType(), $locale);

            $options = $banner->getEffects();

            \CMSFactory\assetManager::create()->setData(
                [
                    'banner' => $banner,
                    'allowedPagesOptions' => $allowedPagesOptions,
                    'bannerImages' => $bannerImages,
                    'locale' => $locale,
                    'languages' => $this->load->model('cms_admin')->get_langs(true),
                    'options' => $options
                ]
            )
                ->registerStyle('style')
                ->registerScript('script')
                ->renderAdmin('banner/edit');
        }
    }

    /**
     * Create/Update banner image
     * @param int $bannerId - banner id
     * @param string $locale - locale name
     * @param int $imageId - image id
     */
    public function saveImage($bannerId, $locale, $imageId = NULL) {
        try {
            if ($this->input->post()) {
                $this->form_validation->set_rules('image[name]', lang('Name', 'xbanners'), 'required|min_length[2]|max_length[255]|trim');
                $this->form_validation->set_rules('image[url]', lang('URL', 'xbanners'), 'trim|callback_validate_url');

                if ($this->form_validation->run($this) === FALSE) {
                    showMessage(validation_errors(), '', 'r');
                } else {
                    $data = $this->input->post('image');
                    $data = ImagesManager::getInstance()->prepareImageData($data, $bannerId, $locale);

                    if ($_FILES[ImagesManager::IMAGE_FILE_FIELD]) {
                        $data['src'] = ImagesManager::getInstance()->saveImage($imageId, $data['locale']);
                    } elseif (!$_FILES[ImagesManager::IMAGE_FILE_FIELD] && !$data['src']) {
                        showMessage(lang('Slide must have image', 'xbanners'), lang('Error', 'admin'), 'r');
                        exit;
                    }

                    $bannerImage = $imageId ? BannerImageQuery::create()->findPk($imageId) : (new BannerImage());
                    $bannerImage->fromArray($data);
                    $bannerImage->save();

                    if ($bannerImage->setLastPosition()) {
                        $data['id'] = $bannerImage->getId();

                        $bannerImageI18n = BannerImageI18nQuery::create()->filterByLocale($locale)->findOneById($imageId);
                        if (!$bannerImageI18n) {
                            $bannerImageI18n = new BannerImageI18n();
                        }
                        $bannerImageI18n->fromArray($data);
                        $bannerImageI18n->save();

                        showMessage(lang('Successfully saved', 'xbanners'), lang('Success', 'admin'));
                        pjax(site_url('/admin/components/init_window/xbanners/edit_banner') . "/$bannerId/$locale");
                    }
                }
            }
        } catch (Exception $e) {
            showMessage($e->getMessage(), lang('Error', 'admin'), 'r');
        }
    }

    public function validate_url($url) {
        if (!preg_match("/^[\w\d-._~:\[\]@!$&'()*+;=]*$/", $matches)) {
            $this->form_validation->set_message('validate_url', lang('The %s field can only contain alphanumeric characters and symbols: - , _', 'xbanners'));
            return FALSE;
        }

        preg_match('/[а-яА-Я #?]/i', $url, $matches);
        if (!empty($matches)) {
            $this->form_validation->set_message('validate_url', lang('The %s field can only contain alphanumeric characters and symbols: - , _', 'xbanners'));
            return FALSE;
        }

        return TRUE;
    }

    public function uploadImage() {
        include_once 'assets/js/crop/src/php/core/PictureCut.php';
        ImagesManager::getInstance()->uploadImage();
    }

    /**
     * Delete banner slide image file
     * @param int $bannerId - banner id
     * @param int $imageId - banner image id
     * @param string $locale - locale name
     */
    public function deleteSlideImage($bannerId, $imageId, $locale) {
        if ($imageId && $locale) {
            if (ImagesManager::getInstance()->delete($imageId, $locale)) {
                showMessage(lang('Image successfully deleted', 'xbanners'), lang('Success', 'admin'));
            }
        } else {
            showMessage(lang('Can not delete image', 'xbanners'), lang('Error', 'admin'), 'r');
        }

        pjax(site_url('/admin/components/init_window/xbanners/edit_banner') . "/$bannerId/$locale");
    }

    /**
     * Delete banner slide
     * @param int $bannerId - banner id
     * @param int $imageId - image id
     * @param string $locale - locale name
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteSlide($bannerId, $imageId, $locale) {
        if ($imageId && $locale) {
            ImagesManager::getInstance()->delete($imageId);
            BannerImageQuery::create()->findPk($imageId)->delete();
            showMessage(lang('Banner slide successfully deleted', 'xbanners'), lang('Success', 'admin'));
        } else {
            showMessage(lang('Can not delete banner slide', 'xbanners'), lang('Error', 'admin'), 'r');
        }

        pjax(site_url('/admin/components/init_window/xbanners/edit_banner') . "/$bannerId/$locale");
    }

    public function changePositions() {
        $positions = array_reverse($this->input->post('positions'));
        foreach ($positions as $position => $id) {
            $image = BannerImageQuery::create()->findPk($id);
            $image->setPosition($position);
            $image->save();
        }
        showMessage(lang('Positions saved', 'admin'));
    }

    /**
     * @uses /xbanners/assets/js/script.js autocomplete
     * @param string $_GET ['term']
     * @return string json : [
     *      GroupName: {'Name' : 'url', ... },
     *      Brands: {
     *          'Sony' : '/shop/brand/sony',
     *          'Apple': '/shop/brand/apple',
     *          ... }
     *      ]
     */
    public function url_search_autocomplete() {
        $word = $this->input->get('term');

        echo (new DelegationFinder())
            ->getResultsFor($word, MY_Controller::defaultLocale())
            ->toJson();
    }

    public function updateBannersPlaces() {
        $man = new \Banners\Installers\BannersModuleManager();
        try {
            $man->updateTemplatePlaces();
            showMessage(lang('Successfully saved', 'xbanners'), lang('Success', 'admin'));
        } catch (Exception $e) {
            showMessage($e->getMessage(), lang('Error', 'admin'), 'r');
        }
        pjax(site_url('/admin/components/cp/xbanners'));
    }

}
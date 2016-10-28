<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use Propel\Runtime\Exception\PropelException;
use xbanners\src\Installers\BannersModuleManager;
use xbanners\src\Managers\ImagesManager;
use CMSFactory\assetManager;
use xbanners\models\BannersQuery;
use xbanners\models\BannerImage;
use xbanners\models\BannerImageI18n;
use xbanners\models\BannerImageQuery;
use xbanners\models\BannerImageI18nQuery;
use xbanners\src\Managers\BannerPageTypesManager;
use xbanners\src\UrlFinder\DelegationFinder;

/**
 * Image CMS
 * Sample Module Admin
 */
class Admin extends BaseAdminController
{

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('xbanners');
        $this->load->library('form_validation');
        $this->load->helper('xbanners');

    }

    public function deleteA() {
        BannersQuery::create()->setComment(__METHOD__)->deleteAll();
    }

    /**
     * Banners places list page
     */
    public function index() {

        ImagesManager::getInstance()->setInactiveOnTimeOut();
        $banners = BannersQuery::create()->setComment(__METHOD__)->joinWithI18n(MY_Controller::defaultLocale())->find();

        assetManager::create()
            ->setData(
                [
                 'banners'   => $banners,
                 'pageTypes' => BannerPageTypesManager::getInstance()->getPagesTypes(),
                ]
            )
            ->registerStyle('style')
            ->registerScript('script')
            ->renderAdmin('banner/list');
    }

    /**
     * Edit banner page
     * @param integer $id - banner id
     * @param string $locale - locale name
     * @throws PropelException
     */
    public function edit_banner($id, $locale = NULL) {
        $locale = $locale ?: MY_Controller::defaultLocale();

        $banner = BannersQuery::create()
            ->findPk($id);

        if (!$banner) {
            $this->core->error_404();
        }

        $banner->setLocale($locale);

        if ($this->input->post()) {
            $this->form_validation->set_rules('banner[name]', lang('Name', 'xbanners'), 'reguired|min_length[2]|max_length[255]|trim');
            $this->form_validation->set_rules('options[autoplaySpeed]', lang('autoplaySpeed', 'xbanners'), 'trim|floatval|reguired|greater_than[0]');
            $this->form_validation->set_rules('options[scrollSpeed]', lang('scrollSpeed', 'xbanners'), 'trim|floatval|reguired|greater_than[0]');

            if ($this->form_validation->run($this) === FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                $data = $this->input->post('banner');
                $banner->setName($data['name']);

                $banner->setEffects($this->input->post('options'));

                $banner->save();

                showMessage(lang('Banner successfully update', 'xbanners'), lang('Success', 'admin'));
                $this->lib_admin->log(lang('The banner was update', 'xbanners') . '. Id: ' . $banner->getId());

            }
        } else {
            $bannerImages = ImagesManager::getInstance()->getImagesByPageType($banner, $locale);
            $allowedPagesOptions = BannerPageTypesManager::getInstance()->getView($banner->getPageType(), $locale);
            $options = $banner->getEffects();

            assetManager::create()->setData(
                [
                 'banner'              => $banner,
                 'allowedPagesOptions' => $allowedPagesOptions,
                 'bannerImages'        => $bannerImages,
                 'locale'              => $locale,
                 'languages'           => $this->load->model('cms_admin')->get_langs(true),
                 'options'             => $options,
                ]
            )
                ->registerStyle('style')
                ->registerScript('script')
                ->renderAdmin('banner/edit');
        }
    }

    /**
     * Create/Update banner image
     * @param integer $bannerId - banner id
     * @param string $locale - locale name
     * @param integer $imageId - image id
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

                    $bannerImage = $imageId ? BannerImageQuery::create()->setComment(__METHOD__)->findPk($imageId) : (new BannerImage());
                    $bannerImage->fromArray($data);
                    $bannerImage->save();

                    if ($imageId || $bannerImage->setLastPosition()) {
                        $data['id'] = $bannerImage->getId();

                        $bannerImageI18n = BannerImageI18nQuery::create()->setComment(__METHOD__)->filterByLocale($locale)->findOneById($imageId);
                        if (!$bannerImageI18n) {
                            $bannerImageI18n = new BannerImageI18n();
                        }
                        $bannerImageI18n->fromArray($data);
                        $bannerImageI18n->save();

                        showMessage(lang('Successfully saved', 'xbanners'), lang('Success', 'admin'));
                        $this->lib_admin->log(lang('The banner image was be saved', 'xbanners') . '. Id: ' . $bannerImage->getId());

                        pjax(site_url('/admin/components/init_window/xbanners/edit_banner') . "/$bannerId/$locale");
                    }
                }
            }
        } catch (Exception $e) {
            showMessage($e->getMessage(), lang('Error', 'admin'), 'r');
        }
    }

    public function validate_url($url) {
        return TRUE;
    }

    public function uploadImage() {
        include_once 'assets/js/crop/src/php/core/PictureCut.php';
        ImagesManager::getInstance()->uploadImage();
    }

    /**
     * Delete banner slide image file
     * @param integer $bannerId - banner id
     * @param integer $imageId - banner image id
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
     * @param integer $bannerId - banner id
     * @param integer $imageId - image id
     * @param string $locale - locale name
     * @throws PropelException
     */
    public function deleteSlide($bannerId, $imageId, $locale) {
        if ($imageId && $locale) {
            ImagesManager::getInstance()->delete($imageId);
            BannerImageQuery::create()->setComment(__METHOD__)->findPk($imageId)->delete();
            showMessage(lang('Banner slide successfully deleted', 'xbanners'), lang('Success', 'admin'));

            $this->lib_admin->log(lang('The banner slide was be deleted', 'xbanners'));

        } else {
            showMessage(lang('Can not delete banner slide', 'xbanners'), lang('Error', 'admin'), 'r');
        }

        pjax(site_url('/admin/components/init_window/xbanners/edit_banner') . "/$bannerId/$locale");
    }

    public function changePositions() {
        $positions = array_reverse($this->input->post('positions'));
        foreach ($positions as $position => $id) {
            $image = BannerImageQuery::create()->setComment(__METHOD__)->findPk($id);
            $image->setPosition($position);
            $image->save();
        }
        showMessage(lang('Positions saved', 'admin'));
    }

    /**
     * @uses /xbanners/assets/js/script.js autocomplete
     * @param string $locale
     * @param string $_GET ['term']
     * @return string json : [
     *      GroupName: {'Name' : 'url', ... },
     *      Brands: {
     *          'Sony' : '/shop/brand/sony',
     *          'Apple': '/shop/brand/apple',
     *          ... }
     *      ]
     */
    public function url_search_autocomplete($locale) {
        $word = $this->input->get('term');
        $locale = $locale ?: MY_Controller::defaultLocale();
        echo (new DelegationFinder())
            ->getResultsFor($word, $locale)
            ->toJson();
    }

    public function updateBannersPlaces() {
        $man = new BannersModuleManager();
        try {
            $man->updateTemplatePlaces();
            showMessage(lang('Successfully saved', 'xbanners'), lang('Success', 'admin'));
        } catch (Exception $e) {
            showMessage($e->getMessage(), lang('Error', 'admin'), 'r');
        }
        pjax(site_url('/admin/components/cp/xbanners'));
    }

}
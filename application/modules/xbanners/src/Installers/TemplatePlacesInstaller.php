<?php

namespace xbanners\src\Installers;

use xbanners\models\Banners;
use xbanners\models\BannersQuery;
use template_manager\classes\TemplateManager;
use xbanners\src\Entities\BannerEffects;

/**
 * Install all banners from temlate
 *
 * @author Crayd
 */
final class TemplatePlacesInstaller
{

    /**
     * @var string
     */
    protected $bannersConfigFile;

    /**
     * @param string|void $templateName installed tamplate name
     */
    public function __construct($templateName = null) {
        if (!$templateName) {
            $templateName = TemplateManager::getInstance()->getCurentTemplate()->name;
        }
        $this->bannersConfigFile = TEMPLATES_PATH . $templateName . '/xbanners/banner_places.php';
    }

    /**
     * Save all tamplate banners to databse
     */
    public function install() {
        $this->dropAll();
        foreach ($this->getBanners() as $key => $banner) {
            $bannerModel = new Banners();
            $bannerModel->setPlace($key);
            $bannerModel->setName($banner['name']);//for i18n
            $bannerModel->fromArray($banner, \Propel\Runtime\Map\TableMap::TYPE_FIELDNAME);

            $bannerModel->setEffects((new BannerEffects($banner['effects'], TRUE))->toArray());//default effects

            $bannerModel->save();
        }
    }

    public function update() {
        foreach ($this->getBanners() as $place => $banner) {
            $bannerModel = BannersQuery::create()->setComment(__METHOD__)->findOneByPlace($place);
            if (!count($bannerModel)) {
                $bannerModel = new Banners();
                $bannerModel->setPlace($place);
                $bannerModel->setName($banner['name']);//for i18n
                $bannerModel->setEffects((new BannerEffects($banner['effects'], TRUE))->toArray());//default effects
            }
            $bannerModel->fromArray($banner, \Propel\Runtime\Map\TableMap::TYPE_FIELDNAME);

            $bannerModel->save();
        }
    }

    public function dropAll() {
        BannersQuery::create()->setComment(__METHOD__)->deleteAll();
    }

    /**
     * Get template banners
     *
     * @return array
     * @throws \Exception
     */
    protected function getBanners() {
        if (file_exists($this->bannersConfigFile)) {
            return include $this->bannersConfigFile;
        }
        throw new \Exception(lang('Could not find banner settings', 'xbanners'));
    }

}
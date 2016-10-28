<?php namespace core\src;

use core\models\Route;

class CoreConfiguration
{

    private $urlRules = [
                         Route::TYPE_SHOP_CATEGORY => [
                                                       'prefix' => 'shop/category',
                                                       'parent' => true,
                                                      ],
                         Route::TYPE_PRODUCT       => [
                                                       'prefix' => 'shop/product',
                                                       'parent' => false,
                                                      ],

                        ];

    /**
     * @var array
     */
    private $languages;

    /**
     * @var array
     */
    private $currentLanguage;

    /**
     * @var array
     */
    private $defaultLanguage;

    /**
     * Loaded in lib_init
     * @var array
     */
    private $settings;

    /**
     * @var array
     */
    private $modules;

    /**
     * @var string
     */
    private $currentEntityType;

    /**
     * @var string
     */
    private $currentEntityId;

    /**
     * @return string
     */
    public function getCurrentEntityType() {
        return $this->currentEntityType;
    }

    /**
     * @param string $currentEntityType
     */
    public function setCurrentEntityType($currentEntityType) {
        $this->currentEntityType = $currentEntityType;
    }

    /**
     * @return string
     */
    public function getCurrentEntityId() {
        return $this->currentEntityId;
    }

    /**
     * @param string $currentEntityId
     */
    public function setCurrentEntityId($currentEntityId) {
        $this->currentEntityId = $currentEntityId;
    }

    /**
     * @return array
     */
    public function getModules() {
        return $this->modules;
    }

    /**
     * @param array $modules
     */
    public function setModules($modules) {
        $this->modules = $modules;
    }

    /**
     * @return mixed
     */
    public function getLanguages() {
        return $this->languages;
    }

    /**
     * @param mixed $languages
     */
    public function setLanguages($languages) {
        $this->languages = $languages;
    }

    /**
     * @return mixed
     */
    public function getCurrentLanguage() {
        return $this->currentLanguage;
    }

    public function isDefaultLanguage() {
        return $this->currentLanguage['id'] == $this->defaultLanguage['id'];
    }

    /**
     * @param mixed $currentLanguage
     */
    public function setCurrentLanguage($currentLanguage) {
        $this->currentLanguage = $currentLanguage;
    }

    /**
     * @return mixed
     */
    public function getDefaultLanguage() {
        return $this->defaultLanguage;
    }

    /**
     * @param mixed $defaultLanguage
     */
    public function setDefaultLanguage($defaultLanguage) {
        $this->defaultLanguage = $defaultLanguage;
    }

    /**
     * @return mixed
     */
    public function getSettings() {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings) {

        $this->urlRules[Route::TYPE_SHOP_CATEGORY] = [
                                                      'prefix' => $settings['urlShopCategoryPrefix'],
                                                      'parent' => $settings['urlShopCategoryParent'],
                                                     ];

        $this->urlRules[Route::TYPE_PRODUCT] = [
                                                'prefix' => $settings['urlProductPrefix'],
                                                'parent' => $settings['urlProductParent'],
                                               ];

        $this->settings = $settings;
    }

    /**
     * @return array
     */
    public function getUrlRules() {
        return $this->urlRules;
    }

}
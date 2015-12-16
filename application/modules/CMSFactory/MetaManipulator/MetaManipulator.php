<?php

namespace CMSFactory\MetaManipulator;

use CI;
use CMSFactory\assetManager;
use Currency\Currency;
use Exception;
use MY_Controller;
use phpMorphy;
use phpMorphy_Exception;
use SBrand;
use SCategory;
use SProducts;

class MetaManipulator
{
    const META_TITLE = 1;
    const META_DESCRIPTION = 2;
    const META_KEYWORDS = 3;

    /**
     * Currency
     * @var string
     */
    protected $CS;

    /**
     * ID
     * @var string
     */
    protected $ID;

    /**
     * Brand
     * @var string
     */
    protected $brand;

    /**
     * Category
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $matching = [];

    /**
     * @var string
     */
    protected $metaDescription;

    /**
     * @var string
     */
    protected $metaKeywords;

    /**
     * @var string
     */
    protected $metaTitle;

    /**
     * @var array
     */
    protected $morph = [];

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $pageNumber;

    /**
     * Price
     * @var string
     */
    protected $price;

    /**
     * @var MetaStorage
     */
    protected $storage;

    /**
     * @var string
     */
    protected $wrapper = '%';

    /**
     * MetaManipulator constructor.
     * @param SBrand|SCategory|SProducts|array $model
     * @param MetaStorage $storage
     * @throws Exception
     */
    public function __construct($model, MetaStorage $storage) {

        if ($model === null) {
            throw new Exception('Model not set');
        }

        if ($storage === null) {
            throw new Exception('Storage not set');
        }

        $this->setModel($model);
        $this->setStorage($storage);
        $this->setMetaTitle($this->getStorage()->getTitleTemplate());
        $this->setMetaDescription($this->getStorage()->getDescriptionTemplate());
        $this->setMetaKeywords($this->getStorage()->getKeywordsTemplate());
    }

    /**
     * @return MetaStorage
     */
    public function getStorage() {

        return $this->storage;
    }

    /**
     * @param $storage
     */
    public function setStorage($storage) {

        $this->storage = $storage;
    }

    /**
     * @param string $name
     * @param string $arguments
     * @return string
     */
    public function __call($name, $arguments) {

        $prev_string = $name;
        $method = substr($name, 0, strpos($name, '['));
        $string = method_exists(__CLASS__, $method) ? $this->$method() : '';

        return $string !== '' ? $this->make($string, $prev_string) : '';
    }

    /**
     * @param string $string
     * @param string $prev_string
     * @return null|string
     */
    public function make($string, $prev_string) {

        $return = $string;

        //morphing
        if (preg_match('/\[\d\]/', $prev_string, $match)) {
            $part = str_replace(['[', ']'], '', $match[0]);
            $return = $this->morphing($string, $part);
        }

        //transliteration
        if (preg_match('/\[t\]/', $prev_string)) {
            $return = $this->transliteration($return);
        }

        return $return;
    }

    /**
     * @param string $string
     * @param int $part 1-6
     * @return string|null
     */
    protected function morphing($string, $part) {

        $word = mb_strtoupper($string);

        if (!isset($this->morph[$string])) {
            try {
                $dir = APPPATH . 'modules/CMSFactory/MetaManipulator/dics';

                // set some options
                $opts = [
                    // storage type, follow types supported
                    // PHPMORPHY_STORAGE_FILE - use file operations(fread, fseek) for dictionary access, this is very slow...
                    // PHPMORPHY_STORAGE_SHM - load dictionary in shared memory(using shmop php extension), this is preferred mode
                    // PHPMORPHY_STORAGE_MEM - load dict to memory each time when phpMorphy initialized, this useful when shmop ext. not activated.
                    //                          Speed same as for PHPMORPHY_STORAGE_SHM type
                    'storage' => PHPMORPHY_STORAGE_MEM,
                    // Enable prediction by suffix
                    'predict_by_suffix' => true,
                    // Enable prediction by prefix
                    'predict_by_db' => true,
                    'resolve_ancodes' => RESOLVE_ANCODES_AS_DIALING
                ];

                $lang = MY_Controller::getCurrentLanguage();
                $locale = $lang['locale'];

                $morphy = new phpMorphy($dir, $locale, $opts);

                if (function_exists('iconv')) {
                    $word = iconv('utf-8', $morphy->getEncoding(), $word);
                }
                $this->setMorph($string, $morphy->getAllForms($word));
                return $this->getMorph($string, $part);
            } catch (phpMorphy_Exception $e) {
                die('Error occurred while creating phpMorphy instance: ' . PHP_EOL . $e->getMessage());
            }
        }
        return $this->getMorph($string, $part);

    }

    /**
     * @param string $string
     * @return string
     */
    protected function transliteration($string = '') {

        CI::$APP->load->helper('translit');

        $transliteration = translit($string);
        return $transliteration;
    }

    /**
     * @return string
     */
    public function getBrand() {

        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand) {

        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getCS() {

        if (!$this->CS) {
            $this->setCS(Currency::create()->getSymbol());
        }
        return $this->CS;
    }

    /**
     * @param string $CS
     */
    public function setCS($CS) {

        $this->CS = $CS;
    }

    /**
     * @return string
     */
    public function getCategory() {

        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category) {

        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getDescription() {

        if (!$this->description) {
            $this->setDescription($this->getModel()->getDescription());
        }
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {

        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getID() {

        if (!$this->ID) {
            $this->setID($this->getModel()->getId());
        }
        return $this->ID;
    }

    /**
     * @param string $ID
     */
    public function setID($ID) {

        $this->ID = $ID;
    }

    /**
     * @param string $string
     * @param integer $part
     * @return array
     */
    public function getMorph($string, $part) {

        if (isset($this->morph[$string][$part])) {
            return mb_strtolower($this->morph[$string][$part]);
        }

        return $string;
    }

    /**
     * @param string $string
     * @param array $morph
     */
    public function setMorph($string, $morph) {

        $this->morph[$string] = $morph ?: $string;
    }

    /**
     * @return string
     */
    public function getName() {

        if (!$this->name) {
            $this->setName($this->getModel()->getName());
        }
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {

        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPageNumber() {

        if (!$this->pageNumber) {
            $this->setPageNumber(assetManager::create()->getData('page_number'));
        }
        return (int) $this->pageNumber ?: '';
    }

    /**
     * @param int $pageNumber
     */
    public function setPageNumber($pageNumber) {

        $this->pageNumber = $pageNumber;
    }

    /**
     * @return string
     */
    public function getPrice() {

        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price) {

        $this->price = $price;
    }

    /**
     * @param int|null $param
     * You can specify which elements are returned with optional parameter
     * options. It composes from
     * META_TITLE,
     * META_DESCRIPTION,
     * META_KEYWORDS
     * @return string|array<string,string>
     */
    public function render($param = null) {

        /** @var string $w wrapper */
        $w = $this->getWrapper();

        foreach ($this->getStorage()->getVars() as $var) {
            $method = $this->matching[$var] ?: $var;
            $method = "get$method";

            $replace = $this->$method();
            $search = $w . $var . $w;

            foreach (['MetaTitle', 'MetaDescription', 'MetaKeywords'] as $metaName) {
                $get = "get$metaName";
                $set = "set$metaName";
                $this->$set(str_replace($search, $replace, trim($this->$get())));
            }
        }

        switch ($param) {
            case self::META_TITLE:
                return $this->getMetaTitle();

            case self::META_DESCRIPTION:
                return $this->getMetaDescription();

            case self::META_KEYWORDS:
                return $this->getMetaKeywords();

            default:
                return [
                    'metaTitle' => $this->getMetaTitle(),
                    'metaDescription' => $this->getMetaDescription(),
                    'metaKeywords' => $this->getMetaKeywords(),
                ];

        }
    }

    /**
     * @return string
     */
    public function getWrapper() {

        return $this->wrapper;
    }

    /**
     * @param string $wrapper
     */
    public function setWrapper($wrapper) {

        $this->wrapper = $wrapper;
    }

    /**
     * @return string
     */
    public function getMetaTitle() {

        return $this->metaTitle;
    }

    /**
     * @param string $metaTitle
     */
    public function setMetaTitle($metaTitle) {

        $this->metaTitle = $metaTitle;
    }

    /**
     * @return string
     */
    public function getMetaDescription() {

        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription) {

        $this->metaDescription = $metaDescription;
    }

    /**
     * @return string
     */
    public function getMetaKeywords() {

        return $this->metaKeywords;
    }

    /**
     * @param string $metaKeywords
     */
    public function setMetaKeywords($metaKeywords) {

        $this->metaKeywords = $metaKeywords;
    }

}
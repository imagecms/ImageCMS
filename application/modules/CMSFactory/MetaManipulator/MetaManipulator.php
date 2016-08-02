<?php

namespace CMSFactory\MetaManipulator;

use CI;
use CMSFactory\assetManager;
use Currency\Currency;
use Exception;
use phpMorphy;
use phpMorphy_Exception;
use phpMorphy_Paradigm_ParadigmInterface;
use phpMorphy_WordForm_WordFormInterface;
use SBrands;
use SCategory;
use SProducts;

/**
 * Class MetaManipulator
 * @package CMSFactory\MetaManipulator
 */
class MetaManipulator
{
    const META_TITLE = 1;
    const META_DESCRIPTION = 2;
    const META_KEYWORDS = 3;
    const META_H1 = 4;

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
     * @var int
     */
    protected $descLength;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $matching = [];

    /**
     * @var array
     */
    protected $metaArray = [];

    /**
     * @var string
     */
    protected $metaDescription;

    /**
     * @var string
     */
    protected $metaH1;

    /**
     * @var string
     */
    protected $metaKeywords;

    /**
     * @var string
     */
    protected $metaTitle;

    /**
     * @var SCategory|SBrands|SProducts|array|null
     */
    protected $model;

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
    protected $number;

    /**
     * @var string
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
     * @var array
     */
    private $grammens = [
                         'ИМ',
                         'РД',
                         'ДТ',
                         'ВН',
                         'ТВ',
                         'ПР',
                        ];

    /**
     * method processing meta data
     * @var phpMorphy
     */
    private $phpMorphy;

    /**
     * MetaManipulator constructor.
     * @param SBrands|SCategory|SProducts|array $model
     * @param MetaStorage $storage
     * @throws Exception
     */
    public function __construct($model, MetaStorage $storage) {

        $dir = APPPATH . 'modules/CMSFactory/MetaManipulator/dics';

        // set some options
        $opts = [
            // storage type, follow types supported
            // PHPMORPHY_STORAGE_FILE - use file operations(fread, fseek) for dictionary access, this is very slow...
            // PHPMORPHY_STORAGE_SHM - load dictionary in shared memory(using shmop php extension), this is preferred mode
            // PHPMORPHY_STORAGE_MEM - load dict to memory each time when phpMorphy initialized, this useful when shmop ext. not activated.
            //                          Speed same as for PHPMORPHY_STORAGE_SHM type
                 'storage'           => PHPMORPHY_STORAGE_MEM,
            // Enable prediction by suffix

                 'predict_by_suffix' => true,
                 'graminfo_as_text'  => true,
                ];

        $this->setPhpMorphy(new phpMorphy($dir, 'ru_RU', $opts));

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
        $this->setMetaH1($this->getStorage()->getH1Template());

        $this->setMatching('desc', 'description');
        $this->setMetaArray(['metaTitle', 'metaH1', 'metaDescription', 'metaKeywords']);
    }

    /**
     * @return array
     */
    public function getGrammens() {

        return $this->grammens;
    }

    /**
     * @return MetaStorage
     */
    public function getStorage() {

        return $this->storage;
    }

    /**
     * @param MetaStorage $storage
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
            $words = explode(' ', $string);
            foreach ($words as $word) {
                $array[] = $this->morphing($word, $part);
            }
            $return = implode(' ', $array);
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

        $ucFirst = false;
        //check if first letter is uppercase
        if (mb_strtolower($string) !== $string) {
            $ucFirst = true;
        }

        $word = mb_strtoupper($string);

        if (!array_key_exists($string, $this->morph)) {
            try {

                if (function_exists('iconv')) {
                    $word = iconv('utf-8', $this->getPhpMorphy()->getEncoding(), $word);
                }
                $collection = $this->getPhpMorphy()->findWord($word);

                if (false !== $collection) {
                    $param = $this->getTypeMany($word);

                    foreach ($collection->getByPartOfSpeech($param['TypeSpeech']) as $paradigm) {

                        $checkGrammar = $this->checkGrammar($paradigm, $param, $word);

                        $result = $this->getGrammensWord($paradigm, $param, $checkGrammar);

                        if ($result[0] == $word) {
                            break;
                        }
                    }

                    $this->setMorph($string, $result);
                }
                return $this->getMorph($string, $part, $ucFirst);
            } catch (phpMorphy_Exception $e) {
                die('Error occurred while creating phpMorphy instance: ' . PHP_EOL . $e->getMessage());
            }
        }

        return $this->getMorph($string, $part, $ucFirst);
    }

    /**
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param string $param
     * @param null|string $grammar
     * @return array
     */
    private function getGrammensWord($paradigm, $param, $grammar = null) {

        $result = [];
        if ($grammar !== null) {

            foreach ($this->getGrammens() as $key => $val) {

                /** @var phpMorphy_WordForm_WordFormInterface $form */
                foreach ($paradigm->getWordFormsByGrammems([$param['param'], $val, $grammar]) as $form) {
                    if (!$result[$key]) {
                        $result[$key] = $form->getWord();
                    }
                }
            }
        } else {
            foreach ($this->getGrammens() as $key => $val) {

                /** @var phpMorphy_WordForm_WordFormInterface $form */
                foreach ($paradigm->getWordFormsByGrammems([$param['param'], $val]) as $form) {
                    if (!$result[$key]) {
                        $result[$key] = $form->getWord();
                    }
                }
            }
        }
        return $result;
    }

    /**
     * @param string $word
     * @return array
     */
    private function getTypeMany($word) {

        $checkString = $this->getPhpMorphy()->castFormByGramInfo($word, null, ['МН', 'ИМ'], true)[0];

        $param = ($word !== $checkString) ? 'ЕД' : 'МН';

        $typeSpeech = $this->getTypeSpeechWord($word, $param);

        $result = [
                   'param'      => $param,
                   'TypeSpeech' => $typeSpeech,
                  ];

        return $result;
    }

    /**
     * @param string $word
     * @param string $param
     * @return array
     */
    private function getTypeSpeechWord($word, $param) {

        $typeSpeech = $this->getPhpMorphy()->getPartOfSpeech($word);
        foreach ($typeSpeech as $type) {
            $checkGrammar[$type] = $this->getPhpMorphy()->castFormByGramInfo($word, $type, [$param, 'ИМ'], true);

            foreach ($checkGrammar[$type] as $value) {

                if (empty($resultType)) {
                    $resultType = $word === $value ? $type : null;
                }
                if ($resultType) {
                    break 2;
                }
            }
        }

        return $resultType;

    }

    /**
     * @param phpMorphy_Paradigm_ParadigmInterface $paradigm
     * @param array $param
     * @param string $word
     * @return string|null
     */
    private function checkGrammar($paradigm, $param, $word) {
        /** @var phpMorphy_WordForm_WordFormInterface $form */
        foreach ($paradigm as $form) {
            foreach ($form->getGrammems() as $grammatical) {
                switch ($grammatical) {
                    case 'МР':
                    case 'ЖР':
                    case 'СР':
                        if (empty($checkGrammar)) {

                            $checkGrammar = ($word === $this->getPhpMorphy()->castFormByGramInfo($word, $param['TypeSpeech'], [$param['param'], 'ИМ', $grammatical], true)[0]) ? $grammatical : null;
                        }
                        if ($checkGrammar) {
                            continue;
                        }

                }
            }
        }

        return $checkGrammar;

    }

    /**
     * @param phpMorphy $phpMorphy
     */
    private function setPhpMorphy($phpMorphy) {

        $this->phpMorphy = $phpMorphy;
    }

    /**
     * @return phpMorphy
     */
    private function getPhpMorphy() {

        return $this->phpMorphy;
    }

    /**
     * @param string $string
     * @param integer $part
     * @param bool $ucFirst
     * @return array
     */
    public function getMorph($string, $part, $ucFirst = false) {

        if (array_key_exists(--$part, $this->morph[$string])) {
            $string = mb_strtolower($this->morph[$string][$part]);
        }
        return $ucFirst ? mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1) : $string;
    }

    /**
     * @param string $string
     * @param array $morph
     */
    public function setMorph($string, $morph) {

        $this->morph[$string] = $morph ?: $string;
    }

    /**
     * @param string $string
     * @return string
     */
    protected function transliteration($string = '') {

        CI::$APP->load->helper('translit');

        return translit($string);
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
     * @return int
     */
    public function getDescLength() {
        return $this->descLength;
    }

    /**
     * @param int $descLength
     */
    public function setDescLength($descLength) {

        if ($descLength === '') {
            $this->descLength = 100;
        } elseif ((int) $descLength >= 0) {
            $this->descLength = (int) $descLength;
        }
    }

    /**
     * @return string
     */
    public function getDescription() {

        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {

        $description = strip_tags($description);
        $description = str_replace([PHP_EOL, '  '], ' ', $description);
        $description = rtrim($description, '!,.-:; ');
        if (mb_strlen($description) > $this->getDescLength()) {
            $description = mb_substr($description, 0, $this->getDescLength());
            $description = mb_substr($description, 0, mb_strrpos($description, ' '));
        }

        $this->description = $description;
    }

    /**
     * @return array|null|SBrands|SCategory|SProducts
     */
    public function getModel() {

        return $this->model;
    }

    /**
     * @param array|null|SBrands|SCategory|SProducts $model
     */
    public function setModel($model) {

        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getID() {

        return $this->ID;
    }

    /**
     * @param string $ID
     */
    public function setID($ID) {

        $this->ID = $ID;
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
    public function getMetaH1() {

        return $this->metaH1;
    }

    /**
     * @param string $metaH1
     */
    public function setMetaH1($metaH1) {

        $this->metaH1 = $metaH1;
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
    public function getName() {

        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPageNumber() {

        return $this->getNumber() ? str_replace('%number%', $this->getNumber(), $this->pageNumber) : '';
    }

    /**
     * @param string $pageNumber
     */
    public function setPageNumber($pageNumber) {

        $this->pageNumber = $pageNumber;
    }

    /**
     * @return string
     */
    public function getNumber() {

        if (!$this->number) {
            $this->setNumber(assetManager::create()->getData('page_number'));
        }
        return (int) $this->number > 1 ? (int) $this->number : '';
    }

    /**
     * @param string $number
     */
    public function setNumber($number) {

        $this->number = $number;
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
     * @return array<String>
     */
    public function render() {

        $return = [];
        /** @var string $w wrapper */
        $w = $this->getWrapper();
        $vars = $this->getStorage()->getVars();
        if ($vars !== []) {
            foreach ($vars as $var) {
                $method = $this->getMatching($var) ?: $var;
                $method = "get$method";

                $replace = $this->$method();
                $search = $w . $var . $w;

                foreach ($this->getMetaArray() as $metaName) {
                    $get = "get$metaName";
                    $set = "set$metaName";

                    $return[$metaName] = str_replace($search, $replace, trim($this->$get()));
                    $this->$set($return[$metaName]);
                }
            }
        } else {
            foreach ($this->getMetaArray() as $metaName) {
                $get = "get$metaName";
                $set = "set$metaName";

                $return[$metaName] = trim($this->$get());
                $this->$set($return[$metaName]);
            }

        }

        return $return;

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
     * @param string $key
     * @return bool|array
     */
    public function getMatching($key) {

        return array_key_exists($key, $this->matching) ? $this->matching[$key] : false;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setMatching($key, $value) {

        $this->matching[$key] = $value;
    }

    /**
     * @return array
     */
    public function getMetaArray() {

        return $this->metaArray;
    }

    /**
     * @param array $metaArray
     */
    public function setMetaArray($metaArray) {

        foreach ($metaArray as $item) {
            $this->metaArray[] = $item;
        }

        $this->metaArray = array_unique($this->metaArray);
    }

}
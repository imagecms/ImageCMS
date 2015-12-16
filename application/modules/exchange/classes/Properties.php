<?php

namespace exchange\classes;

use CMSFactory\ModuleSettings;

/**
 *
 *
 * @author kolia
 */
class Properties extends ExchangeBase
{

    const PROPTYPE_NUM = 0;
    const PROPTYPE_SPR = 1;

    /**
     * External ids of new properties
     * @var array
     */
    protected $new = [];

    /**
     * External ids of existing properties
     * @var array
     */
    protected $existing = [];

    /**
     *
     * @var array
     */
    protected $propertiesData = [];

    /**
     * For the properties with type "Справочник"
     * @var array
     */
    public $dictionaryProperties = [];

    /**
     *
     * @var string
     */
    protected $brandIdentif = NULL;

    /**
     *
     * @var array (property_external_id => id)
     */
    protected $brands = [];

    /**
     *
     * @var array [[id => name],...]
     */
    protected $brandIdsToNames = [];

    /**
     *
     */
    protected function import_() {

        \CI::$APP->load->helper('translit');

        // preparing data array for insert, spliting on new and existing properties

        $this->processProperties();

        if (count($this->new) > 0) {
            $this->insert();
        }

        $ignoreExisting = ModuleSettings::ofModule('exchange')->get('ignore_existing');
        if (count($this->existing) > 0 && !isset($ignoreExisting['properties'])) {
            $this->update();
        }

        if (count($this->brands) > 0) {
            $this->insertBrands();
        }

        $this->dataLoad->getNewData('properties');

        $this->loadBrandsNames();
    }

    public function setBrandIdentif($brandIdentif) {
        $this->brandIdentif = $brandIdentif;
        return $this;
    }

    protected function loadBrandsNames() {
        $result = $this->db
            ->select(['shop_brands.id', 'shop_brands_i18n.name'])
            ->from('shop_brands')
            ->join('shop_brands_i18n', sprintf("shop_brands.id=shop_brands_i18n.id AND shop_brands_i18n.locale='%s'", $this->locale))
            ->get();

        if (!$result) {
            return;
        }
        $result = $result->result_array();

        foreach ($result as $brandData) {
            $this->brandIdsToNames[$brandData['id']] = $brandData['name'];
        }
    }

    /**
     * Отримання ід бренду по його назві.
     * Даний метод викликається із Products
     * Якщо бренд не існує, то він буде створений (правда це трошки трошки не продуктивно,
     * бо краще було б зв’язувати по exId, але це буде не універсально, бо зараз
     * бренд ід береться із властивостей - шоби не рухати більше ніж треба коду в модулі)
     * @param type $brandName
     * @return null|int
     */
    public function getBrandIdByName($brandName) {
        if (!is_string($brandName) || !isset($brandName[0])) {
            return null;
        }

        $brandName = trim($brandName);
        $brandId = array_search($brandName, $this->brandIdsToNames);
        if (false != $brandId && is_numeric($brandId)) {
            return $brandId;
        }

        // creating brand
        $this->db->insert(
            'shop_brands',
            [
            'url' => translit_url($brandName),
            'created' => time(),
            'updated' => time(),
                ]
        );

        if ($this->db->_error_message()) {
            return null;
        }

        $brandId = $this->db->insert_id();

        $this->db->insert(
            'shop_brands_i18n',
            [
            'id' => $brandId,
            'locale' => $this->locale,
            'name' => $brandName
                ]
        );

        if ($this->db->_error_message()) {
            $this->db->delete('shop_brands', ['id' => $brandId], 1);
            return null;
        }

        $this->brandIdsToNames[$brandId] = $brandName;

        return $brandId;
    }

    public function getBrandIdByExId($externalId = NULL) {
        if ($externalId == NULL) {
            return $this->brands;
        }

        if (array_key_exists($externalId, $this->brands)) {
            return $this->brands[$externalId];
        }

        return FALSE;
    }

    /**
     * Returns property identificator of brand
     * @return string
     */
    public function getBrandIdentif() {
        return $this->brandIdentif;
    }

    /**
     * Parsing properties. Separation on new and existing.
     * Preparing arrays (insert & update) for db
     */
    protected function processProperties() {
        foreach ($this->importData as $property) {
            $propertyData = [];
            $externalId = (string) $property->Ид;
            $name = (string) $property->Наименование;

            if ($name == $this->brandIdentif & $this->brandIdentif !== NULL) {
                $this->brandIdentif = $externalId;
            }

            $propertyData = [
                'external_id' => $externalId,
            ];

            $this->propertiesData[$externalId]['name'] = $name;

            $propertyData['csv_name'] = str_replace(["-", "_", "'"], '', translit_url($property->Наименование));

            // type ("Справочник"|"Число")
            $type = (string) $property->ТипЗначений == 'Справочник' ? self::PROPTYPE_SPR : self::PROPTYPE_NUM;
            $this->propertiesData[$externalId]['type'] = $type;

            if ($type == self::PROPTYPE_SPR) {
                // getting all possible values
                $values = [];
                foreach ($property->ВариантыЗначений->Справочник as $propValue) {
                    $values[(string) $propValue->ИдЗначения] = (string) $propValue->Значение;
                }
                $this->dictionaryProperties[$externalId] = $values;

                if ($this->brandIdentif == $externalId) {
                    $this->brands = $values;
                }
            }

            // main_property
            $propertyData['main_property'] = (string) $property->Обязательное == 'true' ? 1 : 0;

            // cheking if property is "multivalue"
            if ((string) $property->Множественное == 'true' || $type == self::PROPTYPE_SPR) {
                $propertyData['multiple'] = 1;
            } else {
                $propertyData['multiple'] = 0;
            }

            // status of property (active or disabled)
            $active = (string) $property->ИспользованиеСвойства == 'true' ? TRUE : FALSE;
            if ($active == TRUE || count($property->ИспользованиеСвойства) == 0) {
                $propertyData['active'] = 1;
            } else {
                $propertyData['active'] = 0;
            }

            // separation on new and existing
            if (!$this->propertyExists($externalId)) {
                // adding default property values
                $propertyData = array_merge(
                    $propertyData,
                    [
                    'show_in_compare' => 0,
                    'show_on_site' => 1,
                    'show_in_filter' => 0
                        ]
                );
                $this->new[$externalId] = $propertyData;
            } else {
                $this->existing[$externalId] = $propertyData;
            }
        }
    }

    /**
     *
     */
    protected function insert() {
        $this->insertBatch('shop_product_properties', $this->new);
        // getting updated data from DB
        $this->dataLoad->getNewData('properties');

        // preparing data for `i18n` and `mod_exchange`
        $i18n = $this->makei18n('new');

        $this->insertBatch('shop_product_properties_i18n', $i18n);
    }

    /**
     * Inserting new brands,
     * forming array with all new brands
     */
    protected function insertBrands() {
        // getting existing brands
        $result = $this->db
            ->select(['id', 'name'])
            ->get('shop_brands_i18n')
            ->result_array();

        $existingBrands = [];
        foreach ($result as $brandData) {
            $existingBrands[strtolower($brandData['name'])] = $brandData['id'];
        }

        // inserting new brands
        $newBrands = [];
        $referensForI18n = [];
        foreach ($this->brands as $externalId => $brandName) {
            $name_ = strtolower($brandName);
            if (array_key_exists($name_, $existingBrands)) { // brand exist
                $this->brands[$externalId] = $existingBrands[$name_];
            } else {
                $url = translit_url($brandName);
                $referensForI18n[$url] = $externalId;
                $newBrands[] = ['url' => $url];
            }
        }

        // those witch will be needed for products
        if (count($newBrands) > 0) {
            $this->insertBatch('shop_brands', $newBrands);
            $result = $this->db
                ->select(['id', 'url'])
                ->get('shop_brands')
                ->result_array();

            $newBrandsI18n = [];
            foreach ($result as $brandData) {
                if (array_key_exists($brandData['url'], $referensForI18n)) {
                    $newBrandsI18n[] = [
                        'id' => $brandData['id'],
                        'name' => $this->brands[$referensForI18n[$brandData['url']]],
                        'locale' => $this->locale
                    ];
                    $this->brands[$referensForI18n[$brandData['url']]] = $brandData['id'];
                }
            }

            $this->insertBatch('shop_brands_i18n', $newBrandsI18n);
        }
    }

    /**
     *
     */
    protected function update() {
        $this->updateBatch('shop_product_properties', $this->existing, 'external_id');
        // preparing data for `i18n` and `mod_exchange`
        // preparing data for `i18n`
        $i18n = $this->makei18n();

        $this->updateBatch('shop_product_properties_i18n', $i18n, 'id');
        //$this->updateBatch('mod_exchange', $modExchange, 'external_id');
    }

    /**
     * Checks if property exists by external id
     * @param string $externalId
     * @return boolean
     */
    protected function propertyExists($externalId) {
        foreach ($this->properties as $propertyData) {
            if ($propertyData['external_id'] == $externalId) {
                return TRUE;
            }
        }
        return FALSE;
    }

    private function makei18n($type = 'existing') {
        $i18n = [];
        $modExchange = [];
        foreach ($this->properties as $propertyData) {
            $exId = $propertyData['external_id'];
            if (array_key_exists($exId, $this->$type)) {
                $arr = [];
                if (!empty($this->dictionaryProperties[$exId])) {
                    foreach ($this->dictionaryProperties[$exId] as $value) {
                        $arr[] = trim($value);
                    }
                    $data = serialize($arr);
                } else {
                    $data = '';
                }

                $i18n[] = [
                    'id' => $propertyData['id'],
                    'name' => $this->propertiesData[$exId]['name'],
                    'locale' => $this->locale,
                    'data' => $data,
                ];

                // gathering property possible values, if type = "Справочник"
                if ($this->propertiesData[$exId]['type'] == self::PROPTYPE_SPR) {
                    foreach ($this->dictionaryProperties[$exId] as $valueExternalId => $value) {
                        $modExchange[] = [
                            'external_id' => $valueExternalId,
                            'property_id' => $propertyData['id'],
                            'value' => $value,
                        ];
                    }
                }
            }
        }
        return $i18n;
    }

}
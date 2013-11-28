<?php

/**
 * Class to generate properties forms.
 *
 * @package Shop
 * @version $id$
 * @author <dev@imagecms.net>
 */
class SPropertiesRenderer {

    public $inputsName = 'productProperties';
    public $noValueText = '- none -';
    public $useMultipleSelect = false;
    protected $properties = null;
    protected $productModel = null;
    protected $propertiesData = array();

    public function __construct() {
        ShopCore::$ci->load->helper('form');
    }

    /**
     * Render properties form for admin panel. Used in create/edit products.
     *
     * @param mixed $categoryId Category Id
     * @access public
     * @return string
     */
    public function renderAdmin($categoryId, $productModel = null, $locale = 'ru') {
        $categoryModel = SCategoryQuery::create()->findPk((int) $categoryId);
        if ($categoryModel === null)
            return false;
        $properties = SPropertiesQuery::create()->joinWithI18n($locale)->filterByPropertyCategory($categoryModel)->orderByPosition()->find();
        if (sizeof($properties) == 0)
            return false;
        if ($productModel instanceof SProducts) {
            $this->productModel = $productModel;
            $this->loadAdminPropertiesData($locale);
        }
        $resultHtml = '';
        $i = 0;
        foreach ($properties as $property) {
            if ($property->getActive() === TRUE) {
                $resultHtml .='
                <div class="control-group">
                <label class="control-label" for="num_' . $i++ . '">' . ShopCore::encode($property->getName()) . ':</label>
                <div class="controls">' . $this->_renderInput($property, $i, $locale) . '</div>
                                                    </div>';
            }
        }
        return $resultHtml;
    }

    protected function _renderInput(SProperties $property, $i, $locale) {
        $data = $property->asArray($locale);
        $name = $this->inputsName . '[' . $property->getId() . ']';

// Render select
        if (sizeof($data) > 0) {
            array_unshift($data, $this->noValueText);
            $data = array_combine($data, $data);
            $data[''] = $data[$this->noValueText];
            unset($data[$this->noValueText]);
            ksort($data);


            if ($property->getMultiple() === true) {
                $multiple = 'multiple';
                $name .= '[]';
            }
            else
                $multiple = null;
            return form_dropdown($name, $data, $this->_getProductPropertyValue($property->getId()), $multiple);
        }
        else {
            $i--;
            $inputData = array('name' => $name, 'value' => $this->_getProductPropertyValue($property->getId()), 'id' => 'num_' . $i,);
            return form_input($inputData);
        }
    }

    /**
     * Сombines array of the properties with identifier as the key and the properties object as a value.<br/>
     * Recommend to use only for the administrative part of the site.
     *
     * @access protected
     * @return array
     * @author DevImageCMS <dev@imagecms.net>
     * @copyright Copyright (c) 2012, DevImageCMS
     */
    protected function loadAdminPropertiesData($locale = 'ru') {
        $this->propertiesData = array();
        $propertiesDatas = SProductPropertiesDataQuery::create()->filterByLocale($locale)->filterByProductId($this->productModel->Id)->find();
        if (count($propertiesDatas))
            foreach ($propertiesDatas as $p)
                $this->propertiesData[$p->getPropertyId()][] = $p;
    }

//    protected function _loadProductPropertiesDataCompare() {
//        // Clear current properties
//        $this->propertiesData = null;
//
//        if ($this->productModel === null)
//            return false;
//
//        $propertiesDatas = SPropertiesQuery::create()
//                ->leftJoin('SProductPropertiesData')
//                ->joinWithI18n(MY_Controller::getCurrentLocale(), Criteria::LEFT_JOIN)
//                ->where('SProductPropertiesData.ProductId = ?', $this->productModel->Id)
//                ->find();
//
//        if (sizeof($propertiesDatas) > 0) {
//            foreach ($propertiesDatas as $p) {
//                $propertyData = $p->getSProductPropertiesDatas();
//                $this->propertiesData[$propertyData[0]->getPropertyId()][] = $propertyData[0];
//            }
//        } else {
//            $this->propertiesData = array();
//        }
//    }

    protected function _loadProductPropertiesData($locale = null, $forsed = false) {
        $this->propertiesData = null;

        if ($this->productModel === null)
            return false;

        $propertiesDatas = SPropertiesQuery::create()
                ->filterByShowInCompare(true)
//                ->orderByPosition()
                ->orderByPosition(Criteria::ASC)
                ->useSProductPropertiesDataQuery()
                ->filterByLocale(MY_Controller::getCurrentLocale())
                ->filterByProductId($this->productModel->id)
                ->endUse()
                ->joinWithI18n()
                ->distinct()
                ->find();

        if (sizeof($propertiesDatas) > 0) {
            foreach ($propertiesDatas as $p) {
                $propertyData = $p->getSProductPropertiesDatas();
                foreach ($propertyData as $k => $v) {
                    if ($v->getProductId() == $this->productModel->id) {
                        $this->propertiesData[$propertyData[$k]->getPropertyId()][] = $v;
                    }
                }
            }
        } else {
            $this->propertiesData = array();
        }
    }

    protected function _loadProductPropertiesDataNew($locale = null, $forsed = false) {
        if ($locale == null)
            $locale = MY_Controller::getCurrentLocale();
        $this->propertiesData = null;
        $result = ShopCore::$ci->db->query("SELECT * FROM `shop_product_properties_data` JOIN `shop_product_properties` ON shop_product_properties_data.property_id=shop_product_properties.id JOIN `shop_product_properties_i18n` ON shop_product_properties_data.property_id=shop_product_properties_i18n.id WHERE shop_product_properties_data.locale='" . $locale . "' AND shop_product_properties_i18n.locale='" . $locale . "' AND shop_product_properties.show_on_site AND shop_product_properties_data.product_id=" . $this->productId . " GROUP BY shop_product_properties_data.property_id ORDER BY shop_product_properties.position")->result();
        foreach ($result as $key => $value)
            $result[$key]->values = ShopCore::$ci->db->query("SELECT `value` FROM `shop_product_properties_data` WHERE `product_id`=" . $value->product_id . " AND `locale`='" . $locale . "' AND `property_id`=" . $value->property_id)->result();
        return $result;
    }

    protected function _getProductPropertyValue($propertyId) {
        if ($this->propertiesData[$propertyId]) {
            $property = $this->propertiesData[$propertyId];

            if ($this->propertiesData[$propertyId][0]->SProperties->getMultiple()) {
                $data = array();

                foreach ($property as $key => $val)
                    $data[] = $val->getValue();
                //return array_map('encode', $data);
                return $data;
            } else {
                return $property[0]->getValue();
            }
        } else {
            return ShopCore::$_GET['productProperties'][$propertyId];
        }

        return null;
    }

    /**
     * Render table containing product properties data.
     *
     * @param Product ID $productId
     * @access public
     * @return mixed string or null.
     */
    public function renderPropertiesTableNew($productId) {
        $this->productId = $productId;
        $properties = $this->_loadProductPropertiesDataNew();

        if (sizeof($properties) > 0) {
            $table = ShopCore::$ci->load->library('table', TRUE);
            $table->set_template(array(
                'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="characteristic">'
            ));
            $returnString = "";
            foreach ($properties as $k => $v) {
                if ($v->value == Null)
                    continue;
                $returnString .= ShopCore::encode($v->name);
                if (empty($v->values)) {
                    $returnString .= ShopCore::encode($v->value);
                } else {
                    $ppSt = "";
                    foreach ($v->values as $key => $value) {
                        $ppSt .= htmlspecialchars_decode($value->value);
                        if (count($v->values) - 1 > $key)
                            $ppSt .= ", ";
                    }
                    if ($v->active) {
                        $table->add_row($v->name, $ppSt);
                    }
                    $returnString .= $ppSt;
                }
            }
            return $table->generate();
        }
        return FALSE;
    }

    /**
     * Render table containing product properties data.
     *
     * @param SProducts $product
     * @access public
     * @return mixed string or null.
     */
    public function renderPropertiesTable(SProducts $product) {

        $this->productModel = $product;
        $this->_loadProductPropertiesData();

        if (sizeof($this->propertiesData) > 0) {
            $table = ShopCore::$ci->load->library('table', TRUE);
            $table->set_template(array(
                'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="characteristic">'
            ));
            foreach ($this->propertiesData as $property) {
                if ($property[0]->getSProperties()->getActive() === TRUE && $property[0]->getSProperties()->getShowOnSite() === TRUE) {
                    if ($property[0]->SProperties->getMultiple()) {
                        $data = array();
                        foreach ($property as $key => $val)
                            $data[] = $val->getValue();

                        $data = array_reverse($data);
                        $value = implode(', ', $data);
                    }
                    else
                        $value = $property[0]->getValue();

                    $table->add_row($property[0]->getSProperties()->getName(), $value);
                }
            }

            return $table->generate();
        }

        return null;
    }

    public function renderPropertiesArray(SProducts $product) {
         $property = SPropertiesQuery::create()
                ->joinSProductPropertiesData()
                ->joinWithI18n(MY_Controller::getCurrentLocale())
                ->where('SProductPropertiesData.ProductId = ?', $product->getId())
                ->where('SProductPropertiesData.Locale = ?', MY_Controller::getCurrentLocale())
                ->select(array('Id', 'ShowInCompare', 'ShowInFilter', 'ShowOnSite', 'ShowInFilter', 'MainProperty', 'SPropertiesI18n.Name', 'SPropertiesI18n.Description'))
                ->groupBy('SProductPropertiesData.PropertyId')
                ->orderByPosition()->find()->toArray();

        $arr_res = array();
        foreach ($property as $prop) {
            if ($prop['ShowOnSite']){
                $arr_aux = $prop;
                $arr_aux['Name'] = $prop['SPropertiesI18n.Name'];
                $arr_aux['Desc'] = $prop['SPropertiesI18n.Description'];
                unset($arr_aux['SPropertiesI18n.Name']);
                unset($arr_aux['SPropertiesI18n.Description']);


                $arr_aux_value = SProductPropertiesDataQuery::create()->filterByLocale(MY_Controller::getCurrentLocale())
                                ->filterByProductId($product->getId())
                                ->filterByPropertyId($prop['Id'])
                                ->select(array('Value'))->find()->toArray();

                $str_prop = '';
                foreach ($arr_aux_value as $val)
                    $str_prop .=  ' ' . $val . ',';

                 $arr_aux['Value'] = ltrim(rtrim($str_prop, ','),' ');


                $arr_res[] = $arr_aux;
            }
        }

        return $arr_res;
//        $result = array();
//        $this->productModel = $product;
//        $this->_loadProductPropertiesData();
//
//        if (sizeof($this->propertiesData) > 0) {
//            foreach ($this->propertiesData as $property) {
//                $result[ShopCore::encode($property[0]->getSProperties()->getName())] = ShopCore::encode($property[0]->getValue());
//            }
//
//            return $result;
//        }
//
//        return array();
    }

    public function renderProductsProperties(PropelObjectCollection $product) {
        $propertiesData = null;

        $propertiesDatas = SPropertiesQuery::create()
                ->useSProductPropertiesDataQuery()
                ->filterByProduct($product)
                ->endUse()
                ->distinct()
                ->joinWithI18n(MY_Controller::getCurrentLocale(), Criteria::LEFT_JOIN)
                ->find();

        foreach ($propertiesDatas as $key => $value) {
            foreach ($product as $p) {
                $prp = SProductPropertiesDataQuery::create()->filterByProductId($p->getId())->filterByPropertyId($value->id)->findOne();
                $temp[$p->id][$value->name] = $prp->value;
            }
        }
        return $temp;
        exit;


        $result = array();
        $this->productModel = $product;
        $this->_loadProductPropertiesData();

        if (sizeof($this->propertiesData) > 0) {
            foreach ($this->propertiesData as $property) {
                $result[ShopCore::encode($property[0]->getSProperties()->getName())] = ShopCore::encode($property[0]->getValue());
            }

            return $result;
        }

        return array();
    }

    public function renderPropertiesInline(SProducts $product) {
        $this->productModel = $product;
        $this->_loadProductPropertiesData();

        $result = '';
        if (sizeof($this->propertiesData) > 0) {
            foreach ($this->propertiesData as $property) {
                if (SProductPropertiesDataQuery::create()
                                ->filterByProductId($product->getId())
                                ->select('Value')
                                ->filterByPropertyId($property[0]->getPropertyId())->findOne() != null)
                    $result .= ShopCore::encode($property[0]->getSProperties()->getName()) . ' ' . ShopCore::encode(SProductPropertiesDataQuery::create()->filterByProductId($product->getId())->select('Value')->filterByPropertyId($property[0]->getPropertyId())->findOne()) . ' / ';
            }
            if (!empty($result))
                return substr($result, 0, -2);
        }

        return FALSE;
    }

    public function renderPropertiesInlineHead(SProducts $product) {
        $this->productModel = $product;
        $this->_loadProductPropertiesData();

        $result = '';
        if (sizeof($this->propertiesData) > 0) {
            foreach ($this->propertiesData as $property) {
                if (SProductPropertiesDataQuery::create()
                                ->filterByProductId($product->getId())
                                ->select('Value')
                                ->filterByPropertyId($property[0]->getPropertyId())->findOne() != null)
                    $result .= ShopCore::encode($property[0]->getSProperties()->getName()) . ' ' . ShopCore::encode(SProductPropertiesDataQuery::create()->filterByProductId($product->getId())->select('Value')->filterByPropertyId($property[0]->getPropertyId())->findOne()) . ' / ';
            }
            if (!empty($result))
                return substr($result, 0, -2);
        }

        return FALSE;
    }

    public function renderPropertiesInlineNew($productId) {
        $this->productId = $productId;
        $properties = $this->_loadProductPropertiesDataNew();

        if (sizeof($properties) > 0) {
            $returnString = "";
            foreach ($properties as $k => $v) {
                if ($v->value == Null)
                    continue;
                $returnString .= "<td>";
                if (empty($v->values)) {
                    $returnString .= ShopCore::encode($v->value);
                } else {
                    $ppSt = "";
                    foreach ($v->values as $key => $value) {

                        //$ppSt .= ShopCore::encode($value->value);
                        $ppSt .= htmlspecialchars_decode($value->value);
                        if (count($v->values) - 1 > $key)
                            $ppSt .= ", ";
                        elseif (count($properties) - 1 > $k)
                            $ppSt .= "";
                    }
                    $returnString .= $ppSt;
                    $returnString .= "</td>";
                }
            }
            return $returnString;
        }
        return FALSE;
    }

    public function renderPropertiesInlineNewHead($productId) {
        $this->productId = $productId;
        $properties = $this->_loadProductPropertiesDataNew();

        if (sizeof($properties) > 0) {
            $returnString = "";
            foreach ($properties as $k => $v) {
                if ($v->value == Null)
                    continue;
                $returnString .= "<th>";
                if (empty($v->values)) {
                    $returnString .= ShopCore::encode($v->value);
                } else {
                    $ppSt = "";
                    foreach ($v->values as $key => $value) {

                        //$ppSt .= ShopCore::encode($value->value);
                        $ppSt .= htmlspecialchars_decode($v->name);
                        if (count($v->values) - 1 > $key)
                            $ppSt .= ", ";
                        elseif (count($properties) - 1 > $k)
                            $ppSt .= "";
                    }
                    $returnString .= $ppSt;
                    $returnString .= "</th>";
                }
            }
            return $returnString;
        }
        return FALSE;
    }


    public function renderPropertiesArrayProd(SProducts $product) {
        $result = array();
        $this->productModel = $product;
        $this->_loadProductPropertiesDataCompare();

        if (sizeof($this->propertiesData) > 0) {
            foreach ($this->propertiesData as $property) {
                $name = ShopCore::encode($property[0]->getSProperties()->getCsvName());
                $result[$name]['title'] = ShopCore::encode($property[0]->getSProperties()->getName());
                $result[$name]['value'] = ShopCore::encode($property[0]->getValue());
            }
            return $result;
        }
        return FALSE;
    }

    public function renderPropertiesArrayProd1(SProducts $product) {
        $result = array();
        $this->productModel = $product;
        $this->_loadProductPropertiesDataCompare();

        if (sizeof($this->propertiesData) > 0) {

            return $this->propertiesData;
        }

        return array();
    }

    public function renderCategoryPropertiesArray($categoryId) {
        $categoryModel = SCategoryQuery::create()
                ->findPk((int) $categoryId);



        if ($categoryModel === null)
            return false;
        $properties = SPropertiesQuery::create()
                ->joinWithI18n(MY_Controller::getCurrentLocale(), Criteria::LEFT_JOIN)
                ->filterByActive(true)
                ->filterByShowInCompare(true)
                ->filterByPropertyCategory($categoryModel)
                ->select('SPropertiesI18n.Name')
                ->find()
                ->toArray();

        if (sizeof($properties) == 0)
            return false;

        return $properties;
    }

    public function renderPropertiesCompareArray(SProducts $product) {
        $result = array();
        $this->productModel = $product;
        $this->_loadProductPropertiesDataCompare();
        if (sizeof($this->propertiesData) > 0) {
            foreach ($this->propertiesData as $key => $property) {
                if (count($property) > 1) {
                    foreach ($property as $p) {
                        $result[ShopCore::encode($p->getSProperties()->getName())][] = ShopCore::encode($p->getValue());
                    }
                } else {
                    if ($property[0]->getSProperties()->getShowInCompare() === TRUE) {
                        $result[ShopCore::encode($property[0]->getSProperties()->getName())] = ShopCore::encode($property[0]->getValue());
                    }
                }
            }
            return $result;
        }
        return array();
    }

    protected function _loadProductPropertiesDataCompare() {
        // Clear current properties
        $this->propertiesData = null;

        if ($this->productModel === null)
            return false;

        $propertiesDatas = SPropertiesQuery::create()
                ->filterByShowInCompare(true)
                ->useSProductPropertiesDataQuery()
                ->filterByLocale(MY_Controller::getCurrentLocale())
                ->filterByProductId($this->productModel->id)
                ->endUse()
                ->joinWithI18n()
                ->distinct()
                ->find();

        if (sizeof($propertiesDatas) > 0) {
            foreach ($propertiesDatas as $p) {
                $propertyData = $p->getSProductPropertiesDatas();
                foreach ($propertyData as $k => $v) {
                    if ($v->getProductId() == $this->productModel->id) {
                        $this->propertiesData[$propertyData[$k]->getPropertyId()][] = $v;
                    }
                }
            }
        } else {
            $this->propertiesData = array();
        }
    }

    /**
     *
     *
     * Function to get property value according to property id
     * SProducts object and additional option to display property value as string
     * if product has a several values this property
     *
     *
     * @package Shop
     * @version $id$
     * @author <avgustus@yandex.ru>
     */
    public function getOneProperty($id = null, SProducts $product = null, $asString = false) {
        $locale = MY_Controller::getCurrentLocale();
        if ($id == null)
            return false;
        if ($product == null)
            return false;
        $productsId = $product->getId();
        $CI = & get_instance();
        $propertyName = $CI->db->query('SELECT `name` FROM `shop_product_properties_i18n` WHERE `locale`="' . $locale . '" AND `id`=' . $id)->row_array();
        if (!empty($propertyName)) {
            $value = $CI->db->query('SELECT `value` FROM `shop_product_properties_data` WHERE `locale`="' . $locale . '" AND `product_id`=' . $productsId . ' AND `property_id`=' . $id)->result_array();
            if (count($value) > 0) {
                foreach ($value as $key => $val) {
                    $result[$propertyName['name']][] = $val['value'];
                }
                if (count($value) > 1 && $asString == true) {
                    foreach ($value as $key => $val) {
                        $string .= $val['value'];
                        if (count($value) - 1 > $key)
                            $string .= " , ";
                    }
                    $result[$propertyName['name']] = $string;
                }
            }
        } else {
            return "Названия свойства с таким ID не найдено";
        }
        return $result;
    }

}


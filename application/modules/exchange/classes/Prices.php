<?php

namespace exchange\classes;

use CMSFactory\ModuleSettings;

/**
 *
 *
 * @author kolia
 */
class Prices extends ExchangeBase
{

    protected function import_() {
        $data = [];
        $i = 0;

        $purchasePriceId = false;
        $mainPriceId = false;
        $purchasePrice = false;
        $mainPrice = false;
        foreach ($this->xml->ПакетПредложений->ТипыЦен->ТипЦены as $type) {
            (string) $type->Наименование == "Закупочная" && $purchasePriceId = (string) $type->Ид;
            (string) $type->Наименование == "Розничная" && $mainPriceId = (string) $type->Ид;
        }

        foreach ($this->importData as $offer) {

            foreach ($offer->Цены->Цена as $one) {
                ((string) $one->ИдТипаЦены === $purchasePriceId) && $purchasePrice = str_replace(',', '.', (string) $one->ЦенаЗаЕдиницу);
                ((string) $one->ИдТипаЦены === $mainPriceId) && $mainPrice = str_replace(',', '.', (string) $one->ЦенаЗаЕдиницу);
            }
            $price = $mainPrice ? : str_replace(',', '.', (string) $mainPrice ? : (string) $offer->Цены->Цена->ЦенаЗаЕдиницу);
            $data[$i]['price'] = $price;
            $data[$i]['price_in_main'] = $price;
            if (ModuleSettings::ofModule('exchange')->get('purchcePriceFieldId') && $purchasePrice) {
                $this->setPurchacePrice((string) $offer->Ид, $purchasePrice);
            }

            if (property_exists($offer, 'Количество')) {
                $data[$i]['stock'] = (int) $offer->Количество;
            }

            $data[$i]['external_id'] = (string) $offer->Ид;

            $i++;
        }

        $this->updateBatch('shop_product_variants', $data, 'external_id');
    }

    /**
     * @param string $externalId
     * @param string $purchasePrice
     */
    protected function setPurchacePrice($externalId, $purchasePrice) {
        $fieldId = ModuleSettings::ofModule('exchange')->get('purchcePriceFieldId');
        $product = \SProductsQuery::create()->findOneByExternalId($externalId);
        if ($product) {
            $productId = $product->getId();
            $cf = \CustomFieldsDataQuery::create()->filterByentityId($productId)->filterByfieldId($fieldId)->findOne();

            if (!$cf) {
                $cf = new \CustomFieldsData();
                $cf->setfieldId($fieldId);
                $cf->setentityId($productId);
                $cf->setLocale(\MY_Controller::defaultLocale());
            }
            $cf && $cf->setdata($purchasePrice)->save();
        }
    }

}
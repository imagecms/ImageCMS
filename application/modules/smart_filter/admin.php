<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use CMSFactory\assetManager as AssetManager;

class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        (new MY_Lang())->load('smart_filter');
        $this->load->model('module_managment');
    }

    public function index() {
        AssetManager::create()->renderAdmin('nothing_here');
    }

    public function ajaxGetBrands($categoryId, $locale) {
        $locale = $locale ? $locale : MY_Controller::defaultLocale();
        if (!$categoryId) {
            echo '';
        }

        $brands = $this->module_managment->getBrandsByCategoryId($categoryId, $locale);

        if ($brands) {
            $template = \CMSFactory\assetManager::create()
                ->setData(
                    [
                    'brands' => $brands
                    ]
                )
                ->fetchAdminTemplate('physical_pages/brands_select');
            preg_match_all('/<option.*<\/option>/', $template, $matches);

            $template = $matches[0] ? implode('', $matches[0]) : '';
            echo $template;
        }
        echo '';
    }

    public function ajaxGetProperties($categoryId, $locale) {
        $locale = $locale ? $locale : MY_Controller::defaultLocale();
        if (!$categoryId) {
            echo '';
        }

        $properties = $this->module_managment->getPropertiesByCategoryId($categoryId, $locale);

        if ($properties) {
            $template = \CMSFactory\assetManager::create()
                ->setData(
                    [
                    'properties' => $properties
                    ]
                )
                ->fetchAdminTemplate('physical_pages/properties_select');
            preg_match_all('/<option.*<\/option>/', $template, $matches);

            $template = $matches[0] ? implode('', $matches[0]) : '';
            echo $template;
        }
        echo '';
    }

    public function savePhysicalPages() {
        $data = $this->input->post('smart_filter');

        if (!$data) {
            return false;
        }

        if ($data['entity_id']) {
            if (!$data['id']) {
                $id = $this->module_managment->create($data);
            } else {
                $id = $data['id'];
                $locale = $data['locale'];
                unset($data['id']);
                unset($data['locale']);
                $this->module_managment->update($id, $locale, $data);
            }
        }

        if ($id) {
            $success = true;
            $message = lang('Successfully saved', 'smart_filter');
        } else {
            $success = false;
            $message = lang('Can not save', 'smart_filter');
        }

        return json_encode(['success' => $success, 'message' => $message, 'data' => ['id' => $id]]);
    }

    public function saveMulti() {
        $data = $this->input->post('smart_filter');

        $emptyRequest = $data['h1'] . $data['meta_title'] . $data['meta_keywords'] . $data['seo_text'] . $data['meta_description'];
        if (!$emptyRequest) {
            return json_encode(['error' => true, 'message' => lang('At least one field must be filed', 'smart_filter')]);
        }

        $data['brands'] = array_filter($data['brands']);
        $data['properties'] = array_filter($data['properties']);
        $brands = array_search('all', $data['brands']) === false ? $data['brands'] : $this->module_managment->getBrandsByCategoryId($data['category'], $data['locale']);
        $properties = array_search('all', $data['properties']) === false ? $data['properties'] : $this->module_managment->getPropertiesByCategoryId($data['category'], $data['locale']);
        $links = $this->module_managment->get($data['locale']);

        $linksInDB = [];
        foreach ($links as $link) {
            $linksInDB["{$link['type']}_{$link['category_id']}_{$link['entity_id']}_{$link['locale']}"] = $link;
        }

        $toInsert = [];
        foreach ($brands as $brand) {
            $brandId = !is_array($brand) ? $brand : $brand['id'];
            if (!$linksInDB["brand_{$data['category']}_{$brandId}_{$data['locale']}"]) {
                $toInsert[] = $this->setInsertData($brandId, 'brand', $data);
            }
        }

        foreach ($properties as $property) {
            $propertyId = !is_array($property) ? $property : $property['property_id'];
            if (!$linksInDB["property_{$data['category']}_{$propertyId}_{$data['locale']}"]) {
                $toInsert[] = $this->setInsertData($propertyId, 'property', $data);
            }
        }

        if ($this->module_managment->saveBatch($toInsert)) {
            return json_encode(['success' => true, 'message' => lang('Successfully saved', 'smart_filter')]);
        } else {
            return json_encode(['error' => true, 'message' => lang('Can not save', 'smart_filter')]);
        }
    }

    private function setInsertData($entityId, $type, $data) {
        return [
            'locale' => $data['locale'],
            'type' => $type,
            'category_id' => (int) $data['category'],
            'entity_id' => (int) $entityId,
            'active' => (int) $data['active'],
            'h1' => $data['h1'],
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
            'meta_keywords' => $data['meta_keywords'],
            'seo_text' => $data['seo_text'],
            'created' => time(),
            'updated' => time(),
        ];
    }

    public function ajaxGetLinkData() {
        $id = $this->input->post('id');
        $locale = $this->input->post('locale');

        return json_encode(['data' => $this->module_managment->get($locale, $id)]);
    }

    public function deleteLink() {
        $id = $this->input->post('id');
        $locale = $this->input->post('locale');

        return $this->module_managment->delete($id, $locale);
    }

}
<?php

namespace exchange\classes;

use CMSFactory\ModuleSettings;

/**
 *
 *
 *
 * @author kolia
 */
final class Categories extends ExchangeBase
{

    /**
     * Parsed categories from XML to one-dimention array
     * @var array
     */
    private $categoriesXml = [];

    /**
     *
     * @var array
     */
    private $new = [];

    /**
     *
     * @var array
     */
    private $existing = [];

    /**
     *
     */
    private $externalIds;

    /**
     *
     * @var array
     */
    private $categoriesNames = [];

    /**
     * Creates one-dimention array with categories from XML-file
     * (method is filling  $categories, $new and $existing arrays of class instance)
     * @param \SimpleXMLElement $categories
     * @param string $parent (default null) external id of parent if there is
     */
    private function processCategories(\SimpleXMLElement $categories, $parent = NULL) {
        foreach ($categories as $category) {
            $externalId = (string) $category->Ид;

            // splitting on those which need to be updated and new (by external id)
            if (FALSE == $this->categoryExists($externalId)) {
                $this->new[] = $externalId;
                $name = $this->getCategoryName((string) $category->Наименование);
            } else {
                $this->existing[] = $externalId;
                $name = (string) $category->Наименование;
            }

            $this->categoriesXml[$externalId] = [
                'name' => $name,
                'active' => (string) $category->Статус == 'Удален' ? 0 : 1,
                'external_id' => $externalId,
                'parent_external_id' => $parent === null ? 0 : $parent
            ];

            if (isset($category->Группы)) {
                $this->processCategories($category->Группы->Группа, $externalId);
            }
        }

    }

    /**
     * @param string $name
     */
    private function getCategoryName($name) {
        $nameTemp = $name;
        $i = 1;
        while (in_array($nameTemp, $this->categoriesNames)) {
            $nameTemp = $name . ' ' . $i++;
        }
        array_push($this->categoriesNames, $nameTemp);
        return $nameTemp;
    }

    /**
     * Starting import of the categories
     * @return boolean|array FALSE|array(count of inserted, count of deleted)
     */
    protected function import_() {
        // getting categories names for checking fr unique names
        $categoriesI18n = $this->db
            ->where('locale', \MY_Controller::getCurrentLocale())
            ->get('shop_category_i18n')
            ->result_array();

        foreach ($categoriesI18n as $category) {
            array_push($this->categoriesNames, $category['name']);
        }
        // creating one-dimention array of categories
        $this->processCategories($this->importData);

        // inserting
        $insertCount = count($this->new);
        if ($insertCount > 0) {
            $dbArray = $this->getPreparedData($this->new);
            $this->insertBatch('shop_category', $dbArray);
            $this->dataLoad->getNewData('categories');
            $i18nData = $this->geti18nData($this->new);
            $this->insertBatch('shop_category_i18n', $i18nData);
        }

        $ignoreExisting = ModuleSettings::ofModule('exchange')->get('ignore_existing');
        // updating
        $updateCount = count($this->existing);
        if ($updateCount > 0 && !isset($ignoreExisting['categories'])) {
            $dbArray = $this->getPreparedData($this->existing);
            $this->updateBatch('shop_category', $dbArray, 'external_id');
            $this->dataLoad->getNewData('categories');
            $i18nData = $this->geti18nData($this->existing);
            $this->updateBatch('shop_category_i18n', $i18nData, 'id');
        }

        $pathsAndParents = $this->getPathsAndParents();
        $this->updateBatch('shop_category', $pathsAndParents, 'id');
        $this->dataLoad->getNewData('categories');
    }

    /**
     * Prepare array for DB insert/update query
     * (returns array redy to inserting in database)
     * @param array $categoriesExternalIds
     */
    private function getPreparedData(array $categoriesExternalIds) {
        $dbArray = [];
        foreach ($categoriesExternalIds as $externalId) {
            // fitment of category url (might be busy)
            $url = translit_url($this->categoriesXml[$externalId]['name']);
            // preparing array for insert
            $dbArray[] = [
                'external_id' => $externalId,
                'url' => $url,
                'active' => $this->categoriesXml[$externalId]['active'],
            ];
        }
        return $dbArray;
    }

    /**
     * Filling parent ids of
     * @return boolean
     */
    private function getPathsAndParents() {
        $categoriesExternalIds = array_merge($this->new, $this->existing);
        // UPDATING INSERTED CATEGORIES (add parent ids & full path)
        $this->dataLoad->getNewData('categories'); // getting dategories form db again
        // getting only categories which was inserted
        $categories = [];
        // "parent data" is in $this->categories (db),
        foreach ($this->categories as $categoryId => $categoryData) {
            if (in_array($categoryData['external_id'], $categoriesExternalIds)) {
                $categories[$categoryData['id']] = [
                    'id' => $categoryData['id'],
                    'parent_id' => $this->getParentIdDb($categoryData['external_id'])
                ];
            }
        }

        // creating id-paths and url-paths of each category
        foreach ($categories as $categoryId => $categoryData) {
            $currentPathIds = [];
            $currentPathUrl = $this->categories[$categoryId]['url'];

            $neededCid = $categoryData['parent_id'];

            while ($neededCid != 0) {
                $currentPathIds[] = $neededCid;
                $currentPathUrl = $this->categories[$neededCid]['url'] . '/' . $currentPathUrl;
                $neededCid = $categories[$neededCid]['parent_id'];
            }

            $categories[$categoryId]['full_path'] = $currentPathUrl;
            $categories[$categoryId]['full_path_ids'] = serialize(array_reverse($currentPathIds));
        }

        return $categories;
    }

    private function geti18nData($categoriesExternalIds) {
        $i18n = [];
        foreach ($this->categories as $categoryId => $categoryData) {
            if (in_array($categoryData['external_id'], $categoriesExternalIds)) {
                $i18n[] = [
                    'id' => $categoryData['id'],
                    'locale' => $this->locale,
                    'name' => $this->categoriesXml[$categoryData['external_id']]['name']
                ];
            }
        }
        return $i18n;
    }

    /**
     * Returning DB id of category by external_id (helper)
     * @param string $externalId
     * @return int|boolean id (DB primary key) of category|FALSE
     */
    private function getParentIdDb($externalId) {
        $parentExternalId = $this->categoriesXml[$externalId]['parent_external_id'];
        if ((string) $parentExternalId == '0') {
            return 0;
        }
        foreach ($this->categories as $categoryData) {
            if ($parentExternalId == $categoryData['external_id']) {
                return $categoryData['id'];
            }
        }
        return 0;
    }

    /**
     * Checks if the new url of category is free (helper)
     * @param string $url
     * @return boolean
     */
    private function isUrlFree($url) {
        foreach ($this->categories as $categoryData) {
            if (strtolower($url) == strtolower($categoryData['url'])) {
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Check if category exists (by external id) (helper)
     * @param string $externalId
     * @return boolean FALSE if category is new, FALSE otherwise
     */
    public function categoryExists($externalId) {
        foreach ($this->categories as $categoryId => $categoryData) {
            if ($externalId == $categoryData['external_id']) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Check if category exists (by external id) (helper)
     * @param string $externalId
     * @param boolean $returnCategoryId if TRUE, then method will return id of category
     * @return boolean|int FALSE if category is new, TRUE otherwise
     */
    public function categoryExists2($externalId, $returnCategoryId = FALSE) {
        if (null === $this->externalIds) {
            $this->externalIds = [];
            foreach ($this->categories as $categoryId => $categoryData) {
                if (!empty($categoryData['external_id'])) {
                    $this->externalIds[$categoryData['external_id']] = $categoryId;
                }
            }
        }
        $exists = isset($this->externalIds[$externalId]);
        if ($exists == TRUE) {
            return $returnCategoryId !== TRUE ? TRUE : $this->externalIds[$externalId];
        }
        return FALSE;
    }

}
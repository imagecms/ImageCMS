<?php

namespace import_export\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property Core $core
 * @property \CI_DB_active_record $db
 */
class CategoryImport extends BaseImport {

    /**
     * Process Categories
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function loadCategories() {
        if (ImportBootstrap::hasErrors())
            return FALSE;
        $this->load->helper('translit');
        foreach ($this->create()->content as $key => $node) {
            if ($node['cat'] == ''){
                return;
            }
            $parts = self::parseCategoryName($node['cat']);
            $pathIds = $pathNames = array();
            $parentId = $line = 0;
            foreach ($parts as $part) {
                $pathNames[] = $part;

                /* Find existing category */
                $binds = array($part, $this->languages, $parentId);
                $result = $this->db->query('
                    SELECT SCategory.id as CategoryId
                    FROM `shop_category_i18n` as SCategoryI18n
                    RIGHT OUTER JOIN `shop_category` AS SCategory ON SCategory.id = SCategoryI18n.id
                    WHERE SCategoryI18n.name = ? AND SCategoryI18n.locale = ? AND SCategory.parent_id = ?', $binds);
                if($result){
                    $result = $result->row();                    
                }else{
                    \import_export\classes\Logger::create()->set('Error $result in CategoryImport.php - IMPORT');
                }                        
               

                if (!($result instanceof \stdClass)) {
                    /* Create new category */
                    $binds = array('parent_id' => $parentId, 'full_path_ids' => serialize($pathIds), 'full_path' => implode('/', array_map('translit_url', $pathNames)), 'url' => translit_url($part), 'active' => 1);
                    $this->db->insert('shop_category', $binds);
                    $newCategoryId = $this->db->insert_id();
                    if(!$newCategoryId){
                        \import_export\classes\Logger::create()->set('Error INSERT category or SELECT id new category in CategoryImport.php - IMPORT');                        
                    }

                    /* Add translation data for new category  */
                    $this->db->insert('shop_category_i18n', array('id' => $newCategoryId, 'locale' => $this->languages, 'name' => trim($part)));

                    $this->create()->content[$key]['CategoryId'] = $pathIds[] = $parentId = $newCategoryId;
                    $this->create()->content[$key]['CategoryIds'] = $pathIds;
                } else {
                    $this->create()->content[$key]['CategoryId'] = $pathIds[] = $parentId = $result->CategoryId;
                    $this->create()->content[$key]['CategoryIds'] = $pathIds;
                }
            }
        }
    }

    /**
     * Parse Category Name by slashes
     * @param string name
     * @return arrray
     * @access private
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    private function parseCategoryName($name) {
        $result = array_map('trim', array_map('stripcslashes', preg_split('/\\REPLACE((?:[^\\\\\REPLACE]|\\\\.)*)/', $name, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY)));
        return explode('/', $result[0]);
    }

}


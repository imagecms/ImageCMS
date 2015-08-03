<?php

namespace template_manager\installer;

/**
 * Image CMS
 * Module Template_manager
 * class DemodataCategoriestemplates
 */
class DemodataCategoriestemplates extends DemodataDirector {

    /**
     * DemodataCategoriestemplates SimpleXMLElement node
     * @var \SimpleXMLElement 
     */
    public $node;
    private $categoriesData = array();
    private $ci;
    private $categories_levels = array();

    public function __construct(\SimpleXMLElement $node) {
        $this->node = $node;
        $this->ci = & get_instance();
    }

    /**
     * Install categories into DB
     * @return boolean
     */
    public function install() {
        if (!SHOP_INSTALLED)
            return TRUE;

        $this->prepareCategoriesLevelsArray();
        foreach ($this->node as $level) {
            $this->prepareData($level);
        }
        
        /*Если в категории есть товары, то tpl остается пустой (по умолчанию)
        * если товаров нет, то меняется в зависимости от файла params.xml 
        * level_1
        * level_2
        */
        foreach ($this->categoriesData as $k=>$v) {
            foreach ($v as $key=>$value){
                $checkProd = $this->ci->db->where('category_id',$value['id'])
                                    ->select('id')
                                    ->get('shop_products')
                                    ->row();
                if($checkProd){
                    $this->categoriesData[$k][$key]['tpl'] = '';
                }
                
            }
            
        }
        
        if ($this->categoriesData) {
            foreach ($this->categoriesData as $data) {
                $this->ci->db->update_batch('shop_category', $data, 'id');
            }
        }

        return TRUE;
    }

    /**
     * Prepare installed categories array
     */
    private function prepareData(\SimpleXMLElement $level) {
        if (strstr($level->getName(), 'level_')) {
            $attributes = $level->attributes();
            $level_number = (int) str_replace('level_', '', $level->getName());
            if (isset($this->categories_levels[$level_number])) {
                foreach ($this->categories_levels[$level_number] as $key => $category) {
                    $this->categories_levels[$level_number][$key]['tpl'] = (string) $attributes->template_name ? (string) $attributes->template_name : '';
                }
                $this->categoriesData[] = $this->categories_levels[$level_number];
            }
        }
    }

    /**
     * Prepare categoriesl levels array where index - category level(1, 2, 3...)
     */
    private function prepareCategoriesLevelsArray() {
        $categories = $this->ci->db->select('id, full_path_ids')->get('shop_category');
        if ($categories) {
            $categories = $categories->result_array();
        } else {
            $categories = array();
        }


        foreach ($categories as $category) {
            $full_path_ids = unserialize($category['full_path_ids']);
            $level_number = count($full_path_ids) + 1;
            unset($category['full_path_ids']);
            $this->categories_levels[$level_number][] = $category;
        }
    }

}

?>

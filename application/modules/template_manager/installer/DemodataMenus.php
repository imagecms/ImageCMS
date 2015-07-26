<?php

namespace template_manager\installer;

/**
 * Image CMS
 * Module Template_manager
 * class DemodataMenus
 */
class DemodataMenus extends DemodataDirector {

    /**
     * DemodataMenus SimpleXMLElement node
     * @var \SimpleXMLElement 
     */
    public $node;
    private $menuData = array();
    private $menuItemI18nData = array();
    private $menuItemData = array();
    private $menuItemPosition = 0;
    private $menuItemParentId = 0;
    private $localesIds = array();
    private $ci;

    public function __construct(\SimpleXMLElement $node) {
        $this->node = $node;
        $this->ci = & get_instance();
    }

    /**
     * Install menu into DB
     * @return boolean
     */
    public function install() {

        $this->prepareLocales();

        foreach ($this->node as $menu) {
            $this->prepareData($menu);
        }

        if ($this->menuItemI18nData) {
            $this->ci->db->insert_batch('menu_translate', $this->menuItemI18nData);
        }

        return TRUE;
    }

    private function prepareLocales() {
        $languages = $this->ci->db->get('languages')->result_array();
        foreach ($languages as $language) {
            $this->localesIds[$language['identif']] = $language['id'];
        }
    }

    /**
     * Prepare installed menu array
     */
    private function prepareData(\SimpleXMLElement $menu) {
        if ($menu->getName() == 'menu') {
            $attributes = $menu->attributes();

            $this->menuData = array(
                'name' => (string) $attributes->name ? (string) $attributes->name : '',
                'main_title' => (string) $attributes->main_title ? (string) $attributes->main_title : '',
                'tpl' => (string) $attributes->tpl_folder ? (string) $attributes->tpl_folder : '',
                'expand_level' => (string) $attributes->expand_level ? (string) $attributes->expand_level : '',
                'description' => (string) $attributes->description ? (string) $attributes->description : '',
                'created' => date('Y-m-d H:i:s')
            );

            $result = $this->ci->db->where('name', $this->menuData['name'])->get('menus');
            if (!$result->num_rows()) {
                $this->ci->db->insert('menus', $this->menuData);
                $menu_id = $this->ci->db->insert_id();

                if ($menu_id) {
                    if (isset($menu->item)) {
                        foreach ($menu->item as $item) {
                            $this->menuItemParentId = 0;
                            $this->prepareMenuItems($item, $menu_id);
                        }
                    }
                }
            }
        }
    }

    private function prepareMenuItems(\SimpleXMLElement $item, $menu_id) {
        if ($item->getName() == 'item') {
            $attributes = $item->attributes();

            $url = (string) $attributes->url ? (string) $attributes->url : '';
            $this->menuItemData = array(
                'menu_id' => $menu_id,
                'item_id' => 0,
                'item_type' => 'url',
                'item_image' => (string) $attributes->image ? (string) $attributes->image : '',
                'roles' => NULL,
                'hidden' => 0,
                'title' => (string) $attributes->title ? (string) $attributes->title : '',
                'parent_id' => $this->menuItemParentId,
                'position' => $this->menuItemPosition,
                'description' => (string) $attributes->description ? (string) $attributes->description : '',
                'add_data' => serialize(array('url' => $url, 'newpage' => 0))
            );

            $this->ci->db->insert('menus_data', $this->menuItemData);
            $item_id = $this->ci->db->insert_id();

            if ($item_id) {
                $this->menuItemPosition++;
                foreach ($item as $entity) {
                    $attributes = $entity->attributes();
                    switch ($entity->getName()) {
                        case 'menu_i18n':
                            $locale = (string) $attributes->locale ? (string) $attributes->locale : '';
                            if ($this->localesIds[$locale]) {
                                $this->menuItemI18nData[] = array(
                                    'title' => (string) $attributes->title ? (string) $attributes->title : '',
                                    'lang_id' => $this->localesIds[$locale],
                                    'item_id' => $item_id
                                );
                            }

                            break;
                        case 'item':
                            $this->menuItemParentId = $item_id;
                            $this->prepareMenuItems($entity, $menu_id);
                            break;
                        default:
                            break;
                    }
                }
            }
        }
    }

}

?>

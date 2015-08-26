<?php

namespace template_manager\installer;

/**
 * Image CMS
 * Module Template_manager
 * class DemodataBanners
 */
class DemodataBanners extends DemodataDirector {

    /**
     * DemodataBanners SimpleXMLElement node
     * @var \SimpleXMLElement 
     */
    public $node;
    private $bannerData = array();
    private $bannerI18nData = array();
    private $bannerGroupsData = array();
    private $existed_banners_groups = array();
    private $ci;

    public function __construct(\SimpleXMLElement $node) {
        $this->node = $node;
        $this->ci = & get_instance();
        $banners_groups = $this->ci->db->get('mod_banner_groups');
        if ($banners_groups) {
            $banners_groups = $banners_groups->result_array();
            foreach ($banners_groups as $group) {
                $this->existed_banners_groups[$group['name']] = $group['name'];
            }
        }
    }

    /**
     * Install baners into DB
     * @return boolean
     */
    public function install() {
        if (!SHOP_INSTALLED)
            return TRUE;

        $this->ci->db
                ->where('active', 1)
                ->set('active', 0)
                ->update('mod_banner');

        foreach ($this->node as $banner) {
            $this->prepareData($banner);
        }

        if ($this->bannerI18nData) {
            $this->ci->db->insert_batch('mod_banner_i18n', $this->bannerI18nData);
        }

        return TRUE;
    }

    /**
     * Prepare installed banners array
     */
    private function prepareData(\SimpleXMLElement $banner) {
        if ($banner->getName() != 'groups') {
            $attributes = $banner->attributes();
            $this->bannerData = array(
                'group' => (string) $attributes->group ? serialize(explode(',', trim((string) $attributes->group))) : '',
                'active' => (string) $attributes->active ? (string) $attributes->active : 0,
                'active_to' => (string) $attributes->active_to ? (string) $attributes->active_to : -1,
                'where_show' => (string) $attributes->where_show ? serialize(array((string) $attributes->where_show . '_0')) : serialize(array('default')),
                'position' => (string) $attributes->position ? (string) $attributes->position : 0
            );

            $this->ci->db->insert('mod_banner', $this->bannerData);

            if (isset($banner->banner_i18n) && $this->ci->db->insert_id()) {
                foreach ($banner->banner_i18n as $banner_i18n) {
                    $attributes = $banner_i18n->attributes();
                    $this->bannerI18nData[] = array(
                        'id' => $this->ci->db->insert_id(),
                        'name' => (string) $attributes->name ? (string) $attributes->name : 'Banner',
                        'description' => (string) $attributes->description ? (string) $attributes->description : '',
                        'url' => (string) $attributes->url ? (string) $attributes->url : '',
                        'locale' => (string) $attributes->locale ? (string) $attributes->locale : 'ru',
                        'photo' => (string) $attributes->photo ? (string) $attributes->photo : ''
                    );
                }
            } else {
                $this->messages[] = lang('Can not install banner.', 'template_manager');
                return FALSE;
            }
        } else {
            if (isset($banner->group)) {
                foreach ($banner->group as $group) {
                    $attributes = $group->attributes();
                    $this->bannerGroupsData = array(
                        'name' => (string) $attributes->name ? (string) $attributes->name : ''
                    );


                    if ($this->bannerGroupsData) {
                        if (!isset($this->existed_banners_groups[$this->bannerGroupsData['name']]))
                            $this->ci->db->insert('mod_banner_groups', $this->bannerGroupsData);
                    }
                }
            }
        }
    }

}

?>

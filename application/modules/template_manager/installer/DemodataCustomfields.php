<?php

namespace template_manager\installer;

/**
 * Image CMS
 * Module Template_manager
 * class DemodataCustomfields
 */
class DemodataCustomfields extends DemodataDirector {

    /**
     * DemodataBanners SimpleXMLElement node
     * @var \SimpleXMLElement 
     */
    public $node;
    private $fieldData = array();
    private $fieldI18nData = array();
    private $fieldTypes = array('text' => 0, 'textarea' => 1, 'file' => 3);
    private $ci;

    public function __construct(\SimpleXMLElement $node) {
        $this->node = $node;
        $this->ci = & get_instance();
    }

    /**
     * Install baners into DB
     * @return boolean
     */
    public function install() {
        foreach ($this->node as $field) {
            $this->prepareData($field);
        }

        if ($this->fieldI18nData) {
            $this->ci->db->insert_batch('custom_fields_i18n', $this->fieldI18nData);
        }
        return TRUE;
    }

    /**
     * Prepare installed banners array
     */
    private function prepareData(\SimpleXMLElement $field) {
        $attributes = $field->attributes();

        $fieldTypeId = $this->fieldTypes[(string) $attributes->type];
        $this->fieldData = array(
            'field_type_id' => $fieldTypeId ? $fieldTypeId : 0,
            'field_name' => (string) $attributes->name ? (string) $attributes->name : 'Field',
            'is_required' => (string) $attributes->required == 'TRUE' ? 1 : 0,
            'is_active' => (string) $attributes->active == 'TRUE' ? 1 : 0,
            'entity' => (string) $attributes->entity ? (string) $attributes->entity : 'user',
            'is_private' => (string) $attributes->private == 'TRUE' ? 1 : 0,
            'validators' => (string) $attributes->validators ? (string) $attributes->validators : '',
            'classes' => (string) $attributes->classes ? (string) $attributes->classes : '',
        );

        $result = $this->ci->db->where('entity', $this->fieldData['entity'])->where('field_name', $this->fieldData['field_name'])->get('custom_fields');
        if (!$result->num_rows()) {
            $this->ci->db->insert('custom_fields', $this->fieldData);
            $customFieldId = $this->ci->db->insert_id();

            if (isset($field->field_i18n) && $customFieldId) {
                foreach ($field->field_i18n as $field_i18n) {
                    $attributes = $field_i18n->attributes();
                    $this->fieldI18nData[] = array(
                        'id' => $customFieldId,
                        'locale' => (string) $attributes->locale ? (string) $attributes->locale : 'ru',
                        'field_label' => (string) $attributes->label ? (string) $attributes->label : 'Field Label',
                        'field_description' => (string) $attributes->description ? (string) $attributes->description : ''
                    );
                }
            } else {
                $this->messages[] = lang('Can not install custom field.', 'template_manager');
                return FALSE;
            }
        }
    }

}

?>

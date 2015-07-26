<?php

namespace template_manager\classes;

/**
 * From instance of this class you can esier get to the methods of components
 * (compontents of current template)
 * 
 * For example to call function getColorSheme() of TColorScheme component: 
 * $tcs = new TComponentShortcut;
 * $colorScheme = $tcs->TColorScheme->getColorSheme();
 * or even shorter (upper case letter from name of component):
 * $tcs->$TCS->getColorScheme();
 * 
 * (monostate)
 */
class TComponentShortcut {

    /**
     * 
     * @param type $componentName
     * @return \template_manager\classes\TComponentShortcutWrapper
     */
    public function __get($componentName) {
//        $currentTemplate = TemplateManager::getInstance()->getCurentTemplate();
//        $components = $currentTemplate->getComponents();

        $components = TemplateManager::getInstance()->getCurrentTemplateComponents();
        $nameShort = self::getShortName($componentName);

        foreach ($components as $componentName_ => $component_) {
            $nameShort_ = self::getShortName($componentName_);
            if ($componentName_ == $componentName || $nameShort_ == $nameShort) {
                return $component_;
            }
        }
    }

    /**
     * 
     * @param type $componentName
     * @return type
     */
    private static function getShortName($componentName) {
        $componentNameUpper = strtoupper($componentName);

        $origin = str_split($componentName);
        $upper = str_split($componentNameUpper);

        $shortName = '';
        for ($i = 0; $i < count($origin); $i++) {
            if ($origin[$i] === $upper[$i]) {
                $shortName .= $upper[$i];
            }
        }

        return $shortName;
    }

}

<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

/**
 * @property Core $core
 */
class MY_Controller extends MX_Controller {

    private $module_name = '';

    public function __construct() {
        parent::__construct();
        $this->module_name = CI::$APP->router->fetch_module();
    }

    /**
     * Возвращает имя модуля
     */
    public function getModuleName() {
        return $this->module_name;
    }

    /**
     * Редерим страницу сайта.
     * 
     * @param string $template_name путь к файлу шаблона относительно директории модуля без расширения,
     * например: catatlog или public/my_template
     * @param boolean $use_theme Если true, то результат будет помещен в 
     * переменную $content и отрендерен в файле main.tpl текущей темы сайта.
     * 
     * Использует метод getTplPath - шаблон можно будет перегружать в текущей теме сайта.
     * ВНИМАНИЕ! Если нужно отрендерить только ваш шаблон (например в панели 
     * администрирования) - установите $use_theme = false
     */
    protected function displayTpl($template_name, $use_theme = true) {
        // Use main site template
        if ($use_theme) {
            $this->template->add_array(array(
                'content' => $this->fetchTpl($template_name),
            ));
            $this->template->show();
        } else {
            $this->template->display('file:' . $this->getTplPath($template_name));
        }
        exit;
    }

    /**
     * Возвращает результат рендеринга шаблона.
     * 
     * @param string $template_name путь к шаблону относительно директории модуля без расширения,
     * например: catatlog или public/my_template
     * 
     * Использует метод getTplPath - шаблон можно будет перегружать в текущей теме сайта.
     */
    protected function fetchTpl($template_name) {
        return $this->template->fetch('file:' . $this->getTplPath($template_name));
    }

    /**
     * Возвращает относительный путь к директории модуля с заверщающим слешем
     */
    protected function getModuleDirectory() {
        return APPPATH . 'modules' . DIRECTORY_SEPARATOR . $this->getModuleName() . DIRECTORY_SEPARATOR;
    }

    /**
     * Генерирует путь к файлу шаблона
     * 
     * @param string $template_name путь к шаблону относительно директории модуля без расширения,
     * например: catatlog или public/my_template
     * 
     * @return string путь без окончания .tpl т.к. оно автоматически подставляется в шаблонизаторе
     * 
     * Шаблон в папке templates/ТЕКУЩАЯ_ТЕМА/modules/ИМЯ_МОДУЛЯ/{$template_name}.tpl
     * имеет большее преимущество перед шаблоном в папке модуля. 
     * Таким образом в теме сайта можно переоределять шаблоны модулей, если они выводятся через э
     */
    protected function getTplPath($template_name) {
        $path = $this->getModuleDirectory() . 'templates' . DIRECTORY_SEPARATOR . $template_name;
        $alter_path = $this->template->template_dir . 'modules' . DIRECTORY_SEPARATOR . $this->getModuleName() . DIRECTORY_SEPARATOR . $template_name;

        if (file_exists($alter_path . '.tpl')) {
            return $alter_path;
        }
        return $path;
    }

}

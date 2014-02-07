<?php

namespace template_manager\classes;

/**
 * Базовий клас для для компонентів шаблону
 * Кожен компонент повинен розширювати даний клас
 * 
 * Компоненти шаблону - свого роду "модулі" для шаблону - тобто
 * розширення його фунціналу. Він має свій ід, для БД.
 * 
 * 
 * 
 */
abstract class TComponent {

    public function __construct() {
        // отримання шляхів
    }

    public function render($tplName, array $data = array()) {
        
    }

    public function renderAdmin($tplName, array $data = array()) {
        
    }

    /**
     * Повертає ід компонента - для збереження в БД
     * @return int
     */
    abstract public function getComponentId();
}

?>

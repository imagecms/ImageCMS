<?php

/**
 * 
 *
 * 
 * 
 */
abstract class ControllerBase {

    /**
     * Instance of main admin controler
     * @var Admin 
     */
    protected $controller;

    /**
     *
     * @var \CMSFactory\assetManager 
     */
    protected $assetManager;

    public function __construct($controller) {
        $this->controller = $controller;
        $this->assetManager = $controller->assetManager;
    }

    /**
     * Hepler function for controller-distributed views rendering
     * @param string $tpl name of template of controller
     * @param array $data data for template
     */
    public function renderAdmin($tpl, array $data = array()) {
        $this->assetManager->setData($data);
        $className = strtolower(get_class($this));
        $folderName = str_replace('controller', '', $className);
        $this->assetManager->render('admin/' . $folderName . '/' . $tpl);
    }

    /**
     * Prepare data for chart
     * @param array $array
     * @return array
     */
    public static function prepareDataForStaticChart($array = null) {
        $chartData = array();
        foreach ($array as $item) {
            // Make for all keys the same length
            if (mb_strlen($item['name']) > 35) {
                $key = mb_substr($item['name'], 0, 33) . '..';
            } else {
                if (strlen($item['name']) != mb_strlen($item['name'])) {
                    $c = 30 + (strlen($item['name'])/2);
                } else {
                    $c = 35;
                }
                $key = str_pad($item['name'], $c);
            }
            $chartData[] = array(
                'key' => $key,
                'y' => (int) $item['count']
            );
        }
        if ($chartData) {
            return $chartData;
        }
        return FALSE;
    }

}

?>

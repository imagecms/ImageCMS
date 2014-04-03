<?php

/**
 * class TColorScheme for Components template manager
 *
 * @author 
 */
class TColorScheme extends \template_manager\classes\TComponent {

    /**
     * prepare param from xml to save in db
     * @param \SimpleXMLElement $nodes
     */
    public function setParamsXml(\SimpleXMLElement $component) {
        $data = array();
        foreach ($component as $item) {
            switch ($item->getName()) {
                case 'param':
                    $param_attributes = $item->attributes();
                    $data[(string) $param_attributes->name] = (string) $param_attributes->value;
                    break;
            }
        }

        if (count($data) > 0)
            $this->setParams($data);
    }

    /**
     * prepare param from form to save in db
     */
    public function setParams($data = array()) {
        if (count($data) > 0)
            parent::setParams($data);
    }

    /**
     * Update component params
     */
    public function updateParams() {
        if ($_POST['color_scheme']) {
            $data = \CI::$APP->input->post();

            $dataToUpdate = array();
            $dataToUpdate['color_scheme'] = $data['color_scheme'];

            if (count($dataToUpdate) > 0)
                return parent::updateParams($dataToUpdate);
        }
    }

    /**
     * Prepare param to output
     */
    public function getParam($key = null) {
        $params = parent::getParam($key);
        $data = array();
        if ($key) {
            $data[$key] = $params;
        } else {
            foreach ($params as $param) {
                $data[$key] = $param;
            }
        }

        return $data;
    }

    /**
     * get all color schema
     * @return array 
     */
    public function getAllColorSchema() {
        $Path = './templates/' . $this->templateName . '/css/';
        $dirList = array();
        $baseDir = new DirectoryIterator($Path);
        if ($baseDir) {
            foreach ($baseDir as $dir) {
                if ($dir->isDir() && !$dir->isDot()) {
                    $dirList[$dir->getBasename()] = str_replace('.', '', $dir->getPathname());
                }
            }
        }
        return $dirList;
    }

    /**
     * 
     * @return type
     */
    public function getLabel() {
        return lang('Color scheme', 'template_manager');
    }

    public function getType() {
        return __CLASS__;
    }

    /**
     * render wityh param
     */
    public function renderAdmin() {
        $sheme = $this->getParam('color_scheme');
        $allShemes = $this->getAllColorSchema();
        $this->cAssetManager->display('admin/main', array(
            'handler' => $this->name,
            'mainScheme' => $sheme,
            'shemes' => $allShemes)
        );
    }

}

?>

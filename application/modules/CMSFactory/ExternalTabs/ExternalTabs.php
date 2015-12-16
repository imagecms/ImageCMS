<?php

namespace CMSFactory\ExternalTabs;

\CI::$APP->load->helper(['translit']);

/**
 * Component for easy hooking functional from one module to another
 * in the form of tabs (common case for admin-panel).
 *
 * First modules which implement this class behavior were [smart_filter -> mod_seo], so you
 * can exam them for an example code.
 *
 * This can be done in numerous ways, but it is good when there is one convinient way.
 *
 * @author kolia
 */
class ExternalTabs
{

    /**
     *
     * @var ExternalTabs[]
     */
    protected static $modulesInstances;

    /**
     *
     * @var Tab[]
     */
    protected $tabs = [];

    /**
     *
     * @param string $moduleName
     * @return ExternalTabs
     */
    public static function ofModule($moduleName) {
        if (!array_key_exists($moduleName, self::$modulesInstances)) {
            self::$modulesInstances[$moduleName] = new self();
        }
        return self::$modulesInstances[$moduleName];
    }

    /**
     *
     * @param string $tabName
     * @return Tab
     */
    public function getTab($tabName) {
        if (!isset($this->tabs[$tabName])) {
            return null;
        }
        return $this->tabs[$tabName];
    }

    /**
     *
     * @param string $tabName
     * @param string $tabContent
     * @param callable $inputHandlerCallback
     */
    public function registerTab($tabName, $tabContent, $inputHandlerCallback) {
        $this->tabs[$tabName] = new Tab($tabName, $tabContent, $inputHandlerCallback);
    }

    /**
     *
     * @param string $methodName
     * @param array $arguments
     */
    protected function runForAllTabs($methodName, array $arguments = []) {
        foreach ($this->tabs as $tab) {
            echo $tab->$methodName($arguments);
        }
    }

    /**
     *
     */
    public function renderTabsButtons() {
        $this->runForAllTabs('renderTabButton');
    }

    /**
     *
     */
    public function renderTabsContent() {
        $this->runForAllTabs('renderTabContent');
    }

    /**
     * Excepts any number of arguments
     */
    public function processInput() {
        $this->runForAllTabs('processInput', func_get_args());
    }

}
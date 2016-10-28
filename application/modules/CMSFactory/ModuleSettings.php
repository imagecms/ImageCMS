<?php

namespace CMSFactory;

use CI;
use CI_DB_active_record;

/**
 * Class for accessing to modules settings
 * (stored in table `components` in `settings` field)
 *
 * Structure:
 * Is kind of singleton - instance for each module stored in self::$instance array.
 *
 * Class is working mostly with $settings array, so you can change storage
 * by changing loadModuleSettings() & saveModuleSettings() methods
 *
 * @author kolia
 */
class ModuleSettings
{

    /**
     *
     * @var array
     */
    protected static $instances = [];

    /**
     *
     * @var array
     */
    protected $settings = [];

    /**
     *
     * @var string
     */
    protected $moduleName;

    /**
     *
     * @var CI_DB_active_record
     */
    protected $db;

    /**
     * @param string $moduleName
     */
    protected function __construct($moduleName) {
        $this->db = CI::$APP->db;
        $this->moduleName = $moduleName;
        $this->loadModuleSettings();
    }

    protected function __clone() {

    }

    /**
     * Returns instance of class for one module
     * @param string $moduleName
     * @return ModuleSettings
     */
    public static function ofModule($moduleName) {
        if (!isset(self::$instances[$moduleName])) {
            self::$instances[$moduleName] = new self($moduleName);
        }
        return self::$instances[$moduleName];
    }

    /**
     * Loads one module settings
     */
    protected function loadModuleSettings() {
        $result = $this->db
            ->limit(1)
            ->select(['settings'])
            ->where('identif', $this->moduleName)
            ->get('components');

        if (!$result) {
            return;
        }
        $settingsString = $result->row()->settings;
        $settings = json_decode($settingsString, true);
        if ($settings == null) {
            // for old formats ( modules that uses serialize() )
            $settings = unserialize($settingsString);
        }

        if (!is_array($settings)) {
            return;
        }

        $this->settings = $settings;
    }

    /**
     * Saves one module settings
     */
    protected function saveModuleSettings() {
        $this->db
            ->where('identif', $this->moduleName)
            ->set('settings', json_encode($this->settings))
            ->update('components');
    }

    /**
     * Sets new settings values
     *
     * Usage: ::set('key', 'value');
     *
     * If second argument is not specified, and first is array-type
     * then all settings will be overwritten by this array
     *
     * @param string|array $keyOrSettings setting name of second argument value, or
     * array with all new settings (will be owerwritten)
     * @param string|int|array $value (optional) setting value
     */
    public function set($keyOrSettings, $value = null) {
        if (is_array($keyOrSettings) && $value === null) {
            $this->settings = $keyOrSettings;
        } else {
            $this->settings[$keyOrSettings] = $value;
        }
        $this->saveModuleSettings();
    }

    /**
     * Deleting specified setting
     * @param string $key
     */
    public function delete($key) {
        if (!isset($this->settings[$key])) {
            return;
        }
        unset($this->settings[$key]);
        $this->saveModuleSettings();
    }

    /**
     * Returns specified setting item
     * @param string (optional) $key config key. if not specified all settings will be returned
     * @param string $key
     * @return array|null|string
     */
    public function get($key = null) {
        if ($key == null) {
            return $this->settings;
        }
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }

}
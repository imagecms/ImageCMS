<?php

namespace CMSFactory;

/**
 * Class DummyModule
 *
 * Stub for unexisting module
 * Returned from module() helper, if expected module does not exist
 * Each method triggers E_USER_WARNING in development environment
 *
 * @package CMSFactory
 */
class DummyModule
{

    /**
     * @var string
     */
    protected $name;

    /**
     * ModuleStub constructor.
     *
     * @param string $name
     */
    public function __construct($name) {
        $this->name = $name;
        $this->triggerWarning();
    }

    /**
     * is triggered when invoking inaccessible methods in an object context.
     *
     * @param string $name
     * @param array $arguments
     * @return DummyModule
     */
    public function __call($name, $arguments) {
        $this->triggerWarning();
        return $this;
    }

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param string $name
     * @return DummyModule
     */
    public function __get($name) {
        $this->triggerWarning();
        return $this;

    }

    /**
     * run when writing data to inaccessible members.
     *
     * @param string $name
     * @param mixed $value
     * @return DummyModule
     */
    public function __set($name, $value) {
        $this->triggerWarning();
        return $this;
    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     */
    public function __toString() {
        $this->triggerWarning();
        return '';
    }

    /**
     * Triggers E_USER_WARNING
     */
    protected function triggerWarning() {
        if (ENVIRONMENT == 'development') {
            //            $debug = debug_backtrace();
            //            $templateData = $debug[2];
            //            trigger_error(sprintf('Call to undefined module %s from file %s line: %s', $this->name, $templateData['file'], $templateData['line']), E_USER_WARNING);
        }
    }

}
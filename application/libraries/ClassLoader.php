<?php

/**
 * require_once APPPATH . 'libraries' . DIRECTORY_SEPARATOR . 'ClassLoader.php';
 * ClassLoader::getInstance()
 *     ->registerNamespacedPath(APPPATH)
 *     ->registerNamespacedPath(APPPATH . 'modules');
 *
 * @author ailok <m.kecha@imagecms.net>
 *
 */
class ClassLoader {

    const EXT = '.php';
    const DS = DIRECTORY_SEPARATOR;

    private static $instance;

    private $namespacedPaths = [];

    private $aliases = [];

    private $classesPaths = [];

    private function __construct() {
        spl_autoload_register([$this, 'autoload'], false);
    }

    private function __clone() {

    }

    /**
     *
     * @return ClassLoader
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     *
     * @param array $array
     * @param string $path
     * @param string (optional) $key
     * @param string $key
     * @throws \Exception
     */
    private function addPath(array &$array, $path, $key = null) {
        if (!is_dir($path)) {
            throw new \Exception('Error registering [' . $path . '] - folder do not exist');
        }
        if (in_array($path, $array)) {
            return;
        }

        if ($key == null) {
            $array[] = $path;
        } else {
            $array[$key] = $path;
        }
    }

    /**
     *
     * @param string $path
     * @return \ClassLoader
     */
    public function registerNamespacedPath($path) {
        $this->addPath($this->namespacedPaths, $path);
        return $this;
    }

    /**
     *
     * @param string $path
     * @return \ClassLoader
     */
    public function registerClassesPath($path) {
        $this->addPath($this->classesPaths, $path);
        return $this;
    }

    /**
     *
     * @param string $path
     * @param string $name
     * @return \ClassLoader
     */
    public function registerAlias($path, $name) {
        $this->addPath($this->aliases, $path, $name);
        return $this;
    }

    /**
     * Function for registering in spl_autoload_register()
     * @param string $className
     */
    public function autoload($className) {
        $className = ltrim($className, '\\');
        if (strpos($className, '\\') > 0) {
            $this->loadNamespacedClass($className);
        } else {
            $this->loadClass($className);
        }
    }

    /**
     * @param string $className
     */
    private function lookInAliases($className) {
        // getting first element of namespace path and search it in namespaces
        list($namespace, $fileName) = $this->splitClassName($className);
        if (key_exists($namespace, $this->aliases) && strpos($namespace, '\\') > 0) {
            $classPath = $this->aliases[$namespace] . '/' . $fileName . self::EXT;
            $this->includeClass($classPath);
            return true;
        }

        $parts = explode('\\', $className);
        $alias = array_shift($parts);
        if (!key_exists($alias, $this->aliases)) {
            return false;
        }
        $pathToNamepace = rtrim($this->aliases[$alias], self::DS) . self::DS;
        $classPath = $pathToNamepace . implode(self::DS, $parts) . self::EXT;
        return $this->includeClass($classPath);
    }

    /**
     *
     * @param string $className
     * @return array [namespace, fileName]
     */
    private function splitClassName($className) {
        $parts = explode('\\', $className);
        $fileName = array_pop($parts);
        return [implode('\\', $parts), $fileName];
    }

    /**
     * @param string $className
     */
    private function loadNamespacedClass($className) {
        if (true == $this->lookInAliases($className)) {
            return;
        }
        $namespacedClassPath = str_replace('\\', self::DS, $className);
        $namespacedPathsCount = count($this->namespacedPaths);
        for ($i = 0; $i < $namespacedPathsCount; $i++) {
            $classPath = rtrim($this->namespacedPaths[$i], self::DS) . self::DS . $namespacedClassPath . self::EXT;
            if (true == $this->includeClass($classPath)) {
                return;
            }
        }
    }

    /**
     * @param string $className
     */
    private function loadClass($className) {
        $classesPathsCount = count($this->classesPaths);

        for ($i = 0; $i < $classesPathsCount; $i++) {
            $classPath = rtrim($this->classesPaths[$i], self::DS) . self::DS . $className . self::EXT;
            if (true == $this->includeClass($classPath)) {
                return;
            }
        }
    }

    /**
     * @param string $classPath
     */
    private function includeClass($classPath) {
        if (file_exists($classPath)) {
            include_once $classPath;
            return true;
        }
        return false;
    }

}
<?php
namespace CMSFactory\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

class DependencyInjectionProvider
{

    /**
     * @var ContainerBuilder
     */
    protected static $container = null;

    /**
     * @var PhpFileLoader
     */
    protected $loader;

    protected function __construct() {
        static::$container = new ContainerBuilder();
        $loader = new YamlFileLoader(static::$container, new FileLocator(__DIR__ . '/../../..'));
        $loader->load('config/services.yml');
    }

    /**
     * @return ContainerBuilder
     */
    public static function getContainer() {
        if (!static::$container) {
            new static;
        }
        return static::$container;
    }

}
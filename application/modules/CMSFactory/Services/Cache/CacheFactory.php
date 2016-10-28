<?php namespace CMSFactory\Services\Cache;

use Doctrine\Common\Cache\CacheProvider;
use Memcache;
use Memcached;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class CacheFactory
{
    use ContainerAwareTrait;

    /**
     * @return CacheProvider
     * @throws ServiceNotFoundException
     * @throws InvalidArgumentException
     * @throws ServiceCircularReferenceException
     */
    public function createCacheProvider() {

        foreach ($this->container->getParameter('cache.provider.priority') as $provider) {
            if ($this->checkRequirements($provider)) {
                $provider = $this->container->get($provider);
                $provider->setNamespace($_SERVER['HTTP_HOST']);
                return $provider;
            }
        }
        return $this->container->get('cache.provider.void');
    }

    /**
     * @param string $provider
     * @return bool
     * @throws ServiceNotFoundException
     * @throws ServiceCircularReferenceException
     * @throws InvalidArgumentException
     */
    private function checkRequirements($provider) {

        switch ($provider) {
            case 'cache.provider.memcache':
                return $this->checkMemcache();
            case 'cache.provider.memcached':
                return $this->checkMemcached();
            case 'cache.provider.filesystem':
                return $this->checkFilesystem();
            case 'cache.provider.apc':
                return $this->checkApc();
            default:
                return false;

        }
    }

    /**
     * @return bool
     * @throws ServiceNotFoundException
     * @throws InvalidArgumentException
     * @throws ServiceCircularReferenceException
     */
    private function checkMemcache() {

        if (!extension_loaded('memcache') or !class_exists('Memcache')) {
            return false;
        }

        /** @var Memcache $memcache */
        $memcache = $this->container->get('memcache');
        $host = $this->container->getParameter('memcached.host');
        return $memcache->getserverstatus($host) !== 0;
    }

    /**
     * @return bool
     * @throws ServiceNotFoundException
     * @throws ServiceCircularReferenceException
     * @throws InvalidArgumentException
     */
    private function checkMemcached() {

        if (!extension_loaded('memcached') or !class_exists('Memcached')) {
            return false;
        }

        /** @var Memcached $memcached */
        $memcached = $this->container->get('memcached');
        $host = $this->container->getParameter('memcached.host');
        $port = $this->container->getParameter('memcached.port');

        $server = "{$host}:{$port}";
        $stats = $memcached->getStats();
        return array_key_exists($server, $stats) && $stats[$server]['pid'] > 0;
    }

    /**
     * @return bool
     * @throws InvalidArgumentException
     */
    private function checkFilesystem() {

        $cacheDirectory = $this->container->getParameter('cache.directory');
        return file_exists($cacheDirectory) && is_writable($cacheDirectory);

    }

    /**
     * @return bool
     */
    private function checkApc() {

        return extension_loaded('apc') && ini_get('apc.enabled');
    }

}
# CacheFactory

This class provides Doctrine Cache library for ImageCMS

### Cache Providers

Cache Factory creates most suitable cache provider which support current system

You can can specify cache providers priority
in  ```cache.provider.priority``` parameter
located in application/config/services.yml file

Each provider implements \Doctrine\Common\Cache\Cache interface

## Basic Usage

The cache is available in any controller via DI container

    $this->getContainer()->get('cache')->fetch($id)
    $this->getContainer()->get('cache')->contains($id)
    $this->getContainer()->get('cache')->delete($id)
    $this->getContainer()->get('cache')->save($id, $data, $lifeTime = 0)

Container will return first available provider described in ```cache.provider.priority```

## Available Providers

Currently implemented and tested providers:

* Doctrine\Common\Cache\ApcCache
* Doctrine\Common\Cache\MemcacheCache
* Doctrine\Common\Cache\MemcachedCache
* Doctrine\Common\Cache\FilesystemCache











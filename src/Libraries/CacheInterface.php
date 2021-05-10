<?php


namespace App\Libraries;

use Symfony\Component\Cache\Adapter\MemcachedAdapter;

interface CacheInterface
{
    public function saveItem(MemcachedAdapter $cachePool, string $key, $value, int $expire): bool;

    public function getItem(MemcachedAdapter $cachePool, string $key);

    public function deleteItem(MemcachedAdapter $cachePool, string $key): bool;

    public function deleteAll(MemcachedAdapter $cachePool): bool;
}
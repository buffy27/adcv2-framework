<?php

namespace App\Libraries;

use App\Exceptions\CacheException;
use phpDocumentor\Reflection\Types\Mixed_;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\MemcachedAdapter;

class MemcachedUtil implements CacheInterface
{
    public function saveItem(MemcachedAdapter $cachePool, string $key, $value, int $exprie = null): bool
    {
        $item = $this->fetch($cachePool, $key);
        $item->set($value);
        if($exprie)
            $item->expiresAfter($exprie);

        return $cachePool->save($item);
    }

    public function getItem(MemcachedAdapter $cachePool, string $key)
    {
        $result = null;

        $item = $this->fetch($cachePool, $key);
        if ($item->isHit()) {
            $result = $item->get();
        }

        return $result;
    }

    public function deleteItem(MemcachedAdapter $cachePool, string $key): bool
    {
        return $cachePool->deleteItem($key);
    }

    public function deleteAll(MemcachedAdapter $cachePool): bool
    {
        return $cachePool->clear();
    }

    private function fetch(MemcachedAdapter $cachePool, string $key): CacheItemInterface
    {
        try {
            return $cachePool->getItem($key);
        } catch (InvalidArgumentException $e) {
            throw new CacheException($e->getMessage());
        }
    }
}
<?php declare(strict_types=1);

namespace Farran\Geo\Locator;

use Farran\Geo\Cache;
use Farran\Geo\Dto\{Ip, Location};

/**
 * Class CacheLocator
 *
 * @package Farran\Geo\Locator
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class CacheLocator implements LocatorInterface
{
    /**
     * @var LocatorInterface
     */
    private $next;

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var int
     */
    private $ttl;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @param LocatorInterface $next
     * @param string           $prefix
     * @param Cache            $cache
     * @param int              $ttl
     */
    public function __construct(LocatorInterface $next, string $prefix, Cache $cache, int $ttl)
    {
        $this->next   = $next;
        $this->prefix = $prefix;
        $this->cache  = $cache;
        $this->ttl    = $ttl;
    }

    /**
     * @param Ip $ip
     *
     * @return Location|null
     */
    public function locate(Ip $ip): ?Location
    {
        $key = 'location-' . $ip->getValue();
        $location = $this->cache->get($key);

        if ($location === null) {
            $location = $this->next->locate($ip);
            $this->cache->set($key, $location, $this->ttl);
        }

        return $location;
    }
}

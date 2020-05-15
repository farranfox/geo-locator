<?php declare(strict_types=1);

namespace Farran\Geo\Locator;

use Farran\Geo\Dto\{Ip, Location};

/**
 * Interface LocatorInterface
 *
 * @package Farran\Geo\Locator
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
interface LocatorInterface
{
    /**
     * @param Ip $ip
     *
     * @return Location|null
     */
    public function locate(Ip $ip): ?Location;
}

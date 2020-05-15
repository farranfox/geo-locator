<?php declare(strict_types=1);

namespace Farran\Geo\Locator;

use Farran\Geo\Dto\{Ip, Location};

/**
 * Class ChainLocator
 *
 * @package Farran\Geo\Locator
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class ChainLocator implements LocatorInterface
{
    /**
     * @var LocatorInterface[]
     */
    private $locators;

    /**
     * @param LocatorInterface ...$locators
     */
    public function __construct(LocatorInterface ...$locators)
    {
        $this->locators = $locators;
    }

    /**
     * @param Ip $ip
     *
     * @return Location|null
     */
    public function locate(Ip $ip): ?Location
    {
        foreach ($this->locators as $locator) {
            $location = $locator->locate($ip);
            if ($location !== null) {
                return $location;
            }
        }

        return null;
    }
}

<?php declare(strict_types=1);

namespace Farran\Geo\Locator;

use Farran\Geo\{Dto\Ip, Dto\Location, ErrorHandlerInterface};

/**
 * Class MuteLocator
 *
 * @package Farran\Geo\Locator
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class MuteLocator implements LocatorInterface
{
    /**
     * @var LocatorInterface
     */
    private $next;

    /**
     * @var ErrorHandlerInterface
     */
    private $handler;

    /**
     * @param LocatorInterface      $next
     * @param ErrorHandlerInterface $handler
     */
    public function __construct(LocatorInterface $next, ErrorHandlerInterface $handler)
    {
        $this->next    = $next;
        $this->handler = $handler;
    }

    /**
     * @param Ip $ip
     *
     * @return Location|null
     */
    public function locate(Ip $ip): ?Location
    {
        try {
            return $this->next->locate($ip);
        } catch (\Exception $exception) {
            $this->handler->handle($exception);
            return null;
        }
    }
}

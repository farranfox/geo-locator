<?php declare(strict_types=1);

namespace Farran\Geo;

use Exception;

/**
 * Interface ErrorHandlerInterface
 *
 * @package Farran\Geo
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
interface ErrorHandlerInterface
{
    /**
     * @param Exception $exception
     */
    public function handle(Exception $exception): void;
}

<?php declare(strict_types=1);

namespace Farran\Geo;

use Exception;
use Psr\Log\LoggerInterface;

/**
 * Class PsrLogErrorHandler
 *
 * @package Farran\Geo
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class PsrLogErrorHandler implements ErrorHandlerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(?LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    /**
     * @param Exception $exception
     */
    public function handle(Exception $exception): void
    {
        if ($this->logger) {
            $this->logger->error($exception->getMessage(), [
                'exception' => $exception,
            ]);
        }
    }
}

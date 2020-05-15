<?php declare(strict_types=1);

namespace Farran\Geo;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpClient
 *
 * @package Farran\Geo
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class HttpClient implements ClientInterface
{
    /**
     * @param string $url
     *
     * @return string|null
     */
    public function get(string $url): ?string
    {
        $response = @file_get_contents($url);
        if ($response === false) {
            throw new \RuntimeException(error_get_last());
        }

        return $response;
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        // TODO: Implement sendRequest() method.
    }
}

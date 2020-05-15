<?php declare(strict_types=1);

namespace Farran\Geo\Locator;

use Laminas\Diactoros\Request;
use Farran\Geo\Dto\{Ip, Location};
use Psr\Http\Client\{ClientInterface, ClientExceptionInterface};

/**
 * Class IpInfoLocator
 *
 * @package Farran\Geo\Locator
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class IpInfoLocator implements LocatorInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @param ClientInterface $client
     * @param string          $apiKey
     */
    public function __construct(ClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * @param Ip $ip
     *
     * @return Location|null
     * @throws ClientExceptionInterface
     */
    public function locate(Ip $ip): ?Location
    {
        $url = 'https://ipinfo.io/' . $ip->getValue() . '?' . http_build_query([
            'token' => $this->apiKey,
        ]);

        $request  = new Request($url, 'get');
        $response = $this->client->sendRequest($request);
        $data     = json_decode($response->getBody()->getContents(), true);

        if (empty($data['country'])) {
            return null;
        }

        return new Location($data['country'], $data['region'], $data['city']);
    }
}

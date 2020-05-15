<?php declare(strict_types=1);

namespace Farran\Geo\Locator;

use Laminas\Diactoros\Request;
use Farran\Geo\Dto\{Ip, Location};
use Psr\Http\Client\{ClientInterface, ClientExceptionInterface};

/**
 * Class IpGeoLocator
 *
 * @package Farran\Geo\Locator
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class IpGeoLocator implements LocatorInterface
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
		$url = 'https://api.ipgeolocation.io/ipgeo?' . http_build_query([
			'apiKey' => $this->apiKey,
			'ip'     => $ip->getValue(),
		]);

		$request  = new Request($url, 'get');
		$response = $this->client->sendRequest($request);
		$data     = json_decode($response->getBody()->getContents(), true);

		$data = array_map(function ($value) {
		    return $value !== '-' ? $value : null;
        }, $data);

		if (empty($data['country_name'])) {
			return null;
		}

		return new Location($data['country_name'], $data['state_prov'], $data['city']);
	}
}

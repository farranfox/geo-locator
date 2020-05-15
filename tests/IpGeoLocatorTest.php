<?php declare(strict_types=1);

namespace Farran\Geo\Tests;

use Farran\Geo\Dto\Ip;
use Farran\Geo\HttpClient;
use Laminas\Diactoros\Response;
use PHPUnit\Framework\TestCase;
use Laminas\Diactoros\StreamFactory;
use Farran\Geo\Locator\IpGeoLocator;

/**
 * Class IpGeoLocatorTest
 *
 * @package Farran\Geo\Tests
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class IpGeoLocatorTest extends TestCase
{
    private $streamFactory;

    public function setUp(): void
    {
        $this->streamFactory = new StreamFactory();
    }

	public function testSuccess(): void 
	{
	    $json = (string) json_encode([
	        'country_name' => 'United States',
            'state_prov' => 'California',
            'city' => 'Mountain View'
        ]);

	    $response = new Response();
        $response = $response
            ->withHeader('Content-Type', 'application/json')
            ->withBody($this->streamFactory->createStream($json));

        $client = $this->createMock(HttpClient::class);
        $client->method('sendRequest')->willReturn($response);

		$locator = new IpGeoLocator($client, '');
		$location = $locator->locate(new Ip('8.8.8.8'));

		self::assertNotNull($location);
		self::assertEquals('United States', $location->getCountry());
		self::assertEquals('California', $location->getRegion());
		self::assertEquals('Mountain View', $location->getCity());
	}

	public function testNotFound(): void
	{
        $json = (string) json_encode([
            'country_name' => '-',
            'state_prov' => '-',
            'city' => '-'
        ]);

        $response = new Response();
        $response = $response
            ->withHeader('Content-Type', 'application/json')
            ->withBody($this->streamFactory->createStream($json));

        $client = $this->createMock(HttpClient::class);
        $client->method('sendRequest')->willReturn($response);

		$locator = new IpGeoLocator($client, '');
		$location = $locator->locate(new Ip('127.0.0.1'));

		self::assertNull($location);
	}
}

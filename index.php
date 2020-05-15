<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use Farran\Geo\Dto\{Ip, Location};
use Farran\Geo\PsrLogErrorHandler;
use Farran\Geo\Locator\{MuteLocator, ChainLocator, IpGeoLocator, IpInfoLocator};

use Dotenv\Dotenv;
use Monolog\Logger;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;

$dotEnv = Dotenv::createImmutable(__DIR__);
$dotEnv->load();

$logger = new Logger('locator');
$logger->pushHandler(new StreamHandler(getenv('LOG_FILE_PATH'), Logger::ERROR));

$handler = new PsrLogErrorHandler($logger);
$client  = new Client();

$cacheLocator = new ChainLocator(
    new MuteLocator(
        new IpGeoLocator($client, getenv('IP_GEO_LOCATOR_KEY')),
        $handler
    ),
    new MuteLocator(
        new IpInfoLocator($client, getenv('IP_INFO_LOCATOR_KEY')),
        $handler
    )
);

/** @var Location $result */
$location = $cacheLocator->locate(new Ip('8.8.8.8'));

echo $location.PHP_EOL;

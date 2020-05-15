<?php

namespace Farran\Geo\Tests;

use PHPUnit\Framework\TestCase;
use Farran\Geo\Dto\{Ip, Location};
use Farran\Geo\Locator\{LocatorInterface, ChainLocator};

/**
 * Class ChainLocatorTest
 *
 * @package Farran\Geo\Tests
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class ChainLocatorTest extends TestCase
{
    public function testSuccess(): void
    {
        $locators = [
            $this->mockLocator(null),
            $this->mockLocator($expected = new Location('Expected', 'Region', null)),
            $this->mockLocator(null),
            $this->mockLocator(new Location('Other', null, null)),
            $this->mockLocator(null),
        ];

        $chainLocator = new ChainLocator(...$locators);
        $actual = $chainLocator->locate(new Ip('8.8.8.8'));

        self::assertNotNull($actual);
        self::assertEquals($expected ,$actual);
    }

    private function mockLocator(?Location $location): LocatorInterface
    {
        $mock = $this->createMock(LocatorInterface::class);
        $mock->method('locate')->willReturn($location);

        return $mock;
    }
}

<?php

namespace Farran\Geo\Tests;

use Farran\Geo\Dto\Location;
use PHPUnit\Framework\TestCase;

/**
 * Class LocationTest
 *
 * @package Farran\Geo\Tests
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class LocationTest extends TestCase
{
    public function testFullObject()
    {
        $location = new Location('United States', 'California', 'Mountain View');
    }
}

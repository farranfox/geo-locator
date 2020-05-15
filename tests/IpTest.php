<?php

namespace Farran\Geo\Tests;

use Farran\Geo\Dto\Ip;
use PHPUnit\Framework\TestCase;

/**
 * Class IpTest
 *
 * @package Farran\Geo\Tests
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class IpTest extends TestCase
{
    public function testIp4(): void
    {
        $ip = new Ip($value = '8.8.8.8');
        self::assertEquals($value, $ip->getValue());
    }

    public function testIp6(): void
    {
        $ip = new Ip($value = '2607:f0d0:1002:51::4');
        self::assertEquals($value, $ip->getValue());
    }

    public function testInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Ip('invalid');
    }

    public function testEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Ip('');
    }
}

<?php declare(strict_types=1);

namespace Farran\Geo\Dto;

/**
 * Class Ip
 *
 * @package Farran\Geo\Dto
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
final class Ip
{
    /**
     * @var string
     */
	private $value;

    /**
     * @param string $ip
     */
	public function __construct(string $ip)
	{
		if (empty($ip)) {
			throw new \InvalidArgumentException('Empty IP address.');
		}

		if (
		    filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false and
            filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false
        ) {
			throw new \InvalidArgumentException('Invalid IP address ' . $ip);
		}

		$this->value = $ip;
	}

    /**
     * @return string
     */
	public function getValue(): string
	{
		return $this->value;
	}
}

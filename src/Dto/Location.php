<?php declare(strict_types=1);

namespace Farran\Geo\Dto;

/**
 * Class Location
 *
 * @package Farran\Geo\Dto
 * @author  Farukh Narzullaev <faruh.narzullaev@bk.ru>
 */
class Location 
{
    /**
     * @var string
     */
	private $country;

    /**
     * @var string|null
     */
	private $region;

    /**
     * @var string|null
     */
	private $city;

    /**
     * @param string      $country
     * @param string|null $region
     * @param string|null $city
     */
	public function __construct(string $country, ?string $region, ?string $city)
	{
		$this->country = $country;
		$this->region  = $region;
		$this->city    = $city;
	}

    /**
     * @return string
     */
	public function getCountry(): string 
	{
		return $this->country;
	}

    /**
     * @return string|null
     */
	public function getRegion(): ?string
	{
		return $this->region;
	}

    /**
     * @return string|null
     */
	public function getCity(): ?string
	{
		return $this->city;
	}

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->country . ', ' . $this->region . ', ' . $this->city;
	}
}

<?php

namespace IpInfo\Lib;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class IpinfoResponse
 *
 * @package IpInfo\Lib
 */
class IpinfoResponse
{
    const IP = 'ip';
    const HOSTNAME = 'hostname';
    const LOC = 'loc';
    const ORG = 'org';
    const CITY = 'city';
    const REGION = 'region';
    const COUNTRY = 'country';
    const PHONE = 'phone';
    const POSTAL = 'postal';


    /**
     * Contains all the properties of the host.
     *
     * @var array
     */
    protected $properties;

    /**
     * Contains the status code ipInfo http response.
     * @var integer
     */
    protected $statusCode;

    /**
     * Create an IpinfoResponse object with all the properties.
     *
     * @param JsonResponse $response
     */
    public function __construct(JsonResponse $response)
    {
        $this->statusCode = $response->getStatusCode();

        $properties = json_decode($response->getContent(), true);
        //Merge default values
        $this->properties = array_merge(array(
                static::CITY => '',
                static::COUNTRY => '',
                static::HOSTNAME => '',
                static::IP => '',
                static::LOC => '',
                static::ORG => '',
                static::PHONE => '',
                static::POSTAL => '',
                static::REGION => '',
        ), $properties);
    }

    /**
     * Get the city value.
     */
    public function getCity()
    {
        return $this->properties[static::CITY];
    }

    /**
     * Get the country value.
     */
    public function getCountry()
    {
        return $this->properties[static::COUNTRY];
    }

    /**
     * Get the hostname value.
     */
    public function getHostname()
    {
        return $this->properties[static::HOSTNAME];
    }

    /**
     * Get the ip value.
     */
    public function getIp()
    {
        return $this->properties[static::IP];
    }

    /**
     * Get the loc value.
     */
    public function getLoc()
    {
        return $this->properties[static::LOC];
    }

    /**
     * Get the org value.
     */
    public function getOrg()
    {
        return $this->properties[static::ORG];
    }

    /**
     * Get the phone value.
     */
    public function getPhone()
    {
        return $this->properties[static::PHONE];
    }

    /**
     * Get the postal value.
     */
    public function getPostal()
    {
        return $this->properties[static::POSTAL];
    }

    /**
     * Get the region value.
     */
    public function getRegion()
    {
        return $this->properties[static::REGION];
    }

    /**
     * Get all the properties.
     *
     * @return array An associative array with all the properties.
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Get the status code ipinfo response.
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}

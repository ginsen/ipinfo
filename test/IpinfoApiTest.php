<?php

namespace IpInfo\Test;

use IpInfo\Lib\IpinfoApi;

class IpinfoApiTest extends \PHPUnit_Framework_TestCase
{
    const IP_FOR_TEST = '8.8.8.8';

    public function testResponseIpinfoFullDetails()
    {
        $ipInfo = new IpinfoApi();
        $response = $ipInfo->getFullIpDetails(static::IP_FOR_TEST);

        static::assertInstanceOf('IpInfo\Lib\IpinfoResponse', $response);
        static::assertEquals(200, $response->getStatusCode());
        static::assertEquals(static::IP_FOR_TEST, $response->getIp());
        static::assertEquals('Mountain View', $response->getCity());
        static::assertEquals('California', $response->getRegion());
        static::assertEquals('US', $response->getCountry());
        static::assertEquals('37.3860,-122.0840', $response->getLoc());
        static::assertEquals(94035, $response->getPostal());
    }


    public function testResponseIpinfoGeoDetails()
    {
        $ipInfo = new IpinfoApi();
        $response = $ipInfo->getIpGeoDetails(static::IP_FOR_TEST);

        static::assertInstanceOf('IpInfo\Lib\IpinfoResponse', $response);
        static::assertEquals(200, $response->getStatusCode());
        static::assertEquals(static::IP_FOR_TEST, $response->getIp());
        static::assertEquals('Mountain View', $response->getCity());
        static::assertEquals('California', $response->getRegion());
        static::assertEquals('US', $response->getCountry());
        static::assertEquals('37.3860,-122.0840', $response->getLoc());
        static::assertEquals(94035, $response->getPostal());

        static::assertEmpty($response->getHostname());
        static::assertEmpty($response->getOrg());
    }
}

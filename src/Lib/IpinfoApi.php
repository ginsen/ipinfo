<?php

namespace IpInfo\Lib;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class IpinfoApi, ipinfo.io service wrapper.
 *
 * @package IpInfo\Lib
 */
class IpinfoApi
{
    const BASE_URL = 'http://ipinfo.io/';
    const GEO      = 'geo';
    const TOKEN    = 'token';


    /** @var array  */
    protected $settings;


    /**
     * IpinfoApi constructor.
     * @param array|null $settings An array with all the settings.
     *                        Supported keys are:
     *                        - token: string the developer token;
     */
    public function __construct($settings = array())
    {
        $this->settings = array_merge(array(
                static::TOKEN => '',
        ), $settings);
    }


    /**
     * Get all the info about your own ip address.
     *
     * @return IpinfoResponse
     */
    public function getYourOwnIpDetails()
    {
        $response = $this->sendRequest($this::BASE_URL.'json');

        return new IpinfoResponse($response);
    }


    /**
     * Get all the info about an ip address.
     *
     * @param string $ipAddress
     * @return IpinfoResponse
     */
    public function getFullIpDetails($ipAddress)
    {
        $response = $this->sendRequest($this::BASE_URL.$ipAddress);

        return new IpinfoResponse($response);
    }


    /**
     * Use the /geo call to get just the geolocation information, which will often be
     * faster than getting the full response.
     *
     * @param string $ipAddress
     *
     * @return IpinfoResponse
     */
    public function getIpGeoDetails($ipAddress)
    {
        $response = $this->sendRequest($this::BASE_URL.$ipAddress.'/'.static::GEO);

        return new IpinfoResponse($response);
    }


    /**
     * Make a curl request.
     *
     * @param string $address The address of the request.
     *
     * @return JsonResponse Returns the response from the request.
     */
    protected function sendRequest($address)
    {
        $curl = curl_init();

        if (!empty($this->settings[static::TOKEN])) {
            $address .= '?token='.$this->settings[static::TOKEN];
        }

        curl_setopt_array($curl, array(
            CURLOPT_HEADER         => 0,
            CURLINFO_HEADER_OUT    => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL            => $address,
        ));

        $response = curl_exec($curl);
        $headers  = curl_getinfo($curl);

        curl_close($curl);

        return new JsonResponse($response, $headers['http_code'], $headers, true);
    }
}

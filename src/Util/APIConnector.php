<?php

namespace Launch\Util;

class APIConnector
{
    const BASE_ENDPOINT = 'https://api.spacexdata.com/v3/launches';

    private $endpoint;
    private $casher;

    public function __construct($pageType = '')
    {
        if (empty($pageType))
        {
            $this->endpoint = static::BASE_ENDPOINT;
        }
        else
        {
            $this->endpoint = static::BASE_ENDPOINT . DIRECTORY_SEPARATOR . $pageType;
        }
        $this->casher = new Cacher($pageType);
    }

    /**
     * Get the response from SpaceX as associative array.
     *
     * @return array|false Return the response as array or false is there is an error.
     */
    public function getDecodedResponse()
    {
        $jsonFromCasher = $this->casher->getCachedFile();
        if ($jsonFromCasher != false)
        {
            return json_decode($jsonFromCasher, true);
        }

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->endpoint);
        // Set some default CURL options
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($curl);
        $this->casher->saveCacheFile($response);

        return json_decode($response, true);
    }
}


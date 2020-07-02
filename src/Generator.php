<?php

namespace Launch;

use Launch\Util\APIConnector;

abstract class Generator implements GeneratorInterface
{

    protected $response;

    public function __construct($pageType = '')
    {
        $this->response = $this->getResponse($pageType);;
    }

    /**
     * Get the response for the current page type.
     *
     * @param string $pageType The page type.
     * @return array|false Return the response or false if there is an error.
     */
    private function getResponse($pageType)
    {
        $apiConnector = new APIConnector($pageType);
        return $apiConnector->getDecodedResponse();
    }

}
<?php

namespace Launch\Util;

class Cacher
{
    const CACHE_FILES_EXTENSION = '.json';
    const CACHE_TIME = 2 * 60 * 60;

    private $filePath;

    public function __construct($pageType)
    {
        if (empty($pageType))
        {
            $pageType = 'all';
        }

        $directory = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'cache';
        $this->filePath = $directory . DIRECTORY_SEPARATOR . $pageType . self::CACHE_FILES_EXTENSION;
    }

    /**
     * Get the cached file.
     *
     * @return bool|string Return the cached file content or false if there is an error.
     */
    public function getCachedFile()
    {
        if (file_exists($this->filePath) == false)
        {
            return false;
        }

        if (filectime($this->filePath) < (date('U') - self::CACHE_TIME))
        {
            return false;
        }

        return file_get_contents($this->filePath);
    }

    /**
     * Save the response in cached file.
     *
     * @param string $json The content of the response.
     */
    public function saveCacheFile($json)
    {
        file_put_contents($this->filePath, $json);
    }

}
<?php

/**
 * Used to model the http query
 * @author Nicolas Rellier <nicolasrellier@yahoo.fr>
 */

class Request
{
    private $url = '';
    private $urlExploded = [];

    /**
     * Retrieve the url and  cleant it before isole elements in array
     */
    function __construct()
    {
        $this->setUrl($_SERVER['REQUEST_URI']);
        $this->setUrlExploded($this->getUrl());
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return [array | null]    return element contained in url
     */
    public function getUrlExploded(): ?array
    {
        return $this->urlExploded ?? null;
    }

    /**
     * @param  int    $index element lookinf for
     * @return string |    null Return an element of the url
     */
    public function getUrlExplodedByIndex(int $index): ?string
    {
        return $this->urlExploded[$index] ?? null;
    }

    public function setUrlExploded(string $url)
    {
        $uri = trim(parse_url($url, PHP_URL_PATH), "/");
        $this->urlExploded = explode("/", $uri);
    }

    /**
     * Looking for $_POST value
     * @return int | null    id article or null if different of isset and empty string
     */
    public function getPostParam($article, $result = null): ?int
    {
        return (isset($_POST[$article]) && $_POST[$article] != '') ? $_POST[$article] : $result;
    }

    /**
     * Lookinf for $_GET value
     * @return int | null    if different of isset and empty string
     */
    public function getGetParam($article, $result = null): ?int
    {
        return (isset($_GET[$article]) && $_GET[$article] != '') ? $_GET[$article] : $result;
    }

    /**
     * Call getPostParam and if different of isset getGetParam and empty string
     * @param  string    $article the desired value
     * @param $default    returned value by default
     * @return string | null    Return $default argument if getPostParam or getGetParam is différent of isset and empty string
     */
    public function getParam(string $article, $default = null): ?string
    {
        return $this->getPostParam($article) ?? $this->getGetParam($article) ?? $default;
    }
}

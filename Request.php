<?php

class Request
{
    private $url = '';
    private $urlExploded = [];

    function __construct()
    {
        $this->setUrl($_SERVER['REQUEST_URI']);
        //$this->setUrlExploded($_SERVER['REQUEST_URI']);
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

    // return the url tab
    public function getUrlExploded(): ?array
    {
        return $this->urlExploded ?? null;
    }

    // return one of this uri
    public function getUrlExplodedByIndex(int $index): ?string
    {
        return $this->urlExploded[$index] ?? null;
    }

    public function setUrlExploded(string $url)
    {
        $uri = trim(parse_url($url, PHP_URL_PATH), "/");
        $this->urlExploded = explode("/", $uri);
    }

    // return null if different from isset and empty string
    public function getPostParam($article, $result = null): ?int
    {
        return (isset($_POST[$article]) && $_POST[$article] != '') ? $_POST[$article] : $result;
    }

    // return null if different from isset and empty string
    public function getGetParam($article, $result = null): ?int
    {
        return (isset($_GET[$article]) && $_GET[$article] != '') ? $_GET[$article] : $result;
    }

    // call getGetPara and if nothing is found getPostParam
    public function getParam(string $article, $default = null): ?string
    {
        return $this->getPostParam($article) ?? $this->getGetParam($article) ?? $default;
    }
}

<?php

namespace Core;

/**
 * Used to model the http query
 * @author Nicolas Rellier <nicolasrellier@yahoo.fr>
 *
 * Retrieve the url and clean it before isole elements in array
 *
 * Exemple:
 *     monsite.fr/article/edit
 *     new Request() = {
 *         url : /article/edit
 *         urlExploded : [
 *             '0' => 'article',
 *             '1' => 'edit'
 *         ];
 *     }
 *
 *     monsite.fr/article
 *     new Request() = {
 *         url: /article/
 *         urlExploded : [
 *             '0' => 'article'
 *         ]
 *     }
 *
 *     monsite.fr/
 *     new Request() = {
 *         url: /
 *         urlExploded: [];
 *     }
 */

class Request
{
    private $url = '';
    private $urlExploded = [];
    private static $instance = null;

    private function __construct()
    {
        $this->setUrl($_SERVER['REQUEST_URI'] ?? '');
        $this->setUrlExploded($this->explodeUrl($this->getUrl()));
    }

    public static function getInstance(): Request
    {
        if (is_null(self::$instance)) {
            self::$instance = new Request();
        }
        return self::$instance;
    }

    /**
     * Getter to the url
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Setter to the url
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return null Return element contained in url
     */
    public function getUrlExploded(): array
    {
        return $this->urlExploded;
    }

    /**
     * @param  int $index Element lookinf for
     * @return string|null Return an element of the url
     */
    public function getUrlExplodedByIndex(int $index): ?string
    {
        return $this->urlExploded[$index] ?? null;
    }

    public function explodeUrl(string $url)
    {
        $uri = trim(parse_url($url, PHP_URL_PATH), "/");
        return explode("/", $uri);
    }

    public function setUrlExploded(array $urlExploded)
    {
        $this->urlExploded = $urlExploded;
    }

    /**
     * Looking for $_POST value
     * @return array|null Return array of searchValue or null if different of isset and empty string
     */
    public function getPostParam(string $searchValue, $defaultValue = null)
    {
        return (isset($_POST[$searchValue]) && $_POST[$searchValue] != '')
            ? $_POST[$searchValue]
            : $defaultValue;
    }

    /**
     * Lookinf for $_GET value
     * @return int|null If different of isset and empty string
     */
    public function getGetParam(string $searchValue, $defaultValue = null)
    {
        return (isset($_GET[$searchValue]) && $_GET[$searchValue] != '')
            ? $_GET[$searchValue]
            : $defaultValue;
    }

    /**
     * Call getPostParam and if different of isset getGetParam and empty string
     * @param  string $searchValue The desired value
     * @param $default Returned value by default
     * @return array|string|null Return $default argument if getPostParam or getGetParam is différent of isset and empty string
     */
    public function getParam(string $searchValue, $defaultValue = null)
    {
        return $this->getPostParam($searchValue)
            ?? $this->getGetParam($searchValue)
            ?? $defaultValue;
    }
}

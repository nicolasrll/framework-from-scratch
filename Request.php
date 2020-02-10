<?php

class Request
{
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

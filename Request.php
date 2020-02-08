<?php

class Request
{
    // return null if different from isset and empty string
    public function getPostParam($article, $result = null): ?int
    {
        if (isset($_POST[$article]) && $_POST[$article] != '') {
            $result = $_POST[$article];
        }

        return $result;
    }

    // return null if different from isset and empty string
    public function getGetParam($article, $result = null): ?int
    {
        if (isset($_GET[$article]) && $_GET[$article] != '') {
            $result = $_GET[$article];
        }

        return $result;
    }

    // call getGetPara and if nothing is found getPostParam
    public function getParam(string $article, $default = null): ?int
    {
        $result = $this->getPostParam($article);
        if (null === $result) {
            $result = $this->getGetParam($article);
        }
        if (null === $result) {
            $result = $default;
        }

        return $result;
    }
}

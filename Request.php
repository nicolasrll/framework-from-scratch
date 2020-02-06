<?php

class Request
{
    public function getPostParam($article, $result = null)
    {
        if (isset($_POST[$article]) && $_POST[$article] != '') {
            $result = $_POST[$article];
        }

        return $result;
    }

    public function getGetParam($article, $result = null)
    {
        if (isset($_GET[$article]) && $_GET[$article] != '') {
            $result = $_GET[$article];
        }

        return $result;
    }

    // appel getGetPara et getPostParam
    public function getParam(string $article, $result = 7)
    {
        $post = $this->getPostParam($article);
        if(isset($post)) {
            $result = $post;
        } else {
            $result = $this->getGetParam($article);
        }

        return $result;
    }
}

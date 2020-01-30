<?php

class Request
{
    public function getPostParam($article)
    {
        if (!isset($_POST[$article])) {
            return;
        }
        return $_POST[$article];
    }

    public function getGetParam($article)
    {
        if (!isset($_GET[$article])) {
            return null;
        }

        return $_GET[$article];
    }

    // appel getGetPara et getPostParam
    public function getParam($article)
    {
        $post = $this->getPostParam($article);
        if(!isset($post)) {
            $get = $this->getGetParam($article);
            return $get;
        }
        return $post;

    }
}

<?php

require_once('Request.php');
require_once('Router.php');

$request = new Request();

//$router = new Router();
$router = new Router($request);


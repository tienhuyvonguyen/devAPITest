<?php
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/simpleRest.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/ProductRestHandler.php');

$token = null;
$headers = apache_request_headers();
if (isset($headers['Authorization'])) {
    $token = $headers['Authorization'];
    // substring the Bearer part
    $token = substr($token, 7);
    $userRestHandler = new UserRestHandler();
    $result = $userRestHandler->protectedAPI($token, $secret_key);
}

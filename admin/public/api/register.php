<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/userRestHandler.php');

$username = null;
$password = null;
$email = null;

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = strtoupper($_POST['username']);
    $password = $_POST['password'];
    $email = $_POST['email'];
    $userRestHandler = new UserRestHandler();
    $userRestHandler->register($username, $password, $email);
} else {
    $controller->setHttpHeaders(400, $method);
    $response = $controller->encode_json(array('error' => 'Missing parameter!'));
    echo $response;
}

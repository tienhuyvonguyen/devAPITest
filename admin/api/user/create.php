<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/userRestHandler.php');

$token = null;
$controller = new SimpleRest();
$headers = apache_request_headers();
$method = $_SERVER['REQUEST_METHOD'];
$username = null;
$password = null;
$email = null;

if (isset($headers['Authorization'])) { // Check token
    $token = $headers['Authorization'];
    $valid = (array)$controller->validateToken($token);
    // var_dump($valid);
    // die();
    if ($valid[0] === false || empty($valid)) { // Invalid token
        $controller->setHttpHeaders(401, $method);
        $response = $controller->encode_json(array('error' => 'Invalid token!'));
        echo $response;
    } elseif ($valid['data']->role === 1) { // Admin only
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
            $username = strtoupper($_POST['username']);
            $password = $_POST['password'];
            $email = $_POST['email'];
            $userRestHandler = new UserRestHandler();
            $userRestHandler->createUser($username, $password, $email);
        } else {
            $controller->setHttpHeaders(400, $method);
            $response = $controller->encode_json(array('error' => 'Missing parameter!'));
            echo $response;
        }
    }
} else { // Missing token
    $controller->setHttpHeaders(401, $method);
    $response = $controller->encode_json(array('error' => 'Missing token!'));
    echo $response;
}

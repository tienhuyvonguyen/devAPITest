<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/userRestHandler.php');

$token = null;
$controller = new SimpleRest();
$headers = apache_request_headers();
$method = $_SERVER['REQUEST_METHOD'];
$view = $_GET['view'];

if (isset($headers['Authorization'])) {
    $token = $headers['Authorization'];
    $valid = (array)$controller->validateToken($token);
    // var_dump($valid['data']->role);
    // die();
    if ($valid[0] === false) {
        $controller->setHttpHeaders(401, $method);
        $response = $controller->encode_json(array('error' => 'Invalid token!'));
        echo $response;
    } else {
        $userRestHandler = new UserRestHandler();
        switch ($view) {
            case "all":
                if ($valid['data']->role !== 1) {
                    $controller->setHttpHeaders(401, $method);
                    $response = $controller->encode_json(array('error' => 'Admin function only!'));
                    echo $response;
                    break;
                }
                $userRestHandler->getAllUsers();
                break;
            case "single":
                $username = $_GET['username'];
                $userRestHandler->getSingleUser($username);
                break;
            default:
                $controller->setHttpHeaders(400, $method);
                $response = $controller->encode_json(array('error' => 'Invalid parameter!'));
                echo $response;
        }
    }
} else {
    $controller->setHttpHeaders(401, $method);
    $response = $controller->encode_json(array('error' => 'Missing token!'));
    echo $response;
}

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/userRestHandler.php');

$token = null;
$controller = new SimpleRest();
$headers = apache_request_headers();
$method = $_SERVER['REQUEST_METHOD'];
if ('PUT' === $method) {
    parse_str(file_get_contents('php://input'), $_PUT);
}

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
        if (isset($_PUT['username']) && isset($_PUT['email'])) {
            // $array = array('username' => $_PUT['username'], 'email' => $_PUT['email']);
            // $encodeed_data = json_encode($array);
            // $userRestHandler = new UserRestHandler();
            // $userRestHandler->updateUser($encodeed_data);
            $username = strtoupper($_PUT['username']);
            $userEmail = $_PUT['email'];
            $userRestHandler = new UserRestHandler();
            $userRestHandler->updateUser($username, $userEmail);
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

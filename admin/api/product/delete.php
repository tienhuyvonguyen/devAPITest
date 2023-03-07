<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/productRestHandler.php');

$token = null;
$controller = new SimpleRest();
$headers = apache_request_headers();
$method = $_SERVER['REQUEST_METHOD'];

if ('DELETE' === $method) {
    parse_str(file_get_contents('php://input'), $_DELETE);
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
        if (isset($_DELETE['id'])) {
            $id = $_DELETE['id'];
            $product = new ProductRestHandler();
            $product->deleteProduct($id);
        } else {
            $controller->setHttpHeaders(400, $method);
            $response = $controller->encode_json(array('error' => 'Missing data!'));
            echo $response;
        }
    } else { // Not admin
        $controller->setHttpHeaders(401, $method);
        $response = $controller->encode_json(array('error' => 'Login as admin!'));
        echo $response;
    }
} else { // Missing token
    $controller->setHttpHeaders(401, $method);
    $response = $controller->encode_json(array('error' => 'Missing token!'));
    echo $response;
}

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/productRestHandler.php');

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
        if (isset($_PUT['id']) && isset($_PUT['name']) && isset($_PUT['price']) && isset($_PUT['stock'])) {
            $id = $_PUT['id'];
            $name = $_PUT['name'];
            $price = $_PUT['price'];
            $stock = $_PUT['stock'];
            $product = new ProductRestHandler();
            $product->updateProduct($id, $name, $price, $stock);
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

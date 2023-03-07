<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// include database and object files
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/Database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/class/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/class/Product.php');
require($_SERVER['DOCUMENT_ROOT'] . '/controller/simpleRest.php');

$controller = new SimpleRest();

// instantiate database and User object
try {
    $db = new Database();
    $user = new User($db->getConnection());
    $rawData = $user->getAllUsers();
    if (empty($rawData)) {
        $statusCode = 404;
        $rawData = array('error' => 'No users found!');
    } else {
        $statusCode = 200;
    }
    $method = $_SERVER['REQUEST_METHOD'];
    $controller->setHttpHeaders($statusCode, $method);
    $response = $controller->encode_json($rawData);
    echo $response;
} catch (Exception $e) {
    $statusCode = 400;
    $rawData = array('error' => 'Fail to get user!');
    $controller->setHttpHeaders($statusCode, $method);
    $response = $controller->encode_json($rawData);
    echo $response;
}

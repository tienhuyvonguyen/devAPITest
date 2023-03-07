<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/productRestHandler.php');

$controller = new SimpleRest();
$method = $_SERVER['REQUEST_METHOD'];
$view = $_GET['view'];

switch ($view) {
    case "all":
        $product = new ProductRestHandler();
        $product->getAllProducts();
        break;
    case "single":
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = new ProductRestHandler();
            $product->getSingleProductByID($id);
        } else {
            $controller->setHttpHeaders(400, $method);
            $response = $controller->encode_json(array('error' => 'Missing id!'));
            echo $response;
        }
        break;
    default:
        $controller->setHttpHeaders(400, $method);
        $response = $controller->encode_json(array('error' => 'Invalid view!'));
        echo $response;
        break;
}

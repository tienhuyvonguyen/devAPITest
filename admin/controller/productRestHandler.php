<?php

require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/class/Product.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/Database.php');
require($_SERVER['DOCUMENT_ROOT'] . '/controller/simpleRest.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use OpenApi\Annotations as OA;

class ProductRestHandler extends SimpleRest
{
    public function getAllProducts()
    {
        try {
            $db = new Database();
            $product = new Product($db->getConnection());
            $rawData = $product->getAllProducts();
            if (empty($rawData)) {
                $statusCode = 404;
                $rawData = array('error' => 'No products found!');
            } else {
                $statusCode = 200;
            }
            $method = $_SERVER['REQUEST_METHOD'];
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Fail to get product!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }

    public function getSingleProductByID($id)
    {
        try {
            $db = new Database();
            $product = new Product($db->getConnection());
            if (empty($id)) {
                $statusCode = 400;
                $rawData = array('error' => 'Missing id!');
            } else {
                $rawData = $product->getSingleProductByID($id);
                if (empty($rawData)) {
                    $statusCode = 404;
                    $rawData = array('error' => 'No product found!');
                } else {
                    $statusCode = 200;
                }
            }
            $method = $_SERVER['REQUEST_METHOD'];
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Fail to get product!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }
    public function createProduct($name, $price, $stock)
    {
        try {
            $db = new Database();
            $product = new Product($db->getConnection());
            if (empty($name) || empty($price) || empty($stock)) {
                $statusCode = 400;
                $rawData = array('error' => 'Missing data!');
            } else {
                $resp = $product->createProduct($name, $price, $stock);
                if ($resp) {
                    $statusCode = 200;
                    $rawData = array('success' => 'Product created!');
                } else {
                    $statusCode = 404;
                    $rawData = array('error' => 'Fails to create product!');
                }
            }
            $method = $_SERVER['REQUEST_METHOD'];
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Fail to create product!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }

    public function updateProduct($id, $name, $price, $stock)
    {
        try {
            $db = new Database();
            $product = new Product($db->getConnection());
            if (empty($id) || empty($name) || empty($price) || empty($stock)) {
                $statusCode = 400;
                $rawData = array('error' => 'Missing data!');
            } else {
                $resp = $product->updateProduct($id, $name, $price, $stock);
                if ($resp) {
                    $statusCode = 200;
                    $rawData = array('success' => 'Product updated!');
                } else {
                    $statusCode = 404;
                    $rawData = array('error' => 'Fails to update product!');
                }
            }
            $method = $_SERVER['REQUEST_METHOD'];
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Fail to update product!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }

    public function deleteProduct($id)
    {
        try {
            $db = new Database();
            $product = new Product($db->getConnection());
            if (empty($id)) {
                $statusCode = 400;
                $rawData = array('error' => 'Missing id!');
            } else {
                $resp = $product->deleteProduct($id);
                if ($resp) {
                    $statusCode = 200;
                    $rawData = array('success' => 'Product deleted!');
                } else {
                    $statusCode = 404;
                    $rawData = array('error' => 'Fails to delete product!');
                }
            }
            $method = $_SERVER['REQUEST_METHOD'];
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Fail to delete product!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }
}

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config/Database.php');
require($_SERVER['DOCUMENT_ROOT'] . '/controller/simpleRest.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/class/User.php');
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use OpenApi\Annotations as OA;

class UserRestHandler extends SimpleRest
{

    public function getAllUsers()
    {
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
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Fail to get user!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }

    public function getSingleUser($username)
    {
        try {
            $db = new Database();
            $user = new User($db->getConnection());
            if (empty($username)) {
                $statusCode = 400;
                $rawData = array('error' => 'Missing username!');
            } else {
                $rawData = $user->getSingleUser($username);
                if (empty($rawData)) {
                    $statusCode = 404;
                    $rawData = array('error' => 'No user found!');
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
            $rawData = array('error' => 'Fail to get user!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }

    public function deleteUser($username)
    {
        try {
            $db = new Database();
            $user = new User($db->getConnection());
            if (empty($username)) {
                $statusCode = 400;
                $rawData = array('error' => 'Missing username!');
            } else {
                $rawData = $user->deleteUser($username);
                $statusCode = 200;
                $rawData = array('success' => 'User deleted successfully!');
            }
            $method = $_SERVER['REQUEST_METHOD'];
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Fail to delete user!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }

    public function updateUser($username, $userEmail)
    {
        try {
            $db = new Database();
            $user = new User($db->getConnection());
            if (empty($username) || empty($userEmail)) {
                $statusCode = 400;
                $rawData = array('error' => 'Missing parameters!');
            } else {
                $rawData = $user->updateUser($username, $userEmail);
                $statusCode = 200;
                $rawData = array('success' => 'User updated successfully!');
            }
            $method = $_SERVER['REQUEST_METHOD'];
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Fail to update user!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }

    public function createUser($username, $userPassword, $userEmail)
    {
        try {
            $db = new Database();
            $user = new User($db->getConnection());
            if (!empty($username) && !empty($userPassword) && !empty($userEmail)) {
                $rawData = $user->createUser($username, $userPassword, $userEmail);
                $statusCode = 200;
                $rawData = array('success' => 'User created successfully!');
            } else {
                $statusCode = 400;
                $rawData = array('error' => 'Missing parameters!');
            }
            $method = $_SERVER['REQUEST_METHOD'];
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Fail to create user!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }

    public function login($username, $password)
    {
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            $db = new Database();
            $user = new User($db->getConnection());
            if (empty($username) || empty($password)) {
                $statusCode = 400;
                $rawData = array('error' => 'Missing username or password!');
            } else {
                $rawData = $user->login($username, $password);
                if (empty($rawData)) {
                    $statusCode = 400;
                    $rawData = array('error' => 'Login Failed!');
                } else {
                    $statusCode = 200;
                    $rawData = array('success' => 'Login Successful!', 'token' => $rawData);
                }
            }
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Login Failed!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }
    // public function protectedAPI($token, $secret_key)
    // {
    //     try {
    //         $rawData = $this->validateToken($token, $secret_key);
    //         if (empty($rawData)) {
    //             $statusCode = 401;
    //             $rawData = array('error' => 'Unauthorized!');
    //         } else {
    //             $statusCode = 200;
    //             $rawData = array('success' => 'Authorized!');
    //         }
    //         $method = $_SERVER['REQUEST_METHOD'];
    //         $this->setHttpHeaders($statusCode, $method);
    //         $response = $this->encode_json($rawData);
    //         echo $response;
    //     } catch (Exception $e) {
    //         $statusCode = 400;
    //         $rawData = array('error' => 'Fail to validate token!');
    //         $this->setHttpHeaders($statusCode, $method);
    //         $response = $this->encode_json($rawData);
    //         echo $response;
    //     }
    // }

    public function register($username, $password, $email)
    {
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            $db = new Database();
            $user = new User($db->getConnection());
            if (empty($username) || empty($password) || empty($email)) {
                $statusCode = 400;
                $rawData = array('error' => 'Missing parameters!');
            } else {
                $rawData = $user->register($username, $password, $email);
                if (empty($rawData)) {
                    $statusCode = 400;
                    $rawData = array('error' => 'Registration Failed!');
                } else {
                    $statusCode = 200;
                    $rawData = array('success' => 'Registration Successful!', 'token' => $rawData);
                }
            }
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        } catch (Exception $e) {
            $statusCode = 400;
            $rawData = array('error' => 'Registration Failed!');
            $this->setHttpHeaders($statusCode, $method);
            $response = $this->encode_json($rawData);
            echo $response;
        }
    }
}

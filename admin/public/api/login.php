<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/userRestHandler.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = strtoupper($_POST['username']);
    $password = $_POST['password'];
    $userRestHandler = new UserRestHandler();
    $userRestHandler->login($username, $password);
}

<?php
require_once(__DIR__ . '/classes/Auth.php');
session_start();

$auth = $_SESSION['auth'];
$userInfo = $auth->getUserInfo();
var_dump($userInfo);
<?php
require_once(dirname(__DIR__ ) . '/classes/Auth.php');
session_start();

$auth = new Auth();
$_SESSION['auth'] = $auth;
$auth->handleLogin();

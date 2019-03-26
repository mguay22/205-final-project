<?php
require_once(dirname(__DIR__ ) . '/classes/Auth.php');

$auth = new Auth(); 
$auth->handleLogin();
$auth->getUserInfo();
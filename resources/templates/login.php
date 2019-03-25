<?php
namespace BillBuddy;
use BillBuddy\Auth;

spl_autoload_register(function ($className) {
    include $className . '.php';
});

$auth = new Auth(); 
$auth->getUserInfo();
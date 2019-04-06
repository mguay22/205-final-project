<?php
require_once(dirname(__DIR__) . '/classes/Auth.php');
require_once('Connect-With-Database.php');

$auth = new Auth($thisDatabaseReader, $thisDatabaseWriter);
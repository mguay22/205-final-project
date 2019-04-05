<?php
/**
 * Created by PhpStorm.
 * User: joshuachilds
 * Date: 2019-04-04
 * Time: 21:20
 */
require_once(__DIR__ . '/templates/top.php');





/**
 ********************** SELECT ALL FROM BILL table ***************************
 */


$query = 'SELECT * ';
$query .= 'FROM bill ';

if ($thisDatabaseReader->querySecurityOk($query,0)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
    $records = $thisDatabaseReader->select($query);

}

if (DEBUG) {
    print '<p>Contents of the array<pre>';
    print_r($records);
    print '</pre></p>';
}


/**
 ************************ SELECT ALL FROM user Table ****************************
 */

$records = $thisDatabaseReader->testSecurityQuery($query, 0);


$query = 'SELECT * ';
$query .= 'FROM user ';

if ($thisDatabaseReader->querySecurityOk($query,0)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
    $records = $thisDatabaseReader->select($query);

}

if (DEBUG) {
    print '<p>Contents of the array<pre>';
    print_r($records);
    print '</pre></p>';
}

/**
 * *********************** SELECT Bills on Address **************************
 */



$query = 'SELECT * ';
$query .= 'FROM bill ';
$query .= 'INNER JOIN address ';
$query .= 'WHERE bill.addressId = address.id ';

$records = $thisDatabaseReader->testSecurityQuery($query);


if ($thisDatabaseReader->querySecurityOk($query)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
    $records = $thisDatabaseReader->select($query);

}

if (DEBUG) {
    print '<p>Contents of the array<pre>';
    print_r($records);
    print '</pre></p>';
}


/**
 * *********************** SELECT USERS on Address **************************
 */



$query = 'SELECT * ';
$query .= 'FROM user ';
$query .= 'INNER JOIN address ';
$query .= 'WHERE user.addressId = address.id ';

$records = $thisDatabaseReader->testSecurityQuery($query);


if ($thisDatabaseReader->querySecurityOk($query)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
    $records = $thisDatabaseReader->select($query);

}

if (DEBUG) {
    print '<p>Contents of the array<pre>';
    print_r($records);
    print '</pre></p>';
}


/**
 * *********************** SELECT FILENAME on Address **************************
 */


$query = 'SELECT fileName ';
$query .= 'FROM bill ';
$query .= 'INNER JOIN address ';
$query .= 'WHERE bill.addressId = address.id ';

$records = $thisDatabaseReader->testSecurityQuery($query);


if ($thisDatabaseReader->querySecurityOk($query)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
    $records = $thisDatabaseReader->select($query);

}

if (DEBUG) {
    print '<p>Contents of the array<pre>';
    print_r($records);
    print '</pre></p>';
}


/**
 * *********************** SELECT ADMIN USERS on Address **************************
 */



$query = 'SELECT * ';
$query .= 'FROM user ';
$query .= 'INNER JOIN address ';
$query .= 'WHERE user.addressId = address.id ';
$query .= 'AND user.status = ? ';

$data = array('admin');

$records = $thisDatabaseReader->testSecurityQuery($query, 1, 1);


if ($thisDatabaseReader->querySecurityOk($query, 1, 1)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
    $records = $thisDatabaseReader->select($query, $data);

}

if (DEBUG) {
    print '<p>Contents of the array<pre>';
    print_r($records);
    print '</pre></p>';
}



/**
 * Sample input user SQL
 */





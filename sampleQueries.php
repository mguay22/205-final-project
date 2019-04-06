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

if ($thisDatabaseReader->querySecurityOk($query, 0)) {
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

if ($thisDatabaseReader->querySecurityOk($query, 0)) {
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
 * *********************** SELECT Token on USER **************************
 */


$query = 'SELECT token, id, firstName ';
$query .= 'FROM user ';

$records = $thisDatabaseReader->testSecurityQuery($query, 0, 0);


if ($thisDatabaseReader->querySecurityOk($query, 0, 0)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
    $records = $thisDatabaseReader->select($query);

}

if (DEBUG) {
    print '<p>Contents of the array<pre>';
    print_r($records);
    print '</pre></p>';
}


/**
 * ********************** Sample input user SQL ***********************
 */

// This example does not have a form so these two lines are just to put values
// in manually for this example.
$_POST['id'] = NULL;
$_POST['firstName'] = 'James';
$_POST['lastName'] = 'King';
$_POST['token'] = 'sampletoken3';
$_POST['email'] = 'jamesking@gmail.com';
$_POST['status'] = 'standard';
$_POST['addressId'] = 1;


// create array to hold values for query
$data = array();

// retreive values from form and store in $data array
$id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
$data[] = $id;

$firstName = htmlentities($_POST['firstName'], ENT_QUOTES, 'UTF-8');
$data[] = $firstName;

$lastName = htmlentities($_POST['lastName'], ENT_QUOTES, 'UTF-8');
$data[] = $lastName;

$token = htmlentities($_POST['token'], ENT_QUOTES, 'UTF-8');
$data[] = $token;

$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
$data[] = $email;

$status = htmlentities($_POST['status'], ENT_QUOTES, 'UTF-8');
$data[] = $status;

$addressId = htmlentities($_POST['addressId'], ENT_QUOTES, 'UTF-8');
$data[] = $addressId;

$query = 'INSERT INTO user SET ';
$query .= 'id = ?, ';
$query .= 'firstName = ?, ';
$query .= 'lastName = ?, ';
$query .= 'token = ?, ';
$query .= 'email = ?, ';
$query .= 'status = ?, ';
$query .= 'addressId = ?';


// demonstration of test query method which returns nothing but displays information.
$records = $thisDatabaseWriter->testSecurityQuery($query, 0);

// lets print out the data array so we can see what values would replace the ?
print '<p>Contents of the array<pre>';
print_r($data);
print '</pre></p>';

// this will insert the data, since i dont want Mr. Spacely entered into my table
// again i commented this line out. $records will always be false because of that.
print '<h2>Insert method</h2>';
if ($thisDatabaseWriter->querySecurityOk($query, 0)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
//    $records = $thisDatabaseWriter->insert($query, $data);
}

if ($records) {
    print '<p>Record Saved</p>';
} else {
    print '<p>Record NOT Saved</p>';
}


/**
 * *********************** SELECT Bills on Address with user Specified**************************
 */
function getAddressID($thisDatabaseReader)
{

    $data = array('sampletoken1');

    $query = 'SELECT addressId ';
    $query .= 'FROM user ';
    $query .= 'WHERE token = ? ';
    $records = $thisDatabaseReader->testSecurityQuery($query, 1, 0);


    if ($thisDatabaseReader->querySecurityOk($query, 1, 0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query);
        $records = $thisDatabaseReader->select($query, $data);
    }

    if (DEBUG) {
        print '<p>Contents of the array<pre>';
        print_r($records);
        print '</pre></p>';
    }

}


getAddressID($thisDatabaseReader);

/**
 * *********************** SELECT Bills on Address with user Specified**************************
 */

$data = array(1);

$query = 'SELECT * ';
$query .= 'FROM bill ';
$query .= 'INNER JOIN address ';
$query .= 'WHERE bill.addressId = address.id ';
$query .= 'AND bill.addressId = ? ';

$records = $thisDatabaseReader->testSecurityQuery($query, 1 ,1);


if ($thisDatabaseReader->querySecurityOk($query, 1, 1)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
    $records = $thisDatabaseReader->select($query, $data);

}

if (DEBUG) {
    print '<p>Contents of the array<pre>';
    print_r($records);
    print '</pre></p>';
}

if (is_array($records)) {
    foreach ($records as $record) {
        print '<p>' . $record['type'] . ' ' . $record['dueDate'] . '     ' . $record['amount'] .'</p>';
    }
}

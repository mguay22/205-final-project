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

/**
 * ********************** JC INSERT USER SQL ***********************
 */

// This example does not have a form so these two lines are just to put values
// in manually for this example.
$_POST['id'] = NULL;
$_POST['token'] = 'sampletoken3';
$_POST['email'] = 'jamesking@gmail.com';
$_POST['fullName'] = 'SAMPLE INSERT';
$_POST['username'] = 'sampleuser';
$_POST['password'] = 'samplepass';
$_POST['status'] = 'standard';
$_POST['addressId'] = 1;
$_POST['houseCode'] = 1;




// create array to hold values for query
$data = array();

// retreive values from form and store in $data array
$id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
$data[] = $id;


$token = htmlentities($_POST['token'], ENT_QUOTES, 'UTF-8');
$data[] = $token;

$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
$data[] = $email;


$fullName = htmlentities($_POST['fullName'], ENT_QUOTES, 'UTF-8');
$data[] = $fullName;

$username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
$data[] = $username;

$password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
$data[] = $password;

$status = htmlentities($_POST['status'], ENT_QUOTES, 'UTF-8');
$data[] = $status;

$addressId = htmlentities($_POST['addressId'], ENT_QUOTES, 'UTF-8');
$data[] = $addressId;

$houseCode = htmlentities($_POST['houseCode'], ENT_QUOTES, 'UTF-8');
$data[] = $houseCode;

$query = 'INSERT INTO user SET ';
$query .= 'id = ?, ';
$query .= 'token = ?, ';
$query .= 'email = ?, ';
$query .= 'fullName = ?, ';
$query .= 'username = ?, ';
$query .= 'password = ?, ';
$query .= 'status = ?, ';
$query .= 'addressId = ?, ';
$query .= 'houseCode = ? ';


// demonstration of test query method which returns nothing but displays information.
$records = $thisDatabaseWriter->testSecurityQuery($query, 0);

// lets print out the data array so we can see what values would replace the ?
print '<p>Contents of the array<pre>';
print_r($data);
print '</pre></p>';

// again i commented this line out. $records will always be false because of that.
print '<h2>Insert method</h2>';
if ($thisDatabaseWriter->querySecurityOk($query, 0)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
//    $records = $thisDatabaseWriter->insert($query, $data); //Uncomment this to make insert
}

if ($records) {
    print '<p>Record Saved</p>';
} else {
    print '<p>Record NOT Saved</p>';
}






/**
 * ********************** JC INSERT BILL SQL ***********************
 */

// This example does not have a form so these two lines are just to put values
// in manually for this example.
$_POST['id'] = NULL;
$_POST['type'] = 'rent';
$_POST['dueDate'] = '20190805';
$_POST['addressId'] = 1;
$_POST['fileName'] = 'sampleFile.png';
$_POST['amount'] = 2000;




// create array to hold values for query
$data = array();

// retreive values from form and store in $data array
$id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
$data[] = $id;


$type = htmlentities($_POST['type'], ENT_QUOTES, 'UTF-8');
$data[] = $type;

$dueDate = htmlentities($_POST['dueDate'], ENT_QUOTES, 'UTF-8');
$data[] = $dueDate;


$addressId = htmlentities($_POST['addressId'], ENT_QUOTES, 'UTF-8');
$data[] = $addressId;

$fileName = htmlentities($_POST['fileName'], ENT_QUOTES, 'UTF-8');
$data[] = $fileName;

$amount = htmlentities($_POST['amount'], ENT_QUOTES, 'UTF-8');
$data[] = $amount;


$query = 'INSERT INTO bill SET ';
$query .= 'id = ?, ';
$query .= 'type = ?, ';
$query .= 'dueDate = ?, ';
$query .= 'addressId = ?, ';
$query .= 'fileName = ?, ';
$query .= 'amount = ? ';


// demonstration of test query method which returns nothing but displays information.
$records = $thisDatabaseWriter->testSecurityQuery($query, 0);

// lets print out the data array so we can see what values would replace the ?
print '<p>Contents of the array<pre>';
print_r($data);
print '</pre></p>';

// again i commented this line out. $records will always be false because of that.
print '<h2>Insert method</h2>';
if ($thisDatabaseWriter->querySecurityOk($query, 0)) {
    $query = $thisDatabaseReader->sanitizeQuery($query);
    $records = $thisDatabaseWriter->insert($query, $data); //Uncomment this to make insert
}

if ($records) {
    print '<p>Record Saved</p>';
} else {
    print '<p>Record NOT Saved</p>';
}



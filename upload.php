<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__ . '/templates/top.php');

$data = array();

$dir = "file/";
$path = $dir . basename($_FILES["file"]["name"]);
$uploadER = 0;
if (isset($_POST["btnSubmit"])) {
    if (empty($_POST["type"])) {
        $typeErr = "Bill type is required";
    }else {
        $type = test_input($_POST["type"]);
        $data[] = NULL; //DUMMY VALUE FOR ID
        $data[] = $type;
    }
    

    
    if (empty($_POST["dueDate"])) {
        $dueDateEr = "Due Date is required";
    }else {
        $dueDate = test_input($_POST["dueDate"]);
        $data[] = $dueDate; //TESTING
        $data[] = 1; //ADDRESS ID DUMMY VALUE
    }
    
    if (empty($_POST["txtAddInfo"])) { // *****  NOT IN DATABASE YET ******
        $additionalInfo = "";
    }else {
        $additionalInfo = test_input($_POST["txtAddInfo"]);
    }  
    
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
        echo "File has been uploaded";
        $fileName =  $_FILES['file']['name'];
        $data[] = $fileName;
    }else{
        echo "Error";
    }

    if (empty($_POST["amount"])) {
        $amountEr = "";
    }else {
        $amount = test_input($_POST["amount"]);
        $data[] = $amount;
    }

}           

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
}




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






echo "<h2>Your given values are as:</h2>";
echo $type;
echo "<br>";
         
echo $amount;
echo "<br>";
         
echo $dueDate;
echo "<br>";
         
echo $additionalInfo;
echo "<br>";
         
echo $_FILES['file']['name'];
echo "<br>";
echo $_FILES['file']['tmp_name'];
echo "<br>";
echo $_FILES['file']['size'];
echo "<br>";
echo $_FILES['file']['type'];
echo "<br>";
?>
<a href="file/<?php echo $_FILES['file']['name'] ?>" target="_blank">View File</a>
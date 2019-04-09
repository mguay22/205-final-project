<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dir = "file/";
$path = $dir . basename($_FILES["file"]["name"]);
$uploadER = 0;
if (isset($_POST["btnSubmit"])) {
    if (empty($_POST["radBill"])) {
        $billTypeErr = "Bill type is required";
    }else {
        $billType = test_input($_POST["radBill"]);
    }
    
    if (empty($_POST["txtAmount"])) {
        $amountEr = "";
    }else {
        $amount = test_input($_POST["txtAmount"]);
    }
    
    if (empty($_POST["txtDueDate"])) {
        $dueDateEr = "Due Date is required";
    }else {
        $dueDate = test_input($_POST["txtDueDate"]);
    }
    
    if (empty($_POST["txtAddInfo"])) {
        $additionalInfo = "";
    }else {
        $additionalInfo = test_input($_POST["txtAddInfo"]);
    }  
    
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
        echo "File has been uploaded";
    }else{
        echo "Error";
    }
}           

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
}

echo "<h2>Your given values are as:</h2>";
echo $billType;
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
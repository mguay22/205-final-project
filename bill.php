<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$billType = "";
$amount = "";
$dueDate = "";
$additionalInfo = "";
$fileInfo = "";
$billTypeEr = $amountEr = $dueDateEr =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
}           

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
}

?>
<article id ="main">
    <h2>Enter Bill</h2>
    <form id ="bill" action="" method="POST" enctype="multipart/form-data">
        <fieldset class = "radio">
            <legend>Bill Type</legend>
            <p>
                <label class ="radio-field">
                    <input type="radio"
                           name="radBill"
                           value="Rent"
                           tabindex="572">
                Rent</label>
                <label class ="radio-field">
                    <input type="radio"
                           name="radBill"
                           value="Energy"
                           tabindex="572">
                Energy</label>
                <label class ="radio-field">
                    <input type="radio"
                           name="radBill"
                           value="Water"
                           tabindex="572">
                Water</label>
                <label class ="radio-field">
                    <input type="radio"
                           name="radBill"
                           value="Internet"
                           tabindex="572">
                Internet</label>
                <label class ="radio-field">
                    <input type="radio"
                           name="radBill"
                           value="Other"
                           tabindex="572">
                Other</label>
            </p>
        </fieldset>
        <fieldset class ="text-area">
            <legend>Information</legend>
            <p>
                <label class="required text-field" for="txtAmount">Amount</label>
                <input id ="txtAmount"
                       maxlength ="45"
                       name="txtAmount"
                       placeholder="Enter amount"
                       tabindex="100"
                       type= "text"
                       value="<?php print $amount; ?>"
                       >
            </p>
            <p>
                <label class="required text-field" for="txtDueDate">Due Date</label>
                <input id="txtDueDate"
                       name="txtDueDate"
                       tabindex="100"
                       type="date"
                       value="<?php print $dueDate; ?>"
                       >
            </p>
            <p>
                <label class ="optional" for="txtAddInfo">Additional Info</label>
                <textarea id="txtAddInfo"
                          name="txtAddInfo"
                          tabindex="400"><?php print $additionalInfo; ?>
                </textarea>
            </p>
            <p>
                <label class ="optional">File</label>
                <input type="file" name="file" />
            </p>
        </fieldset>
        <fieldset class="buttons">
                <legend></legend>
                <input class="button" id="btnSubmit" name="btnSubmit" tabindex="400" type="submit" value="Add" >
        </fieldset>
    </form>
    
    <?php
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
         
      ?>

</article>

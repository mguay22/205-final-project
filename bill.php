<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('templates/top.php');
require_once('lib/config.php');

$type = "";
$amount = "";
$dueDate = "";
$additionalInfo = "";
$fileName= "";
$billTypeEr = $amountEr = $dueDateEr =  "";

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {*/


if (isset($_POST['btnSubmit'])) {
    if ($bill->addBill()) {
        $bill->redirect('upload.php');
    } else {
        var_dump($bill->errorMessage);
    }
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
                           name="type"
                           value="rent"
                           tabindex="572">
                Rent</label>
                <label class ="radio-field">
                    <input type="radio"
                           name="type"
                           value="gas"
                           tabindex="572">
                Gas</label>
                <label class ="radio-field">
                    <input type="radio"
                           name="type"
                           value="water"
                           tabindex="572">
                Water</label>
                <label class ="radio-field">
                    <input type="radio"
                           name="type"
                           value="wifi"
                           tabindex="572">
                Wifi</label>

                <label class ="radio-field">
                    <input type="radio"
                           name="type"
                           value="electric"
                           tabindex="572">
                    Electric</label>
                <label class ="radio-field">
                    <input type="radio"
                           name="type"
                           value="other"
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
                       name="amount"
                       placeholder="Enter amount"
                       tabindex="100"
                       type= "text"
                       value="<?php print $amount; ?>"
                       >
            </p>
            <p>
                <label class="required text-field" for="txtDueDate">Due Date</label>
                <input id="txtDueDate"
                       name="dueDate"
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

</article>

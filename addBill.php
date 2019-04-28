<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('templates/top.php');
require_once('templates/nav.php');
require_once('lib/config.php');

$type = "";
$amount = "";
$dueDate = "";
$additionalInfo = "";
$fileName= "";
$billTypeEr = $amountEr = $dueDateEr =  "";

$bill = new Bill($thisDatabaseReader, $thisDatabaseWriter);

$auth->validateUserStatusAddBill();
$userInfo = $_SESSION['userInfo'];

if (isset($_POST['btnSubmit'])) {
    if ($bill->addBill($userInfo, $auth)) {
        $bill->redirect('dashboard.php');
    } else {
        var_dump($bill->errorMessage);
    }
}

?>
<div class="main-panel">
    <article id ="main">
        <h3 style="margin-bottom: 30px;">Enter Bill</h3>
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
                    <input type="file" name="fileName" />
                </p>
            </fieldset>
            <fieldset class="buttons">
                    <legend></legend>
                    <input class="button" id="btnSubmit" name="btnSubmit" tabindex="400" type="submit" value="Add" >
            </fieldset>
        </form>
        <h2>Calculator</h2>
        <form id ="calculator">
            <fieldset class = "num">
                <p>
                    <label>Num 1</label>
                    <input type= "number" name ="num1" min = "0" value = "0" step = "0.01">
                </p>
                <fieldset class ="operator">
                <label class ="radio-field">
                    <input type="radio"
                            name="operator"
                            value="+"
                            tabindex="572">
                +</label>
                <label class ="radio-field">
                    <input type="radio"
                            name="operator"
                            value="-"
                            tabindex="572">
                -</label>
                <label class ="radio-field">
                    <input type="radio"
                            name="operator"
                            value="X"
                            tabindex="572">
                X</label>
                <label class ="radio-field">
                    <input type="radio"
                            name="operator"
                            value="÷"
                            tabindex="572">
                ÷</label>
            </fieldset>
                <p>
                    <label>Num 2</label>
                    <input type= "number" name ="num2" min = "0" value = "0" step = "0.01">
                </p>
            </fieldset>
            <fieldset class="buttons">
                    <legend></legend>
                    <input class="button" id="btnResult" name="btnResult" tabindex="400" type="submit" value="Equal" >
            </fieldset>
        </form>
        <?php
            $result = array();
            if(isset($_GET["btnResult"])){
                $num1 = $_GET["num1"];
                $num2 = $_GET["num2"];
                $operator = $_GET["operator"];
                echo $num1;
                echo " ";
                echo $operator;
                echo " ";
                echo $num2;
                echo "<br>";
                echo "<h3>Result</h3>";
                echo "<br>";
                //if($operator != "+" || $operator != "-" || $operator != "X" || $operator != "÷"){
                //   echo "choose an operator";
                //}
                if($operator == "+"){
                    echo $num1 + $num2;
                }
                if($operator == "-"){
                    echo $num1 - $num2;
                }
                if($operator == "X"){
                    echo $num1 * $num2;
                }
                if($operator == "÷"){
                    echo $num1 / $num2;
                }
            }
        ?>
    </article>
</div>

<?php
require_once('templates/footer.php');

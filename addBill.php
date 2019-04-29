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

$billError = false;

if (isset($_POST['btnSubmit'])) {
    if ($bill->addBill($userInfo, $auth)) {
        $bill->redirect('dashboard.php');
    } else {
        $billError = true;
    }
}

?>



    <article id ="addBill">
        <h2>Enter Bill</h2>
        <?php if ($billError) { ?>
            <div class="error-message"><h4><?php echo $bill->errorMessage; ?></h4></div>
        <?php } ?>
        <form id="bill" action="" method="POST" enctype="multipart/form-data">
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-sm-2 col-form-label">Bill Type</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="radio" name="type" id="rent" value="rent">
                                <label class="form-check-label" for="rent">RENT</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="type" id="gas" value="gas">
                                <label class="form-check-label" for="gas">GAS</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="type" id="water" value="water">
                                <label class="form-check-label" for="water">WATER</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="type" id="wifi" value="wifi">
                                <label class="form-check-label" for="wifi">WIFI</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="type" id="electric" value="electric">
                                <label class="form-check-label" for="electric">ELECTRIC</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="type" id="other" value="other">
                                <label class="form-check-label" for="other">OTHER</label>
                            </div>
                        </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="txtAmount">Amount</label>
                <div class="col-sm-10">
                    <input id ="txtAmount"
                           class="form-control"
                           name="amount"
                           placeholder="Enter amount"
                           type= "text"
                           value="<?php print $amount; ?>"
                           >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="txtDueDate">Due Date</label>
                <div class="col-sm-10">
                    <input id="txtDueDate"
                           class="form-control"
                           name="dueDate"
                           type="date"
                           value="<?php print $dueDate; ?>"
                           >
                </div>
            </div>
            <div>
                    <label class="col-sm-2 col-form-label">Bill Image</label>
                    <input type="file" name="fileName" />
            </div>
            <fieldset class="button">
                    <input class="btn btn-primary" id="btnSubmit" name="btnSubmit" type="submit" value="Add" >
            </fieldset>
        </form>
        <h2 class = "cal">Calculator</h2>
        <form>
            <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="num1">NUM 1</label>
                    <div class="col-sm-10">
                        <input id ="txtAmount"
                               class="form-control"
                               name="num1"
                               type= "number" min = "0" value = "0" step = "0.01"
                               >
                    </div>
            </div>
            <div id ="operator">
                <div class="form-check form-check-inline">
                    <input  type="radio" name="operator" id="plus" value="+" checked="">
                        <label class="form-check-label" for="plus">+</label>
                </div>
                <div class="form-check form-check-inline">
                        <input  type="radio" name="operator" id="minus" value="-">
                        <label class="form-check-label" for="minus">-</label>
                </div>
                <div class="form-check form-check-inline">
                        <input  type="radio" name="operator" id="mul" value="x">
                        <label class="form-check-label" for="mul">x</label>
                </div>
                <div class="form-check form-check-inline">
                        <input  type="radio" name="operator" id="div" value="/">
                        <label class="form-check-label" for="div">/</label>
                </div>
            </div>
            <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="num2">NUM 2</label>
                    <div class="col-sm-10">
                        <input id ="txtAmount"
                               class="form-control"
                               name="num2"
                               type= "number" min = "0" value = "0" step = "0.01"
                               >
                    </div>
            </div>
            <fieldset class="button">
                        <input class="btn btn-primary" id="btnResult" name="btnResult" type="submit" value="Equal" >
            </fieldset>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">RESULT</label>
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
                    echo " = ";
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
            </div>
        </form>
    </article>
</div>
<?php
require_once('templates/footer.php');

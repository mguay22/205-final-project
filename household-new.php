<?php
require_once(__DIR__ . '/templates/top.php');
require_once(__DIR__ . '/lib/config.php');

session_start();

$auth->validateUserStatusAddress();

$addressError = false;

if (isset($_POST['submitted'])) {
    if ($auth->registerNewHousehold()) {
        $_SESSION['userInfo'][0]['status'] = 'admin';
        $_SESSION['userInfo'][0]['addressId'] = $auth->getUserAddressId($_POST['address']);
        $auth->redirect('dashboard.php');
    } else {
        $addressError = true;
    }
}

?>

<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center" style="color: white;">New Address Registration</h4>
                <p class="text-center" style="color: white;">Register your household</p>
            </div>
                <?php if ($addressError) { ?>
                    <div class="error-message"><h4><?php echo $auth->errorMessage; ?></h4></div>
                <?php } ?>
            <article class="card-body">
                <form id="new-address" action="household-new.php" method="POST" accept-charset="UTF-8">
                    <fieldset>
                        <input type="hidden" name="submitted" id="submitted"value="1"/>
                        <div class="form-group">
                            <label for="address">Your Address*: </label>
                            <input type="text" class="form-control" name="address" id="address" maxlength="50" />
                        </div>
                        <div class="form-group">
                            <label for="unit-number">Unit Number:</label>
                            <input type="text" class="form-control" name="unit-number" id="unit-number" maxlength="50" />
                        </div>
                        <div class="form-group">
                            <label for="zip-code">ZIP Code*:</label>
                            <input type="text" class="form-control" name="zip-code" id="zip-code" maxlength="50" />
                        </div>
                        <div class="form-group">
                            <label for="city" >City*:</label>
                            <input type="text" class="form-control" name="city" id="city" maxlength="50" />
                        </div>
                        <div class="form-group">
                            <label for="state" >State*:</label>
                            <input type="text" class="form-control" name="state" id="state" maxlength="50" />
                        </div>
                        <input type="submit" style="padding-left: 30px !important;" name="Submit" class="btn btn-primary" value="Register" />
                    </fieldset>
                </form>
            </article>
        </div> <!-- card.// -->
    </div>
</div>
<!--container end.//-->


<?php
require_once('templates/footer.php');
?>
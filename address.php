<?php
require_once('templates/top.php');
require_once('lib/config.php');
?>

<?php
session_start();
$auth->validateUserStatusAddress();

$invalidAddressId = false;

if (isset($_POST['addressId'])) {
    $addressId = $_POST['addressId'];
    $registerUserSuccess = $auth->registerExistingHousehold($addressId, $_SESSION['userInfo']);
    if ($registerUserSuccess) {
        $_SESSION['userInfo'][0]['addressId'] = $addressId;
        $_SESSION['userInfo'][0]['status'] = 'standard';
        $auth->redirect('dashboard.php');
    } else {
        $invalidAddressId = true;
    }
}
?>

<div class="card">
    <article class="card-body" style="width: 800px; margin: 0 auto;">
        <div class="row text-center">
            <div class="col-md-12">
                <h3 style="margin-bottom: 30px;">Are you registering as a new user, or with an existing household?</h3>
            </div>
        </div>
        <?php if ($invalidAddressId) { ?>
            <div class="error-message" style="margin-bottom: 20px;"><h4>Invalid address ID. Please try again.</h4></div>
        <?php } ?>
        <div id="household-buttons" class="row text-center">
            <div class="col-md-6">
                <a href="household-new.php"><button class="btn btn-primary">New Household</a>
            </div>
            <div class="col-md-6">
                <button id="existing-household" class="btn btn-primary">Existing Household
            </div>
        </div>

        <form method="POST" name="household-code-form" action="address.php" id="household-code-form" style="display: none;">
            <div class="form-group">
                <label for="householdCodeInput">Household Code</label>
                <input style="padding-left: 0 !important;" type="text" class="form-control" id="householdCodeInput" name="addressId" placeholder="Enter Code">
                <small id="householdCodeHelp" class="form-text text-muted">Enter the Address ID for your address, provided by the house admin</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button class="btn btn-primary back-address">Back</button>
        </form>
    </article>
</div>


<?php
require_once('templates/footer.php');
?>

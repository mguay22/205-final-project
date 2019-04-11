<?php
require_once('templates/top.php');
require_once('lib/config.php');
?>

<?php
session_start();

if (!isset($_SESSION['userInfo']) || !isset($_SESSION['userInfo'][0]['id'])) {
    $auth->redirect('index.php');
}

$userId = $_SESSION['userInfo'][0]['id'];

if (isset($_POST['householdCode'])) {
    $registerUserSuccess = $auth->registerExistingHousehold($_POST['householdCode'], $userId);
    if ($registerUserSuccess) {
        $auth->redirect('dashboard.php');
    } else {
        var_dump('Invalid household code!');
    }
}
?>

<div class="row text-center">
    <div class="col-md-12">
        <h2>Are you registering as a new user, or with an existing household?</h1>
    </div>
</div>

<div id="household-buttons" class="row text-center">
    <div class="col-md-6">
        <a href="household-new"><button class="btn btn-primary">New Household</a>
    </div>
    <div class="col-md-6">
        <button id="existing-household" class="btn btn-primary">Existing Household
    </div>
</div>

<form method="POST" name="household-code-form" action="address.php" id="household-code-form" style="display: none;">
    <div class="form-group">
        <label for="householdCodeInput">Household Code</label>
        <input type="text" class="form-control" id="householdCodeInput" name="householdCode" placeholder="Enter Code">
        <small id="householdCodeHelp" class="form-text text-muted">Enter the household code for your address, provided by the house admin</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
require_once('templates/footer.php');
?>
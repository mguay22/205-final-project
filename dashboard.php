<?php
require_once(__DIR__ . '/classes/Auth.php');
session_start();

$auth = $_SESSION['auth'];
$userInfo = $auth->getUserInfo();
var_dump($userInfo);
var_dump($_GET['code']);
$auth->setAccessToken($_GET['code']);
//TODO: Put user info in Database in relation to primary key (ID), or Group Address.
require_once(__DIR__ . '/templates/top.php');

if (!in_array('householdCode', $userInfo)) {
    ?>
    <form method="POST">
        <p>Would you like to create a new household account, or associate your account with an existing household? (Household Code Required)</p>
        <select id="newHousehold">
            <option value="admin">Yes, I would like to create a new household account</option>
            <option value="notAdmin">No, I would like to associate my account with an existing household</option>
        </select>
        <input id="householdCode" style="display: none;" placeholder="Household Code" name="householdCode" type="text">
        <input type="submit" value="Submit">
    </form>
    <?php
}

if (isset($_POST['householdCode'])) {
    $auth->updateHouseholdCode($_POST['householdCode']);
}



?>
<?php
require_once(__DIR__ . '/templates/footer.php');

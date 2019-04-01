<?php
require_once(__DIR__ . '/classes/Auth.php');
session_start();

$auth = $_SESSION['auth'];
$userInfo = $auth->getUserInfo();
var_dump($userInfo);
//TODO: Put user info in Database in relation to primary key (ID), or Group Address.
require_once(__DIR__ . '/templates/top.php');
?>

<form>
    <p>Would you like to create a new household account, or associate your account with an existing household? (Household Code Required)</p>
    <select id="newHousehold">
        <option value="admin">Yes, I would like to create a new household account</option>
        <option value="notAdmin">No, I would like to associate my account with an existing household</option>
    </select>
</form>

<?php
require_once(__DIR__ . '/templates/footer.php');

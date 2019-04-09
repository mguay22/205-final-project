<?php
require_once('templates/top.php');
require_once('lib/config.php');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['existing-household'])) {
        var_dump('Existing household');
    } else {
        $auth->redirect('dashboard.php');
    }
}
?>

<div class="row text-center">
    <div class="col-md-12">
        <h2>Are you registering as a new user, or with an existing household?</h1>
    </div>
</div>
<form name="user-address" action="address.php" method="post">
    <div class="row text-center">
        <div class="col-md-6">
            <input class="btn btn-primary" name="new-user" type="submit" value="New User">
        </div>
        <div class="col-md-6">
        <input class="btn btn-primary" name="existing-household" type="submit" value="Existing Household">
        </div>
    </div>
</form>


<?php
require_once('templates/footer.php');
?>
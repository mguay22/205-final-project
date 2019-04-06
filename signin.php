<?php
require_once(__DIR__ . '/templates/top.php');
require_once('lib/config.php');

if (isset($_POST['submitted'])) {
    if ($auth->loginUser()) {
        $auth->redirect('dashboard.php');
    } else {
        var_dump($auth->errorMessage);
    }
}

?>
<form id="login" action="signin.php" method="POST" accept-charset="UTF-8">
    <fieldset>
        <legend>Login</legend>
        <input type="hidden" name="submitted" id="submitted"value="1"/>
        <div class="form-group">
            <label for="username">Username*:</label>
            <input type="text" class="form-control" name="username" id="username" maxlength="50" />
        </div>
        <div class="form-group">
            <label for="password" >Password*:</label>
            <input type="password" class="form-control" name="password" id="password" maxlength="50" />
        </div>
        <input type="submit" name="Submit" class="btn btn-primary" value="Submit" />
    </fieldset>
</form>

<?php
require_once(__DIR__ . '/templates/footer.php');
?>
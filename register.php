<?php
require_once('templates/top.php');
require_once('lib/config.php');

if (isset($_POST['submitted'])) {
    if ($auth->registerUser()) {
        $auth->redirect('dashboard.php');
    } else {
        var_dump($auth->errorMessage);
    }
}
?>

<form id="register" action="register.php" method="POST" accept-charset="UTF-8">
    <fieldset>
        <legend>Register</legend>
        <input type="hidden" name="submitted" id="submitted"value="1"/>
        <div class="form-group">
            <label for="name">Your Full Name*: </label>
            <input type="text" class="form-control" name="name" id="name" maxlength="50" />
        </div>
        <div class="form-group">
            <label for="email">Email Address*:</label>
            <input type="text" class="form-control" name="email" id="email" maxlength="50" />
        </div>
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
require_once('templates/footer.php');
?>
<?php
require_once('templates/top.php');
require_once('lib/config.php');

if (isset($_POST['submitted'])) {
    if ($auth->registerUser()) {
        session_start();
        $auth->redirect('address.php');
    } else {
        var_dump($auth->errorMessage);
    }
}
?>

<div class="card">
<article class="card-body" style="width: 800px; margin: 0 auto;">
	<h4 class="card-title mt-3 text-center" style="color: white;">Create Account</h4>
	<p class="text-center" style="color: white;">Get started with your free account</p>
	<form id="register" action="register.php" method="POST" accept-charset="UTF-8">
            <fieldset>
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
                <input type="submit" style="padding-left: 30px !important;" name="Submit" class="btn btn-primary" value="Register" />
            </fieldset>
        </form> 
    <p class="text-center">Have an account? <a href="index.php">Log In</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

<!-- <div class="row">
    <div class="col-md-12">
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
    </div>
</div> -->

<?php
require_once('templates/footer.php');
?>
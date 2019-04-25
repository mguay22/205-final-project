<?php
require_once('templates/top.php');
require_once('lib/config.php');

$registrationError = false;

if (isset($_POST['submitted'])) {
    if ($auth->registerUser()) {
        session_start();
        $auth->redirect('address.php');
    } else {
        $registrationError = true;
    }
}
?>

<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center" style="color: white;">Create Account</h4>
                <p class="text-center" style="color: white;">Get started with your free account</p>
            </div>
                <?php if ($registrationError) { ?>
                    <div class="error-message"><h4><?php echo $auth->errorMessage; ?></h4></div>
                <?php } ?>
            <article class="card-body">
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
            </article>
        </div> <!-- card.// -->
    </div>
</div>
<!--container end.//-->


<?php
require_once('templates/footer.php');
?>
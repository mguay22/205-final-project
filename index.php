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

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card sign-in-card">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body sign-in-card-body">
				<form id="login" action="index.php" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="submitted" id="submitted"value="1"/>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="username" class="form-control" placeholder="username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="password">
					</div>
					<!-- <div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div> -->
					<div class="form-group login-button">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="register.php">Sign Up</a>
				</div>
				<!-- <div class="d-flex justify-content-center">
					<a class="forgot" href="#">Forgot your password?</a>
				</div> -->
			</div>
		</div>
	</div>
</div>


<?php

require_once(__DIR__ . '/templates/footer.php');
?>
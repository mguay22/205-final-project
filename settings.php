<?php
require_once('templates/top.php');
require_once('templates/nav.php');
require_once('lib/config.php');

$auth->validateUserStatus();
$userAddressId = $_SESSION['userInfo'][0]['addressId'];
?>

<div class="main-panel">
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-12 text-center settings-text">
                <h1>Settings</h1>
                <h3>Address ID: <?php echo $userAddressId; ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 style="color: white;">Registered Users</h3>
                <table class="table table-dark" style="margin-top: 30px;">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once('templates/footer.php');

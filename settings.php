<?php
require_once('templates/top.php');
require_once('templates/nav.php');
require_once('lib/config.php');

$auth->validateUserStatus();
$userAddressId = $_SESSION['userInfo'][0]['addressId'];

$users = $auth->getUsersByAddressId();
?>

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
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        for ($i = 0; $i < sizeof($users); $i++) {
                            echo '<tr>';
                            echo '<th scope="row">' . $i .'</th>';
                            echo '<td>' . $users[$i]["fullName"] . '</td>';
                            echo '<td>' . $users[$i]["email"] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once('templates/footer.php');

<?php 
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
        <div class="logo">
            <img src="assets/img/logo.png" alt="Bill Buddy Logo">
            <a href="dashboard.php" class="simple-text logo-normal">
                <?php print  $_SESSION['userInfo'][0]['fullName'] . ' | ' . $_SESSION['userInfo'][0]['status'] ?>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item active dashboard">
                    <a class="nav-link" href="dashboard.php">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php

                $currentStatus = $_SESSION['userInfo'][0]['status'];

                /**
                 * If User is Admin, show addBill.php nav item
                 */
                if ($currentStatus == 'admin') {

                    print '    
                        <li class="nav-item add-bill">
                             <a class="nav-link" href="addBill.php">
                                <i class="material-icons">money</i>
                                <p>Add Bill</p>
                             </a>
                         </li>
                         ';
                }

                ?>
                <li class="nav-item settings">
                    <a class="nav-link" href="settings.php">
                        <i class="material-icons">settings</i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

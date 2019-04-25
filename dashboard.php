<?php
/**
 * dashboard.php retrieves user info from current PHP Session
 * and uses this info to display bills associated with a user's
 * address. User's also have access to different functionality
 * based on their status (admin || standard)
 */
require_once(__DIR__ . '/templates/top.php');
require_once(__DIR__ . '/lib/config.php');

$currentToken = 'sampletoken1'; //JUST FOR TESTING
session_start(); 

if (!isset($_SESSION['userInfo'])) {
    $auth->redirect('index.php');
}

if (!isset($_SESSION['userInfo'][0]['addressId'])
|| !isset($_SESSION['userInfo'][0]['status'])) {
    // User still needs to associate an address
    $auth->redirect('address.php');
}

function getAddressID($thisDatabaseReader, $currentToken)
{

    $data = array($currentToken); //This is where we need to retrieve user token from current session!!

    $query = 'SELECT addressId ';
    $query .= 'FROM user ';
    $query .= 'WHERE token = ? ';
    //$records = $thisDatabaseReader->testSecurityQuery($query, 1, 0);


    if ($thisDatabaseReader->querySecurityOk($query, 1, 0)) {
        $query = $thisDatabaseReader->sanitizeQuery($query);
        $records = $thisDatabaseReader->select($query, $data);
    }

    if (DEBUG) {
        print '<p>Contents of the array<pre>';
        print_r($records);
        print '</pre></p>';
    }

    return $records;
}

function getBills($thisDatabaseReader, $currentAddressId)
{
    $data = array($currentAddressId);

    $query = 'SELECT * ';
    $query .= 'FROM bill ';
    $query .= 'INNER JOIN address ';
    $query .= 'WHERE bill.addressId = address.id ';
    $query .= 'AND bill.addressId = ? ';

//    $records = $thisDatabaseReader->testSecurityQuery($query, 1, 1);


    if ($thisDatabaseReader->querySecurityOk($query, 1, 1)) {
        $query = $thisDatabaseReader->sanitizeQuery($query);
        $records = $thisDatabaseReader->select($query, $data);

    }

    if (DEBUG) {
        print '<p>Contents of the array<pre>';
        print_r($records);
        print '</pre></p>';
    }

    return $records;
}

$currentToken = 'sampletoken1'; //JUST FOR TESTING

//session_start();



function getExpiredStatus($record){


    $expiredStatus = "";

    $currentDate = date("Y-m-d");

    if ($record['dueDate'] < $currentDate ){

        $expiredStatus = "LATE";

    }

    elseif ($record['dueDate'] == $currentDate){
        $expiredStatus = "DUE";
    }

    return $expiredStatus;

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
                <li class="nav-item active  ">
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
                        <li class="nav-item">
                             <a class="nav-link" href="addBill.php">
                                <i class="material-icons">money</i>
                                <p>Add Bill</p>
                             </a>
                         </li>
                         ';
                }

                ?>

            </ul>
        </div>
    </div>

    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:void(0)">Current Bills</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">
                                <i class="material-icons">notifications</i>
                                <p class="d-lg-none d-md-block">
                                    Notifications
                                </p>
                            </a>
                        </li>

                        <!-- your navbar here -->

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">

                <!--    BILL DISPLAY ROW    -->
                <div class="row">

                    <?php
                    /**
                     * Display bills based on different types
                     */

                    $currentAddressId = $_SESSION['userInfo'][0]['addressId'];

                    $records = getBills($thisDatabaseReader, $currentAddressId);

                    if (is_array($records)) {
                        foreach ($records as $record) {
                            $type = $record['type'];
                            $amount = $record['amount'];
                            $dueDate = $record['dueDate'];
                            $typeColor = 'success';
                            $typeIcon = 'house';

                            if($type == 'rent'){
                                $typeColor = 'success';
                                $typeIcon = 'house';
                            }

                            elseif ($type == 'water'){
                                $typeColor = 'info';
                                $typeIcon = 'pool';
                            }

                            elseif ($type == 'gas'){
                                $typeColor = 'warning';
                                $typeIcon = 'local_gas_station';
                            }

                            elseif ($type == 'electric'){
                                $type = 'elec.';
                                $typeColor = 'basic';
                                $typeIcon = 'wb_incandescent';
                            }

                            elseif ($type == 'wifi'){
                                $typeColor = 'default';
                                $typeIcon = 'wifi';
                            }

                            elseif ($type == 'other'){
                                $typeColor = 'default';
                                $typeIcon = 'web_asset';
                            }
                            print '
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-'. $typeColor .' card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">'. $typeIcon .'</i>
                                </div>
                                <p class="card-category">'. $type .'</p>
                                <h3 class="card-title">'. '$' . number_format($amount, 2)   .'</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">date_range</i> Due:
                                    '. $dueDate .' 
                                </div>
                                
                                <div class="expiredStatus">
                                    
                                    '. getExpiredStatus($record) .'
                                
                                </div>
                                
                                
                            </div>
                           
                            <div class="card-footer">
                            
                     
                                
                                <div class="file"> 
                                <a href="file/' .$record['fileName'].'       ">View Bill</a>                      
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>';
                        }
                    }


                    ?>


                </div>

            </div>
        </div>
        <section class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="#">
                                LINK
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                LINK
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                LINK
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                LINK
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright float-right" id="date">

                    Bill Buddy Inc.
                </div>
            </div>
        </section>
        <script>
            const x = new Date().getFullYear();
            let date = document.getElementById('date');
            date.innerHTML = '&copy; ' + x + date.innerHTML;
        </script>
    </div>
</div>


<?php
require_once(__DIR__ . '/templates/footer.php');
require_once(__DIR__ . '/lib/config.php');
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

$auth->validateUserStatus();


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

    <?php require_once('templates/nav.php'); ?>

    <div class="main-panel">
        <h3 style="color: #a9afbbd1; padding-left: 27px;">Current Bills</h3>       
        <div class="content">
            <div class="container-fluid">

                <!--    BILL DISPLAY ROW    -->
                <div class="row" id="bills">

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
                            $billId = $record[0];
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
                                </div>';
                                
                            if ($currentStatus == 'admin') {
                                print   '
                                <div class ="delete">
                                    <form class="deleteForm" method="post">
                                        <input type="hidden" class="billsInput" id="billID" name="billID" value="' . $billId . '">
                                        <input class="btn btn-danger" type="submit" id="btnDel" name="btnDel" value="Delete">
                                    </form>
                                </div>';
                            };
                            
                          print '

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
                <div class="copyright float-left" style="padding-left: 15px;" id="date">

                    Bill Buddy Inc.
                </div>
            </div>
        </section>
        <script type="text/javascript" language="javascript">
            const x = new Date().getFullYear();
            let date = document.getElementById('date');
            date.innerHTML = '&copy; ' + x + date.innerHTML;



        </script>
    </div>
</div>


<?php
require_once(__DIR__ . '/templates/footer.php');
require_once(__DIR__ . '/lib/config.php');

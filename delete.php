

<?php

include 'lib/constants.php';
include LIB_PATH . '/Connect-With-Database.php'; //MUST REMOVE ECHO FROM CONNECT-WITH-DATABASE
require_once(__DIR__ . '/lib/config.php');


    $id = $_POST['billID'];

//    $id = 46; //Update to get the ID from the actual

    $data = array();
    $data[] = $id;
    $query = "DELETE FROM bill ";
    $query .= "WHERE ";
    $query .= "id = ?";


    if ($thisDatabaseWriter->querySecurityOk($query, 1, 0)) {
        $query = $thisDatabaseWriter->sanitizeQuery($query);
        $records = $thisDatabaseWriter->delete($query, $data);


        if($records){
            echo json_encode(array('success' => 1));
        }

        else{
            echo json_encode(array('success' => 0));
        }

    }






?>
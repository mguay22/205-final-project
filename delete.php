

<?php


//if(isset($_GET["btnDel"])){


    $id = $_GET["billID"]; //Update to get the ID from the actua;

    $data = array();
    $data[] = $id;
    $query = "DELETE FROM bill ";
    $query .= "WHERE ";
    $query .= "id = ?";


    if ($thisDatabaseWriter->querySecurityOk($query, 1, 0)) {
        $query = $thisDatabaseWriter->sanitizeQuery($query);
        $records = $thisDatabaseWriter->delete($query, $data);


        if($records){
            echo 'deleted';
        }

        else{
            echo'not deleted';
        }

    }



    echo '<meta http-equiv="refresh"/>';
//}


?>
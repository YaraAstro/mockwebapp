<?php

// establish connection
include '../createConn.php';

// create userId
function createUserID ($con, $type) {
    if ($type == "staff" ) {
        $fetchID = "SELECT staff_id FROM staff_member ORDER BY staff_id DESC LIMIT 1";
        $result = $con -> query($fetchID);

        if ($result -> num_rows > 0) {}
    } 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get the registration type
    $reg_type = $_POST[''];

}

?>
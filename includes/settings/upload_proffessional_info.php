<?php

include '../createConn.php';

session_start();

$type = $_SESSION['user_type'] ;
$user_id = $_SESSION['user_id'] ;
$id_col = $_SESSION['id_column'] ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $position = $_POST['userPost'];
    $branch = $_POST['userBranch']; 

    $sql = "UPDATE $type SET position = ?, branch = ? WHERE $id_col = ?";

    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param( "sss", $position, $branch, $user_id );

    if ($stmt -> execute()) {
        header("Location: ../../pages/dashboard.php");
        exit();
    } else {
        header("Location: ../../pages/error.html");
        exit();
    }

} else {
    header("Location: ../../pages/error.html");
    exit();
}

include '../closeConn.php';

?>
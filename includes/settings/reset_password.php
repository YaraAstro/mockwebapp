<?php

include '../createConn.php';

session_start();

$type = $_SESSION['user_type'] ;
$user_id = $_SESSION['user_id'] ;
$id_col = $_SESSION['id_column'] ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['createPwd']) && !empty($_POST['createPwd'])) {
        
        $new_password = $_POST['createPwd'];
    
        $sql = "UPDATE $type SET password = ? WHERE $id_col = ?";
        
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param('ss', $new_password, $user_id);
    
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

} else {
    header("Location: ../../pages/error.html");
    exit();
}

include '../closeConn.php';

?>
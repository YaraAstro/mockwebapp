<?php

include '../createConn.php';

session_start();

$type = $_SESSION['user_type'] ;
$user_id = $_SESSION['user_id'] ;
$id_col = $_SESSION['id_column'] ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $adrress = $_POST['userAddress'];
    $district = $_POST['userDistrict'];
    $postal_code = $_POST['userPostCode'];
    $mail = $_POST['userMail'];
    $mobile = $_POST['userMobile'];

    $sql = "UPDATE $type SET address = ?, district = ?, postal_code = ?, email = ?, contact_number = ? WHERE $id_col = ? ";
    
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("ssssss", $adrress, $district, $postal_code, $mail, $mobile, $user_id);

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
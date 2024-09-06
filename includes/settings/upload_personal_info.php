<?php

include "../createConn.php";

session_start();

$type = $_SESSION['user_type'] ;
$user_id = $_SESSION['user_id'] ;
$id_col = $_SESSION['id_column'] ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get the details
    $first_name = $_POST['firstName'] ;
    $last_name = $_POST['lastName'] ;
    $date_of_birth = $_POST['bDay'] ;
    $gender = $_POST['userGender'] ;
    $nic = $_POST['userNiC'] ;

    $profile_picture = $user_id.'_profile_picture.'. pathinfo($_FILES['userImg']['name'], PATHINFO_EXTENSION) ;

    $type != 'customer' ? 
        $profile_picture_path = '../../documents/staff/profile_picture/'. $profile_picture : 
        $profile_picture_path = '../../documents/customer/profile_picture/'. $profile_picture ;

    move_uploaded_file( $_FILES['userImg']['tmp_name'], $profile_picture_path );

    $profile_picture_path = str_replace('../../', '../', $profile_picture_path);

    $sql = "UPDATE $type SET first_name = ?, last_name = ?, date_of_birth = ?, gender = ?, nic_number = ?, profile_picture_path = ? WHERE $id_col = ? "  ;

    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("sssssss", $first_name, $last_name, $date_of_birth, $gender, $nic, $profile_picture_path, $user_id );

    if ( $stmt -> execute() ) {
        header("Location: ../../pages/dashboard.php");
        exit();
    } else {
        header("Location: ../../pages/error.html");
        exit();
    }

}

include "../closeConn.php";

?>
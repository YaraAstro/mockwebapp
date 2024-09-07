<?php

include "../createConn.php";

session_start();

$type = $_SESSION['user_type'] ;
$user_id = $_SESSION['user_id'] ;
$id_col = $_SESSION['id_column'] ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($type === 'staff_member') {

        $nic = $user_id.'_nic_scan'.pathinfo($_POST['nicScan']['name'], PATHINFO_EXTENSION);
        $resume = $user_id.'_resume'.pathinfo($_POST['cvScan']['name'], PATHINFO_EXTENSION);

        $nic_path = '../../documents/staff/nic_scan/'.$nic ;
        $resume_path = '../../documents/staff/resume/'.$resume ;

        move_uploaded_file($_FILES['nicScan']['tmp_name'], $nic_path);
        move_uploaded_file($_FILES['cvScan']['tmp_name'], $resume_path);

        $nic_path = str_replace('../../', '../', $nic_path);
        $resume_path = str_replace('../../', '../', $resume_path);

        $sql = "UPDATE $type SET nic_scan_path = ?, resume_path = ? WHERE $id_col = ? ";

        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("sss", $nic_path, $resume_path, $user_id );

        if ($stmt -> execute()) {
            header("Location: ../../pages/dashboard.php");
            exit();
        } else {
            header("Location: ../../pages/error.html");
            exit();
        }

    } else {

        $nic = $user_id.'_nic_scan'.pathinfo($_POST['nicScan']['name'], PATHINFO_EXTENSION);

        $nic_path = '../../documents/staff/nic_scan/'.$nic ;

        move_uploaded_file($_FILES['nicScan']['tmp_name'], $nic_path);

        $nic_path = str_replace('../../', '../', $nic_path);

        $sql = "UPDATE $type SET nic_scan_path = ? WHERE $id_col = ? ";

        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("ss", $nic_path, $user_id );

        if ($stmt -> execute()) {
            header("Location: ../../pages/dashboard.php");
            exit();
        } else {
            header("Location: ../../pages/error.html");
            exit();
        }

    }

} else {
    header("Location: ../../pages/error.html");
    exit();
}

include "../closeConn.php";

?>
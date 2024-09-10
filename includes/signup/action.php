<?php

// establish connection
include '../createConn.php';

// create userId
function createUserID ($con, $type) {

    if ($type == "staff" ) {
        $table_name = 'staff_member';
        $id_column = 'staff_id';
        $id_text = 'ST'; // staff
    } else {
        $table_name = 'customer';
        $id_column = 'customer_id';
        $id_text = 'CL'; // cleint
    }

    $fetchID = "SELECT ". $id_column ." FROM ".$table_name." ORDER BY ". $id_column ." DESC LIMIT 1";
    $result = $con -> query($fetchID);

    if ($result -> num_rows > 0) {

        $row = $result -> fetch_assoc();
        $last_id = $row[$id_column];
        $new_number = intval(substr($last_id, 2)) + 1;
        $new_id = $id_text . sprintf("%04d", $new_number);

    } else {
        $new_id = $id_text . "0001";
    }

    return $new_id;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get the registration type
    $reg_type = $_POST['regType'];

    //common details
    $first_name = $_POST['userFirstName'];
    $last_name  = $_POST['userLastName'];
    $date_of_birth = $_POST['userDoB'];
    $gender = $_POST['gender'];
    $address  = $_POST['userAddress'];
    $district = $_POST['userDistrict'];
    $postal_code = $_POST['userPostalCode'];
    $nic = $_POST['userNIC'];
    $email = $_POST['userEmail'];
    $mobile = $_POST['userMobile'];
    $password = $_POST['userPwd'];
    
    // get the id
    $user_id = createUserID($conn, $reg_type);

    if ( $reg_type == 'staff' ) {

        // staff details
        $position = $_POST['staffPost'];
        $branch = $_POST['staffBranch'];
        
        // hendle rename & file uploading
        $profile_picture = $user_id.'_profile_picture.'. pathinfo($_FILES['userImg']['name'], PATHINFO_EXTENSION) ;
        $scan_of_nic = $user_id.'_nic_scan.'. pathinfo($_FILES['userNICScan']['name'], PATHINFO_EXTENSION);
        $resume = $user_id.'_resume.'. pathinfo($_FILES['staffCV']['name'], PATHINFO_EXTENSION);

        // set paths
        $profile_picture_path = '../../documents/staff/profile_picture/'. $profile_picture;
        $scan_of_nic_path = '../../documents/staff/nic_scan/'. $scan_of_nic ;
        $resume_path = '../../documents/staff/resume/'. $resume ;

        // move uploaded files
        move_uploaded_file( $_FILES['userImg']['tmp_name'], $profile_picture_path);
        move_uploaded_file( $_FILES['userNICScan']['tmp_name'], $scan_of_nic_path);
        move_uploaded_file( $_FILES['staffCV']['tmp_name'], $resume_path);

        $profile_picture_path = str_replace('../../', '../', $profile_picture_path);
        $scan_of_nic_path = str_replace('../../', '../', $scan_of_nic_path);
        $resume_path = str_replace('../../', '../', $resume_path);

        // set SQL query for insert staff members
        $sql = "INSERT INTO staff_member (staff_id, first_name, last_name, date_of_birth, gender, address, district, postal_code, nic_number, email, contact_number, password, position, branch, profile_picture_path, nic_scan_path, resume_path, created_at)
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("sssssssssssssssss", $user_id, $first_name, $last_name, $date_of_birth, $gender, $address, $district, $postal_code, $nic, $email, $mobile, $password, $position, $branch, $profile_picture_path, $scan_of_nic_path, $resume_path);

    } else {

        // set SQL query for insert customers
        $sql = "INSERT INTO customer (customer_id, first_name, last_name, date_of_birth, gender, address, district, postal_code, nic_number, email, contact_number, password, created_at)
        VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssss", $user_id, $first_name, $last_name, $date_of_birth, $gender, $address, $district, $postal_code, $nic, $email, $mobile, $password);

    }

    if ( $stmt -> execute() ) {

        // start the session
        session_start();

        $_SESSION['user_id'] = $user_id ;
        $_SESSION['user_name'] = $first_name." ".$last_name ;

        if ( $reg_type == 'staff' ) {
            $_SESSION['user_type'] = 'staff_member';
            $_SESSION['id_column'] = 'staff_id';
        } else {
            $_SESSION['user_type'] = 'customer';
            $_SESSION['id_column'] = 'customer_id';
        }

        header("Location: ../../pages/dashboard.php");
        exit();
    } else {
        echo "Error : " . $stmt -> error;
    }

    $stmt -> close();

}

// close connection
include '../closeConn.php';

?>
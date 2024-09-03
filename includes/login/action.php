<?php

// establish connection
include '../createConn.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    // fetch the data from login form
    $user_email = $_POST['userEmail'];
    $user_password = $_POST['userPassword'];

    // first check whether user is a customer or not
    $find_from_customers = "SELECT * FROM customer WHERE email = '$user_email' AND password = '$user_password' " ;
    $fetch_customer = $conn -> query($find_from_customers);

    if ( $fetch_customer -> num_rows > 0 ) {

        // start the session
        session_start();

        $customer_data = $fetch_customer -> fetch_assoc();

        $_SESSION['user_id'] = $customer_data['customer_id'];
        $_SESSION['user_name'] = $customer_data['first_name'].' '.$customer_data['last_name'];
        $_SESSION['user_type'] = 'customer';

        echo "Login Successfull \n" . $_SESSION['user_name'];
    
    } else {
       
        $find_from_staff = "SELECT * FROM staff_member WHERE email = '$user_email' AND password = '$user_password' " ;
        $fetch_staff_member = $conn -> query($find_from_staff);

        if ( $fetch_staff_member -> num_rows > 0 ) {

            // start the session
            session_start();

            $staff_member_data = $fetch_staff_member -> fetch_assoc();

            $_SESSION['user_id'] = $staff_member_data['staff_id'];
            $_SESSION['user_name'] = $staff_member_data['first_name'].' '.$staff_member_data['last_name'];
            $_SESSION['user_type'] = 'staff_member';

            echo "Login Successfull \n" . $_SESSION['user_name'];

        } else {

            echo "Something went wrong !";
        }
    }

} else {
    echo "Files are missing !";
}

// close connection
include '../closeConn.php';

?>
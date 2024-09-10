<?php 

include '../includes/createConn.php';

session_start();

if ( isset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_type'], $_SESSION['id_column']) ) {

    $sql = "SELECT * FROM " . $_SESSION['user_type'] . " WHERE " . $_SESSION['id_column'] . " = '" . $_SESSION['user_id'] . "'";
    // echo $sql; 
    $details = $conn -> query($sql);

    if ( ! ($details -> num_rows > 0) ) {
        echo "Internal Error !!";
    } else {
        $data = $details -> fetch_assoc();
    }
    
    // echo $sql;

} else {
    header("Location: ../pages/login.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['user_name'] ?> | Profile Dashboard | Mock App</title>

    <link rel="icon" href="../assets/images/poo_solid.ico" type="image/x-icon">

    <link rel="stylesheet" href="../assets/styles/dashboard/styles.css">
    <link rel="stylesheet" href="../assets/styles/scrollbarStyles.css">
</head>
<body>
    <div class="mainFrame">

        <!-- dashboard details -->
        <div class="innerFrame">

            <div class="dashFrame">

                <div class="initDetails">
                    <?php
                        !empty($data['profile_picture_path']) ? $img_path = $data['profile_picture_path'] : $img_path = '../assets/images/dashboard/5481365_2813838.jpg'; 
                     ?>
                    <div style="background-image: url(<?php echo $img_path ?>);" class="dashBlock">
                    </div>
                    <div class="dashBlock">
                        <h3><?php echo $_SESSION['user_name'] ?></h3>
                    </div>
                </div>
                
            </div>

            <div class="dashFrame">

                <div class="displayData">

                    <div class="dataBlock">
                        <h4>Personal Information</h4>
                        <div class="block">
                            <div class="row">
                                <div id="firstName" class="box">
                                    <p><?php echo $data['first_name'] ?></p>
                                </div>
                                <div id="lastName" class="box">
                                    <p><?php echo $data['last_name'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div id="doBirth" class="box">
                                    <p><?php echo $data['date_of_birth'] ?></p>
                                </div>
                                <div id="gender" class="box">
                                    <p><?php echo $data['gender'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div id="nic" class="box">
                                    <p><?php echo $data['nic_number'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dataBlock">
                        <h4>Contact Information</h4>
                        <div class="block">
                            <div class="row">
                                <div id="addresss" class="box">
                                    <p><?php echo $data['address'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div id="district" class="box">
                                    <p><?php echo $data['district'] ?></p>
                                </div>
                                <div id="postalCode" class="box">
                                    <p><?php echo $data['postal_code'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div id="email" class="box">
                                    <p><?php echo $data['email'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div id="mobile" class="box">
                                    <p><?php echo $data['contact_number'] ?></p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- dashboard buttons -->
        <div class="innerFrame">

            <div class="buttonsBlock">

                <a href="">
                    <div class="profileButtons">
                        <div class="svgXML">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        </div>
                        <p>Info</p>
                    </div>
                </a>
                
                <a href="">
                    <div class="profileButtons">
                        <div class="svgXML">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        </div>
                        <p>Guidance</p>
                    </div>
                </a>
                
                <a href="">
                    <div class="profileButtons">
                        <div class="svgXML">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                        </div>
                        <p>Get Code</p>
                    </div>
                </a>
                
                <a href="./settings.php">
                    <div class="profileButtons">
                        <div class="svgXML">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        </div>
                        <p>Settings</p>
                    </div>
                </a>
                
                <a href="../includes/logout.php">
                    <div class="profileButtons">
                        <div class="svgXML">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        </div>
                        <p>Log Out</p>
                    </div>
                </a>

            </div>

        </div>

    </div>
</body>
</html>

<?php 
 include '../includes/closeConn.php';
?>
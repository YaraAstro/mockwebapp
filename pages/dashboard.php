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


    !empty($data['profile_picture_path']) ? $img_path = $data['profile_picture_path'] : $img_path = '../assets/images/dashboard/5481365_2813838.jpg'; 
                    

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
    <link rel="stylesheet" href="../assets/styles/mainLayout.css">
    <link rel="stylesheet" href="../assets/styles/mainSideBar.css">

    <style>
        .innerFrame:nth-child(2)::after {
            content: '';
            position: fixed;
            z-index: -5;
            width: 35%;
            height: 100%;
            background: url('<?php echo $img_path ?>');
            background-size: cover;
            background-position: center;
            right: 0;
            top: 0;
            transform: rotateY(180deg);
            filter: opacity(.75) sepia(.75) brightness(.75);
        }

        .staff {
            text-transform: capitalize;
        }

    </style>

</head>
<body>

    <div class="mainFrame">
        
        <!-- button field -->
        <div class="innerFrame">
            <div id="sidebar" class="button_field"></div>
        </div>

        <!-- content -->
        <div class="innerFrame">

            <div class="profile">
                
                <div class="profile_frame">
                    <div class="data_box">
                        <h1><?php echo $_SESSION['user_name'] ?></h1>
                        <?php
                        
                        if ($_SESSION['user_type'] === 'staff_member') {

                            echo '
                                <p class="staff">'.$data['position'].'</p>
                                <p class="staff">'.$data['branch'].'</p>
                            ';
                        } else {

                            echo '
                                <p>'.$data['email'].'</p>
                                <p>'.$data['contact_number'].'</p>
                            ';
                        }
                        
                        ?>
                    </div>
                    <div class="img_frame">
                        <img src="<?php echo $img_path ?>" alt="profile_picture">
                    </div>
                </div>

                <div class="profile_frame">

                <?php 

                    if ($_SESSION['user_type'] == 'staff_member') {

                        echo '
                            <div class="box">
                                <div class="label">Email</div>
                                <div class="data">'.$data['email'].'</div>
                            </div>

                            <div class="box">
                                <div class="label">Contact No.</div>
                                <div class="data">'.$data['contact_number'].'</div>
                            </div>
                        ';
                        
                    }
                ?>
                    
                    <div class="box">
                        <div class="label">Date of Birth</div>
                        <div class="data"><?php echo $data['date_of_birth'] ?></div>
                    </div>
                    
                    <div class="box">
                        <div class="label">NIC No.</div>
                        <div class="data"><?php echo $data['nic_number'] ?></div>
                    </div>

                    <div class="box">
                        <div class="label">Address</div>
                        <div class="data"> <?php echo $data['address'] ?> <br> <?php echo $data['district'] ?> <br> <?php echo $data['postal_code'] ?> </div>
                    </div>

                </div>

                <div class="profile_frame">
                    <?php

                    if ($_SESSION['user_type'] == 'staff_member') {
                        // Staff intro
                        echo '<h4>Presenting ' . $_SESSION['user_name'] . ': A Promising New Member of Our Team</h4>
                            <p class="intro">It is with great pleasure that we introduce Mr. ' . $_SESSION['user_name'] . ', a prospective staff member whose application has captured our attention with its remarkable professionalism and enthusiasm. ' . $data['first_name'] . ', born on ' . $data['date_of_birth'] . ' and identifying as ' . $data['gender'] . ', has expressed a keen interest in contributing to our team as a ' . $data['position'] . '. Their choice of the ' . $data['branch'] . ' branch for their role demonstrates their commitment to engaging actively with our organization’s vibrant environment. ' . $data['first_name'] . "'s application is complemented by a series of meticulously prepared documents, including a profile picture, NIC scan, and a resume that highlight their extensive expertise and experience. These credentials reflect " . $data['first_name'] . "'s readiness to embrace the responsibilities of their role with distinction and competence. We are excited to explore the potential contributions " . $data['first_name'] . ' will bring to our team and are dedicated to supporting their integration into our esteemed organization.</p>';
                    } else {
                        // Customer info
                        echo '<h4>Introducing ' . $_SESSION['user_name'] . ': A Valued Addition to Our Customer Community</h4>
                            <p class="intro">We are honored to present Ms. ' . $_SESSION['user_name'] . ', a distinguished individual who has recently joined our customer community. ' . $data['first_name'] . ', whose first and last names speak to their poised and professional demeanor, was born on ' . $data['date_of_birth'] . ' and identifies with grace and clarity as ' . $data['gender'] . '. Their comprehensive registration includes a well-detailed address at ' . $data['address'] . ', ' . $data['district'] . ', with the postal code ' . $data['postal_code'] . ', ensuring that our services are precisely aligned with their needs and locality. ' . $data['first_name'] . "'s engagement with us is further exemplified through their provided email, " . $data['email'] . ', and their contact number, ' . $data['contact_number'] . ', which will enable us to offer them a seamless and personalized experience. We eagerly anticipate the opportunity to serve ' . $data['first_name'] . ' and are committed to delivering an exceptional and tailored experience that befits their distinguished profile.</p>';
                    }
                    ?>
                </div>

            </div>
            

        </div>

    </div>

    <script src="../assets/scripts/mainSideBar.js"></script>
    
</body>
</html>

<?php 
 include '../includes/closeConn.php';
?>
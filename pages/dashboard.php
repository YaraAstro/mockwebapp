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
                        <h1><?php echo $data['first_name'].' '.$data['last_name'] ?></h1>
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
    <script>
         // sidebar content
        let sidebarTopics = [
            {name: 'Browse', link: '../pages/browsePeople.php', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slack"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"></path><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"></path><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"></path><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"></path><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path></svg>'},
            {name: 'alerts', link: '', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>'},
            {name: 'messages', link: '', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitch"><path d="M21 2H3v16h5v4l4-4h5l4-4V2zm-10 9V7m5 4V7"></path></svg>'},
            {name: 'settings', link: '../pages/settings.php', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>'},
            {name: 'info', link: '', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>'},
            {name: 'log out', link: '../includes/logout.php', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>'},
        ];

        MakeSideBar(sidebarTopics);
    </script>
    
</body>
</html>

<?php 
 include '../includes/closeConn.php';
?>
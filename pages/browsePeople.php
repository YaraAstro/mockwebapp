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
    <title><?php echo $_SESSION['user_type'] == 'staff_member' ? 'Browse Customers' : 'Browse Staff' ?> | Mock App</title>

    <link rel="icon" href="../assets/images/poo_solid.ico" type="image/x-icon">

    <link rel="stylesheet" href="../assets/styles/interactions/browsePeople.css">
    <link rel="stylesheet" href="../assets/styles/scrollbarStyles.css">
    <link rel="stylesheet" href="../assets/styles/mainLayout.css">
    <link rel="stylesheet" href="../assets/styles/mainSideBar.css">
</head>
<body>

    <div class="mainFrame">
        <!-- button field -->
        <div class="innerFrame">
            <div id="sidebar" class="button_field"></div>
        </div>

        <div class="innerFrame">

            <div class="viewData">
                
                <div class="searchBox">
                    <input type="text" name="searchInput" id="searchInput" placeholder="Search here . .">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                </div>

                <div id="data_frame" class="data-block">

                <?php

                if ($_SESSION['user_type'] == 'staff_member') {
                    
                    $customers = 'SELECT * FROM customer';
                    $clients = $conn -> query($customers);
    
                    if ($clients -> num_rows > 0) {
                        while ($card = $clients -> fetch_assoc()) {
    
                            echo '
                                <div class="card">
                                    <div class="cardFrame" style="background: url('.$card['profile_picture_path'].'); background-size: 150%; background-position: center -15px; background-repeat: no-repeat;"></div>
                                    <div class="cardFrame">
                                        <h3>' . $card['first_name'] . ' ' . $card['last_name'] . '</h3> 
                                        <div class="btnBox">
                                            <a href="./showProfile.php?name=' . $card['first_name'] . ' ' . $card['last_name'] . '&id=' . $card['customer_id'] . '">
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </div>
                                            </a>
                                            <a href="">
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitch">
                                                        <path d="M21 2H3v16h5v4l4-4h5l4-4V2zm-10 9V7m5 4V7"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    } else {
                        echo '<p>No customers found.</p>';
                    }

                } else {

                    $staff_member = 'SELECT * FROM staff_member';
                    $staff = $conn -> query($staff_member);

                    if ($staff -> num_rows > 0) {
                        while ($card = $staff -> fetch_assoc()) {

                            echo '
                            <div class="staff" style="background: url('.$card['profile_picture_path'].'); background-size: 150%; background-position: center -15px; background-repeat: no-repeat;">
                                <div class="data">
                                    <h3>' . $card['first_name'] . ' ' . $card['last_name'] . '</h3>
                                    <p>' . $card['position'] . '</p>
                                    <p>' . $card['branch'] . '</p>
                                </div>
                                <div class="buttons">
                                    <a href="./showProfile.php?name=' . $card['first_name'] . ' ' . $card['last_name'] . '&id=' . $card['staff_id'] . '">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </div>
                                    </a>
                                    <a href="">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitch">
                                                <path d="M21 2H3v16h5v4l4-4h5l4-4V2zm-10 9V7m5 4V7"></path>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            ';

                        }
                    }

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
        {name: 'Profile', link: '../pages/dashboard.php', svg: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>'},
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
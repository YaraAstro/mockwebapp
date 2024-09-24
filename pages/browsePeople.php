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
    <title>See Customers | Mock App</title>

    <link rel="icon" href="../assets/images/poo_solid.ico" type="image/x-icon">

    <link rel="stylesheet" href="../assets/styles/staff_interactions/viewCustomeList.css">
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
                                            <a href="">
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
                                    <a href="">
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

</body>
</html>
<?php

include '../includes/createConn.php';

session_start();

if ( isset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_type'], $_SESSION['id_column']) ) {

    $sql = "SELECT * FROM " . $_SESSION['user_type'] . " WHERE " . $_SESSION['id_column'] . " = '" . $_SESSION['user_id'] . "'";
    
    $details = $conn -> query($sql);

    if ( ! ($details -> num_rows > 0) ) {
        echo "Internal Error !!";
    } else {
        $data = $details -> fetch_assoc();
    }
    
    $show_name = $_GET['name'] ?? null;
    $show_id = $_GET['id'] ?? null;
    $show_table = $_SESSION['user_type'] == 'staff_member' ? 'customer' : 'staff_member' ;
    $show_column = $_SESSION['user_type'] == 'staff_member' ? 'customer_id' : 'staff_id' ;

    $show_sql = "SELECT * FROM $show_table  WHERE  $show_column  =  '$show_id'";
    $show_query = $conn -> query($show_sql);
    if ( ! ($show_query -> num_rows > 0) ) {
        echo "Internal Error !! Cannot Fetch data :(";
    } else {
        $show = $show_query -> fetch_assoc();
    }

    // echo $show_sql;

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
    <title><?php echo $_SESSION['user_type'] == 'staff_member' ? $show_name.' | Customers' : $show_name.' | Staff' ?> | Mock App</title>

    <link rel="icon" href="../assets/images/poo_solid.ico" type="image/x-icon">

    <link rel="stylesheet" href="../assets/styles/interactions/showProfile.css">
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
            background: url('<?php echo $show['profile_picture_path'] ?>');
            background-size: cover;
            background-position: center;
            right: 0;
            top: 0;
            transform: rotateY(180deg);
            filter: saturate(1.5) contrast(1);
        }

        .chat::before {
            content: 'Chat with <?php echo $show['first_name'] ?>';
            font-weight: 600;
            transition: all ease-in-out .45s;
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

            <div class="frame">

                <div class="head">

                    <h1><?php echo $show_name ?></h1>

        <?php

            if (!($_SESSION['user_type'] == 'staff_member')) {

                echo '
                    <p class="staff-post">'.$show['position'].'</p>
                    <p class="staff-branch">'.$show['branch'].'</p>
                ';
            }
            
        ?>
                </div>
                
                
                <div id="userData" class="data"></div>

            </div>

            <div class="chat">
                <!-- <p>Chat with Natasha</p> -->
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle-more"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M8 12h.01"/><path d="M12 12h.01"/><path d="M16 12h.01"/></svg>
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

        let content = [
            {name: '<?php echo $show['email'] ?>', icon: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-at-sign"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8"/></svg>'},
            {name: '<?php echo $show['contact_number'] ?>', icon: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>'},
            {name: '<?php echo $show['address'].'<br>'.$show['district'].'<br>'.$show['postal_code'] ?>', icon: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>'},
        ]

        function AddData (array) {
            let content = [];

            array.forEach(element => {
                content.push(`
                    <div class="row">
                        <div class="icon">${element.icon}</div>
                        <p class="info">${element.name}</p>
                    </div>
                `);
            });
            
            document.getElementById('userData').innerHTML = content.join('');
        }

        AddData(content);

    </script>

</body>
</html>
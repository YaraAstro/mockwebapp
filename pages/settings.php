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

// ==================================================================================
// custom functions

// calculate age 
function calcAge ($dob) {

    $birth = new DateTime($dob);
    $today = new DateTime('today');

    $age = $today -> diff($birth) -> y ;

    return $age;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['user_name'] ?> | Settings | Mock App</title>
    <link rel="stylesheet" href="../assets/styles/settings/styles.css">
    <link rel="stylesheet" href="../assets/styles/scrollbarStyles.css">
</head>
<body>
    <div class="mainFrame">
        <!-- navigate buttons -->
        <div class="innerFrame">
            <div class="buttonBox">
                <a href="./dashboard.php">
                    <div class="box">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slack"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"></path><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"></path><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"></path><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"></path><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path></svg>
                        </div>
                        <p>dashboard</p>
                    </div>
                </a>
                <a href="#pI">
                    <div class="box">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        <p>personal info</p>
                    </div>
                </a>
                <a href="#cI">
                    <div class="box">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <p>contact info</p>
                    </div>
                </a>
                <?php
                
                if ($_SESSION['user_type'] == 'staff_member') {
                    echo '
                        <a href="#proI">
                            <div class="box">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                                </div>
                                <p>Pro Info</p>
                            </div>
                        </a>
                    ';
                }
                
                ?>
                <a href="#docI">
                    <div class="box">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <p>documents</p>
                    </div>
                </a>
                <a href="#bIo">
                    <div class="box">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-aperture"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
                        </div>
                        <p>biography</p>
                    </div>
                </a>
                <a href="#rePwd">
                    <div class="box">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </div>
                        <p>reset password</p>
                    </div>
                </a>
                <a href="">
                    <div class="box">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </div>
                        <p>delete account</p>
                    </div>
                </a>
            </div>
        </div>
        <!-- update details -->
        <div class="innerFrame">
            <div class="block">
                <!-- personal info -->
                <div id="pI" class="formBlock">
                    <h3>persnal information</h3>
                    <form action="../includes/settings/upload_personal_info.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="subForm evenly two">
                                <div class="dataBox">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="firstName" id="firstName" value="<?php echo $data['first_name'] ?>">
                                </div>
                                <div class="dataBox">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="lastName" id="lastName" value="<?php echo $data['last_name'] ?>" >
                                </div>
                                <div class="dataBox">
                                    <p class="label">Full Name</p>
                                    <p id="fullName" class="data"><?php echo $_SESSION['user_name'] ?></p>
                                </div>
                            </div>
                            <div class="subForm one centerFlex">
                                <label class="imgLabel" for="userImg">
                                    <input type="file" name="userImg" id="userImg" hidden>
                                    <?php
                                        !empty($data['profile_picture_path']) ? $img_path = $data['profile_picture_path'] : $img_path = '../assets/images/dashboard/5481365_2813838.jpg'; 
                                    ?>
                                    <img id="showPic" src="<?php echo $img_path ?>" alt="profile-picture">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="dataBox three">
                                <label for="bDay">Date of Birth</label>
                                <input type="date" name="bDay" id="bDay" value="<?php echo $data['date_of_birth'] ?>">
                            </div>
                            <div class="dataBox two">
                                <p class="label">Age</p>
                                <p id="showAge" class="data"> <?php echo calcAge($data['date_of_birth']) ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="dataBox two">
                                <label for="userGender">Gender</label>
                                <select name="userGender" id="userGender">
                                    <option value="male" <?php echo ($data['gender']=='male') ? 'selected' : '' ?> >Male</option>
                                    <option value="female" <?php echo ($data['gender']=='female') ? 'selected' : '' ?> >Female</option>
                                    <option value="other" <?php echo ($data['gender']=='other') ? 'selected' : '' ?> >Other</option>
                                </select>
                            </div>
                            <div class="dataBox three">
                                <label for="userNiC">NIC No.</label>
                                <input type="text" name="userNiC" id="userNiC" value="<?php echo $data['nic_number'] ?>">
                            </div>
                        </div>
                        <div class="rightBtnBox">
                            <button type="reset">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                </div>
                                <p>Cancel</p>
                            </button>
                            <button type="submit">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                </div>
                                <p>Done</p>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- contact info -->
                <div id="cI" class="formBlock">
                    <h3>contact information</h3>
                    <form action="../includes/settings/upload_contact_info.php" method="post">
                        <div class="dataBox">
                            <label for="userAddress">Address</label>
                            <textarea name="userAddress" id="userAddress"><?php echo $data['address'] ?></textarea>
                        </div>
                        <div class="row">
                            <div class="dataBox one">
                                <label for="userDistrict">District</label>
                                <select name="userDistrict" id="userDistrict">
                                    <option value="<?php echo $data['district'] ?>"><?php echo $data['district'] ?></option>
                                </select>
                            </div>
                            <div class="dataBox one">
                                <label for="userPostCode">Postal Code</label>
                                <input type="text" name="userPostCode" id="userPostCode" value="<?php echo $data['postal_code'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="dataBox two">
                                <label for="userMail">Email</label>
                                <input type="text" name="userMail" id="userMail" value="<?php echo $data['email'] ?>">
                            </div>
                            <div class="dataBox one">
                                <label for="userMobile">Mobile No.</label>
                                <input type="text" name="userMobile" id="userMobile" value="<?php echo $data['contact_number'] ?>">
                            </div>
                        </div>
                        <div class="rightBtnBox">
                            <button type="reset">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                </div>
                                <p>Cancel</p>
                            </button>
                            <button type="submit">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                </div>
                                <p>Done</p>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- staff data -->
                <?php
                
                if ( $_SESSION['user_type'] == 'staff_member' ) {
                    echo `
                    <div id="proI" class="formBlock">
                        <h3>Proffessional Information</h3>
                        <form action="../includes/settings/upload_proffessional_info.php" method="post">
                            <div class="row">
                                <div class="dataBox two">
                                    <label for="userPost">Position</label>
                                    <select name="userPost" id="userPost">
                                        <option value="`.$data['position'].`">`.$data['position'].`</option>
                                    </select>
                                </div>
                                <div class="dataBox one">
                                    <label for="userBranch">Branch</label>
                                    <select name="userBranch" id="userBranch">
                                        <option value="`.$data['branch'].`">`.$data['branch'].`</option>
                                    </select>
                                </div>
                            </div>
                            <div class="rightBtnBox">
                                <button type="reset">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                    </div>
                                    <p>Cancel</p>
                                </button>
                                <button  type="submit">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                    </div>
                                    <p>Done</p>
                                </button>
                            </div>
                        </form>
                    </div>
                    `;
                }
                
                ?>
                <!-- upload docs -->
                <div id="docI" class="formBlock">
                    <h3>documents</h3>
                    <form action="../includes/settings/upload_documents.php" method="post">
                        <!-- nic upload -->
                        <div class="row">
                            <div class="one descBox">
                                <p class="topic">Upload your NIC</p>
                                <p class="desc">To ensure the security of your account and protect your personal information, we kindly request that you verify your identity. This simple step helps to prevent unauthorized access and maintain a trustworthy online environment.</p>
                            </div>
                            <div class="one centerFlex">
                                <label class="docLabel" for="nicScan">
                                    <div class="svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M496 152a56 56 0 00-56-56H220.11a23.89 23.89 0 01-13.31-4L179 73.41A55.77 55.77 0 00147.89 64H72a56 56 0 00-56 56v48a8 8 0 008 8h464a8 8 0 008-8zM16 392a56 56 0 0056 56h368a56 56 0 0056-56V216a8 8 0 00-8-8H24a8 8 0 00-8 8z"/></svg>
                                    </div>
                                    <p>Drop|Click</p>
                                    <input type="file" name="nicScan" id="nicScan" hidden>
                                </label>
                            </div>
                            <div class="one docButtons">
                                <div class="docState approved docBtn">
                                    Lorem, ipsum.
                                </div>
                                <div class="docState docBtn">
                                    Lorem, ipsum.
                                </div>
                                <a href="<?php echo $data['nic_scan_path'] ?>" class="docBtn">
                                    <div class="svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 00-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 000-17.47C428.89 172.28 347.8 112 255.66 112z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><circle cx="256" cy="256" r="80" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
                                    </div>
                                    <p>View</p>
                                </a>
                            </div>
                        </div>
                        <?php
                        
                        if ($_SESSION['user_type'] == 'staff_member') {
                            echo '
                                <div class="row">
                                    <div class="one descBox">
                                        <p class="topic">Upload your Resume</p>
                                        <p class="desc">Updating your resume regularly keeps you prepared for new opportunities and showcases your latest skills and achievements.</p>
                                    </div>
                                    <div class="one centerFlex">
                                        <label class="docLabel" for="nicScan">
                                            <div class="svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M496 152a56 56 0 00-56-56H220.11a23.89 23.89 0 01-13.31-4L179 73.41A55.77 55.77 0 00147.89 64H72a56 56 0 00-56 56v48a8 8 0 008 8h464a8 8 0 008-8zM16 392a56 56 0 0056 56h368a56 56 0 0056-56V216a8 8 0 00-8-8H24a8 8 0 00-8 8z"/></svg>
                                            </div>
                                            <p>Drop|Click</p>
                                            <input type="file" name="nicScan" id="nicScan" hidden>
                                        </label>
                                    </div>
                                    <div class="one docButtons">
                                        <div class="docState empty docBtn">
                                            Lorem, ipsum.
                                        </div>
                                        <div class="docState docBtn">
                                            Lorem, ipsum.
                                        </div>
                                        <a href="'.$data['resume_path'].'" class="docBtn">
                                            <div class="svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 00-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 000-17.47C428.89 172.28 347.8 112 255.66 112z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><circle cx="256" cy="256" r="80" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
                                            </div>
                                            <p>View</p>
                                        </a>
                                    </div>
                                </div>
                            ';
                        }
                        
                        ?>
                        <!-- resume upload only for staff member -->
                        <div class="leftBtnBox">
                            <button type="submit">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                </div>
                                <p>Done</p>
                            </button>
                            <button type="reset">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                </div>
                                <p>Cancel</p>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- intro - about user -->
                <div id="bIo" class="formBlock">
                    <h3>biography</h3>
                    <!-- customer bio -->
                    <div class="descFrame">
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
                <!-- reset pwd -->
                <div id="rePwd" class="formBlock">
                    <h3>reset password</h3>
                    <form action="../includes/settings/reset_password.php" method="post">
                        <div class="rowForm">
                            <div class="subForm one">
                                <p id="capital-error">Password must contan at least one CAPITAL letter.</p>
                                <p id="spchar-error">Password must contain at least one Special Character (!@#$%^&*(),.?":{}|><).</p>
                                <p id="number-error">Password mustcontain atleast one Numeric Character (0-9).</p>
                                <p id="char-count">Password must be at least 8 characters long.</p>
                                <p class="errorMsg" id="error-msg"></p>
                            </div>
                            <div class="subForm one">
                                    <div class="dataBox">
                                        <label for="currentPwd">Current Password</label>
                                        <input class="inputPasswords" type="password" name="currentPwd" id="currentPwd" >
                                        <img class="passwordButton" src="../assets/images/settings/eye-slash-solid.svg" alt="eye-button" onclick="changeVisibility(this, 'currentPwd')" >
                                    </div>
                                    <div class="dataBox">
                                        <label for="createPwd">Createt New Password</label>
                                        <input class="inputPasswords" type="password" name="createPwd" id="createPwd" >
                                        <img class="passwordButton" src="../assets/images/settings/eye-slash-solid.svg" alt="eye-button" onclick="changeVisibility(this, 'createPwd')" >
                                    </div>
                                    <div class="dataBox">
                                        <label for="confirmPwd">Confirm New Password</label>
                                        <input class="inputPasswords" type="password" name="confirmPwd" id="confirmPwd" >
                                        <img class="passwordButton" src="../assets/images/settings/eye-slash-solid.svg" alt="eye-button" onclick="changeVisibility(this, 'confirmPwd')" >
                                    </div>
                            </div>
                        </div>
                        <div class="leftBtnBox">
                            <button id="resetPwdBtn" type="submit">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                </div>
                                <p>Done</p>
                            </button>
                            <button type="reset">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                </div>
                                <p>Cancel</p>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="../assets/scripts/settigns/javasript.js"></script>

    <script>
        // reset password
        let nowPwdInput = document.getElementById('currentPwd');
        nowPwdInput.addEventListener('input', () => {
            let errorMsg = document.getElementById('error-msg');
            let submit = document.getElementById('resetPwdBtn');
            let nowPwd = "<?php echo $data['password'] ?>";
            
            if (nowPwdInput.value === nowPwd || nowPwdInput.value === '' ) {
                errorMsg.textContent = '';
                submit.disabled = false;
            } else {
                errorMsg.textContent = 'Enter your Current Password';
                submit.disabled = true;
            }
        });

    </script>
    
</body>
</html>
<?php

include "./createConn.php";

$_SESSION = array();

session_destroy();

header("Location: ../pages/login.html");
exit();

include "./closeConn.php";

?>
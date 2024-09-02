<?php

    // create credentials
    $hostname = 'localhost';
    $username = 'mockuser';
    $password = 'mockWeb2024';
    $database = 'mockwebdb';

    // create connection
    $conn =  new mysqli($hostname, $username, $password, $database);

    // check the connection
    if ( $conn -> connect_error) {
        echo $connect_error ;
    }

?>
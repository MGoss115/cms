<?php 
    $db_host = "localhost";
    $db_name = "cms";
    $db_user = "kaygoss";
    $db_pass = "WFOIhqv.A@hZdc..";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    if(mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }
    echo "Connected succesfully!"
?>

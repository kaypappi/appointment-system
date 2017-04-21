<?php
    $server="localhost";
    $username="root";
    $password="";
    $db_name="project_schedule";

    $conn=mysqli_connect($server, $username, $password, $db_name);

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error() );
        echo "connected succesful";
    }
?>
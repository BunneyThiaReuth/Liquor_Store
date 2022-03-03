<?php
    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $database = "liquor_store";

    $conn = mysqli_connect($server_name,$user_name,$password,$database) or die("Connection Error...");
?>
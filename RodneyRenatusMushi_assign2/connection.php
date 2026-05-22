<?php
    $servername = "localhost";
    $username   = "root";
    $password   = "";

    $conn = mysqli_connect($servername, $username, $password);

    $sql = "CREATE DATABASE IF NOT EXISTS cacti_succulent";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
?>

<?php

$conn = null;

function setConnection()
{
    $servername = "65.49.214.207";
    $username = "root";
    $password = "12345";
    $dbname = "STUDENT";

    global $conn;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
};

function check_login(){
    if (!isset($_COOKIE["log_in"]))
    {
        echo '<script>alert("Please log in");
            location.replace("login.php")</script>';
    }
};
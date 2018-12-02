<?php
include_once ("connect.php");

$conn = setConnection();

$uname = null;
$pwd = null;

function checkName(){

    global $pwd;
    global $uname;
    global $conn;
    global $login_pwd;

    if (isset($_POST["username"]))
    {
        $uname = $_POST["username"];
    }
    if (isset($_POST["password"]))
    {
        $pwd = $_POST["password"];
    }


    if ($uname == "" || $uname == null)
    {
        header("Location:login.php");
        exit;
    }
    else
    {
        $uname = '"' . $uname . '"';
    }

    $login_sql = "SELECT password,student_ID FROM Student_Info WHERE user_name=" . $uname ;
    $result = mysqli_query($conn, $login_sql);
    $row = null;
    $student_ID = null;

    if (mysqli_num_rows($result) > 0)
    {
        global $row;
        $row = mysqli_fetch_assoc($result);
        $login_pwd = $row["password"];
    }

    if ($pwd == $login_pwd)
    {
        global $student_ID;
        $student_ID = $row["student_ID"];

        setcookie("log_in",  true, time() + 60 * 60 * 60);
        session_start();
        setcookie("student_ID", $student_ID, time() + 5 * 60);

        echo '<script>alert("login success")</script>';
    }
    else
    {
        setcookie("log_in", false, time() - 60 * 5);
        echo '<script>alert("wrong password!!!"); 
                location.replace("login.php")</script>';
        exit;
    }
    echo '<script>location.replace("dashboard.php")</script>';
}

checkName();
exit;
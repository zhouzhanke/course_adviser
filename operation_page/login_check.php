<?php
include_once ("connect.php");
setConnection();

$uname = null;
$pwd = null;

function checkName(){
    if (isset($_POST["username"]))
    {
        global $uname;
        $uname = $_POST["username"];
        echo $uname;
    }
    else
    {
        header("Location:http://localhost/Course-adviser/main_page/login.php");
        exit;
    }
}

checkName();

$login_sql = "SELECT password FROM Student_Info WHERE user_name=" . $uname ;
echo  $login_sql;

<?php
/**
 * Created by PhpStorm.
 * User: zhoudl0605
 * Date: 03/12/18
 * Time: 4:30 AM
 */

include "connect.php";
session_start();
//check_login();
$conn = setConnection();

$semester = $_SESSION["Semester"];
$sql_column = '(';
$sql_value = '(';
$sql_column = $sql_column . "student_ID";
$sql_value = $sql_value . $_COOKIE["student_ID"];

$count = 0;

for ($i = 1; $i <= 5; $i++)
{
    if (isset($_GET["course_" . $i]))
    {
            $sql_column = $sql_column . ',' . "course_" . $i;
            $sql_value = $sql_value . ',"' . $_GET["course_" . $i] . '"';
        $count++;
    }
}
$sql_column .= ')';
$sql_value .= ')';
$sql = 'DELETE FROM ' . $semester .'_course WHERE student_ID = ' . $_COOKIE["student_ID"];
mysqli_query($conn, $sql);

$sql = "INSERT INTO " . $semester . "_course " . $sql_column . "VALUES" . $sql_value;
if (mysqli_query($conn, $sql))
{
    $sql = "SELECT id FROM " . $semester . "_course WHERE student_ID=" . $_COOKIE["student_ID"];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql = 'UPDATE Student_Info SET ' . $semester . '_course_ID=' . $row["id"]
        . ' WHERE student_ID = ' . $_COOKIE["student_ID"];
    mysqli_query($conn, $sql);
}
echo '<script>alert("Fall course has been chosen!!!!")
location.replace("dashboard.php")</script>';



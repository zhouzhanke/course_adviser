<!DOCTYPE html>
<?php
$dbhost = 'localhost:3306';  // mysql服务器主机地址
$dbuser = 'root';            // mysql用户名
$dbpwd = '123456';          // mysql用户名密码
$conn = mysqli_connect($dbhost,$dbuser,$dbpwd);

if (! $conn)
{
    die('Connection failure' . mysqli_error());

}
echo "success";
?>

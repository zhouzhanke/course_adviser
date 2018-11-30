<!DOCUMENT html>
<html>
<title>Course Adviser</title>
<script>
    function checkName() {
        var check = document.forms["login"]["username"].value;
        if (check == null || check == "")
        {
            alert("Please enter user name!!!!!");
            return false;
        }
    }
</script>
<?php
include 'connect.php';
?>
<?php
function login(){

}
?>
<div>
    <h1>demo account:</h1>
    <p>User Name: 132022z</p>
    <p>Password: abc</p>
    <form name="login" method="post" action='login_check.php'>
        <p>User Name:
            <input type="text" name="username">
        </p>
        <p>Password:
            <input type="password" name="password">
        </p>
        <input type="submit" name="login" value="LOG IN" onclick="checkName()">
    </form>
</div>
</html>




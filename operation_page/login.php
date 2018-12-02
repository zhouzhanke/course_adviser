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
<div align="center">
    <h1>demo account:</h1>
    <p>User Name: 132022z</p>
    <p>Password: abc</p>
    <form name="login" method="post" action='login_check.php'>
        <table border="collapse">
        <tr>
            <th>User Name:
                <br>
                <input type="text" name="username">
            </th>
        </tr>
        <tr>
            <th>Password:
                <br>
                <input type="password" name="password">
            </th>
        </tr>
        <tr>
            <th>
                <div align="center">
                <input type="submit" name="login" value="LOG IN" onclick="checkName()">
                </div>
            </th>
        </tr>
    </table>
    
    </form>
</div>
</html>




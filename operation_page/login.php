<!DOCUMENT html>
<html>
<?php
include 'connect.php';
?>
<?php
function login(){

}
?>
<div>
    <form method="post" action='login_check.php'>
        <p>User Name:
            <input type="text" name="username">
        </p>
        <p>Password:
            <input type="password" name="password">
        </p>
        <input type="submit" name="login" value="LOG IN" >
    </form>
</div>
</html>




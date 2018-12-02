<!DOCTYPE html>
<html>
<style type="text/css">
#strip{
    widows: 100%;
    max-height: 2px;
    border-style: solid;
    border-color: green;
    background-color: black;
}
</style>
<?php
function check_login(){
    if (!isset($_COOKIE["log_in"]) && $_COOKIE["log_in"] != true)
    {
        echo '<script>alert("Please log in");
            location.replace("login.php")</script>';
    }
}
check_login();
?>
<head>
    <meta charset="utf-8">
    <title>Course Adviser</title>
    <?php
    include_once ("connect.php");
    $conn = setConnection();
    $student_ID = $_COOKIE["student_ID"];
    $sql = "SELECT * FROM Student_Info WHERE Student_ID = " . $student_ID;

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var show = 0;
            //show & hide fall course
            if (("<?php echo $row["fall_course_ID"] ?>") == null
                || ("<?php echo $row["fall_course_ID"] ?>") === "")
            {
                $("#fall_course").hide();
                show++;
            }
            else
                $("#fall_course").show();

            //show & hide winter course
            if (("<?php echo $row["winter_course_ID"] ?>") == null
                || ("<?php echo $row["winter_course_ID"] ?>") === "")
            {
                $("#winter_course").hide();
                show++;
            }
            else {
                $("#winter_course").show();
            }

            if (show == 2)
            {
                $("#timetable_container").hide();
            }
            else
                $("#timetable_container").show();

        });
    </script>
</head>

<body>
    <div align="center" id="main_container">
        <h1>Welcome to use Course Adviser</h1>
        <div id="strip"></div>
    </div>
        <div id="navigate">
            <input type="button" id="logout" value="LOG OUT" onclick="log_out()">
            <script>
                function log_out() {
                    <?php
                        setcookie("log_in", false, time() - 60 * 5);
                    ?>
                    alert("Log out success!!!!");
                    location.replace("login.php")
                }
            </script>
        </div>
        <div id="Info_container">
            <p>Information:</p>
            <?php
            echo "Name: " . $row["first_name"] . " " . $row["last_name"];
            echo "<br>Student_ID: " . $student_ID;
            echo "<br>Degree: " . $row["Degree"];
            $special = $row["Special_ID"];
            $sql_special = "SELECT * FROM SPECIALIZATION WHERE special_ID = " . $special;

            $result_special = mysqli_query($conn, $sql_special);
            $special_row = mysqli_fetch_assoc($result_special);
            $special = $special_row["name"];

            echo "<br>Specialization: " . $special;
            ?>
        </div>
        <div id="strip"></div>
        <div id="timetable_container" style="background-color: gold">
            <p>Time Table</p>
            <div id="fall_course">
                fall
            </div>
            <div id="winter_course">
                winter
            </div>
        </div>
        <div id="choose_container">
            <p>Press button to generate schedule:</p>
            <input type="button" id="choose_fall" value="Fall Course">
            <input type="button" id="choose_winter" value="Winter Course">
        </div>
    </div>
</body>

</html>

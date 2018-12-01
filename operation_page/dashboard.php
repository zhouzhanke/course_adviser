<!DOCTYPE html>
<html>
<?php
function check_login(){
    if (!isset($_COOKIE["log_in"]) && $_COOKIE["log_in"] != true)
    {
        echo '<script>alert("Please log in");
            location.replace("http://localhost/Course-adviser/operation_page/login.php")</script>';
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
            //show & hide fall course
            if (("\"" + <?php echo $row["fall_course_ID"] ?> + "\"") == null
                || "\"" + <?php echo $row["fall_course_ID"] ?> + "\"" == "")
            {
                $("#fall_course").show();


            }
            else
                $("#fall_course").hide();

            //show & hide winter course
            if (("<?php echo $row["winter_course_ID"] ?>") == null
                || ("<?php echo $row["winter_course_ID"] ?>") === "")
            {
                $("#winter_course").hide();
            }
            else {
                $("#winter_course").show();
            }
        });
    </script>
</head>

<body>
    <div id="main_container">
        <h1>Welcome to use Course Adviser</h1>
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
            <input type="button" id="choose_fall" value="Fall Course">
            <input type="button" id="choose_winter" value="Winter Course">
            <input type="button" id="choose_year" value="New School year">
        </div>
        <?php
        mongoConnection();
        ?>
    </div>
</body>

</html>
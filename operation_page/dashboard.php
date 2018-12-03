<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="my.css">
    <meta charset="utf-8">
    <title>Course Adviser</title>
    <?php
    include_once ("connect.php");
    check_login();
    $conn = setConnection();
    $student_ID = $_COOKIE["student_ID"];
    $login = $_COOKIE["log_in"];

    $sql = "SELECT * FROM Student_Info WHERE Student_ID = " . $student_ID;

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    function log_out()
    {
        global $student_ID;
        setcookie("student_ID", $student_ID, time() - 60 * 60, "/");
        setcookie("log_in",  "success", time() - 60 * 60, "/" );
        session_destroy();
    }
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
                    document.cookie = "student_ID =; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/ ";
                    document.cookie = "log_in =; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/ ";
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
                <b>Fall</b>
                <br>
                <?php
                if ($row["fall_course_ID"] != "" && $row["fall_course_ID"] != null)
                {
                    $sql_f = 'SELECT * FROM fall_course WHERE id="' . $row["fall_course_ID"] . '"';

                    $result_f = mysqli_query($conn, $sql_f);
                    $row_f = mysqli_fetch_assoc($result_f);

                    for ($i = 1; $i <= 5; $i++)
                    {
                        echo  $row_f["course_" . $i] . '<br>';
                    }
                }
                ?>
            </div>
            <br>
            <div id="winter_course">
                <b>Winter</b>
                <br>
                <?php
                if ($row["winter_course_ID"] != "" && $row["winter_course_ID"] != null)
                {
                    $sql_w = 'SELECT * FROM winter_course WHERE id="' . $row["fall_course_ID"] . '"';

                    $result_w = mysqli_query($conn, $sql_w);
                    $row_w = mysqli_fetch_assoc($result_w);

                    for ($i = 1; $i <= 5; $i++)
                    {
                        echo  $row_f["course_" . $i] . '<br>';
                    }
                }
                ?>
            </div>
        </div>
        <div id="choose_container">
            <p>Press button to generate schedule:</p>
            <script>
                function choose_fall() {
                    location.replace("fall.php");
                }
                function choose_winter() {
                    location.replace("winter.php");
                }
            </script>
            <input type="button" id="choose_fall" value="Fall Course" onclick=choose_fall()>
            <input type="button" id="choose_winter" value="Winter Course" onclick=choose_winter()>
        </div>
    </div>
</body>

</html>

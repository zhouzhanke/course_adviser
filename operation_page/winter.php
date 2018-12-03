<!DOCUMENT html>
<html>
<?php
/**
 * Created by PhpStorm.
 * User: zhoudl0605
 * Date: 01/12/18
 * Time: 8:23 PM
 */
include "connect.php";
include "get_course.php";
$conn = setConnection();
check_login();

$sql = 'SELECT course.Times, course.Discipline, course.Code, course.Days  
        FROM course 
        INNER JOIN course_avaliable 
        ON course.Discipline = course_avaliable.discipline 
        WHERE course.Code = course_avaliable.code AND course.Semester="Winter" AND Year="2018-2019"';

$result = mysqli_query($conn, $sql);

$count = 0;
$name = array(null, null, null, null, null);
$code = array(null, null, null, null, null);

while ($row = mysqli_fetch_assoc($result))
{
    for ($i = 0; $i < sizeof($name); $i++)
    {
        if ($name[$i] . $code[$i] != ($row["Discipline"] . $row["Code"]) && $name[$i] == null) {
            $name[$i] = $row["Discipline"];
            $code[$i] = $row["Code"];
            $count++;
            break;
        }
        if ($row["Discipline"] . $row["Code"] == $name[$i] . $code[$i])
            break;
    }
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="my.css">
    <meta charset="utf-8">
    <title>Course Adviser</title>
</head>
<body>
<div id="container">
    <input type="button" onclick=location.replace("dashboard.php") value="BACK">
    <div id="strip"></div>
    <?php
    echo '<form action="winter_submit.php">';
    $count = 0;
    foreach ($name as $value) {

        if ($value != null) {
            $count++;
            echo '<div>';
            $sql = 'SELECT Times, Days, Section, Discipline, Code FROM course WHERE Semester="Winter" AND Year="2018-2019" AND Discipline="'
                . $value . '" AND Code="' . $code[$count - 1] . "\"";

            global $conn;
            $result = mysqli_query($conn, $sql);
            echo '<p>' . $name[$count - 1] . $code[$count - 1] . '</p>';
            $num = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<input type="radio" name = "course_' . $count . '" value="' . $row["Discipline"] . '-'
                    . $row["Code"] . '-' . $row["Section"] . '">' . $row["Section"] . ' ' . $row["Times"] . ' '
                    . $row["Days"];
                echo "<br>";
            }
            echo '</div>';
        }
        else {
            echo '<p>You Still have ' . (5 - $count) . ' course need to choose</p>';
            for ($i = 0; $i < 5 - $count; $i++) {


                echo '<div name ="Course_' . ($count + $i + 1) . '">';
                echo '<div>';
                echo '<input style="display:none">';
                echo '<input type="text" size ="10" id="input_course_' . ($count + $i + 1)
                    . '" name="course_' . ($count + $i + 1) .'" onkeyup="get_Course' . $i . '(this.value, this.id, this.name)">';
                echo '<div id = "course_' . ($count + $i + 1) . '"> </div>';
                echo "</div>";
                echo '</div>';
                //echo '</div>';
                echo '<script>
    function get_Course' .  $i .'(str,input_id, div_id) {
        if (str.length === 0) {
            document.getElementById(div_id).innerHTML="";
            document.getElementById(div_id).style.border="0px";
            return;
        }

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }

        xmlhttp.onreadystatechange=function () {
            if (this.readyState == 4 && this.status==200){
                document.getElementById(div_id).innerHTML=this.responseText;
                document.getElementById(div_id).style.border="1px solid #A5ACB2";
            }

        }

        xmlhttp.open("GET", "get_course.php?q=" + str + "&div=" + div_id, true);
        xmlhttp.send();
    }
</script>';
            }
        }
    }
    session_start();
    $_SESSION["Semester"] = "winter";
    echo '<input type="submit" value="submit">';
    echo '</form>';
    ?>
</div>

<div id="strip"></div>
</body>


</html>

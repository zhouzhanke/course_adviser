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
$conn = setConnection();

$sql = 'SELECT course.Times, course.Discipline, course.Code, course.Days  
        FROM course 
        INNER JOIN course_avaliable 
        ON course.Discipline = course_avaliable.discipline 
        WHERE course.Code = course_avaliable.code AND course.Semester="Fall" AND Year="2018-2019"';

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
    <meta charset="utf-8">
    <title>Course Adviser</title>

</head>

<div id="container">
        <?php
        $count = 0;
        foreach ($name as $value)
            if ($value != null)
            {
                $count++;
                echo '<div id="course_' . $count . '">';
                echo '<form>';
                $sql = 'SELECT Times, Days, Section FROM course WHERE Semester="Fall" AND Year="2018-2019" AND Discipline="'
                    . $value . '" AND Code="' . $code[$count - 1] . "\"";

                global $conn;
                $result = mysqli_query($conn, $sql);
                echo '<p>' . $name[$count - 1] . $code[$count - 1] . '</p>';
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo '<input type="radio" id="' . $row["Times"] . $row["Days"]
                        .'" name = "course_' . $count . '" value="' . $row["Times"] . '|'
                        . $row["Days"] . '">' . $row["Section"] . ' ' . $row["Times"] . ' ' . $row["Days"];
                }
                echo '</form>';
                echo '</div>';
            }
        ?>
</div>

</html>

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
        foreach ()
        $sql = "SELECT "
        ?>
</div>

</html>

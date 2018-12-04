<?php

include_once ("connect.php");
$conn = setConnection();

if (!isset($_GET["q"]))
{
    return;
}
if (!isset($_GET["div"]))
    return;

$div = $_GET["div"];
$q=$_GET["q"];
$tmp = str_split($q, 1);
$Code = 0;
$Discipline = "";

foreach ($tmp as $value)
{
    if (is_numeric($value))
        $Code = $Code * 10 + $value;
    else
        $Discipline .= $value;
}

$sql = 'SELECT * FROM course WHERE Year="2018-2019" AND Semester="Fall" AND Discipline="'
    . $Discipline . '" AND Code="' . $Code . '"';

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        echo '<input type="radio" name="' . $div .'" value="' . $row["Discipline"] . '-' . $row["Code"] . '-'
        . $row["Section"] . '"/>' . $row["Section"]
            . ' ' . $row["Times"] . ' ' .  $row["Days"] . '_' . $row["Primary_Instructor"] . '<br>';
    }
}
else
    echo 'None result!!!';


<?php
session_start();
include('../config.php');

$sql = "SELECT * FROM kpi WHERE userID=" . $_SESSION["UID"] . " LIMIT 1";
$result = mysqli_query($conn, $sql);

$cgpa_myself = $_POST["cgpa_myself"];
$faculty = $_POST["faculty"];
$university = $_POST["university"];
$national = $_POST["national"];
$international = $_POST["international"];

if (mysqli_num_rows($result) == 1) {

    $sql = "UPDATE kpi SET 
    cgpa_myself = '$cgpa_myself',
    faculty = '$faculty',
    university = '$university',
    national = '$national',
    international = '$international'
    WHERE userID =". $_SESSION["UID"];


    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Form data saved successfully!";
        header("refresh:2;URL=my_kpi.php");
    } else {
        echo "WARNING :: Form data not saved successfully!";
        header("refresh:2;URL=my_kpi.php");
    }
} else {
    $sql = "INSERT INTO kpi (`userID`, `cgpa_myself`, 
    `faculty`, `university`, `national`, `international`) 
    VALUES('" . $_SESSION["UID"] . "','" . $cgpa_myself . "',
    '" . $faculty . "','" . $university . "',
    '" . $national . "','" . $international . "')";


    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Form data saved successfully!";
        header("refresh:2;URL=my_kpi.php");
    } else {
        echo "WARNING :: Form data not saved successfully!";
        header("refresh:2;URL=my_kpi.php");
    }
}
mysqli_close($conn);

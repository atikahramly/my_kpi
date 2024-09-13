<?php
include('../config.php');

$sql = "SELECT * FROM kpi WHERE userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    $cgpa_myself = $row["cgpa_myself"];
    $faculty = $row["faculty"];
    $university = $row["university"];
    $national = $row["national"];
    $international = $row["international"];
}

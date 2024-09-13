<?php
    session_start();
    include ('../config.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sem = $_POST["sem"];
        $year = $_POST["year"];
        $activity = $_POST["activity"];
        $remark = $_POST["remark"];

        $sql = "INSERT INTO activities (userID, sem, year, activity, remark) 
        VALUES ('" . $_SESSION["UID"] . "', '" . $sem . "', '". $year . "', '" . $activity . "','" . $remark . "')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "New record created successfully.<br>";
            echo '<a href="javascript:history.back()">Back</a>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo '<a href="javascript:history.back()">Back</a>';
        }
    }
?>
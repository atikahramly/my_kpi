<?PHP
session_start();
include('../config.php');

//this block is called when button Submit is clicked
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST["activity_id"];
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $activity = trim($_POST["activity"]);
    $level = $_POST["level"];
    $remark = trim($_POST["remark"]);

    $sql = "UPDATE activities SET sem = '$sem', year ='$year', activity = '$activity', level = '$level',  remark = '$remark' 
    WHERE activity_id =" . $id . " AND userID = ". $_SESSION["UID"]; 
    
    $status = mysqli_query($conn, $sql);

    if ($status) {
        echo "Form data updated successfully!<br>";
        echo '<a href="my_activities.php">Back</a>';             
    } else {
        echo "Form data updated error!<br>";
        echo '<a href="my_activities.php">Back</a>';
    }   
}

//close db connection
mysqli_close($conn);


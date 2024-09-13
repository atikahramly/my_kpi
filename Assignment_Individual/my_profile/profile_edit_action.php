<?PHP
session_start();
include('../config.php');

$target_dir = "../Uploads/";
$target_file = "";
$uploadOk = 0;
$imageFileType = "";
$uploadfileName = "";

//check if logged-in
if(!isset($_SESSION["UID"])){
    header("location:../index.php"); 
}

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $program = $_POST["program"];
    $mentor = $_POST["mentor"];
    $motto = $_POST["motto"];

    $filetmp = $_FILES["fileToUpload"];
    $uploadfileName = $filetmp["name"];

        if(isset($_FILES["fileToUpload"]) &&  $_FILES["fileToUpload"]["name"] == ""){
            $sql = "UPDATE profile SET username='$username', program='$program', 
            mentor='$mentor', motto='$motto' WHERE userID=" . $_SESSION["UID"];

        $status = update_DBTable($conn, $sql);

        if ($status) {
            echo "Form data updated successfully!<br>";
            echo '<a href="profile.php">Back</a>';             
        } else {
            echo '<a href="profile.php">Back</a>';
        }   
    }
    //IF there is image
    else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        //Variable to determine for image upload is OK
        $uploadOk = 1;        
        $filetmp = $_FILES["fileToUpload"];

        //file of the image/photo file
        $uploadfileName = $filetmp["name"];
                 
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "ERROR: Sorry, image file $uploadfileName already exists.<br>";
            $uploadOk = 0;
        }
        
        // Check file size <= 488.28KB or 500000 bytes
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "ERROR: Sorry, your file is too large. Try resizing your image.<br>";
            $uploadOk = 0;
        }
        
        // Allow only these file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        } 

        //If uploadOk, then try add to database first 
        //uploadOK=1 if there is image to be uploaded, filename not exists, file size is ok and format ok     
        if($uploadOk){
            $sql = "UPDATE profile SET username='$username', program='$program', 
            mentor='$mentor', motto='$motto' , profile_img= '$uploadfileName' WHERE userID=" . $_SESSION["UID"];

            $status = update_DBTable($conn, $sql);

            if ($status) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //Image file successfully uploaded                    
                    
                    //Tell successfull record
                    echo "Profile updated successfully!<br>";
                    echo '<a href="profile.php">Back</a>'; 
                } 
                else{
                    //There is an error while uploading image 
                    echo "Sorry, there was an error uploading your file.<br>";  
                    echo '<a href="javascript:history.back()">Back</a>';              
                }
            } 
            else {
                echo '<a href="javascript:history.back()">Back</a>';
            }
        }
        else{            
            echo '<a href="javascript:history.back()">Back</a>';
        }
    }    
}
//close db connection
mysqli_close($conn);

//Function to insert data to database table
function update_DBTable($conn, $sql){
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>

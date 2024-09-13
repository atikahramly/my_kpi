<?php
session_start();
include("../config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form_tableStyle.css">
    <script src="https://kit.fontawesome.com/9aa99ba8cc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .row {
            justify-content: center;
            align-items: center;
            display: flex;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="../img/logo.png" alt="">
    </div>

    <?php
    if (isset($_SESSION["UID"])) {
        include '../menu.php';
    }
    ?>

    <?php

    $matricNo = "";
    $userEmail = "";
    $username = "";
    $program = "";
    $mentor = "";
    $motto = "";
    $profile_img = "avatar.png";
    //query the table user and profile
    $sql = 'SELECT user.userID, user.matricNo, user.userEmail, profile.username, profile.program, profile.mentor, profile.motto, profile.profile_img
    FROM user INNER JOIN profile ON user.userID = profile.userID
    WHERE user.userID=' . $_SESSION['UID'] . ';';

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $matricNo = $row["matricNo"];
        $userEmail = $row["userEmail"];
        $username = $row["username"];
        $program = $row["program"];
        $mentor = $row["mentor"];
        $motto = $row["motto"];
        if ($row["profile_img"] != "") {
            $profile_img = $row["profile_img"];
        }

    }
    ?>

    <div class="row">
        <div>
            <h2>Edit My Profile</h2>
            <form action="profile_edit_action.php" method="post"enctype="multipart/form-data" style="background-color: transparent;">
                <table class="allTable" width="100%">
                    <tr>
                        <th width="164">Matric No.</th>
                        <td>
                            <?= $matricNo ?>
                        </td>
                    </tr>
                    <tr>
                        <th width="164">Email</th>
                        <td>
                            <?= $userEmail ?>
                        </td>
                    </tr>
                    <tr>
                        <th width="164">Name</th>
                        <td><textarea rows="1" name="username" style="width:100%"><?= $username ?></textarea></td>
                    </tr>
                    <tr>
                        <th width="164">Program</th>
                        <td><select size="1" name="program">
                                <option value="" <?php echo ($program == '') ? 'selected' : ''; ?> disabled>Select Program
                                </option>
                                <option <?php echo ($program == 'Software Engineering') ? 'selected' : ''; ?>>Software
                                    Engineering</option>
                                <option <?php echo ($program == 'Network Engineering') ? 'selected' : ''; ?>>Network
                                    Engineering</option>
                                <option <?php echo ($program == 'Data Science') ? 'selected' : ''; ?>>Data Science
                                </option>
                            </select></td>
                    </tr>
                    <tr>
                        <th width="164">Mentor Name</th>
                        <td><textarea rows="1" name="mentor" style="width:100%"><?= $mentor ?></textarea></td>
                    </tr>
                    <tr>
                        <th colspan="2" style:="text-align:left;">
                            My Study Motto:
                            <textarea rows="5" name="motto" style="width:100%"><?= $motto ?></textarea>
                        </th>
                    </tr>
                    <tr>
                        <th>Profile Photo</th>
                        <td>
                            <input type="text" disabled value="<?= $profile_img; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Upload new photo</th>
                        <td>
                            Max size: 488.28KB<br>
                            <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
                        </td>
                    </tr>
                </table>
                <div style="display: flex; justify-content: space-around">
                    <input type="submit" value="Update" style="cursor: pointer; padding: 15px; margin: 10px">
                    <input type="reset" value="Reset" style="cursor:pointer; padding: 15px; margin: 10px">
                </div>
            </form>
        </div>
    </div>
    <footer>
        <p>Copyright (c) @2023 - Atikah Ramly</p>
    </footer>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "navbar") {
                x.className += " responsive";
            } else {
                x.className = "navbar";
            }
        }

        function switchToEdit() {
            var x = document.getElementById("profile");
            x.style.display = 'block';
            var firstField = document.getElementById('sem');
            firstField.focus();
        }
    </script>
</body>

</html>
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

    //query the user and profile table for this user
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
    <h2>My Profile</h2>
    <div class="row">
        <div class="col-left">
            <div class="imgcontainer" style="align: center; width: 100%; border-radius: 0%">
                <img src="../uploads/<?= $profile_img ?>" alt="Avatar" class="avatar">
            </div>
        </div>
        <div class="col-right">
            <div class="btnbtn">
                <div class="edit_btn">
                    <a href="profile_edit.php">Edit</a>
                </div>
            </div>
            <table class="allTable" border="1" width="100%">
                <tr>
                    <th width="164">Name</th>
                    <td>
                        <?= $username ?>
                    </td>
                </tr>
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
                    <th width="164">Program</th>
                    <td>
                        <?= $program ?>
                    </td>
                </tr>
                <tr>
                    <th width="164">Mentor Name</th>
                    <td>
                        <?= $mentor ?>
                    </td>
                </tr>
                <tr>
                    <th width="164">Study Motto</th>
                    <td>
                        <?php
                        if ($motto == "") {
                            echo "&nbsp;";
                        } else {
                            echo $motto;
                        }

                        ?>
                    </td>
                </tr>
            </table>
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
    </script>
</body>

</html>
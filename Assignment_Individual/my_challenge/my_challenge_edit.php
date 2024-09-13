<?php
session_start();
include("../config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Study KPI</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form_tableStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/9aa99ba8cc.js" crossorigin="anonymous"></script>
    <style>
        #challengeDiv {
            display: none;
        }

        .row {
            justify-content: center;
            align-items: center;
            display: flex;
        }
    </style>
</head>

<body onLoad="show_AddEntry()">
    <div class="header">
        <img src="../img/logo.png" alt="">
    </div>

    <?php
    if (isset($_SESSION["UID"])) {
        include '../menu.php';
    } else {
        //include 'menu.php';
        header("location:../index.php");
    }
    ?>

    <?php
    $id = "";
    $sem = "";
    $year = "";
    $challenge = " ";
    $plan = "";
    $remark = "";
    $img = "";

    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $sql = "SELECT * FROM challenge WHERE ch_id=" . $_GET["id"];
        //echo $sql . "<br>";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row["ch_id"];
            $sem = $row["sem"];
            $year = $row["year"];
            $challenge = $row["challenge"];
            $plan = $row["plan"];
            $remark = $row["remark"];
            $img = $row["img_path"];
        }
    }

    mysqli_close($conn);
    ?>

    <div class="row">
        <div id="challengeDiv">
            <div style="padding: 10px;">
                <h2 align="center">Edit Challenge and Plan</h2>
                <p align="center">Required field with mark*</p>

                <form method="POST" action="my_challenge_edit_action.php" id="cid" enctype="multipart/form-data">
                    <!--hidden value: id to be submitted to action page-->
                    <input type="hidden" name="cid" value="<?= $_GET['id'] ?>">
                    <table class="allTable" border="1">
                        <tr>
                            <th>Semester*</th>
                            <td>
                                <select size="1" name="sem" id="sem" required>
                                    <option value="">&nbsp;</option>
                                    <?php
                                    if ($sem == "1") {
                                        echo '<option value="1" selected>1</option>';
                                    } else {
                                        echo '<option value="1">1</option>';
                                    }
                                    if ($sem == "2") {
                                        echo '<option value="2" selected>2</option>';
                                    } else {
                                        echo '<option value="2">2</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Year*</th>
                            <td>
                                <?php
                                if ($year != "") {
                                    echo '<textarea rows="2" name="year" cols="50" required>' . $year . '</textarea>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Challenge*</th>
                            <td>
                                <textarea rows="4" name="challenge" cols="50" required><?php echo $challenge; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Plan*</th>
                            <td>
                                <textarea rows="4" name="plan" cols="50" required><?php echo $plan; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Remark</th>
                            <td>
                                <textarea rows="4" name="remark" cols="50"><?php echo $remark; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Photo</th>
                            <td>
                                <input type="text" disabled value="<?= $img; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Upload photo</th>
                            <td>
                                Max size: 488.28KB<br>
                                <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
                            </td>
                        </tr>
                    </table>
                    <div style="display: flex; justify-content: space-around">
                        <input type="submit" value="Update" style="cursor: pointer; padding: 15px; margin: 10px">
                        <input type="reset" value="Reset" style="cursor: pointer; padding: 15px; margin: 10px">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p></p>
    <footer>
        <p>Copyright (c) @2023 FCI - Atikah Ramly</p>
    </footer>

    <script>
        //for responsive sandwich menu
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }

        //reset form after modification to a php echo to fields
        function resetForm() {
            document.getElementById("cid").reset();
        }

        function show_AddEntry() {
            var x = document.getElementById("challengeDiv");
            x.style.display = 'block';
            var firstField = document.getElementById('sem');
            firstField.focus();
        }
    </script>
</body>

</html>
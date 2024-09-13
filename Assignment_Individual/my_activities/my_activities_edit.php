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
    $activity = "";
    $level = "";
    $remark = "";

    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $sql = "SELECT * FROM activities WHERE activity_id=" . $_GET["id"];
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row["activity_id"];
            $sem = $row["sem"];
            $year = $row["year"];
            $activity = $row["activity"];
            $level = $row["level"];
            $remark = $row["remark"];
        } else {
            echo "Data not found.<br>";
        }
    } else {
        echo "Cannot find activity id.<br>";
    }
    mysqli_close($conn);
    ?>

    <div class="row">
        <div id="new_act">
            <div style="padding: 10px;">
                <h2 align="center">Edit Activity</h2>
                <p align="center">Required field with mark*</p>
                <form style="width: 700px;" id="activity_id" method="POST" action="my_activities_edit_action.php"
                    enctype="multipart/form-data">
                    <input type="hidden" name="activity_id" value="<?= $_GET['id'] ?>">
                    <table class="allTable" border="1">
                        <tr>
                            <th>Semester*</th>
                            <td>
                                <select size="1" id="sem" name="sem" required>
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
                                        echo '<option value="1">1</option>';
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
                                    echo '<textarea rows="2" name="year" cols="35" required>' . $year . '</textarea>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Name of Activities/Club/Association/Competition *</th>
                            <td>
                                <textarea rows="4" name="activity" cols="35"
                                    required><?php echo $activity; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Level</th>
                            <td>
                                <select size="1" name="level" id="level" required>
                                    <option value="">&nbsp;</option>
                                    <?php
                                    if ($level == "Faculty")
                                        echo '<option value="Faculty" selected>Faculty</option>';
                                    else
                                        echo '<option value="Faculty">Faculty</option>';
                                    if ($level == "University")
                                        echo '<option value="University" selected>University</option>';
                                    else
                                        echo '<option value="University">University</option>';
                                    if ($level == "National")
                                        echo '<option value="National" selected>National</option>';
                                    else
                                        echo '<option value="National">National</option>';
                                    if ($level == "International")
                                        echo '<option value="International" selected>International</option>';
                                    else
                                        echo '<option value="International">International</option>';
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Remark</th>
                            <td>
                                <textarea rows="4" name="remark" cols="35"> <?php echo $remark; ?></textarea>
                            </td>
                        </tr>
                    </table>
                    <div style="display: flex; justify-content: space-around">
                        <input type="submit" value="Submit" style="cursor: pointer; padding: 15px; margin: 10px">
                        <input type="reset" value="Reset" style="cursor:pointer; padding: 15px; margin: 10px"
                            onclick="resetForm()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>Copyright (c) @2023 FCI - Atikah Ramly</p>
    </footer>

    <script>
        //for responsive sandwich menu
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "navbar") {
                x.className += " responsive";
            } else {
                x.className = "navbar";
            }
        }

        //reset form after modification to a php echo to fields
        function resetForm() {
            document.getElementById("activity_id").reset();
        }

        function show_AddEntry() {
            var x = document.getElementById("new_act");
            x.style.display = 'block';
            var firstField = document.getElementById('sem');
            firstField.focus();
        }
    </script>
</body>

</html>
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
        #new_act {
            display: none;
        }

        h1 {
            background-color: #F3DDB3;
            color: #000000;
        }

        .allTable tr:hover {
            background-color: #C8B4BA;
        }

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
    } else {
        //include 'menu.php';
        header("location:../index.php");
    }
    ?>

    <div style="padding: 10px;" id="activities">
        <h2>My Activities</h2>
        <div>
            <form action="my_activities_search.php" method="post"
                style="text-align: right; padding: 5px; background-color: transparent; display: flex; flex-direction: row; width: 100%;">
                <input
                    style="text-align: left; padding: 10px; display: flex; flex-direction: row; width: 88%; margin-right: 10px;"
                    type="text" placeholder="Search.." name="search">
                <input style="padding: 10px;" type="submit" value="Search">
            </form>
        </div>
        <table class="allTable" border="1" width="90%">
            <tr>
                <th width="5%">No</th>
                <th width="10%">Sem & Year</th>
                <th width="30%">Activities</th>
                <th width="20%">Level</th>
                <th width="40%">Remark</th>

                <?php
                $sql = "SELECT * FROM activities WHERE userID=" . $_SESSION["UID"];
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<th style="width="5%"; text-align: center; background-color: #619196; color: white;">Action</th>';
                }
                ?>
            </tr>
            <?php
            $sql = "SELECT * FROM activities WHERE userID=" . $_SESSION["UID"];
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $numrow = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $numrow . "</td>";
                    echo '<td>' . $row["sem"] . '  ' . $row["year"] . '</td>';
                    echo "<td>" . $row["activity"] . "</td>";
                    echo "<td>" . $row["level"] . "</td>";
                    echo "<td>" . $row["remark"] . "</td>";
                    echo '<td> <a href="my_activities_edit.php?id=' . $row["activity_id"] . '">Edit</a>&nbsp;|&nbsp;';
                    echo '<a href="my_activities_delete.php?id=' . $row["activity_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                    echo "</tr>" . "\n\t\t";
                    $numrow++;
                }
            } else {
                echo '<tr><td colspan="7">No results</td></tr>';
            }

            mysqli_close($conn);
            ?>
        </table>
        <?php
        if (isset($_SESSION["UID"])) {
            ?>
            <div
                style="text-align: right; padding-top:10px; justify-content: end; display: flex; flex-direction: row; margin-right: 10px;">
                <input style="text-align: right; padding: 10px;" type="button" value="Add New" onclick="show_AddEntry()">
            </div>
            <?php
        }
        ?>
    </div>

    <div class="row">
        <div id="new_act">
            <div style="padding: 10px;">
                <h2 align="center">Add New Activities</h2>
                <p align="center">Required field with mark*</p>
                <form style="width: 700px;" method="POST" action="my_activities_action.php"
                    enctype="multipart/form-data">
                    <table class="allTable" border="1" style="width: 100%;">
                        <tr>
                            <th>Semester *</th>
                            <td>
                                <select size="1" id="sem" name="sem" style="align: center;" required>
                                    <option value="">&nbsp;</option>
                                    <option value="1">1</option>;
                                    <option value="2">2</option>;
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Year*</th>
                            <td>
                                <textarea rows="2" name="year" cols="35"
                                    style="align-item: center; border: 1px solid black" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Name of Activities/Club/Association/Competition *</th>
                            <td>
                                <textarea rows="4" name="activity" cols="35" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Level</th>
                            <td>
                                <select size="1" name="level" id="level" required>
                                    <option value="">&nbsp;</option>
                                    <option value="Faculty">Faculty</option>;
                                    <option value="University">University</option>;
                                    <option value="National">National</option>;
                                    <option value="International">International</option>;
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Remark</th>
                            <td>
                                <textarea rows="4" name="remark" cols="35"></textarea>
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
    </div>
    </main>
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

        function show_AddEntry() {
            var x = document.getElementById("new_act");
            x.style.display = 'block';
            var x = document.getElementById("activities");
            x.style.display = 'none';
            var firstField = document.getElementById('sem');
            firstField.focus();
        }
    </script>
</body>

</html>
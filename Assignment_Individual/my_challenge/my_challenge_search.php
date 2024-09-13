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

        #myTable th{
            text-align: left;
            padding-left: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="../img/logo.png" alt="">
    </div>

    <?php
    $search = "";
    if (isset($_SESSION["UID"])) {
        include '../menu.php';
    } else {
        //include 'menu.php';
        header("location:../index.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = $_POST["search"];
    }
    ?>

    <div style="padding:0 10px;">
        <div style="text-align: right; padding:10px;" id="search_challenge">
            <h2>Search Result:&nbsp;
                <?= $search ?>
            </h2>
            <form action="my_challenge_search.php" method="post"
                style="text-align: right; padding: 5px; background-color: transparent; display: flex; flex-direction: row; width: 100%;">
                <input
                    style="text-align: left; padding: 10px; display: flex; flex-direction: row; width: 94%; margin-right: 10px;"
                    type="text" placeholder="Search.." name="search">
                <input style="padding: 10px;" type="submit" value="Search">
            </form>
        </div>
        <table class="allTable" border="1" width="100%">
            <tr>
                <th width="5%">No</th>
                <th width="10%">Sem & Year</th>
                <th width="30%">Challenge</th>
                <th width="30%">Plan</th>
                <th width="15%">Remark</th>
                <th width="10%">Photo</th>
                <th width="10%">Action</th>
            </tr>
            <?php
            if ($search != "") {
                $search = $_POST["search"];

                // Split the search string into individual words
                $keywords = explode(" ", $search);

                // Prepare the SQL query with multiple LIKE conditions
                $sql = "SELECT * FROM challenge WHERE (";

                // Build the conditions dynamically for single keyword
                $conditions = [];
                foreach ($keywords as $index => $keyword) {
                    $conditions[] = "challenge LIKE '%$keyword%'";
                }

                // Combine
                $sql .= implode(" OR ", $conditions);

                // Select only with this userID
                $sql .= " OR challenge LIKE '%$search%') AND userID=" . $_SESSION["UID"];

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    $numrow = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $numrow . "</td><td>" . $row["sem"] . " " . $row["year"] . "</td><td>" . $row["challenge"] .
                            "</td><td>" . $row["plan"] . "</td><td>" . $row["remark"] . "</td><td>" . $row["img_path"] . "</td>";
                        echo '<td> <a href="my_challenge_edit.php?id=' . $row["ch_id"] . '">Edit</a>&nbsp;|&nbsp;';
                        echo '<a href="my_challenge_delete.php?id=' . $row["ch_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                        echo "</tr>" . "\n\t\t";
                        $numrow++;
                    }
                } else {
                    echo '<tr><td colspan="7">0 results</td></tr>';
                }

                mysqli_close($conn);
            } else {
                echo "Search query is empty<br>";
            }
            ?>
        </table>
        <?php
        if (isset($_SESSION["UID"])) {
            ?>
            <div style="text-align: right; padding-top:10px;" id="add_challenge">
                <input type="button" value="Add New" onclick="show_AddEntry()">
            </div>

            <?php
        }
        ?>
    </div>

    <div class="row">
        <div style="padding:0 10px;" id="challengeDiv">
            <h2 align="center">Add Challenge and Plan</h2>
            <p align="center">Required field with mark*</p>
            <form method="POST" action="my_challenge_action.php" enctype="multipart/form-data" id="myForm">
                <table class="allTable" border="1" id="myTable">
                    <tr>
                        <th>Semester*</th>
                        <td>
                            <select size="1" id="sem" name="sem" required>
                                <option value="">&nbsp;</option>
                                <option value="1">1</option>;
                                <option value="2">2</option>;
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Year*</th>
                        <td>
                            <input type="text" name="year" size="5" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Challenge*</th>
                        <td>
                            <textarea rows="4" name="challenge" cols="20" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Plan*</th>
                        <td>
                            <textarea rows="4" name="plan" cols="20" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Remark</th>
                        <td>
                            <textarea rows="4" name="remark" cols="20"></textarea>
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
                    <input type="submit" value="submit" style="cursor: pointer; padding: 15px; margin: 10px">
                    <input type="reset" value="Reset" style="cursor:pointer; padding: 15px; margin: 10px">
                </div>
            </form>
        </div>
    </div>
    <p></p>
    <footer>
        <p>Copyright (c) @2023 - Atikah Ramly</p>
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
            document.getElementById("myForm").reset();
        }

        function show_AddEntry() {
            var x = document.getElementById("challengeDiv");
            x.style.display = 'block';
            var x = document.getElementById("search_challenge");
            x.style.display = 'none';
            var x = document.getElementById("add_challenge");
            x.style.display = 'none';
            var firstField = document.getElementById('sem');
            firstField.focus();
        }
    </script>
</body>

</html>
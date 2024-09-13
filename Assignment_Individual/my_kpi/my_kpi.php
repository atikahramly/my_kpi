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
        #edit_KPI {
            display: none;
            margin-top: 50px;
            width: 100%;
            text-align: center;
            justify-content: center;
            align-items: center;
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
        include('cgpa.php');
        include('kpi_activity.php');
        include('kpi.php');
    } else {
        //include 'menu.php';
        header("location:index.php");
    }
    ?>

    <main>
        <h2> My KPI Indicators</h2>
        <div>
            <table class="allTable" border="1" width="100%">
                <div
                    style="text-align: right; padding-top:10px; justify-content: end; display: flex; flex-direction: row; margin-right: 10px;">
                    <input style="text-align: right; padding: 10px; margin-bottom: 10px;" type="button" value="Edit"
                        onclick="showEdit()">
                </div>
                <tr>
                    <th>No</th>
                    <th>Indicator</th>
                    <th>Faculty KPI</th>
                    <th>My KPI</th>
                    <th>Sem 1 Year 1</th>
                    <th>Sem 2 Year 1</th>
                    <th>Sem 1 Year 2</th>
                    <th>Sem 2 Year 2</th>
                    <th>Sem 1 Year 3</th>
                    <th>Sem 2 Year 3</th>
                    <th>Sem 1 Year 4</th>
                    <th>Sem 2 Year 4</th>
                </tr>
                <tr>
                    <td align="center">1</td>
                    <td>CGPA</td>
                    <td align="center">>3.00</td>
                    <td>
                        <?= $cgpa_myself ?? '' ?>
                    </td>
                    <td>
                        <?= $sem1year1 ?? '' ?>
                    </td>
                    <td>
                        <?= $sem2year1 ?? '' ?>
                    </td>
                    <td>
                        <?= $sem1year2 ?? '' ?>
                    </td>
                    <td>
                        <?= $sem2year2 ?? '' ?>
                    </td>
                    <td>
                        <?= $sem1year3 ?? '' ?>
                    </td>
                    <td>
                        <?= $sem2year3 ?? '' ?>
                    </td>
                    <td>
                        <?= $sem1year4 ?? '' ?>
                    </td>
                    <td>
                        <?= $sem2year4 ?? '' ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" rowspan="5" style="border-bottom-left-radius: 20px;">2</td>
                    <th align="center" colspan="12">Student Activity</th> <!-- The colspan usage -->
                </tr>
                <tr>
                    <td>Faculty</td>
                    <td>4</td>
                    <td>
                        <?= $faculty ?? '' ?>
                    </td>
                    <?php activity('Faculty', $conn) ?>
                </tr>
                <tr>
                    <td>University</td>
                    <td>4</td>
                    <td>
                        <?= $university ?? '' ?>
                    </td>
                    <?php activity('University', $conn) ?>
                </tr>
                <tr>
                    <td>National</td>
                    <td>1</td>
                    <td>
                        <?= $national ?? '' ?>
                    </td>
                    <?php activity('National', $conn) ?>
                </tr>
                <tr>
                    <td>International</td>
                    <td>1</td>
                    <td>
                        <?= $international ?? '' ?>
                    </td>
                    <?php activity('International', $conn) ?>
                </tr>
            </table>
        </div>

        <div id="edit_KPI">
            <div>
                <h2>Edit your Kpi indicator</h2>
                <form action="kpi_action.php" method="POST" id="kpi">
                    <table class="allTable" style="width: 400px;">
                        <tr>
                            <th>No</th>
                            <th>Indicator</th>
                            <th style="width: 90px;">My KPI</th>
                        </tr>
                        <tr>
                            <td>No</td>
                            <td>CGPA</td>
                            <td><input type="text" name="cgpa_myself" id="cgpa_myself" size="5"
                                    value="<?= $cgpa_myself ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td align="center" rowspan="5" style="border-bottom-left-radius: 20px;">2</td>
                            <th colspan="3">Student Activity</th>
                        </tr>
                        <tr>
                            <td>Faculty</td>
                            <td><input type="text" name="faculty" id="faculty" size="5" value="<?= $faculty ?? '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>University</td>
                            <td><input type="text" name="university" id="university" size="5"
                                    value="<?= $university ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>National</td>
                            <td><input type="text" name="national" id="national" size="5"
                                    value="<?= $national ?? '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>International</td>
                            <td><input type="text" name="international" id="international" size="5"
                                    value="<?= $international ?? '' ?>"></td>
                        </tr>
                        <tr></tr>
                    </table>
                    <div style="display: flex; justify-content: space-around">
                        <input type="submit" value="Update" style="cursor: pointer; padding: 15px; margin: 10px">
                        <input type="reset" value="Reset" style="cursor:pointer; padding: 15px; margin: 10px">
                    </div>
                </form>
            </div>

            <div>
                <form action="cgpa_action.php" method="POST" id="cgpa">
                    <h2>Edit Or Add Your CGPA</h2>
                    <table class="allTable" style="width: 400px;">
                        <tr>
                            <th>Sem & Year</th>
                            <th>CGPA</th>
                        </tr>
                        <tr>
                            <td>Sem 1 Year 1</td>
                            <td>
                                <input type="text" name="sem1year1" id="sem1year1" size="5"
                                    value="<?= $sem1year1 ?? '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Sem 2 Year 1</td>
                            <td><input type="text" name="sem2year1" id="sem2year1" size="5"
                                    value="<?= $sem2year1 ?? '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Sem 1 Year 2</td>
                            <td><input type="text" name="sem1year2" id="sem1year2" size="5"
                                    value="<?= $sem1year2 ?? '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Sem 2 Year 2</td>
                            <td><input type="text" name="sem2year2" id="sem2year2" size="5"
                                    value="<?= $sem2year2 ?? '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Sem 1 Year 3</td>
                            <td><input type="text" name="sem1year3" id="sem1year3" size="5"
                                    value="<?= $sem1year3 ?? '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Sem 2 Year 3</td>
                            <td><input type="text" name="sem2year3" id="sem2year3" size="5"
                                    value="<?= $sem2year3 ?? '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Sem 1 Year 4</td>
                            <td><input type="text" name="sem1year4" id="sem1year4" size="5"
                                    value="<?= $sem1year4 ?? '' ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Sem 2 Year 4</td>
                            <td><input type="text" name="sem2year4" id="sem2year4" size="5"
                                    value="<?= $sem2year4 ?? '' ?>">
                            </td>
                        </tr>
                        <tr></tr>
                    </table>
                    <div style="display: flex; justify-content: space-around">
                        <input type="submit" value="Update" style="cursor: pointer; padding: 15px; margin: 10px">
                        <input type="reset" value="Reset" style="cursor:pointer; padding: 15px; margin: 10px">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p>Copyright (c) @2023 FCI - Atikah Ramly</p>
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

        function showEdit() {
            var x = document.getElementById("edit_KPI");
            x.style.display = 'block';
            var x = document.getElementById("edit_KPI");
            x.style.display = 'flex';
            x.style.justifyContent = 'space-around';
            var firstField = document.getElementById('CGPA');
            firstField.focus();
        }
    </script>
</body>

</html>
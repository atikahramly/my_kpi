<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/flip-card.css">
    <title>My study KPI</title>
    <script src="https://kit.fontawesome.com/9aa99ba8cc.js" crossorigin="anonymous"></script>
    <style>
        img {
            width: 500px;
            height: auto;
            translate: 40% -70%;
        }

        .announcement {
            width: 70%;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            text-align: center;
            margin: 5px;
        }

        .news {
            width: 70%;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            text-align: center;
            margin: 5px;
        }

        .test {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="banner">
        <div>
            <img src="img/logo.png" alt="kpi_logo">
        </div>
        <div class="flip">
            <div class="flip-inner">
                <div id="login" class="flipping">
                    <form action="user_authentication/login_action.php" method="POST">
                        <label for="username">Matric Number</label>
                        <input type="text" placeholder="Insert Username" id="userName" name="userName" required />

                        <label for="pwd">Password</label>
                        <input type="password" placeholder="Insert Password" id="userPwd" name="userPwd" required />

                        <button type="submit" class="login_btn">Login</button>
                        <label style="display:flex">
                            <input type="checkbox" checked="checked" name="remember">
                            <div style="padding:7px;">
                                Remember me
                            </div>
                        </label>
                        <span class="psw">
                            <a onClick="flip()" style="cursor: pointer;"> Register</a> |
                            <a style="cursor: pointer;">Forgot password?</a>
                        </span>
                    </form>
                </div>

                <div id="registerDiv" class="flipper">
                    <form action="register_action.php" method="post">
                        <h2 style="background-color: white; color: #db4d5f;"> User Registration </h2>
                        <div class="test">
                            <div style="margin: 10px;">
                                <label for="matricNo">Matric No</label>
                                <input type="text" placeholder="Insert Matric No" name="matricNo" id="matricNo"
                                    required>
                            </div>
                            <div style="margin: 10px;">

                                <label for="userEmail">User Email:</label>
                                <input type="email" placeholder="Insert User Email" id="userEmail" name="userEmail"
                                    required>
                            </div>
                        </div>
                        <div class="test">
                            <div style="margin: 10px;">
                                <label for="userPwd">Password:</label>
                                <input type="password" placeholder="Insert Password" id="userPwd" name="userPwd"
                                    required maxlength="15">
                            </div>
                            <div style="margin: 10px;">
                                <label for="userPwd">Confirm Password:</label>
                                <input type="password" placeholder="Confirm Password" id="confirmPwd" name="confirmPwd"
                                    required>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-around;">
                            <input type="submit" value="Register" style="cursor: pointer; padding: 15px; color: white; margin: 10px; background-color: #E21F3D;">
                            <input type="reset" value="Reset" style="color: white; margin: 10px; padding: 15px; background-color: #E21F3D; ">
                            <input type="reset" value="Cancel" style="color: white; margin: 10px; padding: 15px; background-color: #E21F3D;" onClick="flip()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        
    <div class="newsDiv">
        <div class="announcement">
            <h2><b>Announcement</b></h2>
            <h3>PERMOHONAN TRANSKRIP SEMENTARA (PELAJAR PRASISWAZAH)</h3>
            <h3 style="text-align: center; font-size: 10pt;">Updated by : 2023-10-03</h3>
            <br>Assalammualaikum dan Salam Sejahtera,
            <p style="font-size: 12pt">
                Permohonan Transkrip Sementara boleh dibuat melalui SMPB. Sila klik pautan berikut bagi Manual Pengguna
                (Permohonan Peperiksaan Pelajar di SMPB) https://shorturl.at/gxIR3 Sila ambil maklum bahawa,
                Transkrip Sementara hanya akan dikeluarkan kepada pelajar yang TELAH DISAHKAN LAYAK BERGRADUAT.
                Sekiranya
                saudara/i BELUM DISAHKAN LAYAK BERGRADUAT, saudara/i akan diberikan Laporan Umum Keputusan Peperiksaan.
                Laporan Umum Keputusan Peperiksaan tersebut boleh digunakan bagi tujuan tajaan Pendidikan, menyambung
                pengajian dan penempatan Latihan Industri. Sekian dan terima kasih </p>
        </div>
        <br>
        <div class="news">
            <h2><b>News</b></h2>
            <h3>SEMAKAN BERGRADUAT FASA 3</h3>
            <h3 style="text-align: center; font-size: 10pt">Updated by 2023-11-17</h3>
            <p style="font-size: 12pt">
                Dimaklumkan bahawa status pelajar yang telah disahkan layak bergraduat (Fasa 3) telah dikemaskini.
                Sehubungan itu, pelajar boleh menyemak status bergraduat masing-masing dan seterusnya mencetak surat
                tamat
                pengajian dalam SMPB dibawah menu Konvokesyen (Semakan Bergraduat pelajar).
                <br><br><b>PIHAK BPA MENGUCAPKAN SETINGGI-TINGGI TAHNIAH KEPADA SEMUA PELAJAR YANG BERJAYA TAMAT
                    PENGAJIAN DAN
                    LAYAK BERGRADUAT PADA TAHUN INI. </b>
            </p>
        </div>
    </div>
</body>

<script>
    function flip() {
        document.querySelector('.flip').classList.toggle('is-flipped');
    }
</script>

</html>
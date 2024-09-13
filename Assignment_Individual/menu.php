<?php
define('BASE_URL', '/Assignment_Individual');

echo
    '<nav class="navbar" id="myTopnav">
    <a href="' . BASE_URL . '/my_profile/profile.php"><i class="fa-solid fa-user"></i> Profile</a>
    <a href="' . BASE_URL . '/my_kpi/my_kpi.php"><i class="fa-solid fa-graduation-cap"></i> KPI Indicator</a>
    <a href="' . BASE_URL . '/my_activities/my_activities.php"><i class="fa-solid fa-medal"></i> Activities</a>
    <a href="' . BASE_URL . '/my_challenge/my_challenge.php"><i class="fa-solid fa-calendar-days"></i> Challenge and Future Plan</a>
    <a href="' . BASE_URL . '/user_authentication/logout.php" class="split" onClick="return confirm(\'Confirm Log Out\');" style="margin-left: 6px;"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
    </nav>';




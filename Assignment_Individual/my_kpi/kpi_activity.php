<?php
function activity($level, $conn)
{
    $sql = "SELECT 
    level,
    MAX(CASE WHEN yearsem = '2021-1' THEN total_activity ELSE '' END) AS year1sem1,
    MAX(CASE WHEN yearsem = '2021-2' THEN total_activity ELSE '' END) AS year1sem2,
    MAX(CASE WHEN yearsem = '2022-1' THEN total_activity ELSE '' END) AS year2sem1,
    MAX(CASE WHEN yearsem = '2022-2' THEN total_activity ELSE '' END) AS year2sem2,
    MAX(CASE WHEN yearsem = '2023-1' THEN total_activity ELSE '' END) AS year3sem1,
    MAX(CASE WHEN yearsem = '2023-2' THEN total_activity ELSE '' END) AS year3sem2,
    MAX(CASE WHEN yearsem = '2024-1' THEN total_activity ELSE '' END) AS year4sem1,
    MAX(CASE WHEN yearsem = '2024-2' THEN total_activity ELSE '' END) AS year4sem2
FROM (
    SELECT
        level,
        CONCAT(`year`, '-', sem) AS yearsem,
        COUNT(activity) AS total_activity,
        CASE level
            WHEN 'Faculty' THEN 1
            WHEN 'University' THEN 2
            WHEN 'National' THEN 3
            WHEN 'International' THEN 4
        END AS level_order
    FROM activities
    WHERE userID = " . $_SESSION["UID"] . "
    GROUP BY level, yearsem
) AS subquery
GROUP BY level
ORDER BY level_order;";

    $year1sem1 = "";
    $year1sem2 = "";
    $year2sem1 = "";
    $year2sem2 = "";
    $year3sem1 = "";
    $year3sem2 = "";
    $year4sem1 = "";
    $year4sem2 = "";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["level"] == $level) {
                $year1sem1 = $row["year1sem1"];
                $year1sem2 = $row["year1sem2"];
                $year2sem1 = $row["year2sem1"];
                $year2sem2 = $row["year2sem2"];
                $year3sem1 = $row["year3sem1"];
                $year3sem2 = $row["year3sem2"];
                $year4sem1 = $row["year4sem1"];
                $year4sem2 = $row["year4sem2"];
            }
        }
    }

    echo "<td>" . $year1sem1 . "</td>";
    echo "<td>" . $year1sem2 . "</td>";
    echo "<td>" . $year2sem1 . "</td>";
    echo "<td>" . $year2sem2 . "</td>";
    echo "<td>" . $year3sem1 . "</td>";
    echo "<td>" . $year3sem2 . "</td>";
    echo "<td>" . $year4sem1 . "</td>";
    echo "<td>" . $year4sem2 . "</td>";
}

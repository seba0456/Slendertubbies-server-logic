<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Player profile</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../profile_styles.css">
    <?php
    //Drawing pictures
    $backgroundImageName = array("29Smz1D.png", "349btA5.png", "7t0DKbv.png", "9cVLGpd.png", "auZ6qOk.png", "eDU9st7.png", "FsbPUEH.png", "Vpv0Xt1.png", "X5pM5BN.png");
    $backgroundImagePath = "../images/st_screenshots/" . $backgroundImageName[array_rand($backgroundImageName)];
    echo ("<style>");
    echo ("body {");
    echo ("background-image: url('$backgroundImagePath');");
    echo ("}");
    echo ("</style>");
    ?>
</head>

</html>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

function getDatabaseConfig()
{
    $configFilePath = '/home/SlendertubbiesDB_Data/config.ini';
    return parse_ini_file($configFilePath, true)['database'];
}
$publicID = $_GET['publicID'];
$dbConfig = getDatabaseConfig();
$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT PlayerName, RegistrationDate, CollectedCustards, CatchedSurvivors, StartedSP_Games, FinishedSP_Games, HostedMP_Games, JoinedMP_Games, FinishedMP_Games, LastActive, bUsedEpic, bPublicProfile FROM playerdata WHERE publicID = ?";

$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $publicID);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->bind_result(
    $PlayerName,
    $RegistrationDate,
    $CollectedCustards,
    $CatchedSurvivors,
    $StartedSP_Games,
    $FinishedSP_Games,
    $HostedMP_Games,
    $JoinedMP_Games,
    $FinishedMP_Games,
    $LastActive,
    $bUsedEpic,
    $bPublicProfile
);
if ($stmt->fetch() && $bPublicProfile === 1) {
    $stmt->close();
    $conn->close();

    echo '<div class="paper">';
    echo '    <h1>' . $PlayerName . '</h1>';
    echo '    <div class="table-container">';
    echo '        <table>';
    echo '            <tr>';
    echo '                <th>Stat</th>';
    echo '                <th>Value</th>';
    echo '            </tr>';
    echo '            <tr>';
    echo '                <td>Registration date </td>';
    echo '                <td>' . $RegistrationDate . '</td>';
    echo '            </tr>';
    echo '            <tr>';
    echo '                <td>Collected custards</td>';
    echo '                <td>' . $CollectedCustards . '</td>';
    echo '            </tr>';
    echo '            <tr>';
    echo '                <td>Catched survivours</td>';
    echo '                <td>' . $CatchedSurvivors . '</td>';
    echo '            </tr>';
    echo '            <tr>';
    echo '                <td>Started solo games</td>';
    echo '                <td>' . $StartedSP_Games . '</td>';
    echo '            </tr>';
    echo '            <tr>';
    echo '                <td>Finished solo games</td>';
    echo '                <td>' . $FinishedSP_Games . '</td>';
    echo '            </tr>';
    echo '            <tr>';
    echo '                <td>Hosted online games</td>';
    echo '                <td>' . $HostedMP_Games . '</td>';
    echo '            </tr>';
    echo '            <tr>';
    echo '                <td>Joined online games</td>';
    echo '                <td>' . $JoinedMP_Games . '</td>';
    echo '            </tr>';
    echo '            <tr>';
    echo '                <td>Finished online games</td>';
    echo '                <td>' . $FinishedMP_Games . '</td>';
    echo '            </tr>';
    echo '            <tr>';
    echo '                <td>Last active</td>';
    // Convert date to timestamp (timestamp)
    $lastActiveTimestamp = strtotime($LastActive);
    $currentTimestamp = time();

    // Calculate time differe
    $timeDifferenceInSeconds = $currentTimestamp - $lastActiveTimestamp;
    // Konwertuj różnicę czasu na dni, godziny, minuty i sekundy
    $days = floor($timeDifferenceInSeconds / (60 * 60 * 24));
    $hours = floor(($timeDifferenceInSeconds % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($timeDifferenceInSeconds % (60 * 60)) / 60);
    $seconds = $timeDifferenceInSeconds % 60;
    $message = ($minutes < 3) ? '<td style="color: green;"> Now </td>' : '<td>' . $days . ' D ' . $hours . ' Hr ' . $minutes . ' Min ago</td>';
    echo $message;
    echo '</tr>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '<script>';
    echo 'document.title = "Player Profile - ' . $PlayerName . '";'; //Changing website title
    echo '</script>';
} else {
    $stmt->close();
    $conn->close();
    header("HTTP/1.0 404 Not Found");
    echo '<div class="error">';
    echo '<h1>404 Not Found - Player ID is invalid or profile is hidden!</h1>';
    echo '</div>';
    exit();
}
?>
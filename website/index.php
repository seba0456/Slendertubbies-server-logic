<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Slendertubbies is a fan-made game by seba0456 and community, inspired by the popular Slendytubbies game. Dive into the Slendertubbies world, explore 10 maps, and avoid 7 unique Slendertubbies. Choose between Collect or Versus mode, and play solo or with friends.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slendertubbies</title>
    <link rel="stylesheet" type="text/css" href="home_style.css" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VLETTZ5RXJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-VLETTZ5RXJ');
    </script>
</head>

<body>
    <div class="background">
        <img class="game_logo" src="images/newlogo.png" alt="Game Logo">
        <p class="slogan"><b>Slendertubbies</b> is a fan-made game made by seba0456 and amazing community, inspired by the popular game Slendytubbies, boasting many new unique features and characters. Immerse yourself in the world of Slendertubbies, exploring <b>10</b> different maps and avoiding <b>7</b> unique Slendertubbies! Choose between Collect or Versus game mode, and play them solo or with your friends. Are you up for the challenge of surviving among Slendertubbies? <br><br>Download the game now and join the incredible adventure!</p>
        <div class="buttons">
            <div class="dropdown">
                <button class="dropbtn"><img class="win_logo" src="images/win_logo.png">Download</button>
                <div class="dropdown-content">
                    <a href="https://seba0456.itch.io/slendertubbies">Download from Itch.io</a>
                    <a href="launcher/builds/st_setup.exe">Download Slendertubbies</a>
                    <a href="launcher/builds/Slendertubbies.zip">Download Standalone version</a>
                    <a href="https://gamejolt.com/games/slendertubbies/795418">Download from Gamejolt</a>

                </div>
                <br>
            </div>
            <script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script>
            <script type='text/javascript'>
                kofiwidget2.init('Support Me on Ko-fi', '#8B0000', 'O4O6U2OB7');
                kofiwidget2.draw();
            </script>

        </div>
        <div class="stats">

            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            function getDatabaseConfig()
            {
                $configFilePath = '/home/SlendertubbiesDB_Data/config.ini';
                return parse_ini_file($configFilePath, true)['database'];
            }

            function getCollectedCustards()
            {
                // Get database config
                $dbConfig = getDatabaseConfig();
                $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

                // Test conn
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT SUM(CollectedCustards) AS TotalCollectedCustards FROM playerdata;";

                $result = $conn->query($sql);

                if ($result) {
                    // Get querry result
                    $row = $result->fetch_assoc();


                    $conn->close();

                    // Return num of collected custards
                    return $row['TotalCollectedCustards'];
                } else {
                    return "Error: " . $conn->error;
                }
            }
            function getRegistredPlayers()
            {
                // Get database config
                $dbConfig = getDatabaseConfig();
                $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

                // Test conn
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }


                $sql = "SELECT COUNT(*) AS TotalRows FROM playerdata WHERE PlayerName != 'Player' AND PlayerName IS NOT NULL AND GameVersion IS NOT NULL;";

                $result = $conn->query($sql);

                if ($result) {
                    $row = $result->fetch_assoc();
                    $conn->close();
                    return $row['TotalRows'];
                } else {
                    return "Error: " . $conn->error;
                }
            }
            echo ("<p>" . getRegistredPlayers() . " players have collected " . getCollectedCustards() . " custards since 18th August 2023.</p>");
            ?>
        </div>
        <div class="footer">
            <div class="footer-left">
                <a href="https://discord.com/invite/9d6RBrhqtg">Discord</a> |
                <a href="privacy_policy.html">Privacy Policy</a> |
                <a href="terms_and_conditions.html">Terms and conditions</a> |
                <a href="attribution.php">Authors</a>
            </div>
            <p class="footer-right">Made by seba0456 and the Community</p>
        </div>

    </div>

</body>

</html>
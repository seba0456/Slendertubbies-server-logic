<html>

<head>
    <title>Contributors and attributions to the
        Slendertubbies</title>
    <link rel="stylesheet" type="text/css" href="home_style.css" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="attribution_style.css" />
</head>

<body>
    <img class="game_logo" src="images/newlogo.png" alt="Game Logo">
    <pp class='slogan'>The development journey of Slendertubbies has been an extensive and rewarding experience. Over the past three years, the game has undergone significant expansion. However, it's crucial to note that Slendertubbies is not the result of a solo effort; I received support from the gaming community and assistance from third-party asset sources such as freesound.org and sketchfab.com. Additionally, this game would not have been possible without the Unreal Engine, Megascans, EOS, and the Unreal Marketplace.
        In this article, I would like to express my sincere gratitude to everyone whose amazing efforts have contributed to the development of Slendertubbies. This project has been a collaborative endeavor, and I want to extend my thanks to the individuals who have played a vital role in its evolution. Moreover, I would like to acknowledge and thank those to whom I am indebted due to licensing obligations.

        <br>Thank you all for being a part of this incredible journey!
        <?php
        // Function to retrieve database configuration
        function getDatabaseConfig()
        {
            $configFilePath = '/home/SlendertubbiesDB_Data/config.ini';
            return parse_ini_file($configFilePath, true)['database'];
        }

        // Function to generate list items
        function textBetweenLi($text)
        {
            echo ("<li>" . $text . "</li>");
        }

        // Function to convert license name to link
        function licenseNameToLink($license)
        {
            switch ($license) {
                case 'CC BY 4.0 DEED':
                    return "https://creativecommons.org/licenses/by/4.0/";
                case 'CC BY-NC 4.0 DEED':
                    return "https://creativecommons.org/licenses/by-nc/4.0/";
                case 'CC0 1.0 DEED';
                    return "https://creativecommons.org/publicdomain/zero/1.0/";
                case 'CC BY-NC 3.0 DEED';
                    return "https://creativecommons.org/licenses/by-nc/3.0/";
                case 'CC BY 3.0 DEED';
                    return "https://creativecommons.org/licenses/by/3.0/";
                default:
                    // Handle default case
                    return "";
            }
        }

        // Function to retrieve contributors by type
        function getContributorsByType($type)
        {
            $dbConfig = getDatabaseConfig();
            $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = "SELECT * FROM attributions WHERE AssetType = $type ORDER BY Author DESC";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo ("<ul>");
                while ($row = $result->fetch_assoc()) {
                    echo ('<li><a href="' . $row['AssetLink'] . '" target="_blank" class="links">' . $row['AssetName'] . "</a> by " . $row["Author"] . "<br> LICENSED UNDER " . '<a href="' . licenseNameToLink($row["LicenseType"]) . '" target="_blank" class="links">' . $row["LicenseType"] . "</a></li>");
                }
                echo ("</ul>");
            } else {
                // Handle query error if necessary
                echo "Error executing query: " . mysqli_error($conn);
            }
        }

        // Output contributors
        echo ("<h1>CONTRIBUTORS</h1>");
        echo ("<ul>");
        textBetweenLi("seba456 - Main game developer");
        textBetweenLi("<a href='https://www.artstation.com/anderaika' class='links'>Andżelika</a> - Dobby (old Po) model");
        textBetweenLi("Renarder - Slendertubbies models, ideas");
        textBetweenLi("Agente Shuffle - audio, 2D graphic, ideas");
        textBetweenLi("Mephisto - UI design advices");
        textBetweenLi("Beanz - 2D graphic, ideas");
        textBetweenLi("TerrorPug - ideas");
        textBetweenLi("Solebo - ideas");
        textBetweenLi("and others");
        echo ("</ul>");

        // Output attributions by type
        echo ("<h1>ATTRIBUTIONS</h1>");
        echo ("<h2>SOUND ATTRIBUTIONS</h2>");
        getContributorsByType("SFX");
        echo ("<h2>3D MODELS ATTRIBUTIONS</h2>");
        getContributorsByType("3D Model");
        echo ("<h2>MUSIC ATTRIBUTIONS</h2>");
        getContributorsByType("Music");

        // Acknowledgment and apology
        echo ("I would also like to sincerely apologize to anyone whose work and support were not mentioned in the above article. There may have been a few significant names or contributions that unintentionally escaped my attention.
    If anyone feels they should be included in the acknowledgments but were not, or if there are additional individuals or resources that should be added to the list, please reach out. I am more than willing to update the acknowledgment list to accurately reflect all essential contributions and support.<br>
    Once again, I apologize for any oversights and lack of clarity. Please feel free to get in touch to provide additional information and updates to the acknowledgment list.");
        ?>

</body>

</html>
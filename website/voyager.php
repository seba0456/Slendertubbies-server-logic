<?php
$validAuthKey = file_get_contents('/home/SlendertubbiesDB_Data/auth_key.txt');
function getDatabaseConfig()
{
    $configFilePath = '/home/SlendertubbiesDB_Data/config.ini';
    return parse_ini_file($configFilePath, true)['database'];
}
function register($playerName)
{
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    while (true) {
        $playerID = bin2hex(random_bytes(8)); //Generate random ID
        $publicID = bin2hex(random_bytes(3));
        $currentTime = gmdate("Y-m-d\TH:i:s");

        $playerID = $conn->real_escape_string($playerID);

        $sql_check_player = "SELECT * FROM playerdata WHERE playerID = '$playerID'";
        $result_check_player = $conn->query($sql_check_player);

        $sql_check_public = "SELECT * FROM playerdata WHERE publicID = '$publicID'";
        $result_check_public = $conn->query($sql_check_public);

        if ($result_check_player->num_rows === 0 && $result_check_public->num_rows === 0) {
            $playerName = $conn->real_escape_string($playerName);
            $sql_insert = "INSERT INTO playerdata (PlayerID, PlayerName, RegistrationDate, PublicID, LastActive) 
                           VALUES ('$playerID', '$playerName', '$currentTime', '$publicID', '$currentTime')";

            if ($conn->query($sql_insert) === true) {
                echo json_encode(array("success" => true, "message" => "Register successful", "PlayerID" => (string) $playerID, "PublicID" => (string) $publicID));
            } else {
                echo json_encode(array("success" => false, "message" => "Error while registering."));
            }
            break; //Repeat until generated ID is unique
        }
    }
    $conn->close();
}


function modifyDataBaseVariable($tableName, $variableName, $operation, $value, $playerID) //Dangerous function, use alternative instead
{
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die(json_encode(array("success" => false, "message" => "Error while connecting to database.")));
    }

    $tableName = strtolower($conn->real_escape_string($tableName));
    $variableName = $conn->real_escape_string($variableName);
    $value = $conn->real_escape_string($value);
    $playerID = $conn->real_escape_string($playerID);

    //Phrase word to mathematic operator
    switch ($operation) {
        case 'add':
            $operationSymbol = '+';
            break;
        case 'subtract':
            $operationSymbol = '-';
            break;
        case 'multiply':
            $operationSymbol = '*';
            break;
        case 'divide':
            $operationSymbol = '/';
            break;
        default:
            $conn->close();
            echo json_encode(array("success" => false, "message" => "Ivalid operation."));
            return;
    }

    // Create SQL querry with valid mathematic operator
    $sql_update = "UPDATE $tableName SET $variableName = $variableName $operationSymbol $value WHERE playerID = '$playerID'";

    if ($conn->query($sql_update) === true) {
        echo json_encode(array("success" => true, "message" => "Variable updated"));
    } else {
        echo json_encode(array("success" => false, "message" => "Error while updating variable."));
    }
    $conn->close();
}


// Implementacja funkcji overwriteDataBaseVariable
function overwriteDataBaseVariable($tableName, $variableName, $newValue, $playerID)
{
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die("Nieudane połączenie: " . $conn->connect_error);
    }

    $tableName = $conn->real_escape_string($tableName);
    $variableName = $conn->real_escape_string($variableName);
    $newValue = $conn->real_escape_string($newValue);
    $playerID = $conn->real_escape_string($playerID);
    //Construct valid SQL querry for valid table. If should compare table name instead variable. But it works :D
    if ($variableName === "bFinished") {
        $sql_update = "UPDATE $tableName SET $variableName = '$newValue' WHERE matchID = '$playerID'";
    } else {
        $sql_update = "UPDATE $tableName SET $variableName = '$newValue' WHERE playerID = '$playerID'";
    }

    if ($conn->query($sql_update) === true) {
        echo json_encode(array("success" => true, "message" => "Variable has been updated!"));
    } else {
        echo json_encode(array("success" => false, "message" => "Błąd podczas aktualizacji zmiennej: " . $conn->error));
    }

    $conn->close();
}

function getDetailedPlayerData($playerID)
{
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM playerdata WHERE playerID = ?";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $playerID);

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $playerData = array(
            "PlayerID" => $playerID,
            "PublicID" => $row['PublicID'],
            "PlayerName" => $row['PlayerName'],
            "RegistrationDate" => $row['RegistrationDate'],
            "CollectedCustards" => $row['CollectedCustards'],
            "CatchedSurvivors" => $row['CatchedSurvivors'],
            "StartedSP_Games" => $row['StartedSP_Games'],
            "FinishedSP_Games" => $row['FinishedSP_Games'],
            "HostedMP_Games" => $row['HostedMP_Games'],
            "JoinedMP_Games" => $row['JoinedMP_Games'],
            "FinishedMP_Games" => $row['FinishedMP_Games'],
            "LastActive" => $row['LastActive'],
            "bUsedEpic" => (bool) $row['bUsedEpic'] ? true : false,
            "bPublicProfile" => (bool) $row['bPublicProfile'] ? true : false,
            "Score" => $row['Score']
        );
        $stmt->close();
        $conn->close();
        return json_encode($playerData);
    } else {
        $stmt->close();
        $conn->close();
        return json_encode(array("success" => false, "message" => "Player ID is invalid!"));
    }
}
function registerMatch($playerID, $roomName, $gameMode, $mapName, $custardAmount, $bSelectTubby, $bBattery, $bFullTubby, $bMultiplayer, $maxPlayers)
{
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check is player valid
    $query = "SELECT * FROM playerdata WHERE playerID = '$playerID'";
    $result = $conn->query($query);

    if ($result->num_rows === 0) {
        echo json_encode(array("success" => false, "message" => "Player ID is invalid!"));
        return;
    }

    while (true) {
        $matchID = bin2hex(random_bytes(3));
        $currentTime = gmdate("Y-m-d\TH:i:s");

        $matchID = $conn->real_escape_string($matchID); // Secure matchID from SQL Injection

        $sql_check_match = "SELECT * FROM startedgames WHERE MatchID = '$matchID'";
        $result_check_match = $conn->query($sql_check_match);

        if ($result_check_match->num_rows === 0) { //Check if generated matchID is valid
            $roomName = $conn->real_escape_string($roomName);
            $gameMode = $conn->real_escape_string($gameMode);
            $mapName = $conn->real_escape_string($mapName);
            $custardAmount = (int) $custardAmount;
            $bSelectTubby = (int) $bSelectTubby;
            $bBattery = (int) $bBattery;
            $bFullTubby = (int) $bFullTubby;
            $bMultiplayer = (int) $bMultiplayer;
            $maxPlayers = (int) $maxPlayers;
            $sql_insert_match = "INSERT INTO startedgames (MatchID, RoomName, GameMode, MapName, CustardAmount, bSelectTubby, bBattery, bFullTubby, bMultiplayer, MaxPlayers, HostedBy, CreateTime) 
                                 VALUES ('$matchID', '$roomName', '$gameMode', '$mapName', $custardAmount, $bSelectTubby, $bBattery, $bFullTubby, $bMultiplayer, $maxPlayers, '$playerID', '$currentTime')";

            if ($conn->query($sql_insert_match) === true) {
                // Instead of echoing, return the response as an array
                return array("success" => true, "message" => "Match registered successfully", "matchID" => (string) $matchID);
            } else {
                return array("success" => false, "message" => "Error while registering match.");
            }
            break;
        }
    }

    $conn->close();
}

function listPlayerIDs()
{
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $selectQuery = "SELECT PlayerID FROM playerdata";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "PlayerID: " . $row["PlayerID"] . "<br>";
        }
    } else {
        echo "No player IDs found.";
    }

    $conn->close();
}
function getLatestGameVersion()
{
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $selectQuery = "SELECT Version FROM gameversion ORDER BY ID DESC";
    $result = $conn->query($selectQuery);
    if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    return array("success" => true, "message" => "Match registered successfully", "gameVersion" => (string) $row['Version']);
    }
    else{
        return array("success" => false, "message" => "Something went wrong - no results");
    }

}
function getScoreSystem()
{
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $selectQuery = "SELECT ActionID, ScoreReward FROM scoresystem";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        // Get scoring data
        $scoreSystem = [];
        while ($row = $result->fetch_assoc()) {
            $scoreSystem[$row['ActionID']] = $row['ScoreReward'];
        }
        $conn->close();
        return $scoreSystem;
    } else {
        // Handle no data
        $conn->close();
        return [];
    }
}
function addScoreToPlayer($playerID, $actionID)
{
    $scoreSystem = getScoreSystem();
    $scorePrize = $scoreSystem[$actionID];

    // Assuming getDatabaseConfig() returns an associative array of database configuration
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $selectQuery = "SELECT Score FROM playerdata WHERE playerID = '$playerID'";

    // Execute the SELECT query
    $result = $conn->query($selectQuery);

    if ($result) {
        // Check if the player exists
        if ($result->num_rows > 0) {
            // Fetch the current score
            $row = $result->fetch_assoc();
            $currentScore = $row['Score'];

            // Calculate the new score
            $newScore = $currentScore + $scorePrize;

            // Use prepared statement to update the player's score in the database
            $stmt = $conn->prepare("UPDATE playerdata SET Score = ? WHERE playerID = ?");
            $stmt->bind_param("is", $newScore, $playerID); // Assuming Score is an integer
            $stmt->execute();
            $stmt->close();

            return array("success" => true, "message" => "Granting score successful", "oldScore" => (int) $currentScore, "newScore" => (int) $newScore);
        } else {
            echo json_encode(array("success" => false, "message" => "Granting score unsuccessful"));
        }

        // Free the result set
        $result->free();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
function addSpeedRunRecord($playerID, $timeTaken, $matchID)
{
    $dbConfig = getDatabaseConfig();
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Check if player is valid
    $query = "SELECT * FROM playerdata WHERE playerID = '$playerID'";
    $result = $conn->query($query);

    if ($result->num_rows === 0) {
        echo json_encode(array("success" => false, "message" => "Player ID is invalid!"));
        return;
    }
    addScoreToPlayer($playerID, "LevelAction_5");
    while (true) {
        $matchID = bin2hex(random_bytes(3));
        $matchID = $conn->real_escape_string($matchID); // Zabezpiecz matchID przed SQL Injection
        $sql_check_match = "SELECT * FROM startedgames WHERE MatchID = '$matchID'";
        $result_check_match = $conn->query($sql_check_match);

        if ($result_check_match->num_rows === 0) {
            $sql_insert_match = "INSERT INTO SpeedRuns (matchID, PlayerID, TimeTaken) 
                                 VALUES ('$matchID', '$playerID', '$timeTaken')";

            if ($conn->query($sql_insert_match) === true) {
                // Instead of echoing, return the response as an array
                return array("success" => true, "message" => "Speedrun Match registered successfully", "matchID" => (string) $matchID);
            } else {
                return array("success" => false, "message" => "Error while registering match.");
            }
            break;
        }
    }

    $conn->close();
}

// Reciving GET data

if (isset($_GET['authKey'])) {
    $providedAuthKey = $_GET['authKey'];
    // Check the validity of the authorization key
    if ($providedAuthKey === $validAuthKey) {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            if ($action === 'register' && isset($_GET['playerName'])) {
                $playerName = $_GET['playerName'];
                register($playerName);
            } elseif ($action === 'modify' && isset($_GET['tableName']) && isset($_GET['variableName']) && isset($_GET['operation']) && isset($_GET['value']) && isset($_GET['playerID'])) {
                $tableName = $_GET['tableName'];
                $variableName = $_GET['variableName'];
                $operation = $_GET['operation']; // 'add', 'subtract', 'multiply', 'divide'
                $value = $_GET['value'];
                $playerID = $_GET['playerID'];

                modifyDataBaseVariable($tableName, $variableName, $operation, $value, $playerID);
            } elseif ($action === 'overwriting' && isset($_GET['tableName']) && isset($_GET['variableName']) && isset($_GET['newValue']) && isset($_GET['playerID'])) {
                $tableName = $_GET['tableName'];
                $variableName = $_GET['variableName'];
                $newValue = $_GET['newValue'];
                $playerID = $_GET['playerID'];

                overwriteDataBaseVariable($tableName, $variableName, $newValue, $playerID);
            } elseif ($action === 'getDetailedPlayerData' && isset($_GET['playerID'])) {
                $playerID = $_GET['playerID'];
                $getDetailedPlayerData_resoult = getDetailedPlayerData($playerID);
                echo $getDetailedPlayerData_resoult;
            } elseif ($action === 'registerMatch') {
                $requiredParams = array('playerID', 'roomName', 'gameMode', 'mapName', 'custardAmount', 'bSelectTubby', 'bBattery', 'bFullTubby', 'bMultiplayer', 'maxPlayers');
                $missingParams = array();

                foreach ($requiredParams as $param) {
                    if (!isset($_GET[$param])) {
                        $missingParams[] = $param;
                    }
                }

                if (count($missingParams) === 0) {
                    $playerID = $_GET['playerID'];
                    $roomName = $_GET['roomName'];
                    $gameMode = $_GET['gameMode'];
                    $mapName = $_GET['mapName'];
                    $custardAmount = $_GET['custardAmount'];
                    $bSelectTubby = $_GET['bSelectTubby'];
                    $bBattery = $_GET['bBattery'];
                    $bFullTubby = $_GET['bFullTubby'];
                    $bMultiplayer = $_GET['bMultiplayer'];
                    $maxPlayers = $_GET['maxPlayers'];

                    // Tutaj możesz umieścić kod, który przetwarza te dane, np. wywołując funkcję registerMatch
                    // Capture the response from the registerMatch function
                    $registerMatchResponse = registerMatch($playerID, $roomName, $gameMode, $mapName, $custardAmount, $bSelectTubby, $bBattery, $bFullTubby, $bMultiplayer, $maxPlayers);

                    // Capture the response from the addScoreToPlayer function
                    $addScoreResponse = addScoreToPlayer($playerID, 'LevelAction_0');

                    // Combine the responses into a single array
                    $combinedResponse = array_merge($registerMatchResponse, $addScoreResponse);

                    // Encode the combined response as JSON and echo it
                    echo json_encode($combinedResponse);
                } else {
                    $missingParamsMessage = "Missing parameters: " . implode(', ', $missingParams);
                    echo json_encode(array("success" => false, "message" => $missingParamsMessage));
                }
            } elseif ($action === 'addScore' && isset($_GET['playerID']) && isset($_GET['actionID'])) {
                $playerID = $_GET['playerID'];
                $actionID = $_GET['actionID'];
                $addScoreResponse = addScoreToPlayer($playerID, $actionID);
                echo json_encode($addScoreResponse);
            } elseif ($action === 'addSpeedrunRecord' && isset($_GET['playerID']) && isset($_GET['timeTaken']) && isset($_GET['matchID'])) {
                $playerID = $_GET['playerID'];
                $timeTaken = $_GET['timeTaken'];
                $matchID = $_GET['matchID'];
                $result = addSpeedRunRecord($playerID, $timeTaken, $matchID);
                echo json_encode($result);
            } else {
                echo json_encode(array("success" => false, "message" => "Invalid action."));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Missing action parameter."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Invalid authorization key."));
    }
    //Public avaliable data
} else {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $resoultString = "";
        if ($action === 'getVersion') {
            // Process getVersion action without requiring an authorization key
           echo  json_encode(getLatestGameVersion());
        } else if ($action === 'getTopPlayers') {
            $dbConfig = getDatabaseConfig();
            $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $selectQuery = "SELECT PublicID, PlayerName, Score FROM playerdata WHERE bPublicProfile = 1 AND bDeveloperProfile = 0 AND PlayerName NOT LIKE '%nigger%' ORDER BY Score DESC LIMIT 10";
            $result = $conn->query($selectQuery);

            if ($result->num_rows > 0) {
                $resultString = "";

                // Fetch and build the result string
                while ($row = $result->fetch_assoc()) {
                    $id = $row['PublicID'];
                    $nick = $row['PlayerName'];
                    $score = $row['Score'];

                    $resultString .= "($id,$nick,$score),";
                }

                // Remove the trailing comma and space
                $resultString = rtrim($resultString, ",");

                // Echo the final result
                echo json_encode(array("success" => true, "topPlayers" => $resultString));
            } else {
                echo json_encode(array("success" => false, "message" => "No records found"));
            }

            $conn->close();
        } else if ($action === 'bestTime') {
            $dbConfig = getDatabaseConfig();
            $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $selectQuery = "SELECT TimeTaken FROM SpeedRuns ORDER BY TimeTaken Asc LIMIT 1";
            $result = $conn->query($selectQuery);

            if ($result->num_rows > 0) {
                $resultString = "";

                // Fetch and build the result string
                while ($row = $result->fetch_assoc()) {
                    $score = $row['TimeTaken'];
                }

                // Remove the trailing comma and space
                $resultString = rtrim($resultString, ",");

                // Echo the final result
                echo json_encode(array("success" => true, "bestTime" => $score));
            } else {
                echo json_encode(array("success" => false, "message" => "No records found"));
            }

            $conn->close();
        } else {
            echo json_encode(array("success" => false, "message" => "Invalid action."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Missing action parameter."));
    }
}

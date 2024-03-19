-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: slendertubbies
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `SpeedRuns`
--

DROP TABLE IF EXISTS `SpeedRuns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SpeedRuns` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `PlayerID` varchar(255) NOT NULL,
  `TimeTaken` int NOT NULL,
  `matchID` varchar(16) NOT NULL,
  `TimeCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SpeedRuns`
--

LOCK TABLES `SpeedRuns` WRITE;
/*!40000 ALTER TABLE `SpeedRuns` DISABLE KEYS */;
INSERT INTO `SpeedRuns` VALUES (7,'0be1a71bf45b0378',168509,'75dc27','2024-03-08 20:40:43'),(8,'a68218f553cc1883',174320,'c38637','2024-03-14 14:11:58');
/*!40000 ALTER TABLE `SpeedRuns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attributions`
--

DROP TABLE IF EXISTS `attributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attributions` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AssetName` text NOT NULL,
  `AssetLink` text NOT NULL,
  `Author` text NOT NULL,
  `AssetType` enum('3D model','Music','SFX','Others') NOT NULL,
  `LicenseType` enum('CC BY 4.0 DEED','CC BY-NC 4.0 DEED','CC0 1.0 DEED','CC BY-NC 3.0 DEED','CC BY 3.0 DEED') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attributions`
--

LOCK TABLES `attributions` WRITE;
/*!40000 ALTER TABLE `attributions` DISABLE KEYS */;
INSERT INTO `attributions` VALUES (1,'Christmas Hat','https://sketchfab.com/3d-models/christmas-hat-b44d66b16ba543c9825af6f95bd3d678','Shedmon','3D model','CC BY 4.0 DEED'),(2,'Enter the Party','https://incompetech.com/music/royalty-free/index.html?isrc=USUAN1100240','Kevin MacLeod','Music','CC BY 4.0 DEED'),(3,'Rusty Metal Cabinett.','https://sketchfab.com/3d-models/rusty-metal-cabinett-9d2d9415a7f7488e9da4b33d4ba3556d','Sam','3D model','CC BY 4.0 DEED'),(4,'70s Tape Recorder','https://sketchfab.com/3d-models/70s-tape-recorder-b03cbb7090da4f8f8cd0b3e6d602117c','3DKoraX','3D model','CC BY 4.0 DEED'),(5,'Old Car Wreck','https://sketchfab.com/3d-models/old-car-wreck-348320b8009f454492c5b5b95b81aa3e','Renafox','3D model','CC BY-NC 4.0 DEED'),(6,'Security Camera','https://sketchfab.com/3d-models/security-camera-7da2489681d749fda57ffdf1db9f0419','Bryan','3D model','CC BY 4.0 DEED'),(7,'Flashlight','https://sketchfab.com/3d-models/flashlight-00b80a4db92b4bfa9faf220861baacda','Monolag','3D model','CC BY 4.0 DEED'),(8,'horror kids 03 ambience 175296.wav','https://freesound.org/people/klankbeeld/sounds/377090/','klankbeeld','SFX','CC BY 4.0 DEED'),(9,'Dark Cave Factory Atmo.wav','https://freesound.org/people/szegvari/sounds/583474/','szegvari','SFX','CC0 1.0 DEED'),(10,'Crystal Cave.wav','https://freesound.org/people/Zeraora/sounds/434736/','\r\nZeraora','SFX','CC0 1.0 DEED'),(11,'HorrorCaveAmbience.mp3','https://freesound.org/people/shelbyshark/sounds/512513/','shelbyshark','SFX','CC0 1.0 DEED'),(12,'Temple Cave Myts Storm','https://freesound.org/people/szegvari/sounds/540836/','szegvari','SFX','CC0 1.0 DEED'),(13,'Dark Cave Horns Fantasy Creatures War Thriller Scary Atmo Ambience Atmosphere Surround.wav','https://freesound.org/people/szegvari/sounds/609422/','szegvari','SFX','CC0 1.0 DEED'),(14,'Geiger_Tick_Medium.wav','https://freesound.org/people/JustLaz/sounds/616517/','JustLaz','SFX','CC0 1.0 DEED'),(15,'Geiger_Tick_Low.wav','https://freesound.org/people/JustLaz/sounds/616516/','JustLaz','SFX','CC0 1.0 DEED'),(16,'girly giggle.mp3','https://freesound.org/people/AlucardsBride/sounds/179671/','AlucardsBride','SFX','CC0 1.0 DEED'),(17,'Electronic Growl.ogg','https://freesound.org/people/dragonboi50120/sounds/632436/','dragonboi50120','SFX','CC0 1.0 DEED'),(18,'tree_creak_04.wav','https://freesound.org/people/Department64/sounds/95262/','Department64','SFX','CC0 1.0 DEED'),(19,'Scary Ambiance 3.wav','https://freesound.org/people/Department64/sounds/95262/','Creeper_Ciller78','SFX','CC BY-NC 3.0 DEED'),(20,'Metallic Groan','https://freesound.org/people/hinchinbrook/sounds/496836/','hinchinbrook','SFX','CC0 1.0 DEED'),(21,'Beware The Monster','https://patrickdearteaga.com/horror-music/','Patrick de Arteaga','Music','CC BY 4.0 DEED'),(22,'Squeaky Jumpscare 2.wav','https://freesound.org/people/Sapisvr/sounds/371708/','Sapisvr','SFX','CC0 1.0 DEED'),(23,'Violin Scare','https://freesound.org/people/SirBedlam/sounds/393824/','SirBedlam','SFX','CC BY 3.0 DEED'),(25,'Female crying.wav','https://freesound.org/people/Luzanne0/sounds/445299/','Luzanne0','SFX','CC BY-NC 3.0 DEED'),(26,'AA Batteries','https://sketchfab.com/3d-models/aa-batteries-6e22bb9e949542bf801e26055987b46a','berzerkey','3D model','CC BY 4.0 DEED'),(27,'DistantExplosionSynthetic.wav','https://freesound.org/people/zimbot/sounds/117097/','zimbot','SFX','CC BY 4.0 DEED'),(28,'Birthday Cake','https://sketchfab.com/3d-models/birthday-cake-29eb6a4e7bf8403fb05cc2495bfc2dd9','Sakthivel G','3D model','CC BY 4.0 DEED');
/*!40000 ALTER TABLE `attributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gameversion`
--

DROP TABLE IF EXISTS `gameversion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gameversion` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Version` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bIsBeta` tinyint NOT NULL DEFAULT '0',
  `Changelog` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gameversion`
--

LOCK TABLES `gameversion` WRITE;
/*!40000 ALTER TABLE `gameversion` DISABLE KEYS */;
INSERT INTO `gameversion` VALUES (1,'1.4.7',0,'https://seba0456.itch.io/slendertubbies/devlog/652564/update-147'),(2,'1.4.7.1',0,'https://seba0456.itch.io/slendertubbies/devlog/654963/update-1471'),(3,'1.5',0,'https://seba0456.itch.io/slendertubbies/devlog/659948/update-15'),(4,'1.5.1',0,'https://seba0456.itch.io/slendertubbies/devlog/663505/slendertubbies-the-journey'),(5,'1.5.2',0,'https://seba0456.itch.io/slendertubbies/devlog/692577/slendertubbies-3rd-anniversary'),(6,'1.5.2.1',0,'https://seba0456.itch.io/slendertubbies/devlog/693109/speedrun-mode'),(7,'1.5.2.2',0,'https://seba0456.itch.io/slendertubbies/devlog/693434/patch-1522');
/*!40000 ALTER TABLE `gameversion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playerdata`
--

DROP TABLE IF EXISTS `playerdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playerdata` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `PlayerID` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `PublicID` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `PlayerName` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `GameVersion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `RegistrationDate` datetime NOT NULL,
  `CollectedCustards` int DEFAULT '0',
  `CatchedSurvivors` int DEFAULT '0',
  `StartedSP_Games` int DEFAULT '0',
  `FinishedSP_Games` int DEFAULT '0',
  `HostedMP_Games` int DEFAULT '0',
  `JoinedMP_Games` int NOT NULL DEFAULT '0',
  `FinishedMP_Games` int DEFAULT '0',
  `LastActive` datetime DEFAULT NULL,
  `bUsedEpic` tinyint(1) DEFAULT '0',
  `bPublicProfile` tinyint(1) NOT NULL DEFAULT '1',
  `bDeveloperProfile` tinyint(1) NOT NULL DEFAULT '0',
  `Score` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9993 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playerdata`
--

LOCK TABLES `playerdata` WRITE;
/*!40000 ALTER TABLE `playerdata` DISABLE KEYS */;
INSERT INTO playerdata (PlayerID, PublicID, PlayerName, GameVersion, RegistrationDate, CollectedCustards, CatchedSurvivors, StartedSP_Games, FinishedSP_Games, HostedMP_Games, JoinedMP_Games, FinishedMP_Games, LastActive, bUsedEpic, bPublicProfile, Score)
VALUES 
('123456', 'ABCDEF', 'Gracz1', '1.0', '2024-03-19 12:00:00', 10, 5, 3, 2, 1, 5, 2, '2024-03-19 13:00:00', 0, 1, 100),
('789012', 'GHIJKL', 'Gracz2', '1.2', '2024-03-18 10:00:00', 8, 3, 2, 1, 0, 2, 1, '2024-03-18 11:30:00', 1, 1, 80);
/*!40000 ALTER TABLE `playerdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scoresystem`
--

DROP TABLE IF EXISTS `scoresystem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scoresystem` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ActionID` text NOT NULL,
  `Description` text NOT NULL,
  `ScoreReward` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scoresystem`
--

LOCK TABLES `scoresystem` WRITE;
/*!40000 ALTER TABLE `scoresystem` DISABLE KEYS */;
INSERT INTO `scoresystem` VALUES (1,'LevelAction_0','Player starts multiplayer game',15),(2,'LevelAction_1','Player loses match',75),(3,'LevelAction_2','Player wins match',150),(4,'LevelAction_3','Player catches other player',120),(5,'LevelAction_4','Player collects custard',30),(6,'LevelAction_5','Completing speedrun',300);
/*!40000 ALTER TABLE `scoresystem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `startedgames`
--

DROP TABLE IF EXISTS `startedgames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `startedgames` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `MatchID` varchar(6) NOT NULL,
  `RoomName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `GameMode` varchar(16) NOT NULL,
  `MapName` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CustardAmount` int NOT NULL,
  `bSelectTubby` tinyint(1) NOT NULL,
  `bBattery` tinyint(1) NOT NULL,
  `bFullTubby` tinyint(1) NOT NULL,
  `bMultiplayer` tinyint(1) NOT NULL,
  `bFinished` tinyint(1) NOT NULL DEFAULT '0',
  `MaxPlayers` int NOT NULL,
  `HostedBy` varchar(16) NOT NULL,
  `CreateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14287 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `startedgames`
--

LOCK TABLES `startedgames` WRITE;
/*!40000 ALTER TABLE `startedgames` DISABLE KEYS */;
INSERT INTO startedgames (MatchID, RoomName, GameMode, MapName, CustardAmount, bSelectTubby, bBattery, bFullTubby, bMultiplayer, MaxPlayers, HostedBy, CreateTime) 
VALUES 
('ABC123', 'Room1', 'SinglePlayer', 'Forest', 5, 1, 1, 0, 0, 1, 'Player1', '2024-03-19 10:00:00'),
('DEF456', 'Room2', 'Multiplayer', 'Mountains', 10, 1, 1, 1, 1, 4, 'Player2', '2024-03-19 11:30:00'),
('GHI789', 'Room3', 'SinglePlayer', 'Desert', 8, 1, 0, 1, 0, 1, 'Player3', '2024-03-19 12:45:00');
/*!40000 ALTER TABLE `startedgames` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-19  2:00:02

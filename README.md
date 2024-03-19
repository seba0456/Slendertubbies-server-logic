# Slendertubbies Server-side Logic

I've decided to share the code for my Slendertubbies website, including its logic, on GitHub. This repository illustrates what I've created and learned throughout this process. Please note that this API will not be utilized further; it signifies a concluded chapter in the game's development. Thank you for playing my game, and I hope you enjoyed the functionality of [st.sebaprojects.online](http://st.sebaprojects.online).

## Configuration

I'll also strive to include a configuration file that directs the Slendertubbies client on where to send data. This will empower you to create your own leaderboards and player profiles. Hosting the website requires adjusting the connection PHP file to utilize the `.ini` configuration. Additionally, you may need to modify the `.htaccess` file on your server.

## Functionality

This code encompasses the server-side logic for Slendertubbies, excluding the multiplayer aspect. Here, you can observe the entire website's functionality, including player profiles, API, and the main page.

## How it Works

The provided URLs serve as examples:

- To register a new player:
  `http://192.168.1.3/voyager.php?authKey=key_here&action=register&playerName=seba0456`
- To modify a variable:
  `http://192.168.1.3/voyager.php?authKey=key_here&action=modify&tableName=playerdata&variableName=CollectedCustards&operation=add&value=1&playerID=3a5e07d857bc3130`
- To overwrite a variable:
  `http://192.168.1.3/voyager.php?authKey=key_here&action=overwriting&tableName=playerdata&variableName=PlayerName&newValue=NewNickname&playerID=3a5e07d857bc3130`
- To list player data from the server:
  `http://192.168.1.3/voyager.php?authKey=key_here&action=getDetailedPlayerData&playerID=3a5e07d857bc3130`

This straightforward API may pose security risks due to its potential for unintended database modifications. Presently, the system employs two variables for authentication: a static AuthKey and a secret variable called PlayerID.

On the client-side, I utilized the [VA Rest API Plugin](https://www.unrealengine.com/marketplace/en-US/product/varest-plugin) to establish connections with my server.

The `website` folder contains all files utilized by the Apache server, while `SlendertubbiesDB_Data` holds `config.ini` and `auth_key`. These directories shouldn't reside in the `www` server, containing sensitive credentials, so ensure their security. The `scripts` folder comprises a script for backing up the database, which can be automated using `cron`.

## Miscellaneous

Feel free to incorporate my code into your project. ^^

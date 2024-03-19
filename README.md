# Slendertubbies Server-side Logic

I have decided to publish the code for my Slendertubbies website, along with its logic, on GitHub. This repository showcases what I have created and learned during this process. Please note that this API will not be used again; it represents a closed chapter in the development of the game. Thank you for playing my game, and I hope you enjoyed the functionality of [st.sebaprojects.online](http://st.sebaprojects.online).

## Configuration

I will also attempt to include a configuration file that directs the Slendertubbies client on where to send data. This will enable you to create your own leaderboards and player profiles. All you need to do is host the website and adjust the connection PHP file to use the `.ini` configuration. Additionally, you may need to make changes to the `.htaccess` file on your own server.

## Functionality

This code represents the server-side logic for Slendertubbies, excluding the multiplayer aspect.

## How it Works

These URLs are just examples:

- Register a new player:
  `http://192.168.1.3/voyager.php?authKey=key_here&action=register&playerName=seba0456`
- Modify variable:
  `http://192.168.1.3/voyager.php?authKey=key_here&action=modify&tableName=playerdata&variableName=CollectedCustards&operation=add&value=1&playerID=3a5e07d857bc3130`
- Overwrite variable:
  `http://192.168.1.3/voyager.php?authKey=key_here&action=overwriting&tableName=playerdata&variableName=PlayerName&newValue=NewNickname&playerID=3a5e07d857bc3130`
- List player data from server:
  `http://192.168.1.3/voyager.php?authKey=key_here&action=getDetailedPlayerData&playerID=3a5e07d857bc3130`

This simple API may pose security risks due to its allowance of unintended database modifications. Presently, the system employs two variables for authentication: a static AuthKey and a secret variable called PlayerID.

On the client-side, I utilized the [VA Rest API Plugin](https://www.unrealengine.com/marketplace/en-US/product/varest-plugin) to establish connections with my server.

## Miscellaneous

Feel free to use my code in your project ^^

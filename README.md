# Message

I've decided to publish my Slendertubbies website and its logic here, on Github.

This is server side logic for Slendertubbies (not multiplayer).

```
Rejestr a new player:
http://192.168.1.3/voyager.php?authKey=key_here&action=register&playerName=seba0456
Modify variable:
http://192.168.1.3/voyager.php?authKey=key_here&action=modify&tableName=playerdata&variableName=CollectedCustards&operation=add&value=1&playerID=3a5e07d857bc3130
Overwrite variable:
http://192.168.1.3/voyager.php?authKey=key_here&action=overwriting&tableName=playerdata&variableName=PlayerName&newValue=NewNickname&playerID=3a5e07d857bc3130
List player data from server:
http://192.168.1.3/voyager.php?authKey=key_here&action=getDetailedPlayerData&playerID=3a5e07d857bc3130
```

This simple API might be unsafe because it allows for unwanted database modifications. Currently, this system uses two variables for authentication: a static AuthKey and a PlayerID, which is a secret variable.

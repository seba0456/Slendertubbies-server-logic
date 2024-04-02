#!/bin/bash

# Server URL
URL="https://st.sebaprojects.online/voyager.php?action=getTopPlayers"

# Path to save the file
OUTPUT_PATH="/home/SlendertubbiesDB_Data/best_players/"

# Current date in YYYYMMDD format
CURRENT_DATE=$(date "+%Y_%m_%d")

# Output file name
OUTPUT_FILE="${OUTPUT_PATH}${CURRENT_DATE}_top_players.json"

# Perform a request to the server and save the response to a file
curl -s "$URL" > "$OUTPUT_FILE"

# Display a message confirming the completion of data retrieval and saving
echo "Server response has been saved to the file $OUTPUT_FILE"


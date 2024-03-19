#!/bin/bash

# Variable with the backup path
backup_path="/home/SlendertubbiesDB_Data/db_Backup"

# Get the current date
current_date=$(date +"%d_%m_%Y")

# Full name of the backup file
backup_file="$backup_path/Slendertubbies_$current_date.sql"

# Path to the .ini file with login details
config_path="/home/SlendertubbiesDB_Data/config.ini"

# Read login details from the .ini file
db_user=$(awk -F "=" '/username/ {print $2}' $config_path)
db_password=$(awk -F "=" '/password/ {print $2}' $config_path)
db_name=$(awk -F "=" '/dbname/ {print $2}' $config_path)

# Perform database backup
mysqldump -u$db_user -p$db_password $db_name > $backup_file

# Check if the backup was successful
if [ $? -eq 0 ]; then
  echo "Database backup successful. File: $backup_file"
else
  echo "Error occurred while creating database backup."
fi

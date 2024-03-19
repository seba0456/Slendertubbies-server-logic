import xml.etree.ElementTree as ET
import mysql.connector
from tqdm import tqdm
import configparser

# Reading data from the configuration file
config = configparser.ConfigParser()
config.read("config.ini")

db_config = config["database"]
host = db_config["servername"]
user = db_config["username"]
password = db_config["password"]
database = db_config["dbname"]

# Connecting to the database
db_connection = mysql.connector.connect(
    host=host,
    user=user,
    password=password,
    database=database
)

# Creating a cursor to execute SQL queries
db_cursor = db_connection.cursor()

# Retrieving data of players meeting the conditions
query = "SELECT PublicID FROM playerdata WHERE bPublicProfile = 1"
db_cursor.execute(query)
players = db_cursor.fetchall()

# Creating XML structure
urlset = ET.Element("urlset")
urlset.set("xmlns", "https://www.sitemaps.org/schemas/sitemap/0.9")

# Generating URL elements based on player data
for player in tqdm(players, desc="Generating URL map", unit=" player"):
    public_id = player[0]
    url = ET.SubElement(urlset, "url")
    loc = ET.SubElement(url, "loc")
    loc.text = f"https://st.sebaprojects.online/player/{public_id}"

# Creating and saving the XML file
tree = ET.ElementTree(urlset)
tree.write("mapa_url.xml", encoding="utf-8", xml_declaration=True)

# Closing the database connection
db_cursor.close()
db_connection.close()

print("Generated URL map and saved it as mapa_url.xml")

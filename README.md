# Super Ski
the goal of the project is to design and program an NFC system that simulates access to a ski facility, creating an overview of the season by memorizing the date and time of the accesses.
# Components
## Hardware Components
- ESP-32;
- NFC Cards and Tags;
- Connection cables;
- PN532 NFC Reader;
## Software Components
- Arduino IDE to program NFC devices;
- Arduino IDE to program ESP32;
- XAMPP to start web server (phpMyAdmin, Apache web server)
- PHP to develop web pages;
- JS to code web pages;
- CSS to program the style of web pages;
# Setup
## Hardware Setup
- attach the ESP32 board;
- attach NFC Reader to ESP32 board paying attenetion to order of pins;
- connect the board to PC;
## Software Setup
- program the board with arduino code;
- including libraries for the communication with NFC device: WiFi.h, HTTPClient.h, PN532_HSU.h, PN532.h;
- import web pages on server;
# Code Explanation
The entire project is composed by various parts:
- arduino code:

connect to WiFi, search for PN532 Module and it activate it when found, wait for a card and when is place la riconosce e invia al server il numero della carta
- index.php:

homepage, l'utente può appoggiare la tessera o inserire il suo numero, attraverso il pulsante "verifica" il sistema controlla la validità della tessera e se è verificata accede alla propria performance, attraverso un link è possibile amministrare il sistema 
- dashboard.php:

permette di selezionare la data, e vedere le performance della giornata selezionata e le medie giornaliere con tabelle e grafici
- login.php:

accesso all'area di amministrazione sistema
- amm.php:

connessione ESP532 e leggere tessere, e permette di associare o dissociare una tessera
-database.php:

pagina non visualizzata dall'utente, permette di memorizzare l'ultima tessera letta

/////tabelle database

the system is designed to recognize the accesses of different NFC cards, memorize the date and time of the access and return an overall report of all the accesses.
All operations can be viewed on a web page.
when an NFC chip is detected, the reader sends an authentication request to the Arduino microprocessor which compares the new chip with the existing ones.
- when the chip number already exists, the system stores a new access and performs operations on it
- when the chip number does not exist, the system detects that it has never been authenticated and returns a warning
the web service is responsible for storing, organizing and creating the access overviews of each NFC card
# Project Video and Presentation
[video](https://github.com/elgabe01/Embedded-Software/edit/main/README.md)

# Team
Gabriele Fasoli
Nicola Turniano

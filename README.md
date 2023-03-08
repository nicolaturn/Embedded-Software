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

the system is designed to recognize the accesses of different NFC cards, memorize the date and time of the access and return an overall report of all the accesses.
All operations can be viewed on a web page.
the web service is responsible for storing, organizing and creating the access overviews of each NFC card.

The entire project is composed by various parts:
- arduino code:
  - connect to WiFi;
  - search for PN532 Module and it activate it when found;
  - wait card, gets the number and sends it to the web server
- index.php:
  - contains code of homepage;
  - the user can enter the card number or place it on the reader, reading the number of the card you can access its performances;
  - link to administer the system;
- dashboard.php:
  - date selection;
  - view performance of the selected day and its averages with tables and graphs;
- login.php:
  - administration area login;
- amm.php:
  - ESP532 connections;
  - cards reading;
  - association/dissociation cards
-database.php (page not used by the user):
  - storage of the last card read;


/////tabelle database

# Project Video and Presentation
[video](https://github.com/elgabe01/Embedded-Software/edit/main/README.md)

# Team
Gabriele Fasoli
Nicola Turniano

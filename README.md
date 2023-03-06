# Super Ski
the goal of the project is to design and program an NFC system that simulates access to a ski facility, creating an overview of the season by memorizing the date and time of the accesses.
To view all personal accesses it will be necessary to authenticate on the website.
# Components
## Hardware Components
- arduino board;
- NFC cards;
- ...
## Software Components
- Arduino to program NFC devices;
- c to program the code;
- html to program web page
- JS to program the code of web page
- CSS to program the style of web page
# Setup
## Hardware Setup
- attach the arduino board paing attenetion to order of pins;
- connect the board to download the programmed codes;
## Software Setup
- program the board with arduindo code, including libraries for the communication with NFC device
-program web page with htma, JS and CSS;
# Code Explanation
the system is designed to recognize the accesses of different NFC cards, memorize the date and time of the access and return an overall report of all the accesses.
All operations can be viewed on a web page.

the NFC reader waits for a signal by performing a scan every 10 microseconds
when an NFC chip is detected, the reader sends an authentication request to the Arduino microprocessor which compares the new chip with the existing ones.
- when the chip number already exists, the system stores a new access and performs operations on it
- when the chip number does not exist, the system detects that it has never been authenticated and returns a warning
the web service is responsible for storing, organizing and creating the access overviews of each NFC card

// WIFI libraries
#include <WiFi.h>
#include <HTTPClient.h>

// NFC libraries
#include <PN532_HSU.h>
#include <PN532.h>

// Replace with your network credentials
const char* ssid = "iPhone di Nicola";
const char* password = "qwertyuiop";

//Your Domain name with URL path or IP address with path
String serverName = "http://172.20.10.4";

// Initialize PN532 library
PN532_HSU pn532hsu(Serial2);
PN532 nfc( pn532hsu );
String tagId = "None", dispTag = "None";
byte nuidPICC[4];


void checkAccessCard(String ncarta) {
  HTTPClient http;

  String serverPath = serverName + "/dashboard/embedded/database.php";
  
  // Your Domain name with URL path or IP address with path
  http.begin(serverPath.c_str());

  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  
  String httpRequestData = "ncarta=" + ncarta;  

  //serverPath*="?ncarta="+ncarta;         
  
  int httpResponseCode = http.POST(httpRequestData);
  //int httpResponseCode=http.GET(); 
  
  if (httpResponseCode>0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
    String payload = http.getString();
    Serial.println(payload);
  }
  else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }
  // Free resources
  http.end();
}

void readNFC()
{
  boolean success;
  uint8_t uid[] = { 0, 0, 0, 0, 0, 0, 0 };  // Buffer to store the returned UID
  uint8_t uidLength;                       // Length of the UID (4 or 7 bytes depending on ISO14443A card type)
  success = nfc.readPassiveTargetID(PN532_MIFARE_ISO14443A, &uid[0], &uidLength);
  if (success)
  {
    Serial.print("UID Length: ");
    Serial.print(uidLength, DEC);
    Serial.println(" bytes");
    Serial.print("UID Value: ");
    for (uint8_t i = 0; i < uidLength; i++)
    {
      nuidPICC[i] = uid[i];
      Serial.print(" "); Serial.print(uid[i], DEC);
    }
    Serial.println();
    tagId = tagToString(nuidPICC);
    dispTag = tagId;
    Serial.print(F("tagId is : "));
    Serial.println(tagId);
    Serial.println("");
    checkAccessCard(tagId);
    delay(1000);  // 1 second halt
  }
}

String tagToString(byte id[4])
{
  String tagId = "";
  for (byte i = 0; i < 4; i++)
  {
    if (i < 3) tagId += String(id[i]) + ".";
    else tagId += String(id[i]);
  }
  return tagId;
}

void setup() {
  Serial.begin(115200); 

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());


  nfc.begin();
  uint32_t versiondata = nfc.getFirmwareVersion();
  if (! versiondata)
  {
    Serial.print("Didn't Find PN53x Module");
    while (1); // Halt
  }
  // Got valid data, print it out!
  Serial.print("Found chip PN5");
  Serial.println((versiondata >> 24) & 0xFF, HEX);
  Serial.print("Firmware ver. ");
  Serial.print((versiondata >> 16) & 0xFF, DEC);
  Serial.print('.'); 
  Serial.println((versiondata >> 8) & 0xFF, DEC);
  // Configure board to read RFID tags
  nfc.SAMConfig();
}

void loop() {
  readNFC();
}

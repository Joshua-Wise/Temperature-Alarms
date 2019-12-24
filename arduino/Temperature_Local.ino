// Including the library
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <SPI.h>

// Network Details
const char* ssid = "";
const char* password = "";
String ServerIP = "";

//DO NOT MODIFY CODE BELOW THIS COMMENT

// Data Variable
String Table = WiFi.hostname();

// Data wire is plugged into pin D1 on the ESP8266 12-E - GPIO 5
#define ONE_WIRE_BUS 5

// Setup a oneWire instance to communicate with any OneWire devices
OneWire oneWire(ONE_WIRE_BUS);

// Pass our oneWire reference to Dallas Temperature.
DallasTemperature DS18B20(&oneWire);
char temperatureCString[7];
char temperatureFString[7];

// Web Server
WiFiServer server(80);

// Timer
long previousMillis = 0;
long interval = 1800000; // Interval for Timer

// Run on Boot
void setup() {
  // Initializing Serial Port
  Serial.begin(115200);
  delay(10);

  DS18B20.begin();

  // Connecting to WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);
  WiFi.mode(WIFI_STA);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");

  // Start Web Server
  server.begin();
  Serial.println("Web Server Running.");
  delay(10000);

  // Print Device Information
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());
  Serial.print("MAC: ");
  Serial.println(WiFi.macAddress());
  Serial.print("HOSTNAME: ");
  Serial.println(WiFi.hostname());
  Serial.println("Recoding Temperature Every 30 Minutes.");
}

void getTemperature() {
  float tempC;
  float tempF;
  do {
    DS18B20.requestTemperatures();
    tempC = DS18B20.getTempCByIndex(0);
    dtostrf(tempC, 2, 2, temperatureCString);
    tempF = DS18B20.getTempFByIndex(0);
    dtostrf(tempF, 3, 2, temperatureFString);
    delay(100);
  } while (strcmp(temperatureFString, "-196.60") == 0);
}

void loop() {
  //Web Server Loop

  WiFiClient client = server.available();

  if (client) {
    Serial.println("New client");
    // Locate HTTP Request End
    boolean blank_line = true;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();

        if (c == '\n' && blank_line) {
          getTemperature();
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connection: close");
          client.println();
          // Local Web Server
          client.println("<!DOCTYPE HTML>");
          client.println("<html>");
          client.println("<head><link rel=""stylesheet"" href=""https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css""></head>");
          client.println("<body>");
          client.println("<div class=""card mx-auto"" style=""max-width: 200px; max-height: 270px; margin-top: 20px;"">");
          client.println("<div class=""card-header"">");
          client.println("<h3 align=""center"">" + Table + "</h3>");
          client.println("<h6 align=""center"">Live Temperature</h6>");
          client.println("</div>");
          client.println("<div class=""card-body"">");
          client.println("<h1 class=""card-title"" align=""center"">");
          client.println(temperatureFString);
          client.println("<span>&#176;</span></h1>");
          client.println("<p align=""center"" style=""font-size: 10px; margin-bottom: 0px;"">");
          client.print(WiFi.localIP());
          client.print("</p>");
          client.println("<p align=""center"" style=""font-size: 10px;"">");
          client.print(WiFi.macAddress());
          client.print("</p>");
          client.println("</div>");
          client.println("</div>");
          client.println("</body>");
          break;
        }
        if (c == '\n') {
          blank_line = true;
        }
        else if (c != '\r') {
          blank_line = false;
        }
      }
    }
    // Close Connection
    delay(1);
    client.stop();
    Serial.println("Client disconnected.");
  }

  // Record Data to Server Every 30 Minutes

  unsigned long currentMillis = millis();

  if (currentMillis - previousMillis > interval) {
    getTemperature();
    senddata();       //Send Temp
    previousMillis = currentMillis; //Log Time
  }
}

void senddata()
{
  WiFiClient client;

  Serial.println();
  delay(1000);  //Prevent Connection Freeze

  HTTPClient http;    //Declare Object of HTTPClient

  String getData, Link;
 
  //GET Data
  getData = "?table=" + Table + "&temp=" + temperatureFString;
  Link = "http://" + ServerIP + "/write.php" + getData;
  
  http.begin(Link);     //Specify Request Destination
  
  int httpCode = http.GET();            //Send the Request
  String payload = http.getString();    //Get the Response
 
  Serial.println(httpCode);   //Print HTTP return code
  Serial.println(payload);    //Print request response payload
 
  http.end();  //Close connection
  
  delay(5000);  //GET Data at every 5 seconds

}

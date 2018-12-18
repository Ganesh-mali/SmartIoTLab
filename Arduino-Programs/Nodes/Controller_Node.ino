#include <SPI.h>
#include <WiFi.h>
#include <PubSubClient.h>
String buildClientName (){
  String data = "";
  data+="d:";
  data+="VJTI";
  data+=":";
  data+="CSRIoTLab3";
  data+=":";
  data+="Actuator1";
  return data;
}
int ssrControlPin = 15;
// WiFi Login
char ssid[] = "CSRIOTLab3Gateway";      //  your network SSID (name)
char pass[] = "csr10t1ab3";             // your network password

// IBM Bluemix Info
char orgName[] = "1ryln5";      // Your org name, found under the "Credentials" area in your Bluemix dashboard.
char macstr[] = "Arduino"; // The MAC address of your Arduino gadget, update this to match your own.
char server[] = "192.168.4.1"; // MQTT Host (taken from Bluemix dashboard)
char type[] = "ArduinoGateway";    // Type of device you have registered in the IBM Bluemix Devices area.
char token[] = "srinivas"; // Token issued when you first register your IoT device (only appears once)
int port = 1883;

String clientName = buildClientName();
String topicName = String("vjti/csriot/lab3/act1"); // Topic

// WiFi connection
WiFiClient wifiClient;
int status = WL_IDLE_STATUS;          // the Wifi radio's status

// PubSub Client.
PubSubClient client(server, port, 0 , wifiClient);
void setup()
{
  pinMode(ssrControlPin, OUTPUT);
  Serial.begin(115200);
  status = WiFi.begin(ssid, pass);
  if(status == WL_CONNECTED){
    Serial.println("WiFi Connected!");
  } else {
    Serial.println("WiFi Failed!");
  }
  client.setCallback(callback);
}

void loop()
{
  
 if (!client.connected()) {
  reconnect();
 }
 client.loop();
}
void reconnect() {
 // Loop until we're reconnected
 while (!client.connected()) {
 Serial.print("Attempting MQTT connection...");
 // Attempt to connect
 char clientStr[34];
  clientName.toCharArray(clientStr,34);
  Serial.print("Trying to connect to: ");
    Serial.println(clientStr);
 client.connect(clientStr, "use-token-auth", token);
 if (client.connected()) {
  char topicStr[28];
  topicName.toCharArray(topicStr,28);
  Serial.println("connected");
  // ... and subscribe to topic
  client.subscribe(topicStr);
 } else {
  Serial.print("failed, rc=");
  Serial.print(client.state());
  Serial.println(" try again in 5 seconds");
  // Wait 5 seconds before retrying
  delay(5000);
  }
 }
}
void callback(char* topic, byte* payload, unsigned int length) {
 Serial.print("Message arrived [");
 Serial.print(topic);
 Serial.print("] ");
 for (int i=0;i<length;i++) {
  char receivedChar = (char)payload[i];
  Serial.print(receivedChar);
  if (receivedChar == '1')
  // ESP8266 Huzzah outputs are "reversed"
  digitalWrite(ssrControlPin, HIGH);
  if (receivedChar == '0')
   digitalWrite(ssrControlPin, LOW);
  }
  Serial.println();
}


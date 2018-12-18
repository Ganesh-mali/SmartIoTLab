//This program is run at the controller(ESP-32) 
//In this program an MQTT client is created and it subscribes to the topic on which the gateway publishes the command to 
//switch ON/OFF the appliance.
//Relay is connected at the Pin 15 of the controller(ESP32 in this case)
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
char ssid[] = "CSR_IOT_LAB";      //  your network SSID (name)
char pass[] = "csr10t1ab1369";             // your network password

// IBM Bluemix Info
char orgName[] = "1ryln5";      // Your org name, found under the "Credentials" area in your Bluemix dashboard.
char macstr[] = "Arduino"; // The MAC address of your Arduino gadget, update this to match your own.
char server[] = "172.18.22.9"; // MQTT Host (taken from Bluemix dashboard)
char type[] = "ArduinoGateway";    // Type of device you have registered in the IBM Bluemix Devices area.
char token[] = "srinivas"; // Token issued when you first register your IoT device (only appears once)
int port = 1886;

String clientName = buildClientName();
String topicName = String("a/b/c"); // Topic

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
 client.connect("test-client1", "test-user1", "123");
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

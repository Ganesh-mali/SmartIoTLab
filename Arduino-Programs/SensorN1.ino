// SimpleTx - the master or the transmitter
//Writing Pipe address 0x65646f4e31
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>


#define CE_PIN   9
#define CSN_PIN 10

const byte slaveAddress[5] = {'R','x','A','A','A'};


RF24 radio(CE_PIN, CSN_PIN); // Create a Radio

char txNum = '0';


unsigned long currentMillis;
unsigned long prevMillis;
unsigned long txIntervalMillis = 1000; // send once per second
int inputPin = 3;               // choose the input pin (for PIR sensor)
int val = 0;                    // variable for reading the pin status
int sensorPin = A0; // select the input pin for LDR
int sensorValue = 0; // variable to store the value coming from the sensor




void setup() {
    pinMode(inputPin, INPUT);     // declare sensor as input
    Serial.begin(9600);
    Serial.println("SimpleTx Starting");

    radio.begin();
    radio.setDataRate(RF24_250KBPS);
    //radio.setChannel(0x76);//Originally not present in this program
    radio.setRetries(3,5); // delay, count
    radio.openWritingPipe(0x65646f4e31);//Working with Node RED address 0x65646f4e31 //originally slave address
    //radio.enableDynamicPayloads();//Originally not present in this program
}

//====================

void loop() {

    currentMillis = millis();
    if (currentMillis - prevMillis >= txIntervalMillis)
    {   
        int data_PIR = PIR();
        int data_LDR = LDR();
        if(data_PIR==HIGH)
        { 
          String json = buildJson(data_PIR,data_LDR);
          char dataToSend[json.length()];
          Serial.println(sizeof(dataToSend));
           //json.toCharArray(dataToSend,100);
          int i;
          for(i=0;i<json.length();i++){
            dataToSend[i]=json.charAt(i);
          }
          dataToSend[i]='\0';
          bool rslt;
          rslt = radio.write( &dataToSend, sizeof(dataToSend) );
          // Always use sizeof() as it gives the size as the number of bytes.
          // For example if dataToSend was an int sizeof() would correctly return 2

          //Serial.print("Datae Sent ");
          //Serial.print(dataToSend);
          if (rslt) {
            //Serial.println("  Acknowledge received");
            //updateMessage();
          }
          else {
            //Serial.println("  Tx failed");
          }
          delay(30000);      
          prevMillis = millis();
        }
    }
}

//====================

int PIR()
{
   val = digitalRead(inputPin);  // read input value
   return(val);
  
}

int LDR()
{
  
 sensorValue = analogRead(sensorPin); // read the value from the sensor
 return(sensorValue);
}



String buildJson(int motion, float lintensity) {
  String data = "{";
  //data+="\n";
  data+= "\"N1\": {";
  //data+="\n";
  data+="\"M\":";
  data+=motion; // Note: wrap like \"5\" for a string, this is a number we are sending.
  //data+="\n";
  data+=",";
  data+="\"L\":";
  data+=lintensity;
  data+="}";
  //data+="\n";
  data+="}";
  return data;
  //String data="hello";
  return data;
}

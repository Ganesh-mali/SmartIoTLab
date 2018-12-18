// SimpleTx - the master or the transmitter
//@Vikas
//This program sends the data to the gateway communicating whether to turn the appliance ON/OFF. This is a very basic program
//It communicated with the gateway by using RF Module 
//If there is a motion before a minute it resets its counter. If there is no motion after a minute it switches off the appliance 
//
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   9
#define CSN_PIN 10

const byte slaveAddress[5] = {'R','x','A','A','A'};


RF24 radio(CE_PIN, CSN_PIN); // Create a Radio
unsigned long currentMillis;
unsigned long prevMillis;
unsigned long txIntervalMillis = 1000; // send once per second
int count1=1;
int count2=0;
int initialState=0;
int lastState=0;
int currentState=0;
int pirPin = 3; // Input for HC-S501
int pirValue; // Place to store read PIR Value
char dataToSend[16];

void setup() {

    Serial.begin(9600);

    Serial.println("SimpleTx Starting");

    radio.begin();
    radio.setDataRate(RF24_250KBPS);//For Python radio.setDataRate(RF24_1MBPS);
    //radio.setChannel(0x76);//Originally not present in this program specifically being used for communication with Python program
    //For communication with Node-RED(Raspberry Pi, this line was absent)
    radio.setRetries(3,5); // delay, count
    radio.openWritingPipe(0x65646f4e31);//Working with Node RED address 0x65646f4e31 //originally slave address for arduino-arduino
    //communication For Python 0xF0F0F0F0E1
    //radio.enableDynamicPayloads();//Originally not present in this program specifically being used for communication with Python program
    //For communication with Node-RED(Raspberry Pi, this line was absent)
}

//====================

void loop() {
        //Code for checking 1 min duration
  // Read the signal from the sensor: a HIGH pulse whose
  // duration is the time (in microseconds) from the sending
  // of the ping to the reception of its echo off of an object.
 int motion=0;
 pirValue = digitalRead(pirPin);
  if(count1==1){
        if(pirValue==HIGH){//There is presence
          initialState=1;
          lastState=1;
        }
        else{
          initialState=0;
          lastState=0;
        }
        Serial.print("Initial State is");
        Serial.println(initialState);
        int num =initialState ;
        itoa(num, dataToSend , 10);
        send();//send initialState
        count1=0;
   }
   delay(5000);
   count2=0;
   while(count2<=12){
        Serial.print("Current Count Value is:");
        Serial.println(count2);
        pirValue=digitalRead(pirPin);
        Serial.print("Current State is:");
        Serial.println(pirValue);
        Serial.print("Last State is: ");
        Serial.println(lastState);    
        if(pirValue==HIGH){
          currentState=1;
        }else{
         currentState=0; 
        }
        if(lastState==0 && currentState==1)
           break;
        else if(lastState==0 && currentState==0)
          count2=0;
        else if(lastState==1 && currentState==0)
          count2++;
        else if(lastState==1 && currentState==1)
          count2=0;
        delay(5000);
      }
      lastState=currentState;
      Serial.println("This statement is getting executed");
      digitalWrite(13,HIGH);
      delay(2000);
      digitalWrite(13,LOW);
        //Code for sending data
         int num =currentState ;
        itoa(num, dataToSend , 10);
        send();//Current State
        
}

//====================

void send() {

    bool rslt;
    rslt = radio.write( &dataToSend, sizeof(dataToSend) );
        // Always use sizeof() as it gives the size as the number of bytes.
        // For example if dataToSend was an int sizeof() would correctly return 2

    Serial.print("Data Sent ");
    Serial.print(dataToSend);
    if (rslt) {
        Serial.println("  Acknowledge received");
    }
    else {
        Serial.println("  Tx failed");
    }
}





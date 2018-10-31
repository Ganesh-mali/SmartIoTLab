// SimpleTx - the master or the transmitter
//@Vikas
//This program was used to transmit data to Node-RED and Python at Raspberry Pi with few changes in the program
//
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>


#define CE_PIN   9
#define CSN_PIN 10

const byte slaveAddress[5] = {'R','x','A','A','A'};


RF24 radio(CE_PIN, CSN_PIN); // Create a Radio

char dataToSend[10] = "Message 0";
char txNum = '0';


unsigned long currentMillis;
unsigned long prevMillis;
unsigned long txIntervalMillis = 1000; // send once per second


void setup() {

    Serial.begin(9600);

    Serial.println("SimpleTx Starting");

    radio.begin();
    radio.setDataRate(RF24_1MBPS);
    radio.setChannel(0x76);//Originally not present in this program specifically being used for communication with Python program
    //For communication with Node-RED(Raspberry Pi, this line was absent)
    radio.setRetries(3,5); // delay, count
    radio.openWritingPipe(0xF0F0F0F0E1);//Working with Node RED address 0x65646f4e31 //originally slave address for arduino-arduino
    //communication
    radio.enableDynamicPayloads();//Originally not present in this program specifically being used for communication with Python program
    //For communication with Node-RED(Raspberry Pi, this line was absent)
}

//====================

void loop() {
    currentMillis = millis();
    if (currentMillis - prevMillis >= txIntervalMillis) {
        send();
        prevMillis = millis();
    }
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
        updateMessage();
    }
    else {
        Serial.println("  Tx failed");
    }
}

//================

void updateMessage() {
        // so you can see that new data is being sent
    txNum += 1;
    if (txNum > '9') {
        txNum = '0';
    }
    dataToSend[8] = txNum;
}



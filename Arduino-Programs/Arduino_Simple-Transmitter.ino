/*
 * @Vikas
 * This simple program can be used for sending data to Raspberry Pi running Node-RED or Python Program
 * with some commenting and uncommenting depending upton the programming language being used at the receiver side
 * It doesn't provide any kind of acknowledgement in the communication
 */
#include<SPI.h>
#include<RF24.h>

// ce, csn pins
RF24 radio(9, 10);

void setup(void){
  radio.begin();
  radio.setPALevel(RF24_PA_MAX);
  //radio.setDataRate( RF24_1MBPS );//Not to be used with Python Program, To be used in Node-RED Program 
  radio.setChannel(0x76); //It was creating problem while communicating with (Node-RED)Raspberry Pi but needed in Python Program
  radio.openWritingPipe(0xF0F0F0F0E1);//Previously the address was 0x65646f4e31 for Node-RED Raspberry Pi
  radio.enableDynamicPayloads(); //It was creating problem while communicating with Node-RED Raspberry Pi but needed for python 
  //program
  radio.powerUp();
}

void loop(void){
    const char text[] = "Hello World is awesome";
  radio.write(&text, sizeof(text));
  delay(1000);

}

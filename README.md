# SmartIoTLab

This are some temporary program files that were created while working on creating a smart energy saving system for our IoT Lab.
As of now we have a motion sensor connected to ESP32 on which pubsub MQTT client library is added that sends the command to the 
Raspberry Pi based on the meeting of specific condition. Raspberry Pi acts as a controller/gateway in this scenario which is 
responsible for sending/receing command to/from different sensor nodes. One sensor node reads motion sensor data and then
checks to see if there has been any motion in last 5 minutes if there is no motion a command is sent to Controller also if there 
is a motion after switching off the light the command is sent to to the Controller to switch on the lights. There is another actuator
node based on ESP32 to which a 100 W lightbulb is connected to via a relay. It receives the command from the controller to swich or
switch off the light and accordingly it makes or breaks the circuit of the load using relay. The controller device also strore
the information about when the light was turned on or off in the influx db database.

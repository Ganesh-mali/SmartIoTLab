import paho.mqtt.client as paho
import time
 
def on_publish(client, userdata, mid):
    print("mid: "+str(mid))
 
client = paho.Client()
client.on_publish = on_publish
client.connect("172.18.22.9", 1884)
client.loop_start()
 
while True:
    temperature = 10
    (rc, mid) = client.publish("encyclopedia/temperature", str(temperature), qos=1)
    time.sleep(5)

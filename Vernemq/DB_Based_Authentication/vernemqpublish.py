import paho.mqtt.client as paho
import time
 
def on_publish(client, userdata, mid):
    print("mid: "+str(mid))
 
client = paho.Client(client_id="test-client1",clean_session=True)
client.on_publish = on_publish
client.username_pw_set("test-user1","123")
client.connect("172.18.22.9", 1886)
client.loop_start()
 
while True:
    temperature = 10
    (rc, mid) = client.publish("a/b/c", str(temperature), qos=1)
    time.sleep(5)
    #print(client.getTopic())


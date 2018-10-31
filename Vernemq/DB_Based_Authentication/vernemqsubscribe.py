import paho.mqtt.client as paho
 
def on_subscribe(client, userdata, mid, granted_qos):
    print("Subscribed: "+str(mid)+" "+str(granted_qos))
 
def on_message(client, userdata, msg):
    print(msg.topic+" "+str(msg.qos)+" "+str(msg.payload))    
 
client = paho.Client(client_id="test-client",clean_session=True)
client.on_subscribe = on_subscribe
client.on_message = on_message
client.username_pw_set("test-user","123")
client.connect("172.18.22.9", 1884)
client.subscribe("a/b/c", qos=1) 
client.loop_forever()

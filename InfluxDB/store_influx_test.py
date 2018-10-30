import paho.mqtt.client as mqtt
from influxdb import InfluxDBClient
import datetime
import logging
import json
def persists(msg):
    msgobject=json.loads(msg)
    act=msgobject
    current_time = datetime.datetime.utcnow().isoformat()
    json_body = [
        {
            "measurement": "motion",
            "tags": {},
            "time": current_time,
            "fields": {
                "value": int(act)
            }
        }
    ]
    logging.info(json_body)
    influx_client.write_points(json_body)
logging.basicConfig(level=logging.INFO)
influx_client = InfluxDBClient('localhost', 8086, database='iot')
client = mqtt.Client()
client.on_connect = lambda self, mosq, obj, rc: self.subscribe("vjti/csriot/phdlab/motion1")
client.on_message = lambda client, userdata, msg: persists(msg.payload)
client.connect("localhost", 1883, 60)
client.loop_forever()

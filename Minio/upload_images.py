#!/usr/bin/python
import datetime, time, os
from picamera import PiCamera
from time import sleep
from minio import Minio
from minio.error import (ResponseError, BucketAlreadyOwnedByYou,
                         BucketAlreadyExists)
#Initialize camera module
camera=PiCamera()

# Initialize minioClient with an endpoint and access/secret keys.
minioClient = Minio('172.18.22.9:9000',
                    access_key='AKIAIOSFODNN734dfhdfh',
                    secret_key='sdfjk335jlkAefldkfjs8s7989sd',
                    secure=False)



camera.rotation = -90 #Rotate camera image by 90 degree anti-clkwise
prefix="00000"
try:
    ts = time.time()
    st = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d_%H:%M:%S')
    camera.capture('/home/pi/cron'+st+'.jpeg', format = 'jpeg', resize = None)
    minioClient.fput_object('iotlab3', (st+'.jpeg'), '/home/pi/cron'+st+".jpeg")
    os.remove(('/home/pi/cron'+st+'.jpeg')) #Deleting the file after it has been uploaded to the object
finally:
    camera.close() #Free up camera resources

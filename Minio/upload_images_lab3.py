#!/usr/bin/python
from scipy import ndimage
from PIL import Image
import datetime, time, os
from picamera import PiCamera
from time import sleep
from minio import Minio
from minio.error import (ResponseError, BucketAlreadyOwnedByYou,
                         BucketAlreadyExists)
#Initialize camera module
camera=PiCamera()
start_time = time.time()
# Initialize minioClient with an endpoint and access/secret keys.
minioClient = Minio('172.18.22.9:9000',
                    access_key='AKIAIOSFODNN734dfhdfh',
                    secret_key='sdfjk335jlkAefldkfjs8s7989sd',
                    secure=False)



#camera.rotation = -90 #Rotate camera image by 90 degree anti-clkwise
prefix="00000"
try:
    ts = time.time()
    st = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d_%H:%M:%S')
    original_filepath = '/home/pi/cron'+st+'.jpeg'
    rotated_filepath = '/home/pi/cron/rotated_image.jpeg'
    camera.capture(original_filepath)
    im1 = Image.open(original_filepath,mode='r')
    im1 = ndimage.rotate(im1, 90)
    im = Image.fromarray(im1,mode='RGB')
    im.save(rotated_filepath,quality=100)
    minioClient.fput_object('iotlab31', (st+'.jpeg'), rotated_filepath)
    os.remove(rotated_filepath)
    os.remove(original_filepath) #Deleting the file after it has been uploaded to the object
finally:
    camera.close() #Free up camera resources

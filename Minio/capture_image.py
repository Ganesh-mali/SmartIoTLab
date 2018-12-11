#!/usr/bin/python
from picamera import PiCamera
from time import sleep
camera=PiCamera()
camera.image_effect = 'denoise'
#camera.rotation = -90
prefix="00000"
try:
    for i in range(0,5):
        sleep(2)
        camera.capture('/home/pi/cron/newimage'+prefix[:(len(prefix)-(i/10))]+str(i)+'.jpeg')
finally:
    camera.close()

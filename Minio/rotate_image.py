#!/usr/bin/python
from picamera import PiCamera
import time
from time import sleep
from scipy import ndimage
from PIL import Image

camera=PiCamera()
camera.image_effect = 'denoise'
#camera.rotation = -90
prefix="00000"
start_time = time.time()
try:
    for i in range(0,5):
        sleep(2)
        filepath = '/home/pi/cron/newimage'+prefix[:(len(prefix)-(i/10))]+str(i)+'.jpeg'
        camera.capture(filepath)
        im1 = Image.open(filepath,mode='r')
        im1 = ndimage.rotate(im1, 90)
        im = Image.fromarray(im1,mode='RGB')
        im.save("rotated_file.jpeg",quality=100)
finally:
    camera.close()
end_time=time.time()
print(end_time-start_time)



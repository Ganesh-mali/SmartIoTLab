from picamera import PiCamera
from time import sleep
camera=PiCamera()
#camera.rotation = -90
prefix="00000"
try:
    camera.start_preview()
    time.sleep(2)
finally:
    camera.close()


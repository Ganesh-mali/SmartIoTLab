from picamera import PiCamera
from time import sleep
camera = PiCamera()
camera.start_preview(alpha=200)
time.sleep(30)
camera.stop_preview()

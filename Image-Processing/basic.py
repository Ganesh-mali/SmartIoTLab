# -*- coding: utf-8 -*-
#In this program basic image manipulation is demonstrated

#Importing packages
import cv2
import numpy as np
from matplotlib import pyplot as plt
from copy import deepcopy #to copy image

#Basic operation on images
img = cv2.imread(r"C:\Users\iot\Downloads\Analyse\2019-01-07_16_45_03.jpeg",1) #0 grayscale 1 RGB is for reading
#cv2.namedWindow("image",cv2.WINDOW_NORMAL)
def display(image):
    #cv2.namedWindow("image",cv2.WINDOW_NORMAL)
    cv2.imshow("image",image)
    cv2.waitKey(0) #wait #time duration in milliseconds, if specified 0 then it waits indefinitely
    cv2.destroyAllWindows() #destroy the window

display(img)

circle = cv2.circle(img, (780,1280),400,(0,0,255),-1) #OpenCV uses BGR instead of RGB combination,(780,1280) coordinate
    #of center, radius - 100, color and thickness
display(circle) #Circle not showing up

img1 = deepcopy(circle)
display(img1)

img2 = cv2.imread(r"C:\Users\iot\Downloads\Analyse\2019-01-07_16_50_03.jpeg",1)
display(img2)

def click2circle(x,y,flags,param):
    if event == cv2.EVENT_LBUTTONDBLCLK :
            cv2.circle(img2, (x,y), 50, (255,0,0),4)
    
cv2.namedWindow("differences",cv2.WINDOW_NORMAL)
cv2.setMouseCallback("differences",click2circle)

while True:
    cv2.imshow("differences",img2)
    a = cv2.waitKey(2000)
    print("2 seconds")
    if a == 27: #wait for escape command
        break
cv2.destroyAllWindows()

#Splitting channels and map algebra
b,g,r = cv2.split(img2)
display(g) #displaying individual channels
display(g-r)

imgcol2 = cv2.merge((b,g,r))  #Merge the band to get the original image
display(imgcol2)

#Resizing cropping and exporting images
imgres = cv2.resize(img2,dsize=None, fx=0.4,fy=0.4,interpolation=cv2.INTER_CUBIC) #dsize is used if we want to apply universal scaling factor to our image
#fx scaling factor(0.2 means resize by 1/5), interpolation is uses neightborhood pixels to determing the intensity of the next pixel
cv2.imshow("window",imgres)
cv2.waitKey(0)
cv2.destroyAllWindows()

#Cropping the image
cropped = img2[470:720,0:479] #start y and end y, start x and end x
display(cropped)
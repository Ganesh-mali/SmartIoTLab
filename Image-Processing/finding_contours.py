# -*- coding: utf-8 -*-
import cv2
import numpy as np
from ip_functions import display

img1 =cv2.imread("E:\\SmartIoTLab\\Images\\Contours\\3.jpeg")
img1 = img1.copy()
img3 = cv2.cvtColor(img1, cv2.COLOR_BGR2GRAY)
img2 =cv2.imread("E:\\SmartIoTLab\\Images\\Contours\\4.jpeg",0)
img2 = img2.copy()
diff=cv2.absdiff(img3,img2)
#_,thresh1 = cv2.threshold(diff,27,255,cv2.THRESH_BINARY)
ret,thresh = cv2.threshold(diff,27,255,0)
display(thresh,"Thresholded")
image, contours, heirarchy = cv2.findContours(thresh,cv2.RETR_TREE,cv2.CHAIN_APPROX_SIMPLE)
for i in range(0, len(contours)):
    print("Printing Area "+str(cv2.contourArea(contours[i])))
    print("Printing Arc Length "+str(cv2.arcLength(contours[i],True)))
img1 = cv2.drawContours(img2, contours, -1, (0,255,0) ,1)
display(img1,"Thresholded_image")


# -*- coding: utf-8 -*-
import cv2
from ip_functions import display,homo_morph
import pymunk.matplotlib_util
i = 18
img1 = cv2.imread("E:\SmartIoTLab\Images\Brightness_difference_getting_captured_3x3\in\\original"+str(i)+".jpeg",0)
matplotlib_utils.impixelinfo(None, img1)
imgColor = cv2.imread("E:\SmartIoTLab\Images\Brightness_difference_getting_captured_3x3\in\\original"+str(i)+".jpeg",1)
img2 = cv2.imread("E:\SmartIoTLab\Images\Brightness_difference_getting_captured_3x3\in\\original"+str(i+1)+".jpeg",0)
img3 = homo_morph(img1, "img1-gauss","g")
img4 = homo_morph(img2, "img2-gauss","g")
diff=cv2.absdiff(img1,img2)
display(diff,"Displaying-Difference")
_,thresh = cv2.threshold(diff,27,255,cv2.THRESH_BINARY)
#display(thresh1,"Showing thresholded")
display(thresh,"Showing inverted")
image, contours, heirarchy = cv2.findContours(thresh,cv2.RETR_TREE,cv2.CHAIN_APPROX_SIMPLE)
for i in range(0, len(contours)):
    print("Printing Area "+str(cv2.contourArea(contours[i])))
    print("Printing Arc Length "+str(cv2.arcLength(contours[i],True)))
    if(cv2.contourArea(contours[i])>=10 and cv2.contourArea(contours[i])<=50000):
        imgColor = cv2.drawContours(imgColor, [contours[i]], 0, (0,255,0) ,1)
display(imgColor,"Thresholded_image")
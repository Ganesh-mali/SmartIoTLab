# -*- coding: utf-8 -*-
import cv2
import numpy as np

def display(image,name):
    #cv2.namedWindow("image",cv2.WINDOW_NORMAL)
    cv2.imshow(name,image)
    cv2.waitKey(0) #wait #time duration in milliseconds, if specified 0 then it waits indefinitely
    #cv2.destroyAllWindows() #destroy the window
    
img1 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-11_14_00_04.jpeg",0)
img2 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-11_14_05_03.jpeg",0)
vis=np.concatenate((img1,img2),axis=1)
cv2.imwrite('out.png', vis)
combined = cv2.imread(r"out.png", 0)
display(combined,"Combined")
cv2.waitKey(0)
cv2.destroyAllWindows()



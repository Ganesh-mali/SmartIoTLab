import cv2
import numpy as np
from ip_functions import display

img1 =cv2.imread("E:\\SmartIoTLab\\Images\\Contours\\7.jpeg",0)
img3 =cv2.imread("E:\\SmartIoTLab\\Images\\Contours\\7.jpeg")
img4 = img3.copy()
img2 =cv2.imread("E:\\SmartIoTLab\\Images\\Contours\\8.jpeg",0)
X = np.random.randint(10,size=(720, 480),dtype=np.uint8)
for i in range (0,720):
    for j in range(0,480):
        val1=img1[i][j]
        val2=img2[i][j]
        if(val1 == 0 or val2 == 0):
            if(val1 == 0):
                temp = val2
            else:
                temp = val1
        else:
            if(val1>=182 or val2>=182):
                temp = 0
            else:
                if(val1>=val2):
                    temp = abs(val1-val2)
                else:
                    temp = abs(val2-val1)
        X[i][j]=temp
ret,thresh1 = cv2.threshold(X,27,255,0)
display(thresh1,"Thresholded-Manual")
img3 =cv2.absdiff(img1,img2)
ret,thresh1 = cv2.threshold(img3,27,255,0)
display(thresh1,"Thresholded-Library")
image, contours, heirarchy = cv2.findContours(thresh1,cv2.RETR_TREE,cv2.CHAIN_APPROX_SIMPLE)

for i in range(0, len(contours)):
    print("Printing Area "+str(cv2.contourArea(contours[i])))
    print("Printing Arc Length "+str(cv2.arcLength(contours[i],True)))
img5 = cv2.drawContours(img4, contours, -1, (0,255,0) ,1)
display(img5,"Image_with_contour")
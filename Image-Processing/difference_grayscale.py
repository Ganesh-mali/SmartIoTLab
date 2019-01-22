# -*- coding: utf-8 -*-
import cv2
from PIL import Image
import numpy as np
def display(image,name):
    #cv2.namedWindow("image",cv2.WINDOW_NORMAL)
    cv2.imshow(name,image)
    cv2.waitKey(0) #wait #time duration in milliseconds, if specified 0 then it waits indefinitely
    #cv2.destroyAllWindows() #destroy the window

#Brightness issue with morphological kernel of size 3x3
img1 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-04_15_00_03.jpeg",0)
display(img1,"Original Image-1")
img2 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-04_15_05_03.jpeg",0)
display(img2,"Original Image-2")


# =============================================================================
# X = np.random.randint(10,size=(720, 480))
# for i in range (0,719):
#     for j in range(0,479):
#         val1=img1[i][j]
#         val2=img2[i][j]
#         if(val1>=val2):
#             temp=val1%val2
#         else:
#             temp=val2%val1
#         X[i][j]=int(temp)
# =============================================================================
        #print(temp)
        #print(X[i][j])
diff=cv2.absdiff(img1,img2)
display(diff,"grayscale_difference")


# =============================================================================
# ret, thresh1 = cv2.threshold(diff,80,255,cv2.THRESH_BINARY)
# display(thresh1,"After-Thresholding-Binary")
# =============================================================================

thresh1 = cv2.adaptiveThreshold(diff,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
            cv2.THRESH_BINARY,11,2)
display(thresh1,"After-Thresholding-Adaptive-Gaussian")

inverted=thresh1
cv2.bitwise_not(thresh1,inverted)  #(src,dest)
display(inverted,"Inverted-Image")

kernel = np.ones((5,5),np.uint8)
opening = cv2.morphologyEx(inverted, cv2.MORPH_OPEN, kernel,iterations=1)
display(opening,"Erosion-Dilation")
cv2.imwrite("gray_scale_diff1.jpeg",opening)







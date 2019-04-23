import cv2
import numpy as np
from ip_functions import display

img1 =cv2.imread("E:\\SmartIoTLab\\Images\\Contours\\kerchief.png",0)
with open('array1_diff.txt', 'w') as f:
    for i in range (0,18):
        for j in range(0,25):
            f.write("%s \t" % img1[i][j])
        f.write("\n") 
# =============================================================================
# for i in range (0,37):
#     for j in range(0,70):
#         if(img1[i][j]>=210):
#             img1[i][j]=0
# display(img1,"Blacking-bright-pixels")
# =============================================================================

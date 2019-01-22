# -*- coding: utf-8 -*-
import cv2
import numpy as np
from matplotlib import pyplot as plt
def display(image,name):
    #cv2.namedWindow("image",cv2.WINDOW_NORMAL)
    cv2.imshow(name,image)
    cv2.waitKey(0) #wait #time duration in milliseconds, if specified 0 then it waits indefinitely
    #cv2.destroyAllWindows() #destroy the window

#Brightness issue with morphological kernel of size 3x3
# =============================================================================
# img1 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-10_09_20_03.jpeg",0)
# display(img1,"Original Image-1")
# img2 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-10_09_25_03.jpeg",0)
# display(img2,"Original Image-2")
# =============================================================================

#Some differences not getting detected
img1 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-04_15_00_03.jpeg",0)
display(img1,"Original Image-1")
img2 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-04_15_05_03.jpeg",0)
display(img2,"Original Image-2")
plt.hist(img1.ravel(),256,[0,256]) 
plt.show()
plt.hist(img2.ravel(),256,[0,256]) 
plt.show()

# =============================================================================
# for i in range (0,719):
#      for j in range(0,479):
#          if(img1[i][j]<=245):
#              img1[i][j]+=30
# 
# display(img1,"Image-1 added") 
# =============================================================================
# create a CLAHE object (Arguments are optional).
# =============================================================================
# clahe = cv2.createCLAHE(clipLimit=1.0, tileGridSize=(8,8))
# img1 = clahe.apply(img1)
# display(img1,"Image-1-CLAHE")
# =============================================================================

# =============================================================================
# img1 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-10_13_35_03.jpeg",0)
# display(img1,"Original Image-1")
# img2 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-10_13_40_03.jpeg",0)
# display(img2,"Original Image-2")
# =============================================================================

# =============================================================================
# img1 = cv2.imread(r"C:\Users\iot\Downloads\Analyse\2019-01-07_16_50_03.jpeg",0)
# display(img1,"Original Image-1")
# img2 = cv2.imread(r"C:\Users\iot\Downloads\Analyse\2019-01-07_16_55_03.jpeg",0)
# display(img2,"Original Image-2")
# =============================================================================

#img1crop = img1[470:720,0:479]
#img2crop = img2[470:720,0:479]

#Median Filtering
'''blur1 = cv2.medianBlur(img1,5)
blur2 = cv2.medianBlur(img2,5)'''

#Histogram Equalization
# =============================================================================
# img1 = cv2.equalizeHist(img1)
# img2 = cv2.equalizeHist(img2)
# display(img1,"Equalized-1")
# display(img1,"Equalized-2")
# =============================================================================

#Guassian Filtering
# =============================================================================
# blur1 = cv2.GaussianBlur(img1,(5,5),0)
# blur2 = cv2.GaussianBlur(img2,(5,5),0)
# =============================================================================
#display(blur1,"Gaussian Blurred-1")
#display(blur2,"Gaussian Blurred-2")
#np.savetxt('np.csv',(img1crop-img2crop), delimiter=',')
#display(img1-img2)
#diff = img2-img1
#ret, thresh1 = cv2.threshold(diff,127,255,cv2.THRESH_BINARY)
thresh2 = cv2.adaptiveThreshold(img1,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
            cv2.THRESH_BINARY,11,2)
thresh3 = cv2.adaptiveThreshold(img2,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
            cv2.THRESH_BINARY,11,2)
display(thresh2,"Thresholding-1")
display(thresh3,"Thresholding-2")
# =============================================================================
# _,thresh2 = cv2.threshold(blur1,0,255,cv2.THRESH_BINARY+cv2.THRESH_OTSU)
# _,thresh3 = cv2.threshold(blur2,0,255,cv2.THRESH_BINARY+cv2.THRESH_OTSU)
# =============================================================================


#Canny Edge detection
# =============================================================================
# edges1 = cv2.Canny(blur1,100,200)
# display(edges1,"edge_detection_1")
# edges2 = cv2.Canny(blur2,100,200)
# display(edges1,"edge_detection_2")
# diff1=edges1-edges2
# diff2=edges2-edges1
# display(diff1,"Diff in edges 1-2")
# display(diff2,"Diff in edges 2-1")
# =============================================================================


#display(thresh2,"Threshold-1")
#display(thresh3,"Threshold-2")
diff1=cv2.subtract(thresh2,thresh3)
diff2=cv2.subtract(thresh3,thresh2)
#display(rawdiff,"Diff in threshold 1-2 raw")
#display(diff1,"Diff in threshold 1-2")
kernel = np.ones((5,5),np.uint8)
opening1 = cv2.morphologyEx(diff1, cv2.MORPH_OPEN, kernel,iterations=1)
kernel = np.ones((5,5),np.uint8)
opening2 = cv2.morphologyEx(diff2, cv2.MORPH_OPEN, kernel,iterations=1)
display(opening1,"morphological-1")
display(opening2,"morphological-2")
combine = cv2.add(opening1,opening2)
display(combine,"combined") 
cv2.imwrite("diff_later_combined.jpeg",combine)
flag=False;
section_1=0;
section_2=0;
section_1_text=""
section_2_text=""
for i in range (0,359):
    for j in range(0,479):
        if(combine[i][j]==255):
            section_1=1;
            flag=True;
            break;
    if flag==True:
        break;
flag=False;
for i in range (360,719):
    for j in range(0,479):
        if(combine[i][j]==255):
            section_2=1;
            flag=True;
            break;
    if flag==True:
        break;
print("Motion in section 1 "+str(section_1))
print("Motion in section 2 "+str(section_2))

#Setting the motion text
if section_1 == 0:
    section_1_text = "No Motion"
else:
    section_1_text="Motion"

if section_2 == 0:
    section_2_text = "No Motion"
else:
    section_2_text="Motion"

#rgb_img2 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-10_09_25_03.jpeg",1)
rgb_img2 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-04_15_00_03.jpeg",1)
#rgb_img2 = cv2.imread(r"E:\SmartIoTLab\Images\2019-01-10_13_40_03.jpeg",1)
font = cv2.FONT_HERSHEY_SIMPLEX
cv2.putText(rgb_img2, "Section:1 "+section_1_text, (0,20),font,0.7,(0,0,255),1,cv2.LINE_AA)
cv2.rectangle(rgb_img2,(0,0),(479,359),(0,255,0),1)
cv2.putText(rgb_img2, "Section:2 "+section_2_text, (0,359+20),font,0.7,(0,0,255),1,cv2.LINE_AA)
cv2.rectangle(rgb_img2,(0,360),(479,719),(255,0,0),1)
display(rgb_img2,"Annotated-Image")




#Counting number of white pixels in different sections of the image






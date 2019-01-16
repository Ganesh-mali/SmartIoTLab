# -*- coding: utf-8 -*-
#This module displays the OpenCV image
import cv2
import numpy as np
import os

def display(image,name):
    #cv2.namedWindow("image",cv2.WINDOW_NORMAL)
    cv2.imshow(name,image)
    cv2.waitKey(0) #wait #time duration in milliseconds, if specified 0 then it waits indefinitely
    #cv2.destroyAllWindows() #destroy the window

def combine(img1,img2,name):
    vis=np.concatenate((img1,img2),axis=1)
    cv2.imwrite('E:\SmartIoTLab\Images\For_Study\Output\\'+name+'.jpeg', vis)

def save(img,name):
    cv2.imwrite('E:\SmartIoTLab\Images\For_Study\Output\\'+name+'.jpeg',img)
#This function annotates the image
def annotate(binary_img,rgb_img2):
    flag=False;
    section_1=0;
    section_2=0;
    section_1_text=""
    section_2_text=""
    for i in range (0,449):
        for j in range(0,479):
            if(binary_img[i][j]==255):
                section_1=1;
                flag=True;
                break;
        if flag==True:
            break;
    flag=False;
    for i in range (450,719):
        for j in range(0,479):
            if(binary_img[i][j]==255):
                section_2=1;
                flag=True;
                break;
        if flag==True:
            break;
    #print("Motion in section 1 "+str(section_1))
    #print("Motion in section 2 "+str(section_2))
    
    #Setting the motion text
    if section_1 == 0:
        section_1_text = "No Motion"
    else:
        section_1_text="Motion"
    
    if section_2 == 0:
        section_2_text = "No Motion"
    else:
        section_2_text="Motion"

    font = cv2.FONT_HERSHEY_SIMPLEX
    cv2.putText(rgb_img2, "Section:1 "+section_1_text, (0,20),font,0.7,(0,0,255),1,cv2.LINE_AA)
    cv2.rectangle(rgb_img2,(0,0),(479,449),(0,255,0),1)
    cv2.putText(rgb_img2, "Section:2 "+section_2_text, (0,449+20),font,0.7,(0,0,255),1,cv2.LINE_AA)
    cv2.rectangle(rgb_img2,(0,450),(479,719),(255,0,0),1)
    return rgb_img2,section_1,section_2 

def load_images_from_folder(folder):
    images = []
    for filename in os.listdir(folder):
        img = cv2.imread(os.path.join(folder,filename))
        if img is not None:
            images.append(img)
    return images
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

def homo_morph(img,name,filter_type):
    d_zero = 30
    c = 2
    y_h = 1.5
    y_l = 0.75
    
    #Step 1: Take the log of the image
    I_log = np.log1p(np.array(img,dtype='float'))
    
    #Step 2: Take Fast Fourier Transform
    I_fft =np.fft.fft2(I_log) #2 Dimensional Fourier Transform
    
    if(filter_type=="g"):
        #Step 3: Apply the Gaussian Filter
        I_shape = I_fft.shape
        P = I_shape[0]/2
        Q = I_shape[1]/2 
        U, V = np.meshgrid(range(I_shape[0]), range(I_shape[1]), sparse=False, indexing='ij')
        Duv = np.sqrt((((U-P)**2+(V-Q)**2))).astype(float)  #np.sqrt is redundant as we are going to square this quantity in the next step
        H = np.exp((-(c*(Duv**2))/(d_zero**2)))
        H_u = (y_h - y_l) * (1-H) + y_l
        
        H_u = np.fft.fftshift(H_u)
        I_fft_filt = H_u*I_fft
    
    #Butterworth Filter
    if(filter_type=='b'):
        n = 3
        d_zero = 120
        y_h = 1.002
        y_l = 1.115
        I_shape = I_fft.shape
        P = I_shape[0]/2
        Q = I_shape[1]/2 
        U, V = np.meshgrid(range(I_shape[0]), range(I_shape[1]), sparse=False, indexing='ij')
        Duv = np.sqrt((((U-P)**2+(V-Q)**2))).astype(float)
        H = 1/(1+(d_zero/Duv)**(2*n))
        H_u = (y_h - y_l) * (1-H) + y_l
        H_u = np.fft.fftshift(H_u)
        I_fft_filt = H_u * I_fft
    
    
    #Step 4: Do the Inverse FFT
    I_filt = np.fft.ifft2(I_fft_filt)
            
    #Step 5: Take Exponential of the components
    I = np.exp(np.real(I_filt))-1
    final_img = np.uint8(I)
    display(final_img, name)
    return final_img
    #color_img = cv2.cvtColor(final_img,cv2.COLOR_GRAY2RGB)
    #display(color_img, name+"1")

def modified_annotate(binary_img,rgb_img2):
    section_1=0;
    section_2=0;
    section_1_text=""
    section_2_text=""
    count_section_1 = 0
    count_section_2 = 0
    for i in range (0,449):
        for j in range(0,479):
            if(binary_img[i][j]==255):
                count_section_1+=1;
    if(count_section_1>=100):
        section_1 = 1
    for i in range (450,719):
        for j in range(0,479):
            if(binary_img[i][j]==255):
                count_section_2+=1
    if(count_section_2>=100):
        section_2 = 1
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

def count_white_pixels(binary_img):
    count_section_1 = 0
    count_section_2 = 0
    for i in range (0,449):
        for j in range(0,479):
            if(binary_img[i][j]==255):
                count_section_1+=1;
    for i in range (450,719):
        for j in range(0,479):
            if(binary_img[i][j]==255):
                count_section_2+=1
    print("Count White Pixels Section 1 ",count_section_1)
    print("Count White Pixels Section 2 ",count_section_2)

def avg_diff(img1, img2):    
    img5 = cv2.absdiff(img1,img2)
    total = 0
    for m in range (0,720):
        for n in range(0,480):
            total+=img5[m][n]
    
    total/=255
    return total
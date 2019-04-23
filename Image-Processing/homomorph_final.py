# -*- coding: utf-8 -*-
import cv2
import numpy as np
import math
from ip_functions import display,save,avg_diff

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

#Step 0: Read the image
img1 = cv2.imread(r"E:\SmartIoTLab\Images\Contours\28.jpeg",0)
img2 = cv2.imread(r"E:\SmartIoTLab\Images\Contours\29.jpeg",0)
# =============================================================================
# =============================================================================
display(img1,"Gray-scale Image")
# save(img1,"gray-original8")
# =============================================================================
# =============================================================================
img3 = homo_morph(img1,"Image-8-Gaussian","g")
img4 = homo_morph(img2,"Image-8-Gaussian","g")

total = avg_diff(img1,img2)

X = np.random.randint(10,size=(720, 480),dtype=np.uint8)
for m in range (0,720):
    for n in range(0,480):
        val1=img3[m][n]
        val2=img4[m][n]
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
        X[m][n]=temp
        #diff=cv2.absdiff(img1,img2)
# =============================================================================
#         plt.hist(diff.ravel(),256,[0,256])
#         plt.show()
# =============================================================================
display(X,"Showing difference")

#display(img,"Gray-scale Image")
# =============================================================================
# save(img,"gauss-original8")
#img = homo_morph(img1,"Image-8-Butterworth","b") 
# save(img,"butterworth-original8")
# =============================================================================





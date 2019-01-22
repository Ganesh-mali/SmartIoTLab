# -*- coding: utf-8 -*-
"""
Created on Fri Jan  4 16:09:47 2019

@author: Dhanshree
"""

import numpy as np
import cv2
from numba import jit
import os
from matplotlib import pyplot as plt
import math
import csv
from sklearn import preprocessing


image1 = cv2.imread(r"C:\Users\iot\Downloads\Analyse\2019-01-07_16_45_03.jpeg")
cv2.imshow('lab1',image1)
cv2.waitKey(0) 
cv2.destroyAllWindows()

image2 = cv2.imread(r"C:\Users\iot\Downloads\Analyse\2019-01-07_16_50_03.jpeg")
cv2.imshow('lab2',image2)
cv2.waitKey(0) 
cv2.destroyAllWindows()

# covert to GRAY       
gray_scale1 = cv2.cvtColor(image1,cv2.COLOR_BGR2GRAY)
# contast limited adaptive Histogarm Equalization 
clahe = cv2.createCLAHE(clipLimit=2.0, tileGridSize=(8,8))
contrast_enhanced_fundus1 = clahe.apply(gray_scale1)
cv2.imshow('lab3',contrast_enhanced_fundus1)
cv2.waitKey(0) 
#cv2.destroyAllWindows()
   
ret,fin1 = cv2.threshold(contrast_enhanced_fundus1,25,255,cv2.THRESH_BINARY_INV)
cv2.imshow('lab4',fin1)
cv2.waitKey(0) 
#cv2.destroyAllWindows()
#complements the image
fundus_eroded1 = cv2.bitwise_not(fin1)    

edge_result1 = cv2.Canny(fin1,30,100)
cv2.imshow('lab5',edge_result1)
cv2.waitKey(0) 
cv2.destroyAllWindows()


gray_scale2 = cv2.cvtColor(image2,cv2.COLOR_BGR2GRAY)
# contast limited adaptive Histogarm Equalization 
clahe = cv2.createCLAHE(clipLimit=2.0, tileGridSize=(8,8))
contrast_enhanced_fundus2 = clahe.apply(gray_scale2)  
cv2.imshow('lab6',contrast_enhanced_fundus2)
cv2.waitKey(0) 
#cv2.destroyAllWindows()
 
ret,fin2 = cv2.threshold(contrast_enhanced_fundus2,25,255,cv2.THRESH_BINARY_INV)
cv2.imshow('lab7',fin2)
cv2.waitKey(0) 
#cv2.destroyAllWindows()
#complements the image
fundus_eroded2 = cv2.bitwise_not(fin2)  

edge_result2 = cv2.Canny(fin2,30,100) #Earlier value 30-100
cv2.imshow('lab8',edge_result2)
cv2.waitKey(0) 
#cv2.destroyAllWindows()

# =============================================================================
# i = 0
# j = 0
# while i < image1.shape[0]:
#     j = 0
#     while j < image1.shape[1]:
#         if edge_result1[i,j] == 255 and edge_result2[i,j] == 255:
#             edge_result2[i,j] = 0
#         j = j+1
#     i = i+1
# newfin = cv2.dilate(edge_result2, cv2.getStructuringElement(cv2.MORPH_ELLIPSE,(5,5)), iterations=1)
# =============================================================================

temp = cv2.absdiff(edge_result1,edge_result2)
cv2.imshow('diff',temp)
cv2.waitKey(0) 
cv2.destroyAllWindows()

cv2.imshow('lab9',newfin)
cv2.waitKey(0) 
cv2.destroyAllWindows()

      

        
        
       
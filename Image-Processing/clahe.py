# -*- coding: utf-8 -*-
#Contrast Limited Adaptive Histogram Equalization
import numpy as np
from ip_functions import display
import cv2
img = cv2.imread(r'E:\SmartIoTLab\Images\Brightness_difference_getting_captured_3x3\in\original1.jpeg',0)
clahe = cv2.createCLAHE(clipLimit=2.0, tileGridSize=(8,8))
cl1 = clahe.apply(img)
display(cl1,"CLAHE-Image")

# -*- coding: utf-8 -*-
import cv2
#from ip_functions import display
from matplotlib import pyplot as plt
i=0
img1 = cv2.imread("E:\\SmartIoTLab\\Images\\Dataset\\Dataset3\\"+str(i)+".jpeg",0)
img2 = cv2.imread("E:\\SmartIoTLab\\Images\\Dataset\\Dataset3\\"+str(i+1)+".jpeg",0)
diff=cv2.absdiff(img1,img2)
plt.hist(diff.ravel(),256,[0,256])
plt.show()


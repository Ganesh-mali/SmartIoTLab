#Used for mass annotation of image from the given directory
import cv2
from ip_functions import load_images_from_folder
images=[]
images=load_images_from_folder("E:\SmartIoTLab\Images\Dataset\Dataset2_wo_boundary")
for i in range(0,len(images)):
    img = images[i]
    font = cv2.FONT_HERSHEY_SIMPLEX
    cv2.rectangle(img,(0,0),(479,449),(0,255,0),1)
    cv2.rectangle(img,(0,450),(479,719),(255,0,0),1)
    cv2.imwrite('E:\SmartIoTLab\Images\Dataset\Dataset2\\'+str(i)+'.jpeg',img)
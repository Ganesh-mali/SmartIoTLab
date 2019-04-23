#Used for mass annotation of image from the given directory
#it renames the files and also makes the rectangular boundary
import cv2
from ip_functions import load_images_from_folder
images=[]
images=load_images_from_folder("E:\SmartIoTLab\Images\Dataset\Original_Dataset_with_Timestamp\\28-01-19")
for i in range(0,len(images)):
    img = images[i]
    cv2.imwrite('E:\SmartIoTLab\Images\Dataset\Dataset4\woboundary\\'+str(i)+'.jpeg',img)
import cv2
import numpy as np
from ip_functions import combine,annotate,save,display

# =============================================================================
# This function works in following steps
#     1. It reads the grayscale image
#     2. It performs adaptive thresholding on the image
#     3. It takes absolute difference of the two thresholded image
#     4. Finally it applied morphological transformation on the image obtained in setp 3
# =============================================================================
def function1():
    img1 = cv2.imread(r"E:\SmartIoTLab\Images\For_Study\Set10\1.jpeg",0)
    img2 = cv2.imread(r"E:\SmartIoTLab\Images\For_Study\Set10\2.jpeg",0)
    rgb_img1 = cv2.imread(r"E:\SmartIoTLab\Images\For_Study\Set10\1.jpeg",1)
    rgb_img2 = cv2.imread(r"E:\SmartIoTLab\Images\For_Study\Set10\2.jpeg",1)
    
    combine(rgb_img1,rgb_img2,"Set10-Combined-RGB")
    
    thresh2 = cv2.adaptiveThreshold(img1,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
            cv2.THRESH_BINARY,11,2)
    thresh3 = cv2.adaptiveThreshold(img2,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
            cv2.THRESH_BINARY,11,2)
    
    diff=cv2.absdiff(thresh2,thresh3)
    display(diff,"Displaying-Diff")
    rgb_img2 = cv2.imread(r"E:\SmartIoTLab\Images\For_Study\Set10\2.jpeg",1)
    eroding(3,1,diff,rgb_img2,"Method-1")

#calling the two diferent processing functions
def eroding(i,j,open_i,rgb_img2,method):
    kernel = np.ones((i,i),np.uint8)
    eroding = cv2.erode(open_i, kernel, iterations=j)
    display(eroding,"Eroded-the-image"+method)
    rgb_img2,_,_ = annotate(eroding,rgb_img2)
    save(eroding,"Set10-After morphological operation_"+method+"_kernel_"+str(i)+"iteration_"+str(j))
    save(rgb_img2,"Set10-annotated_"+method+"_kernel_"+str(i)+"iteration_"+str(j))

def function2():
    img1 = cv2.imread(r"E:\SmartIoTLab\Images\For_Study\Set10\1.jpeg",0)
    img2 = cv2.imread(r"E:\SmartIoTLab\Images\For_Study\Set10\2.jpeg",0)
    rgb_img1 = cv2.imread(r"E:\SmartIoTLab\Images\For_Study\Set10\1.jpeg",1)
    rgb_img2 = cv2.imread(r"E:\SmartIoTLab\Images\For_Study\Set10\2.jpeg",1)
    combine(rgb_img1,rgb_img2,"Set9-Combined-RGB")
    diff=cv2.absdiff(img1,img2)
    thresh1 = cv2.adaptiveThreshold(diff,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
                        cv2.THRESH_BINARY,11,2)
    inverted=thresh1
    cv2.bitwise_not(thresh1,inverted)  #(src,dest)
    #combine(diff,inverted,"Set9-Difference_and_Thresholded")
    eroding(3,1,inverted,rgb_img2,"Method-2")
      

function1() 
function2()
a=np.zeros((100,2))
a[0][1]=10





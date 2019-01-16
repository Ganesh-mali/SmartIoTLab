import cv2
import numpy as np
from ip_functions import annotate,load_images_from_folder

ground_truth=np.zeros((3,2))
ground_truth[0][0]=0
ground_truth[0][1]=1
ground_truth[1][0]=0
ground_truth[1][1]=0
ground_truth[2][0]=1
ground_truth[2][1]=1

print(ground_truth)
# =============================================================================
# This function works in following steps
#     1. It reads the grayscale image
#     2. It takes their absolute difference
#     3. It performs adaptive thresholding
#     4. Finally it applies morphological transformation on the image
# =============================================================================
def function1():
    images=[]
    images=load_images_from_folder("E:\SmartIoTLab\Images\For_Study\FinalSet")
    a=np.zeros((len(images)-1,16))
    for i in range(0,len(images)-1):
        img1 = cv2.cvtColor(images[i],cv2.COLOR_BGR2GRAY)
        img2 = cv2.cvtColor(images[i+1],cv2.COLOR_BGR2GRAY)
        rgb_img2 = images[i+1].copy()
        thresh2 = cv2.adaptiveThreshold(img1,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
            cv2.THRESH_BINARY,11,2)
        thresh3 = cv2.adaptiveThreshold(img2,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
            cv2.THRESH_BINARY,11,2)
        diff=cv2.absdiff(thresh2,thresh3)
        count_kernel_steps=0
        for j in range(2,6):
            for k in range(1,3): 
                count_kernel_steps+=1
                section_1,section_2 = opening(j,k,diff,rgb_img2,"Method-1")
                #   print("Output: Section1: "+str(section_1)+", Section2: "+str(section_2))
                a[i][(2*count_kernel_steps-2)]=section_1
                a[i][(2*count_kernel_steps-1)]=section_2
    print(a)
    return a        

# =============================================================================
# This function works in following steps
#     1. It reads the grayscale image
#     2. It takes their absolute difference
#     3. It performs adaptive thresholding
#     4. Finally it applied morphological transformation on the image
# =============================================================================
def function2():
    images=[]
    images=load_images_from_folder("E:\SmartIoTLab\Images\For_Study\FinalSet")
    b=np.zeros((len(images)-1,16))
    for i in range(0,len(images)-1):
        img1 = cv2.cvtColor(images[i],cv2.COLOR_BGR2GRAY)
        img2 = cv2.cvtColor(images[i+1],cv2.COLOR_BGR2GRAY)
        rgb_img2 = images[i+1].copy()
        diff=cv2.absdiff(img1,img2)
        thresh1 = cv2.adaptiveThreshold(diff,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
                        cv2.THRESH_BINARY,11,2)
        inverted=thresh1
        cv2.bitwise_not(thresh1,inverted)  #(src,dest)
        count_kernel_steps=0
        for j in range(2,6):
            for k in range(1,3):
                count_kernel_steps+=1
                section_1,section_2 = opening(j,k,inverted,rgb_img2,"Method-1")
                #print("Output: Section1: "+str(section_1)+", Section2: "+str(section_2))
                b[i][(2*count_kernel_steps-2)]=section_1
                b[i][(2*count_kernel_steps-1)]=section_2
    print(b)
    return b
#calling the two diferent processing functions
def opening(i,j,open_i,rgb_img2,method):
    kernel = np.ones((i,i),np.uint8)
    opening = cv2.morphologyEx(open_i, cv2.MORPH_OPEN, kernel,iterations=j)
    _,section_1,section_2 = annotate(opening,rgb_img2)
    return section_1,section_2

def find_accuracy(ground_truth,output_1,output_2):
    print("Method 1")
    for i in range(0,16):
        section_name=""
        #Method1
        model = output_1[:,[i]]
        if(i%2==0):
            section_name = "section_1"
            actual = ground_truth[:,[0]]
        else:
            section_name = "section_2"
            actual = ground_truth[:,[1]]
        count_true = 0
        count_false = 0
        for j in range(0,len(actual)):
            if(actual[j]==model[j]):
                count_true+=1
            else:
                count_false+=1
        percent = count_true / len(actual) * 100
        print(section_name+" : "+str(percent))
    print("Method 2")
    for i in range(0,16):   
        #Method2
        model = output_2[:,[i]]
        if(i%2==0):
            section_name = "section_1"
            actual = ground_truth[:,[0]]
        else:
            section_name = "section_2"
            actual = ground_truth[:,[1]]
        count_true = 0
        count_false = 0
        for j in range(0,len(actual)):
            if(actual[j]==model[j]):
                count_true+=1
            else:
                count_false+=1
        percent = count_true / len(actual) * 100
        print(section_name+" : "+str(percent))
        
        
output_1 = function1()
output_2 = function2()
find_accuracy(ground_truth,output_1,output_2)


    






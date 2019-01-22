#This is single iteration function
import cv2
import numpy as np
from ip_functions import combine,annotate,save,display,load_images_from_folder
from sklearn.metrics import confusion_matrix
ground_truth=np.zeros((120,2))
ground_truth[0][0]=1
ground_truth[0][1]=0
ground_truth[1][0]=1
ground_truth[1][1]=0
ground_truth[2][0]=1
ground_truth[2][1]=0
ground_truth[3][0]=1
ground_truth[3][1]=1
ground_truth[4][0]=1
ground_truth[4][1]=1
ground_truth[5][0]=1
ground_truth[5][1]=1
ground_truth[6][0]=1
ground_truth[6][1]=1
ground_truth[7][0]=1
ground_truth[7][1]=0
ground_truth[8][0]=1
ground_truth[8][1]=0
ground_truth[9][0]=1
ground_truth[9][1]=0
ground_truth[10][0]=1
ground_truth[10][1]=0
ground_truth[11][0]=1
ground_truth[11][1]=0
ground_truth[12][0]=1
ground_truth[12][1]=0
ground_truth[13][0]=1
ground_truth[13][1]=0
ground_truth[14][0]=1
ground_truth[14][1]=0
ground_truth[15][0]=1
ground_truth[15][1]=0
ground_truth[16][0]=1
ground_truth[16][1]=0
ground_truth[17][0]=1
ground_truth[17][1]=0
ground_truth[18][0]=1
ground_truth[18][1]=0
ground_truth[19][0]=1
ground_truth[19][1]=0
ground_truth[20][0]=1
ground_truth[20][1]=0
ground_truth[21][0]=1
ground_truth[21][1]=0
ground_truth[22][0]=1
ground_truth[22][1]=0
ground_truth[23][0]=1
ground_truth[23][1]=0
ground_truth[24][0]=1
ground_truth[24][1]=1
ground_truth[25][0]=1
ground_truth[25][1]=1
ground_truth[26][0]=1
ground_truth[26][1]=1
ground_truth[27][0]=1
ground_truth[27][1]=1
ground_truth[28][0]=1
ground_truth[28][1]=1
ground_truth[29][0]=0
ground_truth[29][1]=1
ground_truth[30][0]=0
ground_truth[30][1]=1
ground_truth[31][0]=1
ground_truth[31][1]=1
ground_truth[32][0]=1
ground_truth[32][1]=1
ground_truth[33][0]=0
ground_truth[33][1]=1
ground_truth[34][0]=1
ground_truth[34][1]=1
ground_truth[35][0]=1
ground_truth[35][1]=1
ground_truth[36][0]=1
ground_truth[36][1]=1
ground_truth[37][0]=1
ground_truth[37][1]=1
ground_truth[38][0]=1
ground_truth[38][1]=1
ground_truth[39][0]=1
ground_truth[39][1]=1
ground_truth[40][0]=1
ground_truth[40][1]=1
ground_truth[41][0]=1
ground_truth[41][1]=1
ground_truth[42][0]=1
ground_truth[42][1]=1
ground_truth[43][0]=1
ground_truth[43][1]=1
ground_truth[44][0]=1
ground_truth[44][1]=1
ground_truth[45][0]=1
ground_truth[45][1]=1
ground_truth[46][0]=1
ground_truth[46][1]=1
ground_truth[47][0]=1
ground_truth[47][1]=1
ground_truth[48][0]=1
ground_truth[48][1]=0
ground_truth[49][0]=1
ground_truth[49][1]=0
ground_truth[50][0]=1
ground_truth[50][1]=0
ground_truth[51][0]=1
ground_truth[51][1]=0
ground_truth[52][0]=1
ground_truth[52][1]=1
ground_truth[53][0]=1
ground_truth[53][1]=1
ground_truth[54][0]=1
ground_truth[54][1]=1
ground_truth[55][0]=1
ground_truth[55][1]=1
ground_truth[56][0]=1
ground_truth[56][1]=1
ground_truth[57][0]=1
ground_truth[57][1]=1
ground_truth[58][0]=1
ground_truth[58][1]=0
ground_truth[59][0]=1
ground_truth[59][1]=0
ground_truth[60][0]=1
ground_truth[60][1]=0
ground_truth[61][0]=1
ground_truth[61][1]=0
ground_truth[62][0]=1
ground_truth[62][1]=0
ground_truth[63][0]=1
ground_truth[63][1]=0
ground_truth[64][0]=1
ground_truth[64][1]=0
ground_truth[65][0]=1
ground_truth[65][1]=0
ground_truth[66][0]=1
ground_truth[66][1]=0
ground_truth[67][0]=1
ground_truth[67][1]=0
ground_truth[68][0]=1
ground_truth[68][1]=0
ground_truth[69][0]=1
ground_truth[69][1]=0
ground_truth[70][0]=1
ground_truth[70][1]=0
ground_truth[71][0]=1
ground_truth[71][1]=0
ground_truth[72][0]=1
ground_truth[72][1]=0
ground_truth[73][0]=1
ground_truth[73][1]=1
ground_truth[74][0]=1
ground_truth[74][1]=1
ground_truth[75][0]=1
ground_truth[75][1]=1
ground_truth[76][0]=1
ground_truth[76][1]=1
ground_truth[77][0]=1
ground_truth[77][1]=0
ground_truth[78][0]=1
ground_truth[78][1]=0
ground_truth[79][0]=1
ground_truth[79][1]=0
ground_truth[80][0]=1
ground_truth[80][1]=0
ground_truth[81][0]=1
ground_truth[81][1]=0
ground_truth[82][0]=1
ground_truth[82][1]=1
ground_truth[83][0]=1
ground_truth[83][1]=1
ground_truth[84][0]=1
ground_truth[84][1]=1
ground_truth[85][0]=0
ground_truth[85][1]=0
ground_truth[86][0]=0
ground_truth[86][1]=0
ground_truth[87][0]=0
ground_truth[87][1]=0
ground_truth[88][0]=0
ground_truth[88][1]=0
ground_truth[89][0]=0
ground_truth[89][1]=0
ground_truth[90][0]=0
ground_truth[90][1]=0
ground_truth[91][0]=0
ground_truth[91][1]=0
ground_truth[92][0]=0
ground_truth[92][1]=0
ground_truth[93][0]=0
ground_truth[93][1]=0
ground_truth[94][0]=1
ground_truth[94][1]=1
ground_truth[95][0]=1
ground_truth[95][1]=1
ground_truth[96][0]=1
ground_truth[96][1]=1
ground_truth[97][0]=1
ground_truth[97][1]=0
ground_truth[98][0]=1
ground_truth[98][1]=1
ground_truth[99][0]=1
ground_truth[99][1]=0
ground_truth[100][0]=1
ground_truth[100][1]=1
ground_truth[101][0]=1
ground_truth[101][1]=0
ground_truth[102][0]=1
ground_truth[102][1]=0
ground_truth[103][0]=1
ground_truth[103][1]=0
ground_truth[104][0]=1
ground_truth[104][1]=1
ground_truth[105][0]=1
ground_truth[105][1]=1
ground_truth[106][0]=1
ground_truth[106][1]=1
ground_truth[107][0]=1
ground_truth[107][1]=1
ground_truth[108][0]=1
ground_truth[108][1]=1
ground_truth[109][0]=1
ground_truth[109][1]=0
ground_truth[110][0]=1
ground_truth[110][1]=0
ground_truth[111][0]=1
ground_truth[111][1]=1
ground_truth[112][0]=1
ground_truth[112][1]=1
ground_truth[113][0]=1
ground_truth[113][1]=1
ground_truth[114][0]=1
ground_truth[114][1]=1
ground_truth[115][0]=1
ground_truth[115][1]=1
ground_truth[116][0]=1
ground_truth[116][1]=0
ground_truth[117][0]=1
ground_truth[117][1]=1
ground_truth[118][0]=1
ground_truth[118][1]=1
ground_truth[119][0]=1
ground_truth[119][1]=1
# =============================================================================
# This function works in following steps
#     1. It reads the grayscale image
#     2. It performs adaptive thresholding on the image
#     3. It takes absolute difference of the two thresholded image
#     4. Finally it applied morphological transformation on the image obtained in setp 3
# =============================================================================
def function1():
    a=np.zeros((120,2))
    for i in range(0,120):
        img1 = cv2.imread("E:\\SmartIoTLab\\Images\\For_Study\FinalSet\\"+str(i)+".jpeg",0)
        img2 = cv2.imread("E:\\SmartIoTLab\\Images\\For_Study\FinalSet\\"+str(i+1)+".jpeg",0)
        #display(img2,"displaying-images")
        rgb_img2 = cv2.imread("E:\\SmartIoTLab\\Images\\For_Study\FinalSet\\"+str(i+1)+".jpeg",1)
        thresh2 = cv2.adaptiveThreshold(img1,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
            cv2.THRESH_BINARY,11,2)
        thresh3 = cv2.adaptiveThreshold(img2,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
            cv2.THRESH_BINARY,11,2)
        diff=cv2.absdiff(thresh2,thresh3)
        section_1,section_2 = eroding(3,1,diff,rgb_img2,"Method-1")
        #   print("Output: Section1: "+str(section_1)+", Section2: "+str(section_2))
        a[i][0]=section_1
        a[i][1]=section_2
    print("Printing A")
    print(a)
    return a

def function2():   
    b=np.zeros((120,2))
    for i in range(0,120):
        img1 = cv2.imread("E:\\SmartIoTLab\\Images\\For_Study\FinalSet\\"+str(i)+".jpeg",0)
        img2 = cv2.imread("E:\\SmartIoTLab\\Images\\For_Study\FinalSet\\"+str(i+1)+".jpeg",0)
        #display(img2,"displaying-images")
        rgb_img2 = cv2.imread("E:\\SmartIoTLab\\Images\\For_Study\FinalSet\\"+str(i+1)+".jpeg",1)
        diff=cv2.absdiff(img1,img2)
        thresh1 = cv2.adaptiveThreshold(diff,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,\
                        cv2.THRESH_BINARY,11,2)
        inverted=thresh1
        cv2.bitwise_not(thresh1,inverted)  #(src,dest)
        section_1,section_2 = eroding(3,1,inverted,rgb_img2,"Method-1")
        #print("Output: Section1: "+str(section_1)+", Section2: "+str(section_2))
        b[i][0]=section_1
        b[i][1]=section_2
    print("Printing B")
    print(b)
    return b

#calling the two diferent processing functions
def eroding(i,j,open_i,rgb_img2,method):
    kernel = np.ones((i,i),np.uint8)
    eroding = cv2.erode(open_i, kernel, iterations=j)
    #display(eroding,"Eroded-the-image")
    _,section_1,section_2 = annotate(eroding,rgb_img2)
    return section_1,section_2

def find_accuracy(ground_truth,output_1,output_2):
    print("Method 1")
    for i in range(0,2):
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
        print(confusion_matrix(actual, model)) 
    
    print("Method 2")
    for i in range(0,2):   
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
        print(confusion_matrix(actual, model))
        
output_1 = function1()
output_2 = function2()

find_accuracy(ground_truth,output_1,output_2)





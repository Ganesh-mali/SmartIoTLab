# -*- coding: utf-8 -*-
#This is single iteration function
#This program contains the latest work of brighness removal and thread removal
import cv2
import numpy as np
from matplotlib import pyplot as plt
from ip_functions import combine,annotate,save,display,load_images_from_folder, modified_annotate,count_white_pixels,avg_diff,homo_morph
from sklearn.metrics import confusion_matrix
ground_truth=np.zeros((329,2))
ground_truth[0][0] = 1
ground_truth[0][1] = 0
ground_truth[1][0] = 1
ground_truth[1][1] = 0
ground_truth[2][0] = 1
ground_truth[2][1] = 0
ground_truth[3][0] = 1
ground_truth[3][1] = 0
ground_truth[4][0] = 1
ground_truth[4][1] = 0
ground_truth[5][0] = 1
ground_truth[5][1] = 0
ground_truth[6][0] = 1
ground_truth[6][1] = 0
ground_truth[7][0] = 1
ground_truth[7][1] = 1
ground_truth[8][0] = 0
ground_truth[8][1] = 0
ground_truth[9][0] = 0
ground_truth[9][1] = 0
ground_truth[10][0] = 0
ground_truth[10][1] = 0
ground_truth[11][0] = 0
ground_truth[11][1] = 0
ground_truth[12][0] = 0
ground_truth[12][1] = 0
ground_truth[13][0] = 1
ground_truth[13][1] = 1
ground_truth[14][0] = 1
ground_truth[14][1] = 1
ground_truth[15][0] = 1
ground_truth[15][1] = 1
ground_truth[16][0] = 0
ground_truth[16][1] = 0
ground_truth[17][0] = 0
ground_truth[17][1] = 0
ground_truth[18][0] = 0
ground_truth[18][1] = 0
ground_truth[19][0] = 0
ground_truth[19][1] = 0
ground_truth[20][0] = 0
ground_truth[20][1] = 0
ground_truth[21][0] = 0
ground_truth[21][1] = 0
ground_truth[22][0] = 0
ground_truth[22][1] = 0
ground_truth[23][0] = 1
ground_truth[23][1] = 1
ground_truth[24][0] = 1
ground_truth[24][1] = 1
ground_truth[25][0] = 1
ground_truth[25][1] = 1
ground_truth[26][0] = 1
ground_truth[26][1] = 1
ground_truth[27][0] = 1
ground_truth[27][1] = 1
ground_truth[28][0] = 1
ground_truth[28][1] = 1
ground_truth[29][0] = 1
ground_truth[29][1] = 1
ground_truth[30][0] = 1
ground_truth[30][1] = 1
ground_truth[31][0] = 1
ground_truth[31][1] = 1
ground_truth[32][0] = 0
ground_truth[32][1] = 0
ground_truth[33][0] = 1
ground_truth[33][1] = 1
ground_truth[34][0] = 1
ground_truth[34][1] = 1
ground_truth[35][0] = 1
ground_truth[35][1] = 1
ground_truth[36][0] = 1
ground_truth[36][1] = 1
ground_truth[37][0] = 1
ground_truth[37][1] = 1
ground_truth[38][0] = 1
ground_truth[38][1] = 1
ground_truth[39][0] = 1
ground_truth[39][1] = 1
ground_truth[40][0] = 0
ground_truth[40][1] = 0
ground_truth[41][0] = 0
ground_truth[41][1] = 0
ground_truth[42][0] = 0
ground_truth[42][1] = 0
ground_truth[43][0] = 0
ground_truth[43][1] = 0
ground_truth[44][0] = 0
ground_truth[44][1] = 0
ground_truth[45][0] = 0
ground_truth[45][1] = 0
ground_truth[46][0] = 1
ground_truth[46][1] = 0
ground_truth[47][0] = 1
ground_truth[47][1] = 1
ground_truth[48][0] = 1
ground_truth[48][1] = 1
ground_truth[49][0] = 1
ground_truth[49][1] = 1
ground_truth[50][0] = 1
ground_truth[50][1] = 1
ground_truth[51][0] = 1
ground_truth[51][1] = 1
ground_truth[52][0] = 1
ground_truth[52][1] = 1
ground_truth[53][0] = 1
ground_truth[53][1] = 1
ground_truth[54][0] = 1
ground_truth[54][1] = 1
ground_truth[55][0] = 1
ground_truth[55][1] = 1
ground_truth[56][0] = 1
ground_truth[56][1] = 1
ground_truth[57][0] = 1
ground_truth[57][1] = 1
ground_truth[58][0] = 1
ground_truth[58][1] = 1
ground_truth[59][0] = 1
ground_truth[59][1] = 1
ground_truth[60][0] = 1
ground_truth[60][1] = 1
ground_truth[61][0] = 1
ground_truth[61][1] = 1
ground_truth[62][0] = 1
ground_truth[62][1] = 1
ground_truth[63][0] = 1
ground_truth[63][1] = 1
ground_truth[64][0] = 1
ground_truth[64][1] = 0
ground_truth[65][0] = 0
ground_truth[65][1] = 0
ground_truth[66][0] = 0
ground_truth[66][1] = 0
ground_truth[67][0] = 0
ground_truth[67][1] = 0
ground_truth[68][0] = 0
ground_truth[68][1] = 0
ground_truth[69][0] = 0
ground_truth[69][1] = 0
ground_truth[70][0] = 0
ground_truth[70][1] = 0
ground_truth[71][0] = 0
ground_truth[71][1] = 0
ground_truth[72][0] = 0
ground_truth[72][1] = 0
ground_truth[73][0] = 0
ground_truth[73][1] = 0
ground_truth[74][0] = 0
ground_truth[74][1] = 0
ground_truth[75][0] = 0
ground_truth[75][1] = 0
ground_truth[76][0] = 0
ground_truth[76][1] = 0
ground_truth[77][0] = 0
ground_truth[77][1] = 0
ground_truth[78][0] = 0
ground_truth[78][1] = 0
ground_truth[79][0] = 0
ground_truth[79][1] = 0
ground_truth[80][0] = 0
ground_truth[80][1] = 0
ground_truth[81][0] = 0
ground_truth[81][1] = 0
ground_truth[82][0] = 0
ground_truth[82][1] = 0
ground_truth[83][0] = 0
ground_truth[83][1] = 0
ground_truth[84][0] = 0
ground_truth[84][1] = 0
ground_truth[85][0] = 0
ground_truth[85][1] = 0
ground_truth[86][0] = 0
ground_truth[86][1] = 0
ground_truth[87][0] = 0
ground_truth[87][1] = 0
ground_truth[88][0] = 0
ground_truth[88][1] = 0
ground_truth[89][0] = 0
ground_truth[89][1] = 0
ground_truth[90][0] = 0
ground_truth[90][1] = 0
ground_truth[91][0] = 0
ground_truth[91][1] = 0
ground_truth[92][0] = 0
ground_truth[92][1] = 0
ground_truth[93][0] = 0
ground_truth[93][1] = 0
ground_truth[94][0] = 0
ground_truth[94][1] = 0
ground_truth[95][0] = 0
ground_truth[95][1] = 0
ground_truth[96][0] = 0
ground_truth[96][1] = 0
ground_truth[97][0] = 0
ground_truth[97][1] = 0
ground_truth[98][0] = 1
ground_truth[98][1] = 0
ground_truth[99][0] = 0
ground_truth[99][1] = 0
ground_truth[100][0] = 0
ground_truth[100][1] = 0
ground_truth[101][0] = 1
ground_truth[101][1] = 0
ground_truth[102][0] = 1
ground_truth[102][1] = 0
ground_truth[103][0] = 1
ground_truth[103][1] = 0
ground_truth[104][0] = 1
ground_truth[104][1] = 0
ground_truth[105][0] = 1
ground_truth[105][1] = 0
ground_truth[106][0] = 1
ground_truth[106][1] = 1
ground_truth[107][0] = 1
ground_truth[107][1] = 0
ground_truth[108][0] = 1
ground_truth[108][1] = 0
ground_truth[109][0] = 1
ground_truth[109][1] = 0
ground_truth[110][0] = 1
ground_truth[110][1] = 0
ground_truth[111][0] = 1
ground_truth[111][1] = 0
ground_truth[112][0] = 1
ground_truth[112][1] = 0
ground_truth[113][0] = 1
ground_truth[113][1] = 0
ground_truth[114][0] = 1
ground_truth[114][1] = 0
ground_truth[115][0] = 1
ground_truth[115][1] = 0
ground_truth[116][0] = 1
ground_truth[116][1] = 0
ground_truth[117][0] = 1
ground_truth[117][1] = 0
ground_truth[118][0] = 1
ground_truth[118][1] = 0
ground_truth[119][0] = 1
ground_truth[119][1] = 0
ground_truth[120][0] = 1
ground_truth[120][1] = 0
ground_truth[121][0] = 1
ground_truth[121][1] = 1
ground_truth[122][0] = 1
ground_truth[122][1] = 1
ground_truth[123][0] = 1
ground_truth[123][1] = 1
ground_truth[124][0] = 1
ground_truth[124][1] = 1
ground_truth[125][0] = 1
ground_truth[125][1] = 0
ground_truth[126][0] = 1
ground_truth[126][1] = 0
ground_truth[127][0] = 1
ground_truth[127][1] = 0
ground_truth[128][0] = 1
ground_truth[128][1] = 0
ground_truth[129][0] = 1
ground_truth[129][1] = 0
ground_truth[130][0] = 1
ground_truth[130][1] = 0
ground_truth[131][0] = 1
ground_truth[131][1] = 0
ground_truth[132][0] = 1
ground_truth[132][1] = 0
ground_truth[133][0] = 1
ground_truth[133][1] = 0
ground_truth[134][0] = 1
ground_truth[134][1] = 0
ground_truth[135][0] = 1
ground_truth[135][1] = 0
ground_truth[136][0] = 1
ground_truth[136][1] = 0
ground_truth[137][0] = 1
ground_truth[137][1] = 0
ground_truth[138][0] = 1
ground_truth[138][1] = 0
ground_truth[139][0] = 1
ground_truth[139][1] = 0
ground_truth[140][0] = 1
ground_truth[140][1] = 0
ground_truth[141][0] = 1
ground_truth[141][1] = 0
ground_truth[142][0] = 1
ground_truth[142][1] = 0
ground_truth[143][0] = 1
ground_truth[143][1] = 0
ground_truth[144][0] = 1
ground_truth[144][1] = 0
ground_truth[145][0] = 1
ground_truth[145][1] = 0
ground_truth[146][0] = 1
ground_truth[146][1] = 0
ground_truth[147][0] = 1
ground_truth[147][1] = 0
ground_truth[148][0] = 1
ground_truth[148][1] = 0
ground_truth[149][0] = 1
ground_truth[149][1] = 0
ground_truth[150][0] = 1
ground_truth[150][1] = 0
ground_truth[151][0] = 1
ground_truth[151][1] = 0
ground_truth[152][0] = 1
ground_truth[152][1] = 0
ground_truth[153][0] = 1
ground_truth[153][1] = 0
ground_truth[154][0] = 1
ground_truth[154][1] = 0
ground_truth[155][0] = 1
ground_truth[155][1] = 0
ground_truth[156][0] = 1
ground_truth[156][1] = 0
ground_truth[157][0] = 1
ground_truth[157][1] = 0
ground_truth[158][0] = 1
ground_truth[158][1] = 0
ground_truth[159][0] = 1
ground_truth[159][1] = 0
ground_truth[160][0] = 1
ground_truth[160][1] = 0
ground_truth[161][0] = 1
ground_truth[161][1] = 0
ground_truth[162][0] = 1
ground_truth[162][1] = 0
ground_truth[163][0] = 1
ground_truth[163][1] = 0
ground_truth[164][0] = 1
ground_truth[164][1] = 0
ground_truth[165][0] = 1
ground_truth[165][1] = 0
ground_truth[166][0] = 1
ground_truth[166][1] = 0
ground_truth[167][0] = 1
ground_truth[167][1] = 0
ground_truth[168][0] = 1
ground_truth[168][1] = 0
ground_truth[169][0] = 0
ground_truth[169][1] = 0
ground_truth[170][0] = 0
ground_truth[170][1] = 0
ground_truth[171][0] = 0
ground_truth[171][1] = 0
ground_truth[172][0] = 0
ground_truth[172][1] = 0
ground_truth[173][0] = 0
ground_truth[173][1] = 0
ground_truth[174][0] = 1
ground_truth[174][1] = 0
ground_truth[175][0] = 1
ground_truth[175][1] = 0
ground_truth[176][0] = 1
ground_truth[176][1] = 0
ground_truth[177][0] = 1
ground_truth[177][1] = 0
ground_truth[178][0] = 1
ground_truth[178][1] = 0
ground_truth[179][0] = 1
ground_truth[179][1] = 0
ground_truth[180][0] = 1
ground_truth[180][1] = 0
ground_truth[181][0] = 1
ground_truth[181][1] = 0
ground_truth[182][0] = 1
ground_truth[182][1] = 0
ground_truth[183][0] = 1
ground_truth[183][1] = 0
ground_truth[184][0] = 1
ground_truth[184][1] = 0
ground_truth[185][0] = 1
ground_truth[185][1] = 0
ground_truth[186][0] = 1
ground_truth[186][1] = 0
ground_truth[187][0] = 1
ground_truth[187][1] = 0
ground_truth[188][0] = 1
ground_truth[188][1] = 0
ground_truth[189][0] = 1
ground_truth[189][1] = 0
ground_truth[190][0] = 1
ground_truth[190][1] = 0
ground_truth[191][0] = 1
ground_truth[191][1] = 0
ground_truth[192][0] = 1
ground_truth[192][1] = 0
ground_truth[193][0] = 1
ground_truth[193][1] = 0
ground_truth[194][0] = 1
ground_truth[194][1] = 0
ground_truth[195][0] = 1
ground_truth[195][1] = 0
ground_truth[196][0] = 1
ground_truth[196][1] = 0
ground_truth[197][0] = 1
ground_truth[197][1] = 0
ground_truth[198][0] = 1
ground_truth[198][1] = 0
ground_truth[199][0] = 1
ground_truth[199][1] = 0
ground_truth[200][0] = 1
ground_truth[200][1] = 0
ground_truth[201][0] = 1
ground_truth[201][1] = 0
ground_truth[202][0] = 1
ground_truth[202][1] = 0
ground_truth[203][0] = 1
ground_truth[203][1] = 0
ground_truth[204][0] = 1
ground_truth[204][1] = 0
ground_truth[205][0] = 1
ground_truth[205][1] = 0
ground_truth[206][0] = 1
ground_truth[206][1] = 0
ground_truth[207][0] = 1
ground_truth[207][1] = 0
ground_truth[208][0] = 1
ground_truth[208][1] = 0
ground_truth[209][0] = 1
ground_truth[209][1] = 0
ground_truth[210][0] = 1
ground_truth[210][1] = 0
ground_truth[211][0] = 1
ground_truth[211][1] = 0
ground_truth[212][0] = 1
ground_truth[212][1] = 0
ground_truth[213][0] = 1
ground_truth[213][1] = 0
ground_truth[214][0] = 1
ground_truth[214][1] = 0
ground_truth[215][0] = 1
ground_truth[215][1] = 0
ground_truth[216][0] = 1
ground_truth[216][1] = 0
ground_truth[217][0] = 1
ground_truth[217][1] = 0
ground_truth[218][0] = 1
ground_truth[218][1] = 0
ground_truth[219][0] = 0
ground_truth[219][1] = 0
ground_truth[220][0] = 0
ground_truth[220][1] = 0
ground_truth[221][0] = 0
ground_truth[221][1] = 0
ground_truth[222][0] = 0
ground_truth[222][1] = 0
ground_truth[223][0] = 0
ground_truth[223][1] = 0
ground_truth[224][0] = 0
ground_truth[224][1] = 0
ground_truth[225][0] = 0
ground_truth[225][1] = 0
ground_truth[226][0] = 0
ground_truth[226][1] = 0
ground_truth[227][0] = 1
ground_truth[227][1] = 0
ground_truth[228][0] = 1
ground_truth[228][1] = 0
ground_truth[229][0] = 1
ground_truth[229][1] = 0
ground_truth[230][0] = 1
ground_truth[230][1] = 1
ground_truth[231][0] = 1
ground_truth[231][1] = 1
ground_truth[232][0] = 1
ground_truth[232][1] = 1
ground_truth[233][0] = 1
ground_truth[233][1] = 1
ground_truth[234][0] = 1
ground_truth[234][1] = 1
ground_truth[235][0] = 1
ground_truth[235][1] = 0
ground_truth[236][0] = 1
ground_truth[236][1] = 0
ground_truth[237][0] = 1
ground_truth[237][1] = 1
ground_truth[238][0] = 1
ground_truth[238][1] = 1
ground_truth[239][0] = 1
ground_truth[239][1] = 1
ground_truth[240][0] = 1
ground_truth[240][1] = 1
ground_truth[241][0] = 1
ground_truth[241][1] = 1
ground_truth[242][0] = 1
ground_truth[242][1] = 0
ground_truth[243][0] = 1
ground_truth[243][1] = 0
ground_truth[244][0] = 0
ground_truth[244][1] = 0
ground_truth[245][0] = 0
ground_truth[245][1] = 0
ground_truth[246][0] = 0
ground_truth[246][1] = 0
ground_truth[247][0] = 0
ground_truth[247][1] = 0
ground_truth[248][0] = 0
ground_truth[248][1] = 0
ground_truth[249][0] = 0
ground_truth[249][1] = 0
ground_truth[250][0] = 0
ground_truth[250][1] = 0
ground_truth[251][0] = 0
ground_truth[251][1] = 0
ground_truth[252][0] = 0
ground_truth[252][1] = 0
ground_truth[253][0] = 0
ground_truth[253][1] = 0
ground_truth[254][0] = 1
ground_truth[254][1] = 0
ground_truth[255][0] = 1
ground_truth[255][1] = 0
ground_truth[256][0] = 1
ground_truth[256][1] = 0
ground_truth[257][0] = 1
ground_truth[257][1] = 0
ground_truth[258][0] = 1
ground_truth[258][1] = 0
ground_truth[259][0] = 1
ground_truth[259][1] = 0
ground_truth[260][0] = 1
ground_truth[260][1] = 0
ground_truth[261][0] = 1
ground_truth[261][1] = 0
ground_truth[262][0] = 1
ground_truth[262][1] = 0
ground_truth[263][0] = 1
ground_truth[263][1] = 0
ground_truth[264][0] = 1
ground_truth[264][1] = 0
ground_truth[265][0] = 1
ground_truth[265][1] = 0
ground_truth[266][0] = 1
ground_truth[266][1] = 0
ground_truth[267][0] = 1
ground_truth[267][1] = 0
ground_truth[268][0] = 1
ground_truth[268][1] = 0
ground_truth[269][0] = 1
ground_truth[269][1] = 0
ground_truth[270][0] = 1
ground_truth[270][1] = 0
ground_truth[271][0] = 1
ground_truth[271][1] = 0
ground_truth[272][0] = 1
ground_truth[272][1] = 0
ground_truth[273][0] = 1
ground_truth[273][1] = 0
ground_truth[274][0] = 1
ground_truth[274][1] = 0
ground_truth[275][0] = 1
ground_truth[275][1] = 0
ground_truth[276][0] = 1
ground_truth[276][1] = 0
ground_truth[277][0] = 1
ground_truth[277][1] = 0
ground_truth[278][0] = 1
ground_truth[278][1] = 0
ground_truth[279][0] = 1
ground_truth[279][1] = 0
ground_truth[280][0] = 1
ground_truth[280][1] = 0
ground_truth[281][0] = 1
ground_truth[281][1] = 0
ground_truth[282][0] = 1
ground_truth[282][1] = 0
ground_truth[283][0] = 1
ground_truth[283][1] = 0
ground_truth[284][0] = 1
ground_truth[284][1] = 0
ground_truth[285][0] = 1
ground_truth[285][1] = 0
ground_truth[286][0] = 1
ground_truth[286][1] = 0
ground_truth[287][0] = 1
ground_truth[287][1] = 0
ground_truth[288][0] = 1
ground_truth[288][1] = 0
ground_truth[289][0] = 1
ground_truth[289][1] = 0
ground_truth[290][0] = 1
ground_truth[290][1] = 0
ground_truth[291][0] = 1
ground_truth[291][1] = 0
ground_truth[292][0] = 1
ground_truth[292][1] = 0
ground_truth[293][0] = 1
ground_truth[293][1] = 0
ground_truth[294][0] = 1
ground_truth[294][1] = 0
ground_truth[295][0] = 1
ground_truth[295][1] = 0
ground_truth[296][0] = 1
ground_truth[296][1] = 0
ground_truth[297][0] = 1
ground_truth[297][1] = 0
ground_truth[298][0] = 1
ground_truth[298][1] = 0
ground_truth[299][0] = 1
ground_truth[299][1] = 0
ground_truth[300][0] = 1
ground_truth[300][1] = 0
ground_truth[301][0] = 1
ground_truth[301][1] = 0
ground_truth[302][0] = 1
ground_truth[302][1] = 0
ground_truth[303][0] = 1
ground_truth[303][1] = 0
ground_truth[304][0] = 0
ground_truth[304][1] = 0
ground_truth[305][0] = 1
ground_truth[305][1] = 0
ground_truth[306][0] = 1
ground_truth[306][1] = 0
ground_truth[307][0] = 1
ground_truth[307][1] = 0
ground_truth[308][0] = 1
ground_truth[308][1] = 0
ground_truth[309][0] = 1
ground_truth[309][1] = 0
ground_truth[310][0] = 1
ground_truth[310][1] = 0
ground_truth[311][0] = 1
ground_truth[311][1] = 0
ground_truth[312][0] = 1
ground_truth[312][1] = 0
ground_truth[313][0] = 1
ground_truth[313][1] = 0
ground_truth[314][0] = 1
ground_truth[314][1] = 0
ground_truth[315][0] = 1
ground_truth[315][1] = 0
ground_truth[316][0] = 1
ground_truth[316][1] = 0
ground_truth[317][0] = 1
ground_truth[317][1] = 0
ground_truth[318][0] = 1
ground_truth[318][1] = 0
ground_truth[319][0] = 1
ground_truth[319][1] = 0
ground_truth[320][0] = 1
ground_truth[320][1] = 0
ground_truth[321][0] = 1
ground_truth[321][1] = 0
ground_truth[322][0] = 1
ground_truth[322][1] = 0
ground_truth[323][0] = 1
ground_truth[323][1] = 0
ground_truth[324][0] = 1
ground_truth[324][1] = 0
ground_truth[325][0] = 1
ground_truth[325][1] = 0
ground_truth[326][0] = 1
ground_truth[326][1] = 0
ground_truth[327][0] = 1
ground_truth[327][1] = 0
ground_truth[328][0] = 1
ground_truth[328][1] = 0
# =============================================================================
# This function works in following steps
#     1. It reads the grayscale image
#     2. It performs adaptive thresholding on the image
#     3. It takes absolute difference of the two thresholded image
#     4. Finally it applied morphological transformation on the image obtained in setp 3
# =============================================================================

def function2():   
    b=np.zeros((329,2))
# =============================================================================
#     for cval in range(2,9):
#             for ksize in range(7,24):
#                 if(ksize%2==1):  
#                     print("Kernel Size "+str(ksize))
#                     print("C Val "+str(cval))
# =============================================================================
    #for tval in range(35,36):
    #print("Threshold Value "+str(tval))
    for i in range(0,1):
        #"E:\\SmartIoTLab\\Images\\Dataset\\Dataset4\\woboundary\\"+str(i)+".jpeg"
        img1 = cv2.imread("E:\\SmartIoTLab\\Images\\Contours\\239.jpeg",0)
        img2 = cv2.imread("E:\\SmartIoTLab\\Images\\Contours\\240.jpeg",0)
        
        
        img1 = homo_morph(img1,"Image-8-Gaussian","g")
        img2 = homo_morph(img2,"Image-8-Gaussian","g")
            
        display(img2,"displaying-images")
        rgb_img2 = cv2.imread("E:\\SmartIoTLab\\Images\\Dataset\\Dataset4\\woboundary\\"+str(i+1)+".jpeg",1)
        X = np.random.randint(10,size=(720, 480),dtype=np.uint8)
        for m in range (0,720):
            for n in range(0,480):
                val1=img1[m][n]
                val2=img2[m][n]
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
        #thresh1 = cv2.adaptiveThreshold(diff,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,cv2.THRESH_BINARY,ksize,cval)
        #thresh1 = cv2.adaptiveThreshold(diff,255,cv2.ADAPTIVE_THRESH_MEAN_C,cv2.THRESH_BINARY,ksize,cval)
        _,thresh1 = cv2.threshold(X,27,255,cv2.THRESH_BINARY)
        #display(thresh1,"Showing thresholded")
        inverted=thresh1
        #cv2.bitwise_not(thresh1,inverted)  #(src,dest)
        display(inverted,"Showing inverted")
        section_1,section_2 = eroding(2,1,inverted,rgb_img2,"Method-2")
        
        
        print(section_1)
        print(section_2)
        #print("Output: Section1: "+str(section_1)+", Section2: "+str(section_2))
        b[i][0]=section_1
        b[i][1]=section_2
    #print("Printing B")
        #print(b)
    #find_accuracy(ground_truth,b)

#calling the two diferent processing functions
def eroding(i,j,open_i,rgb_img2,method):
    kernel = np.ones((i,i),np.uint8)
    eroding = cv2.erode(open_i, kernel, iterations=j)
    display(eroding,"Eroded-the-image")
    count_white_pixels(eroding)
    _,section_1,section_2 = modified_annotate(eroding,rgb_img2)
    return section_1,section_2

def find_accuracy(ground_truth,output_2):
    #print("Method 2")
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
        
function2()






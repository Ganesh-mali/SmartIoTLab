import cv2
from ip_functions import display
img = cv2.imread(r"E:\SmartIoTLab\Images\Brightness_difference_getting_captured_3x3\in\original4.jpeg")[:,:,0]
img1 = cv2.imread(r"E:\SmartIoTLab\Images\Brightness_difference_getting_captured_3x3\in\original4.jpeg",0)
img2 = cv2.imread(r"E:\SmartIoTLab\Images\Brightness_difference_getting_captured_3x3\in\original4.jpeg")
print(img.shape)
display(img,"Image1")
display(img1,"Image2")
b = img2.copy()
# set green and red channels to 0
b[:, :, 1] = 0
b[:, :, 2] = 0
cv2.imshow("R-RGB",b)
cv2.waitKey(0)
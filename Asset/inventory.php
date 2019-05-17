<?php
require "db.php";
$ComponentCode = $_GET['ccode'];
//$studentid='152050013';
$query="SELECT ComponentName,TotalQ,AvailQ FROM components WHERE ComponentCode='$ComponentCode'";
$result=mysqli_query($connection,$query);
$response=array();
while($row=mysqli_fetch_array($result)){
  array_push($response,array("CName"=>$row[0],"TotalQ"=>$row[1],"AvailQ"=>$row[2]));
}
echo json_encode(array("server_response"=>$response));
mysqli_close($connection);
 ?>

<?php
session_start();
?>
<?php include "db.php"?>
<?php
$x = 100;
global $connection;
$username = $_SESSION['user'];
//echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
/*$stmt1=mysqli_prepare($connection,"SELECT client_id,username,publish_acl,subscribe_acl FROM vmq_auth_acl where mountpoint=?");
echo "Printing username".$username;
mysqli_stmt_bind_param($stmt1,'s',$username);
mysqli_stmt_execute($stmt1);
mysqli_stmt_bind_result($stmt1,$clientid,$username,$subscribeacl,$publishacl);
mysqli_stmt_store_result($stmt1);
mysqli_stmt_error($stmt1);
$count=mysqli_stmt_num_rows($stmt1);
while(mysqli_stmt_fetch($stmt1)){
  echo "\n Printing count ".$count;
  echo $clientid." Printing First Name";
}*/
/*$emailid = 'project.fellow@el.vjti.ac.in';
echo "<script>alert('".$emailid."');</script>";
$stmt = mysqli_prepare($connection,"SELECT fname from users WHERE emailid = ?");
mysqli_stmt_bind_param($stmt,'s',$emailid);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $fname, $hash);
mysqli_stmt_store_result($stmt);
$count = mysqli_stmt_num_rows($stmt);
echo $count;*/
/*var_dump(apc_fetch('foo'));*/?>
<button onclick="window.location.href='index.php'">Click Here</button>
<?
?>

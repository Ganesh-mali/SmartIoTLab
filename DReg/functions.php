<?php include "db.php"?>
<style>
#results
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:50%;
border-collapse:collapse;
}
#results td, #results th
{
font-size:1em;
border:1px solid #293d3d;
padding:3px 7px 2px 7px;
    width:35%;
}
#results th
{
font-size:1.1em;
text-align:left;
padding-top:5px;
padding-bottom:4px;
background-color:#669999;
color:#ffffff;
    width: 15%;
}
</style>
<?php
function registerDevice(){
  echo "<script>console.log('Inside register device');</script>";
    global $connection;
    if(isset($_POST['submit'])){
                echo "<script>console.log('Inside register device');</script>";
                $clientid=$_POST['clientid'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $publishacl=$_POST['publishacl'];
                $subscribeacl=$_POST['subscribeacl'];
                $query1="INSERT INTO vmq_auth_acl(mountpoint, client_id, username, password, publish_acl, subscribe_acl) ";
                $query1 .="VALUES('','$clientid','$username',MD5('$password'),'$publishacl','$subscribeacl')";
                $result1=mysqli_query($connection,$query1);
                if(!$result1){
                    echo "Database Error Occured. Please try again";
                  }
                else{
                    echo "Your Device Reg istration Done Successfully";
                  }
    }
}
function checkLogin(){
    //session_start();
    //session_destroy();
    global $connection;
    if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query= "SELECT * FROM users WHERE username='$username' and password=MD5('$password')";
    $result=mysqli_query($connection,$query );
    $count = mysqli_num_rows($result);
    echo "<script>console.log('".$count."')</script>";
    if($count==1){
        $_SESSION['user'] = $username;
        header("Location:home.php");
        //die("Query Failed".mysqli_error($connection));
    }
    else{
        echo "Invalid Login Credentials.";
    }
}
}
function getDeviceStatus(){
  $curl = curl_init("http://UhXVlAWRjbDq6W5WbWnBdF0iBZIjYJdN@172.18.22.9:8889/api/v1/session/show");
  $result = curl_exec($curl);
  $some_array = json_decode($result,true);
  echo $result;
  print_r($some_array);
}
?>

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
function registerNewUser(){
    global $connection;
    if(isset($_POST['submit'])){
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $emailid=$_POST['emailid'];
                $mobileno=$_POST['mobileno'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
                $code=md5(uniqid(rand()));
                $query2="SELECT * FROM users WHERE username='$username'";
                $result2=mysqli_query($connection,$query2);
                $count=mysqli_num_rows($result2);
                if($count==1){
                    echo "Username Already Taken";
                }
                else{
                     mysqli_free_result($result2);
                     $query1="INSERT INTO register(fname,lname,emailid,mobileno,username,password,code)";
                     $query1 .="VALUES('$fname','$lname','$emailid','$mobileno','$username','$encrypted_password','$code')";
                     $result1=mysqli_query($connection,$query1);
                    if(!$result1){
                        echo "Database Error Occured. Please try again";
                        echo "Error Occured".mysqli_error($connection);
                    }
                    else{
                         echo "Your Registration Completed Successfully";
                         sendMail($code);
                    }
                }
    }
}

function sendMail($code){
    $to=$_POST['emailid'];
    $subject="Thank yor for registering on CSRIoT Lab Server Portal";
    $message="Your Comfirmation link \r\n";
    $message.="Click on this link to activate your account \r\n";
    $message.="http://172.18.22.9/confirmation.php?passkey=$code";
    $sentmail=mail($to,$subject,$message,'From: do.vikas1369@gmail.com');
    if($sentmail){
        echo "<br>Please activate your account before accessing this website<br>A Confirmation link has been sent to your email address.";
    }
    else {
        echo "<br>Cannot send Confirmation link to your e-mail address";
    }
}

function confirmUser(){
    global $connection;
    $passkey=$_GET['passkey'];
    $query="SELECT * FROM register where code='$passkey'";
    $result=mysqli_query($connection,$query);
    $count=mysqli_num_rows($result);
    if($count==1){
        $row=mysqli_fetch_assoc($result);
        $fname=$row['fname'];
        $lname=$row['lname'];
        $emailid=$row['emailid'];
        $mobileno=$row['mobileno'];
        $username=$row['username'];
        $password=$row['password'];
        $query="INSERT INTO users(fname,lname,emailid,mobileno,username,password) ";
        $query .="VALUES('$fname','$lname','$emailid','$mobileno','$username','$password')";
        $result=mysqli_query($connection,$query);
        if(!$result){
        die("Query Failed".mysqli_error($connection));
        }
        else{
            echo "Your account has been activated<br>You will be redirected to Home Page";
            $sql="DELETE FROM register WHERE code = '$passkey'";
            $result=mysqli_query($connection,$sql);
            header('Refresh: 5; URL=home.php');
        }
    }
     else
        {
            echo "Wrong Confirmation Code";
        }
}

function registerDevice(){
  echo "<script>console.log('Inside register device');</script>";
    global $connection;
    if(isset($_POST['submit'])){
                echo "<script>console.log('Inside register device');</script>";
                $mountpoint = $_SESSION['user'];
                $clientid=$_POST['clientid'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $publishacl=$_POST['publishacl'];
                $subscribeacl=$_POST['subscribeacl'];
                $query1="INSERT INTO vmq_auth_acl(mountpoint, client_id, username, password, publish_acl, subscribe_acl) ";
                $query1 .="VALUES('$mountpoint','$clientid','$username',MD5('$password'),'$publishacl','$subscribeacl')";
                $result1=mysqli_query($connection,$query1);
                if(!$result1){
                    echo "Database Error Occured. Please try again";
                  }
                else{
                    echo "Your Device Registration Done Successfully";
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
      $stmt = mysqli_prepare($connection,"SELECT password from users WHERE username = ?");
      mysqli_stmt_bind_param($stmt,'s',$username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $hash);
      mysqli_stmt_store_result($stmt);
      $row=mysqli_stmt_fetch($stmt);
      $total=mysqli_stmt_num_rows($stmt);
      mysqli_free_result($result1);
      mysqli_stmt_error($stmt );
      if($total==1){
        echo "<script>console.log('".$count."')</script>";
        $auth = password_verify($password, $hash);
        if($auth==true){
          $_SESSION['user'] = $username;
          header("Location:home.php");
          }
        else{
          echo "Invalid Login Credentials.";
        }
      }
      else{
        echo "Invalid Username";
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

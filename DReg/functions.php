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
                $stmt1 = mysqli_prepare($connection,"SELECT * FROM users WHERE username=?");
                mysqli_stmt_bind_param($stmt1,'s',$username);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_store_result($stmt1);
                $count=mysqli_stmt_num_rows($stmt1);
                if($count==1){
                    echo "Username Already Taken";
                }
                else{
                     mysqli_stmt_close($stmt1);
                     $query = "INSERT INTO register(fname,lname,emailid,mobileno,username,password,code)";
                     $query .="VALUES(?,?,?,?,?,?,?)";
                     $stmt2 = mysqli_prepare($connection, $query);
                     mysqli_stmt_bind_param($stmt2,'sssssss',$fname,$lname,$emailid,$mobileno,$username,$encrypted_password,$code);
                     $result1=mysqli_stmt_execute($stmt2);
                     if(!$result1){
                        echo "Database Error Occured. Please try again";
                        echo "Error Occured".mysqli_stmt_error($stmt2);
                      }
                      else{
                         echo "Your Registration Completed Successfully";
                         sendMail($code);
                    }
                    mysqli_stmt_close($stmt2);
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
    $stmt1=mysqli_prepare($connection,"SELECT fname,lname,emailid,mobileno,username,password FROM register where code=?");
    mysqli_stmt_bind_param($stmt1,'s',$passkey);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_bind_result($stmt1,$fname,$lname,$emailid,$mobileno,$username,$password);
    mysqli_stmt_store_result($stmt1);
    mysqli_stmt_fetch($stmt1);
    $count=mysqli_stmt_num_rows($stmt1);
    if($count==1){
        //echo "Printing Fname ".$fname;
        mysqli_stmt_close($stmt1);
        $query="INSERT INTO users(fname,lname,emailid,mobileno,username,password)";
        $query .="VALUES(?,?,?,?,?,?)";
        $stmt2=mysqli_prepare($connection,$query);
        mysqli_stmt_bind_param($stmt2,'ssssss',$fname,$lname,$emailid,$mobileno,$username,$password);
        $result = mysqli_stmt_execute($stmt2);
        if(!$result){
        die("Query Failed");
        }
        else{
            echo "Your account has been activated<br>You will be redirected to Home Page";
            $stmt = mysqli_prepare($connection,"DELETE FROM register WHERE code = ?");
            mysqli_stmt_bind_param($stmt,'s',$passkey);
            mysqli_stmt_execute($stmt);
            header('Refresh: 5; URL=index.php');
        }
    }
     else
        {
            echo "Wrong Confirmation Code";
        }
}

function registerDevice(){
  //echo "<script>console.log('Inside register device');</script>";
    global $connection;
    if(isset($_POST['submit'])){
                //echo "<script>console.log('Inside register device');</script>";
                $userid = $_SESSION['user'];
                $clientid=$_POST['clientid'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $publishacl=$_POST['publishacl'];
                $mountpoint ='';
                $subscribeacl=$_POST['subscribeacl'];
                $query="INSERT INTO vmq_auth_acl(mountpoint,userid, client_id, username, password, publish_acl, subscribe_acl) ";
                $query .="VALUES(?,?,?,?,MD5(?),?,?)";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt,'sssssss',$mountpoint,$userid,$clientid,$username,$password,$publishacl,$subscribeacl);
                $result = mysqli_stmt_execute($stmt);
                if(!$result){

                    echo "Database Error Occured. Please try again(Probably with differnt client-id and/or username)";
                  }
                else{
                    echo "Your Device has been registered successfully";
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
      $stmt = mysqli_prepare($connection,"SELECT fname, password from users WHERE username = ?");
      mysqli_stmt_bind_param($stmt,'s',$username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $fname, $hash);
      mysqli_stmt_store_result($stmt);
      $row=mysqli_stmt_fetch($stmt);
      $total=mysqli_stmt_num_rows($stmt);
      mysqli_stmt_close($stmt);
      if($total==1){
        echo "<script>console.log('".$count."')</script>";
        $auth = password_verify($password, $hash);
        if($auth==true){
          $_SESSION['user'] = $username;
          $_SESSION['fname'] = $fname;
          header("Location:home.php");
          }
        else{
          echo "Invalid Login Credentials!";
        }
      }
      else{
        echo "Invalid Login Credentials!";
      }
    }
}
function sayHello(){
  $fname = $_SESSION['fname'];
  echo "<center>";
  echo "<h1>Hello! ".$fname."</h1>";
  echo "<h4>Welcome to MQTT device management portal</h4>";
  echo "</center>";
}
function getDeviceStatus(){
  $curl = curl_init("http://UhXVlAWRjbDq6W5WbWnBdF0iBZIjYJdN@172.18.22.9:8889/api/v1/session/show");
  $result = curl_exec($curl);
  $some_array = json_decode($result,true);
  echo $result;
  print_r($some_array);
}

function getDeviceList(){
  global $connection;
  $username = $_SESSION['user'];
  if(isset($_POST['editsub'])){
    //echo "<script>alert('Inside submitted form');</script>";
    $newclientid = $_POST['cid'];
    //echo "<script>alert('".$username."');</script>";
    //echo "<script>alert('".$newclientid."');</script>";
    $newuname = $_POST['uname'];
    $publishacl = $_POST['publishacl'];
    $subscribeacl = $_POST['subscribeacl'];
    $oldclientid = $_SESSION['oldclientid'];
    $olduname = $_SESSION['oldusername'];
    //echo "<script>alert('".$oldclientid."');</script>";
    //echo "<script>alert('".$olduname."');</script>";
    $query="UPDATE vmq_auth_acl SET client_id=?, username =?, publish_acl=?, subscribe_acl=? WHERE userid=? AND client_id=? and username=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt,'sssssss',$newclientid,$newuname,$publishacl,$subscribeacl,$username,$oldclientid,$olduname);
    $result = mysqli_stmt_execute($stmt);
    if(!$result){
        echo "Database Error Occured. Please try again";
      }
    else{
        echo "Your Device has been edited successfully";
        //getDeviceList();
      }
  }
  if(isset($_POST['delete'])){
    //echo "<script>alert('Inside delete block')</script>";
    $clientid = $_POST['clientid'];
    $usern = $_POST['username'];
    //echo "<script>alert(".$clientid.")</script>";
    //echo "<script>alert(".$usern.")</script>";
    $stmt=mysqli_prepare($connection,"DELETE FROM vmq_auth_acl where userid=? AND client_id = ? AND username =?");
    mysqli_stmt_bind_param($stmt,'sss',$username,$clientid,$usern);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
  //echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
  $stmt1=mysqli_prepare($connection,"SELECT client_id,username,publish_acl,subscribe_acl FROM vmq_auth_acl where userid=?");
  mysqli_stmt_bind_param($stmt1,'s',$username);
  mysqli_stmt_execute($stmt1);
  mysqli_stmt_bind_result($stmt1,$clientid,$username,$publishacl,$subscribeacl);
  mysqli_stmt_store_result($stmt1);
  mysqli_stmt_error($stmt1);
  $count=mysqli_stmt_num_rows($stmt1);
  if($count>=1){
  echo "<h3>Your device list</h3>"?>
  <table class='table table-striped'>
  <thead>
    <tr>
      <th>Sr No</th>
      <th>Client Id</th>
      <th>Uername</th>
      <th>Publish ACL</th>
      <th>Subscribe ACL</th>
    </tr>
  </thead>
  <tbody>
  <?php $count =1;
  while(mysqli_stmt_fetch($stmt1)){?>
    <tr>
    <th><?php echo $count?></th>
    <td><?php echo $clientid?></td>
    <td><?php echo $username?></td>
    <td><?php echo $publishacl?></td>
    <td><?php echo $subscribeacl?></td>
    <td><form method='POST' action='editdevice.php' name='editForm'>
    <input type='hidden' name='clientid' value="<?php echo $clientid ?>"/>
    <input type='hidden' name='username' value="<?php echo $username ?>">
    <input type='hidden' name='pacl' value='<?php echo $publishacl ?>'>
    <input type='hidden' name='sacl' value='<?php echo $subscribeacl ?>'>
    <button type='submit' class='btn btn-default' name='edit'>Edit Details</button></form></td>
    <td><form method='POST' name='deleteForm' action=''>
      <input type='hidden' name='clientid' value="<?php echo $clientid ?>"/>
      <input type='hidden' name='username' value="<?php echo $username ?>">
      <button type='submit' class='btn btn-default' name='delete'>Delete</button></form></td>
    </tr>
    <?php $count++;
    }
    ?>
    </tbody>
    </table>
  <?php
}//end of if condition to check empty list
else{
  echo "<h2>No device registered yet!</h2>";
}
}//end of function block
  function editDevicePop(){
      if(isset($_POST['edit'])){
        $clientid = $_POST['clientid'];
        $username = $_POST['username'];
        $publishacl = $_POST['pacl'];
        $subscribeacl = $_POST['sacl'];
        //echo "<script>alert('".$subscribeacl."');</script>";
        $_SESSION['oldclientid'] = $clientid;
        $_SESSION['oldusername'] = $username;
        ?>
        <form id="editForm" action="listr.php" class="form-horizontal" method="post" name="editForm" onsubmit="return(validate());">
          <fieldset>

            <!-- Form Name -->

            <legend>Edit MQTT Device Details</legend>
  					<p id="success1" class="bg-success">
  					<?php
  					//function name
            //editDeviceDetails();
  					?>
  					</p>
  					<div id="messages"></div>

  					<!-- Text input-->

            <div class="form-group">
              <label class="col-sm-3 control-label" for="cid">Client_ID</label>
              <div class="col-sm-9">
                <input type="text" name="cid" class="form-control" value ="<?php echo $clientid;?>" required>
  							<div class="form-group has-error">
  							<span id="helpBlock1" class="help-block"></span>
  							</div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label" for="uname">Username</label>
              <div class="col-sm-9">
                <input type="text" name="uname" class="form-control" value ="<?php echo $username;?>" required>
  							<div class="form-group has-error">
  							<span id="helpBlock2" class="help-block"></span>
  							</div>
              </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
              <label class="col-sm-3 control-label" for="publishacl">Publish_acl</label>
              <div class="col-sm-9">
                <input type="text" name="publishacl" class="form-control" value ='<?php echo $publishacl;?>' required>
  							<div class="form-group has-error">
  							<span id="helpBlock4" class="help-block"></span>
  							</div>
              </div>
            </div>
           <!-- Text input-->
            <div class="form-group">
              <label class="col-sm-3 control-label" for="subscribeacl">Subscribe_acl</label>
              <div class="col-sm-9">
                <input type="text" name="subscribeacl" class="form-control" value ='<?php echo $subscribeacl;?>' required>
  							<div class="form-group has-error">
  							<span id="helpBlock5" class="help-block"></span>
  							</div>
              </div>
              </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="pull-right">
                  <button id="btnReg" type="submit" class="btn btn-primary" name="editsub" value="editsub">Submit</button>
                </div>
              </div>
            </div>
          </fieldset>
        </form>
        <?php
      }//end of if
  }
/*  function editDeviceDetails(){
        $user = $_SESSION['user'];
        //$olduname = $_POST['username'];
        //$oldclientid = $_POST['clientid'];
        //echo "<script>alert('".$olduname."');</script>";
        //echo "<script>alert('Inside Edit Device');</script>";
      if(isset($_POST['editsub'])){
        //echo "<script>alert('Inside submitted form');</script>";
        $clientid = $_POST['cid'];
        $username = $_POST['uname'];
        $publishacl = $_POST['publishacl'];
        $subscribeacl = $_POST['subscribeacl'];
        $query="UPDATE vmq_auth_acl SET client_id=? AND username =? AND publish_acl=? AND subscribe_acl=? WHERE userid=? AND client_id=? and username=?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt,'sssssss',$clientid,$username,$publishacl,$subscribeacl,$user,$olduname,$oldclientid);
        $result = mysqli_stmt_execute($stmt);
        if(!$result){
            echo "Database Error Occured. Please try again";
          }
        else{
            echo "Your Device has been edited successfully";
            getDeviceList();
          }
      }
  }*/
  function resetPassword(){
    global $connection;
      if(isset($_POST['submit'])){
        $emailid = $_POST['emailid'];
        //echo "<script>alert('".$emailid."');</script>";
        $stmt = mysqli_prepare($connection,"SELECT fname from users WHERE emailid = ?");
        mysqli_stmt_bind_param($stmt,'s',$emailid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $fname, $hash);
        mysqli_stmt_store_result($stmt);
        $count = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);
        if($count==1){
            $code=md5(uniqid(rand()));
            $stmt = mysqli_prepare($connection,"INSERT INTO resetp values(?,?)");
            mysqli_stmt_bind_param($stmt,'ss',$emailid,$code);
            $success= mysqli_stmt_execute($stmt);
            if($success){
              $to=$emailid;
              $subject="CSRIOT:Reset Password";
              $message="Link to Reset password\r\n";
              $message.="Click on this link to reset your password \r\n";
              $message.="http://172.18.22.9/confirmprcode.php?passkey=$code";
              $sentmail=mail($to,$subject,$message,'From: do.vikas1369@gmail.com');
              if($sentmail){
                  echo "A link has been sent to your email address to reset your password";
              }
              else {
                  echo "Cannot send Confirmation link to your e-mail address.<br> Please try again";
                  $stmt4 = mysqli_prepare($connection,"DELETE from resetp WHERE emailid=?");
                  mysqli_stmt_bind_param($stmt4,'s',$emailid);
                  mysqli_stmt_execute($stmt4);
              }
            }
            else{
              echo "Database Error Occured";
            }
        }
        else{
          echo $count;
          echo "Email Id doesn't exist in our database";
        }
      }
  }
  function confirmprcode(){
    global $connection;
    if(isset($_POST['submit'])){
      //echo "<script>alert('inside submit');</script>";
      $password = $_POST['password'];
      $emailid = $_POST['emailid'];
      //echo "<script>alert('".$emailid."');</script>";
      //echo "<script>alert('".$password."');</script>";
      $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
      $query="UPDATE users SET password=? WHERE emailid=?";
      $stmt2=mysqli_prepare($connection,$query);
      mysqli_stmt_bind_param($stmt2,'ss',$encrypted_password,$emailid);
      $result = mysqli_stmt_execute($stmt2);
      mysqli_stmt_close($stmt2);
      if(!$result){
      die("Query Failed");
      }
      else{
        $stmt3=mysqli_prepare($connection,"DELETE FROM resetp where emailid=?");
        mysqli_stmt_bind_param($stmt3,'s',$emailid);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);
        echo "Your password has been reset successfully<br>You will be redirected to Login Page";
        header('Refresh: 5; URL=index.php');
      }
      exit();
    }
    $passkey=$_GET['passkey'];
    $stmt1=mysqli_prepare($connection,"SELECT emailid FROM resetp where code=?");
    mysqli_stmt_bind_param($stmt1,'s',$passkey);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_bind_result($stmt1,$emailid);
    mysqli_stmt_store_result($stmt1);
    mysqli_stmt_fetch($stmt1);
    //echo "<script>alert('".$emailid."');</script>";
    $count=mysqli_stmt_num_rows($stmt1);
    mysqli_stmt_close($stmt1);
    if($count==1){
        ?>
        <div class="container">
            <div class="col-sm-6 col-md-offset-4 col-lg-5">
              <br><br><br>
            <center><img src="img/CSRIoT_Logo1.png"></img></center>
            <br>
                <h1 class="text-center">Reset Password</h1>
                <p id="success1" class="bg-success">
                <?php
                //registerNewUser();
                ?>
                </p>
                <form method="post" name="rform" id="rform" onsubmit="return(validate());">
                  <table class="table table-bordered">
                  <tr><td>
                    <div class="form-group">
                        <label for="password">Enter New Password</label>
                        <input type="password" name="password" class="form-control">
                        <div class="form-group has-error">
                        <span id="helpBlock1" class="help-block"></span>
                        </div>
                    </div>
                        </td></tr>
                        <tr><td>
                    <div class="form-group">
                        <label for="rpassword">Reenter New Password</label>
                        <input type="password" name="rpassword" class="form-control">
                        <div class="form-group has-error">
                        <span id="helpBlock2" class="help-block"></span>
                        </div>
                    </div>
                    <input type='hidden' name='emailid' value="<?php echo $emailid; ?>"/>
                  </td></tr>
                  <tr><td>
          <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                      </td></tr>
                </table>
              </form>
          </div>
      </div>
        <?php
    }
     else
        {
            echo "Wrong Confirmation Code";
        }
  }
?>

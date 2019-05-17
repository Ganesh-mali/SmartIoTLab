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
function doRegistration(){
    global $connection;
    if(isset($_POST['submit'])){
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $emailid=$_POST['emailid'];
                $mobileno=$_POST['mobileno'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $code=md5(uniqid(rand()));
                $query2="SELECT * FROM members WHERE username='$username'";
                $result2=mysqli_query($connection,$query2);
                $count=mysqli_num_rows($result2);
                if($count==1){
                    echo "Username Already Taken";
                }
                else{
                     mysqli_free_result($result2);
                     $query1="INSERT INTO register(fname,lname,emailid,mobileno,username,password,code) ";
                     $query1 .="VALUES('$fname','$lname','$emailid','$mobileno','$username','$password','$code')";
                     $result1=mysqli_query($connection,$query1);
                    if(!$result1){
                        echo "Database Error Occured. Please try again";
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
    $subject="Thank yor for registering on VHOAM";
    $message="Your Comfirmation link \r\n";
    $message.="Click on this link to activate your account \r\n";
    $message.="http://example/confirmation.php?passkey=$code";
    $sentmail=mail($to,$subject,$message,'From: do.vikas1369@gmail.com');
    if($sentmail){
        echo "<br>Please activate your account before accessing this website<br>A Confirmation link aas been sent to your email address.";
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
        $query="INSERT INTO members(fname,lname,emailid,mobileno,username,password) ";
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
function checkLogin(){
    //session_start();
    //session_destroy();
    global $connection;
    if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query= "SELECT * FROM admin WHERE username='$username' and password='$password'";
    $result=mysqli_query($connection,$query );
    $count = mysqli_num_rows($result);
    if($count==1){
        $_SESSION['user'] = $username;
        header("Location:/assets/home.php");
        //die("Query Failed".mysqli_error($connection));
    }
    else{
        echo "Invalid Login Credentials.";
    }
}
}

function addNewComponent(){
    global $connection;
if(isset($_POST['add'])){
    $ccode=$_POST['ccode'];
    $cname=$_POST['cname'];
    $total1=$_POST['totalq'];
    $availq=$_POST['availq'];
    $edate=$_POST['edate'];
    $udate=$_POST['udate'];
    $query="INSERT INTO components(Componentcode,Componentname, Totalq,Availq, DateF, DateU) ";
    $query .="VALUES('$ccode','$cname','$total1','$availq','$edate','$udate')";
    $result=mysqli_query($connection,$query);
    if(!$result){
        echo "Error";
        die("Query Failed".mysqli_error($connection));

    }
    else{
        echo "Record for Component: ".$cname." added successfully";
    }
}
}

function searchEvents(){
    global $connection;
if(isset($_POST['submit'])){
    echo "<br><b><u>Search Results</u></b><br>";
    $search=$_POST['address'];
        $query="SELECT * FROM components WHERE ComponentCode LIKE '%$search%' or ComponentName LIKE '%$search%'";
    $result=mysqli_query($connection,$query);
    $rowcount=mysqli_num_rows($result);
    if(!$result){
        die("Query Failed".mysqli_error($connection));
    }
    else{
        if($rowcount==0){
            echo "<br>No Result Found";
        }
        else{
            echo "<br>Total componenets found for this query are :".$rowcount."<br><br>";
        }

        while($row=mysqli_fetch_assoc($result)){
            $cid=$row['ComponentID'];
            $cname=$row['ComponentName'];
            $totalq=$row['TotalQ'];
            $availq=$row['AvailQ'];
            $datef=$row['DateF'];
            $dateu=$row['DateU'];
            $ccode=$row['ComponentCode'];
            ?>
            <table border="1" id="results">
               <tr>
                    <th>Component Id</th>
                    <td width="25%"><?php echo $cid?></td>
                </tr>
                <tr>
                    <th>Componenet Code</th>
                    <td width="25%"><?php echo $ccode?></td>
                </tr>
                <tr>
                    <th>Componenet Name</th>
                    <td width="25%"><?php echo $cname?></td>
                </tr>
                <tr>
                    <th>Total Quantity</th>
                    <td><?php echo $totalq?></td>
                </tr>
                <tr>
                    <th>Available Quantity</th>
                    <td><?php echo $availq?></td>
                </tr>
                <tr>
                    <th>Entry Date</th>
                    <td><?php echo $datef?></td>
                </tr>
                <tr>
                    <th>Updated Date</th>
                    <td><?php echo $dateu?></td>
                </tr>
                <tr>
                    <td><form method="POST">
                    <input type="hidden" name="event" value="<?php echo $eventname;?>"/>
                    <button type="submit" class="btn btn-default" name="register">Update</button></form></td>
                </tr>
                <tr></tr>
            </table>
            <?php
                echo "<br><br><br>";
        }
    }
}
}
function sendPassword(){
    global $connection;
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $query="SELECT emailid,password FROM members WHERE username='$username'";
        $result=mysqli_query($connection,$query);
        if($result){
            $count=mysqli_num_rows($result);
            if($count==1){
                $row=mysqli_fetch_assoc($result);
            $password=$row['password'];
            $to=$row['emailid'];
            $subject="Password Mail";
            $message="Your Password is: ".$password;
            $sentmail=mail($to,$subject,$message,'From: do.vikas1369@gmail.com');
        if($sentmail){
            echo "<br>Your password has been sent to your email address.";
        }
        else {
            echo "<br>Cannot send password to your e-mail address";
        }
            }

            else{
            echo "Username doesn't exist";
        }
        }
    }
}
function registerForEvent(){
    global $connection;
    if(isset($_POST['register'])){
        $username=$_SESSION['user'];
        $eventname=$_POST['event'];
        $query="INSERT INTO transaction(username,event) ";
        $query .="VALUES('$username','$eventname')";
        $result=mysqli_query($connection,$query);
        if($result){
            echo "You have been successfully registered for the event<br>";
        }
        else{
            echo "Some Problem in registreation. Please try again";
        }
    }
}

function issueRegistered(){
  global $connection;
  if(isset($_POST['issue'])){
    $studentdetails = $_POST['namedrop'];
    $arr = explode("(",$studentdetails);
    $count = $_POST['count'];
    echo $count;

    for($x = 1; $x<=$count;$x++){
      $temp1 = "s".$x;
      $comp = $_POST[$temp1];
      $temp2 = "q".$x;
      $quant = $_POST[$temp2];
      $query="INSERT INTO issuerecord(rollno, compnamecode,compq,  issuedate)";
      $query .="VALUES('$studentrn','$comp','$quant',CURDATE())";
      $result=mysqli_query($connection,$query);
      if(!$result){
        echo "Error";
        die("Query Failed".mysqli_error($connection));

      }
      else{
        echo "Student Roll No Recorded successfully";
      }
    }
  }
  }


function issueUnregistered(){
  global $connection;
  if(isset($_POST['issue'])){
    $studentname = $_POST['studentname'];
    $studentrn=$_POST['studentrn'];
    $studentba=$_POST['studentba'];
    $studentbr=$_POST['studentbr'];
    $count = $_POST['count'];
    echo $count;
    $mobilen = $_POST['mobilen'];
    $studentd = $_POST['studentd'];
    $query="INSERT INTO Students(name,rollno, batch, branch, mobileno,degree)";
    $query .="VALUES('$studentname','$studentrn','$studentba','$studentbr','$mobilen','$studentd')";
    $result=mysqli_query($connection,$query);
    if(!$result){
      echo "Error";
      die("Query Failed".mysqli_error($connection));

    }
    else{
      echo "Student Roll No Recorded successfully";
    }
    for($x = 1; $x<=$count;$x++){
      $temp1 = "s".$x;
      $comp = $_POST[$temp1];
      $temp2 = "q".$x;
      $quant = $_POST[$temp2];
      $query="INSERT INTO issuerecord(rollno, compnamecode,compq,  issuedate)";
      $query .="VALUES('$studentrn','$comp','$quant',CURDATE())";
      $result=mysqli_query($connection,$query);
      if(!$result){
        echo "Error";
        die("Query Failed".mysqli_error($connection));

      }
      else{
        echo "Student Roll No Recorded successfully";
      }
    }
  }
  }
function getInventoryList(){
  global $connection;
  $query="SELECT * FROM components";
  $result=mysqli_query($connection,$query);
  $rowcount=mysqli_num_rows($result);
  if(!$result){
    die("Query Failed".mysqli_error($connection));
  }
  else{
    if($rowcount==0){
        echo "<br>No Result Found";
    }
    else{
        echo "<center><br>Total number of components :".$rowcount."<br></center><br>";
    }
    while($row=mysqli_fetch_assoc($result)){
        $cid=$row['ComponentID'];
        $cname=$row['ComponentName'];
        $totalq=$row['TotalQ'];
        $availq=$row['AvailQ'];
        $datef=$row['DateF'];
        $dateu=$row['DateU'];
        $ccode=$row['ComponentCode'];
        ?>
        <center>
        <table border="1" id="results">
           <tr>
                <th>Component Id</th>
                <td width="25%"><?php echo $cid?></td>
            </tr>
            <tr>
                <th>Componenet Code</th>
                <td width="25%"><?php echo $ccode?></td>
            </tr>
            <tr>
                <th>Componenet Name</th>
                <td width="25%"><?php echo $cname?></td>
            </tr>
            <tr>
                <th>Total Quantity</th>
                <td><?php echo $totalq?></td>
            </tr>
            <tr>
                <th>Available Quantity</th>
                <td><?php echo $availq?></td>
            </tr>
            <tr>
                <th>Entry Date</th>
                <td><?php echo $datef?></td>
            </tr>
            <tr>
                <th>Updated Date</th>
                <td><?php echo $dateu?></td>
            </tr>
            <tr>
                <td><form method="POST">
                <input type="hidden" name="event" value="<?php echo $eventname;?>"/>
                <button type="submit" class="btn btn-default" name="register">History</button></form></td>
            </tr>
            <tr></tr>
        </table>
      </center>
        <?php
            echo "<br><br><br>";
    }
}
  }
?>

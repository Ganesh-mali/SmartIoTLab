<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
?>
    <?php include "includes/header.php"?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
		<script src="http://www.hivemq.com/demos/websocket-client/js/mqttws31.js" type="text/javascript"></script>
    <script src="includes/sidebarscript.js" type="text/javascript"></script>
    <script type="text/javascript">
        var flag=0;
        function checkcid(){
          //alert('Check cid getting called');
           var id = /^[a-zA-Z0-9_-]+$/;
        if(document.editForm.cid.value == ""){
            document.getElementById('helpBlock1').innerHTML = 'Please Enter the Client Id';
           flag=1;
         }
         else if(document.editForm.cid.value.length>128){
             document.getElementById('helpBlock1').innerHTML = 'Client Id cant be greater than 128 characters';
             flag=1;
         }
         else if(!document.editForm.cid.value.match(id)){
            document.getElementById('helpBlock1').innerHTML = 'No special characters allowed except underscore(_) and dash(-)';
           flag=1;
         }
        }
        function checkuname(){
         var un_pattern = /^[a-zA-Z0-9_-]+$/;
         //alert('Check usernem getting called');
         if(document.editForm.uname.value == ""){
             document.getElementById('helpBlock2').innerHTML = 'Please Enter the uname';
             flag=1;
         }
            else if(document.editForm.uname.value.length>128){
                document.getElementById('helpBlock2').innerHTML = 'uname cant be greater than 128 characters';
                flag=1;
            }
            else if(!document.editForm.uname.value.match(un_pattern)){
                document.getElementById('helpBlock2').innerHTML = 'No special characters allowed except underscore(_) and dash(-)';
                flag=1;
            }
        }
        function checkpublishacl(){
          //alert('Check pacl getting called');
         if(document.editForm.publishacl.value == ""){
             document.getElementById('helpBlock4').innerHTML = 'Please Enter the Publish ACL';
             flag=1;
         }
            else if(document.editForm.publishacl.value.length>65535){
                document.getElementById('helpBlock4').innerHTML = 'Publish ACL should be of Maximun 65535 characters';
                flag=1;
            }
        }
        function checksubscribeacl(){
          //alert('Check sacl getting called');
        if(document.editForm.subscribeacl.value == ""){
            document.getElementById('helpBlock5').innerHTML = 'Please Enter the Subscribe ACL';
            flag=1;
        }
           else if(document.editForm.subscribeacl.value.length>65535){
               document.getElementById('helpBlock5').innerHTML = 'Subscribe ACL should be of Maximun 65535 characters';
               flag=1;
           }
       }
           function validate(){
             console.log("Called:validation function");
             //alert('Validation function called');
               flag=0;
                 document.getElementById('helpBlock1').innerHTML = "";
                 document.getElementById('helpBlock2').innerHTML = "";
                 document.getElementById('helpBlock4').innerHTML = "";
                 document.getElementById('helpBlock5').innerHTML = "";
                 checkcid();
                 checkuname();
                 checkpublishacl();
                 checksubscribeacl();
                 if(flag==1){
                   //alert("Flag is False");
                     return false;
                 }
                 else{
                    //alert("Flag is True");
                     return true;
               }
       }
 </script>
     <?php include "functions.php"?>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="home.php">Home</a>
    <div class="subnav">
    <button class="subnavbtn">Device Management <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="listr.php">List of Devices</a>
      <a href="deviceregister.php">Register a New Device</a>
    </div>
  </div>
    <a href="logout.php?logout">Log Out</a>
  </div>
  <div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu </span>
  </div>
   <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <div class="form-group">
        <br><br><br>
      <center><img src="img/CSRIoT_Logo1.png"></img></center>
      <br>
    </div>
      <?php
        editDevicePop();
      ?>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
  <?php include "includes/footer.php"?>

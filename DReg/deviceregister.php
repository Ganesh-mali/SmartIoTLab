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
     <?php include "functions.php"?>
		 <script type="text/javascript">
				 var flag=0;
				 function checkclientid(){
				 		var id = /^[a-zA-Z0-9_-]+$/;
            //alert("Inside Check clientid");
				 if(document.drform.clientid.value == ""){
				 		 document.getElementById('helpBlock1').innerHTML = 'Please Enter the Client Id';
				 		flag=1;
				  }
          else if(document.drform.clientid.value.length>128){
              document.getElementById('helpBlock1').innerHTML = 'Client Id cant be greater than 128 characters';
              flag=1;
          }
				  else if(!document.drform.clientid.value.match(id)){
				 		 document.getElementById('helpBlock1').innerHTML = 'No special characters allowed except underscore(_) and dash(-)';
				 		flag=1;
				  }
				 }

				 function checkusername(){
					var un_pattern = /^[a-zA-Z0-9_-]+$/;
					if(document.drform.username.value == ""){
							document.getElementById('helpBlock2').innerHTML = 'Please Enter the Username';
							flag=1;
					}
						 else if(document.drform.username.value.length>128){
								 document.getElementById('helpBlock2').innerHTML = 'Username cant be greater than 128 characters';
								 flag=1;
						 }
						 else if(!document.drform.username.value.match(un_pattern)){
								 document.getElementById('helpBlock2').innerHTML = 'No special characters allowed except underscore(_) and dash(-)';
								 flag=1;
						 }
				 }

         function checkpassword(){
					var p_pattern = /^[a-zA-Z0-9_-]+$/;
					if(document.drform.password.value == ""){
							document.getElementById('helpBlock3').innerHTML = 'Please Enter the Password';
							flag=1;
					}
						 else if(document.drform.password.value.length>128){
								 document.getElementById('helpBlock3').innerHTML = 'Name should be of Maximun 128 characters';
								 flag=1;
						 }
						 else if(!document.drform.password.value.match(p_pattern)){
								 document.getElementById('helpBlock3').innerHTML = 'No special characters allowed except underscore(_) and dash(-)';
								 flag=1;
						 }
				 }

         function checkpublishacl(){
					if(document.drform.publishacl.value == ""){
							document.getElementById('helpBlock4').innerHTML = 'Please Enter the Publish ACL';
							flag=1;
					}
						 else if(document.drform.publishacl.value.length>65535){
								 document.getElementById('helpBlock4').innerHTML = 'Publish ACL should be of Maximun 65535 characters';
								 flag=1;
						 }
				 }

				 function checksubscribeacl(){
				 if(document.drform.subscribeacl.value == ""){
						 document.getElementById('helpBlock5').innerHTML = 'Please Enter the Subscribe ACL';
						 flag=1;
				 }
						else if(document.drform.subscribeacl.value.length>65535){
								document.getElementById('helpBlock5').innerHTML = 'Subscribe ACL should be of Maximun 65535 characters';
								flag=1;
						}
				}

						function validate(){
							console.log("Called:validation function");
								flag=0;
									document.getElementById('helpBlock1').innerHTML = "";
									document.getElementById('helpBlock2').innerHTML = "";
									document.getElementById('helpBlock3').innerHTML = "";
									document.getElementById('helpBlock4').innerHTML = "";
									document.getElementById('helpBlock5').innerHTML = "";
									checkclientid();
									checkusername();
									checkpassword();
									checkpublishacl();
									checksubscribeacl();
									if(flag==1){
											return false;
									}
									else{
									    return true;
								}
        }

	</script>

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
      <form id="drform" class="form-horizontal" method="post" name="drform" onsubmit="return(validate());">
        <fieldset>

          <!-- Form Name -->

          <legend>MQTT Device Registration</legend>
					<p style="color:#4286f4">Note:Once a password is set for device, it can't be changed later</p>
					<p style="color:#4286f4">Publish/Subscribe Pattern Eg:[{"pattern":"a/b/c"},{"pattern":"b/c/d"}]</p>
					<br>
					<p id="success1" class="bg-success">
					<?php
					//function name
          registerDevice();
					?>
					</p>
					<div id="messages"></div>

					<!-- Text input-->

          <div class="form-group">
            <label class="col-sm-3 control-label" for="clientid">Client_ID</label>
            <div class="col-sm-9">
              <input type="text" name="clientid" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock1" class="help-block"></span>
							</div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="username">Username</label>
            <div class="col-sm-9">
              <input type="text" name="username" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock2" class="help-block"></span>
							</div>
            </div>
          </div>

          <!-- Text input-->


          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="password">Password</label>
            <div class="col-sm-9">
              <input type="text" name="password" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock3" class="help-block"></span>
							</div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="publishacl">Publish_acl</label>
            <div class="col-sm-9">
              <input type="text" name="publishacl" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock4" class="help-block"></span>
							</div>
            </div>
          </div>
         <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="subscribeacl">Subscribe_acl</label>
            <div class="col-sm-9">
              <input type="text" name="subscribeacl" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock5" class="help-block"></span>
							</div>
            </div>
            </div>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                <button id="btnReg" type="submit" class="btn btn-primary" name="submit" value="submit">Register</button>
              </div>
            </div>
          </div>
        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
  <?php include "includes/footer.php"?>

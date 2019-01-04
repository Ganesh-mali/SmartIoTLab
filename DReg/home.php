
<?php
session_start();
?>
    <?php include "includes/header.php"?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
		<script src="http://www.hivemq.com/demos/websocket-client/js/mqttws31.js" type="text/javascript"></script>

     <?php include "functions.php"?>
		 <script type="text/javascript">


				 var flag=0;
				 function checkclientid(){
				 		var id = /^[a-zA-Z0-9_-]+$/;

				 if(document.stuform.clientid.value == ""){
				 		 document.getElementById('helpBlock1').innerHTML = 'Please Enter the Client Id';
				 		flag=1;
				  }
          else if(document.stuform.clientid.value.length>128){
              document.getElementById('helpBlock1').innerHTML = 'Client Id cant be greater than 128 characters';
              flag=1;
          }
				  else if(!document.stuform.clientid.value.match(id)){
				 		 document.getElementById('helpBlock1').innerHTML = 'No special characters allowed except underscore(_) and dash(-)';
				 		flag=1;
				  }
				 }

				 function checkusername(){
					var un_pattern = /^[a-zA-Z0-9_-]+$/;
					if(document.stuform.username.value == ""){
							document.getElementById('helpBlock2').innerHTML = 'Please Enter the Username';
							flag=1;
					}
						 else if(document.stuform.username.value.length>128){
								 document.getElementById('helpBlock2').innerHTML = 'Username cant be greater than 128 characters';
								 flag=1;
						 }
						 else if(!document.stuform.username.value.match(letters)){
								 document.getElementById('helpBlock2').innerHTML = 'No special characters allowed except underscore(_) and dash(-)';
								 flag=1;
						 }
				 }

         function checkpassword(){
					var p_pattern = /^[a-zA-Z0-9_-]+$/;
					if(document.stuform.password.value == ""){
							document.getElementById('helpBlock3').innerHTML = 'Please Enter the Password';
							flag=1;
					}
						 else if(document.stuform.password.value.length>128){
								 document.getElementById('helpBlock3').innerHTML = 'Name should be of Maximun 128 characters';
								 flag=1;
						 }
						 else if(!document.stuform.password.value.match(letters)){
								 document.getElementById('helpBlock3').innerHTML = 'No special characters allowed except underscore(_) and dash(-)';
								 flag=1;
						 }
				 }

         function checkpublishacl(){
					if(document.stuform.publishacl.value == ""){
							document.getElementById('helpBlock4').innerHTML = 'Please Enter the Publish ACL';
							flag=1;
					}
						 else if(document.stuform.publishacl.value.length>65535){
								 document.getElementById('helpBlock4').innerHTML = 'Publish ACL should be of Maximun 65535 characters';
								 flag=1;
						 }
				 }

				 function checksubscribeacl(){
				 if(document.stuform.subscribeacl.value == ""){
						 document.getElementById('helpBlock5').innerHTML = 'Please Enter the Subscribe ACL';
						 flag=1;
				 }
						else if(document.stuform.subscribeacl.value.length>65535){
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
									checkpublishacl()
									checksubscribeacl();
									if(flag==1){
											return false;
									}
									else{
									    return true;
								}
        }

	</script>
   <div class="container">
     <a href="logout.php?logout">Log Out</a>
    <div class="col-md-4 col-md-offset-4">
      <div class="form-group">
        <br><br><br>
      <center><img src="img/CSRIoT_Logo1.png"></img></center>
      <br>
      </div>
      <form id="myForm" class="form-horizontal" method="post" name="stuform" onsubmit="return(validate());">
        <fieldset>

          <!-- Form Name -->

          <legend>MQTT Device Registration</legend>
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
              <input type="text" name="publishacl" class="form-control" placeholder='[{"pattern":"a/b/c"},{"pattern":"b/c/d"}]' required>
							<div class="form-group has-error">
							<span id="helpBlock4" class="help-block"></span>
							</div>
            </div>
          </div>
         <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="subscribeacl">Subscribe_acl</label>
            <div class="col-sm-9">
              <input type="text" name="subscribeacl" class="form-control" placeholder='[{"pattern":"a/b/c"},{"pattern":"b/c/d"}]' required>
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

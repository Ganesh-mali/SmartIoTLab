<?php include "includes/header.php"?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
		<script src="http://www.hivemq.com/demos/websocket-client/js/mqttws31.js" type="text/javascript"></script>
    <script src="includes/sidebarscript.js" type="text/javascript"></script>
     <?php include "functions.php"?>
		 <script>
		 flag=0;
		 function checkemaild(){
				 var email = /^[a-z0-9]((\.?|\_?)[a-z0-9]){5,}@el\.vjti\.ac\.in$/;
				 if(document.pform.emailid.value == ""){
					document.getElementById('helpBlock1').innerHTML = 'Please Enter the Email Id';
				 flag=1;
					}
				 else if(!document.pform.emailid.value.match(email)){
					document.getElementById('helpBlock1').innerHTML = 'Please Enter the Email Id in proper format';
				 flag=1;
					}

		 }
		 function validate(){
				 flag=0;
				 document.getElementById('helpBlock1').innerHTML = "";
				 checkemaild();
				 if(flag==1){
						 return false;
				 }
				 else{
						 return true;
				 }
		 }
		 </script>
   <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <div class="form-group">
        <br><br><br>
      <center><img src="img/CSRIoT_Logo1.png"></img></center>
      <br>
      </div>
			<button id="btnReg" class="btn btn-info" onclick="window.location.href='index.php'">Go Back to Login Page</button>
			<br>
			<br>
      <form id="preset" class="form-horizontal" method="post" name="pform" onsubmit="return(validate());">
				<fieldset>

          <!-- Form Name -->

          <legend>Password Reset</legend>
					<p id="success1" class="bg-success">
					<?php
					//function name
          resetPassword();
					?>
					</p>
					<div id="messages"></div>

					<!-- Text input-->

          <div class="form-group">
            <label class="col-sm-3 control-label" for="clientid">Enter your email id</label>
            <div class="col-sm-9">
              <input type="text" name="emailid" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock1" class="help-block"></span>
							</div>
            </div>
          </div>
					<div class="form-group">
            <div class="col-lg-6 col-sm-10">
              <div class="pull-right">
                <button id="btnReg" type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
              </div>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
    </div><!-- /.col-lg-12 --><!-- /.row -->
  <?php include "includes/footer.php"?>

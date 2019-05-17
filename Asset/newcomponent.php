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

     <?php include "functions.php"?>
		 <script type="text/javascript">
				 var flag=0;
				 function checkstudentid(){
				 		var id = /^[0-9]{9}$/;
				 if(document.stuform.studentid.value == ""){
				 		 document.getElementById('helpBlock2').innerHTML = 'Please Enter the Student Id.';
				 		flag=1;
				  }
				  else if(!document.stuform.studentid.value.match(id)){
				 		 document.getElementById('helpBlock2').innerHTML = 'Please Enter 9 digit Student Id';
				 		flag=1;
				  }
				 }

				 function checkname(){
					var letters = /^[A-Za-z]+$/;
					if(document.stuform.name.value == ""){
							document.getElementById('helpBlock3').innerHTML = 'Please Enter the First Name';
							flag=1;
					}
						 else if(document.stuform.name.value.length>30){
								 document.getElementById('helpBlock3').innerHTML = 'Name should be of Maximun 30 characters';
								 flag=1;
						 }
						 else if(!document.stuform.name.value.match(letters)){
								 document.getElementById('helpBlock3').innerHTML = 'Name should only contain alphabet characters';
								 flag=1;
						 }

				 }

				 function checkemailid(){
						 var email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
						 if(document.stuform.emailid.value == ""){
							document.getElementById('helpBlock4').innerHTML = 'Please Enter the Email Id';
						 flag=1;
							}
						 else if(!document.stuform.emailid.value.match(email)){
							document.getElementById('helpBlock4').innerHTML = 'Please Enter the Email Id in proper format';
						 flag=1;
							}

				 }

				 function checkclass(){
				 var letters = /^[A-Za-z]+$/;
				 if(document.stuform.class.value == ""){
						 document.getElementById('helpBlock5').innerHTML = 'Please Enter the Class name';
						 flag=1;
				 }
						else if(document.stuform.class.value.length>20){
								document.getElementById('helpBlock5').innerHTML = 'Class Name should be of Maximun 20 characters';
								flag=1;
						}
						else if(!document.stuform.class.value.match(letters)){
								document.getElementById('helpBlock5').innerHTML = 'Class should only contain alphabet characters';
								flag=1;
						}

				}

				 function checkmobile(){
						 var mobileno = /^[0-9]{10}$/;
				 if(document.stuform.mobileno.value == ""){
							document.getElementById('helpBlock6').innerHTML = 'Please Enter the Mobile No.';
						 flag=1;
					}
					else if(!document.stuform.mobileno.value.match(mobileno)){
							document.getElementById('helpBlock6').innerHTML = 'Please Enter 10 digit mobile number';
						 flag=1;
					}
				 }

				 function checkpmobile(){
						 var mobileno = /^[0-9]{10}$/;
				 if(document.stuform.pmobileno.value == ""){
							document.getElementById('helpBlock7').innerHTML = 'Please Enter the Mobile No.';
						 flag=1;
					}
					else if(!document.stuform.pmobileno.value.match(mobileno)){
							document.getElementById('helpBlock7').innerHTML = 'Please Enter 10 digit mobile number';
						 flag=1;
					}
				 }
						function validate(){
							attempt++;
							console.log("Called:validation function");
								flag=0;
								if(flags==false){
									document.getElementById('helpBlock1').innerHTML = "";
									document.getElementById('helpBlock2').innerHTML = "";
									document.getElementById('helpBlock3').innerHTML = "";
									document.getElementById('helpBlock4').innerHTML = "";
									document.getElementById('helpBlock5').innerHTML = "";
									document.getElementById('helpBlock6').innerHTML = "";
									document.getElementById('helpBlock7').innerHTML = "";
									checkstudentid();
									checkname();
									checkemailid();
									checkclass();
									checkmobile();
									checkpmobile();
									if(flag==1){
											return false;
									}
									else{
									return true;
								}
					}
				}

	</script>
    <?php include "includes/Topbar.php"?>
   <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <form id="myForm" class="form-horizontal" method="post" name="stuform" onsubmit="return(validate());">
        <fieldset>

          <!-- Form Name -->
          <legend>Add New Component Details</legend>
					<p id="success1" class="bg-success">
					<?php
					addNewComponent();
					?>
					</p>
					<div id="messages"></div>
          <!-- Text input-->

          <div class="form-group">
            <label class="col-sm-3 control-label" for="studentid">Component Code</label>
            <div class="col-sm-9">
              <input type="text" name="ccode" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock2" class="help-block"></span>
							</div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="name">Component Name</label>
            <div class="col-sm-9">
              <input type="text" name="cname" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock3" class="help-block"></span>
							</div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="emailid">Total Quantity</label>
            <div class="col-sm-9">
              <input type="text" name="totalq" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock4" class="help-block"></span>
							</div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="class">Available Quantity</label>
            <div class="col-sm-9">
              <input type="text" name="availq" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock5" class="help-block"></span>
							</div>
            </div>
          </div>
         <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="mobileno">Entry Date</label>
            <div class="col-sm-9">
              <input type="date" name="edate" class="form-control" required>
							<div class="form-group has-error">
							<span id="helpBlock6" class="help-block"></span>
							</div>
            </div>
            </div>

						<!-- Text input-->
						 <div class="form-group">
							 <label class="col-sm-3 control-label" for="pmobileno">Updated Date</label>
							 <div class="col-sm-9">
								 <input type="date" name="udate" class="form-control" required>
								 <div class="form-group has-error">
								 <span id="helpBlock7" class="help-block"></span>
								 </div>
							 </div>
							 </div>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                <button id="btnReg" type="submit" class="btn btn-primary" name="add">Add Component</button>
              </div>
            </div>
          </div>
        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
  <?php include "includes/footer.php"?>

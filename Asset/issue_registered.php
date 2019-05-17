<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
?>
    <?php include "includes/header.php"?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>

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
							alert("Inside function validate");
							var container = document.getElementById("container");
							var input = document.createElement("input");
							input.type = "hidden";
							input.name = "count";
							input.value = count;
							alert(count);
							container.appendChild(input);
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
				var cname = "s"
			  var qname = "q"
			  var count =0;
			  function addRow(){
			      var container = document.getElementById("container");
			      container.appendChild(document.createTextNode("Component Name "));
			      var input = document.createElement("select");
			      //input.type = "select";
			      <?php
			      global $connection;
			      $query1="SELECT ComponentName, ComponentCode FROM components";
			      $result=mysqli_query($connection,$query1);
			      $array = array();
			      while($row=mysqli_fetch_assoc($result)){
			          $name = $row['ComponentName']." (".$row['ComponentCode'].") ";
			          $array[]=$name;
			      }
			      $total = count($array);
			      sort($array, SORT_STRING);
			      for($x = 0; $x < $total; $x++){
			        ?>
			        var opt = document.createElement("OPTION");
			        opt.text = '<?php echo $array[$x]; ?>';
			        opt.value = '<?php echo $array[$x]; ?>';
			        input.appendChild(opt)
			        <?php
			      }
			       ?>
			      input.name = cname + (++count);
			      container.appendChild(input);

			      //Appending Quantity
			      container.appendChild(document.createTextNode("Quantity"));
			      var input = document.createElement("input");
			      input.type = "text";
			      input.name = qname + count;
			      container.appendChild(input);

			      container.appendChild(document.createElement("br"));
						//return false;
			  }
			  function removeRow(){
			      if(count!=0){
			        container.removeChild(container.lastChild);
			        container.removeChild(container.lastChild);
			        container.removeChild(container.lastChild);
			        container.removeChild(container.lastChild);
			        container.removeChild(container.lastChild);
			        count--;
			      }
						//return false;
			    }

	</script>
    <?php include "includes/Topbar.php"?>
   <div class="containr">
    <div class="col-md-6 col-md-offset-4">
      <form id="myForm" class="form-horizontal" method="post" name="stuform" onsubmit="return(validate());">
        <fieldset>

          <!-- Form Name -->
          <legend>Component Issue Details</legend>
					<p id="success1" class="bg-success">
					<?php
					issueRegistered();
					?>
					</p>
					<div id="messages"></div>
          <!-- Text input-->
            <div class="form-group">
              <label class="col-sm-3 control-label" for="namedrop">Student Details</label>
                <!--<input type="text" name="totalq" class="form-control" required> -->
                <div class="col-sm-9">
                  <?php
                  global $connection;
                  echo '<select name = "namedrop">';
                  $query1="SELECT name, rollno FROM Students";
                  $result=mysqli_query($connection,$query1);
                  $array = array();
                  while($row=mysqli_fetch_assoc($result)){
                      $name = $row['name']." (".$row['rollno'].") ";
                      $array[]=$name;
                  }
                  $total = count($array);
                  sort($array, SORT_STRING);
                  for($x = 0; $x < $total; $x++){
                    echo '<option value = "'.$array[$x].'">'.$array[$x].'</option>"';
                  }
                  echo '</select>';
                   ?>
    							<div class="form-group has-error">
    							<span id="helpBlock3" class="help-block"></span>
    							</div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-3 control-label" for="comdrop">Components</label>
              <!--<input type="text" name="totalq" class="form-control" required> -->
              <div class="col-sm-9">
								<button type="button" onclick="addRow()">Add row</button>
								<button type="button" onclick="removeRow()">Remove row</button>
								    <div id="container">
								    </div>
  							<div class="form-group has-error">
  							<span id="helpBlock3" class="help-block"></span>
  							</div>
          </div>
        </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-left">
                <button id="btnReg" type="submit" class="btn btn-primary" name="issue">Submit</button>
              </div>
            </div>
          </div>
        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
  <?php include "includes/footer.php"?>

    <?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include "includes/header.php"?>
     <?php include "functions.php"?>
       <script>
           var flag=0;
           function checkfname(){
            var letters = /^[A-Za-z]+$/;
            if(document.myform.fname.value == ""){
                document.getElementById('helpBlock1').innerHTML = 'Please Enter the First Name';
                flag=1;
            }
               else if(document.myform.fname.value.length>20){
                   document.getElementById('helpBlock1').innerHTML = 'First Name should be of Maximun 20 characters';
                   flag=1;
               }
               else if(!document.myform.fname.value.match(letters)){
                   document.getElementById('helpBlock1').innerHTML = 'First Name should only contain alphabet characters';
                   flag=1;
               }

           }
           function checklname(){
               var letters = /^[A-Za-z]+$/;
              if(document.myform.lname.value == ""){
                document.getElementById('helpBlock2').innerHTML = 'Please Enter the Last Name';
                flag=1;
              }
               else if(document.myform.lname.value.length>20){
                   document.getElementById('helpBlock2').innerHTML = 'Last Name should be of Maximun 20 characters';
                   flag=1;
               }
               else if(!document.myform.lname.value.match(letters)){
                   document.getElementById('helpBlock2').innerHTML = 'Last Name should only contain alphabet characters';
                   flag=1;
               }
           }
           function checkemaild(){
               var email = /^[a-z0-9]((\.?|\_?)[a-z0-9]){5,}@el\.vjti\.ac\.in$/;
               if(document.myform.emailid.value == ""){
                document.getElementById('helpBlock3').innerHTML = 'Please Enter the Email Id';
               flag=1;
                }
               else if(!document.myform.emailid.value.match(email)){
                document.getElementById('helpBlock3').innerHTML = 'Please Enter the Email Id in proper format';
               flag=1;
                }

           }
           function checkmobile(){
               var mobileno = /^[0-9]{10}$/;
           if(document.myform.mobileno.value == ""){
                document.getElementById('helpBlock4').innerHTML = 'Please Enter the Mobile No.';
               flag=1;
            }
            else if(!document.myform.mobileno.value.match(mobileno)){
                document.getElementById('helpBlock4').innerHTML = 'Please Enter 10 digit mobile number';
               flag=1;
            }
           }
           function checkusername(){
               var alphanum = /^[A-Za-z0-9]+$/;
               if(document.myform.username.value == ""){
                document.getElementById('helpBlock5').innerHTML = 'Please Enter the Username';
               flag=1;
            }
               else if(!document.myform.username.value.match(alphanum)){
                document.getElementById('helpBlock5').innerHTML = 'Please Enter only alphanumberic characters';
               flag=1;
            }
           }
           function checkpassword(){
               if(document.myform.password.value == ""){
                document.getElementById('helpBlock6').innerHTML = 'Please Enter the Password';
               flag=1;
            }
           }
           function checkrpassword(){
               if(document.myform.rpassword.value == ""){
                document.getElementById('helpBlock7').innerHTML = 'Please Re-enter the password';
               flag=1;
            }
               else if(document.myform.password.value!=document.myform.rpassword.value){
                   document.getElementById('helpBlock7').innerHTML = 'Passwords do not match';
               flag=1;
               }
           }
           function checkCaptcha(){
                ctotal=document.myform.captchaResult.value;
                var fnum=document.myform.firstNumber.value;
                var snum=document.myform.secondNumber.value;
                total=Number(fnum)+Number(snum);
               if(document.myform.captchaResult.value == ""){
                    document.getElementById('helpBlock8').innerHTML = 'Please Enter a value';
                    flag=1;
                }
                else if(total!=ctotal){
                    document.getElementById('helpBlock8').innerHTML = 'Please Enter the value correctly';
                    flag=1;
                }
           }
              function validate(){
                  flag=0;
                  document.getElementById('helpBlock1').innerHTML = "";
                  document.getElementById('helpBlock2').innerHTML = "";
                  document.getElementById('helpBlock3').innerHTML = "";
                  document.getElementById('helpBlock4').innerHTML = "";
                  document.getElementById('helpBlock5').innerHTML = "";
                  document.getElementById('helpBlock6').innerHTML = "";
                  document.getElementById('helpBlock7').innerHTML = "";
                  document.getElementById('helpBlock8').innerHTML = "";
                  checkfname();
                  checklname();
                  checkmobile();
                  checkpassword();
                  checkrpassword();
                  checkusername();
                  checkemaild();
                  checkCaptcha();
                  if(flag==1){
                      return false;
                  }
                  else{
                      return true;
                  }
              }

    </script>
        <div class="container">
            <div class="col-sm-6 col-md-offset-4 col-lg-5">
              <br><br><br>
            <center><img src="img/CSRIoT_Logo1.png"></img></center>
            <br>
                <h1 class="text-center">New User Registration</h1>
                <p id="success1" class="bg-success">
                <?php
                registerNewUser();
                ?>
                </p>
                <form method="post" name="myform" onsubmit="return(validate());">
                  <table class="table table-bordered">
                  <tr><td>
                   <div class="form-group">
                        <label for="fname">Enter First Name</label>
                        <input type="text" name="fname" class="form-control">
                        <div class="form-group has-error">
                        <span id="helpBlock1" class="help-block"></span>
                        </div>
                    </div>
                      </td></tr>
                      <tr><td>
                    <div class="form-group">
                        <label for="lname">Enter Last Name</label>
                        <input type="text" name="lname" class="form-control">
                        <div class="form-group has-error">
                        <span id="helpBlock2" class="help-block"></span>
                        </div>
                    </div>
                          </td></tr>
                    <tr><td>
                    <div class="form-group">
                        <label for="emailid">Enter Email Id</label>
                        <input name="emailid" class="form-control">
                        <div class="form-group has-error">
                        <span id="helpBlock3" class="help-block"></span>
                        </div>
                    </div>
                        </td></tr>
                        <tr><td>
                    <div class="form-group">
                        <label for="mobileno">Enter 10 digit Mobile No.</label>
                        <input type="text" name="mobileno" class="form-control">
                        <div class="form-group has-error">
                        <span id="helpBlock4" class="help-block"></span>
                        </div>
                    </div>
                            </td></tr>
                            <tr><td>
                    <div class="form-group">
                        <label for="username">Enter Username</label>
                        <input type="text" name="username" class="form-control">
                        <div class="form-group has-error">
                        <span id="helpBlock5" class="help-block"></span>
                        </div>
                    </div>
                                </td></tr>
                    <tr><td>
                    <div class="form-group">
                        <label for="password">Enter Password</label>
                        <input type="password" name="password" class="form-control">
                        <div class="form-group has-error">
                        <span id="helpBlock6" class="help-block"></span>
                        </div>
                    </div>
                        </td></tr>
                        <tr><td>
                    <div class="form-group">
                        <label for="rpassword">Reenter Password</label>
                        <input type="password" name="rpassword" class="form-control">
                        <div class="form-group has-error">
                        <span id="helpBlock7" class="help-block"></span>
                        </div>
                    </div>
                        </td>
                      </tr>

                           <tr><td>
                              <div class="form-group">
                              <?php
$min_number = 1;
	$max_number = 20;

	$random_number1 = mt_rand($min_number, $max_number);
	$random_number2 = mt_rand($min_number, $max_number);
?>
                             <label for="captchaResult">Are you human?</label>
		<?php
			echo $random_number1 . ' + ' . $random_number2 . ' = ';
		?>
		<input name="captchaResult" type="text" class="form-control"/>

		<input name="firstNumber" type="hidden" value="<?php echo $random_number1; ?>" />
		<input name="secondNumber" type="hidden" value="<?php echo $random_number2; ?>" />
                              <div class="form-group has-error">
                        <span id="helpBlock8" class="help-block"></span>
                        </div>
                               </div>
                               </td></tr>
                            <tr><td>
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                </td></tr>
                                <tr><td>
                    <a href="index.php">Sign In Here</a>
                                    </td></tr>

                    </table>
                </form>
            </div>
        </div>

        <?php include "includes/footer.php"?>

<?php
session_start();
if(isset($_SESSION['user']))
{
	header("Location: home.php");
}?>
<?php include "includes/header.php"?>
<?php include "functions.php"?>
<style type="text/css">
.container {
   margin-top: 150px;
}
</style>
 <div class="container">
 <div class="col-sm-6 col-md-offset-4 col-lg-3">
   <center><img src="img/CSRIoT_Logo1.png" width="90%"></img></center>
	 <center><h5>(Beta Version)</h5></center>
    <h2>User Login Portal</h2>
		<h5 style="color:red"><?php
		    checkLogin();
		    ?></h5>
<form method="post">
<table class="table table-bordered">
    <tr><td>
       <div class="form-group">
        <label for="username">Username</label>
    <input type="text" name="username" required class="form-control">
    </div>
    </td></tr>
    <tr><td>
       <div class="form-group">
        <label for="password">Password</label>
    <input type="password" name="password" required class="form-control">
        </div>
    </td></tr>
    <tr><td>
        <button type="submit" name="login" class="btn btn-primary">Sign In</button>
    </td></tr>
    <tr><td>
        <a href="passwordreset.php">Forgot Password?</a>
    </td></tr>
    <tr><td>
        <a href="userregister.php">Sign Up Here</a>
    </td></tr>
</table>
</form>
     </div>
</div>
<?php include "includes/footer.php"?>

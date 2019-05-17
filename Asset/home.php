<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
?>
<?php include "includes/header.php";?>
<?php include "functions.php";?>
<?php include "includes/Topbar.php"?>
 <?php
    $username=$_SESSION['user'];
		//$_SESSION['mqtt']='disconnected';
		//sessionStorage.mqtt="disconnected";
    echo "<center><h3>Hi ".$username.". Welcome to the IoT Inventory Portal</h3></center>";?>
    <br>
    <center><?php
?><a href="newcomponent.php"><button class="btn btn-primary" type="submit">Add New Component</button></a></center>
<br>
<center><a href="issue_registered.php"><button class="btn btn-primary" type="submit">Issue Registered</button></a></center>
<br>
<center><a href="issue_unregistered.php"><button class="btn btn-primary" type="submit">Issue Unregistered</button></a></center>
<br>
<center><a href="inventorylist.php"><button class="btn btn-primary" type="submit">Inventory List</button></a></center>
<?php include "includes/footer.php";?>

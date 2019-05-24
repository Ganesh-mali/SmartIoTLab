<?php
session_start();
if(isset($_GET['logout']))
{
	global $connection;
	mysqli_close($connection);
	session_destroy();
	unset($_SESSION['user']);
	unset($_SESSION['fname']);
	unset($_SESSION['fname']);
	unset($_SESSION['oldclientid']);
	unset($_SESSION['oldusername']);
}
	header("Location: index.php");
	exit();
?>

<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
?>
<?php include "includes/header.php"?>
<?php include "includes /Topbar.php"?>
<center>
<?php include "functions.php";?>
<?php
registerForEvent();
?>
<button class="btn btn-warning" onclick="history.go(-1)">Go Back </button>
</center>
<?php include "includes/footer.php"?>
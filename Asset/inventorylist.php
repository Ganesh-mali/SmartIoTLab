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
getInventoryList();
?>
<?php include "includes/footer.php";?>

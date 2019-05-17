<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
?>
<?php include "includes/header.php"?>
<?php include "includes /Topbar.php"?>
<div class="container">
    <h5>You can contact us on the following</h5>
    <a href="mailto:esp@gmail.com">esp@gmail.com</a><br>
    <a href="">www.facebook.com/ESP</a><br>
    <a href="">www.twitter.com/ESP</a>
</div>
<?php include "includes/footer.php"?>
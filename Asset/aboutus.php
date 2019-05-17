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
<h5>We are students of VJTI College and We wished to create a platform to share various events like Technical Events, Workshop, Talks etc. You can register and start sharing the events with the world. Thank you</h5>
</div>
<?php include "includes/footer.php"?>
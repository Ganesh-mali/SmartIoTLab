<?php
session_start();
if(isset($_SESSION['user'])!="")
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
<?php
    getDeviceStatus();
    ?>
 <div class="container">

</div>
<?php include "includes/footer.php"?>

<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
?>
    <?php include "includes/header.php"?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
		<script src="http://www.hivemq.com/demos/websocket-client/js/mqttws31.js" type="text/javascript"></script>
    <script src="includes/sidebarscript.js" type="text/javascript"></script>
     <?php include "functions.php"?>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="home.php">Home</a>
    <div class="subnav">
    <button class="subnavbtn">Device Management <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="listr.php">List of Devices</a>
      <a href="deviceregister.php">Register a New Device</a>
    </div>
  </div>
    <a href="logout.php?logout">Log Out</a>
  </div>
  <div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu </span>
  </div>
   <div class="container">
    <div class="col-md-4 col-md-offset-4">
      <div class="form-group">
        <br><br><br>
      <center><img src="img/CSRIoT_Logo1.png"></img></center>
      <br>
      </div>
      <center>
        <h5>MQTT Server Address: 172.18.22.9  Port:1886</h5>
      <?php
      getDeviceList();
      ?>
    </center>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
  <?php include "includes/footer.php"?>

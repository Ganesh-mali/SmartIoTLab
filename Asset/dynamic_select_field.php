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
  <script type="text/javascript">
  var cname = "s"
  var qname = "q"
  var count =0;
  function addRow(){
      var container = document.getElementById("container");
      container.appendChild(document.createTextNode("Component Name "));
      var input = document.createElement("select");
      //input.type = "select";
      input.name = cname + count++;
      <?php
      global $connection;
      $query1="SELECT ComponentName, ComponentCode FROM components";
      $result=mysqli_query($connection,$query1);
      $array = array();
      while($row=mysqli_fetch_assoc($result)){
          $name = $row['ComponentName']." (".$row['ComponentCode'].") ";
          $array[]=$name;
      }
      $total = count($array);
      sort($array, SORT_STRING);
      for($x = 0; $x < $total; $x++){
        ?>
        var opt = document.createElement("OPTION");
        opt.text = '<?php echo $array[$x]; ?>';
        opt.value = '<?php echo $array[$x]; ?>';
        input.appendChild(opt)
        <?php
      }
       ?>
      input.name = cname + count++;
      container.appendChild(input);

      //Appending Quantity
      container.appendChild(document.createTextNode("Quantity"));
      var input = document.createElement("input");
      input.type = "text";
      input.name = qname + count++;
      container.appendChild(input);

      container.appendChild(document.createElement("br"));
  }
  function removeRow(){
      if(count!=0){
        container.removeChild(container.lastChild);
        container.removeChild(container.lastChild);
        container.removeChild(container.lastChild);
        container.removeChild(container.lastChild);
        container.removeChild(container.lastChild);
        count--;
      }

    }
  </script>
</head>
<body>
<button onclick="addRow()">Add row</button>
<button onclick="removeRow()">Remove row</button>
    <div id="container">
    </div>
<?php include "includes/footer.php";?>

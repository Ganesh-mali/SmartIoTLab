<html>
<head>
  <script type="text/javascript">
  var cname = "c"
  var count =0;
  function addRow(){
      var container = document.getElementById("container");
      container.appendChild(document.createTextNode("Component Name "));
      var input = document.createElement("input");
      input.type = "text";
      input.name = cname + count++;
      container.appendChild(input);
      container.appendChild(document.createElement("br"));
  }
  function removeRow(){
      if(count!=0){
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
</body>
</html>

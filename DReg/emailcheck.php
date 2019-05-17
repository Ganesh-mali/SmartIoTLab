<html>
<head>
</head>
<script>
function validate(){
  var emailregex = /^[a-z0-9](\.?[a-z0-9]){5,}@el\.vjti\.ac\.in$/;
  if(document.getElementById('email').value.match(emailregex)){
    alert("Valid VJTI email Id");
    return true;
  }
  else{
    alert("Invalid VJTI email Id");
    return false;
  }
}
</script>
<body>
  <form onsubmit="return validate();">
    <input id="email" type="text"></input>
    <button type="Submit">Submit</button>
  </form>
</body>
</html>

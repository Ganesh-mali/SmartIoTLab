<?php include "includes/header.php"?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="http://www.hivemq.com/demos/websocket-client/js/mqttws31.js" type="text/javascript"></script>
<script src="includes/sidebarscript.js" type="text/javascript"></script>
<?php include "functions.php"?>
<script>
    var flag=0;
    function checkpassword(){
      //alert("inside check password");
        if(document.rform.password.value == ""){
         document.getElementById('helpBlock1').innerHTML = 'Please Enter the Password';
        flag=1;
     }
    }
    function checkrpassword(){
      //alert("inside check rpassword");
        if(document.rform.rpassword.value == ""){
         document.getElementById('helpBlock2').innerHTML = 'Please Re-enter the password';
        flag=1;
     }
        else if(document.rform.password.value!=document.rform.rpassword.value){
            document.getElementById('helpBlock2').innerHTML = 'Passwords do not match';
        flag=1;
        }
    }
       function validate(){
           flag=0;
           document.getElementById('helpBlock1').innerHTML = "";
           document.getElementById('helpBlock2').innerHTML = "";
           checkpassword();
           checkrpassword();
           if(flag==1){
               return false;
           }
           else{
               return true;
           }
       }

</script>
<?php
confirmprcode();
?>

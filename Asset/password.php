<?php include "includes/header.php"?>
<?php include "functions.php"?>
<div class="container">
<div class="col-sm-6">
    <h1 class="text-center">VHOAM</h1>
    <p id="success1" class="bg-success">
                <?php
                sendPassword();
                ?>
                </p>
<form method="post">
<table class="table table-bordered">
<p>
   We will mail you your password if your username exists in our database
    </p>
<tr><td>
<div class="form-group">
    <label for="username">Enter your username</label>
    <input type="text" name="username" class="form-control" required>
</div>
    </td></tr>
    <tr><td>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </td></tr>
        <tr><td>
         <button class="btn btn-warning" onclick="history.go(-1);">Back </button>
        </td></tr>
    </table>
</form>
</div>
</div>
<?php include "includes/footer.php"?>
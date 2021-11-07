<?php
include "/db_config/db1.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="loginBox">
	<h2><font color = "#fff">Log In</font> </h2>
    <h2><font color = "#1a73e8"></font> </h2>
	<form class="myform" action="auditorlogin.php" method="post">
		<p></p>
        <input type="text" name ="username" class="inputvalues" placeholder="Enter Username" required style="width: 278px">
        <p></p>
        <input type="Password" name ="password" class="inputvalues" placeholder="Enter Password" required  style="width: 278px"><br><br>
		<input type="submit" name = "login" id="login_btn" value="Login">
	</form>
	<?php
    if(isset($_POST['login']))
    {    
    	$username = $_POST['username'];
    	$password = $_POST['password'];
    	$query = "select * from audlogin WHERE username = '$username' AND password = '$password'";
    	$query_run = mysqli_query($db,$query);
    	if(mysqli_num_rows($query_run)>0)
    	{     $_SESSION['username'] = $username;
            header('location:auditorinboxdashboard.php');

          		}
          		
    	    
    	    else
    	    {
    	    	echo'<script type="text/javascript"> alert ("Invalid Credentials..!!")</script>';
          		}
    	    
    	}

	?>

</div>
</body>
</html>
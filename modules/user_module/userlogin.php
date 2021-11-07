<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="loginBox">
	<h2><font color = "#fff">Sign up</font> </h2>
	<h2><font color = "#1a73e8"></font> </h2>
	<form class="myform" action="userlogin.php" method="post">
		<p></p>
		<input type="text" name ="username" class="inputvalues" placeholder="Enter Username" required>
		<p></p>
		<input type="Password" name ="password" class="inputvalues" placeholder="Enter Password" required ><br>
		<input type="Password" name ="cpassword" class="inputvalues" placeholder=" confirm Password"  required><br>
		<input type="submit" name ="submit_btn" id="signup_btn" value="Signup">
		<a href="userlogin1.php"><input type="button" name ="back_btn" id="back_btn" value="Login"></a>
		
	</form>
	<?php
	include "/db_config/db1.php";
	if(isset($_POST['submit_btn']))
	{
        
        $username = $_POST['username'];
         $password = $_POST['password'];
          $cpassword = $_POST['cpassword'];
          if($password==$cpassword)
          {
          	$query = "select * from usersignup WHERE username = '$username'";
          	$query_run = mysqli_query($db,$query);
          	if(mysqli_num_rows($query_run)>0)
          	{
          		echo'<script type="text/javascript"> alert ("Already the username exists.....Try another one!!!")</script>';
          	}
          	else
          	{
          		$query = "insert into usersignup values('','$username','$password')";
          		$query_run = mysqli_query($db,$query);
          	
          		if($query_run)
          		{
          			echo'<script type="text/javascript"> alert ("Successfully Registered..!!")</script>';
          		}
          		else
          		{
          			echo mysqli_error($db);
          		}
          	}

          }
          else
          {
          	echo'<script type="text/javascript"> alert ("password and confirm password doesnt match please try again .....!!!")</script>';
          }
	}
	?>

</div>
</body>
</html>
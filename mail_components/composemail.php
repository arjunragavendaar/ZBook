<?php
	
	include"/db_config/db1.php";
	session_start();

	$to=$_POST['reciever'];
	$subject=$_POST['subj'];
	$message=$_POST['message'];
    $result="insert into userinbox values('','{$_SESSION['username']}','$to','$subject','$message',now())";
	$result=mysqli_query($db,$result) or die(mysqli_error($db));
	if($result){
		header("location:http://localhost/expense/auditorinboxdashboard.php");	
	}
?>
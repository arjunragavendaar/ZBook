<?php
include "/db_config/db1.php";
$id=$_POST["id"];




$q1="update expensecard set adminstat=1 where cardid='$id'";
$result1=mysqli_query($db,$q1);
if($result1)
{
	echo "1";
}
else
{ 
	echo "0";
}

?>
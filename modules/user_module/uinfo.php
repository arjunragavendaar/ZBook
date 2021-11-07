<?php
include "/db_config/db1.php";
$id=$_POST["id"];
$value=array();




$query1=" SELECT message FROM userinbox WHERE boxid='$id' ";
$result1=mysqli_query($db,$query1);
$value[0]=mysqli_fetch_row($result1);


$rvalue=json_encode($value);
echo "$rvalue";
?>
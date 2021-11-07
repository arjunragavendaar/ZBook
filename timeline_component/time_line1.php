<?php
include "/db_config/db1.php";
$qy="select * from timeline";
$result=mysqli_query($db,$qy);
	$select=mysqli_num_rows($result);
	$data=array();
	if($select>0){
		while($row=mysqli_fetch_assoc($result)){
			$data[]=$row;
		}
	   echo json_encode($data);
	}
	else{
		echo "0";	
	}




 ?>
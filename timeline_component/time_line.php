<?php
include "/db_config/db1.php";
 if(isset($_POST['tagi'])&&isset($_POST['posti']))
    {
$us=  $_POST['useri'];    
$ta = $_POST['tagi'];
$ar = $_POST['posti'];

$query = "insert into timeline values('','$us','$ta','$ar',now())";
              $query_run = mysqli_query($db,$query);
              if($query_run)
              {
                $qy="select * from timeline where timeid=(select max(timeid) from timeline)";
   $result=mysqli_query($db,$qy);
  $select=mysqli_num_rows($result);
  $data=array();
  if($select>0){
    while($row=mysqli_fetch_assoc($result)){
      $data[]=$row;
    }
     echo json_encode($data);
  }
  else {
    echo "fail";
  }           
}
else {
    mysqli_error($db);
  }
        }
              

    

?>
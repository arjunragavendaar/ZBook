<?php
include "/db_config/db1.php";
$id=$_POST["id"];
$value=array();
$query1=" SELECT fromd FROM expensecard WHERE cardid='$id' ";
$result1=mysqli_query($db,$query1);
$value[0]=mysqli_fetch_row($result1);
$query2="SELECT tod FROM expensecard WHERE cardid='$id' ";
$result2=mysqli_query($db,$query2);
$value[1]=mysqli_fetch_row($result2);
$query3="SELECT nodays FROM expensecard WHERE cardid='$id' ";
$result3=mysqli_query($db,$query3);
$value[2]=mysqli_fetch_row($result3);
$query4="SELECT location FROM expensecard WHERE cardid='$id' ";
$result4=mysqli_query($db,$query4);
$value[3]=mysqli_fetch_row($result4);
$query5="SELECT travel FROM expensecard WHERE cardid='$id' ";
$result5=mysqli_query($db,$query5);
$value[4]=mysqli_fetch_row($result5);
$query6="SELECT food FROM expensecard WHERE cardid='$id' ";
$result6=mysqli_query($db,$query6);
$value[5]=mysqli_fetch_row($result6);
$query7="SELECT aaco FROM expensecard WHERE cardid='$id' ";
$result7=mysqli_query($db,$query7);
$value[6]=mysqli_fetch_row($result7);
$query8="SELECT modp FROM expensecard WHERE cardid='$id' ";
$result8=mysqli_query($db,$query8);
$value[7]=mysqli_fetch_row($result8);
$query9="SELECT tot FROM expensecard WHERE cardid='$id' ";
$result9=mysqli_query($db,$query9);
$value[8]=mysqli_fetch_row($result9);

$rvalue=json_encode($value);
echo "$rvalue";
?>
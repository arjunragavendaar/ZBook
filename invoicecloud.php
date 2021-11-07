<?php
include "/db_config/db1.php";
session_start();
  if(isset($_FILES['image']))
  {
$error=array();
$file_name=$_FILES['image']['name'];
$file_size=$_FILES['image']['size'];
$file_tmp=$_FILES['image']['tmp_name'];
$file_type=$_FILES['image']['type'];
$t=explode('.', $_FILES['image']['name']);
$file_ext= strtolower(end($t));
$extensions=array("jpeg","jpg","png");
if(in_array($file_ext,$extensions)==false){
$error[]="Please choose the invoice with jpg or png!!!";
}
if(empty($error)==true)
{
move_uploaded_file($file_tmp, "C:/xampp/htdocs/expense/invoice/"  . $file_name);
 $path="http://localhost/expense/" . "invoice/" .$file_name;

$qu="insert into invoiceupload values ('','{$_SESSION['username']}','$path',now())";
$query_run1 = mysqli_query($db,$qu);

if($query_run1)
              {
                echo'<script type="text/javascript"> alert ("Successfully Uploaded..!!")</script>';
              }
              else
              {
                echo mysqli_error($db);
              }

}

  }


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
input,select,Button
{
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
  border-radius:20px;
  width:  220px;
}


   .icon-bar {
    background-color: blue !important;
}
.row.content {height:0px}

    
    .sidenav {
      height: 100%;
    }
    
    footer {
      background-color: #f1f1f1;
      color: white;
      padding: 15px;
    }
    
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      } 
    }
     th {
  text-align: left;
  padding: 35px;
}
td
{
   text-align: center;
   padding-bottom: 25px;
}

    
  </style>
</head>
<body>
	<div class="nav1">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Go Expense</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="userlogin.php"> <?php echo $_SESSION['username'] ?>  <span class="glyphicon glyphicon-off"></span></a></li>
      </ul>
    </div>
  </div>
</nav>
</div>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav" id ="scrl" style="background: rgba(0,0,0,0.2); width: 260px;height:608px;background-image: url(bg.jpg);border-radius:20px;margin-top:50px;">
      <h4 style="color: #ffffff"><b>Dashboard</b></h4>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="#section1" style="color: #ffffff">Inbox<span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="#section2" style="color: #ffffff">Create Expense Card</a></li>
        <li><a href="#section3" style="color: #ffffff">View Reports</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section3" style="color: #1eb3e9">Invoice Cloud</a></li>
        <li><a href="#section3" style="color: #ffffff">Plan Your Expense</a></li>
        <li><a href="#section3" style="color: #ffffff">Track Your Expense</a></li>
        <li><a href="#section3" style="color: #ffffff">Expense History</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">

       <div class="well" style="background-color:white;border-color: white;">
         <h4></h4>
        <p></p>
      </div>
<form action="invoicecloud.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="image" >
  <input type="submit" Value="Submit" ><br/>
  <div id ="hed" style="width: 260px;height: 50px;border: 2px solid #f1f1f1;margin-left: 310px;background: #f1f1f1;border-radius:20px;">
    <h4 style="margin-left:60px;">Invoice Reciepts</h4>
  </div><br/>
  <?php
  $i=1;
$q1="select * from invoiceupload where username= '".$_SESSION['username']."'" ;
$r=mysqli_query($db ,$q1);
if(mysqli_num_rows($r)>0)
{
  while($rows=mysqli_fetch_row($r)){
    if($i%3!=0)
    {
  echo "<a href='$rows[2]'><div id='mainboard' style ='width: 300px;height:300px;border:3px solid #dadce0;display:inline-block;border-radius:10px;'><img src=   $rows[2]  width='280' height='280' style='display:inline-block;' />
 </div></a>&nbsp&nbsp&nbsp&nbsp ";
  $i++;
}
else
{
   echo "<a href='$rows[2]'><div id='mainboard' style ='width: 300px;height:300px;border:3px solid #dadce0; display:inline-block;border-radius:10px;'><img src=   $rows[2]  width='280' height='280' />
</div></a><br><br> ";
    $i++;
}
}
  
}

else
{
  echo "No Image Found";
}
?>
  
</form>

    </div>
  </div>
</div>



</body>
</html>

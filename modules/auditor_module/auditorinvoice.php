<?php
include "/db_config/db1.php";
session_start();



$i1="select username from usersignup ";
$ir1=mysqli_query($db,$i1);

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
      .row.content {height: auto;} 
    }
    
    
  </style>
</head>
<body >
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
        <li><a href="#section1" style="color:#ffffff">Inbox  <span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="#section2" style="color: #ffffff">Create Expense Card</a></li>
        <li><a href="#section3" style="color: #ffffff">View Reports</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section3" style="color: #1eb3e9 ">Invoice Cloud</a></li>
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

<?php

while($row1=mysqli_fetch_row($ir1))
{ $i=1;
  $i2=" select * from invoiceupload where username= '$row1[0]'";
  $ir2=mysqli_query($db,$i2);
  echo "<div id='cad' style=' border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;width:300px;height:160px;border-radius:10px;' >
  <img src='round.png' style='height:80px; margin-left:20px;margin-top:30px;display:inline-block;'></img><h3 style='margin-left:10px;display:inline-block;'>Username:</h3><h3 style='margin-left:10px;display:inline-block;'>$row1[0]</h3>

  </div><br>";
  
  while($row2=mysqli_fetch_row($ir2))
  {
     if($i%3!=0)
    {
  echo "<a href='$row2[2]'><div id='mainboard' style ='width: 300px;height:300px;border:3px solid #dadce0;display:inline-block;border-radius:10px;'><img src=   $row2[2]  width='280' height='280' style='display:inline-block;' >
 </div></a>&nbsp&nbsp&nbsp&nbsp ";
  $i++;
}
else
{
   echo "<a href='$row2[2]'><div id='mainboard' style ='width: 300px;height:300px;border:3px solid #dadce0; display:inline-block;border-radius:10px;'><img src=   $row2[2]  width='280' height='280' />
</div></a><br><br> ";
    $i++;
}
}
  }




 ?>
    </div>
  </div>
</div>


</body>
</html>
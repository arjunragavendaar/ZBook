<?php
include "/db_config/db1.php";
session_start();




 $i="select id from usersignup where username='".$_SESSION['username']."'";
              $i_run=mysqli_query($db,$i);
              $r=mysqli_fetch_row($i_run);
  $c1="select max(cardid) from expensecard where  id='$r[0]' and cardid not in (select max(cardid) from expensecard where id='$r[0]')";
  $c_run=mysqli_query($db,$c1);
  $cresult=mysqli_fetch_row($c_run);
  $q="select adminstat,tot ,tdate,location from expensecard where cardid='$cresult[0]'";
  $q_run=mysqli_query($db,$q);
  $q_res=mysqli_fetch_row($q_run);
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
        <li ><a href="userdashboardinbox.php" style="color: #ffffff">Inbox  <span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="userdashboard.php" style="color: #ffffff">Create Expense Card</a></li>
        <li><a href="userdashboardfinalreport.php" style="color: #ffffff">View Report</a></li>
        <li><a href="invoicecloud.php" style="color: #ffffff">Invoice Cloud</a></li>
        <li><a href="predict.php" style="color: #ffffff">Plan Your Expense</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="userdashboardtrack.php" style="color: #1eb3e9" >Track Your Expense</a></li>
        <li><a href="userdashboardanalytics.php" style="color: #ffffff">Expense Analytics</a></li>
         <li><a href="userdashboardforum.php" style="color: #ffffff">Forum/Community</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">
       <div class="well" style="background-color:white">
         <h4></h4>
        <p></p>
      </div>
  <div class="row">
   <div class="col-sm-6">
     <div class="well" style="height: 200px; background-color: white;border-radius: 0px;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;">

        <h1><?php if($q_res[0]==1)
      {
   echo "<img src='tick.jpg' style='padding-left:160px;height:80px;'>";
      } 
      else
      {
         echo "<img src='wrong.jpg' style='padding-left:160px;height:80px;'>";
      } 
      ?></h1>
      <p style="color: #1eb3e9;padding-left:70px;font-size: 20px;">Status of Last report Submitted on</p>
      <span style="min-width: 140px; height:20px; display: inline-block;margin-left:140px;" class="badge"><?php echo $q_res[2]?></span>
      </div>
   </div>
   <div class="col-sm-6">
     <div class="well" style="height: 200px; background-color: white;border-radius: 0px;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;">
      <h3 style="padding-left: 120px;color: #1eb3e9;">Total Expense</h3>
        <img src="rupee-indian.png" style="display: inline-block;padding-left: 110px;"><p style="display: inline-block;font-size:45px;"><?php echo"$q_res[1]";?></p>
        <h3 style="padding-left:20px;color: #1eb3e9;"> Last visit to <?php echo"$q_res[3]"; ?> on <span style="min-width: 140px; height:20px; display: inline-block;" class="badge"><?php echo $q_res[2]?></span></h3>
      </div>
   </div>
  </div>
<div class ="row">
      <?php

     $id1="select id from usersignup where username='".$_SESSION['username']."'";
              $id_run=mysqli_query($db,$id1);
              $result=mysqli_fetch_row($id_run);
  $card1="select max(cardid) from expensecard where  id='$result[0]'";
  $card_run=mysqli_query($db,$card1);
  $cardresult=mysqli_fetch_row($card_run);
  $query2="select auditorstat,adminstat,tot from expensecard where id='$result[0]' AND cardid='$cardresult[0]' ";
  $id_run2=mysqli_query($db,$query2);
  $result3=mysqli_fetch_row($id_run2);

   if($result3[0]==1&&$result3[1]==1)
   {
    echo" <img src='fully approved.jpg'  style=' border-radius:0px;border: 1px solid #dadce0;margin-left:240px;'>";
   }
   else 
    if($result3[0]==1&&$result3[1]==2)
   {
    echo" <img src='final rejected.jpg'  style=' border-radius:0px;border: 1px solid #dadce0;margin-left:240px;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;'>";
   } 
   else
    if($result3[0]==2&&$result3[1]==2||$result3[0]==2)
   {
    echo" <img src='rejected.jpg'  style=' border-radius:0px;border: 1px solid #dadce0;margin-left:240px;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;'>";
   }
   else
    if($result3[0]==3&&$result3[1]==0)
   {
    echo" <img src='pending.jpg' style=' border-radius:0px;border: 1px solid #dadce0;margin-left:240px;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;'>";
   }
   else
    if($result3[0]==0&&$result3[1]==0)
   {
    echo" <img src='submitted.jpg'  style=' border-radius:0px;border: 1px solid #dadce0;margin-left:240px;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;'>";
   }
   else
    if($result3[0]==1&&$result3[1]==0)
   {
    echo" <img src='half approved.jpg'  style=' border-radius:0px;border: 1px solid #dadce0;margin-left:240px;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;'>";
   }

       ?>
</div>
    </div>
  </div>
</div>



</body>
</html>


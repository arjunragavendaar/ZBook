<?php
include "/db_config/db1.php";
session_start();
$i="select username from audlogin";


$i1=mysqli_query($db,$i);


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
input,select
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
        <li ><a href="#section1" style="color: #ffffff"> Reciept Inbox  <span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="#section2" style="color: #ffffff">Compose</a></li>
        <li><a href="#section3" style="color: #ffffff">Approved Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Rejected Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Invoice Cloud</a></li>
        <li><a href="#section3" style="color: #ffffff">Info Base</a></li>
        <li><a href="#section3" style="color: #ffffff">Recieved Messages</a></li>
        <li><a href="#section3" style="color: #ffffff">Forum/Community</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section3" style="color: #1eb3e9">Settings</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">
      <div class="well" style="background-color:white">
         <h4></h4>
        <p></p>
      </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Priority Id</th>
      <th scope="col">Auditor Account</th>
      <th scope="col">Total Number Of Expenses</th>
      <th scope="col">Processed</th>
      <th scope="col">Pending</th>
      <th scope="col">Processed Percentage</th>
       <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $c=1;
  while($i2=mysqli_fetch_row($i1))
  {

  	$q="select count(cardid) from expensecard where assign_aud='$i2[0]'";
	$q1=mysqli_query($db,$q);
	$q2=mysqli_fetch_row($q1);
	$r="select count(cardid) from expensecard where assign_aud='$i2[0]' and (auditorstat=1 or auditorstat=2)";
	$r1=mysqli_query($db,$r);
	$r2=mysqli_fetch_row($r1);
    echo "<tr>";
    echo "<th scope='row'><b>" .$c."</b></th>";
    echo "<td><b>" .$i2[0]."</b></td>";
    echo "<td><b>" .$q2[0]."</b></td>";
    echo "<td><b>" .$r2[0]."</b></td>";
    echo "<td><b>" .($q2[0]-$r2[0])."</b></td>";
    echo "<td><b>" .(round($r2[0]/$q2[0])*100)."</b>%</td>";
    if((round($r2[0]/$q2[0])*100)>=60)
    {
echo "<td><b><span class='glyphicon glyphicon-ok-circle' style='color:green;''></span>Available</b></td>";
    }
    else
    {
    	echo "<td><b><span class='glyphicon glyphicon-duplicate' style='color:#f36a7b;'></span>Stacked Up</b></td>";
    }
    echo "</tr>";
    $c++;
  }

      ?>
  </tbody>
</table>
    </div>
  </div>
</div>



</body>
</html>

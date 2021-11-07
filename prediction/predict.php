<?php
include "/db_config/db1.php";
session_start();
$id1="select id from usersignup where username='".$_SESSION['username']."'";
              $id_run=mysqli_query($db,$id1);
              $result=mysqli_fetch_row($id_run);
  $result1="select count(p_id) from predicttab ";
  $id_run1=mysqli_query($db,$result1);
  $result2=mysqli_fetch_row($id_run1);
  $card1="select max(p_id) from predicttab";
  $card_run=mysqli_query($db,$card1);
  $cardresult=mysqli_fetch_row($card_run);
  $query2="select predate from predicttab where p_id='$cardresult[0]' ";
  $id_run2=mysqli_query($db,$query2);
  $result3=mysqli_fetch_row($id_run2);
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
    <div class="col-sm-3 sidenav" id ="scrl" style="background:rgba(0,0,0,0.2); width:260px;height:608px;background-image: url(bg.jpg);border-radius:20px;margin-top:50px;">
      <h4 style="color: #ffffff"><b>Dashboard</b></h4>
      <ul class="nav nav-pills nav-stacked">
        <li ><a href="userdashboardinbox.php" style="color: #ffffff">Inbox</a></li>
        <li ><a href="userdashboard.php" style="color: #ffffff">Create Expense Card  <span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="userdashboardfinalreport.php" style="color: #ffffff">View Reports </a></li>
        <li><a href="#section3" style="color: #ffffff">Invoice Cloud</a></li>
        <li  style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="predict.php" style="color:  #1eb3e9">Plan Your Expense</a></li>
        <li><a href="userdashboard.php" style="color: #ffffff">Track Your Expense</a></li>
        <li><a href="userdashboardanalytics.php" style="color: #ffffff">Expense Analytics</a></li>
         <li><a href="userdashboardforum.php" style="color: #ffffff">Forum/Community</a></li>
      </ul><br>
    </div>
    <div class="col-sm-9">
    	<div class="col-sm-8">
       <div class="well">
       	 <h4></h4>
        <p></p>
      </div>
      <form class="myform" action="predict.php" method="post">
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>Travel Expense</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="number" name="travel" placeholder="Enter the Travel Expense">
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>Food Expense</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="number" name="food"  placeholder="Enter the Food Expense">
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>Accomodation Expense</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="number" name="acco"  placeholder="Accomodation Expense">
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>Total Expense</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="number" name="tot"  placeholder=" Enter Total Expense">
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>Days</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="number" name="days"  placeholder="Enter the no of days">
      	</div>
      </div>

      <div class="row"  style="height: 70px">
        <div class="col-sm-6">
          <label>Location</label>
        </div>
        <div class="col-sm-6">
          <input type="text" name="locat"  placeholder="Enter the Location">
        </div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label></label>
      	</div>
      	<div class="col-sm-6">
      	<input type="submit" name="sub_btn"  value="Analyze" style="border:none;outline: none;height: 45px;color:#fff;font-size: 16px;background: #d9534f;cursor: pointer;border-radius: 20px;">
      	</div>
      </div>
  </form>
  </div>
  <div class="col-sm-4">
  	<div class="row">

  		 <div class="well">
       	 <h4></h4>
        <p></p>
      </div>
       <div class="well" style="height: 200px; background-color: white;border-radius: 20px;">
       	 <h1 style="font-size: 80px;text-align: center;"><?php echo $result2[0];?></h1>
        <p style="text-align: center; font-size: 20px;">Number of Predictions</p>
      </div>
  </div>
  <div class="row"></div>
  <div class="row">
 <div class="well" style="height:200px; background-color: white;border-radius: 20px;">
       	 <h1 style="text-align: center;"><?php echo $result3[0];?></h1>
        <p  style="text-align: center;font-size: 20px;">Last Prediction on</p>
      </div>
  </div>
     
  </div>


</div>
  </div>
</div>

<?php 
if(isset($_POST['sub_btn']))
{
$texp=$_POST['travel'];
$fexp=$_POST['food'];
$aexp=$_POST['acco'];
$totexp=$_POST['tot'];
$ndays=$_POST['days'];
$locati=$_POST['locat'];
$id1="select id from usersignup where username='".$_SESSION['username']."'";
          		$id_run=mysqli_query($db,$id1);
          		$result=mysqli_fetch_row($id_run);
        $query1 = "insert into predicttab values('','{$_SESSION['username']}','$texp','$fexp','$aexp','$totexp','$ndays','$locati',now())";
          		$query_run1 = mysqli_query($db,$query1);

          		if($query_run1)
          		{
          			echo'<script type="text/javascript"> alert ("Successfully Analysed..!!")</script>';
          		}
          		else
          		{
          			echo mysqli_error($db);
          		}

}




?>
</body>
</html>
<?php
include "/db_config/db1.php";
session_start();
$id1="select id from usersignup where username='".$_SESSION['username']."'";
          		$id_run=mysqli_query($db,$id1);
          		$result=mysqli_fetch_row($id_run);
  $result1="select count(id) from expensecard where id='$result[0]'";
  $id_run1=mysqli_query($db,$result1);
  $result2=mysqli_fetch_row($id_run1);
  $card1="select max(cardid) from expensecard where  id='$result[0]'";
  $card_run=mysqli_query($db,$card1);
  $cardresult=mysqli_fetch_row($card_run);
  $query2="select tdate from expensecard where id='$result[0]' AND cardid='$cardresult[0]' ";
  $id_run2=mysqli_query($db,$query2);
  $result3=mysqli_fetch_row($id_run2);



  function curr($f,$t)
{
 $apikey = '3b59943ee60fb8eda01e';

  $from_Currency = urlencode($f);
  $to_Currency = urlencode($t);
  $query =  "{$from_Currency}_{$to_Currency}";

  $json = file_get_contents("https://free.currencyconverterapi.com/api/v6/convert?q={$query}&compact=ultra&apiKey={$apikey}");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);
return number_format($val, 2, '.', '');

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
    <div class="col-sm-3 sidenav" id ="scrl" style="background:rgba(0,0,0,0.2); width:260px;height:608px;background-image: url(bg.jpg);border-radius:20px;margin-top:50px;">
      <h4 style="color: #ffffff"><b>Dashboard</b></h4>
      <ul class="nav nav-pills nav-stacked">
        <li ><a href="serdashboardinbox.php" style="color: #ffffff">Inbox</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="userdashboard.php" style="color: #1eb3e9">Create Expense Card  <span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="userdashboardfinalreport.php" style="color: #ffffff">View Report</a></li>
        <li><a href="invoicecloud.php" style="color: #ffffff">Invoice Cloud</a></li>
        <li><a href="predict.php" style="color: #ffffff">Plan Your Expense</a></li>
        <li><a href="userdashboardtrack.php" style="color: #ffffff">Track Your Expense</a></li>
        <li><a href="userdashboardanalytics.php" style="color: #ffffff">Expense Analytics</a></li>
         <li><a href="userdashboardforum.php" style="color: #ffffff">Forum/Community</a></li>
      </ul><br>
    </div>
    <div class="col-sm-9">
    	<div class="col-sm-4">
       <div class="well">
       	 <h4></h4>
        <p></p>
      </div>
      <form class="myform" action="userdashboardcurrency.php" method="post">
      <div class="row" style="height: 70px">
      	<div class="col-sm-6">
      		<label>From</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="date" name="fromdate">
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>To</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="date" name="todate" >
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>Number Of Days</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="number" name="days"  placeholder="Enter the Number of days">
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>location</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="text" name="locat" placeholder="Enter the Location">
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>Travel Expense</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="number" name="travel"  placeholder="Enter the Travel Expense">
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
      		<input type="number" name="acco"  placeholder=" Accomodation Expense">
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>Total Expense</label>
      	</div>
      	<div class="col-sm-6">
      		<input type="number" name="tot"  placeholder="Enter the Total Expense">
      	</div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label>Mode of payment</label>
      	</div>
      	<div class="col-sm-6">
      		
      		<select name="pay" placeholder="Enter the Total Expense">
      			<option>Corporate Card</option>
      			<option>Cash</option>
      		</select>
      	</div>
      </div>

       <div class="row"  style="height: 70px">
        <div class="col-sm-6">
          <label>Currency</label>
        </div>
        <div class="col-sm-6">
          <input type="text" name="curr"  placeholder="Currency Code Eg: USD" required>
        </div>
      </div>
      <div class="row"  style="height: 70px">
      	<div class="col-sm-6">
      		<label></label>
      	</div>
      	<div class="col-sm-6">
      	<input type="submit" name="sub_btn"  value="Trade to INR" style="border:none;outline: none;height: 45px;color:#fff;font-size: 16px;background: #1eb3e9;cursor: pointer;border-radius: 20px;">
      	</div>
      </div>
  </form>
  </div>
  <div class="col-sm-4">
  	<div class="well">
         <h4></h4>
        <p></p>
      </div>
      <div class="row">
        <div class="col-sm-12">
      <div id="trade" style ="width: 280px;height:600px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;margin-left: 70px;background-image: url(gg.jpg);width:300;">
       <table>
         <tr>
           <th>Intl Currency</th>
           <th>INR <img src="rupee-indian.png" style="height: 15px;"></th>
         </tr>
          <tr>
           <td><b>United States USD</b></td>
           <td><img src="rupee-indian.png" style="height: 15px;"><b><?php echo curr("USD","INR"); ?></b></td>
         </tr>
         <tr>
           <td><b>Europe EUR</b></td>
           <td><img src="rupee-indian.png" style="height: 15px;"><b><?php echo curr("EUR","INR"); ?></b></td>
         </tr>
         <tr>
           <td><b>United Kingdom GBP</b></td>
           <td><img src="rupee-indian.png" style="height: 15px;"><b><?php echo curr("GBP","INR"); ?></b></td>
         </tr>
         <tr>
           <td><b>Australia AUD</b></td>
           <td><img src="rupee-indian.png" style="height: 15px;"><b><?php echo curr("AUD","INR"); ?></b></td>
         </tr>
         <tr>
           <td><b>Bahraini Dinar BHD</b></td>
           <td><img src="rupee-indian.png" style="height: 15px;"><b><?php echo curr("BHD","INR"); ?></b></td>
         </tr>
         <tr>
           <td><b>China CNY</b></td>
           <td><img src="rupee-indian.png" style="height: 15px;"><b><?php echo curr("CNY","INR"); ?></b></td>
         </tr>
         <tr>
           <td><b>Canada CAD</b></td>
           <td><img src="rupee-indian.png" style="height: 15px;"><b><?php echo curr("CAD","INR"); ?></b></td>
         </tr>
         <tr>
           <td><b>Japan JPY</b></td>
           <td><img src="rupee-indian.png" style="height: 15px;"><b><?php echo curr("JPY","INR"); ?></b></td>
         </tr>

          <tr>
           <td>Last Updated</td>
           <td><?php $q="select now()"; $r=mysqli_query($db,$q);$re=mysqli_fetch_row($r);echo $re[0]; ?></b></td>
         </tr>
          

       </table>
      </div></div></div>
      <div class="row">
      <div class="col-sm-12">
      <div id="tradeentry" style ="width: 280px;height:200px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;margin-left: 70px; margin-top: 20px;">
        <h3 align="center">Enter currency Code</h3>
        <form  class="my1" action="userdashboardcurrency.php" method="post">
        <input type="text" name="curre"  placeholder="Currency Code Eg: USD" required style="margin-left: 20px;">
        <input type="submit" name="sub_btn1"  value="Save Current Value " style="border:none;outline: none;height: 45px;color:#fff;font-size: 13px;background: #1eb3e9;cursor: pointer;border-radius: 20px;margin-left: 60px;width: 140px;">
</form>
      </div></div></div>
  </div>


  <div class="col-sm-4">
    <div class="well">
         <h4></h4>
        <p></p>
      </div>
<div class="row">
        <div class="col-sm-12">
      <div id="tradedisplay" style ="width: 340px;height:auto;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;margin-left: 35px;">
        <h3 align="center">Saved Currency Rates!!</h3>
        <?php 
        $z="select * from currencytrade where username = '".$_SESSION['username']."' ";
        $z1=mysqli_query($db,$z);
?>
<table>
  <tr>
    <th>Intl Currency</th>
    <th>INR</th>
    <th>Date</th>
  </tr>
<?php
 while ($z2=mysqli_fetch_row($z1)) {
  echo "<tr>";
  echo "<td><b>" .$z2[2]."</b></td>";
  echo "<td><b>" .$z2[3]."</b></td>";
  echo "<td><b>" .$z2[4]."</b></td>";
  echo "</tr>";
 }

 ?>

</table>


      </div></div></div>
</div>
  </div>
</div>
</div>
<?php 
if(isset($_POST['sub_btn']))
{

$curr=$_POST["curr"];
  $curr1="INR";

  $rate=curr($curr,"INR");


$from=$_POST['fromdate'];
$to=$_POST['todate'];
$ndays=$_POST['days'];
$locati=$_POST['locat'];
$texp=$_POST['travel'];
$fexp=$_POST['food'];
$aexp=$_POST['acco'];
$totexp=$_POST['tot'];
$mpay=$_POST['pay'];

$texp=round($texp*$rate);
$fexp=round($fexp*$rate);
$aexp=round($aexp*$rate);
$totexp=round($totexp*$rate);

$id1="select id from usersignup where username='".$_SESSION['username']."'";
          		$id_run=mysqli_query($db,$id1);
          		$result=mysqli_fetch_row($id_run);
          		$query1 = "insert into expensecard values('','$from','$to','$result[0]','$ndays','$locati','$texp','$fexp','$aexp','$totexp','$mpay',now(),0,0)";
          		$query_run1 = mysqli_query($db,$query1);

          		if($query_run1)
          		{
          			echo'<script type="text/javascript"> alert ("Successfully Traded to INR and Submitted..!!")</script>';
          		}
          		else
          		{
          			echo mysqli_error($db);
          		}

}




?>
<?php
if(isset($_POST['sub_btn1']))
{

$curre=$_POST['curre'];
 $curr1="INR";

  
  $rate1=curr($curre,"INR");
  $que= "insert into currencytrade values('','{$_SESSION['username']}','$curre','$rate1',now())";
  $qr=mysqli_query($db,$que);

  if($qr)
              {
                echo'<script type="text/javascript"> alert ("Current Value Saved Successfully..!!")</script>';
              }
              else
              {
                echo mysqli_error($db);
              }

}

 ?>
</body>
</html>
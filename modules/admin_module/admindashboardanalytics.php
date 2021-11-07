<?php
include "/db_config/db1.php";
session_start();
  $q="select max(travel) from expensecard";
  $qr=mysqli_query($db,$q);
  $qres=mysqli_fetch_row($qr);
  $q1="select max(food) from expensecard";
  $qr1=mysqli_query($db,$q1);
  $qres1=mysqli_fetch_row($qr1);
  $q2="select max(aaco) from expensecard";
  $qr2=mysqli_query($db,$q2);
  $qres2=mysqli_fetch_row($qr2);

$q3="select count(cardid) from expensecard";
$qr3=mysqli_query($db,$q3);;
$qres3=mysqli_fetch_row($qr3);


$q4="select count(cardid) from expensecard where auditorstat>0";
$qr4=mysqli_query($db,$q4);;
$qres4=mysqli_fetch_row($qr4);



$q5="select count(cardid) from expensecard where adminstat>0 or (auditorstat=2 and adminstat=0)";
$qr5=mysqli_query($db,$q5);;
$qres5=mysqli_fetch_row($qr5);


$q6="select count(cardid) from expensecard where  auditorstat=1 or auditorstat=2 ";
$qr6=mysqli_query($db,$q6);;
$qres6=mysqli_fetch_row($qr6);


  $i="select u.username,e.travel,e.food,e.aaco,e.tot from usersignup u,expensecard e where u.id=e.id";
  $result=mysqli_query($db,$i);

  $i2="select fromd,food,tot from expensecard where auditorstat=1 ";
  $result2=mysqli_query($db,$i2);


   $i3="select cardid,travel,food,aaco from expensecard where auditorstat=1 and adminstat=1 ";
  $result3=mysqli_query($db,$i3);



     $i4="select fromd,travel,aaco from expensecard where auditorstat=1";
  $result4=mysqli_query($db,$i4);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript"  src ="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart()
  {
    var data = google.visualization.arrayToDataTable([
      ['username','travel','food','aaco','tot'],
      <?php
      while ($row = mysqli_fetch_array($result)) {
        echo "['".$row["username"]."',".$row["travel"]." ,".$row["food"]." ,".$row["aaco"]." ,".$row["tot"]."],";
      }
      ?>
      ]);
    var options = {
      title:'Entire Expense Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.AreaChart(document.getElementById('areachart'));
    chart.draw(data,options);
  }

  </script>


   <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart2);
  function drawChart2()
  {
    var data2 = google.visualization.arrayToDataTable([
      ['fromd','food','tot'],
      <?php
      while ($row2 = mysqli_fetch_array($result2)) {
        echo "['".$row2["fromd"]."',".$row2["food"]." ,".$row2["tot"]." ],";
      }
      ?>
      ]);
    var options2 = {
      title:' Auditor Approved Expenses',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.ScatterChart(document.getElementById('scatterchart'));
    chart.draw(data2,options2);
  }

  </script>

  <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart3);
  function drawChart3()
  {
    var data3 = google.visualization.arrayToDataTable([
      ['cardid','travel','food','aaco'],
      <?php
      while ($row3 = mysqli_fetch_array($result3)) {
        echo "['".$row3["cardid"]."',".$row3["travel"]." ,".$row3["food"]." ,".$row3["aaco"]."],";
      }
      ?>
      ]);
    var options3 = {
      title:'Final Approved Expenses',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.BarChart(document.getElementById('barchart'));
    chart.draw(data3,options3);
  }

  </script>

  <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart4);
  function drawChart4()
  {
    var data4 = google.visualization.arrayToDataTable([
      ['fromd','travel','aaco'],
      <?php
      while ($row4 = mysqli_fetch_array($result4)) {
        echo "['".$row4["fromd"]."',".$row4["travel"]." ,".$row4["aaco"]." ],";
      }
      ?>
      ]);
    var options4 = {
      title:'Auditor Approved Travel and Stay Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.LineChart(document.getElementById('linechart'));
    chart.draw(data4,options4);
  }

  </script>

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
    
    body
    {
      background-color: #f9fafb;
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
        <li ><a href="#section1" style="color: #ffffff">Inbox  <span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="#section2" style="color: #ffffff">Compose</a></li>
        <li><a href="#section3" style="color: #ffffff">Approved Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Rejected Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Invoice Cloud</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section3" style="color: #1eb3e9">Info Base</a></li>
        <li><a href="#section3" style="color: #ffffff">Recieved Messages </a></li>
        <li><a href="#section3" style="color: #ffffff">Forum/Community </a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">
  <div class="well">
         <h4></h4>
        <p></p>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div id="mainboard" style ="width: 660px;height:360px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;">
            <div id="areachart" style="width: 660px;height: 360px;"></div>
            
          </div>

        </div>


        <div class="col-sm-4">
          <div class="row">
            <div class="col-sm-12">
              <div id="side1"  style ="width: 360px;height:105px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color:#0174c6;">
                <p style="color: white;"> <b>Highest Travel Expense</b></p>
                <p style="display: inline-block;font-size: 35px;color: white"><?php  echo $qres[0];?></p>
                <img class="pull-right" src="travel expense.png" height="70px;" style="display: inline-block;">
                
              </div>
            </div>
          </div><br>
           <div class="row">
              <div class="col-sm-12">
              <div id="side2"  style ="width: 360px;height:105px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color:#81c867;">
                 <p style="color: white;"> <b>Highest Accomodation Expense</b></p>
                  <p style="display: inline-block;font-size: 35px;color: white;"><?php  echo $qres2[0];?></p>
                <img class="pull-right" src="accomodation expense.png" height="70px;">
                
              </div>
            </div>
           </div><br>
            <div class="row">
               <div class="col-sm-12">
              <div id="side3"  style ="width: 360px;height:110px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color:#f05150;">
                 <p style="color: white;"> <b>Highest Food Expense</b></p>
                  <p style="display: inline-block;font-size: 35px;color: white;"><?php  echo $qres1[0];?></p>
                <img class="pull-right" src="food expenses.png" height="70px;">
                
              </div>
            </div>
            </div>


        </div>


      </div><br>

<div class="row">

  <div class="col-sm-4">
  
      <div id="mid1"  style ="width: 330px;height:110px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;display: inline-block;margin-left:0px;">
         <p> <b>Total Expense Cards Recieved</b></p>
                  <p style="display: inline-block;font-size: 30px;color: #0174c6">&nbsp&nbsp&nbsp<?php  echo $qres3[0];?></p>
        <img class="pull-right" src="expcard.png" height="70px;">
</div></div>
  <div class="col-sm-4">
   
      <div id="mid2"  style ="width: 325px;height:110px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;display: inline-block;margin-left:0px;">
         <p> <b>Auditor Processed</b></p>
                  <p style="display: inline-block;font-size: 30px;color: #81c867">&nbsp&nbsp&nbsp<?php  echo $qres4[0];?>/<?php  echo $qres3[0];?></p>
        <img class="pull-right" src="auditpro.png" height="70px;">
  </div></div>
  <div class="col-sm-4" >
      <div id="mid3"  style ="width: 360px;height:110px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;display: inline-block;margin-left:0px;">
         <p> <b>Admin Processed</b></p>
                  <p style="display: inline-block;font-size: 30px;color: #f05150">&nbsp&nbsp&nbsp<?php  echo $qres5[0];?>/<?php  echo $qres6[0];?></p>
        <img class="pull-right" src="admin.png" height="70px;">
  </div></div>

      
    </div><br>

<div class="row">
  <div class="col-sm-4">
<div id="bottom1"  style ="width: 330px;height:310px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;display: inline-block;margin-left:0px;">

  <div id="scatterchart" style="height: 310px;"></div>
</div>


  </div>


  <div class="col-sm-8">
<div id="bottom2"  style ="width: 700px;height:310px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;display: inline-block;margin-left:0px;">

  <div id="barchart" style="height: 310px;"></div>
</div>


  </div>



</div>

<div class="row">
  
  <div class="col-sm-12">

    <div class="final1"  style ="width: 1038px;height:310px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;display: inline-block;margin-left:0px;" >
      <div id="linechart"  style ="width: 1033px;height:310px;">
        
      </div>
  </div>


</div>

  </div>
</div>


</body>
</html>

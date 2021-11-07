<?php
include "/db_config/db1.php";
session_start();
$id1="select id from usersignup where username='".$_SESSION['username']."'";
              $id_run=mysqli_query($db,$id1);
              $result=mysqli_fetch_row($id_run);


           $i1="select modp,tot from expensecard where id='$result[0]'";
           $result1=mysqli_query($db,$i1); 

          $i2="select fromd,tot from expensecard where id='$result[0]'";
           $result2=mysqli_query($db,$i2);

           
          $i3="select fromd,travel,food,aaco,tot from expensecard where id='$result[0]'";
           $result3=mysqli_query($db,$i3);


          $i4="select fromd,travel from expensecard where id='$result[0]'";
           $result4=mysqli_query($db,$i4); 

          $i5="select location,food,aaco from expensecard where id='$result[0]'";
           $result5=mysqli_query($db,$i5);  


  $query2="select count(id) from expensecard where id='$result[0]' ";
  $id_run2=mysqli_query($db,$query2);
  $row=mysqli_fetch_row($id_run2);  
   $query3="select count(id) from expensecard where id='$result[0]' AND adminstat=1 ";
  $id_run3=mysqli_query($db,$query3);
  $row1=mysqli_fetch_row($id_run3); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="chart.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript"  src ="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart()
  {
    var data = google.visualization.arrayToDataTable([
      ['modp','tot'],
      <?php
      while ($row2 = mysqli_fetch_array($result1)) {
        echo "['".$row2["modp"]."',".$row2["tot"]."],";
      }
      ?>
      ]);
    var options = {
      title:'Payment Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data,options);
  }

  </script>
  <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart1);
  function drawChart1()
  {
    var data1 = google.visualization.arrayToDataTable([
      ['fromd','tot'],
      <?php
      while ($row2 = mysqli_fetch_array($result2)) {
        echo "['".$row2["fromd"]."',".$row2["tot"]."],";
      }
      ?>
      ]);
    var options1 = {
      title:'Total Expense Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.LineChart(document.getElementById('linechart'));
    chart.draw(data1,options1);
  }

  </script>
   <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart2);
  function drawChart2()
  {
    var data2 = google.visualization.arrayToDataTable([
      ['fromd','travel','food','aaco','tot'],
      <?php
      while ($row2 = mysqli_fetch_array($result3)) {
        echo "['".$row2["fromd"]."',".$row2["travel"]." ,".$row2["food"]." ,".$row2["aaco"]." ,".$row2["tot"]."],";
      }
      ?>
      ]);
    var options2 = {
      title:'Total Expense Log',
      is3D:true,
      'backgroundColor':'white',
      seriesType: 'bars',
          series: {5: {type: 'line'}}

    };
    var chart = new google.visualization.ComboChart(document.getElementById('combochart'));
    chart.draw(data2,options2);
  }

  </script>
   <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart3);
  function drawChart3()
  {
    var data3 = google.visualization.arrayToDataTable([
      ['fromd','travel'],
      <?php
      while ($row3 = mysqli_fetch_array($result4)) {
        echo "['".$row3["fromd"]."',".$row3["travel"]."],";
      }
      ?>
      ]);
    var options3 = {
      title:'Travel Expense Analysis',
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
      ['location','food','aaco'],
      <?php
      while ($row4 = mysqli_fetch_array($result5)) {
        echo "['".$row4["location"]."',".$row4["food"]." ,".$row4["aaco"]."],";
      }
      ?>
      ]);
    var options4 = {
      title:'Accomodation Expense Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.AreaChart(document.getElementById('areachart'));
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
        <li><a href="userlogin.php">  <?php echo $_SESSION['username'] ?>  <span class="glyphicon glyphicon-off"></span></a></li>
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
        <li ><a href="userdashboardinbox.php" style="color: #ffffff">Inbox<span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="userdashboard.php" style="color: #ffffff">Create Expense Card</a></li>
        <li><a href="userdashboardfinalreport.php" style="color: #ffffff">View Report</a></li> 
        <li><a href="invoicecloud.php" style="color: #ffffff">Invoice Cloud</a></li>
        <li><a href="predict.php" style="color: #ffffff">Plan Your Expense</a></li>
        <li><a href="userdashboardtrack.php" style="color: #ffffff">Track Your Expense</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="userdashboardanalytics.php" style="color: #1eb3e9">Expense Analytics</a></li>
        <li><a href="userdashboardforum.php" style="color: #ffffff">Forum/Community</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">

 <div class="row">
      <div class="col-sm-4">
<div class="well">
         <h4></h4>
        <p></p>
      </div>
<div id ="piechart" style ="width: 660px;height:200px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important; ">
  </div>

      </div>


      <div class="col-sm-4">

        <div class="well">
         <h4></h4>
        <p></p>
      </div>
      </div>

      <div class="col-sm-4">

        <div class="well">
         <h4></h4>
        <p></p>
      </div>
      <div id="invoice" style="width: 300px;height: 200px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: #0174c6">
        <p style="font-size: 20px;text-align: center;color: white;">Number of reciepts</p><img src="nre.png" style="padding-left: 100px;height: 100px;"><br> <h1 style="font-size: 30px;text-align: center;color: white;"><?php echo $row[0];?></h1> </div>
      </div>
  </div>
<br>
  <div class="row">
    <div class="col-sm-8">
 <div id ="linechart" style ="width: 650px;height:400px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"></div><br>
 <div id ="combochart" style ="width: 650px;height:400px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"></div><br>
  <div id ="areachart" style ="width: 983px;height:400px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"></div>
</div>
<div class="col-sm-4">
  <div class="row">
<div id ="like" style ="width: 320px;height:100px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"> <p style="margin-left: 120px;"><b>Approval</b></p><span class='glyphicon glyphicon-thumbs-up' style='color: #81c867;font-size: 65px;margin-left: 75px;display: inline-block;'></span>&nbsp<p style="font-size: 45px;display: inline-block;color: #81c867"><?php echo round(($row1[0]/$row[0])*100 ) ?>%</p></div><br>
</div>
<div class="row">
<div id ="dislike" style ="width: 320px;height:100px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"><p style="margin-left: 120px;"><b>Rejection</b></p><span class='glyphicon glyphicon-thumbs-down' style='color: #f05150;font-size: 65px;margin-left: 75px;display: inline-block;'></span>&nbsp<p style="font-size: 45px;display: inline-block;color: #f05150 "><?php echo round(100-(($row1[0]/$row[0])*100) ) ?>%</p>
<div id ="barchart" style ="width: 320px;height:580px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"></div><br></div><br></div>
</div>

</div>

</div>


      </div>

</div>
    </div>
  </div>
</div>



</body>
</html>

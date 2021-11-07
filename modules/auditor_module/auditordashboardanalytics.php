<?php
include "/db_config/db1.php";
session_start();
$q="select count(cardid) from expensecard where adminstat > 0";
$r=mysqli_query($db,$q);
$res=mysqli_fetch_row($r);
$q1="select count(cardid) from expensecard";
$r1=mysqli_query($db,$q1);
$res1=mysqli_fetch_row($r1);

  $i="select modp,tot from expensecard  where assign_aud='".$_SESSION['username']."' ";
  $result=mysqli_query($db,$i);

  $i1="select u.username,e.travel ,e.tot from usersignup u,expensecard e where u.id=e.id and e.assign_aud='".$_SESSION['username']."' ";
  $result1=mysqli_query($db,$i1);

  $i2="select fromd,food,tot from expensecard where assign_aud='".$_SESSION['username']."' ";
  $result2=mysqli_query($db,$i2);

   $i3="select location,travel,food,aaco from expensecard where assign_aud='".$_SESSION['username']."'";
  $result3=mysqli_query($db,$i3);


   $i4="select fromd,travel,aaco from expensecard where assign_aud='".$_SESSION['username']."'";
  $result4=mysqli_query($db,$i4);


   $i5="select u.username,e.tot from usersignup u,expensecard e where u.id=e.id and assign_aud='".$_SESSION['username']."' ";
  $result5=mysqli_query($db,$i5);

   $i6="select fromd,food,aaco from expensecard where assign_aud='".$_SESSION['username']."'";
  $result6=mysqli_query($db,$i6);


     $i7="select u.username,e.travel,e.food,e.aaco,e.tot from usersignup u,expensecard e where u.id=e.id and e.assign_aud='".$_SESSION['username']."'";
  $result7=mysqli_query($db,$i7);

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
      ['modp','tot'],
      <?php
      while ($row = mysqli_fetch_array($result)) {
        echo "['".$row["modp"]."',".$row["tot"]." ],";
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
      ['username','travel','tot'],
      <?php
      while ($row1 = mysqli_fetch_array($result1)) {
        echo "['".$row1["username"]."',".$row1["travel"]." ,".$row1["tot"]."],";
      }
      ?>
      ]);
    var options1 = {
      title:'Travel and Total Expense Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.SteppedAreaChart(document.getElementById('stepchart'));
    chart.draw(data1,options1);
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
      title:' Food and Total Expense Analysis',
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
      ['location','travel','food','aaco'],
      <?php
      while ($row3 = mysqli_fetch_array($result3)) {
        echo "['".$row3["location"]."',".$row3["travel"]." ,".$row3["food"]." ,".$row3["aaco"]."],";
      }
      ?>
      ]);
    var options3 = {
      title:'Expense Log Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.AreaChart(document.getElementById('areachart'));
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
      title:'Travel and Stay Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.BubbleChart(document.getElementById('bubblechart'));
    chart.draw(data4,options4);
  }

  </script>

   <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart5);
  function drawChart5()
  {
    var data5 = google.visualization.arrayToDataTable([
      ['username','tot'],
      <?php
      while ($row5 = mysqli_fetch_array($result5)) {
        echo "['".$row5["username"]."',".$row5["tot"]." ],";
      }
      ?>
      ]);
    var options5 = {
      title:'Total Expense Analysis',
       pieHole: 0.4,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.PieChart(document.getElementById('douchart'));
    chart.draw(data5,options5);
  }

  </script>

   <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart7);
  function drawChart7()
  {
    var data7 = google.visualization.arrayToDataTable([
      ['username','travel','food','aaco','tot'],
      <?php
      while ($row7 = mysqli_fetch_array($result7)) {
        echo "['".$row7["username"]."',".$row7["travel"]." ,".$row7["food"]." ,".$row7["aaco"]." ,".$row7["tot"]."],";
      }
      ?>
      ]);
    var options7 = {
      title:'Entire Expense Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.BarChart(document.getElementById('barchart'));
    chart.draw(data7,options7);
  }

  </script>

  <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart6);
  function drawChart6()
  {
    var data6 = google.visualization.arrayToDataTable([
      ['fromd','food','aaco'],
      <?php
      while ($row6 = mysqli_fetch_array($result6)) {
        echo "['".$row6["fromd"]."',".$row6["food"]." ,".$row6["aaco"]."],";
      }
      ?>
      ]);
    var options6 = {
      title:'Stay Analysis',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.LineChart(document.getElementById('linechart'));
    chart.draw(data6,options6);
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
        <li  style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section3" style="color: #1eb3e9">Analytics</a></li>
        <li><a href="#section3" style="color: #ffffff">Rejected Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Invoice Cloud</a></li>
        <li><a href="#section3" style="color: #ffffff">Pending Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Unprocessed Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Messages Recieved</a></li>
        <li><a href="#section3" style="color: #ffffff">Forum/Community</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">
      <div class="col-sm-3">
        <div class="well">
         <h4></h4>
        <p></p>
      </div>
     <div class="row">
       <div id="pro" style ="width: 300px;height:90px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;">
        <p style="margin-left: 80px;color:  blue"><b> Processed Expenses</b></p>
          <div class="progress" style="margin-top: 30px;">
  <div class="progress-bar" role="progressbar" aria-valuenow="0"
  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($res[0]/$res1[0])*100); ?>%">
    <?php echo round(($res[0]/$res1[0])*100) ?>%
  </div>
</div> 
       </div><br>
<div id="piechart" style ="width: 300px;height:300px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"></div><br>
<div id="stepchart" style ="width: 300px;height:300px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"></div>

     </div>
      </div>
      <div class="col-sm-6">
        <div class="well">
         <h4></h4>
        <p></p>
      </div>
      <div class="row">
        <div class="col-sm-12">
<div id="scatterchart" style ="width: 420px;height:200px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;margin-left: 60px;"></div><br>
      </div></div>
    
    <div class="row">
      <div class="col-sm-12">
      <div id="areachart" style ="width: 420px;height:400px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;margin-left: 60px;"></div><br>
      </div></div>


      <div class="row">
      <div class="col-sm-12">
      <div id="bubblechart" style ="width: 420px;height:100px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;margin-left: 60px;"></div><br>
      </div></div>
    </div>
      <div class="col-sm-3">
        <div class="well">
         <h4></h4>
        <p></p>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div id="douchart" style ="width: 300px;height:270px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"></div><br>


        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div id="linechart" style ="width: 300px;height:220px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"></div><br>

</div>
        </div>

        <div class="row">
        <div class="col-sm-12">
          <div id="barchart" style ="width: 300px;height:210px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;"></div><br>


        </div>
      </div>
</div>

      </div>
    </div>





  </div>
</div>



</body>
</html>

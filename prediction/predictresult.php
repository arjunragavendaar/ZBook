<?php
include "/db_config/db1.php";
session_start();


$i=0;$count=0;$j=0;$sum=0;$sum1=0;$fmin=999999999;$tmin=999999999;$amin=999999999;$f=0;$t=0;$a=0;$f1=0;$t1=0;$a1=0;$f2=0;$t2=0;$a2=0;


$knn=array();
$travel=array();
$food=array();
$accomodation=array();
$total=array();
$adminstat=array();
$q="select max(p_id) from predicttab where name= '".$_SESSION['username']."'";
$qr=mysqli_query($db,$q);

$res=mysqli_fetch_row($qr);

$q1="select * from predicttab where p_id= '$res[0]'";
$qr1=mysqli_query($db,$q1);

$q2="select location from predicttab where p_id= '$res[0]' ";
$qr2= mysqli_query($db,$q2);
$res2 = mysqli_fetch_row($qr2);

$q3="select * from expensecard where location = '$res2[0]' ";
$qr3= mysqli_query($db,$q3);
while($res3 = mysqli_fetch_row($qr3))
{
  $travel[$i]=round($res3[6]/$res3[4]);
  $food[$i]=round($res3[7]/$res3[4]);
   $accomodation[$i]=round($res3[8]/$res3[4]);
    $total[$i]=round($res3[9]/$res3[4]);
     $adminstat[$i]=$res3[13];
     $i++;
     $count++;

}
$z="select * from predicttab where p_id= '$res[0]'";
$z1=mysqli_query($db,$z);
$z2=mysqli_fetch_row($z1);
for($j=0;$j<$count;$j++)
{

$sum=$total[$j]-round($z2[5]/$z2[6]);
  $sum1=pow($sum,2);
  $knn[$j]=sqrt($sum1);
}
array_multisort($knn,$travel,$food,$accomodation,$total,$adminstat);
$c=0;$c1=0;$c2=0;
for($j=0;$j<$count;$j++)
{
  if($adminstat[$j]==1)
  {
    $c=$food[$j];
    $f=sqrt(pow(($c-round($z2[3]/$z2[6])),2));
    if($f<$fmin)
    {
      $fmin=$f;
      $f1=$food[$j];
      $f2=round($z2[3]/$z2[6]);
    }
  }
}

for($j=0;$j<$count;$j++)
{
  if($adminstat[$j]==1)
  {
    $c1=$travel[$j];
    $t=sqrt(pow(($c1-round($z2[2]/$z2[6])),2));
    if($t<$tmin)
    {
      $tmin=$t;
      $t1=$travel[$j];
      $t2=round($z2[2]/$z2[6]);
    }
  }
}
for($j=0;$j<$count;$j++)
{
  if($adminstat[$j]==1)
  { $c2=$accomodation[$j];
    $a=sqrt(pow(($c2-round($z2[4]/$z2[6])),2));
    if($a<$amin)
    {
      $amin=$a;
      $a1=$accomodation[$j];
      $a2=round($z2[4]/$z2[6]);
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
  <script type="text/javascript"  src ="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart()
  {
    var data = google.visualization.arrayToDataTable([
      ['Location','Suggested','yours'],
      <?php
        echo "['".$res2[0]."',".$f1.",".$f2." ],";
      
      ?>
      ]);
    var options = {
      title:' Food Expense',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.LineChart(document.getElementById('linechart'));
    chart.draw(data,options);
  }

  </script>


   <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart2);
  function drawChart2()
  {
    var data2 = google.visualization.arrayToDataTable([
      ['Location','Suggested','Yours'],
      <?php
        echo "['".$res2[0]."',".$t1.",".$t2." ],";
      
      ?>
      ]);
    var options2 = {
      title:' Travel Expense',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.BarChart(document.getElementById('barchart'));
    chart.draw(data2,options2);
  }

  </script>


   <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart3);
  function drawChart3()
  {
    var data3 = google.visualization.arrayToDataTable([
      ['Location','Suggested','Yours'],
      <?php
        echo "['".$res2[0]."',".$a1.",".$a2." ],";
      
      ?>
      ]);
    var options3 = {
      title:' Accomodation Expense',
      is3D:true,
      'backgroundColor':'white'
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('columnchart'));
    chart.draw(data3,options3);
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
      background-color: #f9f7f7;
    }
     th {
  text-align: left;
  padding: 35px;
}
td
{
   text-align: center;
   padding-bottom: 20px;
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
        <li ><a href="#section1" style="color:#ffffff">Inbox  <span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="#section2" style="color: #ffffff">Create Expense Card</a></li>
        <li><a href="#section3" style="color: #ffffff">View Reports</a></li>
        <li><a href="#section3" style="color: #ffffff">Invoice Cloud</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section3" style="color:  #1eb3e9">Plan Your Expense</a></li>
        <li><a href="#section3" style="color: #ffffff">Track Your Expense</a></li>
        <li><a href="#section3" style="color: #ffffff">Expense History</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">
       <div class="well">
         <h4></h4>
        <p></p>
      </div>
<div class="row">
  <div class="col-sm-12">
    <div id="top" style ="width: 1000px;height:220px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;margin-left:30px;">

      <table>
        
<tr>
  <th> Travel Expense</th>
  <th> Food Expense</th>
  <th> Accomodation Expense</th>
  <th> Total Expense</th>
  <th> Location</th>
  <th> Number of Days</th>
  <th> Predicted Result</th>
</tr>
<?php
 while ($res1=mysqli_fetch_row($qr1)) {
  echo "<tr>";
  echo "<td><img src='rupee-indian.png' style='height: 15px;'><b>" .$res1[2]."</b></td>";
  echo "<td><img src='rupee-indian.png' style='height: 15px;'><b>" .$res1[3]."</b></td>";
  echo "<td><img src='rupee-indian.png' style='height: 15px;'><b>" .$res1[4]."</b></td>";
  echo "<td><img src='rupee-indian.png' style='height: 15px;'><b>" .$res1[5]."</b></td>";
  echo "<td><b>" .$res1[7]."</b></td>";
  echo "<td><b>" .$res1[6]."</b></td>";


  if($adminstat[0]==1)
{
  if($knn[0]>250)
  {
echo "<td><b><span class='glyphicon glyphicon-thumbs-up' style='color:grey;font-size:35px;'></span></b></td>";
  }
  else
  {
echo "<td><b><span class='glyphicon glyphicon-thumbs-up' style='color:green;font-size:35px;'></span></b></td>";
  }
}
  else
  {
echo "<td><b><span class='glyphicon glyphicon-thumbs-down' style='color:red;font-size:35px;'></span></b></td>";
  }
  echo "</tr>";
 }
 ?>

      </table>

    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-sm-12">
   
   <div id="insight" style ="width: 1000px;height:100px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;margin-left:30px;" >
    <span class='glyphicon glyphicon-search' style='font-size:26px;color: #337ab7'></span>&nbsp<p style="display: inline-block;font-size: 20px;"><b> Expense Insight </b></p><br>&nbsp&nbsp
    <?php
  if($adminstat[0]==1)
{
  if($knn[0]>250)
  {
echo "<td><b><span class='glyphicon glyphicon-thumbs-up' style='color:grey;font-size:35px;'></span><p style='font-size:20px;display:inline-block;'>--Your Expense have Marginal Probability of getting Approved</p></b></td>";
  }
  else if($knn[0]<250&&$knn[0]>100)
  {
echo "<td><b><span class='glyphicon glyphicon-thumbs-up' style='color:green;font-size:35px;'></span><p style='font-size:20px;display:inline-block;'>--Your Expense have good Probability of getting Approved</p></b></td>";
  }
  else
  {
    echo "<td><b><span class='glyphicon glyphicon-thumbs-up' style='color:green;font-size:35px;'></span><p style='font-size:20px;display:inline-block;'>--Your Expense have High Probability of getting Approved</p></b></td>";
  }
}
  else
  {
echo "<td><b><span class='glyphicon glyphicon-thumbs-down' style='color:red;font-size:35px;'></span><p style='font-size:20px;display:inline-block;'>--
Your Expense have High Probability of getting Rejected</p></b></td>";
  }


     ?>
   </div>


  </div>
  


</div><br>


<div class="row">

<div class="col-sm-8">
  <div id ="first"  style ="width: 660px;height:230px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;margin-left:30px;" >
    
    <div id ="linechart" style="width: 660px;height:230px;display: inline-block;">
  </div>
  </div>
</div>

<div class="col-sm-4">
  <div id ="firstexp"  style ="width: 325px;height:230px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;margin-left:30px;" >

    <?php
   if($f1>$f2)
   {
    echo nl2br(" \n");
    echo nl2br(" \n");
    echo "<p   style='display:inline-block;font-size:20px;'> You have saved &nbsp<span class='glyphicon glyphicon-arrow-up' style='color:green;font-size:27px;'>". round((($f1-$f2)/$f1)*100). "%</span> of the suggested expense and your expenditure in terms of food expense is streamlined and ideal as well interms of strategizing and management</p>";
   }
   else
   {
    echo nl2br(" \n");
    echo nl2br(" \n");
    echo "<p style='display:inline-block;font-size:20px;'> You can still reduce&nbsp <span class='glyphicon glyphicon-arrow-down' style='color:red;font-size:27px;'>". round((($f2-$f1)/$f2)*100)."%</span> of the your expense in order to increase the chances of getting approved.Your Expenditure in terms of food is managed unraggely </p> ";
   }

     ?>
  </div>
</div>
</div><br>

<div class="row">

<div class="col-sm-8">
  <div id ="second"  style ="width: 660px;height:230px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;margin-left:30px;" >
    
    <div id ="barchart" style="width: 660px;height:230px;display: inline-block;">
  </div>
  </div>
</div>

<div class="col-sm-4">
  <div id ="secondexp"  style ="width: 325px;height:230px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;margin-left:30px;" >

    <?php
   if($t1>$t2)
   {
    echo nl2br(" \n");
    echo nl2br(" \n");
    echo "<p   style='display:inline-block;font-size:20px;'> You have saved &nbsp<span class='glyphicon glyphicon-arrow-up' style='color:green;font-size:27px;'>". round((($t1-$t2)/$t1)*100). "%</span> of the suggested expense and your expenditure in terms of Travel expense is streamlined and ideal as well in terms of strategizing and management</p>";
   }
   else
   {
    echo nl2br(" \n");
    echo nl2br(" \n");
    echo "<p style='display:inline-block;font-size:20px;'> You can still reduce&nbsp <span class='glyphicon glyphicon-arrow-down' style='color:red;font-size:27px;'>". round((($t2-$t1)/$t2)*100)."%</span> of the your expense in order to increase the chances of getting approved.Your Expenditure in terms of Travel is managed unraggely </p> ";
   }

     ?>
  </div>
</div>

  </div><br>



  <div class="row">

    <div class="col-sm-8">
  <div id ="third"  style ="width: 660px;height:230px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;margin-left:30px;" >
    
    <div id ="columnchart" style="width: 660px;height:230px;display: inline-block;">
  </div>
  </div>
</div>

<div class="col-sm-4">
  <div id ="thirdexp"  style ="width: 325px;height:230px;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;margin-left:30px;" >

    <?php
   if($a1>$a2)
   {
    echo nl2br(" \n");
    echo nl2br(" \n");
    echo "<p   style='display:inline-block;font-size:20px;'> You have saved &nbsp<span class='glyphicon glyphicon-arrow-up' style='color:green;font-size:27px;'>". round((($a1-$a2)/$a1)*100). "%</span> of the suggested expense and your expenditure in terms of Accomodation expense is streamlined and ideal as well in terms of strategizing and management</p>";
   }
   else
   {
    echo nl2br(" \n");
    echo nl2br(" \n");
    echo "<p style='display:inline-block;font-size:20px;'> You can still reduce&nbsp <span class='glyphicon glyphicon-arrow-down' style='color:red;font-size:27px;'>". round((($a2-$a1)/$a2)*100)."%</span> of the your expense in order to increase the chances of getting approved.Your Expenditure in terms of Accomodation is managed unraggely </p> ";
   }

     ?>
  </div>
</div>
  </div><br>
  <h4 style="margin-left: 28px;"><b> Suggested Pick</b></h4>
<div class="row">
  
<div class="col-sm-12">

<div id="sugg"  style ="width: 1002px;height:auto;border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: white;margin-left:30px;">

  <?php
$min=999999999;
$val=0;
$row = 1;
$arr=array();$j=0;
if (($handle = fopen("dataset/zomato.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            //echo $data[$c] . "<br />\n";
            $arr[$j][$c]=$data[$c];

        }
        $j++;
    }
    fclose($handle);
}
$cost=$z2[3];
for($i=0;$i<$j;$i++)
{
  if($arr[$i][3]==$z2[7])
    {
        $c1=round(($arr[$i][8])/2);
        $temp=shell_exec("python knn.py $c1 $cost ");
        if($temp<$min)
        {
            $min=$temp;
            $val=$i;
        }
        $inferredval=shell_exec("python projection.py $arr[$i] ");
        
    }
}
  

?>
  <table>
    
<tr>
  <th>Restaurant Name:</th>
  <th><?php echo $arr[$val][1] ?></th>
   <th><span class='glyphicon glyphicon-ok' style='color:green;font-size:27px;'></span>Approximate Amount:</th>
  <th><?php echo round($arr[$val][10]/2) ?></th>
  

</tr>
<tr>
  <th>City:</th>
  <th><?php echo $arr[$val][3] ?></th>
   <th><span class='glyphicon glyphicon-usd' style='color:blue;font-size:27px;'></span>Currency:</th>
  <th><?php echo $arr[$val][11] ?></th>

</tr>
<tr>
  <th>Address:</th>
  <th><?php echo $arr[$val][4] ?></th>
   <th><span class='glyphicon glyphicon-star' style='color:black;font-size:27px;'></span>Rating:</th>
  <th><?php echo $arr[$val][17] ?></th>

</tr>
<tr>
  <th>Cuisines:</th>
  <th><?php echo $arr[$val][9] ?></th>
   <th><span class='glyphicon glyphicon-globe' style='color:black;font-size:27px;'></span>Quality:</th>
  <th><?php echo $arr[$val][19] ?></th>

</tr>
<tr>
   <th><span class='glyphicon glyphicon-hand-up' style='color:green;font-size:27px;'></span>Up Votes:</th>
  <th><?php echo $arr[$val][20] ?></th>

</tr>


  </table>


</div>

</div>


</div>


    </div>




  </div>
</div>


</body>
</html>
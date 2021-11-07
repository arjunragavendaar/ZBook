<?php
include "/db_config/db1.php";
session_start();
$id1="select id from usersignup where username='".$_SESSION['username']."'";
              $id_run=mysqli_query($db,$id1);
              $result=mysqli_fetch_row($id_run);
  $card1="select max(cardid) from expensecard where  id='$result[0]'";
  $card_run=mysqli_query($db,$card1);
  $cardresult=mysqli_fetch_row($card_run);
  $query2="select * from expensecard where id='$result[0]' AND cardid='$cardresult[0]' ";
  $id_run2=mysqli_query($db,$query2);
  $result3=mysqli_fetch_row($id_run2);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="bill.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
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
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section3" style="color: #1eb3e9">View Report</a></li>
        <li><a href="invoicecloud.php" style="color: #ffffff">Invoice Cloud</a></li>
        <li><a href="predict.php" style="color: #ffffff">Plan Your Expense</a></li>
        <li><a href="userdashboardtrack.php" style="color: #ffffff">Track Your Expense</a></li>
        <li><a href="userdashboardanalytics.php" style="color: #ffffff">Expense Analytics</a></li>
        <li><a href="userdashboardforum.php" style="color: #ffffff">Forum/Community</a></li>
      </ul><br>
    </div>
    <div class="col-sm-9">
      <div class="col-sm-5">
        <div class="well">
         <h4></h4>
        <p></p>
      </div>
     <b><a href="" ><p style="display: inline-block;">Recent Transactions</p></a></b>&nbsp&nbsp&nbsp&nbsp
   <a href="userdashboardfinalpdf.php">  <button type="button"  class="btn btn-info" style="display: inline-block;width:210px;"><b>Download Report <span class="glyphicon glyphicon-save"></span></b></button></a>
<?php 
$query2="select * from expensecard where id='$result[0]'";
  $id_run2=mysqli_query($db,$query2);

while( $row = mysqli_fetch_row($id_run2)){ ?>
   
   <div class="trans" style="border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;background-color: #f7f8fb">
    <p style="display: inline-block;color: #2f264c;">&nbsp&nbsp<b><a href=""><span class="glyphicon glyphicon-tags"></span></a>&nbsp<?php echo $row[5] ;?></b></p>
    <p  style="display: inline-block; margin-left: 230px;color: #2f264c;"><span data-prefix><img src="rupee-indian0.png" style="height:15px;"></span><span><b><?php echo $row[9];?></b></p>
    <p style="display: inline-block;color:#186fd0">&nbsp&nbsp <span class="glyphicon glyphicon-list-alt">&nbsp<b><?php echo $row[10] ;?></b> <b style="height:20px;">| </b></p>
    <p style="display: inline-block;"><span class="glyphicon glyphicon-calendar" style="color: red;">&nbsp</span><b><?php echo $row[1];?></b></p>
    <?php
    if($row[13]==1)
  {
 echo"<p class='pull-right' style='display: inline-block;'><span class='glyphicon glyphicon-thumbs-up' style='color: green;font-size: 25px;'></span></p>";
  }
  else if($row[13]==2)
  {
echo"<p class='pull-right' style='display: inline-block;'><span class='glyphicon glyphicon-thumbs-down' style='color: red;font-size: 25px;'></span></p>";
  }
  else
  {
    echo"<p class='pull-right' style='display: inline-block;'><span class='glyphicon glyphicon-pushpin' style='color: orange;font-size: 25px;'></span></p>";
  }

     ?>
    <br><br>
    </div>
    <br>
    <?php } ?>
   


      </div>
      <div class="col-sm-7">
        <div class="well">
         <h4></h4>
        <p></p>
      </div>
      <div class="bill"  style="border:1px solid #dadce0;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important; padding-left:20px;padding-right: 20px;" >
          <header>
      <h1>Expense Reciept</h1>
      <address contenteditable>
        <p><b><?php  echo $_SESSION['username']; ?></b></p>
        <p><b>Expense Id :# <?php echo $result3[0]; ?></b></p>
        <p><b>User Id :# <?php echo $result[0]; ?></b></p>
      </address>
      <span>
        <?php 
        if($result3[13]==2||$result3[13]==0&&$result3[12]==2)
        {
       echo" <img alt='' src='rejected1.jpg'></span>";
      }
      else if($result3[13]==1)
      {

         echo" <img alt='' src='approvedseal.jpg'></span>";
      }
      else
      {
        echo" <img alt='Status not Available' ></span>";
      }
      ?>
    </header>
    <article>
      <h1>Recipient</h1>
      <address contenteditable>
        <p><i class='fas fa-address-card' style='font-size:24px'></i>&nbsp<?php echo $_SESSION['username']; ?>'s<br>Expense Reciept</p>
      </address>
      <table class="meta">
        <tr>
          <th><span contenteditable>Expense Card #</span></th>
          <td><span contenteditable><?php echo $result3[0]; ?></span></td>
        </tr>
        <tr>
          <th><span contenteditable>Date</span></th>
          <td><span contenteditable><?php echo $result3[11]; ?></span></td>
        </tr>
        <tr>
          <th><span contenteditable>Amount Due</span></th>
          <td><span id="prefix" contenteditable><img src="rupee-indian0.png"></span><span><?php echo $result3[9];?></span></td>
        </tr>
      </table>
      <table class="inventory">
        <thead>
          <tr>
            <th><span contenteditable>From</span></th>
            <th><span contenteditable>To</span></th>
            <th><span contenteditable>Location</span></th>
            <th><span contenteditable>Mode Of Payment</span></th>
            <th><span contenteditable>Total Expense</span></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><a class="cut">-</a><span data-prefix><?php echo $result3[1];?></span></td>
            <td><span data-prefix><?php echo $result3[2];?></span></td>
            <td><span data-prefix></span><span data-prefix><?php echo $result3[5];?></span></td>
            <td><span data-prefix><?php echo $result3[10];?></span></td>
            <td><span data-prefix><img src="rupee-indian0.png" style="height:15px;"></span><span><?php echo $result3[9];?></span></td>
          </tr>
        </tbody>
      </table>
      <table class="balance">
        <tr>
          <th><span contenteditable><b>Number of Days<b></span></th>
          <td><span data-prefix></span><span><?php echo $result3[4];?></span></td>
        </tr>
        <tr>
          <th><span contenteditable><b>Travel Expense</b></span></th>
          <td><span data-prefix><img src="rupee-indian0.png" style="height:15px;"></span><span contenteditable><?php echo $result3[6];?></span></td>
        </tr>
        <tr>
          <th><span contenteditable><b>Food Expense</b></span></th>
          <td><span data-prefix><img src="rupee-indian0.png" style="height:15px;"></span><span><?php echo $result3[7];?></span></td>
        </tr>
        <tr>
          <th><span contenteditable><b>Accomodating Expense</b></span></th>
          <td><span data-prefix><img src="rupee-indian0.png" style="height:15px;"></span><span><?php echo $result3[8];?></span></td>
        </tr>
      </table>
      <table class="inventory">
        <thead>
          <tr>
            <th><span contenteditable>Auditor</span></th>
            <th><span contenteditable>Admin</span></th>
            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span data-prefix><?php 
        if($result3[12]==2)
        {
       echo" <img alt='' src='wrong.jpg' style='height:40px;'></span>";
      }
      else  if($result3[12]==1)
      {

         echo" <img alt='' src='tick.jpg' style='height:40px;'></span>";
      }
      else
      {
        echo" <img alt='Not Processed'style='height:40px;'></span>";
      }
      ?></span></td>
            <td><span data-prefix></span><?php 
        if($result3[13]==2||$result3[13]==0&&$result3[12]==2)
        {
       echo" <img alt='' src='wrong.jpg' style='height:40px;'></span>";
      }
      else  if($result3[13]==1)
      {

         echo" <img alt='' src='tick.jpg' style='height:40px';></span>";
      }
      else
      {
        echo" <img alt='Not Processed'style='height:40px;'></span>";
      }
      ?></td>
          </tr>
        </tbody>
      </table>
    </article>
    <aside>
      <h1><span contenteditable>Go Expense</span></h1>
      <div contenteditable>
        <p>Use This Reciept as Official offline Proof for Claiming Expenses </p>
      </div>
    </aside>
      </div>
    </div>
  </div>
</div>
</div>



</body>
</html>
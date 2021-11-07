<?php
include "/db_config/db1.php";
session_start();
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
     <form class="myform" action="configuresett.php" method="post">
      <div class="row" style="height: 80px;">
        <h3> <span class="glyphicon glyphicon-chevron-right" style="color: #11999e"></span>Choose the Submitter </h3>
        
      </div>
      <div class="row" style="height: 100px">
        <div class="col-sm-6">
          <label><b>User</b></label>
        </div>
        <div class="col-sm-6">
          <?php
             $l="select username from usersignup";
            $l1=mysqli_query($db,$l);
              $dropdown = "<select name='users'>";
while($l2 = mysqli_fetch_row($l1)) {
  $dropdown .= "\r\n<option value='{$l2[0]}'>{$l2[0]}</option>";
}
 $dropdown .= "\r\n<option value='all'>all</option>";
$dropdown .= "\r\n</select>";
echo $dropdown; ?>
        </div>
      </div>
      <div class="row" style="height: 80px;">
        <h3> <span class="glyphicon glyphicon-chevron-right" style="color: #11999e"></span>Assign the Auditor </h3>
        
      </div>
      <div class="row"  style="height: 100px">
        <div class="col-sm-6">
          <label><b>Auditor</b></label>
        </div>
        <div class="col-sm-6">
          <?php
             $l="select username from audlogin";
            $l1=mysqli_query($db,$l);
              $dropdown = "<select name='auditors'>";
while($l2 = mysqli_fetch_row($l1)) {
  $dropdown .= "\r\n<option value='{$l2[0]}'>{$l2[0]}</option>";
}
$dropdown .= "\r\n</select>";
echo $dropdown; ?>
        </div>
      </div>

      <div class="row" style="height: 80px;">
        <h3> <span class="glyphicon glyphicon-chevron-right" style="color: #11999e"></span>Trigger an Action </h3>
        
      </div>
      <div class="row"  style="height: 100px">
        <div class="col-sm-6">
          <label>Action</label>
        </div>
        <div class="col-sm-6">
         <select name="act" placeholder="Select the action">
            <option>Switching the Auditor</option>
            <option>Others</option>
          </select>
        </div>
      </div>
      <div class="row"  style="height: 100px">
        <div class="col-sm-6">
          <label>Notification</label>
        </div>
        <div class="col-sm-6">
           <textarea class="form-control" name="notify" id ="areafield" rows="3" cols="58" placeholder="Enter the Content" style="width: 298px;border-radius: 20px;" ></textarea>
        </div>
      </div>
     
      <div class="row"  style="height: 70px">
        <div class="col-sm-6">
          <label></label>
        </div>
        <div class="col-sm-6">
        <input type="submit" name="config_btn"  value="Configure" style="border:none;outline: none;height: 45px;color:#fff;font-size: 16px;background: #11999e;cursor: pointer;border-radius: 20px;">
        </div>
      </div>
  </form>


    </div>
  </div>
</div>

<?php 
if(isset($_POST['config_btn']))
{

$user=$_POST['users'];
$auditor=$_POST['auditors'];
$action=$_POST['act'];
$note=$_POST['notify'];

$i1="insert into userinbox values('','{$_SESSION['username']}','$user','$action','$note',now()) ";
$q1=mysqli_query($db,$i1);

$i2="insert into configtab values('','$user','$auditor','$action','$note',now()) ";
$q2=mysqli_query($db,$i2);

if($q1&&$q2)
{
echo'<script type="text/javascript"> alert ("Successfully Configured...!!")</script>';
}
else
{
  echo mysqli_error($db);
}


}
?>

</body>
</html>






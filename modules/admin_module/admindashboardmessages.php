<?php
include "/db_config/db1.php";
session_start();
$q="select count(cardid) from expensecard";
$r=mysqli_query($db,$q);
$r1=mysqli_fetch_row($r);
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
        <li><a href="auditorlogin.php"> <?php echo $_SESSION['username'] ?>  <span class="glyphicon glyphicon-off"></span></a></li>
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
        <li ><a href="#section1" style="color: #ffffff" > Reciept Inbox<span style="min-width: 40px; display: inline-block; background-color: " class="pull-right badge"><?php echo $r1[0] ?></span></a></li>
         <li><a href="#section2" style="color: #ffffff">Compose</a></li>
        <li><a href="#section2" style="color: #ffffff">Approved Expenses</a></li>
         <li><a href="#section2" style="color: #ffffff">Reports</a></li>
        <li><a href="#section3" style="color: #ffffff">Rejected Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Invoice Cloud</a></li>
        <li><a href="#section3" style="color: #ffffff">Auditor Analytics</a></li>
        <li><a href="#section3" style="color: #ffffff">User Analytics</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section3" style="color: #1eb3e9">Recieved Messages</a></li>
        <li><a href="#section3" style="color: #ffffff">Forum/Community</a></li>
        
      </ul><br>
    </div>

    <div class="col-sm-9">
      <div class="well" style="background-color:white">
         <h4></h4>
        <p></p>
      </div>
      <?php  
   $query =" select boxid,audfrom ,subj,tidate from userinbox where audto= '". $_SESSION['username'] ."'";
   $result2=mysqli_query($db,$query);
?>

<div class="tab-pane fade in active" id="primary">
            <div class="list-group">
            <?php while( $row = mysqli_fetch_row($result2)){ ?>
              <a href="#" class="list-group-item" id="<?php echo $row[0]; ?>" onclick="open_modal(this.id)">
                <span style="min-width: 140px; display: inline-block;"><span class="glyphicon glyphicon-envelope"></span>&nbsp&nbsp<b><?php echo $row[1] ?></b></span>
                <span style="min-width: 140px; display: inline-block;"><?php echo $row[2] ?></span>
                <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                                </span></span><span style="min-width: 140px; display: inline-block;" class="pull-right badge"><?php echo $row[3] ?></span>
              
              </a>
            <?php } ?>
            </div>
</div>
<div class="modal fade" id="mymodal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b>Info</b></h4>
              </div>
            <div class="modal-body">
               <strong>Message:</strong><p id="msg"></p><br />
            </div>
            </div>
        </div>
</div>

<script type="text/javascript">
    var success=0;
    function open_modal(id){
      var get_id=id;
      $.ajax({
        url:'uinfo.php',
        type:'post',
        dataType:'json',
        data:{
          'id':get_id ,
        },
        success: function(response){
          $('#mymodal').modal('show');
          $('#msg').html(response[0]);
        },
        error: function(e) {
          console.log(e);
        }
      });
    }
</script>

      
    </div>
  </div>
</div>



</body>
</html>

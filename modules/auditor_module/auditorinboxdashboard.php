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
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section1" style="color: #1eb3e9">Inbox<span style="min-width: 40px; display: inline-block; background-color: " class="pull-right badge"><?php echo $r1[0] ?></span></a></li>
         <li><a href="#section2" id = "comp" style="color: #ffffff" onclick="compose()">Compose</a></li>
        <li><a href="#section2" style="color: #ffffff">Approved Expenses</a></li>
         <li><a href="#section2" style="color: #ffffff">Reports</a></li>
        <li><a href="#section3" style="color: #ffffff">Rejected Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Invoice Cloud</a></li>
        <li><a href="#section3" style="color: #ffffff">Pending Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Unprocessed Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Messages Recieved</a></li>
        <li><a href="#section3" style="color: #ffffff">Forum/Community</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">
      <div class="well" style="background-color:white">
         <h4></h4>
        <p></p>
      </div>
       <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">&nbsp
                </span>Inbox</a></li>
              </ul>
      <?php  
   $query ="select e.cardid ,e.tdate,e.location,a.username from usersignup a,expensecard e where a.id=e.id 
    and e.assign_aud= '".$_SESSION['username']."'";
   $result2=mysqli_query($db,$query);
?>

<div class="tab-pane fade in active" id="primary">
            <div class="list-group">
            <?php while( $row = mysqli_fetch_row($result2)){ ?>
              <a href="#" class="list-group-item" id="<?php echo $row[0]; ?>" onclick="open_modal(this.id)">
                <span style="min-width: 140px; display: inline-block;"><span class="glyphicon glyphicon-envelope"></span>&nbsp&nbsp<b><?php echo $row[3] ?></b></span>
                <span style="min-width: 140px; display: inline-block;"><?php echo $row[2] ?></span>
                <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                                </span></span><span style="min-width: 140px; display: inline-block;" class="pull-right badge"><?php echo $row[1] ?></span>
              
              <span style="min-width: 0px; display: inline"><span class="glyphicon glyphicon-check "  id="<?php echo $row[0]; ?>" onclick="ok(this.id)" style="color:#1eb3e9;"></span></span>
        <span style="min-width: 0px; display: inline;"><span class="glyphicon glyphicon-thumbs-down" id="<?php echo $row[0]; ?>" onclick="reject(this.id)"  style="color:#1eb3e9 ;padding-left:20px;"></span></span>
                <span style="min-width: 0px; display: inline;"><span class="glyphicon glyphicon-exclamation-sign" id="<?php echo $row[0]; ?>" onclick="pending(this.id)" style="color:#1eb3e9 ;padding-left: 20px;"></span></span>
              </a>
            <?php } ?>
            </div>
</div>
<div class="modal fade" id="mymodal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><b>Expense Card</b></h4>
              </div>
            <div class="modal-body">
               <strong>From:</strong><p id="fdate"></p><br />
                <strong>To:</strong><p id="tdate"></p><br />
                 <strong>Number of Days:</strong><p id="ndays"></p><br />
                  <strong>Location:</strong><p id="loc"></p><br />
                <strong>Travel:</strong><p id="tra"></p><br />
                <strong>Food:</strong><p id="foo"></p><br />
                 <strong>Accomodation:</strong><p id="acco"></p><br />
                  <strong>Mode of Payment:</strong><p id="mp"></p><br />
                <strong>Total Expense:</strong><p id="tp"></p><br/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" name="approve" class="btn btn-success">Approve</button> 
                <button type="button" name="reject" class="btn btn-danger" >Reject</button>
                <button type="button" name="pending" class="btn btn-warning" >Mark as pending</button>
                
            </div>
            </div>
        </div>
</div>
<div class="modal fade" id="modal_compose" role="dialog">
        <div class="modal-dialog modal-md">
        
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Compose</h4>
              </div>
            <form action="composemail.php" method="post" id="compose_form"> 
            <div class="modal-body">
          <div class="form-group" >
            <label for="from" class="sr-only">From</label>
          </div>
          <div class="form-group">
            <label for="to">To:</label>
            <input type="text"  class="form-control" name="reciever" id="to" >
          </div>
          <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text"  class="form-control" name="subj" id="subj" >
          </div>
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="6"></textarea>
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
            </div>
            </form>
            </div>
            
        </div>
      </div>
</div>
<script type="text/javascript">
    var success=0;
    function open_modal(id){
      var get_id=id;
      $.ajax({
        url:'userinfo.php',
        type:'post',
        dataType:'json',
        data:{
          'id':get_id ,
        },
        success: function(response){
          $('#mymodal').modal('show');
          $('#fdate').html(response[0]);
          $('#tdate').html(response[1]);  
          $('#ndays').html(response[2]);
          $('#loc').html(response[3]);
          $('#tra').html(response[4]);  
          $('#foo').html(response[5]);
          $('#acco').html(response[6]);
          $('#mp').html(response[7]);  
          $('#tp').html(response[8]);  
        },
        error: function(e) {
          console.log(e);
        }
      });
    }
    function compose(){
      $('#modal_compose').modal('show');
    }

</script>
  <script type="text/javascript">
    var success=0;
    function ok(id){
      var get_id=id;
      $.ajax({
        url:'approve.php',
        type:'post',
        data:{
          'id':get_id ,
        },
        success: function(response){
          console.log(response);
          if(response==1)
          {
            alert("Expense Has been Approved!!!");
          }
          else
          {
            alert("Some Problem Please do look into it!!!");
          }  
        },
        error: function(e) {
          console.log(e);
        }
      });
    }
</script>
<script type="text/javascript">
    var success=0;
    function reject(id){
      var get_id=id;
      $.ajax({
        url:'reject.php',
        type:'post',
        data:{
          'id':get_id ,
        },
        success: function(response){
          console.log(response);
          if(response==1)
          {
            alert("Expense Has been Rejected!!!");
          }
          else
          {
            alert("Some Problem Please do look into it!!!");
          }  
        },
        error: function(e) {
          console.log(e);
        }
      });
    }
</script>
<script type="text/javascript">
    var success=0;
    function pending(id){
      var get_id=id;
      $.ajax({
        url:'pending.php',
        type:'post',
        data:{
          'id':get_id ,
        },
        success: function(response){
          console.log(response);
          if(response==1)
          {
            alert("Expense Has been Marked as pending!!!");
          }
          else
          {
            alert("Some Problem Please do look into it!!!");
          }  
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

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
    <div class="col-sm-3 sidenav" id ="scrl" style="background: rgba(0,0,0,0.2); width: 260px;height:908px;background-image: url(bg.jpg);border-radius:20px;margin-top:50px;">
      <h4 style="color: #ffffff"><b>Dashboard</b></h4>
      <ul class="nav nav-pills nav-stacked">
        <li ><a href="#section1" style="color: #ffffff" >Inbox  <span class="glyphicon glyphicon-plus"></span></a></li>
        <li><a href="#section2" style="color: #ffffff">Compose</a></li>
        <li><a href="#section3" style="color: #ffffff">Approved Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Reports</a></li>
        <li><a href="#section3" style="color: #ffffff">Rejected Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Invoice Cloud</a></li>
        <li><a href="#section3" style="color: #ffffff">Pending Expenses</a></li>
        <li><a href="#section3" style="color: #ffffff">Unprocessed Expenses</a></li>
        <li style="border-left:6px solid #1eb3e9; background-color:white;border-radius:20px;"><a href="#section3" style="color: #1eb3e9">Forum/Community</a></li>

      </ul><br>
    </div>

    <div class="col-sm-9">
       <div class="well" style="background-color:white;border:1px solid white;">
         <h4></h4>
        <p></p>
      </div>

<div class="container" id="disp" style="border-radius: 20px;border: 1px solid #dadce0;width: 780px;">
</div>



      <div class="container" id="comment" >
   <h4>Leave a Comment:</h4>
      <form class="form" action="auditordashboardforum.php" method="post">
        <div class="form-group">
           <input type="hidden" name="uid" class="form-control" id="usern" value="<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else{echo '0';} ?>">
          <input type="text" name="tag" id="tagid" placeholder="Enter Tag" style="border-radius: 20px;"><br><br>
          <textarea class="form-control" name="area" id ="areafield" rows="3" cols="58" placeholder="Leave comment" style="width: 498px;border-radius: 20px;" ></textarea>
        </div>
        <button type="button" id="post_btn" name="sub" class="btn btn-info">Post</button>
         <div class="alert alert-success alert-dismissable" id="post_success" style="display: none;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>  
                  </div><br>
            <div class="alert alert-danger alert-dismissable" id="post_error" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> 
</div>
      </form>
      <br><br></div>

    </div>



  </div>
</div>

 <script type="text/javascript">
        $(document).ready(function(){
           $.fn.myfunc();

           $("#post_btn").click(function(){
                 var feedback = $("#areafield").val();
                 var tagid=$("#tagid").val();
                 var user1=$("#usern").val();
                  if(feedback.length==0||tagid.length==0){
                        $("#post_error").empty();
                        $("#post_error").append("<p>Please fill all  the fields!</p>");
                        $("#post_error").show().delay(1000).fadeOut(1500);
                        return false;
                    }
                      $.ajax({
                        type: 'post',
                        url: 'time_line.php',
                        data: {
                            'useri':user1,
                            'tagi': tagid,
                            'posti': feedback
                        },
                        dataType:'json',
                         success: function(response) {
                            console.log(response);
                            if (response.length >0) {
                               $("#tagid").val("");
                                $("#areafield").val("");
                                $("#post_success").append("<p>Posted Successfully!</p>");
                                $("#post_success").show().delay(1000).fadeOut(1500);
                                 
                        $.each(response, function(i, k) {
                                $("#disp").append("<h4><small>RECENT POSTS</small></h4><hr><h2>"+response[i].tag+"</h2><h5><span class='glyphicon glyphicon-time'></span>Posted on " + response[i].timedate+"</h5> <h5><span class='label label-danger'>"+response[i].user +"</span>&nbsp&nbsp<span class='label label-primary'>"+response[i].timedate+"</span></h5><br><p>"+ response[i].description+"</p><br><br>");
                              });
                      
                            } else {
                                $("#review_error").append("<p>Error in Posting!</p>");
                                $("#review_error").show().delay(2000).fadeOut(1500);
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });
            });


        $.fn.myfunc = function() {
            $.ajax({
                type: 'GET',
                url: 'time_line1.php',
                dataType: "json",
                success: function(response) {
                    if (response.length > 0) {
                        $.each(response, function(i, k) {
                                $("#disp").append("<h4><small>RECENT POSTS</small></h4><hr><h2>"+response[i].tag+"</h2><h5><span class='glyphicon glyphicon-time'></span>Posted on " + response[i].timedate+"</h5> <h5><span class='label label-danger'>"+response[i].user +"</span>&nbsp&nbsp<span class='label label-primary'>"+response[i].timedate+"</span></h5><br><p>"+ response[i].description+"</p><br><br>");
                            
                            
                        });
                    } 
                },
                error: function(response) {
                    console.log(response);
                }
            });
        };



       </script>

</body>
</html>


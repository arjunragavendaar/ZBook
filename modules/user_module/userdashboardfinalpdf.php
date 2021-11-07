<?php  
session_start();
 function fetch_data()  
 {  
      $output = '';    
      
$db=mysqli_connect("localhost","root","","expensedb");
      
$id1="select id from usersignup where username='".$_SESSION['username']."'";
              $id_run=mysqli_query($db,$id1);
              $result=mysqli_fetch_row($id_run);
  $card1="select max(cardid) from expensecard where  id='$result[0]'";
  $card_run=mysqli_query($db,$card1);
  $cardresult=mysqli_fetch_row($card_run);
  $query2="select * from expensecard where id='$result[0]' AND cardid='$cardresult[0]' ";
  $id_run2=mysqli_query($db,$query2);
  $row=mysqli_fetch_row($id_run2);  
 
$output .= '
<tr>  
                          <td>'.$row[1].'</td>  
                          <td>'.$row[2].'</td>  
                          <td>'.$row[5].'</td>  
                          <td>'.$row[10].'</td>  
                          <td><img src="rupee-indian0.png" style="height:15px;">'.$row[9].'</td>  
                     </tr>  
                          ';  
      
      return $output;   
}
function fetch1()
{  
   $o = ''; 

   $db=mysqli_connect("localhost","root","","expensedb");
      
$id1="select id from usersignup where username='".$_SESSION['username']."'";
              $id_run=mysqli_query($db,$id1);
              $result=mysqli_fetch_row($id_run);
  $card1="select max(cardid) from expensecard where  id='$result[0]'";
  $card_run=mysqli_query($db,$card1);
  $cardresult=mysqli_fetch_row($card_run);
  $query2="select * from expensecard where id='$result[0]' AND cardid='$cardresult[0]' ";
  $id_run2=mysqli_query($db,$query2);
  $row=mysqli_fetch_row($id_run2);
  if($row[13]==1)
  {
  $o .= '
<br><br><br>
<label><b>Username</b></label>:'.$_SESSION['username'].'<br>
<label><b>Expense Id</b></label>:#'.$row[0].'<br>
<label><b>User Id</b></label>:#'.$result[0].'<br>
<img src="approvedseal.jpg" style="height:90px;">
                          ';  
      
      return $o; 
    }
    else if($row[13]==2||$row[12]==2&&$row[13]==0)
    {
       $o .= '
<br><br><br>
<label><b>Username</b></label>:'.$_SESSION['username'].'<br>
<label><b>Expense Id</b></label>:#'.$row[0].'<br>
<label><b>User Id</b></label>:#'.$result[0].'<br>
<img src="rejected1.jpg" style="height:90px;">
                          ';  
      
      return $o; 
    }
    else
    {
      $o .= '
<br><br><br>
<label><b>Username</b></label>:'.$_SESSION['username'].'<br>
<label><b>Expense Id</b></label>:#'.$row[0].'<br>
<label><b>User Id</b></label>:#'.$result[0].'<br>
<img src="" alt="Not Updated" style="height:90px;">
                          ';  
      
      return $o; 
    }
}

function fetch2()
{  
   $h = ''; 
  $h .= '

<h1 style="background-color:black;color:white;">Expense Card</h1>
<div></div>
                          ';  
      
      return $h; 
}
  function fetch_data1()
  {
    $t='';
     $db=mysqli_connect("localhost","root","","expensedb");
      
$id1="select id from usersignup where username='".$_SESSION['username']."'";
              $id_run=mysqli_query($db,$id1);
              $result=mysqli_fetch_row($id_run);
  $card1="select max(cardid) from expensecard where  id='$result[0]'";
  $card_run=mysqli_query($db,$card1);
  $cardresult=mysqli_fetch_row($card_run);
  $query2="select * from expensecard where id='$result[0]' AND cardid='$cardresult[0]' ";
  $id_run2=mysqli_query($db,$query2);
  $row=mysqli_fetch_row($id_run2);
  if($row[12]==1&&$row[13]==2)
  {

    $t .= '


  <tr>  
                          <td><img src="tick.jpg"></td>  
                          <td><img src="wrong.jpg"></td>   
                     </tr>  
                          ';  
      
      return $t; 
    }
    else if($row[12]==1&&$row[13]==1)
    {
  $t .= '


  <tr>  
                          <td><img src="tick.jpg"></td>  
                          <td><img src="tick.jpg"></td>   
                     </tr>  
                          ';  
      
      return $t; 
    }
    else if($row[12]==2&&$row[13]==2||$row[12]==2)
    {
       
       $t .= '


  <tr>  
                          <td><img src="wrong.jpg"></td>  
                          <td><img src="wrong.jpg"></td>   
                     </tr>  
                          ';  
      
      return $t; 
    }
    else
    {


$t .= '


  <tr>  
                          <td><p>Not Processed</p></td>  
                          <td><p>Not Processed</p></td>   
                     </tr>  
                          ';  
      
      return $t; 

    }
  }
  function fetch_details()
  {

$t1='';


 $db=mysqli_connect("localhost","root","","expensedb");
      
$id1="select id from usersignup where username='".$_SESSION['username']."'";
              $id_run=mysqli_query($db,$id1);
              $result=mysqli_fetch_row($id_run);
  $card1="select max(cardid) from expensecard where  id='$result[0]'";
  $card_run=mysqli_query($db,$card1);
  $cardresult=mysqli_fetch_row($card_run);
  $query2="select * from expensecard where id='$result[0]' AND cardid='$cardresult[0]' ";
  $id_run2=mysqli_query($db,$query2);
  $row=mysqli_fetch_row($id_run2);
$t1='
 <tr>  
                <th width="35%"><b>Number of Days</b></th>  
                <th width="30%">'.$row[4].'</th>    
           </tr>  
    <tr>  
                <th width="35%"><b>Travel Expense</b></th>  
                <th width="30%"><img src="rupee-indian0.png" style="height:15px;">'.$row[6].'</th>    
           </tr>  
            <tr>  
                <th width="35%"><b>Food Expense</b></th>  
                <th width="30%"><img src="rupee-indian0.png" style="height:15px;">'.$row[7].'</th>    
           </tr> 
            <tr>  
                <th width="35%"><b>Accomodation Expense</b></th>  
                <th width="30%"><img src="rupee-indian0.png" style="height:15px;">'.$row[8].'</th>    
           </tr> 






';
return $t1;

  }
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->setImageScale(1.53);
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content.=fetch2();
       $content .= '<br><br>';
       $content .= fetch1();
      $content .= '  
      <h1 align="center"><img src="receipt.png" style="height:45px;">Expense Summary</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="20%"><b>From</b></th>  
                <th width="20%"><b>To</b></th>  
                <th width="20%"><b>Location</b></th>  
                <th width="25%"><b>payment</b></th>  
                <th width="20%"><b>Total Expense</b></th>  
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table><div></div><div></div>';  
       $content .= '  <p style="font-size:25px;"><img src="online-payment.png" style="height:45px;"><b> Expense Log</b></p>  
      <table border="1" cellspacing="0" cellpadding="5">  
           
      ';    
       $content .= fetch_details();
      $content .= '</table><div></div><div></div>';  
       $content .= '   <p style="font-size:25px;"><img src="tag.png" style="height:45px;"><b> Process Log</b></p> 
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="30%"><b>Auditor</b></th>  
                <th width="30%"><b>Admin</b></th>   
           </tr>  
      ';   
       $content .= fetch_data1(); 
      $content .= '</table><div></div><div></div>';
      $content .= '<br><br><br><br>
      <hr style"background-color:solid 2px black;">
      <p>**This Report can be used offline when required for the official purposes...</p>
      ';
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output(''.$_SESSION['username'] .'_FinalReport.pdf', 'I');  
  
 ?>  
 
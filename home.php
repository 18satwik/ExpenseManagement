<?php
require 'connection.php';
if(isloggedin()==FALSE){
    header("location:index.php");
}else{
    
}
$sid=$_SESSION['id'];
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <?php
    $image="images/".$sid.".jpg";

    if(file_exists($image))
    {
    }
    else
    {
        $image="images/noavatar.gif";
    } 
    ?>
    <body  onLoad="document.showexp.edetail.focus()">
        <div style="padding:10px; margin:10px;">
<div class="panel panel-primary">
  <div class="panel-heading"><b>Daily Expanses Manager</b></div>
  <div class="panel-body">

<div class="media">
<div class="media-left">
<img  class="circle" src="<?php echo $image; ?>">
</div>
<div class="media-body">

<blockquote>
<h4 id="media-heading" class="media-heading"><b>Welcome <?php    echo $_SESSION['name']; ?></b> <a href='signout.php'  class="button" >Logout</a></h4> 
<strong>Total Earning :</strong> <span class="label label-success">
    </body>
    <?php 
    $today = date("Y-m-d");
    $dtstart = date("1950-m-d");
    $thiyear = date("y-01-01");


    $query = "SELECT SUM(tvalue) FROM income WHERE date >= '$dtstart' AND date <= '$today' AND uid='$sid' AND isdel=0"; 
    $result = $conn->query($query);
    while($psum = $result->fetch_assoc()) 
    {
        $tisum = $psum['SUM(tvalue)']; 
          if ($tisum == '')
          {echo "Add income to display here";}
            else
        {echo $tisum;
        
        }
    } 
?>
    </span>
<!-- Today's Expenses Start-->
<br><strong>Today's Expenses :</strong> <span class="label label-danger" id='exptop'><?php 
    $query = "SELECT SUM(pprice) FROM expense WHERE date='$today' AND uid='$sid' AND isdel=0"; 
   if($result = $conn->query($query)) {
    while($psum = $result->fetch_assoc()) 
    {
    $tesum = $psum['SUM(pprice)']; 
    if ($tesum== '')
    {echo "No Expense Today";}
        else
        {
            echo $tesum;
            
        }
    } 
   }
?>
    </span>
<!-- Today's Expenses End -->

<br><strong>Total Expenses :</strong> <span class="label label-danger" id='exptop'><?php 
$query = "SELECT SUM(pprice) FROM expense WHERE date >= '$dtstart' AND date <= '$today' AND uid='$sid' AND isdel=0"; 
$result = $conn->query($query) or die($conn->error);
    while($psum =  mysqli_fetch_assoc($result)) 
{
    $tesum = $psum['SUM(pprice)']; 
    if ($tesum== '')
    {   
        echo "Add expenses to display here";}
    else
    {   
        echo $tesum;
        
    }
}

?></span>
    <br><strong>Total Balance :</strong> <span class="label label-default"><?php $rbalance = $tisum - $tesum;
if ($tisum == '')
{echo "NIL";}
else
{echo $rbalance;}
?></span></blockquote>

</div>

</div>
      <div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Don't Know How to use, <a href=" https://youtu.be/-lsoxJi7Xs4"><strong>Click Here!</strong></a>
</div>

<div class="panel panel-info">
<div class="panel-heading"><a href="home.php"><b>Home</b></a>
</div>
    <div class="panel-body"> 
<div class="row">
<div>


<div class="col-md-6">

<div class="panel panel-warning">
  <div class="panel-heading">
    <span class="glyphicon glyphicon-copy" aria-hidden="true"></span> Add Expenses/Income Detail
  </div>
         <div class="panel-body">

  <form action="home.php" class="form-horizontal"  name="showexp" method="post" id="myForm" >
  <div class="col-lg-8">
      <script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
    return false;
    return true;
}    
</script>
         <input type="text" class="form-control" size="20"  name="entrydate" required placeholder="Choose Date" id="datepicker3" readonly  aria-label="..." value="<?php $thisday = strtotime($today);
    $thisday= date('d-m-Y', $thisday); echo $thisday; ?>">
      <input type="text" class="form-control" size="20" id="edetail"   name="edetail" required placeholder="Enter Detail/Source" title="Please Enter Source"  aria-label="..." autofocus>
      <input type="text" class="form-control" size="20" id="eamount" name="eamount" required placeholder="Enter Amount" aria-label="..." title="Please enter Amount"  onkeypress="return isNumberKey(event)"  >
      <div class="input-group">
      <span class="input-group-addon">Choose Type:
      <label><input type="radio"  name="enttype"  value="1" aria-label="..." checked="">Expense</label>
      <label><input type="radio" name="enttype"   value="2" aria-label="...">Income</label>
      </span>
        <span class="input-group-btn">
        <button  type="submit" class="btn btn-primary" ><b>Save</b>  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
        </span>
    </div>  
  </form>
      <?php
        $uid=$sid;
        if(isset($_POST['entrydate'])&& trim($_POST['entrydate'])!=""){
            $entrydate=$_POST['entrydate'];
            $entrydate=  strtotime($entrydate);
            $entrydate=date('Y-m-d',$entrydate);
            $enttype=  mysqli_real_escape_string($conn,$_POST['enttype']);
            $edetail=  mysqli_real_escape_string($conn,$_POST['edetail']);
             $eamount=  mysqli_real_escape_string($conn,$_POST['eamount']);
            $edetail=  strip_tags($edetail);
            $eamount=  strip_tags($eamount);
            $eamount=  floatval($eamount);
            if(isset($_POST['enttype'])&& trim($_POST['enttype'])=="1"){
                $sql="INSERT INTO expense(pname,pprice,uid,date)VALUES('$edetail','$eamount','$uid','$entrydate')";
                if($conn->query($sql)===TRUE){
                    echo"";
                }
                else{
                    echo "error".$sql."<br>".$conn->error;
                }
            }  elseif (isset($_POST['enttype'])&& trim($_POST['enttype'])=="2") {
                $sql="INSERT INTO income(income,tvalue,uid,date)VALUES('$edetail','$eamount','$uid','$entrydate')";
                if($conn->query($sql)===TRUE){
                    echo"";
                }
                else{
                    echo "error".$sql."<br>".$conn->error;
                }
            }    
        }
      ?>
             
    </div>  
  </div>
</div>
    <table class="table table-hover table-striped table-bordered ">
   <caption><h4><span class="glyphicon glyphicon-leaf" ></span> Income report for this Year</h4></caption>
    <tr class="info"><th>Date</th> <th> Income Source </th><th> Money </th><th><a href="homeedit.php" class='btn btn-sm'>Edit</a></th></tr>
    <?php
        $sql="SELECT * FROM income WHERE uid='$sid' AND isdel=0 ORDER BY date";
        $result=$conn->query($sql);
        $total=0;
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                 $exdate = strtotime($row["date"]);
        $exdate = date('d M Y', $exdate);
        echo "<tr><td> " . $exdate. "</td> <td> " . $row["income"]. " </td><td> " . $row["tvalue"]. "</td> <td> <a href='homeedit.php' class='btn btn-sm' name='remove' value='remove'><span class='glyphicon glyphicon-remove white' aria-hidden='true'></span></a></td></tr>";
        $total+=$row["tvalue"];
        }
} else {
}

if(isset($_GET['delincome']))
 {
     //$id = (int)$_GET['delincome'];
     //$removeQuery = "UPDATE income SET isdel='1' Where id=$id AND uid='$sid'";
echo "<tr id='totalincome'><td> </td> <td> Total  </td><td>".$total."</td></tr>";
    if (mysqli_query($conn, $removeQuery))
{
    echo "
   <script> 
          alert('Entry Deleted Successfully'); 
          location.href = 'home.php';
    </script>     
    ";
}
     
 }
    ?>
</table>
        </div>

  <div class="col-md-6">

<div class="panel panel-warning">
  <div class="panel-heading">
    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Trace Expense Record
  </div>
  <div class="panel-body">
  <div class="col-lg-8">

  <form action="home.php" class="form-horizontal"  name="showexp" method="post">
              <div class="form-group">
                <div class="input-group form_datetime" >      
                    <input class="form-control" size="60" type="text" value="" name="expdetail" placeholder="Type expense to find" >
                </div>
              </div>

              <div class="form-group">
                <div class="input-group form_datetime" >      
                    <input class="form-control" size="60" type="text" value="<?php $dstart = date("01-m-Y"); echo $dstart; ?>" id="datepicker1" name="startd" readonly placeholder="Start Date" >
                </div>
              </div>
            <div class="form-group">
                <div class="input-group date form_datetime" >
                <input class="form-control" size="50" type="text" value="<?php echo $thisday; ?>" id="datepicker2" name="endd" readonly placeholder="End Date" >
      <span class="input-group-btn">
        <button class="btn btn-primary" type="submit"><b>Show</b> <span class="glyphicon glyphicon-book" aria-hidden="true"></span></button>
      </span>
   </form>
       </div>
</div>
</div>
    


  </div>
    <?php
        if(!empty($_POST['endd'])){
            $dstart=$_POST['startd'];
            $dend=$_POST['endd'];
            $dstart=  strtotime($dstart);
            $dend=  strtotime($dend);
            $dstart=date('Y-m-d',$dstart);
            $dend=  date('Y-m-d',$dend);
        }  else {
            $dstart=date("Y-m-01");
            $dend=date("Y-m-01");
        }
        $expdetail='';
        if(!empty($_POST['expdetail'])){
            $expdetail=  mysqli_real_escape_string($conn,$_POST['expdetail']);
            
        }
        $dstartn = strtotime($dstart);
        $dstartn = date('d M Y', $dstartn);
        $dendn = strtotime($dend);
        $dendn = date('d M Y', $dendn);
    ?>
        <table class="table table-hover table-striped table-bordered">
   <caption><h4><span class="glyphicon glyphicon-list" ></span> Expense report from <?php echo $dstartn; ?> to <?php echo $dendn; ?>
   </h4>
<h4><?php
        if(empty($_POST['expdetail'])){
            $query="SELECT SUM(tvalue) FROM income WHERE date>='$dstart' AND date<='$dend' AND uid='$uid' AND isdel=0";
            $result=$conn->query($query);
            while ($psum=$result->fetch_assoc()){
                $isum=$psum['SUM(tvalue)'];
                if($isum==''){
                    
                }
                else{
                    echo 'Income <span class="label label-success">';
                    echo $isum;
                }
            }
        ?></span>
            <?php 
        }
            $query = "SELECT SUM(pprice) FROM expense WHERE date >= '$dstart' AND date <= '$dend' AND uid='$sid' AND pname LIKE '%$expdetail%' AND isdel=0"; 
            $result = $conn->query($query);
            while($psum = $result->fetch_assoc()) 
            {
                $ppsum = $psum['SUM(pprice)']; 

                 if ($ppsum !='')
                  {
                    echo '<b>'.$expdetail.'</b>  Expenses <span class="label label-danger">'.$ppsum.'</span> ';
                  }
                   else {echo ' Expenses <span class="label label-danger">NIL</span>';}
            } 

            ?>
            <?php
                if(!empty($isum)){
                    echo 'Balance <span class="label label-default">';
                    $btotal=$isum-$ppsum;
                    echo $btotal;
                }
            ?>
</span> 
</h4>
   </caption>
            <tr class="success"><th>Date</th> <th> Expense Description </th><th> Total Price</th><th><a href="homeedit.php" class='btn btn-sm'>Edit</a></th></tr>
            <?php
            $sql="SELECT * FROM expense WHERE date>='$dstart' AND date<='$dend' AND uid='$uid' AND pname LIKE '%$expdetail%' AND isdel=0 ORDER BY date";
            $result=$conn->query($sql);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    $exdate=  strtotime($row['date']);
                    $exdate=date('d M Y',$exdate);
                      echo "<tr><td> " . $exdate. "</td> <td> " . $row["pname"]. " </td><td> " . $row["pprice"]. "</td><td> <a href='homeedit.php' id='del' class='btn btn-sm' name='remove' value='remove'><span class='glyphicon glyphicon-remove white' aria-hidden='true'></span></a></td></tr>";
                       }
                } else {
                     echo "<tr><td> </td> <td class='alert alert-danger' role='alert'> No Expense in given Dates </td><td> </td></tr>";
                    }

        echo "<tr id='totalexp'><td> </td> <td> Total   </td><td id='totexp'>  ".$ppsum." </td></tr>";
        
            ?>
        </table>
</div>
      <?php
        if(isset($_GET['del'])){
         // $id = (int)$_GET['del'];
     //$removeQuery = "UPDATE expense SET isdel='1' Where id=$id AND uid='$sid'";

        if (mysqli_query($conn, $removeQuery))
    {
        echo "
        <script> 
          alert('Entry Deleted Successfully'); 
          location.href = 'home.php';
         </script>     
    ";
    }
  
        }
      ?>
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

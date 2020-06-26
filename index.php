<?php
require 'connection.php';
$wrongpass = '';
$wronginfo = '<div class="alert alert-danger" role="alert">  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Wrong login detail</div>';

if(isloggedin()==FALSE)
{
}
else
{
header("location:home.php");  
  
}
  
  if(isset($_POST['email']) && ($_POST['pass']))
{

$pass= mysqli_real_escape_string($conn, $_POST['pass']);
$email= mysqli_real_escape_string($conn, $_POST['email']);
$query="SELECT * from users where uemail='$email'";
$result = $conn->query($query);

if ($result->num_rows < 1) 
  {
      $wrongpass = $wronginfo;
  }

 while($row = $result->fetch_assoc()) 
    {
  if(md5($pass)==$row['upass'])
  {
    $_SESSION['logged_in']=TRUE;
    $_SESSION['id']=$row['uid'];
    $_SESSION['name']=$row['uname'];
    session_start();
    header("location:home.php");
  }
  else
   {
    $wrongpass = $wronginfo;
   }
    }
  }


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
    <body>
        <div style="padding:10px; margin:10px;">
<div class="panel panel-primary">
  <div class="panel-heading"><b>Daily Expense Manager</b></div>
  <div class="panel-body">
  <div class="row">
  <div class="col-md-3">
  

  <div class="panel panel-success">
  <div class="panel-heading"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Signin with your existing Account</div>
  <div class="panel-body">


  <form class="form-horizontal" name="login" action="index.php" method="post">
  <div class="form-group">
    <label for="Email" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="Email" placeholder="Email" name="email" required>
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="Password" placeholder="Password" name="pass" required>
    </div>
  </div>
  <?php
echo $wrongpass;
?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
  </div>
</form>

  </div>
  </div>


  </div>
    <div class="col-md-3">
    <img src="images/demo.jpg" alt="..." class="img-thumbnail img-responsive">
    </div>

  <div class="col-md-6">
 <div class="panel panel-primary">
  <div class="panel-heading"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> New user? Create your free Account</div>
  <div class="panel-body">



      <form class="form-horizontal" action="index.php" method="post">
  <div class="form-group">
    <label for="fname" class="col-sm-2 control-label" >Full Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fname" name="fname" autocomplete="off" required placeholder="Write your full name here">
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" id="name" name="name" class="form-control"  autocomplete="off" required placeholder="Email">
      <div id="disp"></div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputPassword3" required placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" required> Agreed terms and conditions
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Create My Account</button>
    </div>
  </div>
</form>
<?php

if(isset($_POST['name']) && trim($_POST['password']) != "")
{

$name= mysqli_real_escape_string($conn, $_POST['name']);
$query="SELECT * from users where uemail='$name'";
$result = $conn->query($query);
if ($result->num_rows < 1) 
  {
$uname = mysqli_real_escape_string($conn, $_POST['fname']);
$uname = strip_tags($uname);
$uemail = mysqli_real_escape_string($conn, $_POST['name']);
$uemail = strip_tags($uemail);
$upass = mysqli_real_escape_string($conn, $_POST['password']);
$upass = md5($upass);

$sql = "INSERT INTO users (uname, uemail, upass)
VALUES ('$uname','$uemail','$upass')";
if ($conn->query($sql) === TRUE) 
  {
  echo '<div class="alert alert-success" role="alert">
  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Your account has been created successfully!</div>';
  } else 
  {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else
{
   echo '<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> You already have an account and can access from login form
</div>';
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
    </body>
</html>
<?php
require 'connection.php';
if(isset($_POST['name'])){
    $name=  mysqli_real_escape_string($conn,$_POST['name']);
    $query="SELECT * FROM users WHERE uemail='$name'";
    $result=$conn->query($query);
    if($result->num_rows==0){
        
    }else{
        echo "<span style='color:red;font-weight: bold;'>You already registered with this email</span>";
    }
}

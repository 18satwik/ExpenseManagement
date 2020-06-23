<?php

require 'connection.php';
$_SESSION['logged_in']=FALSE;
session_unset();
session_destroy();
header("location:index.php");


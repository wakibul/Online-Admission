<?php

date_default_timezone_set('Asia/Kolkata');
$conn = mysqli_connect("localhost","root","0942","nitish-db");
ini_set("display_errors",1);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$webUrl = "http://localhost/nitish-project/"; 
$webTitle = "Demo Project";
?>
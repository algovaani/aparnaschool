<?php
$host="localhost"; // Host name
$db_username='root'; // Mysql username
$db_password=''; // Mysql password
$db_name='aparna_school'; // Database name
$conn7= mysqli_connect($host,$db_username,$db_password,$db_name);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>
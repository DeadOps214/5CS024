<?php

$mysqli = mysqli_connect("localhost", "2218466", "61hl2c", "db2218466");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Run SQL query
$res = mysqli_query($mysqli, "SELECT * FROM Users");

// Are there any errors in my SQL statement?
if(!$res) {
  print("MySQL error: " . mysqli_error($mysqli));
  exit;
}
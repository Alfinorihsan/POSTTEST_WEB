<?php

$databaseHost = 'localhost';
$databaseName = '018_alfi';
$databaseUsername = 'root';
$databasePassword = '';

$connection = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if(!$connection) {
  die('Connection Error: ' . mysqli_connect_errno());
}
?>
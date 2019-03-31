<?php

	 $DBhost = "localhost";
	 $DBuser = "root";
	 $DBpass = "kimatia7950";
	 $DBname = "imma";
	 
	 $DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
    
     if ($DBcon->connect_errno) {
         die("ERROR : -> ".$DBcon->connect_error);
     }

$conn = mysqli_connect('localhost' , 'root' , 'kimatia7950', 'imma')or die ('problem to connect database');
//PDO db connection1

  $DB_HOST = 'localhost';
  $DB_USER = 'root';
  $DB_PASS = 'kimatia7950';
  $DB_NAME = 'imma';
  
  try{
    $DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  
  $localhost = 'localhost';
  $root = 'root';
  $DB_PASS = 'kimatia7950';
  $DB_NAME = 'imma';
$con = mysqli_connect($localhost, $root, $DB_PASS,$DB_NAME);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

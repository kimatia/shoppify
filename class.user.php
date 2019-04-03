<?php

require_once 'dbconfig.php';

class USER
{

 private $conn;

 public function __construct()
 {
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
    }

 public function runQuery($sql)
 {
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }

 public function lasdID()
 {
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }

 public function register($uname,$email,$upass,$uphone,$uNatId,$urole)
 {
  try
  {
   $password = md5($upass);
   $stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,userEmail,userPass,userPhone,nationalId,loginType)
                                                VALUES(:user_name, :user_mail, :user_pass, :user_phone, :natId, :user_type)");
   $stmt->bindparam(":user_name",$uname);
   $stmt->bindparam(":user_mail",$email);
   $stmt->bindparam(":user_pass",$password);
   $stmt->bindparam(":user_phone",$uphone);
   $stmt->bindparam(":natId",$uNatId);
   $stmt->bindparam(":user_type",$urole);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }

 public function login($email,$upass)
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
   $stmt->execute(array(":email_id"=>$email));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

   if($stmt->rowCount() == 1)
   {
     if($userRow['userPass']==md5($upass))
     {
       if($userRow['loginType']=="admin"){
         $_SESSION['userSession'] = $userRow['userID'];
         echo "<script>window.location.assign('adhome.php')</script>";
       }elseif($userRow['loginType']=="worker"){
         $_SESSION['userSession'] = $userRow['userID'];
         echo "<script>window.location.assign('home.php')</script>";
       }
     }
     else
     {
      header("Location: login.php?error");
      exit;
     }
   }
   else
   {
    header("Location: login.php?error");
    exit;
   }
 }catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }


 public function is_logged_in()
 {
  if(isset($_SESSION['userSession']))
  {
   return true;
  }
 }

 public function redirect($url)
 {
  header("Location: $url");
 }

 public function logout()
 {
  session_destroy();
  $_SESSION['userSession'] = false;
 }
}

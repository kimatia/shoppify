<?php
date_default_timezone_set("Africa/Nairobi");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
  require_once 'dbconfig.php';
  require_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
    header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();
  
if(isset($_GET['delete_id']))
  {
    // select image from db to delete
   
    // it will delete an actual record from db
    $stmt_delete = $DB_con->prepare('DELETE FROM tbl_users WHERE user_id =:uid');
    $stmt_delete->bindParam(':uid',$_GET['delete_id']);
    $stmt_delete->execute();
    
    header("Location: users.php");
  }
  if(isset($_GET['lock_id'])){
    $id=$_GET['lock_id'];
    $lock=1;
      $stmt = $DB_con->prepare('UPDATE tbl_users SET lockvalue=:lock WHERE user_id=:uid');
      $stmt->bindParam(':lock',$lock);
      $stmt->bindParam(':uid',$id);
        
      if($stmt->execute()){
        ?>
                <script>
        alert('User successfully Locked ...');
        window.location.href='users.php';
        </script>
                <?php
      }
      else{
        $errMSG = "Sorry user could not be locked !";
      }
  }
  if(isset($_GET['unlock_id'])){
    $id=$_GET['unlock_id'];
    $lock=0;
      $stmt = $DB_con->prepare('UPDATE tbl_users SET lockvalue=:lock WHERE user_id=:uid');
      $stmt->bindParam(':lock',$lock);
      $stmt->bindParam(':uid',$id);
        
      if($stmt->execute()){
        ?>
                <script>
        alert('User successfully Unlocked ...');
        window.location.href='users.php';
        </script>
                <?php
      }
      else{
        $errMSG = "Sorry user could not be Unlocked !";
      }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <title>Welcome - <?php echo $userRow['email']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/image-effects.css" rel="stylesheet">
    <link href="css/custom-styles.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    </head>

  <body>
    
      <div class="container">
     
        <div class="row">
          <div class="site-header spacing-t">
            <div class="col-md-3 ">
              <div class="site-name spacing-b">
                <h1> BOUTIQU MANAGEMENT</h1>
                <h6>Buy and book items for reservation.</h6>
              </div>
            </div>
          <div class="col-md-9">
            <nav class="navbar pull-right " role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse"><h3 class="hide">Menu</h3>
            <span class="fw-icon-th-list "></span>
            
          </button>
         
        </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="adhome.php">Home</a></li>
                  <li class="dropdown ">
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown">About <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Events Hub</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Rooms</a></li>
                <li><a href="#">Us</a></li>
              </ul>
            </li>
                  <li><a class="navbar-brand" href="users.php">Users</a></li>
          <li><a class="navbar-brand" href="addnew.php">Add new </a></li>
                  <li class="dropdown ">
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown"><?php echo "Hello Admin ".$userRow['username']; ?><b class="caret"></b></a>
               <ul class="dropdown-menu">
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
            </ul>
            </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
        
          </div>
          </div>
        </div>
     
    </div>
    <div class="container">
    <div class="subscribe">
    <?php
if(isset($_GET['sms_id'])){
$mailid=$_GET['sms_id'];
     $stmt_select = $DB_con->prepare('SELECT * FROM tbl_users WHERE user_id =:uid');
    $stmt_select->execute(array(':uid'=>$mailid));
    $userSelect=$stmt_select->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
if (isset($_POST['btn_save_sms'])) {
   $firstname=$userSelect['firstname'];
    $lastname=$userSelect['lastname'];
    $full_name=$firstname." ".$lastname;
     $text_message=$_POST['message'];
  $messagee=$text_message;
require_once __DIR__ . '/vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic('3d981e72','6X2ucIKjdQeynb8g');
$client = new \Nexmo\Client($basic);
$number=$userSelect['phonenumber'];
$message = $client->message()->send([
    'to' => $number,
    'from' => 'KIMATIA@CIT',
    'text' =>  $messagee
]); 
}
    ?>
<div class="row" style="margin-left: 5px; margin-right: 5px;">
   <form method="post" enctype="multipart/form-data" class="form-horizontal">
<textarea class="form-control" type="text" name="message" placeholder="Enter Message"></textarea><br/>
<button type="submit" name="btn_save_sms" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span>Send Message
        </button>
        </form><br/>
        </div>
    <?php
}
    ?>
      <div class="row">
        <div class="col-md-12">

          <div class="panel panel-default">
            <div class="panel-body">
                  <?php
                 
if(isset($_GET['mail_id'])){
    $mailid=$_GET['mail_id'];
     $stmt_select = $DB_con->prepare('SELECT * FROM tbl_users WHERE user_id =:uid');
    $stmt_select->execute(array(':uid'=>$mailid));
    $userSelect=$stmt_select->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
   
    if (isset($_POST['btn_save_updates'])) {
      $firstname=$userSelect['firstname'];
    $lastname=$userSelect['lastname'];
    $full_name=$firstname." ".$lastname;
     $subject=$_POST['subject'];
     $text_message=$_POST['message'];
require_once 'mailer/class.phpmailer.php';
    // creates object
    $mail = new PHPMailer(true);

      $title="Hello $full_name,";
      $citAccountBody="We are greatfull to trade with you at Boutique management Services a fully incorporated company dealing in fashion industry";
      $email     = $userSelect['email'];
      $body      = $citAccountBody;
     
 require_once 'body.php';
      
      try
      {

        $mail->IsSMTP();
        $mail->isHTML(true);
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host= "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username   ="namandajoshuadaniel";
        $mail->Password   ='namandadaniel199458';
        $mail->SetFrom('namandajoshuadaniel@gmail.com','Boutique Management System');
        $mail->Subject    = $subject;
        $mail->Body     = $message;
        $mail->AltBody    = $message;
       
        if($mail->Send())
        {
          $company_name="Boutique management system";
          $msg = "<div class='alert alert-success'>
            Hello<br /> ".$company_name.", sent an email to. ".$full_name."
              </div>";
        }
      }
      catch(phpmailerException $ex)
      {
        $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";
      }
    }
   ?>
   <div class="row" style="margin-left: 5px; margin-right: 5px;">
   <form method="post" enctype="multipart/form-data" class="form-horizontal">
<input class="form-control" type="text" name="subject" placeholder="Enter Subject" /><br/>
<textarea class="form-control" type="text" name="message" placeholder="Enter Message"></textarea><br/>
<button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span>Send Message
        </button>
        </form><br/>
        </div>
   <?php 
  }
?>
           
               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 10px;">First Name</th>
                                            <th style="font-size: 10px;">Last Name</th>
                                            <th style="font-size: 10px;">Username</th>
                                            <th style="font-size: 10px;">Contact No.</th>
                                            <th style="font-size: 10px;">Email</th>
                                            <th style="font-size: 10px;">Action</th>
                                        </tr>
                                    </thead>
                <tbody>
           <?php
   $stmt = $DB_con->prepare('SELECT * FROM tbl_users ORDER BY user_id ASC');
  $stmt->execute();
  if($stmt->rowCount() > 0)
  {
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
      extract($row);
      ?>
                <tr>
                        <td style="font-size: 10px;"><div class="col" id="user_data_1"><?php echo $row['firstname']; ?> </div></td>
                        <td style="font-size: 10px;"><div class="col" id="user_data_2"><?php echo $row['lastname']; ?> </div></td>
                        <td style="font-size: 10px;"><div class="col" id="user_data_4"><?php echo $row['username']; ?> </div></td>
                         <td style="font-size: 10px;"><div class="col" id="user_data_5"><?php echo $row['phonenumber']; ?> </div></td>
                        <td style="font-size: 10px;"><div class="col" id="user_data_6"><?php echo $row['email']; ?> </div></td>
                        <td style="font-size: 10px;"><div class="col" id="user_data_6">
                        <div class="row">
                          <div class="col-md-3">
                            <span class=""><a class="btn btn-primary" href="users.php?sms_id=<?php echo $row['user_id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Sms&nbsp;&nbsp;&nbsp;</a></span>
                          </div>
                          <div class="col-md-3">
                            <span class=""><a class="btn btn-primary" href="?mail_id=<?php echo $row['user_id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Mail&nbsp;&nbsp;&nbsp;</a></span>
                          </div>

                          <div class="col-md-3">
                           <?php
                          $lockid=1;
                          $unlockid=0;
                       if($row['lockvalue']==$lockid){
                           ?>
                       <span class=""><a class="btn btn-danger" href="?unlock_id=<?php echo $row['user_id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Unlock</a></span>
                           <?php
                         }elseif($row['lockvalue']==$unlockid){
                           ?>
                      <span class=""><a class="btn btn-primary" href="?lock_id=<?php echo $row['user_id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> &nbsp;Lock&nbsp;&nbsp;&nbsp;</a></span>
                           <?php
                         }
                          ?>
                            
                          </div>
                          <div class="col-md-3">
                            <span class=""><a class="btn btn-primary" href="users.php?delete_id=<?php echo $row['user_id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Delete&nbsp;&nbsp;&nbsp;</a></span>
                          </div>
                        </div>
                         </div></td>
                        
                    </tr>
                <?php
                 }
                }
               ?>                 
                </tbody>
            
            </table>
          
          
            </div>
          </div>
        </div>
           
     
</div>
    </div>
    </div>
      <br>
 
     <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
  <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  
       
  </body>
</html>

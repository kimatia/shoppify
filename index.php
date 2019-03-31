<?php
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
    header("Location: home.php");
    exit;
}

if (isset($_POST['btn-login'])) {
    
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    
    $email = $DBcon->real_escape_string($email);
    $password = $DBcon->real_escape_string($password);
    if(empty($email&&$password)){
        $errMSG="Please fill in all the fields!";
    }else{
    $query = $DBcon->query("SELECT * FROM tbl_users WHERE email='$email'");
    $row=$query->fetch_array();
    
    $count = $query->num_rows; // if email/password are correct returns must be 1 row
    
    if (password_verify($password, $row['password']) && $count==1) {
        if($row['verify']==1){
           if($row['logintype']==3){
$_SESSION['userSession'] = $row['user_id'];
        $successMSG1="Successfuly signed in...";
        header("refresh:2; adhome.php");
        }
        elseif($row['logintype']==0){
        $_SESSION['userSession'] = $row['user_id'];
        $successMSG1="Successfuly signed in...";
        header("refresh:2; home.php");    
        } 
    }elseif($row['verify']==0){
$errMSG1="Your account isn't yet verified. We've sent you an SMS with verification code.";
$message1="Your verification code is ";
$rowUniqueRandomCode=rand(1000, 9999);
$messagee=$message1."".$rowUniqueRandomCode;
$email=$row['email'];
$stmt = $DB_con->prepare('UPDATE tbl_users SET verifyCode=:vcode WHERE email=:uemail');
$stmt->bindParam(':vcode',$rowUniqueRandomCode);
$stmt->bindParam(':uemail',$email);
$stmt->execute();
require_once __DIR__ . '/vendor/autoload.php';

$basic  = new \Nexmo\Client\Credentials\Basic('code', 'API key');
$client = new \Nexmo\Client($basic);
$number=$row['phonenumber'];
$message = $client->message()->send([
    'to' => $number,
    'from' => 'BOUTIQUE',
    'text' =>  $messagee
]); 
 header("refresh:2; verify.php");
    }
        
    } else {
        $errMSG1="Invalid email address or paword.";
    }
    $DBcon->close();
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
                  <li class="active"><a href="#">Home</a></li>
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
      <div class="row" style="padding-top: 80px">
<div class="col-md-5 col-md-offset-3">
  <div class="panel panel-default">
    
      <div class="panel-heading">
        <center><strong>LOGIN</strong></center>
        <?php
    if(isset($errMSG1)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG1; ?></strong>
            </div>
            <?php
    }
    else if(isset($successMSG1)){
        ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG1; ?></strong>
        </div>
        <?php
    }
    ?>   
      </div>
      <div class="panel-body">
        <form class="form-signin" method="post" id="register-form">
        <div class="form-group input-group">
        <span class="input-group-addon">Email Add</span>
        <input type="email" required="true" class="form-control" placeholder="Email address" name="email" />
       
        </div>
        
        <div class="form-group input-group">
        <span class="input-group-addon">Password.</span>
        <input type="password" required="true" class="form-control" placeholder="Password" name="password" />
        </div>
       
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-round" name="btn-login" id="btn-login">
        <span class="glyphicon glyphicon-log-in"></span> &nbsp;Login
      </button>  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            
            <a href="register.php" class="btn btn-primary btn-round">Signup</a>
            <a href="verify.php" class="btn btn-primary btn-round">Verify</a>
            
        </div>  
        
        
      
      </form>
 </div>
      <div class="panel-footer">
      
        <?php
    if(isset($errMSG)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
    }
    else if(isset($successMSG)){
        ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
    }
    ?>   
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

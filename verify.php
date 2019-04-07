<?php
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
  header("Location: home.php");
  exit;
}
if (isset($_POST['btn-verify'])) {
    $verifyCode=$_POST['verify'];
    $email=$_POST['email'];
  // select image from db to delete
        $stmt_select = $DB_con->prepare('SELECT verifyCode FROM tbl_users WHERE email =:umail');
        $stmt_select->execute(array(':umail'=>$email));
        $selectRow=$stmt_select->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
        $selectCode=$selectRow['verifyCode'];
        if($selectCode==$verifyCode){
$verify=1;
$stmt = $DB_con->prepare('UPDATE tbl_users SET verify=:vrify WHERE email=:uemail');
$stmt->bindParam(':vrify',$verify);
$stmt->bindParam(':uemail',$email);
$stmt->execute();
$successMSG1="Successfuly verified...You can Sign in.";
header("refresh:2; index.php");
        }else{
$verify=0;
$stmt = $DB_con->prepare('UPDATE tbl_users SET verify=:vrify WHERE email=:uemail');
$stmt->bindParam(':vrify',$verify);
$stmt->bindParam(':uemail',$email);
$stmt->execute();
            $errMSG1="Your Verification Code is wrong";

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
                  <li><a href="services.php">Services</a></li>
                    <li><a href="revervations.php">View Reservations</a></li>
                    <li><a href="reserved.php">View Reserved</a></li>
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
        <span class="input-group-addon">Verification Code.</span>
        <input type="text" required="true" class="form-control" placeholder="Verification Code" name="verify" />
        </div>
       
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-round" name="btn-verify" id="btn-login">
        <span class="glyphicon glyphicon-log-in"></span> &nbsp;Verify
      </button>  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            
            <a href="index.php" class="btn btn-primary btn-round">Login</a>
            
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

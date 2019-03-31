<?php
ini_set('display_errors', 1);
session_start();
require_once 'class.user.php';
$user_login = new USER();
if($user_login->is_logged_in()!="")
{
  $stmt = $user_login->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
  $stmt->execute(array(":uid"=>$_SESSION['userSession']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row['loginType']=="admin"){
    $user_login->redirect('adhome.php');
  }else if($row['loginType']=="worker"){
    $user_login->redirect('home.php');
  }
}

if(isset($_POST['btn-login']))
{
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtupass']);

 if($user_login->login($email,$upass))
 {
  #$user_login->redirect('home.php');
 }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | Palm</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
          <!-- Navigation -->
          <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.php">Palm</a>
              </div>
              <!-- /.navbar-header -->

              <ul class="nav navbar-top-links navbar-right">
                <li>
                  <a class="navbar-brand" href="signup.php">Signup</a>
                </li>
              </ul>
              <!-- /.navbar-top-links -->
              <!-- /.navbar-static-side -->
          </nav>

    <div class="container">
        <div class="row">

            <div class="col-md-4 col-lg-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                              <?php
                                    if(isset($_GET['error']))
                              {
                               ?>
                                <div class='alert alert-danger'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Wrong Details!</strong>
                               </div>
                              <?php
                              }
                              if(isset($_SESSION['offline'])){
                                echo $_SESSION['offline'];
                              }
                              ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="txtemail" type="email" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="txtupass" type="password" value="" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" type="submit" name="btn-login">Login</button></br>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>

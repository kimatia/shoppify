<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
  $stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
  $stmt->execute(array(":uid"=>$_SESSION['userSession']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row['loginType']=="admin"){
    $reg_user->redirect('adhome.php');
  }else if($row['loginType']=="company"){
    $reg_user->redirect('home.php');
  }
}


if(isset($_POST['btn-signup']))
{
 $uname = trim($_POST['txtuname']);
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtpass']);
 $uphone = trim($_POST['txtphone']);
 $uNatId = trim($_POST['txtNatId']);
 $urole = trim($_POST['txtrole']);

 $stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
 $stmt->execute(array(":email_id"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);

 if($stmt->rowCount() > 0)
 {
  $msg = "
        <div class='alert alert-danger'>
    <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry !</strong>  User with that email already exists , Please Try another one
     </div>
     ";
 } else {
  if($reg_user->register($uname,$email,$upass,$uphone,$uNatId,$urole)){
    $msg = "
          <div class='alert alert-success'>
      <button class='close' data-dismiss='alert'>&times;</button>
       <strong>Success !</strong>  You can now login.
       </div>
       ";
       //after successful login, lets take the worker to the login page
       header("refresh:3;login.php");
 }else  {
   echo "sorry , Query could no execute...";
  }
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

    <title>Signup | Palm</title>

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

<body class="imgbg">



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
                  <a class="navbar-brand" href="login.php">Login</a>
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
                        <h3 class="panel-title">Please Signup</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                              <?php if(isset($msg)) echo $msg;  ?>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Username" name="txtuname"  autofocus required>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="E-mail" name="txtemail" type="email" required>
                              </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone number" name="txtphone" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="National Number" name="txtNatId" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="txtpass" type="password" value="" required>
                                </div>
                                <div class="form-group">
                                  <input name="txtrole" type="hidden" value="worker" required>
                                 </div>
                                <button class="btn btn-lg btn-success btn-block" type="submit" name="btn-signup">Signup</button></br>
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

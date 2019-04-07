<?php
date_default_timezone_set("Africa/Nairobi");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
  require_once 'dbconfig.php';
  require_once 'dbconnect.php';
  require_once("dbcontroller.php");
$db_handle = new DBController();

if (!isset($_SESSION['userSession'])) {
    header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();
  if(isset($_GET['delete_id']))
  {
    // select image from db to delete
    $stmt_select = $DB_con->prepare('SELECT * FROM category_products WHERE id =:uid');
    $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
    $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
    unlink("upload/".$imgRow['productImage']);
    
    // it will delete an actual record from db
    $stmt_delete = $DB_con->prepare('DELETE FROM category_products WHERE id =:uid');
    $stmt_delete->bindParam(':uid',$_GET['delete_id']);
    $stmt_delete->execute();
    
    header("Location: index.php");
  }

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
  case "add":
    if(!empty($_POST["quantity"])) {
      $productByCode = $db_handle->runQuery("SELECT * FROM category_products WHERE id='" . $_GET["code"] . "'");
      $itemArray = array($productByCode[0]["id"]=>array('name'=>$productByCode[0]["productName"], 'code'=>$productByCode[0]["id"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["productPrice"], 'image'=>$productByCode[0]["productImage"]));
      
      if(!empty($_SESSION["cart_item"])) {
        if(in_array($productByCode[0]["id"],array_keys($_SESSION["cart_item"]))) {
          foreach($_SESSION["cart_item"] as $k => $v) {
              if($productByCode[0]["id"] == $k) {
                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                  $_SESSION["cart_item"][$k]["quantity"] = 0;
                }
                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
              }
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }
  break;
  case "remove":
    if(!empty($_SESSION["cart_item"])) {
      foreach($_SESSION["cart_item"] as $k => $v) {
          if($_GET["code"] == $k)
            unset($_SESSION["cart_item"][$k]);        
          if(empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
      }
    }
  break;
  case "empty":
    unset($_SESSION["cart_item"]);
  break;  
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
<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
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
                <h1> BOUTIQUE MANAGEMENT</h1>
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
                <?php
if (isset($_SESSION['userSession'])) {
    ?>
<li class="active"><a href="adhome.php">Home</a></li>
    <?php
}else{
  ?>
<li class="active"><a href="#">Home</a></li>
    <?php
}
                ?>
                  
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
                  <?php
if (isset($_SESSION['userSession'])) {
    ?>
<a href="#" class="dropdown-toggle active" data-toggle="dropdown"><?php echo "Hello Admin ".$userRow['username']; ?><b class="caret"></b></a>
               <ul class="dropdown-menu">
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
            </ul>    <?php
}else{
  ?>
<a href="#" class="dropdown-toggle active" data-toggle="dropdown">Welcome<b class="caret"></b></a>
               <ul class="dropdown-menu">
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
            </ul>    <?php
}
                ?>
              
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
      <div class="row">
<div class="col-md-4">
  <div class="panel panel-default">
        
            <div class="panel-heading">
                <center><strong>MASSERGE</strong></center>
                
            </div>
             <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/manicure8.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/masserge.jpeg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure4.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/manicure3.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure5.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/masserge2.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
            </div>
            
            <div class="panel-footer">
                
            </div>
        </div>
  </div>
  <div class="col-md-4">
  <div class="panel panel-default">
        
            <div class="panel-heading">
                <center><strong>MANICURE</strong></center>
                
            </div>
             <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/namicure1.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/namicure2.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure3.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/manicure4.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure5.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure6.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
            </div>
            
            <div class="panel-footer">
                
            </div>
        </div>
  </div>
  <div class="col-md-4">
  <div class="panel panel-default">
        
            <div class="panel-heading">
                <center><strong>PEDICURE</strong></center>
                
            </div>
             <div class="panel-body">
               <div class="row">
                  <div class="col-md-4">
                    <img src="services/pedicure4.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/pedicure3.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/pedicure2.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/pedicure1.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/pedicure.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure6.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div> 
            </div>
            
            <div class="panel-footer">
                
            </div>
        </div>
  </div>
</div>
      <div class="row">
<div class="col-md-4">
  <div class="panel panel-default">
        
            <div class="panel-heading">
                <center><strong>HAIRDRESSING</strong></center>
                
            </div>
             <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/hair3.jpeg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/hair4.jpeg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/hair5.jpeg" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/hair6.jpeg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/hair1.jpeg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/hair2.jpeg" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
            </div>
            
            <div class="panel-footer">
                
            </div>
        </div>
  </div>
  <div class="col-md-4">
  <div class="panel panel-default">
        
            <div class="panel-heading">
                <center><strong>BOOKINGS</strong></center>
                
            </div>
             <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/namicure1.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/namicure2.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure3.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/manicure4.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure5.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure6.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
            </div>
            
            <div class="panel-footer">
                
            </div>
        </div>
  </div>
  <div class="col-md-4">
  <div class="panel panel-default">
        
            <div class="panel-heading">
                <center><strong>PEDICURE</strong></center>
                
            </div>
             <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/namicure1.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/namicure2.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure3.png" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <img src="services/manicure4.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure5.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                  <div class="col-md-4">
                    <img src="services/manicure6.jpg" class="img-rounded" width="90px" height="90px" />
                  </div>
                </div>
            </div>
            
            <div class="panel-footer">
                
            </div>
        </div>
  </div>
</div>
    </div>
    </div>
      <br>
    
<div class="modal fade" id="productView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H4" style="color: orange;"><center>Product Details</center></h4>
    </div>
    <div class="productViewDisplay">
   
  </div>
  
            
        </div>
    </div>
</div>
    <script type="text/javascript">
      
    $('#productView').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal17
          var recipient = button.data('whatever4') // Extract info from data-* attributes
          
          var modal4 = $(this);
          var dataString4 = 'id=' + recipient;
          var dataString2 = 'idd=' + "2";
       
            $.ajax({
                type: "GET",
                url: "productView.php",
                data: dataString4,
                cache: false,
                beforeSend: function (data) {
                    console.log('Retrieving Data....');
                },
                success: function (data) {
                    console.log(data);
                    modal4.find('.productViewDisplay').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });

    })
</script>
      
   <script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
  <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>

       
  </body>
</html>

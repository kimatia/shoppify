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
    
    header("Location: adhome.php");
  }
if(isset($_GET['reserve_id'])){
   // select image from db to delete
    $stmt_select = $DB_con->prepare('SELECT * FROM category_products WHERE id =:uid');
    $stmt_select->execute(array(':uid'=>$_GET['reserve_id']));
    $stmt_reserve=$stmt_select->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
    $pid=$stmt_reserve['pid'];
$category=$stmt_reserve['productCategory'];
$name=$stmt_reserve['productName'];
$price=$stmt_reserve['productPrice'];
$color=$stmt_reserve['productColour'];
$description=$stmt_reserve['productDescription'];
$productDiscount=$stmt_reserve['productDiscount'];
$productFee=$stmt_reserve['productFee'];
$productImage=$stmt_reserve['productImage'];
$reserveName=$userRow['username'];
$reserveNumner=$userRow['phonenumber'];
$postDate=date("h:i A.",time());
$stmt = $DB_con->prepare('INSERT INTO tbl_reservation(pid,productCategory,productName,productPrice,productColour,productDescription,productDiscount,productFee,productImage,personelle,pnumber,postDate) VALUES(:pid,:ctgory, :pname, :pprice, :pcolor, :pdesc, :pdisc, :pfee, :pimage, :person,:rnum, :pdate)');
      $stmt->bindParam(':pid',$pid);
      $stmt->bindParam(':ctgory',$category);
      $stmt->bindParam(':pname',$name);
      $stmt->bindParam(':pprice',$price);
      $stmt->bindParam(':pcolor',$color);
      $stmt->bindParam(':pdesc',$description);
      $stmt->bindParam(':pdisc',$productDiscount);
      $stmt->bindParam(':pfee',$productFee);
      $stmt->bindParam(':pimage',$productImage);
      $stmt->bindParam(':person',$reserveName);
      $stmt->bindParam(':rnum',$reserveNumner);
      $stmt->bindParam(':pdate',$postDate);
      
      if($stmt->execute())
      {
        $reserveNum="1";
      $stst = $DB_con->prepare('UPDATE category_products SET reservationNumber=:rnum  WHERE id=:uid');
      $stst->bindParam(':rnum',$reserveNum);
      $stst->bindParam(':uid',$reserve_id);
      $stst->execute();
        $successMSG = "Product succesfully reserved ...";
        header("refresh:5;adhome.php"); // redirects image view page after 5 seconds.
      }
      else
      {
        $errMSG = "error while inserting....";
      }
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
if(isset($_GET['release_id'])){
  // select image from db to delete
    $stmt_select = $DB_con->prepare('SELECT * FROM category_products WHERE id =:uid');
    $stmt_select->execute(array(':uid'=>$_GET['release_id']));
    $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
    $stmt_select_user = $DB_con->prepare('SELECT * FROM tbl_reservation WHERE id =:uid');
    $stmt_select_user->execute(array(':uid'=>$_GET['release_id']));
    $stmt_reserve=$stmt_select_user->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
    $pid=$stmt_reserve['id'];
$category=$stmt_reserve['productCategory'];
$name=$stmt_reserve['productName'];
$price=$stmt_reserve['productPrice'];
$color=$stmt_reserve['productColour'];
$description=$stmt_reserve['productDescription'];
$productDiscount=$stmt_reserve['productDiscount'];
$productFee=$stmt_reserve['productFee'];
$productImage=$stmt_reserve['productImage'];
$reserveName=$userRow['username'];
$reserveNumner=$userRow['phonenumber'];
$postDate=date("h:i A.",time());
    $stmt = $DB_con->prepare('INSERT INTO tbl_reserved(pid,productCategory,productName,productPrice,productColour,productDescription,productDiscount,productFee,productImage,personelle,pnumber,postDate) VALUES(:pid,:ctgory, :pname, :pprice, :pcolor, :pdesc, :pdisc, :pfee, :pimage, :person,:pnum, :pdate)');
      $stmt->bindParam(':pid',$pid);
      $stmt->bindParam(':ctgory',$category);
      $stmt->bindParam(':pname',$name);
      $stmt->bindParam(':pprice',$price);
      $stmt->bindParam(':pcolor',$color);
      $stmt->bindParam(':pdesc',$description);
      $stmt->bindParam(':pdisc',$productDiscount);
      $stmt->bindParam(':pfee',$productFee);
      $stmt->bindParam(':pimage',$productImage);
      $stmt->bindParam(':person',$reserveName);
      $stmt->bindParam(':pnum',$reserveNumner);
      $stmt->bindParam(':pdate',$postDate);
      $stmt->execute();

    // it will delete an actual record from db
    $stmt_delete = $DB_con->prepare('DELETE FROM category_products WHERE id =:uid');
    $stmt_delete->bindParam(':uid',$_GET['release_id']);
    $stmt_delete->execute();
    // it will delete an actual record from db
    $stmt_delete_reserve = $DB_con->prepare('DELETE FROM tbl_reservation WHERE id =:uid');
    $stmt_delete_reserve->bindParam(':uid',$_GET['release_id']);
    $stmt_delete_reserve->execute();
    
    header("Location: revervations.php");
}
if(isset($_GET['delete_id'])){
    // it will delete an actual record from db
    $stmt_delete_reserve = $DB_con->prepare('DELETE FROM tbl_reserved WHERE id =:uid');
    $stmt_delete_reserve->bindParam(':uid',$_GET['delete_id']);
    $stmt_delete_reserve->execute();
    header("Location: reserved.php");
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
                  <li class="active"><a href="adhome.php">Home</a></li>
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
                  <li class="dropdown">
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
if(isset($_GET['contact_id'])){
$contactID=$_GET['contact_id'];

$stmt_select_contact = $DB_con->prepare('SELECT * FROM tbl_reserved WHERE id =:uid');
    $stmt_select_contact->execute(array(':uid'=>$contactID));
    $userSelectContact=$stmt_select_contact->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
   $number=$userSelectContact['pnumber'];
     $stmt_select = $DB_con->prepare('SELECT * FROM tbl_users WHERE phonenumber =:uid');
    $stmt_select->execute(array(':uid'=>$number));
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
     <div class="col-md-12">
               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 10px;color: white;">Product Name</th>
                                            <th style="font-size: 10px;color: white;">Product Category</th>
                                            <th style="font-size: 10px;color: white;">Product Description</th>
                                            <th style="font-size: 10px;color: white;">Product Price</th>
                                            <th style="font-size: 10px;color: white;">Product Discount</th>
                                            <th style="font-size: 10px;color: white;">Product Picture</th>
                                            <th style="font-size: 10px;color: white;">User</th>
                                            <th style="font-size: 10px;color: white;">Action</th>
                                        </tr>
                                    </thead>
                <tbody>
           <?php
  $stmt_select = $DB_con->prepare('SELECT * FROM tbl_reserved');
  $stmt_select->execute();
  if($stmt_select->rowCount() > 0)
  {
    while($row=$stmt_select->fetch(PDO::FETCH_ASSOC))
    {
      extract($row);
      ?>
                <tr>
                        <td style="font-size: 10px;color: white;"><div class="col" id="user_data_1"><nn style="color: black;"><?php echo $row['productName']; ?></nn> </div></td>
                        <td style="font-size: 10px;color: white;"><div class="col" id="user_data_2"><nn style="color: black;"><?php echo $row['productCategory']; ?></nn> </div></td>
                        <td style="font-size: 10px;color: white;"><div class="col" id="user_data_4"><nn style="color: black;"><?php echo $row['productDescription']; ?></nn> </div></td>
                         <td style="font-size: 10px;color: white;"><div class="col" id="user_data_5"><nn style="color: black;"><?php echo $row['productPrice']; ?></nn> </div></td>
                        <td style="font-size: 10px;color: white;"><div class="col" id="user_data_6"><nn style="color: black;"><?php echo $row['productDiscount']; ?></nn> </div></td>
                        <td style="font-size: 10px;color: white;"><div class="col" id="user_data_8"><nn style="color: black;"><img src="upload/<?php echo $row['productImage']; ?>" class="img-rounded" width="50px" height="30px" /></div></td>
                       <td style="font-size: 10px;color: white;"><div class="col" id="user_data_6"><nn style="color: black;"><?php echo $row['pnumber']; ?></nn> </div></td>
                       <td style="font-size: 10px;color: white;"><div class="col" id="user_data_6">
                        <div class="row">
                          <div class="col-md-6">
                            <span class=""><a class="btn btn-primary" href="?delete_id=<?php echo $row['id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Delete Reserve&nbsp;&nbsp;&nbsp;</a></span>
                          </div>
                          <div class="col-md-6">
                            <span class=""><a class="btn btn-primary" href="?contact_id=<?php echo $row['id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Contact Person&nbsp;&nbsp;&nbsp;</a></span>
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

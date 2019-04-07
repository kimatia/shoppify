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
      <div class="row">
   <div class="col-md-4">
   <?php
if(isset($_SESSION["cart_item"])){
  $pid=rand(2000,6310);
    $total_quantity = 0;
    $total_price = 0;
?>
   <div class="txt-heading" style="color: white;">Shipment Details</div>
   <hr>

   <?php
$firstname=$userRow['firstname'];
$lastname=$userRow['lastname'];
$fullname=$firstname." ".$lastname;
   ?>
   <pp style="color: white;">Name: <?php echo $fullname; ?></pp><br>
   <pp style="color: white;">Contact: <?php echo $userRow['phonenumber']; ?></pp><br>
   <pp style="color: white;">Email: <?php echo $userRow['email']; ?></pp><br>
   <pp style="color: white;">Mode: Road Transport</pp><br>
   <pp style="color: white;">Duration: 2 Days.</pp>

   </div>
   <div class="col-md-8">
      <div id="shopping-cart">
<div class="txt-heading" style="color: white;">Shopping Cart</div><hr>
<a id="btnEmpty" href="adhome.php?action=empty">Empty Cart</a>
  
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;color: white;" width="10%">Name</th>
<th style="text-align:left;color: white;" width="10%">Product ID</th>
<th style="text-align:right;color: white;" width="5%">Quantity</th>
<th style="text-align:right;color: white;" width="10%">Unit Price</th>
<th style="text-align:right;color: white;" width="10%">Price</th>
<th style="text-align:center;color: white;" width="5%">Remove</th>
</tr> 
<?php   
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
        
    ?>
        <tr>
        <td width="10%"><img src="upload/<?php echo $item["image"]; ?>" class="cart-item-image" width="50" height="50" /><?php echo $item["name"]; ?></td>
        <td style="text-align:right;color: white;" width="10%"><?php echo $item["code"]; ?></td>
        <td style="text-align:right;color: white;" width="5%"><?php echo $item["quantity"]; ?></td>
        <td  style="text-align:right;color: white;" width="10%"><?php echo "KES ".$item["price"]; ?></td>
        <td  style="text-align:right;color: white;" width="10%"><?php echo "KES ". number_format($item_price,2); ?></td>
        <td style="text-align:center;color: white;" width="5%"><a href="adhome.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
        </tr>
        <?php
        $checkout=
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"]*$item["quantity"]);
    }
   if(isset($_GET['price'])){

$firstname=$userRow['firstname'];
$lastname=$userRow['lastname'];
$fullname=$firstname." ".$lastname;
$phonenumber=$userRow['phonenumber'];
$email=$userRow['email'];
$mode="Road Transport";
$duration="2 Days";
     $stmt = $DB_con->prepare('INSERT INTO checkout(checkoutCode,productName,productPrice,email,name,phone,mode,duration) VALUES(:cid, :pname, :pprice,:email,:name,:phone,:mode,:duration)');
      $stmt->bindParam(':cid',$pid);
      $stmt->bindParam(':pname',$item["name"]);
      $stmt->bindParam(':pprice',$item["price"]);
      $stmt->bindParam(':email',$email);
      $stmt->bindParam(':name',$fullname);
      $stmt->bindParam(':phone',$phonenumber);
      $stmt->bindParam(':mode',$mode);
      $stmt->bindParam(':duration',$duration);
      if($stmt->execute()){
$message1="Your purchase details are:";
$particularName=$item["name"];
$particularPrice=$item["price"];
$code="Code:";
$name="Name:";
$price="Price:";
$mail="Email:";
$mmode="Mode:";
$time="Duration:";
$for="for:";
$number="Phone";
$comma=",";
$messagee=$message1." ".$code." ".$pid."".$comma." ".$name." ".$particularName."".$comma." ".$price." ".$particularPrice."".$comma." ".$mail." ".$email."".$comma." ".$mmode." ".$mode."".$comma." ".$time." ".$duration." ".$for." ".$fullname."".$comma." ".$number." ".$phonenumber;
require_once __DIR__ . '/vendor/autoload.php';
$basic  = new \Nexmo\Client\Credentials\Basic('3d981e72','6X2ucIKjdQeynb8g');
$client = new \Nexmo\Client($basic);
$uphone=$userRow['phonenumber'];
$message = $client->message()->send([
    'to' => $uphone,
    'from' => 'KIMATIA@CIT',
    'text' =>  $messagee
]);
      }
      unset($_SESSION["cart_item"]);
      $firstname=$userRow['firstname'];
    $lastname=$userRow['lastname'];
    $full_name=$firstname." ".$lastname;
     $subject=$item["name"];
     $text_message=$item["price"];
require_once 'mailer/class.phpmailer.php';
    // creates object
    $mail = new PHPMailer(true);

      $title="Hello $full_name,";
      $citAccountBody="We are greatfull to trade with you at Boutique management Services a fully incorporated company dealing in fashion industry. Your amount is ";
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
      echo "<script>window.location.assign('adhome.php')</script>";
   }
    ?>

<tr>
<td colspan="2" align="right" style="text-align:right;color: white;">Total:</td>
<td align="right" style="text-align:right;color: white;"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong style="text-align:right;color: white;"><?php echo "KES ".number_format($total_price, 2); ?></strong></td>
<td align="right" colspan="2"><strong style="text-align:right;color: white;"><a href="adhome.php?price=<?php echo $total_price; ?>&quantity=<?php echo $total_quantity; ?>&checkout=<?php echo $checkout; ?>">Checkout</a></strong></td>
</tr>
</tbody>
</table>    
  <?php
} 
?>
</div>
<hr>
   </div>
</div>

<br />

<div class="row">


<?php
  
  $stmt = $DB_con->prepare('SELECT * FROM category_products ORDER BY id DESC');
  $stmt->execute();
  
  if($stmt->rowCount() > 0)
  {
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
      extract($row);
      ?>
        <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-body">
      <a href="#" data-toggle="modal" data-target="#productView" data-whatever4=<?php echo $row['id']; ?>>
      <img src="upload/<?php echo $row['productImage']; ?>" class="img-rounded" width="190px" height="200px" />
      </a>
            <div class="row">
              <div class="col-md-6">
                <h4 style="color: black;"><pp style="color: orange;">Name: </pp><?php echo $row['productName']; ?></h4><br>
            <h4 style="color: black;"><pp style="color: orange;">KES: </pp><?php echo $row['productPrice']; ?></h4>
              </div>
              <div class="col-md-5">   
      <form method="post" action="adhome.php?action=add&code=<?php echo $row['id']; ?>">
      <div class="cart-action">
      <div class="row">
        <div class="row">
          <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
        </div>
        <br>
        <div class="row">  
        <input type="submit" value="Add to Cart" class=" icon-info-sign" />
        </div>
      </div>
      </div>
     
      </form>
    </div>
      </div>
      </div>
      </div>
    </div>    
      <?php
    }
  }
  
  
?>
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

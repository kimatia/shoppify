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
                  <li class="dropdown ">
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown"><?php echo "Hello User ".$userRow['username']; ?><b class="caret"></b></a>
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
      <div class="row">
    <div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>
<a id="btnEmpty" href="adhome.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>  
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
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"]*$item["quantity"]);
    }
    ?>

<tr>
<td colspan="2" align="right" style="text-align:right;color: white;">Total:</td>
<td align="right" style="text-align:right;color: white;"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong style="text-align:right;color: white;"><?php echo "KES ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>    
  <?php
} 
?>
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
            <div class="col-md-3 product">
      <a href="#" data-toggle="modal" data-target="#productView" data-whatever4=<?php echo $row['id']; ?>>
      <img src="upload/<?php echo $row['productImage']; ?>" class="img-rounded" width="190px" height="200px" />
      </a>
            <div class="row">
              <div class="col-md-6">
                <h4 style="color: black;"><pp style="color: orange;">Name: </pp><?php echo $row['productName']; ?></h4>
            <h4 style="color: black;"><pp style="color: orange;">KES: </pp><?php echo $row['productPrice']; ?></h4>
              </div>
              <div class="col-md-5">   
      <form method="post" action="adhome.php?action=add&code=<?php echo $row['id']; ?>">
      <div class="cart-action">
      <div class="row">
        <div class="col-md-6">
          <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
        </div>
        <div class="col-md-6">  
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

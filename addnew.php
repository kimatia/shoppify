<script type="text/javascript">
	function fetch_select_gender(val)
{
 $.ajax({
 type: 'post',
 url: 'fetch_data.php',
 data: {
  get_option_name:val
 },
 success: function (response) {
  document.getElementById("new_select_ID").innerHTML=response; 
 }
 });
}
</script>
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
	require_once 'dbconfig.php';
	
	if(isset($_POST['btnsave']))
	{
		$pid=$_POST['pid'];//product ID
		$category=$_POST['category'];
		$pname = $_POST['pname'];// product name
		$pprice = $_POST['pprice'];// product price
		$pcolor = $_POST['pcolor'];// product color
		$pdescription = $_POST['pdescription'];// product price
		$pdiscount = $_POST['pdiscount'];// product price
		$pfee = $_POST['pfee'];// product price
		$ppersonnele = $_POST['ppersonnele'];// product personnele
		$postDate=date("h:i A.",time());
		$imgFile = $_FILES['pimage']['name'];
		$tmp_dir = $_FILES['pimage']['tmp_name'];
		$imgSize = $_FILES['pimage']['size'];
		
		
		 if((empty($pid))&&(!empty($pname))&&(!empty($pprice))&&(!empty($pcolor))&&(!empty($pdescription))&&(!empty($pdiscount))&&(!empty($pfee))&&(!empty($ppersonnele))){
			$errMSG = "Please Enter Category ID.";
		}
		else if((!empty($pid))&&(empty($pname))&&(!empty($pprice))&&(!empty($pcolor))&&(!empty($pdescription))&&(!empty($pdiscount))&&(!empty($pfee))&&(!empty($ppersonnele))){
			$errMSG = "Please Enter Product Name.";
		}
		else if((!empty($pid))&&(!empty($pname))&&(empty($pprice))&&(!empty($pcolor))&&(!empty($pdescription))&&(!empty($pdiscount))&&(!empty($pfee))&&(!empty($ppersonnele))){
			$errMSG = "Please Enter Product Price.";
		}
	    else if((!empty($pid))&&(!empty($pname))&&(!empty($pprice))&&(empty($pcolor))&&(!empty($pdescription))&&(!empty($pdiscount))&&(!empty($pfee))&&(!empty($ppersonnele))){
			$errMSG = "Please Enter Product Colour.";
		}else if((!empty($pid))&&(!empty($pname))&&(!empty($pprice))&&(!empty($pcolor))&&(empty($pdescription))&&(!empty($pdiscount))&&(!empty($pfee))&&(!empty($ppersonnele))){
			$errMSG = "Please Enter Product Description.";
		}
		else if((!empty($pid))&&(!empty($pname))&&(!empty($pprice))&&(!empty($pcolor))&&(!empty($pdescription))&&(empty($pdiscount))&&(!empty($pfee))&&(!empty($ppersonnele))){
			$errMSG = "Please Enter Product Discount.";
		}
		else if((!empty($pid))&&(!empty($pname))&&(!empty($pprice))&&(!empty($pcolor))&&(!empty($pdescription))&&(!empty($pdiscount))&&(empty($pfee))&&(!empty($ppersonnele))){
			$errMSG = "Please Enter Product Fee.";
		}
		
		else if((!empty($pid))&&(!empty($pname))&&(!empty($pprice))&&(!empty($pcolor))&&(!empty($pdescription))&&(!empty($pdiscount))&&(!empty($pfee))&&(empty($ppersonnele))){
			$errMSG = "Please Enter Personelle Incharge.";
		}
		else
		{

			$upload_dir = 'upload/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '20MB'
				if($imgSize < 20000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO category_products(pid,productCategory,productName,productPrice,productColour,productDescription,productDiscount,productFee,productImage,personelle,postDate) VALUES(:pid,:ctgory, :pname, :pprice, :pcolor, :pdesc, :pdisc, :pfee, :pimage, :person, :pdate)');
			$stmt->bindParam(':pid',$pid);
			$stmt->bindParam(':ctgory',$category);
			$stmt->bindParam(':pname',$pname);
			$stmt->bindParam(':pprice',$pprice);
			$stmt->bindParam(':pcolor',$pcolor);
			$stmt->bindParam(':pdesc',$pdescription);
			$stmt->bindParam(':pdisc',$pdiscount);
			$stmt->bindParam(':pfee',$pfee);
			$stmt->bindParam(':pimage',$userpic);
			$stmt->bindParam(':person',$ppersonnele);
			$stmt->bindParam(':pdate',$postDate);
			
			if($stmt->execute())
			{
				$successMSG = "Product succesfully inserted ...";
				header("refresh:5;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "error while inserting....";
			}
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

<form method="post"  enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label" style="color: white;">Product Category.</label></td>
        <td>
        <?php
        $stmtSelect = $DB_con->prepare('SELECT * FROM categories ORDER BY id ASC');
	$stmtSelect->execute();
         ?>
<select class="form-control" name="category" type="text" onchange="fetch_select_gender(this.value)";>
<?php while($rowSelect=$stmtSelect->fetch(PDO::FETCH_ASSOC)){?>
<option value="<?php echo $rowSelect['name']; ?>"> <?php echo $rowSelect['name']; ?>
</option>
<?php } ?>
</select>
        </td>
    </tr>
    <tr>
      <td><label class="control-label" style="color: white;">Category ID.</label></td>
        <td>
 <select class="form-control" name="pid" id="new_select_ID" type="text" >

</select>
        </td>
    </tr>
    <tr>
    	<td><label class="control-label" style="color: white;">Product Name.</label></td>
        <td><input class="form-control" type="text" name="pname" placeholder="Product Name" /></td>
    </tr>
    <tr>
    	<td><label class="control-label" style="color: white;">Product Price.</label></td>
        <td><input class="form-control" type="text" name="pprice" placeholder="Product Price" /></td>
    </tr>
    <tr>
    	<td><label class="control-label" style="color: white;">Product Colour.</label></td>
        <td><input class="form-control" type="text" name="pcolor" placeholder="Product Description" /></td>
    </tr>
    <tr>
    	<td><label class="control-label" style="color: white;">Product Description.</label></td>
        <td><input class="form-control" type="text" name="pdescription" placeholder="Product Description" /></td>
    </tr>
    <tr>
    	<td><label class="control-label" style="color: white;">Product Discount.</label></td>
        <td><input class="form-control" type="text" name="pdiscount" placeholder="Product Discount" /></td>
    </tr>
    <tr>
    	<td><label class="control-label" style="color: white;">Shipping Fee.</label></td>
        <td><input class="form-control" type="text" name="pfee" placeholder="Product Shiping Fee" /></td>
    </tr>
    <tr>
    	<td><label class="control-label" style="color: white;">Personelle Incharge.</label></td>
        <td><input class="form-control" type="text" name="ppersonnele" placeholder="Product Help Personnele" /></td>
    </tr>
    <tr>
    	<td><label class="control-label" style="color: white;">Product Image.</label></td>
        <td><input class="input-group" type="file" name="pimage" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; save
        </button>
        </td>
    </tr>
    
    </table>
    
</form>
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

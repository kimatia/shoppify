<?php

date_default_timezone_set("Africa/Nairobi");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM category_products WHERE id =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
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
		
		$imgFile = $_FILES['file']['name'];
		$tmp_dir = $_FILES['file']['tmp_name'];
		$imgSize = $_FILES['file']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'upload/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$userpic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['userPic']);
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic = $edit_row['productImage']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{

			$id=$_GET['edit_id'];
			$stmt = $DB_con->prepare('UPDATE category_products SET pid=:pid, productCategory=:ctgory,productName=:pname,productPrice=:pprice,productColour=:pcolor,productDescription=:pdesc,productDiscount=:pdisc,productFee=:pfee,productImage=:pimage,personelle=:person,postDate=:pdate WHERE id=:uid');
			
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
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='index.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
		
		}
		
						
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master | Edit</title>
 <!-- Bootstrap Core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
<link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Master</a>
            </div>
    <div class="container">
 
        <div class="navbar-header">
            <a class="navbar-brand" href="#" title='Palm'>Home</a>
            <a class="navbar-brand" href="#">About</a>
            <a class="navbar-brand" href="#">Services</a>
            <a class="navbar-brand" href="#">Downloads</a>

        </div>
            <ul class="nav navbar-top-links navbar-right">
           <a href="#" data-toggle="modal" data-target="#find"><span class="fa fa-search"></span> Search</a>
               
                <a class="dropdown get_tooltip" data-toggle="tooltip" data-placement="bottom" title="logout">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> Hello <!-- <?php echo $row['userName'];?> --> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"> Logout</i></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </a>
            </ul>
    </div>
        
</nav>



<div class="container">
 <div class="row" style="background-color: cream">

	<div class="page-header">
    	<h1 class="h2"> <a class="btn btn-default" href="index.php"> all members </a></h1>
    </div>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Product Category.</label></td>
        <td><input class="form-control" type="text" value="<?php echo $edit_row['productCategory'] ?>" name="category" placeholder="Product Category" /></td>
    </tr>
    <tr>
      <td><label class="control-label">Category ID.</label></td>
        <td><input class="form-control" type="text" value="<?php echo $edit_row['pid'] ?>" name="pid" placeholder="Product ID" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Name.</label></td>
        <td><input class="form-control" type="text" value="<?php echo $edit_row['productName'] ?>" name="pname" placeholder="Product Name" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Price.</label></td>
        <td><input class="form-control" value="<?php echo $edit_row['productPrice'] ?>" type="text" name="pprice" placeholder="Product Price" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Colour.</label></td>
        <td><input class="form-control" value="<?php echo $edit_row['productColour'] ?>" type="text" name="pcolor" placeholder="Product Description" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Description.</label></td>
        <td><input class="form-control" type="text" value="<?php echo $edit_row['productDescription'] ?>" name="pdescription" placeholder="Product Description" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Discount.</label></td>
        <td><input class="form-control" value="<?php echo $edit_row['productDiscount'] ?>" type="text" name="pdiscount" placeholder="Product Discount" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Shipping Fee.</label></td>
        <td><input class="form-control" value="<?php echo $edit_row['productFee'] ?>" type="text" name="pfee" placeholder="Product Shiping Fee" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Personelle Incharge.</label></td>
        <td><input class="form-control" value="<?php echo $edit_row['personelle'] ?>" type="text" name="ppersonnele" placeholder="Product Help Personnele" /></td>
    </tr>
   <tr>
    	<td><label class="control-label">Profile Img.</label></td>
        <td>
        	<p><img src="upload/<?php echo $edit_row['productImage']; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="file" accept="image/*" />
        </td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
        
        </td>
    </tr>
    
    </table>
    
</form>
</div>
</div>
</body>
</html>
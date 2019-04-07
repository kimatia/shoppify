




<?php
date_default_timezone_set("Africa/Nairobi");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
require_once 'dbconfig.php';
if(isset($_GET['id']))
	{
		// select data from db 
		$stmt_select = $DB_con->prepare('SELECT * FROM category_products WHERE id =:uid');
		$stmt_select->execute(array(':uid'=>$_GET['id']));
		$rowSelect=$stmt_select->fetch(PDO::FETCH_ASSOC);//retursn value as associative array.
		
	}	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master | Add</title>
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



<div class="row">
<div class="panel-body">
	<div class="col-md-6">
	
		<img src="upload/<?php echo $rowSelect['productImage']; ?>" class="img-rounded" width="250px" height="200px" />
		<p>Name: <?php echo $rowSelect['productName']; ?></p>
		<br/>
		<p>Description: <?php echo $rowSelect['productDescription']; ?></p>

</div>
<div class="col-md-6">
<span class=""><a class="btn btn-primary" href="details.php?details_id=<?php echo $rowSelect['id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Details&nbsp;&nbsp;&nbsp;</a></span><br/><br/>
 <span class=""><a class="btn btn-primary" href="editform.php?edit_id=<?php echo $rowSelect['id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> &nbsp;&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;&nbsp;</a></span><br/><br/>
 <span class=""><a class="btn btn-primary" href="adhome.php?reserve_id=<?php echo $rowSelect['id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Reserve&nbsp;</a></span><br/><br/>
 <span class=""><a class="btn btn-primary" href="adhome.php?delete_id=<?php echo $rowSelect['id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Delete&nbsp;&nbsp;&nbsp;&nbsp;</a></span>
	</div>
	</div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
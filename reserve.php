



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
	require_once 'dbconfig.php';
	
	if(isset($_POST['btnsave']))
	{

	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
                        <i class="fa fa-user fa-fw"></i> Hello <?php echo $row['userName'];?> <i class="fa fa-caret-down"></i>
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
<body>



<div class="container">


	<div class="page-header">
    	<h1 class="h2"><a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all products </a></h1>
    </div>
    

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
    	<td><label class="control-label">Product Category.</label></td>
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
      <td><label class="control-label">Category ID.</label></td>
        <td>
 <select class="form-control" name="pid" id="new_select_ID" type="text" >

</select>
        </td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Name.</label></td>
        <td><input class="form-control" type="text" name="pname" placeholder="Product Name" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Price.</label></td>
        <td><input class="form-control" type="text" name="pprice" placeholder="Product Price" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Colour.</label></td>
        <td><input class="form-control" type="text" name="pcolor" placeholder="Product Description" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Description.</label></td>
        <td><input class="form-control" type="text" name="pdescription" placeholder="Product Description" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Discount.</label></td>
        <td><input class="form-control" type="text" name="pdiscount" placeholder="Product Discount" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Shipping Fee.</label></td>
        <td><input class="form-control" type="text" name="pfee" placeholder="Product Shiping Fee" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Personelle Incharge.</label></td>
        <td><input class="form-control" type="text" name="ppersonnele" placeholder="Product Help Personnele" /></td>
    </tr>
    <tr>
    	<td><label class="control-label">Product Image.</label></td>
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



	


<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>
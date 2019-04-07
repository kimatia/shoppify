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
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master | Home</title>
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

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="adhome.php">Home</a>
          <a class="navbar-brand" href="addnew.php">Add new </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!-- navs -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo "Hello Admin ".$userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<body>



<div class="container" style="margin-top: 100px;">

	
<br />

<div class="row">


<?php
	
	$stmt = $DB_con->prepare('SELECT * FROM category_products WHERE id =:uid');
	$stmt->execute(array(':uid'=>$_GET['details_id']));
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>
			 
			 	<div class="col-md-12">
			 		<div class="panel panel-default">
			 			<div class="panel-body">
			 		
            <div class="col-md-12">
               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 10px;">Product Name</th>
                                            <th style="font-size: 10px;">Product Category</th>
                                            <th style="font-size: 10px;">Product Description</th>
                                            <th style="font-size: 10px;">Product Price</th>
                                            <th style="font-size: 10px;">Product Discount</th>
                                            <th style="font-size: 10px;">Product Picture</th>
                                            <th style="font-size: 10px;">Action</th>
                                        </tr>
                                    </thead>
                <tbody>
           <?php
  $stmt_select = $DB_con->prepare('SELECT * FROM category_products WHERE id =:uid');
  $stmt_select->execute(array(':uid'=>$_GET['details_id']));
  if($stmt_select->rowCount() > 0)
  {
    while($row=$stmt_select->fetch(PDO::FETCH_ASSOC))
    {
      extract($row);
      ?>
                <tr>
                        <td style="font-size: 10px;"><div class="col" id="user_data_1"><?php echo $row['productName']; ?> </div></td>
                        <td style="font-size: 10px;"><div class="col" id="user_data_2"><?php echo $row['productCategory']; ?> </div></td>
                        <td style="font-size: 10px;"><div class="col" id="user_data_4"><?php echo $row['productDescription']; ?> </div></td>
                         <td style="font-size: 10px;"><div class="col" id="user_data_5"><?php echo $row['productPrice']; ?> </div></td>
                        <td style="font-size: 10px;"><div class="col" id="user_data_6"><?php echo $row['productDiscount']; ?> </div></td>
                        <td style="font-size: 10px;"><div class="col" id="user_data_8"><img src="upload/<?php echo $row['productImage']; ?>" class="img-rounded" width="50px" height="30px" /></div></td>
                        <td style="font-size: 10px;"><div class="col" id="user_data_6">
                        <div class="row">
                          <div class="col-md-4">
                            <span class=""><a class="btn btn-primary" href="details.php?details_id=<?php echo $row['id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Details&nbsp;&nbsp;&nbsp;</a></span>
                          </div>
                          <div class="col-md-4">
                            <span class=""><a class="btn btn-primary" href="details.php?details_id=<?php echo $row['id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Details&nbsp;&nbsp;&nbsp;</a></span>
                          </div>
                          <div class="col-md-4">
                            <span class=""><a class="btn btn-primary" href="details.php?details_id=<?php echo $row['id']; ?>"><i class=" icon-info-sign" style="color: orange;"></i> Details&nbsp;&nbsp;&nbsp;</a></span>
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
			 	</div>
			     
			<?php
		}
	}
	
	
?>
</div>

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
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
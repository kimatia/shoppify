



<?php
date_default_timezone_set("Africa/Nairobi");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
require_once 'dbconfig.php'; 
//get the logged in user credentials and validate

if(isset($_POST['get_option_name']))
{

 $name = $_POST['get_option_name'];
 $stmtSelectName = $DB_con->prepare('SELECT * FROM categories WHERE name=:name ORDER BY id ASC');
 $stmtSelectName->bindParam(':name',$name);
  $stmtSelectName->execute(); 
  while($rowSelectName=$stmtSelectName->fetch(PDO::FETCH_ASSOC)){?>
<option value="<?php echo $rowSelectName['id']; ?>"> <?php echo $rowSelectName['id']; ?>
</option>
<?php }
 exit;
}

?>
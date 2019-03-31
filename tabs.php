<?php 
include_once("dbconfig.php");

       

$stmt = $DB_con->prepare('SELECT * FROM categories ORDER BY id DESC ');
    $stmt->execute();
    
    if($stmt->rowCount() > 0)
    {
        while($category=$stmt->fetch(PDO::FETCH_ASSOC))
        {
$active_class = 0 ;
$category_html = '';
$product_html = ''; 
	$current_tab = "";
	$current_content = "";
	if(!$active_class) {
		$active_class = 1;
		$current_tab = 'active';
		$current_content = 'in active';
	}	
	$category_html.= '<li class="'.$current_tab.'"><a href="#'.$category['id'].'" data-toggle="tab">'.           
	$category['name'].'</a></li>';
	$product_html .= '<div id="'.$category["id"].'" class="tab-pane fade '.$current_content.'">';
    $stmt_select = $DB_con->prepare('SELECT id, p_name, p_image, price FROM category_products  WHERE pid = :uid');
    $stmt_select->execute(array(':uid'=>$category["id"]));
    if($stmt_select->rowCount() > 0)
    {
        while($product=$stmt_select->fetch(PDO::FETCH_ASSOC))
        {
            $product_html .= '<div class="col-md-3 product">';
            $product_html .= '<img src="images/'.$product["p_image"].'" class="img-responsive img-thumbnail product_image" />';
            $product_html .=  '<h4>'.$product["p_name"].'</h4>';
            $product_html .=  '<h4>Price: $'.$product["price"].'</h4>';
            $product_html .=  '</div>';             
        }   
        $product_html .=  '<div class="clear_both"></div></div>';   
        }elseif($stmt_select->rowCount() <= 0) {
          $product_html .=  '<br>No product found!';
        }	
    }
}
?>

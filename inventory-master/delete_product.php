<?php ob_start();
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(2);
?>
<?php
$product = find_by_product_id('product',(int)$_GET['id']);
$prod = find_all('product_location');
//$prod_loc = find_by_prodloc_id('product_location',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","Missing Product id.");
    redirect('product.php');
  }
?>
<?php
$query   = "DELETE product, product_location";
$query  .=" FROM product INNER JOIN product_location on product_location.product_id = product.product_id WHERE product.product_id = '{$product['product_id']}'";
$result = $db->query($query);

if($db->query($query)){
    $session->msg("s","Product deleted.");
    redirect('product.php');
} else {
    $session->msg("d","Product deletion failed.");
    redirect('product.php');
}
?>

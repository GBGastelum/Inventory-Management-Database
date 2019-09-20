<?php ob_start();
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(1);
?>
<?php
  $category = find_by_type_id('product_type',(int)$_GET['id']);
  if(!$category){
    $session->msg("d","Missing product type ID.");
    redirect('category.php');
  }
?>
<?php
  $delete_id = delete_by_type_id('product_type',(int)$category['type_id']);
  if($delete_id){
      $session->msg("s","Product type deleted.");
      redirect('category.php');
  } else {
      $session->msg("d","Product type deletion failed.");
      redirect('category.php');
  }
?>

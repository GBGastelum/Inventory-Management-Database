<?php ob_start();
  $page_title = 'Edit categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(1);
?>
<?php
  //Display all catgories.
  $categorie = find_by_type_id('product_type',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing product type ID.");
    redirect('category.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('type_name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['type_name']));
  if(empty($errors)){
        $sql = "UPDATE product_type SET type_name='{$cat_name}'";
       $sql .= " WHERE type_id='{$categorie['type_id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated product type");
       redirect('category.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('category.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('category.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing <?php echo remove_junk(ucfirst($categorie['type_name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_category.php?id=<?php echo (int)$categorie['type_id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="type_name" value="<?php echo remove_junk(ucfirst($categorie['type_name']));?>">
           </div>
           <button type="submit" name="edit_cat" class="btn btn-primary">Update Product Type</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>

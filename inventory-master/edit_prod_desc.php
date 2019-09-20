<?php ob_start();
$page_title = 'Edit Product Desc';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
//page_require_level(1);
?>
<?php
  //Display all catgories.
  $description = find_by_desc_id('product_description',(int)$_GET['id']);
  if(!$description){
    $session->msg("d","Missing description id.");
    redirect('product_description.php');
  }
?>

<?php
if(isset($_POST['edit_description'])){
  $req_field = array('product_name');
  validate_fields($req_field);
  $p_att1 = remove_junk($db->escape($_POST['first_attribute']));
  $p_att2 = remove_junk($db->escape($_POST['second_attribute']));
  $p_desc = remove_junk($db->escape($_POST['product_desc']));
  if(empty($errors)){
		$sql = "UPDATE product_description SET first_attribute='{$p_att1}',";
		$sql .=" second_attribute='{$p_att2}, product_desc='{$p_desc}'";
       $sql .= " WHERE desc_id='{$description['desc_id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated location");
       redirect('product_description.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('product_description.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('product_description.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-8">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editing <?php echo remove_junk(ucfirst($description['product_name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_prod_desc.php?id=<?php echo (int)$description['desc_id'];?>">
           <div class="form-group">
		   <label>Location Name:</label>
		   <input type="text" class="form-control" name="first_attribute" value="<?php echo remove_junk(ucfirst($description['first_attribute']));?>">
			   <br><label>Location Description:</label>
			   <input type="text" class="form-control" name="second_attribute" value="<?php echo remove_junk(ucfirst($description['second_attribute']));?>">
           </div>
           <button type="submit" name="edit_prod_desc" class="btn btn-primary">Update Description</button>
       </form>
       </div>
     </div>
   </div>
</div>
<?php include_once('layouts/footer.php'); ?>

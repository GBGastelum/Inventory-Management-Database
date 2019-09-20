<?php ob_start();
  $page_title = 'Edit locations';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(1);
?>
<?php
  //Display all catgories.
  $location = find_by_location_id('locations',(int)$_GET['id']);
  if(!$location){
    $session->msg("d","Missing location id.");
    redirect('location.php');
  }
?>

<?php
if(isset($_POST['edit_location'])){
  $req_field = array('location_name');
  validate_fields($req_field);
  $l_name = remove_junk($db->escape($_POST['location_name']));
  $l_desc = remove_junk($db->escape($_POST['description']));
  if(empty($errors)){
		$sql = "UPDATE locations SET location_name='{$l_name}',";
		$sql .=" description='{$l_desc}'";
       $sql .= " WHERE location_id='{$location['location_id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated location");
       redirect('location.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('location.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('location.php',false);
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
           <span>Editing <?php echo remove_junk(ucfirst($location['location_name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_location.php?id=<?php echo (int)$location['location_id'];?>">
           <div class="form-group">
		   <label>Location Name:</label>
		   <input type="text" class="form-control" name="location_name" value="<?php echo remove_junk(ucfirst($location['location_name']));?>">
			   <br><label>Location Description:</label>
			   <input type="text" class="form-control" name="description" value="<?php echo remove_junk(ucfirst($location['description']));?>">
           </div>
           <button type="submit" name="edit_location" class="btn btn-primary">Update Location</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>

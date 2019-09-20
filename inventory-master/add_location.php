<?php

ob_start();
$page_title = 'Add Location';
require_once('includes/load.php');

//page_require_level(1);

$all_locations = find_all('locations');

?>

<?php

if(isset($_POST['add_location'])) {
	$req_fields = array('location_name');
	validate_fields($req_fields);

	if(empty($errors)) {
		$l_name = remove_junk($db->escape($_POST['location_name']));
		$l_desc = remove_junk($db->escape($_POST['description']));

		$query = "INSERT INTO locations (";
		$query .="location_name, description";
		$query .=") VALUES (";
		$query .=" '{$l_name}', '{$l_desc}'";
		$query .=")";

		if($db->query($query)) {
			$session->msg('s', "Location added");
			redirect('location.php', false);
		} else {
			$session->msg('d', 'Sorry failed to be added!');
			redirect('location.php', false);
		}

	}

	else {
		$session->msg("d", $errors);
		redirect('add_location.php', false);
	}
}

?>

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
<div class="col-md-10">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Location</span>
         </strong>
        </div>
				<div class="panel-body">
          <form method="post" action="add_location.php">
              <div class="form-group">
                <div class="input-group-text">
									<label>Location Name:</label>
                  <input type="text" class="form-control" name="location_name" placeholder="Enter Location Name">
									<br><label>Location Description:</label><br>
                  <input type="text" class="form-control" name="description" placeholder="Optional: Enter Description">
               </div>
							 </div>
              <button type="submit" name="add_location" class="btn btn-danger">Add Location</button>
          </form>

				</div>
			 </div>
				 </div>
				</div>
		 </div>


<?php include_once('layouts/footer.php'); ?>

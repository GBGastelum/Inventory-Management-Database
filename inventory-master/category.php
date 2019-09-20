<?php ob_start();
  $page_title = 'All categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(1);
  
  $all_categories = find_all('product_type')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('type_name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['type_name']));
   if(empty($errors)){
      $sql  = "INSERT INTO product_type (type_name)";
      $sql .= " VALUES ('{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully added product type");
        redirect('category.php',false);
      } else {
        $session->msg("d", "Sorry failed to insert.");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Product Type</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="category.php">
            <div class="form-group">
                <input type="text" class="form-control" name="type_name" placeholder="Product Type Name">
            </div>
            <button type="submit" name="add_cat" class="btn btn-primary">Add Product Type</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Product Types</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Product Types</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['type_name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_category.php?id=<?php echo (int)$cat['type_id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_category.php?id=<?php echo (int)$cat['type_id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

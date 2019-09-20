<?php
ob_start();
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(2);
  $all_categories = find_all('product_type');
  $all_location = find_all('locations');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('product_name','quantity', 'type_name', 'location_name');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product_name']));
     $p_qty   = remove_junk($db->escape($_POST['quantity']));
	 $p_type   = remove_junk($db->escape($_POST['type_name'].value));
	 $p_loc    = remove_junk($db->escape($_POST['location_name'].value));
     $query  = "INSERT INTO product (";
     $query .="product_name, quantity, type_id";
     $query .=") VALUES (";
     $query .="'{$p_name}', '{$p_qty}', '{$p_type}'";
     $query .=")";
     
     if($db->query($query)){
     $sql = "INSERT into product_location(";
     $sql .="product_id, location_id";
     $sql .=") VALUES (";
     $sql .= "'{$db->insert_id()}', '{$p_loc}'";
     $sql .= ")";
     } else {
         $db->rollback();
         $session->msg('d', 'Failed');
     }
     
     if($db->query($sql)){
         $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product_name" placeholder="Product Name">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="type_name">
                      <option value="">Select Product Type</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['type_id'] ?>">
                        <?php echo $cat['type_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="location_name">
                      <option value="">Select Location Name</option>
                    <?php  foreach ($all_location as $loc): ?>
                      <option value="<?php echo (int)$loc['location_id'] ?>">
                        <?php echo $loc['location_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="quantity" placeholder="Product Quantity">
                  </div>
                 </div>
                 
               </div>
              </div>
              <button type="submit" name="add_product" class="btn btn-danger">Add product</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>

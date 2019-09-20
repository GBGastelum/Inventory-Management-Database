<?php ob_start();
$page_title = 'Edit product';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
//page_require_level(2);
?>
<?php
$view = name_location();
?>
<?php
 if(isset($_POST['product'])){
 //array of the fields/columns that are required to edit table
    $req_fields = array('product_name','quantity');
    validate_fields($req_fields);
//checks if errors array is empty
       $p_name  = remove_junk($db->escape($_POST['product_name']));
       $p_qty   = remove_junk($db->escape($_POST['quantity']));
       $p_type   = remove_junk($db->escape($_POST['type_name'].value));
       $p_loc  = remove_junk($db->escape($_POST['location_name'].value));
  
	   if(empty($errors)){
	   //updating products table
       $query   ="UPDATE product";
       $query  .=" INNER JOIN product_location ON product.product_id = product_location.product_id";
       $query  .=" SET product.product_name ='{$p_name}', product.quantity ='{$p_qty}',";
       $query  .=" product.type_id ='{$p_type}', product_location.location_id = '{$p_loc}'";
       $query  .=" WHERE product.product_id ='{$product['product_id']}'";    
       $result = $db->query($query);
       
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Product updated ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_product.php?id='.$product['product_id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['product_id'], false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Updating Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['product_id']; ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product_name" value="<?php echo remove_junk($product['product_name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="type_name">
                    <option value=""> Select a categorie</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['type_id']; ?>" <?php if($product['type_id'] === $cat['type_id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['type_name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="location_name">
                      <option value="">Select Location Name</option>
                    <?php  foreach ($all_location as $loc): ?>
                      <option value="<?php echo (int)$loc['location_id']; ?>" <?php if($prod_loc['location_id'] === $loc['location_id']): echo "selected"; endif; ?> >
                        <?php echo remove_junk($loc['location_name']); ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Quantity</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="quantity" value="<?php echo remove_junk($product['quantity']); ?>">
                   </div>
                  </div>
                 </div>
                 
                 
               </div>
              </div>
              <button type="submit" name="product" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>

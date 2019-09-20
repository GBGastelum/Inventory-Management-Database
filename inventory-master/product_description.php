<?php

ob_start();
$page_title = 'Product Description';
require_once('includes/load.php');

//page_require_level(1);
$descriptions = find_all('product_description');

?>

<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-10">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-10">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_prod_desc.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th style="width: 500px;"> Product Name </th>
                <th style="width: 300px;"> First Attribute </th>
                <th style="width: 300px;"> Second Attribute </th>
				<th style="width: 500px;"> Product Description </th>
				<th class="text-center" style="width: 200px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($descriptions as $description):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><?php echo remove_junk($description['product_name']); ?></td>
				<td><?php echo remove_junk($description['first_attribute']); ?></td>
				<td><?php echo remove_junk($description['second_attribute']); ?></td>
				<td><?php echo remove_junk($description['product_desc']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_location.php?id=<?php echo (int)$description['desc_id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_location.php?id=<?php echo (int)$description['desc_id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

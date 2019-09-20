<?php
ob_start();
$page_title = 'All Product';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
// page_require_level(2);
// $products = join_product_table();
$products = find_all('product');
$user = find_all('user_info');

$con = mysqli_connect("localhost", "root", "", "inventory");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM product";
$result = mysqli_query($con,$sql);

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
	<div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<div class="pull-right">
					<a href="add_product.php" class="btn btn-primary">Add New</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th class="text-center" style="width: 500px;">Manufacturer</th>
							<th class="text-center" style="width: 300px;">Part Number</th>
							<th class="text-center" style="width: 500px;">Product Name</th>
							<th class="text-center" style="width: 500px;">Description</th>
							<th class="text-center" style="width: 200px;">Price per Unit</th>
							<th class="text-center" style="width: 200px;">Expiration Date</th>
							<th class="text-center" style="width: 100px;">Quantity</th>
							<!--  <th class="text-center" style="width: 100px;">Actions</th>-->
						</tr>
					</thead>
					<tbody>
            
              <?php foreach ($products as $product):?>
            <tr onClick="document.location.href='viewproduct.php?id=<?php echo (int)$product['product_id'];?>'">
     
                <td class="text-center"><?php echo count_id();?></td>
                 <td class="text-center"><?php echo remove_junk($product['manufacturer']); ?></td>
						<td class="text-center"> <?php echo remove_junk($product['part_number']); ?></td>
						<td class="text-center"> <?php echo remove_junk($product['product_name']); ?></td>
				
	<td class="text-center"><?php echo remove_junk($product['description']); ?></td>
                    
						<td class="text-center"> <?php echo remove_junk($product['price']); ?></td>
						<td class="text-center"> <?php echo remove_junk($product['exp_date']); ?></td>
						<td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
						
						</tr>
						<!--  <td class="text-center">
                    <div class="btn-group">
                     <a href="viewproduct.php?id=<?php echo (int)$product['product_id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['product_id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span> -->
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
<?php include_once('layouts/footer.php'); ?>

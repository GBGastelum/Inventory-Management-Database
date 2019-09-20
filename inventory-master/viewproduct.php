<?php
ob_start();
$page_title = 'All Product';
require_once ('includes/load.php');

$product = find_by_product_id('product', (int)$_GET['id']);
$users = find_all('user_info');
//$u = find_by_userinfo_id('user_info', (int)$_GET['id']);

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
         </div>
        </div>
        <div class="panel-body">
        <form method="get" action="viewproduct.php?id=<?php echo (int)$users['product_id'];?>">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th style="width: 40%;">Name</th>
				<th style="width: 40%;">Location</th>
              </tr>
            </thead>
            <tbody>
             <?php foreach($users as $user):
//if(isset($_GET['id'])) {
                // $product['product_id'] = $_GET['id'];

       ?>
              <tr>
              
                <td class="text-center"><?php echo count_id();?></td>
             
              <td><?php echo remove_junk($user['first_name']); ?>
                <?php echo remove_junk($user['last_name']); ?></td>
				<td><?php echo remove_junk($user['location_name']); ?></td>
				<?php 
           //  }
           endforeach;
				?>
		
                <!-- <td class="text-center">
                   <div class="btn-group">
                    <a href="edit_location.php?id=<?php echo (int)$view['product_id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_location.php?id=<?php echo (int)$view['location_id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div> -->
                </td>
              </tr>
               
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
            
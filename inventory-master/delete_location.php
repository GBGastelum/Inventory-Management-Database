<?php ob_start();
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(1);
?>
<?php
  $location = find_by_location_id('locations',(int)$_GET['id']);
  if(!$location){
    $session->msg("d","Missing location id.");
    redirect('location.php');
  }
?>
<?php
  $delete_id = delete_by_location_id('locations',(int)$location['location_id']);
  if($delete_id){
      $session->msg("s","Location deleted.");
      redirect('location.php');
  } else {
      $session->msg("d","Location deletion failed.");
      redirect('Location.php');
  }
?>
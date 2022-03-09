<?php
	include('../database/db_connection.php');

	$name = $_POST['txt_name'];
    $desc = $_POST['txt_desc'];
    $status = $_POST['txt_status'];
    $dicPerent = $_POST['txt_dicPerent'];
    $stDate = $_POST['txt_stDate'];
    $enDate = $_POST['txt_enDate'];

    $insertSQL = "INSERT INTO `tbl_discount`(`name`, `description`, `discountPerent`, `startDate`, `endDate`, `status`) VALUES ('$name','$desc','$dicPerent','$stDate','$enDate','$status')";
    $runSQL = mysqli_query($conn,$insertSQL);
    if($runSQL)
     {
        echo('<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Message </strong>Discount Inserted successfully
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>');
     }
     else{
       	echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Message </strong>Discount Inserted is not successfully
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>');
      }
?>
<?php
	include('database/db_connection.php');

	$cateName = $_POST['txt_cateName'];
    $desc = $_POST['txt_desc'];
    $status = $_POST['txt_status'];
    $insertSQL = "INSERT INTO `tbl_category`(`name`, `description`, `status`) VALUES ('$cateName','$desc','$status')";
    $runSQL = mysqli_query($conn,$insertSQL);
    if($runSQL)
     {
        echo('<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Message </strong> Insert successfully
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>');
     }
     else{
       	echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Message </strong> Insert is not successfully
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>');
      }
?>
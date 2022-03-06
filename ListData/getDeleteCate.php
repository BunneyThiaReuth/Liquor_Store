<?php
	include('../database/db_connection.php');
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$sql = "DELETE FROM `tbl_category` WHERE `cateId` = $id";
		$result = mysqli_query($conn,$sql);
		if($result){
			$response['status'] = "Success";
			$response['message'] = "Deletes is Successfully...";
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Message </strong> Delete successfully
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>';
		}
		else{
			$response['status'] = "Error";
			$response['message'] = "Deletes is not Successfully...";
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Message </strong> Delete is not successfully
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>';
		}
	}
	
?>
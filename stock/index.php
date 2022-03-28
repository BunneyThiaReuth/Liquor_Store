<?php
include('../libaries/auth.php');
if(!isLogin(2))
{
	header("location:../login/login.php?page=login");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body class="bg-dark">
	<?php include('include/navbar.php') ?>
	<div class="w-100 bg-light" style="height: 2px">
	</div>
	<div class="row mt-4 w-100 container-fluid">
	  <div class="col text-white">
		  <div class="float-start mt-4">
		  	<img src="../images/userImage/<?=$_SESSION['img']?>" width="250px">
		  </div>
		  <div class="float-end mt-5">
				<h4><?=$_SESSION['username']?></h4>
				<h4>
					<?php
						if($_SESSION['gender'] == 0)
						{
							echo "Female";
						}
						else
						{
							echo "Male";
						}
					?>
				</h4>
			  	<p><?= $_SESSION['mail']?></p>
				<h1 style="font-size: 30px"><strong>STOCK MANAGEMENT</strong></h1>
		  </div>
		  	
		</div>
	  <div class="col">
		<h3 class="text-white w-50" >
				<box-icon name='printer' size='lg' color='white' class="mt-2"></box-icon>
				Report
			</h3>
			<div class=" mt-2 text-white">
				  <table id="data3" class="table table-dark table-striped w-100">
					<thead>
					  <tr class="text-center">
						<th>#Number</th>
						<th>Date</th>
						<th>Status</th>
						<th>Description</th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						 <td>
						  #1029
						  </td>
						<td>01-Jan-2022</td>
						<td>Check</td>
						<td>report</td>
					  </tr>
					<tr>
						 <td>
						  #1030
						  </td>
						<td>01-Jan-2022</td>
						<td>Check</td>
						<td>report</td>
					  </tr>
					<tr>
						 <td>
						  #1024
						  </td>
						<td>01-Jan-2022</td>
						<td>No Check</td>
						<td>report</td>
					  </tr>
						
					</tbody>
				  </table>
			</div>
		</div>
	</div>
	
	<div class="row mt-2 container-fluid w-100">
	  	<div class="col">
			<h3 class="text-white w-50" >
				<box-icon name='archive-out' size='lg' color='white' class="mt-2"></box-icon>
				Products OutStock
			</h3>
			<div class=" mt-2 text-white">
				  <table id="data1" class="table table-dark table-striped w-100">
					<thead>
					  <tr class="text-center">
						<th>image</th>
						<th>Products Name</th>
						<th>Quantity</th>
						<th>Price</th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						 <td>
						  <img src="../image/themnail/tmn_pro/1.jpg" width="50px">
						  </td>
						<td>John</td>
						<td>1</td>
						<td>$25.00</td>
					  </tr>
						<tr>
						 <td>
						  <img src="../image/themnail/tmn_pro/2.jpg" width="50px">
						  </td>
						<td>John</td>
						<td>1</td>
						<td>$45.00</td>
					  </tr>
						<tr>
						 <td>
						  <img src="../image/themnail/tmn_pro/3.jpg" width="50px">
						  </td>
						<td>John</td>
						<td>1</td>
						<td>$35.00</td>
					  </tr>
					</tbody>
				  </table>
			</div>
		</div>
		<div class="col w-50">
			<h3 class="text-white w-50" >
				<box-icon name='chart' size='lg' color='white' class="mt-2"></box-icon>
				Message
			</h3>
			<div class=" mt-2 text-white">
				  <table id="data2" class="table table-dark table-striped w-100">
					<thead>
					  <tr class="text-center">
						<th>Photo</th>
						<th>Name</th>
						<th>Position</th>
						<th>Description</th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						 <td>
						  <img src="../image/themnail/tmn_User/user.png" width="55px">
						  </td>
						<td>ThiaReuth</td>
						<td>Admin</td>
						<td>Hi</td>
					  </tr>
						<tr>
						 <td>
						  <img src="../image/themnail/tmn_User/user.png" width="55px">
						  </td>
						<td>Kheng</td>
						<td>Stock</td>
						<td>Hello</td>
					  </tr>
						<tr>
						 <td>
						  <img src="../image/themnail/tmn_User/user.png" width="55px">
						  </td>
						<td>Heang</td>
						<td>Sale</td>
						<td>Hello</td>
					  </tr>
					</tbody>
				  </table>
			</div>
		</div>
	</div>
	
	
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
				$('#data1').DataTable();
			} );
	</script>
	<script>
		$(document).ready(function() {
				$('#data2').DataTable();
			} );
	</script>
	<script>
		$(document).ready(function() {
				$('#data3').DataTable();
			} );
	</script>
</body>
</html>
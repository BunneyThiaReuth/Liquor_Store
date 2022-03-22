<?php
include('../libaries/auth.php');
if(!isLogin())
{
	header("location:../login/login.php?page=login");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php') ?>
<body>
	<div class="container-fluid">
		<div class="row">
		  <div class="col-sm-1 bg-dark p-2" style="width: 60px">
				<div class="mt-5">
			  	<a href="index.php" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
					<box-icon type='solid' name='dashboard' color='white' size='md'></box-icon>
					</a>
			  </div>
			  <div class="mt-5">
			  	<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Message">
					<box-icon name='chat' color='white' size='md'></box-icon>
					</a>
			  </div>
			  <div class="mt-5">
			  	<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Create Invoice">
					<box-icon name='receipt' color='white' size='md'></box-icon>
					</a>
			  </div>
			  <div class="mt-5">
			  	<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="List Invoice">
					<box-icon name='spreadsheet' color='white' size='md'></box-icon>
					</a>
			  </div>
			  <div class="mt-5">
			  	<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Print Receipt">
					<box-icon name='printer' color='white' size='md'></box-icon>
					</a>
			  </div>
			</div>
		  <div class="col-sm-8">
			  <?php include('include/navbar.php')?>
				<table id="data" class="table table-striped mt-3" style="width:100%">
					<thead>
						<tr class="text-center">
							<th>Items 1</th>
							<th>Items 2</th>
							<th>Items 3</th>
							<th>Items 4</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="card" style="width:190px">
								  <img class="card-img-top" src="../image/themnail/tmn_pro/1.jpg" alt="Card image" width="180px">
								  <div class="card-body">
									<h4 class="card-title">John Doe</h4>
									<p class="card-text">Price : $25.00</p>
									 <input type="number" class="form-control mb-2" value="0">
										<a href="#" class="btn btn-danger">Remove</a>
									  <a href="#" class="btn btn-primary">Add</a>
								  </div>
								</div>
							</td>
							<td>
								<div class="card" style="width:190px">
								  <img class="card-img-top" src="../image/themnail/tmn_pro/2.jpg" alt="Card image" width="180px">
								  <div class="card-body">
									<h4 class="card-title">John Doe</h4>
									<p class="card-text">Price : $45.00</p>
									  <input type="number" class="form-control mb-2" value="0">
									<a href="#" class="btn btn-danger">Remove</a>
									  <a href="#" class="btn btn-primary">Add</a>
								  </div>
								</div>
							</td>
							<td>
								<div class="card" style="width:190px">
								  <img class="card-img-top" src="../image/themnail/tmn_pro/2.jpg" alt="Card image" width="180px">
								  <div class="card-body">
									<h4 class="card-title">John Doe</h4>
									<p class="card-text">Price : $35.00</p>
									  <input type="number" class="form-control mb-2" value="0">
									<a href="#" class="btn btn-danger">Remove</a>
									  <a href="#" class="btn btn-primary">Add</a>
								  </div>
								</div>
							</td>
							<td>
								<div class="card" style="width:190px">
								  <img class="card-img-top" src="../image/themnail/tmn_pro/2.jpg" alt="Card image" width="180px">
								  <div class="card-body">
									<h4 class="card-title">John Doe</h4>
									<p class="card-text">Price : $45.00</p>
									  <input type="number" class="form-control mb-2" value="0">
									<a href="#" class="btn btn-danger">Remove</a>
									  <a href="#" class="btn btn-primary">Add</a>
								  </div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="card" style="width:190px">
								  <img class="card-img-top" src="../image/themnail/tmn_pro/1.jpg" alt="Card image" width="180px">
								  <div class="card-body">
									<h4 class="card-title">John Doe</h4>
									<p class="card-text">Price : $25.00</p>
									 <input type="number" class="form-control mb-2" value="0">
									<a href="#" class="btn btn-danger">Remove</a>
									  <a href="#" class="btn btn-primary">Add</a>
								  </div>
								</div>
							</td>
							<td>
								<div class="card" style="width:190px">
								  <img class="card-img-top" src="../image/themnail/tmn_pro/2.jpg" alt="Card image" width="180px">
								  <div class="card-body">
									<h4 class="card-title">John Doe</h4>
									<p class="card-text">Price : $45.00</p>
									  <input type="number" class="form-control mb-2" value="0">
									<a href="#" class="btn btn-danger">Remove</a>
									  <a href="#" class="btn btn-primary">Add</a>
								  </div>
								</div>
							</td>
							<td>
								<div class="card" style="width:190px">
								  <img class="card-img-top" src="../image/themnail/tmn_pro/2.jpg" alt="Card image" width="180px">
								  <div class="card-body">
									<h4 class="card-title">King dom</h4>
									<p class="card-text">Price : $35.00</p>
									  <input type="number" class="form-control mb-2" value="0">
									<a href="#" class="btn btn-danger">Remove</a>
									  <a href="#" class="btn btn-primary">Add</a>
								  </div>
								</div>
							</td>
							<td>
								<div class="card" style="width:190px">
								  <img class="card-img-top" src="../image/themnail/tmn_pro/2.jpg" alt="Card image" width="180px">
								  <div class="card-body">
									<h4 class="card-title">John Doe</h4>
									<p class="card-text">Price : $45.00</p>
									  <input type="number" class="form-control mb-2" value="0">
									<a href="#" class="btn btn-danger">Remove</a>
									  <a href="#" class="btn btn-primary">Add</a>
								  </div>
								</div>
							</td>
						</tr>
						</tbody>
				</table>
			</div>
			<div class="col-sm w-100">
				<div class="w-100 bg-dark p-3 mt-3 text-white" style="height: 55px">
					<h6><box-icon name='cart-alt' color='white'></box-icon>List Items Add</h6>
				</div>
				<div>
					<table class="table">
								<thead>
								  <tr class="text-center">
									<th>Items</th>
									<th width="5%">Qty</th>
									<th width="5%">Price</th>
									 <th width="5%">Action</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>John</td>
									<td>13</td>
									<td>$45.00</td>
									  <td class="text-center">
									  	<a href="#">
										  <box-icon name='trash' color='red'></box-icon>
										  </a>
									  </td>
								  </tr>
								  <tr>
									<td>John</td>
									<td>13</td>
									<td>$45.00</td>
									  <td class="text-center">
									  	<a href="#">
										  <box-icon name='trash' color='red'></box-icon>
										  </a>
									  </td>
								  </tr>
								  <tr>
									<td>John</td>
									<td>13</td>
									<td>$45.00</td>
									  <td class="text-center">
									  	<a href="#">
										  <box-icon name='trash' color='red'></box-icon>
										  </a>
									  </td>
								  </tr>
								</tbody>
							<tfoot>
								<tr>
									<th colspan="2">
										Total :
									</th>
									<th colspan="2" class="text-center">
										$135.00
									</th>
								</tr>
						</tfoot>
					</table>
				</div>
				<input type="button" class="btn btn-primary w-100" value="Submit">
				<input type="button" class="btn btn-danger w-100 mt-2" value="Cancel">
				<div class="container mt-2">
					<input type="button" class="btn btn-primary" value="Bank" style="width: 45%">
					<input type="button" class="btn btn-success" value="Cash" style="width: 45%">
				</div>
				
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
	<script>
				$(document).ready(function() {
				$('#data').DataTable();
			} );
	</script>
	<script>
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			  return new bootstrap.Tooltip(tooltipTriggerEl)
			})
</script>
</body>
</html>
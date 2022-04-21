<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
date_default_timezone_set("Asia/Phnom_Penh");
if(!isLogin(2))
{
	header("location:../login/login.php?page=login");
	exit();
}
$message =-1;
$messageDialog="";
if(isset($_GET['action']))
{
	$action =$_GET['action'];
	switch($action)
	{
		case '1':
			if(isset($_POST['txt_pid']))
			{
				$id = $_POST['txt_pid'];
				$date = $_POST['txt_date'];
				$qty = $_POST['txt_qty'];
				$desc = $_POST['txt_desc'];
				$user = $_SESSION['userID'];
				$price = $_POST['txt_price'];
				$insersql = "INSERT INTO `tbl_import`(`date`, `pid`,`price`, `qty`, `userid`, `desc`) VALUES ('$date','$id','$price','$qty','$user','$desc')";
				$runsqlinser = mysqli_query($conn,$insersql);
				if($runsqlinser)
				{
					$message =1;
					$messageDialog="Import is Successfully...";
					$updateStock = "UPDATE `tbl_products` SET `pro_stock`='$qty' WHERE `pro_id` = $id";
					mysqli_query($conn,$updateStock);
				}
				else{
					$message =0;
					$messageDialog="Import is not Successfully...";
				}
			}
			break;
		case '2':
			if(isset($_POST['txt_upId']) && isset($_POST['txt_proid']))
			{
				$upbyID = $_POST['txt_upId'];
				$upprobyID = $_POST['txt_proid'];
				$date = $_POST['txt_update'];
				$qty = $_POST['txt_upqty'];
				$desc = $_POST['txt_updesc'];
				$user = $_SESSION['userID'];
				$price = $_POST['txt_upprice'];
				$sql = "UPDATE `tbl_import` SET `date`='$date',`price`='$price',`qty`='$qty',`userid`='$user',`desc`='$desc' WHERE `impID` =$upbyID";
				$runsql = mysqli_query($conn,$sql);
				if($runsql)
				{
					$message =1;
					$messageDialog="Updateed is Successfully...";
					$updateStock = "UPDATE `tbl_products` SET `pro_stock`='$qty' WHERE `pro_id` = $upprobyID";
					mysqli_query($conn,$updateStock);
				}
				else
				{
					$message =0;
					$messageDialog="Updated is not Successfully...";
				}
			}
			break;
		case '3':
			if(isset($_GET['delid']))
			{
				$id = $_GET['delid'];
				$sql = "DELETE FROM `tbl_import` WHERE `impID` = $id";
				$runsql = mysqli_query($conn,$sql);
				if($runsql)
				{
					$message =1;
					$messageDialog="Deleted is Successfully...";
				}
				else
				{
					$message =0;
					$messageDialog="Deleted is not Successfully...";
				}
			}
			break;
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('include/head.php')?>
</head>
<body>
    <?php include('include/navbar.php')?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include('include/sibar.php')?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">Import</h4>
                </div>
              </div>
            </div>
          </div>
			<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Import</h4>
					<?php
					if($message ==1)
					{
				?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Success !</strong> <?=$messageDialog?>
				</div>
				<?php
					}
					elseif($message==0)
					{
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Error !</strong> <?=$messageDialog?>
				</div>
				<?php
					}
				?>
                  <div>
					 <form method="post" enctype="multipart/form-data" action="import.php?page=import&action=1">
					<div class="row">
						<div class="col">
							<label class="form-label">Select Prodcut:</label>
							<select name="txt_pid" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
								<?php
									$j=1;
									$sql = "SELECT * FROM `tbl_products` WHERE `pro_stock` >= 0 && `pro_stock` <=5";
									$runsql = mysqli_query($conn,$sql);
									$num = mysqli_num_rows($runsql);
									if($num > 0)
									{
										echo '<option value="">--Select--</option>';
										while($getPro = mysqli_fetch_array($runsql))
										{
											$id = $getPro['pro_id'];
											$name = $getPro['pro_name'];
											$qty = $getPro['pro_stock'];
											echo "<option value='$id'>$j.$name-($qty)</option>";
											$j++;
										}
										
									}
									else
									{
										echo '<option value="">No Products OutStock</option>';
									}

								?>
							</select>
						</div>
						<div class="col">
							<label class="form-label">Date:</label>
							<input type="date" name="txt_date" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
						</div>
						<div class="col">
							<label class="form-label">Quantity:</label>
							<input type="text" name="txt_qty" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;" placeholder="Enter Quantity">
						</div>
						<div class="col">
							<label class="form-label">Price:</label>
							<input type="text" list="price_list" name="txt_price" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;" placeholder="Enter Price" autocomplete="off">
							<datalist id="price_list">
								<?php
									$getpprice = "SELECT  `pro_price` FROM `tbl_products`;";
									$rungetpprice = mysqli_query($conn,$getpprice);
									while($getrowsprice = mysqli_fetch_array($rungetpprice))
									{
								?>
								<option value="<?=$getrowsprice['pro_price']?>">
								<?php
									}
								?>
							</datalist>
						</div>
					</div>
						<div class="row mt-3">
							<div class="col">
								<label class="form-label">Description:</label>
								<textarea name="txt_desc" rows="5" class="form-control" placeholder="Enter Description" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"></textarea>
							</div>
						</div>
					<div class="mt-3">
						<button type="submit" class="btn btn-primary w-25">Save</button>
						<button type="reset" class="btn btn-dark w-25">Clear</button>
					</div>
				</form>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Import</h4>
                  <div class="table-responsive">
					  <table class="table-hover table-primary" id="list">
						<thead class="text-center">
							<th>Products Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
							<th>Date</th>
							<th>Description</th>
							<th>User</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php

								$sqlgetrow = 'SELECT tbl_import.impID as "impID",tbl_import.date As "date",tbl_products.pro_name as "pname",tbl_products.pro_id as "pid",tbl_import.price as "price",tbl_import.qty as "qty",tbl_import.price*tbl_import.qty as "total",tbl_user.fistName AS "userfname",tbl_user.lastName as "userlname",tbl_import.desc As "desc"
								FROM tbl_import
								INNER JOIN tbl_products ON tbl_import.pid = tbl_products.pro_id
								INNER JOIN tbl_user ON tbl_import.userid = tbl_user.id;';
								$runsqlgetrow = mysqli_query($conn,$sqlgetrow);
								while($getrows = mysqli_fetch_array($runsqlgetrow))
								{
							?>
							<tr>

								<td><?=$getrows['pname']?></td>
								<td>$<?=$getrows['price']?></td>
								<td class="text-center"><?=$getrows['qty']?></td>
								<td class="text-center">$<?= number_format($getrows['total'],2)?></td>
								<td class="text-center">
									<?php
										$date = date_create($getrows['date']);
										echo date_format($date,'d-M-Y');
									?>
								</td>
								<td><?=$getrows['desc']?></td>
								<td class="text-center"><?=$getrows['userfname'].' '.$getrows['userlname']?></td>
								<td class="text-center">
									<a href="#">
										<box-icon name='edit-alt' data-toggle="modal" data-target="#editModalCenter<?=$getrows['impID']?>"></box-icon>
									</a>
									<a href="#">
										<box-icon name='trash' data-toggle="modal" data-target="#deleteModalCenter<?=$getrows['impID']?>"></box-icon>
									</a>
								</td>
							</tr>
<!-- Delete Modal -->
<div class="modal fade" id="deleteModalCenter<?=$getrows['impID']?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenter<?=$getrows['impID']?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content alert-warning">
      <div class="modal-header">
        <h3 class="modal-title" id="deleteModalCenter<?=$getrows['impID']?>">Your Message</h3>
      </div>
      <div class="modal-body">
	Are you sure to dalete this record ?
      </div>
      <div class="modal-footer">
		  <a href="import.php?page=import&action=3&delid=<?=$getrows['impID']?>" class="btn btn-primary w-25">Yes</a>
			<button type="button" class="btn btn-secondary w-25" data-dismiss="modal">No</button>
		  </div>  
    </div>
  </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModalCenter<?=$getrows['impID']?>" tabindex="-1" role="dialog" aria-labelledby="editModalCenter<?=$getrows['impID']?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content alert-warning">
      <div class="modal-header">
        <h3 class="modal-title" id="editModalCenter<?=$getrows['impID']?>">UPDATE IMPORT</h3>
      </div>
      <div class="modal-body">
		<form method="post" enctype="multipart/form-data" action="import.php?page=import&action=2">
			<input type="hidden" value="<?=$getrows['impID']?>" name="txt_upId">
			<input type="hidden" value="<?=$getrows['pid']?>" name="txt_proid">
				<div class="row">
						<div class="col">
							<label class="form-label">Date:</label>
							<input type="date" value="<?=$getrows['date']?>" name="txt_update" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
						</div>
						<div class="col">
							<label class="form-label">Quantity:</label>
							<input type="text" name="txt_upqty" value="<?=$getrows['qty']?>" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;" placeholder="Enter Quantity">
						</div>
					<div class="col">
							<label class="form-label">Price:</label>
							<input type="text" name="txt_upprice" value="<?=$getrows['price']?>" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;" placeholder="Enter Price">
						</div>
					</div>
						<div class="row mt-3">
							<div class="col">
								<label class="form-label">Description:</label>
								<textarea name="txt_updesc" rows="5" class="form-control" placeholder="Enter Description" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"><?=$getrows['desc']?></textarea>
							</div>
						</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-success w-25">Update</button>
			<button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
		  </div>  
		</form>
      </div>
      
    </div>
  </div>
</div>
						<?php
								}
							?>
						</tbody>
					</table>
				</div>
                </div>
              </div>
            </div>
					  
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <?php include('include/footer.php')?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
	$(document).ready( function () {
    $('#list').DataTable();
} );
</script>
</script>
	<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "import.php?page=import");  
    }
</script>
</script>
</body>

</html>


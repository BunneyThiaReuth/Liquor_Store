<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
if(!isLogin(2))
{
	header("location:../login/login.php?page=login");
	exit();
}
date_default_timezone_set("Asia/Phnom_Penh");
$sqlgetdate = "SELECT SUBSTRING(date, 6, 2) as 'Month',MONTHNAME(STR_TO_DATE(SUBSTRING(date, 6, 2), '%m')) as 'Monthname' FROM `tbl_import` GROUP BY `Month`";
$runsqlgetdate = mysqli_query($conn,$sqlgetdate);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('include/head.php')?>

</head>
<body>
<?php
	if(isset($_GET['action']) && $_GET['action']==1)
	{
		$date = $_POST['txt_month'];
?>
	<div class="container mt-4">
		<div class="row">
				<div class="col-md-6 col-sm-6 text-left">
						<h4><strong>Import</strong> List</h4>
						<ul class="list-unstyled">
							<li><strong>First Name:</strong> <?=$_SESSION['fistName']?></li>
							<li><strong>Last Name:</strong> <?=$_SESSION['lastName']?></li>
							<li><strong>Email:</strong> <?=$_SESSION['mail']?></li>
							<?php
								if($date != "All")
								{
							?>
							<li><strong>Month:</strong>
								<?php
									$monthNum  = $date;
									$dateObj   = DateTime::createFromFormat('!m', $monthNum);
									$monthName = $dateObj->format('F');
									echo($monthName);
								?>
							</li>
							<?php
								}
							?>
						</ul>
					</div>
					<?php
						
						if($date == "All")
						{
							$sumimp = "SELECT SUM(price*qty) as 'sum' FROM `tbl_import`;";
						}
						else
						{
							
							$sumimp = "SELECT SUM(price*qty) as 'sum' FROM `tbl_import` WHERE date LIKE '%$date%';";
						}
						$runsumimp = mysqli_query($conn,$sumimp );
						$getsum =mysqli_fetch_array($runsumimp);
					?>
					<div class="col-md-6 col-sm-6 text-right">
						<h4><strong>Amount</strong></h4>
						<ul class="list-unstyled">
						<li><strong>Total:</strong>$<?= number_format($getsum['sum'],2)?></li>
						</ul>

					</div>

				</div>
		<div class="mt-5">
			<table class="table">
				<thead class="text-center">
					<th>No</th>
					<th>Products Name</th>
					<th>Price</th>
					<th>QTY</th>
					<th>Total</th>
					<th>Date</th>
					<th>User</th>
				</thead>
				<tbody>
					<?php
						$j=1;
						if($date != "All")
						{
						$prinimp = "SELECT tbl_import.impID as 'impID',tbl_import.date As 'date',tbl_products.pro_name as 'pname',tbl_products.pro_id as 'pid',tbl_import.price as 'price',tbl_import.qty as 'qty',tbl_import.price*tbl_import.qty as 'total',tbl_user.fistName AS 'userfname',tbl_user.lastName as 'userlname',tbl_import.desc As 'desc'
						FROM tbl_import
						INNER JOIN tbl_products ON tbl_import.pid = tbl_products.pro_id
						INNER JOIN tbl_user ON tbl_import.userid = tbl_user.id
						WHERE tbl_import.date LIKE '%$date%';";
						}
						else{
							$prinimp = "SELECT tbl_import.impID as 'impID',tbl_import.date As 'date',tbl_products.pro_name as 'pname',tbl_products.pro_id as 'pid',tbl_import.price as 'price',tbl_import.qty as 'qty',tbl_import.price*tbl_import.qty as 'total',tbl_user.fistName AS 'userfname',tbl_user.lastName as 'userlname',tbl_import.desc As 'desc'
							FROM tbl_import
							INNER JOIN tbl_products ON tbl_import.pid = tbl_products.pro_id
							INNER JOIN tbl_user ON tbl_import.userid = tbl_user.id;";
						}
						
						$runsprinimp = mysqli_query($conn,$prinimp);
						
						while($imp = mysqli_fetch_array($runsprinimp))
						{
					?>
					<tr>
						<td class="text-center"><?=$j?></td>
						<td ><?=$imp['pname']?></td>
						<td ><?=$imp['price']?></td>
						<td ><?=$imp['qty']?></td>
						<td ><?=$imp['total']?></td>
						<td ><?=$imp['date']?></td>
						<td ><?=$imp['userfname'].$imp['userlname']?></td>
					</tr>
					<?php
							$j++;
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="mt-2">
			<button type="button" onClick="window.print();" class="btn btn-success">Print</button>
			<a href="importreport.php?page=importreport" class="btn btn-dark">Back</a>
		</div>
	</div>
<?php
	}
	else
	{
?>
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
                  <h4 class="font-weight-bold mb-0">Report</h4>
                </div>
              </div>
            </div>
          </div>

			<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Import</h4>
                  <div class="table-responsive">
					 <!-- Button trigger modal -->
					<button type="button" class="btn btn-primary mb-2 float-end" data-toggle="modal" data-target="#print">
					  Print
					</button>

					<!-- Modal -->
					<div class="modal fade" id="print" tabindex="-1" role="dialog" aria-labelledby="print" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h5 class="modal-title" id="print">Print</h5>
						  </div>
						  <div class="modal-body">
							<form method="post" enctype="multipart/form-data" action="importreport.php?page=importreport&action=1">
								<label class="form-label">Select Month  :</label>
								<select class="form-control" name="txt_month" required>
									<option value="">--Select--</option>
									<option value="All">All</option>
									<?php
										
										while($dateerows = mysqli_fetch_array($runsqlgetdate))
										{
									?>
										<option value="<?=$dateerows['Month']?>">
											<?php
												echo $dateerows['Monthname'];
											?>
										</option>
									<?php
										}
									?>
								</select>
								 <div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Comfirm</button>
								  </div>
							</form>
						  </div>
						 
						</div>
					  </div>
					</div>
					<table id="list">
							<thead class="text-center">
								<th>Products Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>Date</th>
								<th>Description</th>
								<th>User</th>
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
								</tr>
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
      </div>
    </div>
<?php
	}
?>
  </div>
  <?php include('include/footer.php')?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
	$(document).ready( function () {
    $('#list').DataTable();
} );
</script>
<script>
	$(document).ready( function () {
    $('#list1').DataTable();
} );
</script>
	<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "importreport.php?page=importreport");  
    }
</script>
</body>

</html>


<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
date_default_timezone_set("Asia/Phnom_Penh");
if(!isLogin(2))
{
	header("location:../login/login.php?page=login");
	exit();
}
	$sumtotalinvocice ="SELECT sum(tbl_invoicedetail.amount) as 'total'
						FROM `tbl_invoice`
						INNER JOIN tbl_invoicedetail ON tbl_invoice.invNumber = tbl_invoicedetail.invNumber
						WHERE tbl_invoice.status =1;";
	$runsumtotalinvocice = mysqli_query($conn,$sumtotalinvocice);
	$totalrow = mysqli_fetch_array($runsumtotalinvocice);

	$countuser = "SELECT COUNT(`id`) as 'countuser' FROM `tbl_user`;";
	$runcountuser= mysqli_query($conn,$countuser);
	$countrow = mysqli_fetch_array($runcountuser);

	$countINV = "SELECT COUNT(`invNumber`) as 'countINV' FROM `tbl_invoice`;";
	$runcountINV = mysqli_query($conn,$countINV);
	$countINVrow = mysqli_fetch_array($runcountINV);
	
	$checkINV = "SELECT COUNT(`invNumber`) as 'checkINV' FROM `tbl_invoice` WHERE `status` =0;";
	$runcheckINV = mysqli_query($conn,$checkINV);
	$checkINVrow = mysqli_fetch_array($runcheckINV);
	
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
                  <h4 class="font-weight-bold mb-0">Liquor Store Dashboard</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Sales</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">$<?=number_format($totalrow['total'],2)?></h3>
                    <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-danger"><?php $n=$totalrow['total']/100;echo(number_format($n,2)); ?>%</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Users</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?=$countrow['countuser']?></h3>
                    <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-danger"><?=$countrow['countuser']/100?>%</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Invoice</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?=$countINVrow['countINV']?></h3>
                    <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-success">64.00%<span class="text-black ms-1"><small>(30 days)</small></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Unavailable</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?=$checkINVrow['checkINV']?></h3>
                    <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-success"><?=$checkINVrow['checkINV']/100?>%<span class="text-black ms-1"><small>Invoice</small></span></p>
                </div>
              </div>
            </div>
          </div>
			<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Invoice Detail</h4>
                  <div class="table-responsive">
					  
                    <table id="list" class="table table-bordered">
                      <thead>
							<th>#</th>
                          	<th>Invoice</th>
							<th>Prodcuts</th>
							<th>Price</th>
							<th>QTY</th>
							<th>Amount</th>
                      </thead>
                      <tbody>
						  <?php
							$i=1;
							$sqlinvoicDetail = 'SELECT tbl_invoicedetail.invNumber AS "invNumber",tbl_products.pro_name AS "proname", tbl_invoicedetail.price AS "price", tbl_invoicedetail.qty AS "qty", tbl_invoicedetail.amount AS "amount"
							FROM `tbl_invoicedetail`
							INNER JOIN `tbl_products` ON tbl_invoicedetail.proID = tbl_products.pro_id';

							$runsqlinvoicDetail = mysqli_query($conn,$sqlinvoicDetail);
							while($getrowsIVNDetail = mysqli_fetch_array($runsqlinvoicDetail))
							{
						?>
                        <tr>
							<td><?=$i?></$i?></td>
							<td>#<?=$getrowsIVNDetail['invNumber']?></td>
							<td><?=$getrowsIVNDetail['proname']?></td>
							<td>$<?= number_format($getrowsIVNDetail['price'],2) ?></td>
							<td><?=$getrowsIVNDetail['qty']?></td>
							<td>$<?=$getrowsIVNDetail['amount']?></td>
						</tr>
						 <?php
							$i++;
							}
							?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Invoice</h4>
                  <div class="table-responsive">
                    <table id="list1" class="table table-bordered">
                      <thead class="text-center">
							<th>#Ref.no</th>
							<th>Date</th>
							<th>Total</th>
							<th>Status</th>
							<th>Note</th>
                      </thead>
                      <tbody>
						  <?php
							$sqlgetinv = 'SELECT tbl_invoice.invID AS "invID", tbl_invoice.invNumber AS "invNum", tbl_invoice.Date AS "date", sum(tbl_invoicedetail.amount) as "total",tbl_invoice.status AS "status",tbl_invoice.not AS "not"
							FROM tbl_invoice
							INNER JOIN tbl_invoicedetail ON tbl_invoice.invNumber = tbl_invoicedetail.invNumber
							GROUP BY tbl_invoice.invNumber;';
							 $runsqlgetinv = mysqli_query($conn,$sqlgetinv);
							 while($getinv = mysqli_fetch_array($runsqlgetinv))
							 {
						?>
                        <tr>
							<td>#<?=$getinv['invNum']?></td>
							<td><?=$getinv['date']?></td>
							<td>$<?=number_format($getinv['total'],2)?></td>
							<td class="text-center">
								<?php
									if($getinv['status']==0)
									{

										echo "<box-icon type='solid' name='checkbox-minus'></box-icon>";
									}
								 else{
									 echo "<box-icon type='solid' name='checkbox-checked'></box-icon>";
								 }
								?>
							</td>
							<td>
								<?=$getinv['not']?>
							</td>
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
<script>
	$(document).ready( function () {
    $('#list1').DataTable();
} );
</script>
</body>

</html>


<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
if(!isLogin(2))
{
	header("location:../login/login.php?page=login");
	exit();
}
date_default_timezone_set("Asia/Phnom_Penh");
if(isset($_GET['action']))
{
	$action =$_GET['action'];
	switch($action){
		case '1':
			if(isset($_GET['inv']))
			{
				$inv = $_GET['inv'];
				$not = $_GET['not'];
				$sql = "SELECT tbl_invoicedetail.invNumber AS 'invNumber',tbl_products.pro_name AS 'proname', tbl_invoicedetail.price AS 'price', tbl_invoicedetail.qty AS 'qty', tbl_invoicedetail.amount AS 'amount'
				FROM `tbl_invoicedetail` INNER JOIN `tbl_products` ON tbl_invoicedetail.proID = tbl_products.pro_id WHERE invNumber = $inv GROUP BY tbl_invoicedetail.proID;";
				$runsql = mysqli_query($conn,$sql);
				$findtotal ="SELECT sum(`amount`) as 'grantotal',SUM(`price`*`qty`) as 'subtotal' FROM `tbl_invoicedetail` WHERE invNumber = $inv;";
				$runfindtotal = mysqli_query($conn,$findtotal);
				$get = mysqli_fetch_array($runfindtotal);
			}
			break;
		case '2':
			if(isset($_POST['txt_invNumber']))
			{
				$inv = $_POST['txt_invNumber'];
				$sql = "UPDATE `tbl_invoice` SET `status`='1' WHERE `invNumber` = $inv";
				mysqli_query($conn,$sql);
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
<?php
	if(isset($_GET['action']) && $_GET['action']==1)
	{
?>
	<div class="mt-5">
		<div class="container bootstrap snippets bootdey">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6 col-sm-6 text-left">
						<h4><strong>Client</strong> Details</h4>
						<ul class="list-unstyled">
							<li><strong>First Name:</strong> <?=$_SESSION['fistName']?></li>
							<li><strong>Last Name:</strong> <?=$_SESSION['lastName']?></li>
							<li><strong>Email:</strong> <?=$_SESSION['mail']?></li>
						</ul>
					</div>

					<div class="col-md-6 col-sm-6 text-right">
						<h4><strong>Payment</strong> Details</h4>
						<ul class="list-unstyled">
							<li><strong>Invoice Number:</strong> #<?=$inv?></li>
						</ul>

					</div>

				</div>

				<div class="table-responsive">
					<table class="table table-condensed nomargin">
						<thead>
							<tr>
								<th>Item Name</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Total Price</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while($rows=mysqli_fetch_array($runsql))
							{
						?>
							<tr>
								<td><?=$rows['proname']?></td>
								<td><?=$rows['qty']?></td>
								<td>$<?=$rows['price']?></td>
								<td>$<?=$rows['amount']?></td>
							</tr>
						<?php
							}
	 					?>
						</tbody>
					</table>
				</div>

				<hr class="nomargin-top">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h4><strong>Contact</strong> Details</h4>
						<p class="nomargin nopadding">
							<strong>Note:</strong> 
							<?=$not?>
						</p><br><!-- no P margin for printing - use <br> instead -->

						<address>
							Liquor Store <br>
							207 st2011 Phnom Penh<br>
							Phone: +855 88-4151-542 <br>
							Email: bunneythiareuth@gmail.com
						</address>
					</div>
					<div class="col-sm-6 text-right">
						<ul class="list-unstyled">
							<li><strong>Sub - Total Amount:</strong> $<?=number_format($get['subtotal'],2)?></li>
							<li><strong>Grand Total:</strong> $<?= number_format($get['grantotal'],2)?></li>
						</ul>     
						
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default text-right">
			<div class="panel-body">
			<form enctype="multipart/form-data" method="post" action="INVreport.php?page=InvoiceReport&action=2">
				<a class="btn btn-dark" href="INVreport.php?page=InvoiceReport"><i class="fa fa-check"></i>Back</a>
				
					<input type="hidden" value="<?=$_GET['inv']?>" name="txt_invNumber">
					<button type="submit" class="btn btn-primary">Save</button>
				
				<button type="button" onClick="window.print();" class="btn btn-success">
					<i class="fa fa-print"></i> PRINT
				</button>
			</form>
			</div>
		</div>
	</div>
	</div>


<?php
	}
	else{
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
                  <h4 class="card-title">Invoice</h4>
                  <div class="table-responsive">
                    <table id="list1" class="table table-bordered">
                      <thead class="text-center">
							<th>#Ref.no</th>
							<th>Date</th>
							<th>Total</th>
							<th>Status</th>
							<th>Note</th>
							<th>Action</th>
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
							<td class="text-center">
								<a href="INVreport.php?page=InvoiceReport&action=1&inv=<?=$getinv['invNum']?>&not=<?=$getinv['not']?>">
									<box-icon name='printer'></box-icon>
								</a>
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
</body>

</html>


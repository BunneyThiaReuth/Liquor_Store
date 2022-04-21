<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
if(!isLogin(1))
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
	<style>
		body{margin-top:20px;
background:#eee;
}




/**    17. Panel
 *************************************************** **/
/* pannel */
.panel {
	position:relative;

	background:transparent;

	-webkit-border-radius: 0;
	   -moz-border-radius: 0;
			border-radius: 0;

	-webkit-box-shadow: none;
	   -moz-box-shadow: none;
			box-shadow: none;
}
.panel.fullscreen .accordion .panel-body,
.panel.fullscreen .panel-group .panel-body {
	position:relative !important;
	top:auto !important;
	left:auto !important;
	right:auto !important;
	bottom:auto !important;
}
	
.panel.fullscreen .panel-footer {
	position:absolute;
	bottom:0;
	left:0;
	right:0;
}


.panel>.panel-heading {
	text-transform: uppercase;

	-webkit-border-radius: 0;
	   -moz-border-radius: 0;
			border-radius: 0;
}
.panel>.panel-heading small {
	text-transform:none;
}
.panel>.panel-heading strong {
	font-family:Arial,Helvetica,Sans-Serif;
}
.panel>.panel-heading .buttons {
	display:inline-block;
	margin-top:-3px;
	margin-right:-8px;
}
.panel-default>.panel-heading {
	padding: 15px 15px;
	background:#fff;
}
.panel-default>.panel-heading small {
	color:#9E9E9E;
	font-size:12px;
	font-weight:300;
}
.panel-clean {
	border: 1px solid #ddd;
	border-bottom: 3px solid #ddd;

	-webkit-border-radius: 0;
	   -moz-border-radius: 0;
			border-radius: 0;
}
.panel-clean>.panel-heading {
	padding: 11px 15px;
	background:#fff !important;
	color:#000;	
	border-bottom: #eee 1px solid;
}
.panel>.panel-heading .btn {
	margin-bottom: 0 !important;
}

.panel>.panel-heading .progress {
	background-color:#ddd;
}

.panel>.panel-heading .pagination {
	margin:-5px;
}

.panel-default {
	border:0;
}

.panel-light {
	border:rgba(0,0,0,0.1) 1px solid;
}
.panel-light>.panel-heading {
	padding: 11px 15px;
	background:transaprent;
	border-bottom:rgba(0,0,0,0.1) 1px solid;
}

.panel-heading a.opt>.fa {
    display: inline-block;
    font-size: 14px;
    font-style: normal;
    font-weight: normal;
    margin-right: 2px;
    padding: 5px;
    position: relative;
    text-align: right;
    top: -1px;
}

.panel-heading>label>.form-control {
	display:inline-block;
	margin-top:-8px;
	margin-right:0;
	height:30px;
	padding:0 15px;
}
.panel-heading ul.options>li>a {
	color:#999;
}
.panel-heading ul.options>li>a:hover {
	color:#333;
}
.panel-title a {
	text-decoration:none;
	display:block;
	color:#333;
}

.panel-body {
	background-color:#fff;
	padding: 15px;

	-webkit-border-radius: 0;
	   -moz-border-radius: 0;
			border-radius: 0;
}
.panel-body.panel-row {
	padding:8px;
}

.panel-footer {
	font-size:12px;
	border-top:rgba(0,0,0,0.02) 1px solid;
	background-color:rgba(0255,255,255,1);

	-webkit-border-radius: 0;
	   -moz-border-radius: 0;
			border-radius: 0;
}
	</style>
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
			<form enctype="multipart/form-data" method="post" action="listINV.php?page=invoice&action=2">
				<a class="btn btn-dark" href="listINV.php?page=invoice"><i class="fa fa-check"></i>Back</a>
				
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
	<?php include('include/nav.php')?>
	<div class="container-fluid" style="margin-top:60px">
		<div class="mt-5">
			<a href="index.php" class="btn btn-dark mt-3">Back</a>
		<h4 class="mt-2 text-center">#Invoice</h4>
		<table id="inv" class="table table-hover" style="width: 100%">
			<thead class="bg-primary text-white">
				<th class="text-center">#Ref.no</th>
				<th class="text-center">Date</th>
				<th class="text-center">Total</th>
				<th class="text-center">Status</th>
				<th class="text-center">Note</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody class="table-primary">
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
						<a href="listINV.php?page=invoice&action=1&inv=<?=$getinv['invNum']?>&not=<?=$getinv['not']?>">
							<box-icon name='printer' ></box-icon>
						</a>
					</td>
				</tr>
			<?php
					 }
				?>
			</tbody>
		</table>
	</div>
		<div class="mt-4">
		<h4 class="text-center">#Invoice Detail</h4>
		<table id="invDetail" class="table table-hover" style="width: 100%">
			<thead class="text-center bg-success text-white">
				<th>Invoice</th>
				<th>Prodcuts</th>
				<th>Price</th>
				<th>QTY</th>
				<th>Amount</th>
			</thead>
			<tbody class="table-success">
				<?php
					$sqlinvoicDetail = 'SELECT tbl_invoicedetail.invNumber AS "invNumber",tbl_products.pro_name AS "proname", tbl_invoicedetail.price AS "price", tbl_invoicedetail.qty AS "qty", tbl_invoicedetail.amount AS "amount"
					FROM `tbl_invoicedetail`
					INNER JOIN `tbl_products` ON tbl_invoicedetail.proID = tbl_products.pro_id';
				
					$runsqlinvoicDetail = mysqli_query($conn,$sqlinvoicDetail);
					while($getrowsIVNDetail = mysqli_fetch_array($runsqlinvoicDetail))
					{
				?>
				<tr>
					<td>#<?=$getrowsIVNDetail['invNumber']?></td>
					<td><?=$getrowsIVNDetail['proname']?></td>
					<td>$<?= number_format($getrowsIVNDetail['price'],2) ?></td>
					<td><?=$getrowsIVNDetail['qty']?></td>
					<td>$<?=$getrowsIVNDetail['amount']?></td>
				</tr>
			<?php
					}
				?>
			</tbody>
		</table>
	</div>
	</div>
<?php
		}
?>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"> 
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
	<script>
$(document).ready(function() {
    $('#inv').DataTable();
} );
</script>
<script>
$(document).ready(function() {
    $('#invDetail').DataTable();
} );
</script>
</body>
</html>
<?php mysqli_close($conn)?>
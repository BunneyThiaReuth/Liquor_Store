<?php
	include('libaries/auth.php');
    include('database/db_connection.php');
    if(!isLogin(3))
    {
        header("location:login/login.php?page=login");
        exit();
    }
date_default_timezone_set("Asia/Phnom_Penh");
$t=strtotime("now");
$message=-1;
$messageDialog="";
if(isset($_GET['action']))
{
	$action = $_GET['action'];
	switch($action)
	{
		case '1':
			if(isset($_GET['invID']))
			{
				$invID= $_GET['invID'];
				$sql ="DELETE FROM `tbl_invoice` WHERE `invNumber`=$invID";
				$runsql = mysqli_query($conn,$sql);
				if($runsql)
				{
					$message=1;
					$messageDialog="Invoice deleted is successfully";
				}
				else
				{
					$message=0;
					$messageDialog="Invoice deleted is not successfully !";
				}
			}
			break;
		case '2':
			$date = date("Y-m-d");
			$invNumber = $t;
			$user = $_SESSION['userID'];
			$not = $_POST['txt_not'];
			$sql = "INSERT INTO `tbl_invoice`(`invNumber`, `Date`, `userID`, `status`, `not`) VALUES ('$invNumber','$date','$user','0','$not')";
			$runsql = mysqli_query($conn,$sql);
			if($runsql){
				$message=1;
				$messageDialog="Invoice created is successfully";
			}
			else
			{
				$message =0;
				$messageDialog = "Invoice created is not successfully...";
			}
			break;
	}
	
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <?php
        include 'include/head.php';
    ?>
</head>
<body>

    <?php
        include 'include/pageLorder.php';
    ?>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php
            include 'include/navbar.php';
            include 'include/sidebar.php';
        ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Invoice</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="invoice.php?page=invoice">Invoice</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
			<?php
				if($message==1)
				{
			?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Success !</strong> <?=$messageDialog?>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php
				}
				elseif($message==1)
				{
			?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>Success !</strong> <?=$messageDialog?>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php
				}
				?>
			<div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createINVModalCenter">
  Create Invoice
</button>

<!-- Modal -->
<div class="modal fade" id="createINVModalCenter" tabindex="-1" role="dialog" aria-labelledby="createINVModalCenter" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createINVModalCenter">CREATE INVOICE</h5>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="invoice.php?page=invoice&action=2">
			<label class="form-lable">Date :</label>
			<input type="text" class="form-control" value="<?=date("Y-m-d")?>" name="txt_date" disabled>
			<label class="form-lable mt-2">User :</label>
			<input type="text" class="form-control" value="<?=$_SESSION['username']?>" name="txt_user" disabled>
			<label class="form-lable mt-2">Invoice Number # :</label>
			<input type="text" class="form-control" value="#<?=$t?>" name="txt_inv" disabled>
			<label class="form-lable mt-2">Note :</label>
			<input type="text" class="form-control" name="txt_not" required>
			<div class="modal-footer">
				<button type="submut" class="btn btn-primary w-25">Save</button>
				<button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
		  </div>
		</form>
      </div>
    </div>
  </div>
</div>
			</div>

			<div class="mt-3">
				
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
							<a href="#">
								<box-icon name='trash' data-toggle="modal" data-target="#Modal<?=$getinv['invNum']?>"></box-icon>
							</a>
						</td>
					</tr>
					<!-- Modal -->
					<div class="modal fade" id="Modal<?=$getinv['invNum']?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?=$getinv['invNum']?>" aria-hidden="true">
					  <div class="modal-dialog alert-warning" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h3 class="modal-title" id="Modal<?=$getinv['invNum']?>">Your Message</h3>
						  </div>
						  <div class="modal-body">
							Are you sure to delete this record ?
						  </div>
						  <div class="modal-footer">
							 <a href="invoice.php?page=invoice&action=1&invID=<?=$getinv['invNum']?>" class="btn btn-primary w-25">Yes</a>
							<button type="button" class="btn btn-secondary w-25" data-dismiss="modal">No</button>
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

            <footer class="footer text-center text-muted">
                All Rights Reserved by Bunney ThiaReuth.
            </footer>
        </div>

    </div>
<?php
include 'include/scriptFooter.php';
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
	$(document).ready( function () {
    $('#inv').DataTable();
} );
</script>
</body>

</html>
<?php mysqli_close($conn)?>
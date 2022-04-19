<?php
	include('libaries/auth.php');
    include('database/db_connection.php');
    if(!isLogin(3))
    {
        header("location:login/login.php?page=login");
        exit();
    }
$message=-1;
$messageDialog="";
if(isset($_GET['action']))
{
	$action =$_GET['action'];
	switch($action)
	{
		case '1':
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$sql = "DELETE FROM `tbl_invoicedetail` WHERE `invDetailID`=$id";
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Invoice Detail</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="invdetail.php?page=invdetail">Invoice Detail</a>
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
				<table id="invDetail" class="table table-hover" style="width: 100%">
			<thead class="text-center bg-success text-white">
				<th>Ivoice</th>
				<th>Prodcuts</th>
				<th>Price</th>
				<th>QTY</th>
				<th>Amount</th>
				<th>Action</th>
			</thead>
			<tbody class="table-success">
				<?php
					$sqlinvoicDetail = 'SELECT tbl_invoicedetail.invDetailID as "id",tbl_invoicedetail.invNumber AS "invNumber",tbl_products.pro_name AS "proname", tbl_invoicedetail.price AS "price", tbl_invoicedetail.qty AS "qty", tbl_invoicedetail.amount AS "amount"
					FROM `tbl_invoicedetail`
					INNER JOIN `tbl_products` ON tbl_invoicedetail.proID = tbl_products.pro_id';
				
					$runsqlinvoicDetail = mysqli_query($conn,$sqlinvoicDetail);
					while($getrowsIVNDetail = mysqli_fetch_array($runsqlinvoicDetail))
					{
				?>
				<tr>
					<td>#<?=$getrowsIVNDetail['invNumber']?></td>
					<td><?=$getrowsIVNDetail['proname']?></td>
					<td class="text-center">$<?= number_format($getrowsIVNDetail['price'],2) ?></td>
					<td class="text-center"><?=$getrowsIVNDetail['qty']?></td>
					<td class="text-center">$<?=$getrowsIVNDetail['amount']?></td>
					<td class="text-center">
						<a href="#">
							<box-icon name='trash' data-toggle="modal" data-target="#Modal<?=$getrowsIVNDetail['id']?>"></box-icon>
						</a>
					</td>
				</tr>
<!-- Modal -->
<div class="modal fade" id="Modal<?=$getrowsIVNDetail['id']?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?=$getrowsIVNDetail['id']?>" aria-hidden="true">
  <div class="modal-dialog alert-warning" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="Modal<?=$getrowsIVNDetail['id']?>">Your Message</h3>
      </div>
      <div class="modal-body">
        Are your sure to delete this record ?
      </div>
      <div class="modal-footer">
		<a href="invdetail.php?page=invdetail&action=1&id=<?=$getrowsIVNDetail['id']?>" class="btn btn-primary w-25">Yes</a>
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
    $('#invDetail').DataTable();
} );
</script>
</body>

</html>
<?php mysqli_close($conn)?>
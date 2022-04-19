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
	$action = $_GET['action'];
	switch($action)
	{
		case '1':
			if(isset($_GET['invNum']))
			{
				$invNum = $_GET['invNum'];
				$sql = "DELETE FROM `tbl_invoice` WHERE `invNumber` = $invNum";
				$runsql = mysqli_query($conn,$sql);
				if($runsql)
				{
					$message=1;
					$messageDialog="Invoice deleted is successfully";
				}
				else
				{
					$message=0;
					$messageDialog="Invoice deleted is not successfully";
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Invoice Unavailable</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="InvoiceUnavailable.php?page=InvoiceUnavailable">Invoice Unavailable</a>
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
				<table id="Invunavlible" class="table table-hover" style="width: 100%">
				<thead class="bg-primary text-white">
					<th class="text-center">#Ref.no</th>
					<th class="text-center">Date</th>
					<th class="text-center">User</th>
					<th class="text-center">Status</th>
					<th class="text-center">Note</th>
					<th class="text-center">Action</th>
				</thead>
				<tbody class="table-primary">
					<?php
						$sqlgetinv = "SELECT tbl_invoice.invID as 'invID', tbl_invoice.invNumber as 'invNumber', tbl_invoice.Date 'Date', tbl_user.fistName as 'fname',tbl_user.lastName as 'lname', tbl_invoice.status as 'status', tbl_invoice.not as 'not' 
						FROM `tbl_invoice`
						INNER JOIN tbl_user ON tbl_invoice.userID = tbl_user.id
						WHERE tbl_invoice.status =0";
						 $runsqlgetinv = mysqli_query($conn,$sqlgetinv);
						 while($getinv = mysqli_fetch_array($runsqlgetinv))
						 {
					?>
					<tr>
						<td>#<?=$getinv['invNumber']?></td>
						<td><?=$getinv['Date']?></td>
						<td><?=$getinv['fname']." ".$getinv['lname']?></td>
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
								<box-icon name='trash' data-toggle="modal" data-target="#Modal<?=$getinv['invNumber']?>"></box-icon>
							</a>
						</td>
					</tr>
<!-- Modal -->
<div class="modal fade" id="Modal<?=$getinv['invNumber']?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?=$getinv['invNumber']?>" aria-hidden="true">
  <div class="modal-dialog alert-warning" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="Modal<?=$getinv['invNumber']?>">Your Message</h3>
      </div>
      <div class="modal-body">
        Are you sure to delete this record ?
      </div>
      <div class="modal-footer">
		<a href="InvoiceUnavailable.php?page=InvoiceUnavailable&action=1&invNum=<?=$getinv['invNumber']?>" class="btn btn-primary w-25">Yes</a>
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
    $('#Invunavlible').DataTable();
} );
</script>
</body>

</html>
<?php mysqli_close($conn)?>
<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
date_default_timezone_set("Asia/Phnom_Penh");
if(!isLogin(2))
{
	header("location:../login/login.php?page=login");
	exit();
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
	<div class="container-fluid mt-4">
	<div class="float-start">
		<h5>List Products</h5>
		<p>Date : <?=" ".date("d-M-Y")?></p>
	</div>
	<div class="float-end">
		<h5><strong>Liquor</strong> Stores</h5>
		<p>Mail : <?=$_SESSION['mail']?></p>
		<p>User : <?=$_SESSION['username']?></p>
	</div>
		<table class="table">
			<thead>
				<th>#ID</th>
				<th>Image</th>
				<th>Name</th>
				<th>Category</th>
				<th>Stock</th>
				<th>Price</th>
				<th>Discount</th>
				<th>Total</th>
				<th>Date</th>
				<th>User</th>
			</thead>
			<tbody>
				<?php
					if(isset($_POST['txt_cate']))
					{
						$cateid = $_POST['txt_cate'];
						if($cateid !="All")
						{
							$datasql = "SELECT tbl_products.pro_id AS 'pid', tbl_products.pro_image AS 'pimg', tbl_products.pro_name AS 'pnmae', tbl_category.name AS 'cateName', tbl_products.pro_stock AS 'pstock', tbl_products.pro_price AS 'pprice',tbl_discount.discountPerent AS 'pdisc',tbl_products.pro_price-(tbl_products.pro_price*tbl_discount.discountPerent/100) AS 'TotalDisc', tbl_products.pro_date AS 'pdate', tbl_products.pro_description As 'pdesc', tbl_user.fistName As 'ufname',tbl_user.lastName AS 'ulname'
							FROM tbl_products
							INNER JOIN tbl_category ON tbl_products.cateID=tbl_category.cateID
							INNER JOIN tbl_discount ON tbl_products.pro_discount=tbl_discount.disID
							INNER JOIN tbl_user ON tbl_products.userID=tbl_user.id
							WHERE tbl_products.cateID = $cateid;";
						}
						else{
							$datasql='SELECT tbl_products.pro_id AS "pid", tbl_products.pro_image AS "pimg", tbl_products.pro_name AS "pnmae", tbl_category.name AS "cateName", tbl_products.pro_stock AS "pstock", tbl_products.pro_price AS "pprice",tbl_discount.discountPerent AS "pdisc",tbl_products.pro_price-(tbl_products.pro_price*tbl_discount.discountPerent/100) AS "TotalDisc", tbl_products.pro_date AS "pdate", tbl_products.pro_description As "pdesc", tbl_user.fistName As "ufname",tbl_user.lastName AS "ulname"
								FROM tbl_products
								INNER JOIN tbl_category ON tbl_products.cateID=tbl_category.cateID
								INNER JOIN tbl_discount ON tbl_products.pro_discount=tbl_discount.disID
								INNER JOIN tbl_user ON tbl_products.userID=tbl_user.id;';
						}
						
					}
				?>
				<?php
						$rundata = mysqli_query($conn,$datasql);
						while($rowdata = mysqli_fetch_array($rundata))
						{
				?>
						<tr>
							<td><?=$rowdata['pid']?></td>
							<td><img src="../images/productsImage/thumbnail/<?=$rowdata['pimg']?>"></td>
							<td><?=$rowdata['pnmae']?></td>
							<td><?=$rowdata['cateName']?></td>
							<td><?=$rowdata['pstock']?></td>
							<td>$<?=$rowdata['pprice']?></td>
							<td><?=$rowdata['pdisc']?>%</td>
							<td>$<?= number_format($rowdata['TotalDisc']*$rowdata['pstock'],2)?></td>
							<td><?=$rowdata['pdate']?></td>
							<td><?=$rowdata['ufname'].$rowdata['ulname']?></td>
						</tr>
				<?php
						}
				?>
			</tbody>
		</table>
		<div class="mt-2">
			<div class="row">
				<div class="col-sm-1">
					<button type="button" onClick="window.print();" class="btn btn-success w-100">Print</button>
				</div>
				<div class="col-sm-1">
					<form method="post" action="excelpro.php">
						<input type="hidden" name="catid" value="<?=$cateid?>">
						<input type="submit" value="Excel" name="export_excel" class="btn btn-primary w-100">
					</form>
				</div>
				<div class="col-sm-1">
					<a href="prolist.php?page=prolist" class="btn btn-dark w-100">Back</a>
				</div>
			</div>
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
                  <h4 class="card-title">Products</h4>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary float-end mb-2" data-toggle="modal" data-target="#print">
					  Report
					</button>

					<!-- Modal -->
					<div class="modal fade" id="print" tabindex="-1" role="dialog" aria-labelledby="print" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h5 class="modal-title" id="print">Select Category</h5>
						  </div>
						  <div class="modal-body">
							<form method="post" enctype="multipart/form-data" action="prolist.php?page=prolist&action=1">
							  	<label class="form-label">Select Category:</label>
								<select name="txt_cate" class="form-control" required>
									<option value="">--select--</option>
									<option value="All">All</option>
									<?php
										$getcate = "SELECT tbl_category.name as 'catename',tbl_products.cateID as 'catid' FROM `tbl_products`
										INNER JOIN tbl_category ON tbl_products.cateID = tbl_category.cateId
										GROUP BY tbl_products.cateID";
										$rungetcate = mysqli_query($conn,$getcate);
										while($rowscate = mysqli_fetch_array($rungetcate))
										{
									?>
									<option value="<?=$rowscate['catid']?>"><?=$rowscate['catename']?></option>
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
					
                  <div class="table-responsive mt-2">
                    <table id="list1" class="table table-bordered">
                      <thead class="text-center">
							<th class="text-center">Image</th>
							<th class="text-center">Name</th>
							<th class="text-center">Category</th>
							<th class="text-center">Stock</th>
							<th class="text-center">Price</th>
							<th class="text-center">Discount</th>
                      </thead>
                      <tbody>
						 <?php
								$i=1;
								$Sql = 'SELECT tbl_products.pro_id AS "pid", tbl_products.pro_image AS "pimg", tbl_products.pro_name AS "pnmae", tbl_category.name AS "cateName", tbl_products.pro_stock AS "pstock", tbl_products.pro_price AS "pprice",tbl_discount.discountPerent AS "pdisc",tbl_products.pro_price-(tbl_products.pro_price*tbl_discount.discountPerent/100) AS "TotalDisc", tbl_products.pro_date AS "pdate", tbl_products.pro_description As "pdesc", tbl_user.fistName As "ufname",tbl_user.lastName AS "ulname"
								FROM tbl_products
								INNER JOIN tbl_category ON tbl_products.cateID=tbl_category.cateID
								INNER JOIN tbl_discount ON tbl_products.pro_discount=tbl_discount.disID
								INNER JOIN tbl_user ON tbl_products.userID=tbl_user.id;';
								$runSQL = mysqli_query($conn,$Sql);
								while ($rows = mysqli_fetch_array($runSQL))
								{
							?>
							<tr>
								<td class="text-center">
									<img src="../images/productsImage/thumbnail/<?=$rows['pimg']?>">
								</td>
								<td><?=$rows['pnmae']?></td>
								<td><?=$rows['cateName']?></td>
								<td class="text-center">
										<?=$rows['pstock']?>
								</td>
								<td class="text-center">$<?=$rows['pprice']?></td>
								<td class="text-center"><?=$rows['pdisc']?>%</td>
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
<?php
		}
	?>
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


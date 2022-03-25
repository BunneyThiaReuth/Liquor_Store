<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
if(!isLogin())
{
   header("location:../login/login.php?page=login");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
   <title>Liquor Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
</head>
<body>

<nav class="navbar fixed-top navbar-expand-sm bg-light navbar-light" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
  <div class="container">
    <a class="navbar-brand" href="#">
		<img src="../assets/images/logo-icon.png">
		<strong>LIQUOR SORE</strong>
	  </a>
	  <div class="d-flex">
	  	<div class="container-fluid">
		<a class="navbar-brand" href="#">
		  <img src="../images/userImage/thamnail/<?=$_SESSION['img']?>" alt="LIQUOR SORE" style="width:50px;border-radius: 10px"> 
		</a>
			<span class="navbar-text"><strong><?=$_SESSION['username']?></strong></span>
	  </div>
		<div class="dropdown mt-2">
			<button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">
			  Action
			</button>
			<ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="#">
				  <box-icon type='solid' name='user-detail'></box-icon>
				  Profile
				  </a>
				</li>
			  <li><a class="dropdown-item" href="../login/login.php?page=login&action=logout">
				  <box-icon name='log-out-circle'></box-icon>
				  LogOut
				  </a>
				</li>
			</ul>
  		</div>
	</div>
	  </div>
  </div>
</nav>

<div class="container-fluid" style="margin-top:80px">
	<div class="float-start" style="width: 68%;height: 100%">
	<div class="mt-3">
		<table id="prolist" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr class="text-center">
                <th>Image</th>
				<th>Information</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
			<?php
							$sql = 'SELECT tbl_products.pro_id AS "pid", tbl_products.pro_image AS "pimg", tbl_products.pro_name AS "pnmae", tbl_category.name AS "cateName", tbl_products.pro_stock AS "pstock", tbl_products.pro_price AS "pprice",tbl_discount.discountPerent AS "pdisc",tbl_products.pro_price-(tbl_products.pro_price*tbl_discount.discountPerent/100) AS "TotalDisc", tbl_products.pro_date AS "pdate", tbl_products.pro_description As "pdesc", tbl_user.fistName As "ufname",tbl_user.lastName AS "ulname"
							FROM tbl_products
							INNER JOIN tbl_category ON tbl_products.cateID=tbl_category.cateID
							INNER JOIN tbl_discount ON tbl_products.pro_discount=tbl_discount.disID
							INNER JOIN tbl_user ON tbl_products.userID=tbl_user.id
							WHERE tbl_products.pro_stock >0;';
							$runsql = mysqli_query($conn,$sql);
							   while($rows = mysqli_fetch_array($runsql))
							   {
						?>
            <tr>
                <td>
					<img src="../images/productsImage/<?=$rows['pimg']?>" width="120" height="150">
				</td>
				<td>
					<h4><?=$rows['pnmae']?></h4>
					<?=$rows['pdesc']?>
					<div class="text-danger">
					- Price : $<?=$rows['pprice']?></br>
					- Discount : <?=$rows['pdisc']?>%</br>
					</div>
					<div class="text-success fw-bold">
					- Sale Price : $<?=number_format($rows['TotalDisc'],2)?>
					</div>
				</td>
				<td class="text-center">
					<a href="index.php?page=sale&action=1" class="btn btn-success" style="margin-top: 50%;box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;" >
						<box-icon type='solid' name='cart-add' color='white' size='sm'></box-icon>Add
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
<div class="float-end" style="width:30%;height: 100%">
	<div class="text-center">
		<h2><box-icon type='solid' name='cart-alt'></box-icon>Card</h2>
		<div>
			<table class="table">
			<thead>
			  <tr>
				<th>Name</th>
				<th>Price</th>
				<th>QTY</th>
				<th>Discount</th>
				<th>Amount</th>
				<th>Action</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td>1</td>
				<td>1</td>
				<td>1</td>
				<td>1</td>
				<td>1</td>
				<td>
					<a href="#"><box-icon name='trash-alt' color='red'></box-icon></a>
				</td>
			  </tr>
			</tbody>
		  </table>
		</div>
	</div>
</div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"> 
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#prolist').DataTable();
} );
</script>
<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "index.php?page=sale");  
    }
</script>
</body>
</html>
<?php mysqli_close($conn)?>
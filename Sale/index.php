<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
$pID="";
$pname = "";
$price = "";
$dis = "";
$amount = "";

$message =-1;
$messageDialog ="";
if(!isLogin(1))
{
   header("location:../login/login.php?page=login");
   exit();
}
if(isset($_GET['cation']))
{
	$qty = $_POST['qty'];
	if($qty > 0)
	{
		$action =$_GET['cation'];
		switch($action){
			case '1':
					$pID = $_POST['pid'];
					$pname = $_POST['pname'];
					$price = $_POST['price'];
					$dis = $_POST['disc'];
					$amount = $_POST['amount'];
				
					if(isset($pID) && isset($pname) && isset($price) && isset($dis) && isset($amount))
					{
						$sql = "INSERT INTO `tbl_card`(`pid`, `name`, `price`, `qty`, `discount`, `amount`) VALUES ('$pID','$pname','$price','$qty','$dis','$amount');";
						$runsql = mysqli_query($conn,$sql);
						if($runsql)
						{
							$message =1;
							$messageDialog ="Add to card is successfully ";
						}
						else{
							$message =0;
							$messageDialog ="Add to card is not successfully !";
						}
					}
					else
					{
						$message =0;
						$messageDialog ="Ohhop we have error please try again !";
					}
				break;
			}
	}
	else
	{
		$message =0;
		$messageDialog ="Quantity is invalid !";
	}
		
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('include/head.php')?>
</head>
<body>
<?php include('include/nav.php')?>
<div class="container-fluid" style="margin-top:80px">
	<div class="float-start" style="width: 68%;height: 100%">
	<div class="mt-3">
		<?php
			if($message == 1)
			{
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <strong>Messase !</strong> <?=$messageDialog?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php
			}
			elseif($message ==0)
			{
		?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		 <strong>Messase !</strong> <?=$messageDialog?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php
			}
		?>
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
					<a href="#" class="btn btn-success" style="margin-top: 50%;box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;" data-toggle="modal" data-target="#addCardModalCenter<?=$rows['pid']?>">
						<box-icon type='solid' name='cart-add' color='white' size='sm'></box-icon>Add
					</a>
				</td>
            </tr>
	
	<!-- CardModal -->
	<div class="modal fade" id="addCardModalCenter<?=$rows['pid']?>" tabindex="-1" role="dialog" aria-labelledby="addCardModalCenter<?=$rows['pid']?>" aria-hidden="true">
	  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-body">
			  		<div class="card" style="width: 16.5rem;">
					  <img class="card-img-top" width="180" height="250" src="../images/productsImage/<?=$rows['pimg']?>" alt="Card image cap">
					  <div class="card-body">
					<form method="post" enctype="multipart/form-data" action="index.php?page=sale&cation=1">
						<div class="text-danger fw-bold">
							<?php
								$pID = $rows['pid'];
								$pname = $rows['pnmae'];
								$price = $rows['pprice'];
								$dis = $rows['pdisc'];
								$amount = number_format($rows['TotalDisc'],2);
							?>
							<label class="form-label">- Name : </label>
							<input type="hidden" value="<?=$pID?>" name="pid" required>
							<input type="text" value="<?=$pname?>" name="pname" disabled class="form-control" required>
							<label class="form-label">- Price : $</label>
							<input type="text" value="<?=$price?>" name="price" class="form-control" disabled required>
							<label class="form-label">- Discount : %</label>
							<input type="text" value="<?=$dis?>" name="disc" class="form-control" disabled required>
						</div>
						<div class="text-success fw-bold">
							<label class="form-label">- Sale Price : $</label>
							<input type="text" name="amount" value="<?=$amount?>" class="form-control" disabled required>
							<label class="form-label">- Quantity: $</label>
							<input type="number" placeholder="Quantity" name="qty" class="form-control" required>
						</div>
					<div class="mt-3 text-center">
						<button  type="submit" class="btn btn-success" style="width: 45%">Add Card</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 45%">Close</button>
					</div>
			  </form>
			</div>
					
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
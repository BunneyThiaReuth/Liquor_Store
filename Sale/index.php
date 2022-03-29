<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
$message =-1;
$messageDialog ="";
if(!isLogin(1))
{
   header("location:../login/login.php?page=login");
   exit();
}
if(isset($_GET['action']))
{
	$action = $_GET['action'];
	switch($action)
	{
		case '1':

				$pid = $_POST['txt_pid'];
				$name = $_POST['txt_name'];
				$price = $_POST['txt_price'];
				$amount = $_POST['txt_amount'];
				$amount = number_format($amount,2);
				$qty = 1;
				$sql = "INSERT INTO `tbl_card`(`pid`, `name`, `price`, `qty`,`amount`) VALUES ('$pid','$name','$price','$qty','$amount')";
				$runsql = mysqli_query($conn,$sql);
				if($runsql)
				{
					$message = 1;
					$messageDialog ="Add to card is successfully...";
				}
				else
				{
					$message = 0;
					$messageDialog ="Add to card is not successfully !";
				}
				
			
			break;
		case '2':
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$sql ="DELETE FROM `tbl_card` WHERE `id`=$id";
				$runsql = mysqli_query($conn,$sql);
				if($runsql)
				{
					$message = 1;
					$messageDialog ="Deleted is successfully...";
				}
				else
				{
					$message = 0;
					$messageDialog ="Deleted is not successfully !";
				}
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
					<form method="post" enctype="multipart/form-data" action="index.php?page=sale&action=1">
				</td>
				<?php
					$proid = $rows['pid'];
					$pname = $rows['pnmae'];
					$pprice = $rows['pprice'];
					$pdiscount = $rows['pdisc'];
					$pamount = $rows['TotalDisc'];
				?>
				
				<td class="text-center">
					
						<input type="hidden" name="txt_pid" value="<?=$proid?>">
						<input type="hidden" name="txt_name" value="<?=$pname?>">
						<input type="hidden" name="txt_price" value="<?=$pprice?>">
						<input type="hidden" name="txt_disc" value="<?=$pdiscount?>">
						<input type="hidden" name="txt_amount" value="<?=$pamount?>">
						<button type="submit" class="btn btn-success" style="margin-top: 50%;box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;"><box-icon type='solid' name='cart-add' color='white' size='sm'></box-icon>Add</button>
					</form>
				</td>
            </tr>
			<?php
				
				}
			   
			?>
		</tbody>
    </table>

	</div>
	</div>
	<div class="float-end mt-3" style="width:31%;height: 100%">	
	<div class="text-center">
		<h2><box-icon type='solid' name='cart-alt'></box-icon>Card</h2>
		<div>
			<table class="table table-hover">
			<thead class="bg-warning">

				<th>Name</th>
				<th>Price</th>
				<th>QTY</th>
				<th>Amount</th>
				<th>Action</th>

			</thead>
			<tbody class="table-warning">
				<?php
					$getCard = 'SELECT `id`, `pid`, `name`, `price`, sum(`qty`) as "qty", `amount` 
					FROM `tbl_card`
					GROUP BY `pid`
					ORDER BY `id` DESC;';
					$rungetCard = mysqli_query($conn,$getCard);
					while($card = mysqli_fetch_array($rungetCard))
					{
				?>
			  <tr>
					<td><?=$card['name']?></td>
				  	<td>$<?=$card['price']?></td>
				  	<td>
						<?=$card['qty']?>
				  	</td>
				  	<td><?=$card['amount']?></td>
				<td>
					<a href="index.php?page=sale&action=2&id=<?=$card['id']?>">
						<box-icon name='trash'></box-icon>
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
		<?php
			$sqlcalCard = "SELECT SUM(`price`*`qty`) AS total,SUM(`amount`) as amount FROM `tbl_card`";
			$runcardsql = mysqli_query($conn,$sqlcalCard);
			$calCard = mysqli_fetch_array($runcardsql);
			$totalcard = $calCard['total'];
			$totalpayment = $calCard['amount'];
		?>
		<div class="row mt-1 fw-bold">
			<div class="col">
				<label>Grand Total :</label>
				<input type="text" class="p-1 w-100" value="$<?=$totalcard?>" disabled>
			</div>
			<div class="col">
				<label>Total Payment :</label>
				<input type="text" class="p-1 w-100" value="$<?=$totalpayment?>" disabled>
			</div>
		</div>
		<div class="mt-4">
			<div class="row">
				<div class="col">
					<button type="button" class="btn btn-primary w-100">Payment</button>
				</div>
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
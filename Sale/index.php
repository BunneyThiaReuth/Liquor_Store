<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
if(!isLogin(1))
{
   header("location:../login/login.php?page=login");
   exit();
}
date_default_timezone_set("Asia/Phnom_Penh");
$t=strtotime("now");
$message =-1;
$messagedialog = "";

if(isset($_GET['action']))
{
	$action = $_GET['action'];
	switch($action)
	{
		case '1':
			if(isset($_POST['max_qty']) && $_POST['max_qty']>=$_POST['txt_qty'])
			{
				$maxQTy = $_POST['max_qty'];
			
				if(isset($_POST['txt_qty']) && $_POST['txt_qty'] > 0)
				{
					$pid = $_POST['txt_pid'];
					$name = $_POST['txt_name'];
					$price = $_POST['txt_price'];
					$amount = $_POST['txt_amount'];
					$invnum = $_POST['txt_invNum'];
					$amount = number_format($amount,2);
					$qty = $_POST['txt_qty'];

						$sql = "INSERT INTO `tbl_card`(`pid`, `name`, `price`, `qty`,`amount`,`ivnum`) VALUES ('$pid','$name','$price','$qty','$amount','$invnum');";
						$runsql = mysqli_query($conn,$sql);
					$getupdate = "SELECT  `pro_stock`-$qty as 'pro_stock' FROM `tbl_products` WHERE `pro_id` = $pid;";
					$rungetupdate = mysqli_query($conn,$getupdate);
					$getvalue = mysqli_fetch_array($rungetupdate);
					$update = $getvalue['pro_stock'];
					$sqlup = "UPDATE `tbl_products` SET `pro_stock`='$update' WHERE `pro_id` = $pid;";
					mysqli_query($conn,$sqlup);
				}
				else
				{
					$message =0;
					$messagedialog = "Quantity invalid !";
				}
			}
			else
			{
				$message =0;
				$messagedialog = "Quantity invalid !";
			}
			break;
		case '2':
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$sql ="DELETE FROM `tbl_card` WHERE `id`=$id";
				$runsql = mysqli_query($conn,$sql);
				$stock =$_GET['stock'];
				$proid = $_GET['proid'];
				$getqtypro = "SELECT `pro_stock` FROM `tbl_products` WHERE `pro_id` = $proid";
				$runsqlgetqty = mysqli_query($conn,$getqtypro);
				$data = mysqli_fetch_array($runsqlgetqty);
				$upqty = $data['pro_stock']+$stock;					
				$updatesql = "UPDATE `tbl_products` SET `pro_stock`='$upqty' WHERE `pro_id` =$proid";
				mysqli_query($conn,$updatesql);
				
			}
			break;
		case '3':
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$qty = $_POST['txt_upaty'];
					$qtyapp = $_POST['txt_oldqty'];
					$pid = $_POST['pid'];
					if($qty != $qtyapp && $qty>0)
					{
						$sql = "UPDATE `tbl_card` SET `qty`='$qty' WHERE `id` = $id";
						$runsql = mysqli_query($conn,$sql);
						if($runsql)
						{
							$total = $qty - $qtyapp;
							$message =1;
							if($qty > $qtyapp)
							{
								$getqtypro = "SELECT `pro_stock` FROM `tbl_products` WHERE `pro_id` = $pid";
								$runsqlgetqty = mysqli_query($conn,$getqtypro);
								$data = mysqli_fetch_array($runsqlgetqty);
								
								$upqty = ($data['pro_stock']+$qtyapp)-$qty;
								
								$updatesql = "UPDATE `tbl_products` SET `pro_stock`='$upqty' WHERE `pro_id` =$pid";
								mysqli_query($conn,$updatesql);
								$messagedialog = "Quantity updated is successfully...";
							}
							else
							{
								$getqtypro = "SELECT `pro_stock` FROM `tbl_products` WHERE `pro_id` = $pid";
								$runsqlgetqty = mysqli_query($conn,$getqtypro);
								$data = mysqli_fetch_array($runsqlgetqty);
								$oldstock = $data['pro_stock'];
								$upnumber = $oldstock+$qtyapp-$qty;
								$updatesql = "UPDATE `tbl_products` SET `pro_stock`='$upnumber' WHERE `pro_id` =$pid";
								mysqli_query($conn,$updatesql);
								$messagedialog = "Quantity updated is successfully...";
							}
								
						}
						else
						{
							$message =0;
							$messagedialog = "Quantity updated is not successfully !";
						}
					}
					else{
						$message =0;
						$messagedialog = "Quantity updated is not change !";
					}
					
				}
			break;
		case '4':
			$date = date("Y-m-d");
			$invNumber = $t;
			$user = $_SESSION['userID'];
			$not = $_POST['txt_not'];
			$sql = "INSERT INTO `tbl_invoice`(`invNumber`, `Date`, `userID`, `status`, `not`) VALUES ('$invNumber','$date','$user','0','$not')";
			$runsql = mysqli_query($conn,$sql);
			if($runsql){
				$message =1;
				$messagedialog = "Invoice created is successfully...";
			}
			else
			{
				$message =0;
				$messagedialog = "Invoice created is not successfully...";
			}
			break;
		case '5':
				$sql = 'INSERT INTO `tbl_invoicedetail`(`invNumber`, `proID`, `price`, `qty`, `amount`)
				SELECT `ivnum`,`pid`, `amount`, sum(`qty`), sum(`amount`*`qty`) AS "amount"
				FROM `tbl_card`
				GROUP BY `pid`;';
				$runsql = mysqli_query($conn,$sql);
				if($runsql)
				{
					$message =1;
					$messagedialog = "Submit is successfully....";
					$deleteCard = "DELETE FROM tbl_card;";
					mysqli_query($conn,$deleteCard);
					if(isset($_POST['txt_upinvNum']) && $_POST['txt_upinvNum'] !="")
					{
						$invnumberup = $_POST['txt_upinvNum'];
						$updateInv = "UPDATE `tbl_invoice` SET `status`='0' WHERE `invNumber` = $invnumberup";
						mysqli_query($conn,$updateInv);
					}
					else
					{
						$message =0;
						$messagedialog = "Submit is not successfully !";
					}
				}
				else{
					$message =0;
					$messagedialog = "Submit is not successfully !";
				}
			break;
		case '6':
			if(isset($_POST['txt_caninvNum']))
			{
				$deleteCard = "DELETE FROM tbl_card;";
				$rundelete = mysqli_query($conn,$deleteCard);
				if($rundelete)
				{
					$message =1;
					$messagedialog = "Distroy successfully !";
					$id = $_POST['txt_caninvNum'];
					
					$deleteinv = "DELETE FROM `tbl_invoice` WHERE `invID`=$id";
					mysqli_query($conn,$deleteinv);
				}
				else{
					$message =0;
					$messagedialog = "Fialed to Distroy !";
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
<div class="container-fluid" style="margin-top:60px">

	<div class="float-end" style="width: 58%;height: 100%">
	<div class="mt-2">
	<?php
		if($message == 1)
		{
	?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Success !</strong> <?=$messagedialog?>
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
		<strong>Error !</strong> <?=$messagedialog?>
		</br>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>

	<?php
		}
	?>
	<table id="prolist" class="table table-striped table-hover" style="width:100%">
        <thead class="bg-success text-white">
            <tr class="text-center">
                <th>Image</th>
				<th>Information</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody class="table-success">
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
					<img src="../images/productsImage/<?=$rows['pimg']?>" alt="<?=$rows['pnmae']?>" class="rounded" style="margin-top: 20%" width="120" height="150">
				</td>
				<td>
					<h4><?=$rows['pnmae']?></h4>
					<?=$rows['pdesc']?>
					<div class="text-danger">
					- Price : $<?=$rows['pprice']?></br>
					- Discount : <?=$rows['pdisc']?>%</br>
					
					</div>
					<?php
						if($rows['pstock']>=5)
						{
					?>
					<div class="text-success fw-bold">
					- In Stock : (<?=$rows['pstock']?>)</br>
					</div>
					<?php
						}
						elseif($rows['pstock']<5)
						{
					?>
					<div class="text-danger fw-bold">
					- In Stock : (<?=$rows['pstock']?>)</br>
					</div>
					<?php
						}
					?>
					<div class="text-success fw-bold">
					- Sale Price : $<?=number_format($rows['TotalDisc'],2)?>
					</div>
					<form method="post" enctype="multipart/form-data" action="index.php?page=sale&action=1">
					<div class="row">
						<div class="col">
							<input type="hidden" name="max_qty" value="<?=$rows['pstock']?>">
							<input type="number" value="0" name="txt_qty" class="form-control" placeholder="Quantity" required>
						</div>
						<div class="col">
								<select class="form-control" name="txt_invNum" required>
									<option value="">--select Invoice--</option>
									<?php
										$sqlgetinvnum = "SELECT * FROM `tbl_invoice` WHERE `status` =0 ORDER BY `invID` DESC";
										$runsqlgetinvnum = mysqli_query($conn,$sqlgetinvnum);
										while($getinvnum = mysqli_fetch_array($runsqlgetinvnum))
										{
									?>
										<option value="<?=$getinvnum['invNumber']?>">#<?=$getinvnum['invNumber'].".(".$getinvnum['not'].")"?></option>
									<?php
										}
									?>
								</select>
						</div>	
					</div>
					
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
	<div class="fixed-top" style="width:40%;height:100%;margin-top: 5.3%;margin-left: 1%">
		<div>
			<table id="cartlist" class="table table-hover ">
			<thead class="bg-warning text-center">

				<th>Name</th>
				<th>Price</th>
				<th>QTY</th>
				<th>Amount</th>
				<th>Action</th>

			</thead>
			<tbody class="table-warning">
				<?php
					$getCard = 'SELECT `id`, `pid`, `name`,`price`,`amount` as "saleprice", sum(`qty`) as "qty" , sum(`amount`*`qty`) as "amount"
					FROM `tbl_card`
					GROUP BY `pid`
					ORDER BY `id` DESC;';
					$rungetCard = mysqli_query($conn,$getCard);
					while($card = mysqli_fetch_array($rungetCard))
					{
				?>
			  <tr>
					<td><?=$card['name']?></td>
				  	<td class="text-center">$<?=$card['saleprice']?></td>
				  	<td class="text-center">
						<?php
							if(isset($_GET['action']) && $_GET['action'] == 'edit' && $_GET['editID'] == $card['id'])
							{
						?>
						<form enctype="multipart/form-data" method="post" action="index.php?page=sale&action=3&id=<?=$card['id']?>">
							<input type="hidden" value="<?=$card['qty']?>" name="txt_oldqty">
							<input type="hidden" value="<?=$card['pid']?>" name="pid">
							<div class="input-group mb-3">
							  <input type="number" class="form-control" value="<?=$card['qty']?>" name="txt_upaty" required>
							  <div class="input-group-append">
								<button class="btn btn-outline-secondary" type="submit">Save</button>
							  </div>
							</div>
						</form>
						<?php
							}
							else
							{
						?>
							<?=$card['qty']?>
						<?php
							}
						?>
				  	</td>
				  	<td class="text-center"><?=$card['amount']?></td>
				<td class="text-center">
					<a href="index.php?page=sale&action=2&stock=<?=$card['qty']?>&id=<?=$card['id']?>&proid=<?=$card['pid']?>">
						<box-icon name='trash'></box-icon>
					</a>
					<a href="index.php?page=sale&action=edit&editID=<?=$card['id']?>">
						<box-icon name='edit-alt'></box-icon>
					</a>
				</td>
			  </tr>
			<?php
					}
			?>
			</tbody>
				<?php
					$sqlcalCard = "SELECT SUM(`price`*`qty`) AS total,SUM(`amount`*`qty`) as amount FROM `tbl_card`";
					$runcardsql = mysqli_query($conn,$sqlcalCard);
					$calCard = mysqli_fetch_array($runcardsql);
					$totalcard = $calCard['total'];
					$totalpayment = $calCard['amount'];
				?>
				<tfoot>
					<tr>
						<td>Grand Total : $<?=$totalcard?></td>
					</tr>
					<tr>
						<td>Payment : $<?=$totalpayment?></td>
					</tr>
				</tfoot>
		  </table>
		</div>

		<div class="mt-2">
			<div class="row">
				<div class="col">
					<button type="button" class="btn btn-success w-100"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Generate Invoice</button>
				</div>
				<div class="col">
					<a class="btn btn-primary w-100" href="listINV.php?page=invoice">Invoices</a>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col">
				<button type="button" class="btn btn-dark w-100" data-toggle="modal" data-target="#submitINVModal">Submit Invoice</button>
			</div>
			<div class="col">
				<button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#cancelINVModal"> Distroy</button>
			</div>
		</div>
</div>
</div>
</div>
<!-- Modal submit vin -->
<div class="modal fade" id="submitINVModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitINVModal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-center">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="submitINVModal">Confirm Message</h5>
      </div>
	
      <div class="modal-body p-2">
	  <form method="post" enctype="multipart/form-data" action="index.php?page=sale&action=5">
		<select class="form-control" name="txt_upinvNum" required>
				<option value="">--select Invoice--</option>
					<?php
						$sqlgetinvnumup = "SELECT * FROM `tbl_invoice` WHERE `status` =0 ORDER BY `invID` DESC";
						$runsqlgetinvnumup = mysqli_query($conn,$sqlgetinvnumup);
						
						while($getinvnumup = mysqli_fetch_array($runsqlgetinvnumup))
						{
						?>
						<option value="<?=$getinvnumup['invNumber']?>">#<?=$getinvnumup['invNumber'].".(".$getinvnumup['not'].")"?></option>
						<?php
						}
						?>
			</select>
			 <div class="modal-footer">
		 		<button type="submit" class="btn btn-primary">Submit</button>
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      		</div>
		 </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal cancel vin -->
<div class="modal fade" id="cancelINVModal" tabindex="-1" role="dialog" aria-labelledby="cancelINVModal" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content alert-warning">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelINVModal">Your Message</h5>
      </div>
      <div class="modal-body">
		Are you sure to cancel this cart ?
		<form method="post" enctype="multipart/form-data" action="index.php?page=sale&action=6">
		<select class="form-control mt-3" name="txt_caninvNum" required>
				<option value="">--select Invoice--</option>
					<?php
						$csqlgetinvnumup = "SELECT * FROM `tbl_invoice` WHERE `status` = 0 ORDER BY `invID` DESC";
						$crunsqlgetinvnumup = mysqli_query($conn,$csqlgetinvnumup);
						while($cgetinvnumup = mysqli_fetch_array($crunsqlgetinvnumup))
						{
						?>
						<option value="<?=$cgetinvnumup['invID']?>">#<?=$cgetinvnumup['invNumber'].".(".$cgetinvnumup['not'].")"?></option>
						<?php
						}
						?>
			</select>
			 <div class="modal-footer">
		 		<button type="submit" class="btn btn-primary">Submit</button>
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      		</div>
		 </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal INV -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-center">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">CREATE INVOICE</h5>
      </div>
	
      <div class="modal-body p-2">
	  <form method="post" enctype="multipart/form-data" action="index.php?page=sale&action=4">
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
        <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Close</button>
      </div>
	  </form>
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
$(document).ready(function() {
    $('#cartlist').DataTable();
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
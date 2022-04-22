<?php
include('../libaries/auth.php');
include('../database/db_connection.php');
if(!isLogin(2))
{
	header("location:../login/login.php?page=login");
	exit();
}
date_default_timezone_set("Asia/Phnom_Penh");
if(isset($_POST['btn_export']))
{
	$sql = 'SELECT tbl_import.impID as "impID",tbl_import.date As "date",tbl_products.pro_name as "pname",tbl_products.pro_id as "pid",tbl_import.price as "price",tbl_import.qty as "qty",tbl_import.price*tbl_import.qty as "total",tbl_user.fistName AS "userfname",tbl_user.lastName as "userlname",tbl_import.desc As "desc"
	FROM tbl_import
	INNER JOIN tbl_products ON tbl_import.pid = tbl_products.pro_id
	INNER JOIN tbl_user ON tbl_import.userid = tbl_user.id;';
	$runsql = mysqli_query($conn,$sql);
	if(mysqli_num_rows($runsql)>0)
	{
		?>
		<table>
			<thead class="text-center">
				<th>#ID</th>
				<th>Products Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
				<th>Date</th>
				<th>Description</th>
				<th>User</th>
			</thead>
		<tbody>
			<?php
				while($getrows = mysqli_fetch_array($runsql))
				{
			?>
			<tr>
				<td><?=$getrows['impID']?></td>
				<td><?=$getrows['pname']?></td>
				<td>$<?=$getrows['price']?></td>
				<td class="text-center"><?=$getrows['qty']?></td>
				<td class="text-center">$<?= number_format($getrows['total'],2)?></td>
				<td class="text-center">
				<?php
					$date = date_create($getrows['date']);
					echo date_format($date,'d-M-Y');
				?>
				</td>
				<td><?=$getrows['desc']?></td>
				<td class="text-center"><?=$getrows['userfname'].' '.$getrows['userlname']?></td>
			</tr>
			<?php
				}
			?>
		</tbody>
</table>
<?php
				header("Content-type: application/xls");
				header("Content-Disposition: attachment; filename=importlist.xls");
	}
}
?>
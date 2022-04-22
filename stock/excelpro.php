<?php
	include('../libaries/auth.php');
	include('../database/db_connection.php');
	date_default_timezone_set("Asia/Phnom_Penh");
	if(!isLogin(2))
	{
		header("location:../login/login.php?page=login");
		exit();
	}
	$output="";
	if(isset($_POST['export_excel']))
	{
		if(isset($_POST['catid']))
		{
			$catid= $_POST['catid'];
			if($catid !="All")
			{
				$sql = "SELECT tbl_products.pro_id AS 'pid', tbl_products.pro_image AS 'pimg', tbl_products.pro_name AS 'pnmae', tbl_category.name AS 'cateName', tbl_products.pro_stock AS 'pstock', tbl_products.pro_price AS 'pprice',tbl_discount.discountPerent AS 'pdisc',tbl_products.pro_price-(tbl_products.pro_price*tbl_discount.discountPerent/100) AS 'TotalDisc', tbl_products.pro_date AS 'pdate', tbl_products.pro_description As 'pdesc', tbl_user.fistName As 'ufname',tbl_user.lastName AS 'ulname'
				FROM tbl_products
				INNER JOIN tbl_category ON tbl_products.cateID=tbl_category.cateID
				INNER JOIN tbl_discount ON tbl_products.pro_discount=tbl_discount.disID
				INNER JOIN tbl_user ON tbl_products.userID=tbl_user.id
				WHERE tbl_products.cateID =$catid";
			}
			else
			{
				$sql ='SELECT tbl_products.pro_id AS "pid", tbl_products.pro_image AS "pimg", tbl_products.pro_name AS "pnmae", tbl_category.name AS "cateName", tbl_products.pro_stock AS "pstock", tbl_products.pro_price AS "pprice",tbl_discount.discountPerent AS "pdisc",tbl_products.pro_price-(tbl_products.pro_price*tbl_discount.discountPerent/100) AS "TotalDisc", tbl_products.pro_date AS "pdate", tbl_products.pro_description As "pdesc", tbl_user.fistName As "ufname",tbl_user.lastName AS "ulname"
				FROM tbl_products
				INNER JOIN tbl_category ON tbl_products.cateID=tbl_category.cateID
				INNER JOIN tbl_discount ON tbl_products.pro_discount=tbl_discount.disID
				INNER JOIN tbl_user ON tbl_products.userID=tbl_user.id;';
			}
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0)
			{
?>
			<table class="table">
			<thead>
				<th>#ID</th>
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
						while($rowdata = mysqli_fetch_array($result))
						{
				?>
						<tr>
							<td><?=$rowdata['pid']?></td>
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
<?php
				header("Content-type: application/xls");
				header("Content-Disposition: attachment; filename=Productslist.xls");
			}
		}
	}
?>
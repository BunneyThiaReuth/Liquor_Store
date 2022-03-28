<?php
    include('libaries/auth.php');
	include('database/db_connection.php');
    if(!isLogin(3))
    {
        header("location:login/login.php?page=login");
        exit();
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">LIST PRODUCT</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="category.php?page=category">Category</a>
                                        <li class="breadcrumb-item">
										<a href="ListCategory.php?page=Listcategory">List Category</a>
                                        <li class="breadcrumb-item">
										<a href="discount.php?page=discount">Discount</a>
                                        <li class="breadcrumb-item">
										<a href="lsitDiscount.php?page=lsitDiscount">List Discount</a>
                                        <li class="breadcrumb-item">
										<a href="newProducts.php?page=newProducts">New Product</a>
										<li class="breadcrumb-item">
										<a href="listProducts.php?page=listProducts">list Product</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div>
					<table id="list" class=" table table-primary table-hover">
						<thead>
							<tr>
								<th class="text-center">#No</th>
								<th class="text-center">Image</th>
								<th class="text-center">Name</th>
								<th class="text-center">Category</th>
								<th class="text-center">Stock</th>
								<th class="text-center">Price</th>
								<th class="text-center">Discount</th>
								<th class="text-center">Action</th>
							</tr>
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
								<td class="text-center"><?=$i?></td>
								<td class="text-center">
									<img src="images/productsImage/thumbnail/<?=$rows['pimg']?>">
								</td>
								<td><?=$rows['pnmae']?></td>
								<td><?=$rows['cateName']?></td>
								<td class="text-center"><?=$rows['pstock']?></td>
								<td class="text-center">$<?=$rows['pprice']?></td>
								<td class="text-center"><?=$rows['pdisc']?>%</td>
								<td class="text-center">
									<a href="#">
										<box-icon name='message-alt-error' type='solid' data-toggle="modal" data-target="#infoModalCenter<?=$rows['pid']?>"></box-icon>
									</a>
									<a href="#">
										<box-icon name='edit-alt'></box-icon>
									</a>
									<a href="#">
										<box-icon name='trash' ></box-icon>
									</a>
									
								</td>
							</tr>
<!-- Modal info -->
<div class="modal fade" id="infoModalCenter<?=$rows['pid']?>" tabindex="-1" role="dialog" aria-labelledby="infoModalCenter<?=$rows['pid']?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content alert-info">
      <div class="modal-header">
        <h3 class="modal-title" id="infoModalCenter<?=$rows['pid']?>">PRODUCT INFORMATION</h3>
        </button>
      </div>
      <div class="modal-body">
       	<div class="row">
			<div class="col col-lg-4">
				<img src="images/productsImage/<?=$rows['pimg']?>" width="200" height="200">
			</div>
			<div class="col">
			  <div class="row mt-3">
				  <div class="col">
					 <label class="form-label">Product Name :</label>
					<input type="text" class="form-control" value="<?=$rows['pnmae']?>" disabled>
				  </div>
			  	<div class="col">
					 <label class="form-label">Category :</label>
					<input type="text" class="form-control" value="<?=$rows['cateName']?>" disabled>
				  </div>
				  
			  </div>
				<div class="row mt-3">
					<div class="col">
					 <label class="form-label">Quantity in Stock :</label>
					<input type="text" class="form-control" value="<?=$rows['pstock']?>" disabled>
					  </div>
					<div class="col">
						 <label class="form-label">Price :</label>
						<input type="text" class="form-control" value="$<?=$rows['pprice']?>" disabled>
					  </div>
				</div>
		  </div>
		  </div>
		  <div class="row mt-3">
			  <div class="col">
			  	<label class="form-label">Discount :</label>
				<input type="text" class="form-control" value="<?=$rows['pdisc']?>%" disabled>
			  </div>
			  <div class="col">
			  	<label class="form-label">Date :</label>
				<input type="text" class="form-control" value="<?=$rows['pdate']?>" disabled>
			  </div>
			 <div class="col">
			  	<label class="form-label">User :</label>
				<input type="text" class="form-control" value="<?=$rows['ufname']." ".$rows['ulname']?>" disabled>
			  </div>
			</dvi>
      </div>
	  <div class="row mt-3">
		  <div class="col">
			  <label class="form-label">Description :</label>
			  <textarea class="form-control" rows="5" disabled><?=$rows['pdesc']?></textarea>
		  </div>
	  </div>
	  <div class="row mt-3">
		  <div class="col col-lg-4">
			  <div class="form-group">
				  <input type="text" class="form-control" value="Toal Price : $<?=number_format($rows['TotalDisc'],2)?>" disabled>
			  </div>
		  </div>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
							
						<?php
								$i++;
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
<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "listProducts.php?page=listProducts");  
    }
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
	$(document).ready( function () {
    $('#list').DataTable();
} );
</script>
</body>

</html>
<?php mysqli_close($conn)?>
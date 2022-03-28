<?php
    include('libaries/auth.php');
	include('database/db_connection.php');
    if(!isLogin(3))
    {
        header("location:login/login.php?page=login");
        exit();
    }
$message=-1;
$messageDialog ="";
if(isset($_GET['action']))
{
	$action = $_GET['action'];
	switch($action){
		case '1':
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$sql = 'SELECT tbl_products.pro_id AS "pid",tbl_products.pro_discount AS "disID",tbl_products.cateID AS "cateID",tbl_products.pro_image AS "pimg", tbl_products.pro_name AS "pnmae", tbl_category.name AS "cateName", tbl_products.pro_stock AS "pstock", tbl_products.pro_price AS "pprice",tbl_discount.discountPerent AS "pdisc",tbl_products.pro_price-(tbl_products.pro_price*tbl_discount.discountPerent/100) AS "TotalDisc", tbl_products.pro_date AS "pdate", tbl_products.pro_description As "pdesc", tbl_user.fistName As "ufname",tbl_user.lastName AS "ulname"
				FROM tbl_products
				INNER JOIN tbl_category ON tbl_products.cateID=tbl_category.cateID
				INNER JOIN tbl_discount ON tbl_products.pro_discount=tbl_discount.disID
				INNER JOIN tbl_user ON tbl_products.userID=tbl_user.id
				WHERE tbl_products.pro_id ='.$id;
				$runsql = mysqli_query($conn,$sql);
				$getrow = mysqli_fetch_array($runsql);
				
				$getDiscID = $getrow['disID'];
				$getCateID = $getrow['cateID'];
				$getId = $getrow['pid'];
				$getName = $getrow['pnmae'];
				$getImg = $getrow['pimg'];
				$getCate = $getrow['cateName'];
				$getStock = $getrow['pstock'];
				$getPrice = $getrow['pprice'];
				$getDies = $getrow['pdisc'];
				$getDate = $getrow['pdate'];
				$getDesc = $getrow['pdesc'];
			}
			break;
		case '2':
			if(isset($_POST['byId']))
			{
				
				if(isset($_POST['oldimg']))
				{	
					$id = $_POST['byId'];
					$upname = $_POST['txt_pName'];
					$upcate = $_POST['txt_cate'];
					$upstock = $_POST['txt_stock'];
					$upprice = $_POST['txt_price'];
					$updis = $_POST['txt_discount'];
					$updesc = $_POST['txt_desc'];
					$update = $_POST['txt_date'];
					
					$image = $_POST['oldimg'];
					
					if(isset($_FILES['txt_image']))
					{
						$allowedtype = array('jpg','png','jpeg');
						$imagetype = pathinfo($_FILES['txt_image']['name'],PATHINFO_EXTENSION);
						if(!in_array($imagetype,$allowedtype))
						{
							$message =0;
							$messageDialog = "This file type is not allowed !";
						}
						else
						{
								
								$image = time().basename($_FILES['txt_image']['name']);
								$part = "images/productsImage/".$image;
								move_uploaded_file($_FILES['txt_image']['tmp_name'],$part);
								$nw=50;
								$nh=50;
								$thumbnail = imagecreatetruecolor($nw,$nh);
								$source; //= imagecreatefromjpeg($part);
								if($imagetype == 'jpg' or $imagetype == 'jpeg')
								{
								$source = imagecreatefromjpeg($part);
								}
								elseif($imagetype == 'png')
								{
								$source = imagecreatefrompng($part);
								}
							
								list($w,$h,$t) = getimagesize($part);
								imagecopyresized($thumbnail,$source,0,0,0,0,$nw,$nh,$w,$h);
								imagejpeg($thumbnail,"images/productsImage/thumbnail/".$image);
								
								$imgpath = $_POST['oldimg'];
								$oldpath = "images/productsImage/".$imgpath;
								$oldpathTm = "images/productsImage/thumbnail/".$imgpath;
							
								$upimg = trim($oldpath);
								$upimgtm = trim($oldpathTm);
								
								unlink($upimg);
								unlink($upimgtm);
								
							}
						$sql = "UPDATE `tbl_products` SET `pro_image`='$image',`pro_name`='$upname',`cateID`='$upcate',`pro_stock`='$upstock',`pro_price`='$upprice',`pro_discount`='$updis',`pro_date`='$update',`pro_description`='$updesc' WHERE `pro_id` = $id";
								
								$runsql = mysqli_query($conn,$sql);
								if($runsql)
								{
									$message=1;
									$messageDialog ="This product updated is successfully...";
									
								}
								else
								{
									$message=0;
									$messageDialog ="This product updated is not successfully...";
								}
					}
				}
			}
			break;
		case '3':
			if(isset($_GET['id']))
			{
				
				if(isset($_GET['img']))
				{
					$id = $_GET['id'];
					$imagePath = $_GET['img'];
					$path = "images/productsImage/".$imagePath;
					$paththumbnail = "images/productsImage/thumbnail/".$imagePath;
					$trimpaththumbnail = trim($paththumbnail);
					$trimpath = trim($path);
					if(file_exists($trimpath) && file_exists($trimpaththumbnail))
					{
							$sql ="DELETE FROM `tbl_products` WHERE `pro_id` =$id";
							$runsql = mysqli_query($conn,$sql);
							if($runsql)
							{
								$message =1;
								$messageDialog = "This record deleted is successfully...";
								unlink($trimpath);
								unlink($trimpaththumbnail);
							}
							else
							{
								$message =0;
								$messageDialog = "This record deleted is not successfully...";
							}
					}
					else
					{
							$sql ="DELETE FROM `tbl_products` WHERE `pro_id` =$id";
							$runsql = mysqli_query($conn,$sql);
							if($runsql)
							{
								$message =1;
								$messageDialog = "This record deleted is successfully...";
							}
							else
							{
								$message =0;
								$messageDialog = "This record deleted is not successfully...";
							}
					}
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
			    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
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
				<?php
					if($message ==1)
					{
				?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Success !</strong> <?=$messageDialog?>
				</div>
				<?php
				}
				elseif($message ==0){
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Error !</strong> <?=$messageDialog?>
				</div>
				<?php
				}
					if(isset($_GET['action']) && $_GET['action'] ==1)
					{
				?>
				<div>
					<h2>UPDATE PRODUCT</h2>
					<form method="post" enctype="multipart/form-data" action="listProducts.php?page=List_Products&action=2">
						<input type="hidden" value="<?=$getImg?>" name="oldimg">
						<input type="hidden" value="<?=$getId?>" name="byId">
						<div class="row">
							<div class="rounded mb-4 img-thumbnail col col-lg-3" style="width:200px;height:200px;">
                            <img id="previewImg" src="images/productsImage/<?=$getImg?>" alt="Preview Image" width="100%" height="100%" class="rounded">
                            <div class="input-group mt-2">
                                <div class="custom-file">
                                    <input type="file" name="txt_image" class="custom-file-input" onchange="previewFile(this);" id="customFile"/>
                                    <input type="button" class="custom-file-label btn bg-danger text-white w-100" value="New Image" for="customFile">
                                </div>
                            </div>
                       		</div>
							<div class="col">
							<div class="row mt-4">
								<div class="col">
									<label class="form-label">Date :</label>
									<input type="date" name="txt_date" value="<?=$getDate?>" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
								</div>
								<div class="col">
									<label class="form-label">Category :</label>
									<select class="form-control" name="txt_cate" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
										<option value="">-Select Category-</option>
										<?php
											$sqlcate = "SELECT * FROM `tbl_category` WHERE `status` =1";
											$runsqlcate = mysqli_query($conn,$sqlcate);
											while($getcate = mysqli_fetch_array($runsqlcate))
											{
												$nameCate = $getcate['name'];
												$cateID = $getcate['cateId'];
												if($getCateID == $cateID)
												{
													echo "<option value='$cateID' selected >$nameCate</option>";
												}
												else
												{
													echo "<option value='$cateID'>$nameCate</option>";
												}
												
											}
							
										?>
									</select>
								</div>
								<div class="col">
									<label class="form-label">Discount :</label>
									<select class="form-control" name="txt_discount" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
										<option value="">-Select Discount-</option>
										<?php
											$sqldisc = "SELECT * FROM `tbl_discount` WHERE `status` =1";
											$runsqldisc = mysqli_query($conn,$sqldisc);
											while($getdis = mysqli_fetch_array($runsqldisc))
											{
												$disPerent = $getdis['discountPerent'];
												$disID = $getdis['disID'];
												if($getDiscID == $disID)
												{
													echo "<option value='$disID' selected >$disPerent%</option>";
												}
												else
												{
													echo "<option value='$disID'>$disPerent%</option>";
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="row mt-5">
								<div class="col">
									<label class="form-label">Name :</label>
									<input type="text" name="txt_pName" value="<?=$getName?>" class="form-control" placeholder="Enter product name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
								</div>
								<div class="col">
									<label class="form-label">Quantity Stock :</label>
									<input type="number" name="txt_stock" value="<?=$getStock?>" class="form-control" placeholder="Enter quantity stock" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
								</div>
								<div class="col">
									<label class="form-label">Peice :</label>
									<input type="text" name="txt_price" value="<?=$getPrice?>" class="form-control" placeholder="Enter price" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
								</div>
							</div>
						</div>
						</div>
						<div class="row mt-5">
							<div class="col">
								<label class="form-label">Description :</label>
								<textarea class="form-control" rows="8" name="txt_desc" placeholder="Enter description" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"><?=$getDesc?></textarea>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<button type="submit" class="btn btn-primary w-25" >Update <i class="fas ml-2 fa-save"></i></button>
								<a href="listProducts.php?page=listProducts" class="btn btn-dark w-25">Back</a>
							</div>
						</div>
					</form>
				</div>
				<?php
					}
					else
					{
				?>
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
									<a href="listProducts.php?page=List_products&action=1&id=<?=$rows['pid']?>">
										<box-icon name='edit-alt'></box-icon>
									</a>
									<a href="#">
										<box-icon name='trash' data-toggle="modal" data-target="#deleteModal<?=$rows['pid']?>"></box-icon>
									</a>
									
								</td>
							</tr>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal<?=$rows['pid']?>" tabindex="-1" role="dialog" aria-labelledby="deleteModal<?=$rows['pid']?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content alert-warning">
      <div class="modal-header">
        <h3 class="modal-title" id="deleteModal<?=$rows['pid']?>">Your Message</h3>
      </div>
      <div class="modal-body">
        Are you sure to delete this record ?
      </div>
      <div class="modal-footer">
		  	<a href="listProducts.php?page=List_products&action=3&img=<?=$rows['pimg']?>&id=<?=$rows['pid']?>" class="btn btn-primary w-25">Yes</a>
        	<button type="button" class="btn btn-secondary w-25" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
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
<?php
					}
	?>
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
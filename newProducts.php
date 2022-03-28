<?php
include('libaries/auth.php');
include('database/db_connection.php');
$message =-1;
$messageDialog="";
if(!isLogin(3))
{
	header("location:login/login.php?page=login");
	exit();
}
if(isset($_GET['action']))
{
	$action = $_GET['action'];
	switch($action){
		case '1':
			$pname = $_POST['txt_pName'];
			$pcate = $_POST['txt_cate'];
			$pstock = $_POST['txt_stock'];
			$pprice = $_POST['txt_price'];
			$pdiscount = $_POST['txt_discount'];
			$pdate = $_POST['txt_date'];
			$pdesc = $_POST['txt_desc'];
			$userID = $_SESSION['userID'];
			
			$image = "noimage.png";
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
					$isnertSQL = "INSERT INTO `tbl_products`(`pro_image`, `pro_name`, `cateID`, `pro_stock`, `pro_price`, `pro_discount`, `pro_date`, `pro_description`, `userID`) VALUES ('$image','$pname','$pcate','$pstock','$pprice','$pdiscount','$pdate','$pdesc','$userID')";
					$runSQL = mysqli_query($conn,$isnertSQL);
					if($runSQL)
					{
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
						
						$message =1;
						$messageDialog = "Product insert is successfully...";
					}
					else
					{
						$message = 0;
						$messageDialog = "Product insert is not successfully...";
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">NEW PRODUCT</h3>
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
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
				<?php
                    if($message == 1)
                    {
                ?>
                <div class="alert alert-primary" role="alert">
                    <h3><strong>Success !</strong></h3><p><?=$messageDialog?></p>
                </div>
                <?php
                    }
                    elseif($message == 0)
                    {
                ?>
                <div class="alert alert-danger" role="alert">
                    <h3><strong>Error !</strong></h3><p><?=$messageDialog?></p>
                </div>
                <?php
                    }
                ?>
			<form method="post" enctype="multipart/form-data" action="newProducts.php?page=AddPreoducts&action=1">
               <div class="row">
					<div class="rounded mb-4 img-thumbnail col col-lg-3" style="width:200px;height:200px;">
                            <img id="previewImg" src="images/defualtImage.png" alt="Preview Image" width="100%" height="100%" class="rounded">
                            <div class="input-group mt-2">
                                <div class="custom-file">
                                    <input type="file" name="txt_image" class="custom-file-input" onchange="previewFile(this);" id="customFile" required/>
                                    <input type="button" class="custom-file-label btn bg-danger text-white w-100" value="Upload Image" for="customFile">
                                </div>
                            </div>
                       </div>
				   		<div class="col">
							<div class="row mt-4">
								<div class="col">
									<label class="form-label">Date :</label>
									<input type="date" name="txt_date" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
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
												echo "<option value='$cateID'>$nameCate</option>";
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
												echo "<option value='$disID'>$disPerent%</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div class="row mt-5">
								<div class="col">
									<label class="form-label">Name :</label>
									<input type="text" name="txt_pName" class="form-control" placeholder="Enter product name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
								</div>
								<div class="col">
									<label class="form-label">Quantity Stock :</label>
									<input type="number" name="txt_stock" class="form-control" placeholder="Enter quantity stock" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
								</div>
								<div class="col">
									<label class="form-label">Peice :</label>
									<input type="text" name="txt_price" class="form-control" placeholder="Enter price" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
								</div>
							</div>
						</div>
				</div>
				<div class="row mt-5">
					<div class="col">
						<label class="form-label">Description :</label>
						<textarea class="form-control" rows="8" name="txt_desc" placeholder="Enter description" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"></textarea>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col">
						<button type="submit" class="btn btn-primary w-25" >Save <i class="fas ml-2 fa-save"></i></button>
						<button type="reset" class="btn btn-dark w-25" >Clear <i class="fas ml-2 fa-eraser"></i></button>
						<a href="listProducts.php?page=listProducts" class="btn btn-success float-right">Show List <i class="fas ml-2 fa-list"></i></a>
					</div>
				</div>
			</form>
            </div>

            <footer class="footer text-center text-muted">
                All Rights Reserved by Bunney ThiaReuth.
            </footer>
        </div>
    </div>
<?php
include 'include/scriptFooter.php';
?>
</script>
<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "newProducts.php?page=newProducts");  
    }
</script>
</body>

</html>
<?php mysqli_close($conn)?>
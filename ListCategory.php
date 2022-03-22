<?php
	include('database/db_connection.php');
	include('libaries/auth.php');
	if(!isLogin())
	{
		header("location:login/login.php?page=login");
		exit();
	}
	$message = -1;
	$messageDialog = "";
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
		switch($action)
		{
			case '1':
				if(isset($_GET['delectID']))
				{
					$id = $_GET['delectID'];
					$sql = "DELETE FROM `tbl_category` WHERE `cateId` = $id";
					$result = mysqli_query($conn,$sql);
					if($result)
					{
						$message = 1;
						$messageDialog = "This record deleted is successfully ... ";
					}
					else
					{
						$message = 0;
						$messageDialog = "This record deleted is successfully ... ";
					}
				}
				break;
			case '2':
				if(isset($_GET['enableID']))
				{
					$enableID = $_GET['enableID'];
					$sql = "UPDATE `tbl_category` SET `status`='1' WHERE `cateId` = $enableID";
					$result = mysqli_query($conn,$sql);
					if($result)
					{
						$message = 1;
						$messageDialog = "This record enable is successfully ... ";
					}
					else
					{
						$message = 0;
						$messageDialog = "This record enable is successfully ... ";
					}
				}
				break;
			case '3':
				if(isset($_GET['disabelID']))
				{
					$disabelID = $_GET['disabelID'];
					$sql = "UPDATE `tbl_category` SET `status`='0' WHERE `cateId` = $disabelID";
					$result = mysqli_query($conn,$sql);
					if($result)
					{
						$message = 1;
						$messageDialog = "This record disable is successfully ... ";
					}
					else
					{
						$message = 0;
						$messageDialog = "This record disable is successfully ... ";
					}
				}
				break;
			case '4':
					if(isset($_GET['updateID']))
					{
						$id = $_GET['updateID'];
						$name = $_POST['upName'];
						$desc = $_POST['upDesc'];
						
						$sql = "UPDATE `tbl_category` SET `name`='$name',`description`='$desc' WHERE `cateId` = $id";
						$result = mysqli_query($conn,$sql);
						if($result)
						{
							$message = 1;
							$messageDialog = "This record updated is successfully ... ";
						}
						else
						{
							$message = 0;
							$messageDialog = "This record updated is successfully ... ";
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">LIST CATEGORY</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="category.php?page=category">Category</a>
										<li class="breadcrumb-item"><a href="ListCategory.php?page=Listcategory">List Category</a>
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
				<div class="alert alert-success" role="alert">
				  <h4 class="alert-heading">Success !</h4>
				  <p><?=$messageDialog?></p>
				  <hr>
				</div>
				<?php
				}
					elseif($message == 0)
					{	
				?>
				<div class="alert alert-danger" role="alert">
				  <h4 class="alert-heading">Error !</h4>
				  <p><?=$messageDialog?></p>
				  <hr>
				</div>
				<?php
					}
				?>
                <div class="mt-2">
					<table id="list" class="table-hover table table-success">
						<thead class="bg-success text-white">
							<tr>
								<th class="text-center">#No</th>
								<th>Name</th>
								<th>Description</th>
								<th class="text-center">Status</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody class="border border-success">
						<?php
								$i=1;
								$sql = "SELECT * FROM `tbl_category`";
								$runsql = mysqli_query($conn,$sql);
								while($rows = mysqli_fetch_array($runsql))
								{
						?>
							<tr>
								<td><?=$i?></td>
								<td><?=$rows['name']?></td>
								<td><?=$rows['description']?></td>
								<td>
									<?php
										if($rows['status'] == 1)
										{
									?>
									<a href="ListCategory.php?page=ListCategory&action=3&disabelID=<?=$rows['cateId']?>">
										<box-icon name='show'></box-icon>
									</a>
									<?php
										}
										else
										{
									?>
									<a href="ListCategory.php?page=ListCategory&action=2&enableID=<?=$rows['cateId']?>">
										<box-icon name='hide' ></box-icon>
									</a>
									<?php
										}
									?>
								</td>
								<td>
									<a href="#">
										<box-icon name='edit' type='solid' data-toggle="modal" data-target="#ModalEdit<?=$rows['cateId']?>" ></box-icon>
									</a>
									<a href="#">
										<box-icon name='trash' data-toggle="modal" data-target="#Modal<?=$rows['cateId']?>"></box-icon>
									</a>
								</td>
							</tr>
								<!-- Delete Modal -->
                            <div class="modal fade" id="Modal<?=$rows['cateId']?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?=$rows['cateId']?>" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content alert-warning">
									<div class="modal-header">
										<h3 class="modal-title" id="Modal<?=$rows['cateId']?>">Your Message</h3>
									</div>
									<div class="modal-body">
										Do you want to delete this record ?
									</div>
									<div class="modal-footer">
										<a href="ListCategory.php?page=ListCategory&action=1&delectID=<?=$rows['cateId']?>" class="btn btn-primary w-25">Yes</a>
										<button type="button" class="btn btn-secondary w-25" data-dismiss="modal">No</button>
									</div>
                                </div>
                            </div>
                            </div>
							
							<!-- Edit modal -->
				<div class="modal fade" id="ModalEdit<?=$rows['cateId']?>" tabindex="-1" role="dialog" aria-labelledby="ModalEdit<?=$rows['cateId']?>" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered " role="document">
					<div class="modal-content alert-warning">
					  <div class="modal-header">
						<h3 class="modal-title" id="ModalEdit<?=$rows['cateId']?>">UPDATE CATEGOEY</h3>
					  </div>
					  <div class="modal-body">

						<form method="post" enctype="multipart/form-data" action="ListCategory.php?page=ListCategory&action=4&updateID=<?=$rows['cateId']?>" class="form-group">
							<label for="catename" class="form-label">Name :</label>
							<input type="text" class="form-control" name="upName" id="catename" placeholder="Update Name" value="<?=$rows['name']?>" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
							<label for="textDesc" class="form-label">Description :</label>
							<textarea rows="5" class="form-control" id="textDesc" name="upDesc" placeholder="Update Description" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"><?=$rows['description']?></textarea>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary w-25">Update <i class="fas ml-2 fa-save"></i></button>
								<button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close </button>
							 </div>
						  </form>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
	$(document).ready( function () {
    $('#list').DataTable();
} );
</script>
	<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "ListCategory.php?page=ListCategory");  
    }
</script>
</body>

</html>
<?php mysqli_close($conn)?>
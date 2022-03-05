<?php
	include 'database/db_connection.php';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <?php
        include 'include/head.php';
    ?>
	<script type="text/javascript" src="js/deleteCate.js"></script>
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Components</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="category.php?page=category">Category</a>
									<li class="breadcrumb-item"><a href="ListCategory.php?page=ListCategory">List Category</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
               		<div>
						<h1>LIST CATEGOEY</h1>
					</div>
				<div class="mt-3" id="tblList">
					<table id="cateList" class="table-hover table-success">
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center">#No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-primary">
                            <?php
                                $i=1;
                                $selectCate = "SELECT * FROM `tbl_category`";
                                $runselectCate = mysqli_query($conn,$selectCate);
                                while($rows = mysqli_fetch_array($runselectCate))
                                {
                            ?>
                            <tr>
                                <td class="text-center"><?=$i?></td>
                                <td><?=$rows['name']?></td>
                                <td><?=$rows['description']?></td>
                                <td class="text-center">
                                    <?php
                                        if($rows['status']==1)
                                        {
                                    ?>
                                        <a href="#">
                                            <box-icon name='show'></box-icon>
                                        </a>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <a href="#">
                                            <box-icon name='hide' ></box-icon>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="#">
                                        <box-icon name='edit-alt'></box-icon>
                                    </a>
									<a href="#">
										<box-icon name='trash-alt' data-toggle="modal" data-target="#Modal<?=$rows['cateId']?>"></box-icon>
									</a>
                                </td>
                            </tr>

                            </div>
									<!-- Modal -->
									<div class="modal fade" id="Modal<?=$rows['cateId']?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?=$rows['cateId']?>" aria-hidden="true">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header">
											<h5 class="modal-title" id="Modal<?=$rows['cateId']?>">You Message</h5>
										  </div>
										  <div class="modal-body">
											Are you suer to delete ?
										  </div>
										  <div class="modal-footer">
											<a href="#" class="btn btn-primary w-25">Yes</a>
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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#cateList').DataTable();
    } );
</script>
<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "ListCategory.php?page=ListCategory");  
    }
</script>
</body>

</html>
<?php
    include('database/db_connection.php');
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">LIST DICOUNT</h3>
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
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div>
                <table id="list" class="table-hover table table-success">
						<thead class="bg-success text-white">
							<tr>
								<th class="text-center">#No</th>
								<th>Name</th>
								<th>Description</th>
                                <th>Discount Perent</th>
                                <th>Start Date</th>
                                <th>End Date</th>
								<th class="text-center">Status</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody class="border border-success">
                            <?php
                                $selectDiscount = "SELECT * FROM `tbl_discount`";
                                $runselectDiscount = mysqli_query($conn,$selectDiscount);
                                if(mysqli_num_rows($runselectDiscount)>0)
                                {
                                    $i=1;
                                    while($rows = mysqli_fetch_array($runselectDiscount))
                                    {
                            ?>  
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=$rows['name']?></td>
                                        <td><?=$rows['description']?></td>
                                        <td><?=$rows['discountPerent']?>%</td>
                                        <td><?=$rows['startDate']?></td>
                                        <td><?=$rows['endDate']?></td>
                                        <td class="text-center">
                                            <?php
                                                if($rows['status']==1)
                                                {
                                            ?>
                                            <a href="#">
                                                <box-icon name='show' ></box-icon>
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
                                        <td>
                                            <a href="#">
                                                <box-icon name='edit' type='solid'></box-icon>
                                            </a>
                                            <a href="#">
                                                <box-icon name='trash'></box-icon>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                        $i++;
                                    }
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
         window.history.replaceState( null, null, "lsitDiscount.php?page=lsitDiscount");  
    }
</script>
</body>

</html>
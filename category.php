<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <?php
        include 'include/head.php';
		
    ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/InsertCate.js"></script>
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Category</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="category.php?page=category">Category</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
					<div>
						<h1>Create Category</h1>
					</div>
				<div id="ms" class="mt-4">
				
				</div>
				
                <div class="mt-5">
                    <form  method="post" enctype="multipart/form-data" id="insertCateFrm">
                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" name="txt_cateName" class="form-control" placeholder="Enter category name" required>
                            </div>
                            <div class="col">
                                <label for="status" class="form-label" >Status:</label>
                                <select id="status" class="form-control" name="txt_status" required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" rows="7" class="form-control" name="txt_desc" required></textarea>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary w-25">Save</button>
                            <button type="reset" class="btn btn-dark w-25">Clear</button>
							<a href="ListCategory.php?page=ListCategory" class="btn btn bg-success w-25 text-white">List</a>
                        </div>
                    </form>
					
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
         window.history.replaceState( null, null, "category.php?page=category");  
    }
</script>
</body>
</html>
	